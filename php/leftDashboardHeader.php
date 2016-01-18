<?php
session_start();

/**
 * Created by IntelliJ IDEA.
 * User: srikanthmannepalle
 * Date: 1/2/16
 * Time: 4:59 PM
 */

$servername = "127.0.0.1";
$username = "root";
$password = "MyNewPass";
$dbname ="Playlist";

$rest_json = file_get_contents("php://input");
parse_str($rest_json,$_POST);

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    $sqlquery = "SELECT imageurl,authorname from playlist1 where id=1;";
    $results = $conn->query($sqlquery);
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            echo '<h5>';
            echo '<div class="pull-left">';
            echo '<img class="img-circle hidden-xs" src="'.$row['imageurl'].'" width="70px" height="72px"/>';
            echo '</div>';
            echo '<div class="pull-right alert-dismissible">';
            echo '<span style="font-size: 1.2em;"><b>'.$row['authorname'].'</b></span>';
            echo '</div>';
            echo '</h5>';
        }
    }
    else{
        echo '<h5>';
        echo '<div class="pull-left">';
        echo '<img class="img-circle hidden-xs" src="https://api.fnkr.net/testimg/70x70/00CED1/FFF/?text=70x70"/>';
        echo '</div>';
        echo '<div class="pull-right alert-dismissible">';
        echo '<span style="font-size: 1.2em;"><b>Instructor</b></span>';
        echo '</div>';
        echo '</h5>';
    }
    $results->free();
    $conn->close();
}
?>