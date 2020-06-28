<?php
namespace App;


class Program
{
   private Robot $robot;

   public function __construct(Robot $robot)
   {
      $this->robot = $robot;
   }

   /**
    * Run instructions within a file
    * @param string $instructionFile
    */
   public function run(string $instructionFile)
   {
      if (! is_file($instructionFile))
         throw new \Error('Unable to access instruction file');

      $lines = file($instructionFile);
      foreach ($lines as $instruction)
      {
         [$command, $parameters] = $this->parseInstruction(trim($instruction));

         $this->runCommand($command, $parameters);
      }
   }

   /**
    * Parses an instruction to return a command and parameters (if any)
    * @param string $instruction
    * @return array
    */
   private function parseInstruction(string $instruction):array
   {
      $splitResult = explode(' ', $instruction, 2);

      $command = $splitResult[0] ?? '';
      $parameters = false;
      if (isset($splitResult[1]))
         $parameters = explode(',', $splitResult[1]);

      return [$command, $parameters];
   }

   /**
    * Runs a command
    * @param string $command
    * @param bool $parameters
    */
   private function runCommand(string $command, $parameters = false)
   {
      // Quietly ignore invalid commands
      if (! method_exists($this->robot, $command))
         return;

      if ($parameters !== false)
         $this->robot->$command(...$parameters);
      else
         $this->robot->$command();
   }
}