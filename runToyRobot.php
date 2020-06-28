<?php

use App\Program;
use App\Robot;
use App\Table;

require_once 'vendor/autoload.php';

if (! isset($argv[1]))
{
   echo 'Usage: php runToyRobot.php <filename>' . PHP_EOL . PHP_EOL;
   echo ' <filename> File location containing instructions for toy robot' . PHP_EOL;

   exit(0);
}


try {
   // Create a table 5 x 5
   $table = new Table(5, 5);

   $program = new Program(new Robot($table));
   $program->run($argv[1]);
}
catch (\Throwable $e) {
   echo $e->getMessage() . PHP_EOL;
   exit(1);
}
