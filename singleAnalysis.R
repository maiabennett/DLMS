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
setwd('home/maiabennett/flow-analysis/')

# Fixed compensation matrix
comp <- read.csv("comp_matrix.csv", check.names = FALSE, row.names = 1)
colnames(comp) <- sub(" :: .*", "", colnames(comp))

# Set up to retrieve variables from PHP
args <- commandArgs(TRUE)

# Read in variables
file <- args[1]
fileout <- paste0(args[2], ".pdf")


# Create flow frame from input files
ff <- read.FCS(paste0(file, ".fcs"), truncate_max_range = FALSE)

# Gating variables
markers <-c("CD56 APC-A", "CD16 PB450-A", "NKG2A PE-A", "NKG2D APC-A750-A", "CD57 PE-Cy7-A", "NKp46 KO525-A")
channels <- GetChannels(object = ff, markers = markers, exact = FALSE)
live_gate <- rectangleGate(filterId = "Live", "FSC-A" = c(1000,2000000), "FL3-A" = c(-1000,10000))

# Pre-process
ff_m <- RemoveMargins(ff, channels)
ff_c <- compensate(ff_m, comp)
ff_s <- RemoveDoublets(ff_c)
live <- filter(ff_s, live_gate)
ff_l <- ff_s[live@subSet, ]

# Create FlowSOM result 
fsom <- FlowSOM(input = ff_l, colsToUse = channels, scale = TRUE)

# Print FlowSOM result
FlowSOMmary(fsom = fsom,
            plotFile = fileout)

