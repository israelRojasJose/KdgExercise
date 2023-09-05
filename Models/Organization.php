<?php

namespace Models;

/**
 * @property Association[] $associations
 */

 
class Organization
{   
    private array $entityContents;
    public string $Name;
    public string $Type;
    public int $YearStarted;
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
    
    public function searchEntityId(string $name, string $id): array
    {
        $personAssociations = [];

        foreach ($this->entityContents as $object) {
            if ($object['EntityId'] === $id && $object['Name'] === $name) {
                // Append the associations to the $personAssociations array.
                $personAssociations[] = $object;
            }
        }

        return $personAssociations;
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
