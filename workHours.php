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

?>
<form method="post" action="">
    <h3>
        Angestellter
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
            <input type="submit" name="submit">
            </td>
            <td>

            </td>
        </tr>
    </table>
</form>
<?php
