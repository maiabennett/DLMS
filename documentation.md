# User Documentation for the Denton Lab Management System (DLMS)
## Adding data to the database
Data entry for the DLMS must follow an order specified by the database schema and subsequent data dependencies. There are three main subdivisions of data storage which correspond to the three user interface pages: member data, flow panel data (markers, compensation, flow panels), and assay data (metadata, assays, and flow files). Member information can be inputted with no data constraints. Marker (conjugated fluorophore) and compensation file data can be inputted with no data constraints. Flow panel data relies on existing marker and compensation data. Donor metadata can be inputted with no data constraints. Assay data relies on existing donor metadata and member information. Flow file data relies on existing assay and flow panel information. Exact specifications for all data entry fields can be found in the 'Data dictionary' section of this document. Notably, this system currently stores pointers to existing flow cytometry and compensation files located on the Denton Lab OneDrive: this will ideally be updated as detailed in the 'Areas for improvement & expansion' section of this document. 

## Editing data in the database
Editing data in the DLMS also follows specific data constraints. Many data entry fields display the current contents of specific DLMS, such as lab member names and existing assay and flow panel IDs. As such, changing data with existing database contents (ex., changing the lead lab member on an assay from Maia to Anna) is easily processed. Additionally, changing fields which are not used as references in other tables (ex., file locations, lab member join and graduation dates) is easily processed. Changing primary key information within the database (ex., changing an existing member name or a flow panel ID) will require adaptation on the back end (MySQL) to avoid data inconsistencies or relational schema failures. 

## Data dictionary
- <ins>primary key</ins>: The key value for any given table, i.e., the value(s) which are used to distinguish unique entries from each other during data search or recall. Each table must have at least one primary key, and each primary key value (or combination of values) must be unique; failure to establish a unique primary key value will result in a failure of data entry or modification. All primary keys are required to submit or update a data entry, and all other required fields are indicated in their definitions. 

### Members
- <ins>name</ins> (primary key): The name (first and last) of a Denton Lab member. This field is inputted as a string constrained to 50 characters (including spaces). This cannot be adjusted once entered unless accessed from the back end and is particularly difficult to adjust once the member has been selected as an assay participant, so spell carefully. 
- joined: The date upon which the indicated member joined the Denton Lab. This field is inputted using a responsive calendar and can be easily adjusted at any time.
- grad: The date upon which the indicated member graduates from the Denton Lab. This field is inputted using a responsive calendar and can be easily adjusted at any time. 
- project: The project(s) with which the indicated member is involved. This field is inputted as a string constrained to 50 characters (including spaces). Multiple comma-separated projects may be entered and can be adjusted at any time; however, updating will overwrite the previous field contents, so ensure all information is entered in full.

### Markers
- <ins>markerID</ins> (primary key): The full, unique name of the conjugated fluorophore (ex., CD57 PE-Cy7). To ensure consistency and accuracy of the data, this field is not directly inputted by a DLMS user; instead, the field is constructed by the database using the 'marker' and 'fluor' fields. This cannot be adjusted once entered unless accessed from the back end. 
- marker: The name of the marker to which a fluorophore has been conjugated (ex., CD57). This field is inputted as a string constrained to 6 characters. This cannot be adjusted once entered unless accessed from the back end, so spell carefully. This field is required. 
- fluor: The name of the fluorophore to which a marker has been conjugated (ex., PE-Cy7). This field is inputted as a string constrained to 20 characters. This cannot be adjusted once entered unless accessed from the back end, so spell carefully. This field is required. 
- catID: The catalog information associated with the indicated conjugated fluorophore. This field is inputted as a string constrained to 50 characters and can be easily adjusted at any time. 
- gene_product: The gene product associated with the indicated marker, included to increase the available information of a conjugated fluorophore for publication reference. This field is inputted as a string constrained to 10 characters and can be easily adjusted at any time. 

### Comp
- <ins>compID</ins> (primary key): The unique identifier for a compensation matrix (ex., immunoNKcomp), ideally corresponding in name to its associated flow panel (ex., immunoNK). This field is inputted as a string constrained to 14 characters. This cannot be adjusted once entered unless accessed from the back end, so spell carefully.
- matrix: The file name of the compensation matrix (typically, with a .mtx file format). This field is inputted as a string constrained to 20 characters and can be easily adjusted at any time. This field is required. 
- path: The current file path of the compensation matrix in the Denton Lab OneDrive. This field is inputted as a string constrained to 300 characters and can be easily adjusted at any time. The easiest way to locate and input a file path is to locate the compensation file, right click, and select 'Copy as path', removing the file name itself before submitting. NOTE: All paths must be entered using forward slashes (/.../...) or data input and update attempts will fail due to MySQL syntax requirements.

### Flowpanel
- <ins>FLID</ins> (primary key): The unique identifier for a flow panel (ex., immunoNK), ideally corresponding in name to its associated compensation file (ex., immunoNKcomp). This field is inputted as a string constrained to 10 characters. This cannot be adjusted once entered unless accessed from the back end, so spell carefully.
- FL1: The name of the conjugated fluorophore designated as FL1 by the flow cytometer. This field is inputted by selecting an existing markerID from a dropdown of all existing markerIDs in the the DLMS. The easiest way to locate the FL1-8 assignments is to access the flow panel's applied compensation in FlowJo, where it will display each fluorophore alongside its FL designation. This field is required.
- FL2: The name of the conjugated fluorophore designated as FL2 by the flow cytometer. This field is inputted by selecting an existing markerID from a dropdown of all existing markerIDs in the the DLMS. This field is required.
- FL3-8: The name of the conjugated fluorophores designated as FL3-8 by the flow cytometer. This field is inputted by selecting an existing markerID from a dropdown of all existing markerIDs in the the DLMS. These fields are optional depending on the number of fluorophores assessed by the indicated panel.
- compID: The unique identifier for the associated compensation file. This field is inputted by selecting an existing compID from a dropdown of all existing compIDs in the the DLMS and can be easily adjusted (in terms of panel association, not in terms of the comp table entry) at any time. This field is required. 
- current: The indicator for whether the panel is currently used or if a more updated panel exists. This field is inputted by selecting 'Y' or 'N' from a dropdown and can be easily adjusted at any time. 
- comments: Any relevant comments for the indicated panel. This field is inputted as a string constrained to 200 characters and can be easily adjusted at any time. 

### Metadata
- <ins>donorID</ins> (primary key): The unique identifier for a human donor (ex., HuA1) which is assigned in ascending alphabetical (A-Z) and numerical (1-26) order. This field is inputted as a string constrained to 5 characters. This cannot be adjusted once entered unless accessed from the back end, so spell carefully.
- age: The age of the human donor as detailed by the American Red Cross documentation. This field is inputted as an integer and can be easily adjusted at any time. 
- ethnicity: The race/ethnicity of the human donor as detailed by the American Red Cross documentation. This field is inputted as a string constrained to 20 characters and can be easily adjusted at any time. 
- sex: The sex of the human donor as detailed by the American Red Cross documentation. This field is inputted by selecting 'M' or 'F' from a dropdown and can be easily adjusted at any time. 
- collected: The date upon which the human donor blood product was received and processed. This field is inputted using a responsive calendar and can be easily adjusted at any time.
- comments: Any relevant comments for the indicated human donor. This field is inputted as a string constrained to 300 characters and can be easily adjusted at any time. 

### Assay
- <ins>assayID</ins> (primary key): The unique identifier for an assay (ex., AM033a) which is assigned using the lead researcher's initials (AM), the assay number (33) and an optional assay run qualifier (a). This field is inputted as a string constrained to 6 characters. This cannot be adjusted once entered unless accessed from the back end, so spell carefully.
- donorID: The unique identifier for the human donor used in the indicated assay. This field is inputted by selecting an existing donorID from a dropdown of all existing donorIDs in the the DLMS and can be easily adjusted (in terms of assay association, not in terms of the metadata table entry) at any time. This field is required.
- run: The date upon which the assay was run. This field is inputted using a responsive calendar and can be easily adjusted at any time.
- lead: The lead researcher for the indicated assay. This field is inputted by selecting an existing mamber names from a dropdown of all existing member names in the the DLMS and can be easily adjusted (in terms of assay association, not in terms of the member table entry) at any time.
- magnet: The researcher in charge of NK cell magnetic enrichment for the indicated assay. This field is inputted by selecting an existing mamber names from a dropdown of all existing member names in the the DLMS and can be easily adjusted (in terms of assay association, not in terms of the member table entry) at any time.
- targets: The researcher in charge of target cell staining for the indicated assay. This field is inputted by selecting an existing mamber names from a dropdown of all existing member names in the the DLMS and can be easily adjusted (in terms of assay association, not in terms of the member table entry) at any time.
- staining: The researcher in charge of flow panel staining for the indicated assay. This field is inputted by selecting an existing mamber names from a dropdown of all existing member names in the the DLMS and can be easily adjusted (in terms of assay association, not in terms of the member table entry) at any time.
- flow: The researcher in charge of flow cytometric data collection and analysis for the indicated assay. This field is inputted by selecting an existing mamber names from a dropdown of all existing member names in the the DLMS and can be easily adjusted (in terms of assay association, not in terms of the member table entry) at any time.
- comments: Any relevant comments for the indicated assay. This field is inputted as a string constrained to 300 characters and can be easily adjusted at any time. 

### Flowfiles
- <ins>assayID</ins> (primary key): The unique identifier for the assay during which the flow cytometry file's data was collected. This field is inputted by selecting an existing assayID from a dropdown of all existing assayIDs in the the DLMS and cannot be adjusted once entered unless accessed from the back end, so select carefully.
- <ins>filename</ins> (primary key): The name of a flow cytometry file (ex., NK unstim.fcs) which is assigned using the contents of the data (NK) and the condition tested (unstim), as well as the flow cytometry standard file type extension (.fcs). This file name is likely not unique, which is why the filename and assayID are taken in  combination for the table's primary key. This field is inputted as a string constrained to 100 characters and can be easily adjusted at any time. 
- ODpath: The current file path of the flow cytometry file in the Denton Lab OneDrive. This field is inputted as a string constrained to 300 characters and can be easily adjusted at any time. The easiest way to locate and input a file path is to locate the flow cytometry file, right click, and select 'Copy as path', removing the file name itself before submitting. NOTE: All paths must be entered using forward slashes (/.../...) or data input and update attempts will fail due to MySQL syntax requirements.
- newpath: This field is currently **not** used in the DLMS implementation. It is a placeholder for the eventual implementation of a file upload function, in which it will contain the new path for the uploaded flow cytometry file. 
- FLID: The unique identifier for the flow panel used to collect the flow cytometry file data. This field is inputted by selecting an existing FLID from a dropdown of all existing FLIDs in the the DLMS and can be easily adjusted (in terms of panel association, not in terms of the flowpanel table entry) at any time. This field is required. 

## Function list
### Member data functions
- addMember: Adds a new Denton Lab member. 
- editMember: Edits the information associated with an existing Denton Lab member.
- printMember: Prints all information associated with the indicated existing Denton Lab member, including their member information (join and graduation date, project associations) and all existing assay contributions. Alternatively, prints all members associated with the indicated Denton Lab project(s).

### Flow panel data functions
- addComp: Adds a new compensation matrix. 
- editComp: Edits the information associated with an existing compensation matrix. 
- addMarker: Adds a new conjugated fluorophore. 
- editMarker: Edits the information associated with an existing conjugated fluorophore.
- addPanel: Adds a new flow cytometry panel.
- editPanel: Edits the information associated with an existing flow cytometry panel.
- printPanel: Prints all information associated with the indicated existing flow cytometry panel, including its panel information (name, associated compensation matrix, whether it is currently used, any associated comments) and information on all of its component conjugated fluorophores (marker, fluorophore, catalog information, gene product) in table format. 

### Assay data functions
- addDonor: Adds a new human donor. 
- editDonor: Edits the information associated with an existing human donor. 
- addAssay: Adds a new Denton Lab assay.
- editAssay: Edits the information associated with an existing Denton Lab assay.
- addFile: Adds a new flow cytometry file.
- editFile: Edits the information associated with an existing flow cytometry file.
- printFlow: Prints all information associated with the selected field. Selecting by assay ID prints all information for the indicated assay (assay ID, donor ID, run date, member contributions by their specific roles, comments) and all conditions known to be tested in the indicated assay (retrived using the flow files associated with the assay). Selecting by donor ID prints all information for the indicated donor (donor ID, age, ethnicity, sex, collection date, any associated comments) and all assays associated with the indicated donor. Selecting by file name prints select information (assay ID, donor ID, run date, comments) for each assay associated with files of that name. Selecting by condition tested prints select information (assay ID, donor ID, run date, comments) for each assay testing the indicated condition. Selecting by flow panel ID prints select information (assay ID, donor ID, run date, comments) for each assay which used the indicated flow panel. 

## Areas for future improvement & expansion
### Improvements
- Alerts for successful or unsuccessful data entry and editing.
- Full implementation of the planned file management within the lab computer. This entails:
    * Upload file php function
    * Subsequent utilization of the 'newpath' parameter for flow files
    * Addition of a 'newpath' parameter for compensation files
- Handling member projects as comma-separated lists (or any other method by which projects can be appended); currently, projects must be added one after another as a single string, as editing this field replaces all previously entered data. Searching for projects is not necessarily subject to change, as the function already utilizes pattern matching rather than exact string matching.
- Handling multiple markers (and catalog numbers) associated with the Lineage (Lin FITC) conjugated fluorophore set. 
- Handling multiple human donors associated with a single assay.
- General improvement of code, including the elimination of code redundancies and increased code annotation.

### Expansions
- Addition of 'presentations' field to member entities to track co-authorships on oral and poster presentations for member CVs.
- Addition of assay analysis data storage to track killing assay and immunophenotyping results. 
- Addition of 'project' field to assays to facilitate association of specific assays with member projects.
