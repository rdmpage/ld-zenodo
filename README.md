# ld-zenodo

Linked data export of data in Zenodo. 

Uses ld-template files to fetch individual records in JSON-LD, and convert to N-tripes for bulk import into a tripe store.

The file `harvest-ids/harvest_ids.php` calls Zenodo’s OAI-PMH endpoint http://zenodo.org/oai2d and gets the identifier for each record in the **user-biosyslit** set, outputting one per line, with random pauses every 10 records to give the server a breather. The responses of the OAI-PMH endpoint are cached in the folder **cache**. The list of identifiers can be input into the `fetch.php` script to fetch and process the RDF.


## Zenodo linked data issues

Some fields can have empty strings, e.g. https://zenodo.org/record/3995027 has 

```
"license": "", 
```

Which breaks conversion to N-triples.
