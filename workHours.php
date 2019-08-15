<?php
    require_once('config.php');
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



    if(isset($_POST['senden']))
    {
        $id = $_POST['id'];
        $_SESSION['human_id'] = $id;
    }

#region Auswahlformular
?>
    <form method="post" action="">
        <h3>
            Angestellten Auswählen
        </h3>
        <table>
            <tr>
                <td>
                    id:
                </td>
                <td>
                    <input type="number" name="id">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="senden">
                </td>
                <td>

                </td>
            </tr>
        </table>
    </form>
<?php
#endregion

    if(isset($_SESSION['human_id'])){
        $id = $_SESSION['human_id'];
        $res = $mysqli->query("SELECT * FROM humans WHERE id = $id");

        #region Ausgabe Angestellter
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

        $row = $res->fetch_assoc();

        echo('<tr>
          <td>'.$row['id'].'</td>
          <td>'.$row['lastName'].'</td>
          <td>'.$row['firstName'].'</td>
          <td>'.$row['age'].'</td>
          <td>'.$row['gender'].'</td>
          </tr></table>');
        #endregion

        #region Zeitformular
        ?>
        <form method="post" action="">
            <table>
                <tr>
                    <td>
                        Datum:
                    </td>
                    <td>
                        <input type="date" name="datum">
                    </td>
                </tr>
                <tr>
                    <td>
                        Arbeitsbeginn vormittag:
                    </td>
                    <td>
                        <input type="time" name="beginAm">
                    </td>
                </tr>
                <tr>
                    <td>
                        Arbeitsende vormittag:
                    </td>
                    <td>
                        <input type="time" name="endAm">
                    </td>
                </tr>
                <tr>
                    <td>
                        Arbeitsbeginn nachmittag:
                    </td>
                    <td>
                        <input type="time" name="beginPm">
                    </td>
                </tr>
                <tr>
                    <td>
                        Arbeitsende nachmittag:
                    </td>
                    <td>
                        <input type="time" name="endPm">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="zeit">
                    </td>
                    <td>
                        <input type="reset" name="reset">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        #endregion

        if(isset($_POST['zeit']))
        {
            $datum = $_POST['datum'];
            $beginAm = $_POST['beginAm'];
            $endAm = $_POST['endAm'];
            $beginPm = $_POST['beginPm'];
            $endPm = $_POST['endPm'];

            $mysqli->query("INSERT INTO workHours (human_id,datum,begin_am,end_am,begin_pm,end_pm) VALUES ('$id','$datum','$beginAm','$endAm','$beginPm','$endPm');");




        }


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
                <td>
                    Datum
                </td>
                <td>
                    Arbeitsbeginn
                </td>
                <td>
                    Mittagspause
                </td>
                <td>
                    Ende Mittagspause
                </td>
                <td>
                    Feierabend
                </td>
            </tr>

        <?php


        //needs more dakka
        $res = $mysqli->query("SELECT * FROM humans LEFT JOIN workHours ON humans.id = workHours.human_id");
        while($row = $res->fetch_assoc()){

            echo('<tr>
          <td>'.$row['id'].'</td>
          <td>'.$row['lastName'].'</td>
          <td>'.$row['firstName'].'</td>
          <td>'.$row['age'].'</td>
          <td>'.$row['gender'].'</td>
          <td>'.$row['datum'].'</td>
          <td>'.$row['begin_am'].'</td>
          <td>'.$row['end_am'].'</td>
          <td>'.$row['begin_pm'].'</td>
          <td>'.$row['end_pm'].'</td>
          </tr>');

        }

    }
