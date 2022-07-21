# API Store

A simple application code base to store some remote API data to a local SQLite DB.

## Application structure

### Commands

``/app/Console/Commands/SyncCareQualityData.php``

* Syncs data with remoteAPI endpoint. Or endpoints.

### API Endpoints

```/api/record?providerId={provider_id}```

* Used to access data via the provider_id (Currently using a GET parameter, will swap this out later)

```/api-store.local/api/records```  
or  
```/api/records?itemsPerPage=50&pageNumber=5```

* Displays the providers based on itemsPerPage and pageNumber.
* If not both provided, the defaults are itemsPerPage = 15 and pageNumber = 1
