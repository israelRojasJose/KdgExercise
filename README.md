You will need to have PHP 8.2 and Composer 2 (https://getcomposer.org) installed locally. After they are installed:
* Run `composer install` to enable autoloading
* Run `php program.php` to execute the program



Coding Exercise
Introduction
This is an exercise that tests your ability/knowledge with serialized data,
collections, data associations, data modeling, type casting, and several other
aspects of OOP/PHP. Please review the section as well as the instructions below
for how to present answers to each of the questions outlined.

Setup Instructions
For this exercise, we do not have any requirements on which IDE you use. After
unzipping the files, you will find the project starting point in
“.\PHP\Program.php”. In the same folder, there is a README.md file which
contains further instructions.
Once you are finished, please commit the project to your own personal public
repository (Recommended: GitHub which is free) and send an email to your
interviewers with the url to that repository.
For tests 1 – 8, create a workflow which will output answers to the following
details:
1. Output results with echo in Program.php
2. Include at the question # and the answer at a minimum.
3. NOTE: We will provide answers next to each most questions as a guide, but
your answer should be programmatically determined in your work.
For test 9, this will test your abilities for identifying anti-patterns in object
modelling and how to improve them.
If you have any questions about the instructions, please feel free to contact your
interviewers.
Terms


“Data Source”: Generically identified as a location where data can be pulled from.
In this example, the data will be provided in a file. Do not assume that this
represents a database.
“Entity”: A term used to describe each of the major types in the object model:
Person, Vehicle, Organization, and Address.

Page 1 of 3Coding Exercise

Background
A small “data source” was created that includes the following types: Person,
Organization, Vehicle, and Address. Each of these types are called an “Entity”.
Each Entity has a way to associate itself to another Entity by using the type
“Association”. A property called “Associations” can be found in each Entity which
collects those associations. It’s important to note that some of the Entities will
include an association while others do not.
In the exercise below, you will need to complete 9 tests. The answers for tests 1 –
8 will need to be written out programmatically while test 9 will require a slightly
different response.
The data files are located in the “DataSources” directory from the project
directory. Each file includes a collection of a specific type. Here is a breakdown of
file to type:
1. Address: Addresses_20220824_00.json
2. Organization: Organizations_20220824_00.json
3. Person: Persons_20220824_00.json
4. Vehicle: Vehicles_20220824_00.json
NOTE: This exercise will require your sample program to programmatically read
the data in each of these files.
The tests are included on the next page.







Coding Exercise
Number Test
1 Do all files have entities?
What is the total count for all
2
entities?
What is the count for each type of
3 Entity? Person, Organization,
Vehicle, and Address
Provide a breakdown of entities
which have associations in the
4 following manor:
- Per Entity Count
- Total Count
Provide the vehicle detail that is
associated to the address "4976
5
Penelope Via South Franztown,
NH 71024"?
TRUE
418
Person: 100
Organization: 106
Vehicle: 103
Address: 109
- Per Entity Count:
Person: 5
Organization: 5
Vehicle: 5
Address: 5
- Total Count: 20
Id: bf897e8d-ca66-4930-9529-
0fe0bb57dc86
Make: BMW
Model: Explorer
Year: 2022
Plate: h5hg0y8
State: <null>
Vin: XG2R2OM1XHUO24562
6What person(s) are associated to
the organization "thiel and sons"?None
7How many people have the same
first and middle name?94
Provide a breakdown of entities
where the EntityId contains "B3"
8 in the following manor:
- Total count by type of Entity
- Total count of all entities
9
What improvements would you
make to the object model to
improve your overall workflow
without impacting the structure in
the json?
Disclaimer: There are instances
where we will not have the ability
to change the data structure
coming our way.
Page 3 of 3
Answer
Person: 16
Vehicle: 12
Organization: 7
Address: 13
Answer will not be provided for this
question. Please provide a written
response to the interviewers on any
changes (if any).
Note: Feel free to change/improve the
object model provided if you feel it will
improve your workflow. Reminder: The.

only constraint is changes cannot
require the data in the .json files to
change (i.e. The files located in the
DataSources directory).