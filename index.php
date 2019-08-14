<?php
require_once('config.php');



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

#region Formular Hinzufügen
?>
<table>
    <tr>
        <td>
            <form method='post' action=''>
                <h3>Neue Person hinzufügen</h3>

                <table cellpadding='3px'>

                    <tr>
                        <td>
                            Nachname:
                        </td>
                        <td>
                            <input type='text' name='lastName'>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Vorname:
                        </td>
                        <td>
                            <input type='text' name='firstName'>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Alter:
                        </td>
                        <td>
                            <input type='number' name='age'>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Geschlecht:
                        </td>
                        <td>
                            <input type='text' name='gender'>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type='submit' name='add' value='Hinzufügen'>
                        </td>
                        <td>
                            <input type='reset' name='reset'>
                        </td>
                    </tr>

                </table>
            </form>
        </td>
<?php
#endregion
#region Formular Ändern
?>
        <td>
            <form method='post' action=''>
                <h3>Person ändern</h3>
                <table cellpadding='3px'>

                    <tr>
                        <td>
                            Id:
                       </td>
                       <td>
                            <input type='text' name='id'>
                       </td>
                   </tr>

                   <tr>
                       <td>
                           Nachname:
                       </td>
                      <td>
                          <input type='text' name='lastName'>
                       </td>
                   </tr>

                    <tr>
                       <td>
                           Vorname:
                       </td>
                       <td>
                          <input type='text' name='firstName'>
                      </td>
                   </tr>

                    <tr>
                       <td>
                           Alter:
                       </td>
                       <td>
                           <input type='number' name='age'>
                       </td>
                   </tr>

                   <tr>
                       <td>
                          Geschlecht:
                       </td>
                       <td>
                          <input type='text' name='gender'>
                     </td>
                  </tr>

                   <tr>
                       <td>
                          <input type='submit' name='alter' value='Ändern'>
                      </td>
                     <td>
                         <input type='reset' name='reset'>
                      </td>
                    </tr>
                </table>
            </form>
        </td>
<?php
#endregion
#region Formular Entfernen
?>
        <td>
            <form method='post' action=''>
               <h3>Person entfernen</h3>
               <table cellpadding='3px'>

                   <tr>
                      <td>
                          Id:
                     </td>
                     <td>
                          <input type='text' name='id'>
                      </td>
                  </tr>

                 <tr>
                     <td>
                         <input type='submit' name='remove' value='Entfernen'>
                        </td>
                     <td>
                            <input type='reset' name='reset'>
                        </td>
                    </tr>

             </table>
           </form>
        </td>
    </tr>
</table>
<?php
#endregion
#endregion
#region Auswertung
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$id = $_POST['id'];

if(isset($_POST['remove'])){


    $mysqli->query('DELETE FROM humans WHERE id = '.$id.';');

}

elseif (isset($_POST['add'])) {


    $mysqli->query("INSERT INTO humans (lastName,firstName,age,gender) VALUES ('$lastName','$firstName','$age','$gender');");

}

elseif (isset($_POST['alter'])) {

    $mysqli->query("UPDATE humans SET lastName = '$lastName', firstName = '$firstName', age = '$age', gender = '$gender' WHERE id = '$id';");
}
#endregion
#region Tabellenausgabe
?>
<table cellpadding='3px'>
    <tr>
        <td>
            Id
        </td>
        <td>
            Nachname
        </td>
        <td>
            Vorname
        </td>
        <td>
            Alter
        </td>
        <td>
            Geschlecht
        </td>
    </tr>

<?php
$res = $mysqli->query('SELECT * FROM humans;');

while($row = $res->fetch_assoc()){

    echo('<tr>
          <td>'.$row['id'].'</td>
          <td>'.$row['lastName'].'</td>
          <td>'.$row['firstName'].'</td>
          <td>'.$row['age'].'</td>
          <td>'.$row['gender'].'</td>
          </tr>');

}
echo("</table>");
#endregion

$mysqli->close();
