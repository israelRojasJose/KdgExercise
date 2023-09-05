<?php

namespace Models;

use DateTime;

/**
 * @property Association[] $Associations
 */
class Person {
    private array $entityContents;
    public string $FirstName;
    public string $LastName;
    public string $MiddleName;
    public DateTime|null $DateOfBirth;
    public string $EntityId;
    public array $Associations;
    public function __construct($filelocation)
    {  
        $json = file_get_contents($filelocation);
        $data= json_decode($json, true);
        $this->entityContents = $data;
    }

    public function getEntityContents(): array
    {
        return $this->entityContents;
    }
    public function entityContentsLenth(): int
    {
        return count($this->entityContents);
    }
    public function countAssociations(): int
    {
        return count($this->Associations);


    }
    public  function associationsLenth(): int
    {
      $count = 0;

      foreach ($this->entityContents as $object) {
          if (array_key_exists('Associations', $object) && !empty($object['Associations'])) {
              $count++;
          }
      }
      return $count;
      
    }
   
    public function allPersonsAssociationsIDs(): array
    {
      $valid_associations = [];

      foreach ($this->entityContents as $object) {
          if (array_key_exists('Associations', $object) && !empty($object['Associations'])) {
            $valid_associations[] = $object; // Append the object to the array.
          }
      }
      return $valid_associations;
      
    }

    public function viaAdressFindAssociations(string $name): array
    {
        foreach ($this->entityContents as $object) {
            if ($object['StreetAddress'] === $name) {
                return $object['Associations'];
            }
        }
        return [];
    }

    public function findMatch(string $arg1, string $arg2)
{
    $count = 0;

    foreach ($this->entityContents as $object) {
        $value1 = strtolower($object[$arg1]); // Convert $arg1 value to lowercase
        $value2 = strtolower($object[$arg2]); // Convert $arg2 value to lowercase
        
        if ($value1 === $value2) { // Compare the lowercase values
            $count++;
        }
    }

    return $count;
}
public function entityIdContains(string $param): int
{
    $matchingObjects = [];

    foreach ($this->entityContents as $object) {
        if (strpos($object['EntityId'], $param) !== false) {
            $matchingObjects[] = $object;
        }
    }

    return count($matchingObjects);
}


}
