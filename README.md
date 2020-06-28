Toy Robot Simulator
===================

This is a PHP CLI application which simulates a toy robot moving along a table.

Usage
-----
`php runToyRobot.php <instruction file>`

**instruction file** is a text file containing commands to toy robot

Sample Data
-----------
Sample data has been provided in `data` directory.
* containsInvalidCommand.txt - Contains an invalid command `DANCE` which is ignored
* correctPlacement.txt - Has valid placement command and reports position
* moveCornerToCorner.txt - Places robot in the southwest corner and sends commands to 
move to the northeast corner
* tryToDestroyRobot.txt - Has evil intentions to destroy the robot! (but fails) 
