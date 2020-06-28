<?php
namespace App;


class Robot
{
   /**
    * @var Table Table which robot will be placed and moves along
    */
   private Table $table;

   /**
    * @var array|bool[] Current state of robot [x, y, f]
    */
   private array $state = [false, false, false];

   /**
    * @var array|int[] Possible directions with corresponding move instruction [x, y]
    */
   private array $directions = [
      'NORTH' => [0, 1],
      'EAST' => [1, 0],
      'SOUTH' => [0, -1],
      'WEST' => [-1, 0]
   ];


   public function __construct(Table $table)
   {
      $this->table = $table;
   }

   /**
    * Places robot on table
    * @param int $x X Coordinate
    * @param int $y Y Coordinate
    * @param string $f Pointing direction
    * @return bool Was place successful?
    */
   public function place(int $x, int $y, string $f):bool
   {
      // Check position exist on table
      if (! $this->table->isValidPosition($x, $y))
         return false;

      // Check valid direction
      if (! in_array($f, array_keys($this->directions)))
         return false;

      $this->setX($x);
      $this->setY($y);
      $this->setF($f);
      return true;
   }

   /**
    * Moves robot one unit forward
    * @return bool Did robot move?
    */
   public function move():bool
   {
      if (! $this->hasBeenPlaced())
         return false;

      $moveInstruction = $this->directions[$this->getF()];
      $newX = $this->getX() + $moveInstruction[0];
      $newY = $this->getY() + $moveInstruction[1];

      // Check moving to valid position on table
      if (! $this->table->isValidPosition($newX, $newY))
         return false;

      $this->setX($newX);
      $this->setY($newY);
      return true;
   }

   /**
    * Rotates robot counter clockwise
    * @return bool
    */
   public function left():bool
   {
      return $this->rotate(-1);
   }

   /**
    * Rotates robot clockwise
    * @return bool
    */
   public function right():bool
   {
      return $this->rotate(1);
   }

   /**
    * Reports position and pointing direction of robot
    */
   public function report()
   {
      if (! $this->hasBeenPlaced())
         echo "Toy robot hasn't been placed!" . PHP_EOL;
      else
         echo implode(',', $this->state) . PHP_EOL;
   }


   /**
    * Has robot been placed?
    * @return bool
    */
   private function hasBeenPlaced():bool
   {
      return $this->getX() !== false && $this->getY() !== false && $this->getF() !== false;
   }

   /**
    * Rotate robot by $shift amount
    * @param int $shift
    * @return bool
    */
   private function rotate(int $shift):bool
   {
      if (! $this->hasBeenPlaced())
         return false;

      $pointingDirections = array_keys($this->directions);
      $currentIndex = array_search($this->state[2], $pointingDirections);
      $numOfDirections = sizeof($this->directions);

      // Add $numOfDirections to ensure we don't modulo of negative number
      $newIndex = ($currentIndex + $shift + $numOfDirections) % $numOfDirections;

      $this->setF($pointingDirections[$newIndex]);
      return true;
   }

   /**
    * Get X coordinate
    * @return bool|int
    */
   private function getX()
   {
      return $this->state[0];
   }

   /**
    * Set X coordinate
    * @param int $x
    */
   private function setX(int $x)
   {
      $this->state[0] = $x;
   }

   /**
    * Get Y coordinate
    * @return bool|int
    */
   private function getY()
   {
      return $this->state[1];
   }

   /**
    * Set Y coordinate
    * @param $y
    */
   private function setY(int $y)
   {
      $this->state[1] = $y;
   }

   /**
    * Get pointing direction
    * @return bool|mixed
    */
   private function getF()
   {
      return $this->state[2];
   }

   /**
    * Set pointing direction
    * @param string $f
    */
   private function setF(string $f)
   {
      $this->state[2] = $f;
   }
}