<?php

use App\Program;
use App\Robot;
use App\Table;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
   private Robot $robot;

   public function setUp():void
   {
      // Mock dependencies
      $table = $this->getMockBuilder(Table::class)
         ->setConstructorArgs([10, 10])
         ->getMock();
      $this->robot = $this->getMockBuilder(Robot::class)
         ->setConstructorArgs([$table])
         ->getMock();
   }

   public function testRunningFile()
   {
      $this->robot->expects($this->once())
         ->method('place');
      $this->robot->expects($this->once())
         ->method('report');

      $program = new Program($this->robot);
      $program->run(__DIR__ . DIRECTORY_SEPARATOR . 'testInstructions.txt');
   }

   public function testRunningInvalidCommandsFile()
   {
      $this->robot->expects($this->never())
         ->method('place');
      $this->robot->expects($this->never())
         ->method('move');
      $this->robot->expects($this->never())
         ->method('left');
      $this->robot->expects($this->never())
         ->method('right');
      $this->robot->expects($this->never())
         ->method('report');

      $program = new Program($this->robot);
      $program->run(__DIR__ . DIRECTORY_SEPARATOR . 'testInvalidCommands.txt');
   }

   public function testRunningWithNonExistingFile()
   {
      $this->expectException(\Error::class);

      $program = new Program($this->robot);
      $program->run('nonexisting-file.txt');
   }
}
