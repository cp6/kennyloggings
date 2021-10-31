# Kenny Loggings
Simple custom logging class with PHP to store logs all in one place, a database. 

Call custom logging in your projects all into one viewable place for ease of viewing.

## Usage

Install with:

```composer require corbpie/kennyloggings```

Use like:

```php
<?php
require_once('vendor/autoload.php');

//For creating logs
$l = new Corbpie\KennyLoggings\LoggerCreate();

//For viewing logs
$l = new Corbpie\KennyLoggings\LoggerView();
```

**NOTE:** Make sure to edit your project name and log database details in ```src/LoggerConfig.php```


## Calls

Create a log

```php
$l->doALog(1, 'exampleLog', 'This is just an example success call');
```
