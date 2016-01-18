<?php
/**
 * Created by IntelliJ IDEA.
 * User: srikanthmannepalle
 * Date: 1/2/16
 * Time: 4:59 PM
 */
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "MyNewPass";
$dbname ="Playlist";

$rest_json = file_get_contents("php://input");
parse_str($rest_json,$_POST);
$elementID=$_POST['elementID'];
$value=$_POST["value"];
$authid=$_POST["authid"];

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    $findUserIDQuery = "SELECT user_id from user_tbl where email_id = '".$_SESSION['email']."';";
    $userIDResult=$conn->query($findUserIDQuery);
    $userID=$userIDResult->fetch_assoc();
    echo "emailId = ".$_SESSION['email']." userid = ".$userID['user_id']."\r\n";
    $findVideoIDQuery = "SELECT video_id from video_tbl where author_id = ".$authid." and sort_id = ".$elementID.";";
    $videoIDResult=$conn->query($findVideoIDQuery);
    $videoID=$videoIDResult->fetch_assoc();
    echo "videoID = ".$videoID['video_id']."\r\n";
    $checkRecordExistsQuery = "SELECT count(user_video_id) as NUMRECORDS from user_video_tbl where user_id = ".$userID['user_id']." and video_id = ".$videoID['video_id'].";";
    $checkRecordExistsQueryResult=$conn->query($checkRecordExistsQuery);
    echo "record exists query = ".$checkRecordExistsQuery."\r\n";
    $numrecords = $checkRecordExistsQueryResult->fetch_assoc()['NUMRECORDS'];
    echo "record exists query fetched number of rows = ".$numrecords."\r\n";

    if($numrecords == 0) {
        echo "record not found, entered here"."\r\n";
        $sqlquery1 = "INSERT into user_video_tbl (user_id,video_id,broken_link_flag) values (" . $userID['user_id'] . "," . $videoID['video_id'] . "," . $value . ");";
        $result1 = $conn->query($sqlquery1);
        echo "sql query was ".$sqlquery1."\r\n";
        echo "result was ".$result1."\r\n";
    }
    else {
        echo "record found, entered here"."\r\n";
        $sqlquery2 = "UPDATE user_video_tbl b right outer join video_tbl a on a.video_id = b.video_id
                      SET b.broken_link_flag = $value WHERE a.sort_id = $elementID and a.author_id = $authid and user_id = ".$userID['user_id'].";";
        $result2 = $conn->query($sqlquery2);
        echo " update query = ".$sqlquery2."\r\n";
        echo " result of update query = ".$result2."\r\n";
    }

    if ($result1 || $result2) {
        echo "Updation done successfully for " . $ratingfor . " element "." and author id =".$authid."\r\n";
    } else {
        echo "Updation was not done successfully for " . $ratingfor . " element "." and author id =".$authid."\r\n";
    }
}
$userIDResult->free();
$videoIDResult->free();
$checkRecordExistsQueryResult->free();
$results->free();
$conn->close();
?>