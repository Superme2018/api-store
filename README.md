# DUFF, Pending Reomval, intersting code getting moved to fresh project.
# API Store

A simple application code base, to store some remote API data to a local SQLite DB.

## Application Outline

### Commands

``/app/Console/Commands/SyncCareQualityData.php``

* Syncs data with remoteAPI endpoint. Or endpoints. To act as a scheduled task.

### API Endpoints

```/api/record?providerId={provider_id}```

* Used to access data via the provider_id (Currently using a GET parameter, will swap this out later)

```/api-store.local/api/records```  
or  
```/api/records?itemsPerPage=50&pageNumber=5```

* Displays the providers based on itemsPerPage and pageNumber.
* If not both provided, the defaults are itemsPerPage = 15 and pageNumber = 1

### TODOs

* Add in the extra providers data via an eloquent relation (will pull the extra data via the command and hook upto the providerId).
* Some code documentation to follow the application logic.
* Possibly API endpoint documentation using rout based parameters.
