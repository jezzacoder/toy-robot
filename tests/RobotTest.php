<?php

use App\Robot;
use App\Table;
use PHPUnit\Framework\TestCase;

class RobotTest extends TestCase
{
   private Robot $robot;

   public function setUp(): void
   {
      $this->robot = new Robot(new Table(5, 5));
   }

   public function testCorrectPlacement()
   {
      $this->expectOutputString('3,4,NORTH' . PHP_EOL);

      $this->assertTrue($this->robot->place(3, 4, 'NORTH'));
      $this->robot->report();
   }

   public function testInvalidPlacement()
   {
      $this->expectOutputString("Toy robot hasn't been placed!" . PHP_EOL);

      $this->assertFalse($this->robot->place(3, 19, 'NORTH'));
      $this->robot->report();
   }

   public function testInvalidDirection()
   {
      $this->expectOutputString("Toy robot hasn't been placed!" . PHP_EOL);

      $this->assertFalse($this->robot->place(3, 0, 'UPSIDE-DOWN'));
      $this->robot->report();
   }

   public function testSuccessfulPlacementAndMove()
   {
      $this->expectOutputString('0,1,NORTH' . PHP_EOL);

      $this->assertTrue($this->robot->place(0, 0, 'NORTH'));
      $this->assertTrue($this->robot->move());
      $this->robot->report();
   }

   public function testSuccessfulPlacementAndLeft()
   {
      $this->expectOutputString('0,0,WEST' . PHP_EOL);

      $this->assertTrue($this->robot->place(0, 0, 'NORTH'));
      $this->assertTrue($this->robot->left());
      $this->robot->report();
   }

   public function testSuccessfulPlacementAndRight()
   {
      $this->expectOutputString('0,0,EAST' . PHP_EOL);

      $this->assertTrue($this->robot->place(0, 0, 'NORTH'));
      $this->assertTrue($this->robot->right());
      $this->robot->report();
   }

   public function testSuccessfulPlacementThenMoveInCircle()
   {
      $this->expectOutputString('1,3,WEST' . PHP_EOL . '2,2,EAST' . PHP_EOL);

      $this->assertTrue($this->robot->place(2, 2, 'NORTH'));
      $this->assertTrue($this->robot->move());
      $this->assertTrue($this->robot->left());
      $this->assertTrue($this->robot->move());
      // This make sure it is moving during test
      $this->robot->report();

      $this->assertTrue($this->robot->left());
      $this->assertTrue($this->robot->move());
      $this->assertTrue($this->robot->left());
      $this->assertTrue($this->robot->move());
      $this->robot->report();
   }

   public function testReportWithoutPlacement()
   {
      $this->expectOutputString("Toy robot hasn't been placed!" . PHP_EOL);

      $this->robot->report();
   }

   public function testMovingWithoutPlacement()
   {
      $this->expectOutputString("Toy robot hasn't been placed!" . PHP_EOL);

      $this->assertFalse($this->robot->move());
      $this->assertFalse($this->robot->left());
      $this->assertFalse($this->robot->right());
      $this->robot->report();
   }

   public function testCantMoveOffTable()
   {
      $this->expectOutputString('0,2,WEST' . PHP_EOL);

      $this->assertTrue($this->robot->place(0, 2, 'WEST'));
      $this->assertFalse($this->robot->move());
      $this->robot->report();
   }
}
