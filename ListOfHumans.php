<?php

require_once('Human.php');

class ListOfHumans{


    //attributes of the list
    private $humans = array();

    //default constructor
    public function __construct()
    {


    }

    //returns the list
    public function getHumans()
    {
        return $this->humans;
    }

    //sets the list to given state
    public function setHumans($humans)
    {
        $this->humans = $humans;
    }

    //adds given human to the list
    public function addHuman($human){

        $this->humans[] = $human;
    }

    //removes human at target index from the list and reorders the list to close the resulting gap
    public function removeHuman($index){

        unset($this->humans[$index]);
        $this->setHumans(array_values($this->humans));
    }

    //overrides human at target index with given human
    public function alterHuman($index, $human)
    {
        $this->humans[$index] = $human;
        $this->setHumans(array_values($this->humans));
    }

    //prints a table of all humans stored in the list
    public function printHumans(){

        echo("<table cellpadding='3px'>");

        echo("<tr><td>Id</td>
            <td>Nachname</td>
            <td>Vorname</td>
            <td>Alter</td>
            <td>Geschlecht</td></tr>");

            $index = 0;

        foreach($this->humans as $var){


            echo("<tr><td>$index</td>
            <td>".$var->getLastName()."</td>
            <td>".$var->getFirstName()."</td>
            <td>".$var->getAge()."</td>
            <td>".$var->getGender()."</td></tr>");

            $index++;
        }

        echo("</table>");

    }
}
