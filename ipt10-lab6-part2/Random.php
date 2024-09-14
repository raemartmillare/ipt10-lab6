<?php

require_once 'vendor/autoload.php'; // Ensure composer is used to autoload FakerPHP

class Random
{
    private $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create('en_PH'); // Use the Philippine locale
    }

    public function generatePeople($count = 300)
    {
        $people = [];
        
        for ($i = 0; $i < $count; $i++) {
            $person = [
                'UUID' => $this->faker->uuid(),
                'Title' => $this->faker->title(),
                'First Name' => $this->faker->firstName(),
                'Last Name' => $this->faker->lastName(),
                'Street Address' => $this->faker->streetAddress(),
                'Barangay' => $this->faker->secondaryAddress(),
                'Municipality' => $this->faker->city(),
                'Province' => $this->faker->state(),
                'Country' => 'Philippines',
                'Phone Number' => $this->faker->phoneNumber(),
                'Mobile Number' => $this->faker->mobileNumber(),
                'Company Name' => $this->faker->company(),
                'Company Website' => $this->faker->url(),
                'Job Title' => $this->faker->jobTitle(),
                'Favorite Color' => $this->faker->safeColorName(),
                'Birthdate' => $this->faker->date(),
                'Email Address' => $this->faker->email(),
                'Password' => $this->faker->password()
            ];

            $people[] = $person;
        }

        return $people;
    }
}
