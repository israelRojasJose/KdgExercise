<?php

namespace Models;

/**
 * @property Association[] $Associations
 */
class Address {
    private array $entityContents;
    public string $StreetAddress;
    public string $City;
    public string $State;
    public string $ZipCode;
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
    public function  add_proprties($adress)
    {
        $this->StreetAddress = $adress->StreetAddress;
        $this->City = $adress->City;
        $this->State = $adress->State;
        $this->ZipCode = $adress->ZipCode;
        $this->EntityId = $adress->EntityId;
        $this->Associations = $adress->Associations;

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