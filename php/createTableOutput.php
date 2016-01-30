<?php
session_start();


$servername = "127.0.0.1";
$username = "root";
$password = "MyNewPass";
$dbname ="Playlist";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    $findUserIDQuery = "SELECT user_id from user_tbl where email_id = '".$_SESSION['email']."';";
    $userIDResult=$conn->query($findUserIDQuery);
    $userID=$userIDResult->fetch_assoc();

    $sqlquery= "select distinct v.sort_id,v.title,v.duration,v.likes,v.dislikes,v.avg_audio_rating,v.avg_video_rating,v.avg_content_rating, ifnull(uv.broken_link_flag,0) as brokenlink
    from video_tbl v left outer join (select * from user_video_tbl where user_id = ".$userID['user_id'].") uv
    on v.video_id = uv.video_id
    where v.author_id = $authid and v.subject_id = ".$_SESSION['subjectID'].";";

    $results=$conn->query($sqlquery);

    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            echo "<tr class='sendIdOnClick'>";
            echo "<td data-sort-value='" . $row['sort_id'] . "'>" . $row['sort_id'] . "</td>";
            echo "<td class='titleCol col-xs-3'><a>" . $row["title"] . "</a></td>";
            echo "<td>" . $row["duration"] . "</td>";
            echo "<td>";
            echo "<span col-xs-6 class='pull-left text-success'>" . $row["likes"] . "</span>";
            echo "<span col-xs-6 class='pull-right text-danger'>" . $row["dislikes"] . "</span>";
            echo "</td>";
            echo "<td>";
            echo "<span col-xs-4 class='text-danger col-xs-offset-2  col-xs-2' style='padding-right:10px;'>" . $row["avg_audio_rating"] . "</span>";
            echo "<span col-xs-4 class='text-warning qualityCenter col-xs-2' style='padding-left:15px;'>" . $row["avg_video_rating"] . "</span>";
            echo "<span col-xs-4 class='text-success col-xs-2' style='padding-left:10px;'>" . $row["avg_content_rating"] . "</span>";
            if($row["brokenlink"]==1) {
                //remove bg-color='#ffff00'
                echo "<span class='glyphicon glyphicon-warning-sign warning-red col-xs-2 warning' bg-color='#ffff00' aria-hidden='true' id='warning" . $row['sort_id'] .$_SESSION['subjectID']. "'></span>";
            }
            else {
                echo "<span class='glyphicon glyphicon-warning-sign col-xs-2 warning' bg-color='#ffff00' aria-hidden='true' id='warning" . $row['sort_id'] .$_SESSION['subjectID']. "'></span>";
            }
            echo "</td>";
            echo "</tr>";
        }
    }
    else{
        echo "<tr>";
        echo "<td>NA</td>";
        echo "<td>NA</td>";
        echo "<td>NA</td>";
        echo "<td>NA</td>";
        echo "<td>NA</td>";
        echo "<td>NA</td>";
        echo "<td>NA</td>";
        echo "</tr>";
    }

}
$userIDResult->free();
$results->free();
$conn->close();
?>