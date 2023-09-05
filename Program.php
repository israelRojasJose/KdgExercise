<?php

//Setup code. You may skip over this section and start at the first TODO
require 'vendor/autoload.php';

$dataSources = [
    'Persons' => "./DataSources/Persons_20220824_00.json",
    'Organizations' => "./DataSources/Organizations_20220824_00.json",
    'Vehicles' => "./DataSources/Vehicles_20220824_00.json",
    'Addresses' => "./DataSources/Addresses_20220824_00.json"
];

foreach ($dataSources as $path) {
    if (!file_exists(realpath($path))) {
        throw new Exception('Data source file not found: ' . $path);
    }
}


// namespace Models; imports 
use Models\Address;
use Models\Association;
use Models\Organization;
use Models\Person;
use Models\Vehicle;



class DataValidation
{    
    public $VEHICLES;
    public $PERSONS;
    public $ORGANIZATIONS;
    public $ADDRESSES;
    


    public function __construct(Vehicle $VEHICLE ,Person $PERSON, Organization $ORGANIZATION, Address $ADDRESS,)
    {
        //TODO: Start your exercise here. Do not forget about answering Test #9 (Handled slightly different)
        //Reminder: Collect the data from each file.
        //Hint: You are welcome to use third-party packages.
        // throw new Exception("Get data from files");
        $this->VEHICLES = $VEHICLE;
        $this->PERSONS = $PERSON;
        $this->ORGANIZATIONS = $ORGANIZATION;
        $this->ADDRESSES = $ADDRESS;
    }
    
    // private function objectModel(Vehicle $object): array
    // {   $object = $this->$entityName
    //     $object->add_proprties($object);
    //     return $this->$entityName->getEntityContents();
    // }

    ##Testing Begins here.
    public function validateEntitiesProperty(string $entityName): bool
    {   
        $content = $this->$entityName->getEntityContents();
           // //Test #1: Do all files have entities? (True / False)
      
        if (empty($content)){
            throw new Exception("The property 'entityContents' is in fact empty in the $entityName class.");
        }
        foreach ($content as $object) {
            if (!array_key_exists('EntityId', $object)) {
                return false;
            }
        }
        return true;
    }


    
    public function totalEntityCount(): int
    { //Test #2: What is the total count for all entities?
        $vehicleCount = $this->VEHICLES->entityContentsLenth();
        $personCount = $this->PERSONS->entityContentsLenth();
        $organizationCount = $this->ORGANIZATIONS->entityContentsLenth();
        $addressCount = $this->ADDRESSES->entityContentsLenth();
        $total = $vehicleCount + $personCount + $organizationCount + $addressCount;
        return $total;
    }


    public function countEachType(string $entityName): int
    { // //Test #3: What is the count for each type of Entity? Person, Organization, Vehicle, and Address
        return $this->$entityName->entityContentsLenth();
    }
    

    public function breakdownEntitiesAssociations(string $entityName): int
    { // //Test #4: Provide a breakdown of entities which have associations in the following manner:
        // //         - Per Entity Count
        return $this->$entityName->associationsLenth();
      
    }
    public function TotalEntitiesAssociations(): int
    { //Test #4: Provide a breakdown of entities which have associations in the following manner:
        // - Total Count
        $vehicleCount = $this->VEHICLES->associationsLenth();
        $personCount = $this->PERSONS->associationsLenth();
        $organizationCount = $this->ORGANIZATIONS->associationsLenth();
        $addressCount = $this->ADDRESSES->associationsLenth();
        $total = $vehicleCount + $personCount + $organizationCount + $addressCount;
        return $total;
    }

    public function addressAssociations(string $street): array
    { // //Test #5: Provide the vehicle detail that is associated to the address "4976 Penelope Via South Franztown, NH 71024"?
        // //         StreetAddress: "4976 Penelope Via"
        // //         City: "South Franztown"
        // //         State: "NH"
        // //         ZipCode: "71024"

        $associations =  $this->ADDRESSES->viaAdressFindAssociations($street);
        $vehicle = $this->VEHICLES->viaEntityIdFindVehicle($associations[0]['EntityId']);
    
        return $vehicle;
      
    }

    public function personAssociations(string $org_name): array
    {

        $AssociationsIDs = $this->PERSONS->allPersonsAssociationsIDs();
        foreach ($AssociationsIDs as $personObject) {
            $person = $this->ORGANIZATIONS->searchEntityId($org_name, $personObject['Associations'][0]['EntityId']);
            
            if (!empty($person)) {
                return $personObject;
            }
        }

    return [];
    }   

    public function test_seven(string $arg1,string $arg2){
        // //Test #7: How many people have the same first and middle name?
        return $this->PERSONS->findMatch($arg1,$arg2);
    }


    public function numberEntitesWithB3(string $entity_name ,string $param):int{
        // //Test #8: Provide a breakdown of entities where the EntityId contains "B3" in the following manner:
        // //         - Total count by type of Entity
        // //         - Total count of all entities
        // echo $param;

        return $this->$entity_name->entityIdContains($param);


    }
    public function TotalnumberEntitesWithB3(string $param): int
    { //Test #4: Provide a breakdown of entities which have associations in the following manner:
        // - Total Count
        $vehicleCount = $this->VEHICLES->entityIdContains( $param);
        $personCount = $this->PERSONS->entityIdContains( $param);
        $organizationCount = $this->ORGANIZATIONS->entityIdContains( $param);
        $addressCount = $this->ADDRESSES->entityIdContains( $param);
        $total = $vehicleCount + $personCount + $organizationCount + $addressCount;
        return $total;
    }

}





$DATASOURCEKEYS = array_map('strtoupper', array_keys($dataSources));
// Now $uppercaseKeys contains the uppercase keys in a list

$VEHICLE = new Vehicle($dataSources['Vehicles']); 
$PERSON = new Person($dataSources['Persons']);
$ORGANIZATION = new Organization($dataSources['Organizations']);
$ADDRESS = new Address($dataSources['Addresses']);

echo "\n           DataSources Intalization.\n";
echo "Class objects initialized with file paths to Data Sources.\n";
echo "The contents of each file is stored in the entityContents property of each class.\n";
echo "========================================================\n\n";






$EXERCISE = new DataValidation($VEHICLE,$PERSON,$ORGANIZATION,$ADDRESS);
echo "\n            Coding Exercise Intalization.\n";
echo "\n\n========================================================\n";



###########################################################################
echo "\n\n           Question Number One: ";
echo "\n    Do all files have entities? (True / False)\n\n";
echo "Idea:
 To solve this I choose to check if entityContents property of the class was empty 
or if the objects in the araay did not contain a EntityId key.\n\n";
echo 'What was Done: 
 Using $EXERCISE->validateEntitiesProperty("<Name of entity class>"). 
 first, Check if the entityContents is not empty.
 Last, check if the objects in the array did contain a EntityId key.'
,"\n";

$ENTITIESCHECK = [];
foreach ($DATASOURCEKEYS as $key) {
    $ENTITIESCHECK[$key] = $EXERCISE->validateEntitiesProperty($key);
}
echo "\nAnswer:\n";
var_dump($ENTITIESCHECK);
###########################################################################

echo "\n \n           Question Number Two: ";
echo "\n    What is the total count for all entites.\n\n";
echo "Idea:
 To solve this having a sum function in the Data Validation Class pulling lenth from model classes.\n\n";
echo 'What was Done: 
 Using $$EXERCISE->totalEntityCount(). 
 first, use model entityContentslenth().method to get the lenth of the entityContents property.
 Second,add the property up and retunr the value.
 Last, Print the value.'
,"\n";
$total = $EXERCISE->totalEntityCount();
echo "\nAnswer:
 The total count for all entites is $total.\n\n";



 ###########################################################################

echo "\n\n            Question Number Three: ";
echo "\n    what is the count for each type of Entity? 
        Organization,Vehicle, and Address.\n\n";
echo "Idea:
 To solve this having a similar function in the Data Validation Class pulling lenth from model classes. 
 passing a specific type as an arg.\n\n";
echo 'What was Done: 
 Using $$EXERCISE->countEachType("<$entityName>"). 
 first, pass a type arg.
 Second, use model entityContentslenth().method to get the lenth of the entityContents property.
 Last, Print the value.'
,"\n";
echo "\nAnswer:";
foreach ($DATASOURCEKEYS as $key) {
    $value = $EXERCISE->countEachType($key);
    echo "\n The count for $key is $value.";
}
echo "\n\n";



 ###########################################################################

 echo "\n\n            Question Number Four: ";
 echo "\n    Provide a breakdown of entities
            which have associations in the
            following manor:
            - Per Entity Count
            - Total Count? 
         Organization,Vehicle, and Address.\n\n";
 echo "Idea:
  To solve this having a similar function in the Data Validation Class pulling lenth from model classes. 
  passing a specific type as an arg.\n\n";
 echo 'What was Done: 
  Using $$EXERCISE->breakdownEntitiesAssociations("<$entityName>"). 
  first, pass a type arg.
  Second, use model entityContentslenth().method to get the lenth of the entityContents property.
  Last, Print the value.
  for the Total call the TotalEntitiesAssociations() method. hard coded.'
 ,"\n";
 echo "\nAnswer:";
 foreach ($DATASOURCEKEYS as $key) {
     $value = $EXERCISE->breakdownEntitiesAssociations($key);
     echo "\n The Associations for $key is $value.";
 }
$total = $EXERCISE->TotalEntitiesAssociations();
echo "\n The Total Associations  $total.";
 echo "\n\n";




  ###########################################################################

  echo "\n\n            Question Number Five: ";
  echo "\n   Provide the vehicle detail that is
                    associated to the address '4976'
                    
                    Penelope Via South Franztown,
                    NH 71024'?\n\n";
  echo "Idea:
   passing the values as paramters and using the model find a match in the adress model
   then return the EntityId to find the vehicle.\n\n";
  echo 'What was Done: 
   Using $$EXERCISE->addressAssociations("<$Street_adress>"). 
   first, pass a type arg.
   Second, ADDRESSES->viaAdreeFindAssociations($street) to locate the EntityId.
   Using the EntityId to find the vehicle.'
  ,"\n";
  echo "\nAnswer:";

 $vehicle = $EXERCISE->addressAssociations("4976 Penelope Via");
 echo "\n", var_dump($vehicle),"\n\n";



###########################################################################

echo "\n\n            Question Number Six: ";
echo "\n   What person(s) are associated to
the organization 'thiel and sons'?\n\n";
echo "Idea:
 passing the name as paramters and using the model find a match in the person model
 then return the asscoication array \n\n";
echo 'What was Done: 
 Using $$EXERCISE->personAssociations("<$org_name>"). 
 first,gathering the EntityId of each  personAssociations.
if found a match in the Organization content return the person id that got to it.
 and print the corrct person object. '
,"\n";
echo "\nAnswer:";

$personA = $EXERCISE->personAssociations("thiel and sons");
echo "\n", var_dump($personA),"\n\n";




###########################################################################

echo "\n\n            Question Number Seven: ";
echo "\n   How many people have the same
first and middle name?\n\n";
echo "Idea:
 loop the names and count the first and middle names that match. or two args passed  \n\n";
echo 'What was Done: 
 Using $$EXERCISE->test_seven("<$args>"). 
 first,takig the contents of the file. force to lowercase and count matching values.'
 
,"\n";
echo "\nAnswer:";

$mathcing = $EXERCISE->test_seven("FirstName","MiddleName");
echo "\n", var_dump($mathcing),"\n\n";



###########################################################################

echo "\n\n            Question Number Eight: ";
echo "\n   rovide a breakdown of entities
where the EntityId contains 'B3' in the following manor:
- Total count by type of Entity
- Total count of all entities\n\n";
echo "Idea:
 loop the names and count the first and middle names that match. or two args passed  \n\n";
echo 'What was Done: 
 Using $$EXERCISE->numberEntitesWithB3("<$Model>,"B3"). 
 first,using the model entityIdContains method to get a count of id with the passed param'
 
,"\n";
echo "\nAnswer:";
foreach ($DATASOURCEKEYS as $key) {
    $number = $EXERCISE->numberEntitesWithB3($key,"b3");
    echo "\n The count for $key is $number.";
}



echo "\n\n            Question Number Nine: see file  ./Q9.Txt";




