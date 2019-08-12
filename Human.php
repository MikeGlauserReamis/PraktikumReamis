<?php
class Human{

    //attributes of the human
    private $lastName;
    private $firstName;
    private $age;
    private $gender;

    //constructor for creating humans
    public function __construct($lastName, $firstName, $age, $gender){

        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->age = $age;
        $this->gender = $gender;

    }

    //returns last name of human
    public function getLastName()
    {
        return $this->lastName;
    }
    
    //sets last name of human to given value
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
    //returns first name of human
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    //sets first name of human 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }


    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

}