<?php
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
    $sqlquery= "select a.view_count as viewcount, ifnull(b.audio_rating,0) as audiorating, ifnull(b.video_rating,0) as videorating,
                ifnull(b.content_rating,0) as contentrating, ifnull(b.fav_rating_flag,0) as favrating
                from video_tbl a left outer join user_video_tbl b on a.video_id = b.video_id
                where a.sort_id = ".$_POST["id"]." and a.author_id = ".$_POST["authid"].";";

    $results = $conn->query($sqlquery);
    if ($results->num_rows  > 0) {
        while ($row = $results->fetch_assoc()) {
            echo ($row["viewcount"].",".$row["audiorating"].",".$row["videorating"].",".$row["contentrating"].",".$row["favrating"]);
        }
    }
    else{
        echo "NA";
    }
    $results->free();
    $conn->close();
}
?>