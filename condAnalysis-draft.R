# Load libraries
library(tidyverse)
library(ggcyto)
library(stats)
library(flowCore)
library(flowStats)
library(FlowSOM)
library(readxl)
library(xlsx)
library(PeacoQC)
library(pheatmap)
library(factoextra)

# Fixed global variables
## Working directory
wd <- ""
## Directory of preprocessed files
dir_prepped <- "./preprocessed/"
## Directory of aggregated files
dir_agg <- "./aggregated/"

# Fixed compensation matrix
comp <- read.csv("...comp_matrix.csv", check.names = FALSE, row.names = 1)
colnames(comp) <- sub(" :: .*", "", colnames(comp))

# Set up to retrieve variables from PHP
args <- commandArgs(TRUE)

# Read in variables
files <- args[1:2]
conds <- args[3]
fileout <- paste(args[4], ".pdf")

# Gating variables
markers <-c("CD56 APC-A", "CD16 PB450-A", "NKG2A PE-A", "NKG2D APC-A750-A", "CD57 PE-Cy7-A", "NKp46 KO525-A")
channels <- GetChannels(object = ff, markers = markers, exact = FALSE)
live_gate <- rectangleGate(filterId = "Live", "FSC-A" = c(1000,2000000), "FL3-A" = c(3000,10000))
NK_gate <- rectangleGate(filterId = "NKs", "FL1-A" = c(-1000,1000), "FL5-A" = c(4000,1000000)) # NEEDS CHECKING

# Create flow frames from input files and pre-process
for (file in files[1:2]) {
  
  ff <- read.FCS(file, truncate_max_range = FALSE)
  ff_m <- RemoveMargins(ff, channels)
  ff_c <- compensate(ff_m, comp)
  translist <- estimateLogicle(ff_c, colnames(comp))
  #ff_t <- flowCore::transform(ff_c, translist)
  #ff_s <- RemoveDoublets(ff_t)
  live <- filter(ff_s, live_gate)
  ff_l <- ff_s[live@subSet, ]
  NKs <- filter(ff_l, NK_gate)
  ff_nk <- ff_l[NKs@subSet, ]
  
  # Write preprocessed flow frames to file (for aggregation))
  write.FCS(ff_nk,
            file = paste0(dir_prepped, file))
}

## Name of the aggregated files
name_agg <- paste(fileout, "_agg.fcs")

# Aggregate pre-processed flow frames
agg_untreated <- AggregateFlowFrames(paste0(dir_prepped, files),
                                     cTotal = n, writeOutput = TRUE, 
                                     outputFile = paste0(dir_agg, name_agg))

# Create FlowSOM result 
fsom <- FlowSOM(input = ff_nk, colsToUse = channels, scale = TRUE, transform = TRUE, transformFunction = flowCore::logicleTransform())

# Print FlowSOM result
FlowSOMmary(fsom = fsom,
            plotFile = fileout)


# Get file overlay statistics
percentages <-GetFeatures(fsom = fsom_untreated,
                          files = paste0(dir_prepped, files),
                          type = "percentages")

# Parse conditions and separate files
## Get file names as "assay" "condition"
file1trim <- strsplit(files[1], ", ")
file2trim <- strsplit(files[2], ", ") 
file1_cond <- file1trim[[1]][2]
file2_cond <- file2trim[[1]][2]

## Subset to "condition" with file1 first
cond <- c(file1_cond, file2_cond)

## Create group list in the syntax flowSOM prefers, with file1 first
groups <- list(setNames(as.list(files), cond))

# Get file overlay cluster composition statistics
MC_stats <- GroupStats(percentages[["metacluster_percentages"]], groups)
C_stats <- GroupStats(percentages[["cluster_percentages"]], groups)

fold_changes <- C_stats["fold changes", ]
fold_changes <- factor(ifelse(fold_changes < -1, paste("Underrepresented compared to ", file1_cond),
                                 ifelse(fold_changes > 1, paste("Overrepresented compared to low killing group", file1_cond),
                                        "--")), levels = c("--", paste("Underrepresented compared to low killing group", file1_cond),
                                                           paste("Overrepresented compared to low killing group", file1_cond)))
fold_changes[is.na(fold_changes)] <- "--"

# Visualize cluster compositions
sbs_file1 <- PlotStars(fsom_untreated, title = file1_cond,
                        nodeSizes = C_stats[paste("medians ", file1_cond), ],
                        refNodeSize = max(C_stats[c(paste("medians ", file1_cond), paste("medians ", file2_cond)),]),
                        backgroundValues = fold_changes,
                        backgroundColors = c("white", "red", "blue"),
                        list_insteadof_ggarrange = TRUE)
sbs_file2 <- PlotStars(fsom_untreated, title = file2_cond,
                         nodeSizes = C_stats[paste("medians ", file2_cond), ],
                         refNodeSize = max(C_stats[c(paste("medians ", file1_cond), paste("medians ", file2_cond)),]),
                         backgroundValues = fold_changes,
                         backgroundColors = c("white", "red", "blue"),
                         list_insteadof_ggarrange = TRUE)

# Create the final side-by-side visual 
cond_result <- ggpubr::ggarrange(plotlist = list(sbs_file1$tree, sbs_file2$tree,
                                                     sbs_file2$starLegend, sbs_file2$backgroundLegend),
                                     ncol = 2, nrow = 2,
                                     heights = c(4, 1))

# Print condition composition results
pdf(fileout, title(conds))
cond_result
dev.off()
