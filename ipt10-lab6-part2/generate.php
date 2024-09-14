<?php

require_once 'FileUtility.php';
require_once 'Random.php';

// Create an instance of Random and generate people data
$random = new Random();
$people = $random->generatePeople(300);

// Write data to persons.csv
FileUtility::writeToFile('persons.csv', $people);

echo "300 records generated and saved in persons.csv!";
