<?php

require_once('Human.php');
require_once('ListOfHumans.php');
session_start();


#region Datenbankverbindung
$mysqli = new mysqli(HUMANS_DB_HOST,HUMANS_DB_USER,HUMANS_DB_PW,HUMANS_DB_DATABASE);

if($mysqli === false){
    die("Fehler: " . $mysqli->connect_error);
}

if($mysqli->connect_error){
    die("Fehler: " . $mysqli->connect_error);
}

#endregion

#region Formulare
// Form for adding humans
echo("<table><tr><td><form method='post' action=''><h3>Neue Person hinzufügen</h3><table cellpadding='3px'>
<tr><td>Nachname: </td><td><input type='text' name='lastName'></td></tr>
<tr><td>Vorname: </td><td><input type='text' name='firstName'></td></tr>
<tr><td>Alter: </td><td><input type='number' name='age'></td></tr>
<tr><td>Geschlecht: </td><td><input type='text' name='gender' </td></tr>
<tr><td><input type='submit' name='add' value='Hinzufügen'></td><td><input type='reset' name='reset' </td></tr>
</table></form></td>");


// Form for altering humans
echo("<td><form method='post' action=''><h3>Person ändern</h3><table cellpadding='3px'>
<tr><td>Id: </td><td><input type='text' name='id'></td></tr>
<tr><td>Nachname: </td><td><input type='text' name='lastName'></td></tr>
<tr><td>Vorname: </td><td><input type='text' name='firstName'></td></tr>
<tr><td>Alter: </td><td><input type='number' name='age'></td></tr>
<tr><td>Geschlecht: </td><td><input type='text' name='gender' </td></tr>
<tr><td><input type='submit' name='alter' value='Ändern'></td><td><input type='reset' name='reset' </td></tr>
</table></form></td>");


// Form for removing humans
echo("<td><form method='post' action=''><h3>Person löschen</h3><table cellpadding='3px'>
<tr><td>Id: </td><td><input type='text' name='id'></td></tr>
<tr><td><input type='submit' name='remove' value='Löschen'></td><td><input type='reset' name='reset' </td></tr>
</table></form></td></tr></table>");
#endregion

#region initialisierung
if(!isset($_SESSION['list'])){

    $list = new ListOfHumans();
    $_SESSION['list'] = $list;
}
#endregion

//if this isn't the initial run
else{

    //list gets called from session variable
    $list = $_SESSION['list'];


    //if user wants to remove a human
    if(isset($_POST['remove'])){

        //human at target index gets removed from list
        $list->removeHuman($_POST['id']);
    }

    //if user wants to add a human
    if(isset($_POST['add'])){

        //new human is created with the given values from the form, then added to the list
        $newHuman = new Human($_POST['lastName'], $_POST['firstName'], $_POST['age'], $_POST['gender']);
        $list->addHuman($newHuman);



    }

    //if user wants to alter a human
    if(isset($_POST['alter'])){

        //new human is created with the given values from the form and used to overwrite the human at the target index
        $newHuman = new Human($_POST['lastName'], $_POST['firstName'], $_POST['age'], $_POST['gender']);
        $list->alterHuman($_POST['id'], $newHuman);
    }


    //current state of the list gets stored in the session variable
    $_SESSION['list'] = $list;
}
//list is printed as table
$list->printHumans();
