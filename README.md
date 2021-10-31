# Kenny Loggings

Simple custom logging class with PHP to store logs all in one place, a database.

Call custom logging in your projects all into one viewable place for ease of viewing.

![alt text](https://github.com/cp6/kennyloggings/KennyLoggingsDiagram.jpg "KennyLoggings diagram")

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

Run ```kennyloggings.sql``` on your MySQL server.

## Creating logs

By default, the logging timezone is UTC if you want to change this line 13 of ```src/LoggerCreate.php```.

The function to create a log:

```php
doALog(int $log_status, string $task_name, string $message);
```

```$log_status``` is the log status type (see table below).

```$task_name``` the task/call/method being logged.

```$message``` the message to log.

Example usage:

```php
$l->doALog(1, 'exampleLog', 'This is just an example success call');

$l->doALog(3, 'exampleLog', 'This is just an example warning call');
```

Default log status types

| status | type |
| --- |:---:|
| 1 | success
| 2 | notice
| 3 | warning
| 4 | danger
| 5 | fail

Create your own status type:

```php
$l->insertStatusType('status');//Will status id (incremental)
```

## Fetching logs

**Notice:** All log selecting/fetching returns an array

Fetch all logs from project ordered most recent and a limit of 50

```php
$l->selectAllRecentLogsForProject();
```

Fetch all logs from project with status of 5, ordered most recent and a limit of 50

```php
$l->selectRecentLogsForProjectByLogType(5);
```

Fetch all logs from project with the 'exampleLog' task, ordered most recent and a limit of 50

```php
$l->selectRecentLogsForProjectByTaskType('exampleLog');
```

Fetch projects

```php
$l->selectProjects();
```

Fetch log status types

```php
$l->selectLogTypes();
```

Fetch log tasks

```php
$l->selectTasks();
```