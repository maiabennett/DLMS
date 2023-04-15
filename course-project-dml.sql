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

USE maiabennett;

/* This code contains the initial DML for flowDB. It fills a total of 7  tables with a small subset of all intended flowDB data. */

/* fill members table */

INSERT INTO members VALUES ('Maia Bennett', '2020-01-01', NULL);
INSERT INTO members VALUES ('Anna Mahr', '2021-05-01', NULL);
INSERT INTO members VALUES ('Cami Bisson', '2022-08-01', NULL);
INSERT INTO members VALUES ('Angela Truong', '2022-08-01', NULL);
INSERT INTO members VALUES ('Isabelle Weber', '2022-01-01', NULL);
INSERT INTO members VALUES ('Jaden Neinhueser', '2022-01-01', NULL);
INSERT INTO members VALUES ('DJ Rogers', '2022-03-01', NULL);
INSERT INTO members VALUES ('Bella Circo', '2021-05-01', NULL);
INSERT INTO members VALUES ('Josh Franzen', '2021-08-01', NULL);
INSERT INTO members VALUES ('Nathan Booher', '2021-01-01', NULL);
INSERT INTO members VALUES ('Hakim Lotoro', '2023-01-01', NULL);
INSERT INTO members VALUES ('Arriana Blackmon', '2020-01-01', NULL);

/* fill metadata table */

INSERT INTO metadata VALUES ('HuF3', NULL, NULL, NULL, '2022-07-26', NULL);
INSERT INTO metadata VALUES ('HuG3', NULL, NULL, NULL, '2022-07-27', NULL);
INSERT INTO metadata VALUES ('HuH3', NULL, NULL, NULL, '2022-08-03', NULL);
INSERT INTO metadata VALUES ('HuI3', NULL, NULL, NULL, '2022-08-09', NULL);
INSERT INTO metadata VALUES ('HuJ3', NULL, NULL, NULL, '2022-08-24', NULL);
INSERT INTO metadata VALUES ('HuK3', 40, 'Caucasian', 'F', '2022-08-30', NULL);
INSERT INTO metadata VALUES ('HuL3', 66, 'Caucasian', 'M', '2022-09-07', NULL);
INSERT INTO metadata VALUES ('HuM3', 52, 'Caucasian', 'M', '2022-10-04', NULL);
INSERT INTO metadata VALUES ('HuN3', 46, 'Caucasian', 'F', '2022-10-13', NULL);
INSERT INTO metadata VALUES ('HuO3', 72, 'Caucasian', 'F', '2022-10-13', NULL);
INSERT INTO metadata VALUES ('HuP3', 21, 'Caucasian', 'M', '2022-10-18', NULL);
INSERT INTO metadata VALUES ('HuQ3', 75, 'Caucasian', 'F', '2022-10-25', NULL);
INSERT INTO metadata VALUES ('HuR3', 62, 'Caucasian', 'F', '2022-11-01', NULL);

/* fill assay table */

INSERT INTO assay VALUES ('AM033a', 'HuF3', '2022-07-29', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033b', 'HuG3', '2022-07-30', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033c', 'HuH3', '2022-08-06', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033d', 'HuI3', '2022-08-12', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033e', 'HuJ3', '2022-08-27', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033f', 'HuK3', '2022-09-02', 'Anna Mahr', 'Anna Mahr', NULL, NULL, 'Maia Bennett', NULL);
INSERT INTO assay VALUES ('AM033g', 'HuL3', '2022-09-10', 'Anna Mahr', 'Anna Mahr', NULL, NULL, NULL, NULL);
INSERT INTO assay VALUES ('AM034a', 'HuM3', '2022-10-07', 'Anna Mahr', 'Anna Mahr', NULL, NULL, NULL, NULL);
INSERT INTO assay VALUES ('AM034b', 'HuP3', '2022-10-21', 'Anna Mahr', 'Anna Mahr', NULL, NULL, NULL, NULL);
INSERT INTO assay VALUES ('AM034c', 'HuR3', '2022-11-04', 'Anna Mahr', 'Anna Mahr', NULL, NULL, NULL, NULL);

/* fill markers table: concatenation of marker + fluor to form markerID will be performed by HMTL input code. */

INSERT INTO markers VALUES ('Lin', 'FITC', 'Lin FITC', NULL, NULL);
INSERT INTO markers VALUES ('NKG2A', 'PE', 'NKG2A PE', NULL, NULL);
INSERT INTO markers VALUES ('7AAD', 'PC5.5', '7AAD PC5.5', NULL, NULL);
INSERT INTO markers VALUES ('CD57', 'PE-Cy7', 'CD57 PE-Cy7', NULL, NULL);
INSERT INTO markers VALUES ('CD56', 'APC', 'CD56 APC', NULL, NULL);
INSERT INTO markers VALUES ('NKG2D', 'APC-A750', 'NKG2D APC-A750', NULL, NULL);
INSERT INTO markers VALUES ('CD16', 'PB450', 'CD16 PB450', NULL, NULL);
INSERT INTO markers VALUES ('NKp46', 'KO525', 'NKp46 KO525', NULL, NULL);

/* fill comp table */

INSERT INTO comp VALUES ('immunoNKcomp', 'immunoNKmatrix', NULL)

/* fill flowpanel table */

INSERT INTO flowpanel VALUES ('immunoNK', 'Lin FITC', 'NKG2A PE', '7AAD PC5.5', 'CD57 PE-Cy7', 'CD56 APC', 'NKG2D APC-A750', 'CD16 PB450', 'NKp46 KO525', 'immunoNKcomp', 'Y', NULL);

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
