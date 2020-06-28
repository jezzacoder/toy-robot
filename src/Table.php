<?php
namespace App;


class Table
{
   /**
    * @var int Limit for x
    */
   private int $xLimit;

   /**
    * @var int Limit for y
    */
   private int $yLimit;

   /**
    * Table constructor.
    * @param int $xLimit
    * @param int $yLimit
    */
   public function __construct(int $xLimit, int $yLimit)
   {
      $this->xLimit = $xLimit;
      $this->yLimit = $yLimit;
   }

   /**
    * Validates specified coordinates exist on table
    * @param int $x
    * @param int $y
    * @return bool
    */
   public function isValidPosition(int $x, int $y):bool
   {
      return $this->isValid($x, $this->xLimit) && $this->isValid($y, $this->yLimit);
   }


   /**
    * Validate a point is within allowable range
    * @param int $point
    * @param int $limit
    * @return bool
    */
   private function isValid(int $point, int $limit):bool
   {
      if ($point < 0)
         return false;

      if ($point > $limit)
         return false;

      return true;
   }
}