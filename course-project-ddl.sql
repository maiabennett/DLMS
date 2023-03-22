-- Name: Maia Bennett
-- EMAIL: maiabennett@unomaha.edu
-- Class: CSCI 8876, Spring 2023
-- Assignment #: Course Project DDL
-- 
-- Honor Pledge: On my honor as a student of the University of Nebraska at 
-- Omaha, I have neither given nor received unauthorized help on 
-- this programming assignment.
-- 
-- Partners: None
-- 
-- Sources: None

/* This code contains the initial DDL for flowDB. It initializes a total of 7  tables. */

/* make members table */

CREATE TABLE members (
	name VARCHAR(50) NOT NULL,
	joined DATE,
	left DATE,
	PRIMARY KEY (name));

/* make metadata table */

CREATE TABLE metadata (
	donorID VARCHAR(5) NOT NULL,
	age INT,
	ethnicity VARCHAR(20),
	sex VARCHAR(1),
	collected DATE,
	comments VARCHAR(300),
	PRIMARY KEY (donorID));

/* make assay table */

CREATE TABLE assay (
	assayID VARCHAR(6) NOT NULL,
	donorID VARCHAR(5) NOT NULL,
	run DATE,
	lead VARCHAR(50) FOREIGN KEY REFERENCES members(name),
	magnet VARCHAR(50) FOREIGN KEY REFERENCES members(name),
	targets VARCHAR(50) FOREIGN KEY REFERENCES members(name),
	staining VARCHAR(50) FOREIGN KEY REFERENCES members(name),
	flow VARCHAR(50) FOREIGN KEY REFERENCES members(name),
	comments VARCHAR(300) NOT NULL,
	PRIMARY KEY (assayID));

/* make markers table: notably, although markerID is the primary key, it is created internally by concatenating "marker"-"fluor", so it is listed in the third column. */

CREATE TABLE markers (
	marker VARCHAR(6) NOT NULL,
	fluor VARCHAR(20) NOT NULL,
	markerID VARCHAR(27) NOT NULL,
	catID VARCHAR(50),
	gene_product VARCHAR(10),
	PRIMARY KEY (markerID));

/* make comp table */

CREATE TABLE comp (
	compID VARCHAR(14) NOT NULL,
	matrix VARCHAR(20) NOT NULL,
	path VARCHAR(300),
	PRIMARY KEY(compID));

/* make flowpanel table */

CREATE TABLE flowpanel (
	FLID VARCHAR(10) NOT NULL,
	FL1 VARCHAR(27) FOREIGN KEY REFERENCES markers(markerID), 
	FL2 VARCHAR(27) FOREIGN KEY REFERENCES markers(markerID),
	FL3 VARCHAR(27) FOREIGN KEY REFERENCES markers(markerID),
	FL4 VARCHAR(27) FOREIGN KEY REFERENCES markers(markerID),
	FL5 VARCHAR(27) FOREIGN KEY REFERENCES markers(markerID),
	FL6 VARCHAR(27) FOREIGN KEY REFERENCES markers(markerID),
	FL7 VARCHAR(27) FOREIGN KEY REFERENCES markers(markerID),
	FL8 VARCHAR(27) FOREIGN KEY REFERENCES markers(markerID),
	compID VARCHAR(10) FOREIGN KEY REFERENCES comp(compID),
	current VARCHAR(1),
	comments VARCHAR(200),
	PRIMARY KEY (FLID));

/* make flowfiles table: currently, this should be able to fetch the file via the ODpath (OneDrive path) and copy it to the new path. */

CREATE TABLE flowfiles (
	assayID VARCHAR(5) FOREIGN KEY REFERENCES assay(assayID),
	filename VARCHAR(100) NOT NULL,
	ODpath VARCHAR(300),
	newpath VARCHAR(300), 
	condition VARCHAR(30),
	FLID VARCHAR(10) FOREIGN KEY REFERENCES flowpanel(FLID),
	PRIMARY KEY(assayID, filename));




