-- Name: Maia Bennett
-- EMAIL: maiabennett@unomaha.edu
-- Class: CSCI 8876, Spring 2023
-- Assignment #: Course Project DML
-- 
-- Honor Pledge: On my honor as a student of the University of Nebraska at 
-- Omaha, I have neither given nor received unauthorized help on 
-- this programming assignment.
-- 
-- Partners: None
-- 
-- Sources: None

/* This code contains the initial DML for flowDB. It fills a total of 7  tables with a small subset of all intended flowDB data. */

/* fill members table */

INSERT INTO members VALUES ('Maia Bennett', '01-01-2020', NULL);
INSERT INTO members VALUES ('Anna Mahr', '05-01-2021', NULL);
INSERT INTO members VALUES ('Cami Bisson', '08-01-2022', NULL);
INSERT INTO members VALUES ('Angela Truong', '08-01-2022', NULL);
INSERT INTO members VALUES ('Isabelle Weber', '01-01-2022', NULL);
INSERT INTO members VALUES ('Jaden Neinhueser', '01-01-2022', NULL);
INSERT INTO members VALUES ('DJ Rogers', '03-01-2022', NULL);
INSERT INTO members VALUES ('Bella Circo', '05-01-2021', NULL);
INSERT INTO members VALUES ('Josh Franzen', '08-01-2021', NULL);
INSERT INTO members VALUES ('Nathan Booher', '01-01-2021', NULL);
INSERT INTO members VALUES ('Hakim Lotoro', '01-01-2023', NULL);
INSERT INTO members VALUES ('Arriana Blackmon', '01-01-2020', NULL);

/* fill metadata table */

INSERT INTO metadata VALUES ('HuF3', NULL, NULL, NULL, '07-26-2022', NULL);
INSERT INTO metadata VALUES ('HuG3', NULL, NULL, NULL, '07-27-2022', NULL);
INSERT INTO metadata VALUES ('HuH3', NULL, NULL, NULL, '08-03-2022', NULL);
INSERT INTO metadata VALUES ('HuI3', NULL, NULL, NULL, '08-09-2022', NULL);
INSERT INTO metadata VALUES ('HuJ3', NULL, NULL, NULL, '08-24-2022', NULL);
INSERT INTO metadata VALUES ('HuK3', 40, 'Caucasian', 'F', '08-30-2022', NULL);
INSERT INTO metadata VALUES ('HuL3', 66, 'Caucasian', 'M', '09-07-2022', NULL);
INSERT INTO metadata VALUES ('HuM3', 52, 'Caucasian', 'M', '10-04-2022', NULL);
INSERT INTO metadata VALUES ('HuN3', 46, 'Caucasian', 'F', '10-13-2022', NULL);
INSERT INTO metadata VALUES ('HuO3', 72, 'Caucasian', 'F', '10-13-2022', NULL);
INSERT INTO metadata VALUES ('HuP3', 21, 'Caucasian', 'M', '10-18-2022', NULL);
INSERT INTO metadata VALUES ('HuQ3', 75, 'Caucasian', 'F', '10-25-2022', NULL);
INSERT INTO metadata VALUES ('HuR3', 62, 'Caucasian', 'F', '11-01-2022', NULL);

/* fill assay table */

INSERT INTO assay VALUES ('AM033a', 'HuF3', '07-29-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033b', 'HuG3', '07-30-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033c', 'HuH3', '08-06-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033d', 'HuI3', '08-12-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033e', 'HuJ3', '08-27-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033f', 'HuK3', '09-02-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033g', 'HuL3', '09-10-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, NULL, NULL);
INSERT INTO assay VALUES ('AM034a', 'HuM3', '10-07-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, NULL, NULL);
INSERT INTO assay VALUES ('AM034b', 'HuP3', '10-21-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, NULL, NULL);
INSERT INTO assay VALUES ('AM034c', 'HuR3', '11-04-2022', 'Anna Mahr', 'Anna Mahr', NULL, NULL, NULL, NULL);

/* fill markers table */

INSERT INTO markers VALUES ('Lin', 'FITC', (SELECT concat(marker, ' ', fluor), NULL, NULL);
INSERT INTO markers VALUES ('NKG2A', 'PE', (SELECT concat(marker, ' ', fluor), NULL, NULL);
INSERT INTO markers VALUES ('7AAD', 'PC5.5', (SELECT concat(marker, ' ', fluor), NULL, NULL);
INSERT INTO markers VALUES ('CD57', 'PE-Cy7', (SELECT concat(marker, ' ', fluor), NULL, NULL);
INSERT INTO markers VALUES ('CD56', 'APC', (SELECT concat(marker, ' ', fluor), NULL, NULL);
INSERT INTO markers VALUES ('NKG2D', 'APC-A750', (SELECT concat(marker, ' ', fluor), NULL, NULL);
INSERT INTO markers VALUES ('CD16', 'PB450', (SELECT concat(marker, ' ', fluor), NULL, NULL);
INSERT INTO markers VALUES ('NKp46', 'KO525', (SELECT concat(marker, ' ', fluor), NULL, NULL);

/* fill comp table */

INSERT INTO comp VALUES ('immunoNKcomp', 'immunoNKmatrix', NULL)

/* fill flowpanel table */

INSERT INTO flowpanel VALUES ('immunoNK', 'Lin-FITC', 'NKG2A-PE', '7AAD-PC5.5', 'CD57-Pe-Cy7', 'CD56-APC', 'NKG2D-APC-A750', 'CD16-PB450', 'NKp46-KO525', 'Y', NULL);

/* fill flowfiles table: currently, both paths are manually inputted; eventually, a function can be built to create the new directory based on assay name and panel utilized. */

/* AM033a */
INSERT INTO flowfiles VALUES ('AM033a', 'NK unstim', "C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\Flow Cytometry Data\Mahr-Anna\AM033\AM033a\Immunophenotyping\Immu_Exp_20220729\NK unstim.fcs", NULL, 'Untreated', 'immunoNK');
INSERT INTO flowfiles VALUES ('AM033a', 'NK unstim aCD20', "C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\Flow Cytometry Data\Mahr-Anna\AM033\AM033a\Immunophenotyping\Immu_Exp_20220729\NK unstim aCD20.fcs", NULL, 'Untreated + aCD20', 'immunoNK');
INSERT INTO flowfiles VALUES ('AM033a', 'NK stim', "C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\Flow Cytometry Data\Mahr-Anna\AM033\AM033a\Immunophenotyping\Immu_Exp_20220729\NK stim.fcs", NULL, 'TLR9a stimulated', 'immunoNK');
INSERT INTO flowfiles VALUES ('AM033a', 'NK stim aCD20', "C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\Flow Cytometry Data\Mahr-Anna\AM033\AM033a\Immunophenotyping\Immu_Exp_20220729\NK stim aCD20.fcs", NULL, 'TLR9a stimulated + aCD20', 'immunoNK');

/* AM033b */
INSERT INTO flowfiles VALUES ('AM033b', 'NK unstim', "C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\Flow Cytometry Data\Mahr-Anna\AM033\AM033b\AM033b\Immunophenotyping\Immu_Exp_20220730_1\NK unstim.fcs", NULL, 'Untreated', 'immunoNK');
INSERT INTO flowfiles VALUES ('AM033b', 'NK unstim aCD20', "C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\Flow Cytometry Data\Mahr-Anna\AM033\AM033b\AM033b\Immunophenotyping\Immu_Exp_20220730_1\NK unstim aCD20.fcs", NULL, 'Untreated + aCD20', 'immunoNK');
INSERT INTO flowfiles VALUES ('AM033b', 'NK stim', "C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\Flow Cytometry Data\Mahr-Anna\AM033\AM033b\AM033b\Immunophenotyping\Immu_Exp_20220730_1\NK stim.fcs", NULL, 'TLR9a stimulated', 'immunoNK');
INSERT INTO flowfiles VALUES ('AM033b', 'NK stim aCD20', "C:\Users\Me\OneDrive - University of Nebraska at Omaha\==UNO=Denton_Research_Lab\Flow Cytometry Data\Mahr-Anna\AM033\AM033b\AM033b\Immunophenotyping\Immu_Exp_20220730_1\NK stim aCD20.fcs", NULL, 'TLR9a stimulated + aCD20', 'immunoNK');
