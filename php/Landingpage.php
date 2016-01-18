<?php
session_start();


function returnStats($subjectID){
    $servername = "127.0.0.1";
    $username = "root";
    $password = "MyNewPass";
    $dbname ="Playlist";

    $conn = new mysqli($servername, $username, $password,$dbname);
    $countAuthorsQuery = "select count(distinct author_id) as authorCount from video_tbl where subject_id=$subjectID;";
    $countAuthor = $conn->query($countAuthorsQuery)->fetch_assoc()['authorCount'];
    $countVideosQuery =  "select count(video_id) as videoCount from video_tbl where subject_id=$subjectID;";
    $countVideos = $conn->query($countVideosQuery)->fetch_assoc()['videoCount'];
    $conn->close(); // find a way to open one connectio and fire multiple queries
    return array($countAuthor,$countVideos);

}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>User Profile</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/default.css" rel="stylesheet" type="text/css">
    <link href="../css/index.css" rel="stylesheet" type="text/css">
    <link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <!--    added for bootstrap styling-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/bs/dt-1.10.10,se-1.1.0/datatables.min.css"/>
    <!-- Shared assets -->
    <!--    <link rel="stylesheet" type="text/css" href="../css/style.css">-->

    <!-- Example assets -->
    <link rel="stylesheet" type="text/css" href="../css/jcarousel.ajax.css">






    <!--    added for bootstrap styling-->
    <script type="text/javascript" src="https://cdn.datatables.net/s/bs/dt-1.10.10,se-1.1.0/datatables.min.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/carousaljquery.js"></script>
    <script type="text/javascript" src="../js/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="../js/jcarousel.ajax.js"></script>



    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/default.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/jquery.tablesorter.min.js"></script>
    <script src="../js/loadYoutubeData.js"></script>
    <script src="../js/mainPageJS.js"></script>




</head>
<body>
<div class="container-fluid display-table">
    <div class="row display-table-row ">
        <!--side menu-->
        <div class="col-md-2 col-sm-1 display-table-cell hidden-xs valign-top" id="side-menu">
            <h1 class="hidden-xs hidden-md">navigation</h1>
            <ul>
                <!--List for top dashboard systems-->
                <li class="link active">
                    <a href="../index.php">
                        <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Dashboard</span>
                    </a>
                </li>
                <!--List for top programming languages-->
                <li class="link">
                    <a href="#collapse-ProgLanguages" data-toggle="collapse" aria-controls="collapse-ProgLanguages">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Programming languages</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-ProgLanguages">
                        <li>
                            <a href="#">Java
                                <span class="label  pull-right hidden-xs hidden-md"><?php echo returnStats(1001)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"><?php echo returnStats(1001)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">C/C++
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1002)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1002)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Python
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1003)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1003)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">VB .NET
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1004)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1004)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">PHP
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1005)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1005)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Ruby
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1006)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1006)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">R
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1007)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1007)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Matlab
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1008)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1008)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Android
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1009)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1009)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Swift
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1010)[1];?></span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> <?php echo returnStats(1010)[0];?></span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for top  scripting languages-->
                <li class="link">
                    <a href="#collapse-Scripts" data-toggle="collapse" aria-controls="collapse-Scripts">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Scripting languages</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-Scripts">
                        <li>
                            <a href="#">Javascript
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">JQuery
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Angular JS
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Node JS
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Perl
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Shell
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">VB script
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for top database management systems-->
                <li class="link">
                    <a href="#collapse-DB" data-toggle="collapse" aria-controls="collapse-DB">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">DBMS</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-DB">
                        <li>
                            <a href="#">Oracle
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">MySQL
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">MS SQL Server
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">MongoDB
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">DB2
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">MS Access
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Cassandra
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Redis
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for top big data technologies-->
                <li class="link">
                    <a href="#collapse-BigData" data-toggle="collapse" aria-controls="collapse-BigData">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Big Data</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-BigData">
                        <li>
                            <a href="#">Hadoop
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">SparkSQL
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Storm
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Hbase
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Scala
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Flume
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Kafka
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for top security technologies-->
                <li class="link">
                    <a href="#collapse-Security" data-toggle="collapse" aria-controls="collapse-Security">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Security</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-Security">
                        <li>
                            <a href="#">Enterprise
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Mobile
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Hacking
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for top game programming languages-->
                <li class="link">
                    <a href="#collapse-GameProgramming" data-toggle="collapse" aria-controls="collapse-GameProgramming">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Game Programming</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-GameProgramming">
                        <li>
                            <a href="#">Unity
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for top web development-->
                <li class="link">
                    <a href="#collapse-WebDevelopment" data-toggle="collapse" aria-controls="collapse-WebDevelopment">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Web Development</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-WebDevelopment">
                        <li>
                            <a href="#">Play framework
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Ruby on Rails
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Django
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">CodeIgniter
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Laravel
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for setup configurations-->
                <li class="link">
                    <a href="#collapse-DevEnvSetup" data-toggle="collapse" aria-controls="collapse-DevEnvSetup">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Setups & Configuration</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-DevEnvSetup">
                        <li>
                            <a href="#">Eclipse
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">IntelliJ
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Git
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Maven
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Jenkins
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for top automation tools-->
                <li class="link">
                    <a href="#collapse-Automation" data-toggle="collapse" aria-controls="collapse-Automation">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Automation</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-Automation">
                        <li>
                            <a href="#">Selenium
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">VS Coded UI
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Android
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">IOS
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for top testing tools-->
                <li class="link">
                    <a href="#collapse-Testing" data-toggle="collapse" aria-controls="collapse-Testing">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Testing</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-Testing">
                        <li>
                            <a href="#">Testing Process
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Debugging tools
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for experts view-->
                <li class="link">
                    <a href="#collapse-ExpertView" data-toggle="collapse" aria-controls="collapse-ExpertView">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Expert's view</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-ExpertView">
                        <li>
                            <a href="#">General tips
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Efficient Coding
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Algorithms
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Design Patterns
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--List for top certifications-->
                <li class="link">
                    <a href="#collapse-Certifications" data-toggle="collapse" aria-controls="collapse-Certifications">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        <span class="hidden-xs hidden-md">Certifications</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-Certifications">
                        <li>
                            <a href="#">Programming
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Databases
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Linux
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Networking
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Virtualization
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">Cloud
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-facetime-video pull-right" aria-hidden="true"></span>
                                <span class="label  pull-right hidden-xs hidden-md"> 10</span>
                                <span class="glyphicon glyphicon-user pull-right" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!--main menu -->
        <div class="col-md-10 col-sm-11  display-table-cell valign-top">
            <div class="row">

                <!--                top header section-->
                <header id="nav-header" class="clearfix">
                    <div class="col-md-5">
                        <nav class="navbar-default pull-left">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="offCanvas" data-target="#side-menu">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </nav>
                        <input type="text" id="header-search-field" class="hidden-xs hidden-md" placeholder="Search for something..">
                    </div>
                    <div class="col-md-7">
                        <ul class=pull-right>
                            <?php
                            $logout = 'http://localhost/Contact.html';
                            if(isset($_REQUEST['logout'])){
                                //unset($_SESSION['fbtoken']);
                                //session_unset();
                                //session_destroy();
                                //$args = array_merge(array(session_name(), ''), array_values(session_get_cookie_params()));
                                //$args[2] = time() - 3600;
                                //call_user_func_array('fbtoken', $args);
                                //setcookie( "PHPSESSID", "", (time()-3600) );
                                $sessionvar = $this->GetLoginSessionVar();
                                $_SESSION[$sessionvar]=NULL;
                                unset($_SESSION[$sessionvar]);
                                session_destroy();
                                //setcookie("PHPSESSID", "", 1);
                            }
                            //$logout = 'http://localhost/Contact.html';
                            $_SESSION['email'] = array_key_exists('email', $_SESSION) ? $_SESSION['email'] : 'Learner !';
                            echo '<li id="welcome">Welcome '.$_SESSION['name'].'</li>';
                            //fire sql query to check if user exists
                            $servername = "127.0.0.1";
                            $username = "root";
                            $password = "MyNewPass";
                            $dbname ="Playlist";

                            $conn = new mysqli($servername, $username, $password,$dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            else{
                                $firstname = '"'.$_SESSION['firstname'].'"';
                                $lastname = '"'.$_SESSION['lastname'].'"';
                                $email = '"'.$_SESSION['email'].'"';
                                $imageurl = '"'.$_SESSION['image_url'].'"';

                                $userCountQuery= "SELECT count('email_id') as NUM from user_tbl where email_id =".$email.";";
                                $userCount= $conn->query($userCountQuery);
                                $row = $userCount->fetch_assoc();
                                if($row['NUM']==0){
                                    $insertNewUserQuery = "INSERT into user_tbl (firstname,lastname,email_id,image_url) values ($firstname,$lastname,$email,$imageurl);";
                                    $conn->query($insertNewUserQuery);
                                }
                                else{
                                    echo '<li class="fixed-width">';
                                    echo '<img width="70%" height="70%" style="margin:0px;" src='.$imageurl.'/>';
                                    echo '</li>';
                                    echo '<li>';
                                }
                            }
                            ?>
                            <!--                            <li id="welcome">Welcome to yout profile!</li>-->
<!--                            PHASE 2-->
<!--                            <li class="fixed-width">-->
<!--                                <a href="#">-->
<!--                                    <span class="glyphicon glyphicon-bell" aria-hidden="true"></span>-->
<!--                                    <span class="label label-warning">4</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!---->
<!--                            <li class="fixed-width">-->
<!--                                <a href="#">-->
<!--                                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>-->
<!--                                    <span class="label label-message">4</span>-->
<!--                                </a>-->
<!--                            </li>-->

                                <?php
                                echo "<a class='logout' id='logout' href='".$logout."'>";
                                ?>
                                <span class="glyphicon glyphicon-log-out pull-left" aria-hidden="true"></span>
                                logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </header>
            </div>

            <div id="dashboard-con">
                <!--                Starting here can be auto generated by the php file-->
                <?php include("mainpageAutogen.php"); ?>
                <!--                Till here can be auto generated by the php file-->


                <!-- footer starts here-->
                <div class="row">
                    <footer id="admin-footer" class="clearfix">
                        <div class="pull-left"><b>Copyright</b>&copy; Fope 2015</div>
                        <div class="pull-right">All rights reserved</div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
