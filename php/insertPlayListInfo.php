<?php
$servername = "127.0.0.1";
$username = "root";
$password = "MyNewPass";
$dbname ="Playlist";

$conn = new mysqli($servername, $username, $password,$dbname);

$rest_json = file_get_contents("php://input");
parse_str($rest_json,$_POST);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo $rest_json;
    echo $_POST;
    echo "Connected successfully<br>";
    $ptitle=$_POST['ptitle'];
    $pduration=$_POST['pduration'];
    $plikes=$_POST['plikes'];
    $pdislikes=$_POST['pdislikes'];
    $avgaudiorating=0;
    $avgvideorating=0;
    $avgcontentrating=0;
    $reportbroken='false';
    $authorname='"'.$_POST['pauthorname'].'"';  //to be read from config file
    $pviewcount=$_POST['pviewcount'];
    $pcommentscount=$_POST['pcommentscount'];
    $pvideolink='"'.$_POST['pvideolink'].'"';
    $pimageURL = '"'.$_POST['pimageURL'].'"';
    $ppublishedAt = '"'.$_POST['ppublishedAt'].'"';
    $psubjectID = $_POST['psubjectID'];
    $pauthorID = $_POST['pauthorID'];

    $sqlquery1 = "INSERT INTO author_tbl (author_id,author_name,image_url) VALUES ($pauthorID,$authorname,$pimageURL)";
    $sqlquery2 = "INSERT INTO video_tbl (subject_id,author_id,title,duration,likes,dislikes,view_count,
                      comments_count,video_url,published_date,avg_audio_rating,avg_video_rating,avg_content_rating) VALUES ($psubjectID,$pauthorID,$ptitle,$pduration,
                      $plikes,$pdislikes,$pviewcount,$pcommentscount,$pvideolink,$ppublishedAt,$avgaudiorating,$avgvideorating,$avgcontentrating);";

    echo $sqlquery1+"<br/>";
    echo $sqlquery2;
    $result1 = $conn->query($sqlquery1);
    $result1 = $conn->query($sqlquery2);

    if (($result1 ||  $result2)<= 0)
        echo 0;
    else
        echo 1;

}
$result1->free();
$result2->free();
$conn->close();
?>