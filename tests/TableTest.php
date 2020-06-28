<?php

use App\Table;
use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{
   private Table $table;

   public function setUp():void
   {
      $this->table = new Table(5, 5);
   }

   /**
    * @dataProvider validPositionsProvider
    */
   public function testValidIsValidPosition($x, $y)
   {
      $this->assertTrue($this->table->isValidPosition($x, $y));
   }

   /**
    * @dataProvider invalidPositionsProvider
    */
   public function testInvalidIsValidPosition($x, $y)
   {
      $this->assertFalse($this->table->isValidPosition($x, $y));
   }


   public function validPositionsProvider()
   {
      return [
         [0, 0],
         [0, 1],
         [5, 0],
         [5, 5],
         [2, 3],
         [4, 0]
      ];
   }

   public function invalidPositionsProvider()
   {
      return [
         [-1, 0],
         [0, -1],
         [6, 5],
         [5, 6],
         [-12, 3],
         [4, 23]
      ];
   }
}
