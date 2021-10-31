<?php
require_once('vendor/autoload.php');

$l = new Corbpie\KennyLoggings\LoggerView();

//Example logging:

$l->doALog(1, 'exampleLog', 'This is just an example success call');

$l->doALog(2, 'exampleLog', 'This is just an example notice call');

$l->doALog(3, 'exampleLog', 'This is just an example warning call');

$l->doALog(4, 'exampleLog', 'This is just an example danger call');

$l->doALog(5, 'exampleLog', 'This is just an example fail call');


//Example fetching stored logs:

$l->selectAllRecentLogsForProject();//Most recent 50 logs for project

$l->selectRecentLogsForProjectByLogType(5);//Most recent 50 logs for project with type 5 (fails)

$l->selectRecentLogsForProjectByTaskType('exampleLog');//Most recent 50 logs for project with the task 'exampleLog'