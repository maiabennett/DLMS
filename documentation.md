# User Documentation for the Denton Lab Management System (DLMS)
## Adding data to the database
Data entry for the DLMS must follow an order specified by the database schema and subsequent data dependencies. There are three main subdivisions of data storage which correspond to the three user interface pages: member data, flow panel data (markers, compensation, flow panels), and assay data (metadata, assays, and flow files). Member information can be inputted with no data constraints. Marker (conjugated fluorophore) and compensation file data can be inputted with no data constraints. Flow panel data relies on existing marker and compensation data. Donor metadata can be inputted with no data constraints. Assay data relies on existing donor metadata and member information. Flow file data relies on existing assay and flow panel information. Exact specifications for all data entry fields can be found in the 'Data dictionary' section of this document. 

## Editing data in the database

## Data dictionary
### Members

### Markers

### Comp

### Flowpanel

### Metadata

### Assay

### Flowfiles

## Areas for future improvement & expansion
### Improvements
- Alerts for successful or unsuccessful data entry and editing.

### Expansions
- Addition of 'presentations' field to member entities to track co-authorships on oral and poster presentations for member CVs.
- Addition of assay analysis data storage to track killing assay and immunophenotyping results. 
