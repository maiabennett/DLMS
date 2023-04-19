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
setwd('home/maiabennett/flow-analysis/')
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
fileout <- paste(args[3], ".pdf")

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
            plotFile = fileout))


