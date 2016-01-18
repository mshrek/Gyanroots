<?php
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
    //$sqlquery ="SELECT sort_id,title,duration,likes,dislikes,avg_audio_rating,avg_video_rating,avg_content_rating,brokenlink FROM playlist1 where authorid=$authid;";
    //$getBrokenLinkValQuery = "SELECT broken_link_flag from user_video_tbl where user_id = ".""." and video_id ="."";
    //$sqlquery ="SELECT sort_id,title,duration,likes,dislikes,avg_audio_rating,avg_video_rating,avg_content_rating,0 as brokenlink FROM video_tbl where author_id=$authid";
    $findUserIDQuery = "SELECT user_id from user_tbl where email_id = '".$_SESSION['email']."';";
    $userIDResult=$conn->query($findUserIDQuery);
    $userID=$userIDResult->fetch_assoc();

    $sqlquery= "select distinct v.sort_id,v.title,v.duration,v.likes,v.dislikes,v.avg_audio_rating,v.avg_video_rating,v.avg_content_rating, ifnull(uv.broken_link_flag,0) as brokenlink
    from video_tbl v left outer join (select * from user_video_tbl where user_id = ".$userID['user_id'].") uv
    on v.video_id = uv.video_id
    where v.author_id = $authid;";


//    $sqlquery = "select distinct uv.user_id, v.author_id, v.video_id, uv.broken_link_flag from video_tbl v, user_video_tbl uv where v.video_id = uv.video_id
//                 and uv.user_id = ".$userID['user_id'].
//                 " and v.author_id = $authid;";
   // echo "createtable sql query for authorid = ".$authid."\r\n"."query = ".$sqlquery."\r\n";
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
                echo "<span class='glyphicon glyphicon-warning-sign warning-red col-xs-2 warning' bg-color='#ffff00' aria-hidden='true' id='warning" . $row['sort_id'] . "'></span>";
            }
            else {
                echo "<span class='glyphicon glyphicon-warning-sign col-xs-2 warning' bg-color='#ffff00' aria-hidden='true' id='warning" . $row['sort_id'] . "'></span>";
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