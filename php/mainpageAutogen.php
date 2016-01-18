<?php
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: srikanthmannepalle
 * Date: 1/9/16
 * Time: 1:45 PM
 */

$servername = "127.0.0.1";
$username = "root";
$password = "MyNewPass";
$dbname ="Playlist";

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    $sqlquery = "SELECT distinct author_id ,author_name,image_url from author_tbl;";
    $result = $conn->query($sqlquery);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="row">';
            echo '<div class="col-md-8 dashboard-left-cell">';
            echo '<div class="admin-content-con clearfix">';

            //header section
            echo '<h5>';
            echo '<div class="pull-left">';
                 echo '<img class="img-circle hidden-xs" src="'.$row['image_url'].'" id="'.$row['author_id'].'" alt="Image not found" onError="this.onerror=null;this.src=\'https://api.fnkr.net/testimg/70x70/00CED1/FFF/?text=70x70\';" width="70px" height="72px"/>';
            echo '</div>';
            echo '<div class="pull-right alert-dismissible">';
                  echo '<span style="font-size: 1.2em;"><b>'.$row['author_name'].'</b></span>';
            echo '</div>';
            echo '</h5>';

            //titlebar
            echo '<table class="table table-condensed display tablesorter playList" id="'.$row['author_id'].'" cellspacing="0" width="100%" id="leftdashboardtable'.$row['author_id'].'">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Title</th>';
            echo '<th>Duration</th>';
            echo '<th>Ratings</th>';
            echo '<th>';
            echo '<div class="pull-left">';
                 echo '<span style="padding-left:80px;">Quality</span>';
            echo '</div>';
            echo '</th>';
            echo '</tr>';
            echo '<tr>';
            echo '<th></th>';
            echo '<th></th>';
            echo '<th></th>';
            echo '<th>';
                 echo '<span class="glyphicon glyphicon-thumbs-up pull-left" aria-hidden="true"></span>';
                 echo '<span class="glyphicon glyphicon-thumbs-down pull-right" aria-hidden="true"></span>';
            echo '</th>';
            echo '<th>';
              echo '<div class="pull-right">';
                 echo '<span class="label label-success" role="button" style=\'padding-right:10px;\'>audio</span>';
                 echo '<span class="label label-success " role="button">video</span>';
                 echo '<span class="label label-success " role="button">content</span>';
                 echo '<span class="label label-warning"  role="button">Report broken</span>';
              echo '</div>';
            echo '</th>';
            echo '</tr>';
            echo '</thead>';
            //end of titlebar

            //body section begins
            echo '<tbody id="playlistItems'.$row['author_id'].'">';
            $authid=$row['author_id'];
            include("createTableOutput.php");
            echo '</tbody>';
            echo '</table>';
            //end of table

            echo '</div>'; //end of admin-content-con
            echo '</div>'; //end of dashboard-left-cell

            echo '<!--                    Below portion can be put in rightDashboardStats.php-->';

            echo '<div class="col-md-4 dashboard-right-cell">';
            echo '<div class="admin-content-con clearfix">';

            echo '<header>';
                 echo '<h5>';
                 echo 'Video';
                 echo '<span class="glyphicon glyphicon-heart pull-right favicon" id="favicon'.$authid.'" value=-1></span>';
                 echo '</h5>';
            echo '</header>';

            echo '<div class="comment-head-dash clearfix">';
                 echo '<div class="pull-left">Viewer hits</div>';
                 echo '<div class="pull-right" id="viewcount'.$authid.'"></div>';
            echo '</div>'; //end of clearfix

            echo '<div id="videoPreview'.$authid.'">';
            echo '</div>'; //end of videopreview
            echo '<div class="clearfix"></div>';
            echo '<br/>';
            echo '<div class="clearfix"></div>';
            echo '<div class="feedback">';
                 echo '<span class="col-xs-4">Audio</span>';
                 echo '<span class="col-xs-4">Video</span>';
                 echo '<span class="col-xs-4">Content</span>';
            echo '</div>'; //end of feedback


            echo '<div class="clearfix"></div>';

            echo '<div class="star-ratingA  col-xs-4 audioRating" id="audioRating'.$authid.'">';
                 echo '<span class="fa fa-star-o" data-rating="1"></span>';
                 echo '<span class="fa fa-star-o" data-rating="2"></span>';
                 echo '<span class="fa fa-star-o" data-rating="3"></span>';
                 echo '<span class="fa fa-star-o" data-rating="4"></span>';
                 echo '<span class="fa fa-star-o" data-rating="5"></span>';
                 echo '<input type="hidden" name="whatever" class="rating-value" value="3">';
            echo '</div>'; //end of audiorating
            echo '<div class="star-ratingV col-xs-4 videoRating" id="videoRating'.$authid.'">';
                 echo '<span class="fa fa-star-o" data-rating="1"></span>';
                 echo '<span class="fa fa-star-o" data-rating="2"></span>';
                 echo '<span class="fa fa-star-o" data-rating="3"></span>';
                 echo '<span class="fa fa-star-o" data-rating="4"></span>';
                 echo '<span class="fa fa-star-o" data-rating="5"></span>';
                 echo '<input type="hidden" name="whatever" class="rating-value" value="3">';
            echo '</div>';//end of videorating
            echo '<div class="star-ratingC col-xs-4 contentRating" id="contentRating'.$authid.'">';
                 echo '<span class="fa fa-star-o" data-rating="1"></span>';
                 echo '<span class="fa fa-star-o" data-rating="2"></span>';
                 echo '<span class="fa fa-star-o" data-rating="3"></span>';
                 echo '<span class="fa fa-star-o" data-rating="4"></span>';
                 echo '<span class="fa fa-star-o" data-rating="5"></span>';
                 echo '<input type="hidden" name="whatever" class="rating-value" value="3">';
            echo '</div>';//end of content rating

            echo '</div>'; //end of admin-content-con
            echo '</div>'; //dashboard-right-cell
            echo '</div>'; //end of row i.e 1 record
            echo '<!--                    Till above portion can be put in rightDashboardStats.php-->';
            echo '<div class="clearfix "></div>';

        } //end of while loop

        echo '<div class="row col-md-12 carousalWrapper">';
              echo '<div>';
                echo '<script charset="utf-8" type="text/javascript">';
                echo 'amzn_assoc_ad_type = "responsive_search_widget";';
                echo 'amzn_assoc_tracking_id = "wwwgyanrootsc-21";';
                echo 'amzn_assoc_marketplace = "amazon";';
                echo 'amzn_assoc_region = "IN";';
                echo 'amzn_assoc_placement = "";';
                echo 'amzn_assoc_search_type = "search_widget";';
                echo 'amzn_assoc_width = 770;';
                echo 'amzn_assoc_height = 220;';
                echo 'amzn_assoc_default_search_category = "";';
                echo 'amzn_assoc_default_search_key = "java books";';
                echo 'amzn_assoc_theme = "light";';
                echo 'amzn_assoc_bg_color = "E6E9ED";';
                echo '</script>';
                echo '<script src="//z-in.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1&MarketPlace=IN"></script>';
              echo '</div>';
        echo '</div>';
        echo '<!--End of carousal-->';
    }
}
$result->free();
$conn->close();
?>