<?php

namespace Models;

/**
 * @property Association[] $associations
 */
class Vehicle
{
    private array $entityContents;
    public string $Make;
    public string $Model;
    public string $Color;
    public int $Year;
    public string $VehicleType;
    public string $PlateNumber;
    public string $State;
    public string $Vin;
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
    public function add_proprties($vehicle)
    {
        $this->Make = $vehicle->Make;
        $this->Model = $vehicle->Model;
        $this->Color = $vehicle->Color;
        $this->Year = $vehicle->Year;
        $this->VehicleType = $vehicle->VehicleType;
        $this->PlateNumber = $vehicle->PlateNumber;
        $this->State = $vehicle->State;
        $this->Vin = $vehicle->Vin;
        $this->EntityId = $vehicle->EntityId;
        $this->Associations = $vehicle->Associations;
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

    public function viaEntityIdFindVehicle(string $id): array
    {
        foreach ($this->entityContents as $object) {
            if ($object['EntityId'] === $id) {
                return $object;
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
