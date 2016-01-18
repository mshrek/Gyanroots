<?php
//$servername = "127.0.0.1";
//$username = "root";
//$password = "MyNewPass";
//$dbname ="Playlist";

$servername = "79.170.40.34";
$username = "demodb1";
$password = "kH36G7k/^";
$dbname ="cl10-demodb1";

$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    echo "reordering started... <br />";
    $file = fopen("../configFile.csv", "rw");

    while (!feof($file)) {
        $row = fgetcsv($file);
        if ($row[0] != 'youtubekey') {
            if ($row[6] == 'NO') {
                echo "sorting not done for authorid =" . $row[2] . "<br />";
                $reIndexQuery1 = "SET @x=0";
                $reIndexQuery2 = "UPDATE video_tbl set sort_id=(@x:=@x+1) WHERE author_id = " . $row[2] . " order by published_date;";
                $indexResult1 = $conn->query($reIndexQuery1);
                $indexResult2 = $conn->query($reIndexQuery2);
            }
        }
    }
    echo "reordering completed !  <br />";
    fclose($file);
    $conn->close();
}
?>