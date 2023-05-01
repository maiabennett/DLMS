/* This code contains the initial DDL for flowDB. It initializes a total of 7  tables. */

/* make members table */

CREATE TABLE members (
	name VARCHAR(50) NOT NULL,
	joined DATE,
	grad DATE,
	project VARCHAR(300),
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

/* make assay table: as multiple references to the same column (i.e., multiple foreign keys to member(name)) are not allowed, this effect
 will be accomplished using dropdown bars of already entered members. */

CREATE TABLE assay (
	assayID VARCHAR(6) NOT NULL,
	donorID VARCHAR(5) NOT NULL,
	run DATE,
	lead VARCHAR(50),
	magnet VARCHAR(50),
	targets VARCHAR(50),
	staining VARCHAR(50),
	flow VARCHAR(50),
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

/* make flowpanel table: as multiple references to the same column (i.e., multiple foreign keys to marker(markerID)) are not allowed, this effect will be accomplished using dropdown bars of already entered markerIDs. */

CREATE TABLE flowpanel (
	FLID VARCHAR(10) NOT NULL,
	FL1 VARCHAR(27), 
	FL2 VARCHAR(27),
	FL3 VARCHAR(27),
	FL4 VARCHAR(27),
	FL5 VARCHAR(27),
	FL6 VARCHAR(27),
	FL7 VARCHAR(27),
	FL8 VARCHAR(27),
	compID VARCHAR(10),
	iscurrent VARCHAR(1),
	comments VARCHAR(200),
	PRIMARY KEY (FLID),
	FOREIGN KEY (compID) REFERENCES comp(compID));

/* make flowfiles table: currently, this should be able to fetch the file via the ODpath (OneDrive path) and copy it to the new path. */

CREATE TABLE flowfiles (
	assayID VARCHAR(6) NOT NULL,
	filename VARCHAR(100) NOT NULL,
	ODpath VARCHAR(300),
	newpath VARCHAR(300),
	cond VARCHAR(30),
	FLID VARCHAR(10) NOT NULL,
	FOREIGN KEY (assayID) REFERENCES assay(assayID),
	FOREIGN KEY (FLID) REFERENCES flowpanel(FLID),
	PRIMARY KEY(assayID, filename));
