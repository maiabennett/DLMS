# flowDB: a database to enable storage and high-level analysis of flow cytometric data

This is the repository for Maia Bennett's CSCI 8876 Database Search and Pattern Discovery course project at the University of Nebraska at Omaha (UNO).

Natural killer (NK) cells, the innate immune counterparts to cytotoxic T cells, are the primary effectors of innate immunity. They kill diseased cells by two methods: direct killing and antibody-dependent cellular cytotoxicity (ADCC). The Denton Immunobiology Lab at the University of Nebraska at Omaha is currently focused on studying NK-mediated killing (both direct and via ADCC) and combination immunotherapeutic strategies in B cell lymphoma and leukemia. To study these processes, they obtain peripheral blood mononuclear cells (PBMCs)—a cell population which contains most human immune cells—from human donors for NK cell enrichment and subsequent testing of cancer killing efficacy. All cells, including NK cells, express unique proteins on their surface—termed markers—which directly inform their actions and how they respond to various stimuli. The overall profile of these markers is called an immunophenotype. Although these markers have complex roles in cell signaling, they have two predominant identities in cancer killing; cytotoxic NK cells—activated NK cells with the capacity to kill diseased cells—and cytokine-producing NK cells. The Denton Lab utilizes an 8-color flow cytometry panel to assess donor NK cell immunophenotypes under various conditions at the same time as cancer killing efficacy is measured. Although this data is highly useful, it is currently stored in an inefficient manner which makes consistent analysis difficult. Additionally, analysis is currently conducted using FlowJo: while a powerful analytical tool for flow cytometry data, FlowJo requires significant expertise to operate with high dimensional analysis capacity. This practice is outdated and limits the knowledge that can be extracted from flow cytometry data severely.

## The main aim of this project is to create a user-friendly database to facilitate analysis of primary flow cytometry data by the Denton Immunobiology Lab. 
- The first aim is to create a database (flowDB) that accurately stores flow cytometry data, donor metadata, and relevant gene ontologies. 
- The second aim is to develop analytical methodologies to run FlowSOM on stored flow cytometry data.
- The third aim is to design a user-friendly interface to enable non-bioinformatics Denton Lab members analytical capacity of their data.

## General overview of the database schema
Table schema:
![course-project-tables](https://user-images.githubusercontent.com/123126475/227023244-f7df8343-f6b7-465c-acc8-48bbaec1c2af.png)

Relationships:
![course-project-relationships](https://user-images.githubusercontent.com/123126475/227023286-201fb9c3-903d-40a8-891f-551c29b9b6c5.png)

## Installation
Access to a MySQL server is required for use of this database. To implement flowDB with the test data, navigate to your MySQL database. Obtain the [schema](https://github.com/maiabennett/flowDB/blob/main/course-project-ddl.sql) and [test data](https://github.com/maiabennett/flowDB/blob/main/course-project-dml.sql) files from this GitHub repository. Set up the database schema by running 'mysql [your database name] < course-project-ddl.sql'. Import the test data to your database by running 'mysql [your database name] < course-project-dml.sql'.

To implement the web-based user interface (UI), all non-deprecated .php files included in this repository should be downloaded and placed together on a web server file system. 

## License
This repository uses the MIT License. 
