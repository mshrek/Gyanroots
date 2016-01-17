/**
 * Created by srikanthmannepalle on 1/1/16.
 */

if (typeof jQuery == "undefined"){
    alert('Jquery is not loaded');
} else {
    $(document).ready(function () {
        alert('dom is ready now...');
        //variables for DB insertion
        var youtubekey;
        var authname;
        var authid;
        var playlistid;
        var maxrecords;

        //variables for making call to youtube api
        var vidTitle;
        var duration;
        var likes;
        var dislikes;
        var comments;
        var viewcount;
        var imageURL;

        $('#submitbtn').click(function () {
            alert('sdsd');
            youtubekey=$('#keyid').val();
            authname=$('#authname').val();
            authid=$('#authid').val();
            playlistid=$('#playlistid').val();
            maxrecords=$('#maxrecords').val();



            //section to retrieve playlist Items
            var channelName = authname;
            var index = 1;


            $.get("https://www.googleapis.com/youtube/v3/channels", {
                    part: 'contentDetails,brandingSettings',
                    forUsername: channelName,
                    key: youtubekey
                },
                function (data) {
                    $.each(data.items, function (i, item) {
                        console.log(item);
                        pid = item.contentDetails.relatedPlaylists.uploads;
                        getVids(pid);
                        console.log("Play list id now is ="+pid);
                        imageURL=item.brandingSettings.image.bannerMobileLowImageUrl;
                        //console.log(imageURL);
                        //alert("image url is ="+imageURL);
                    })
                }
            );

            function getVids(pid) {

                $.get("https://www.googleapis.com/youtube/v3/playlistItems", {
                        part: 'snippet',
                        maxResults: 50,
                        playlistId: pid,
                        key: 'AIzaSyAYVmp1339Gvva8j9Kc5HebekzTS2cLRa4'
                    },

                    function (data) {

                        $.each(data.items, function (i, item) {
                            console.log(item);
                            videoId = item.snippet.resourceId.videoId;
                            getStats(videoId, index);
                            index += 1;
                        })
                    }
                );
            }


            //videoDuration
            function getStats(videoID, index) {
                var output = '';

                $.get("https://www.googleapis.com/youtube/v3/videos?id=" + videoID, {
                        part: 'snippet,contentDetails,statistics,status',
                        key: 'AIzaSyAYVmp1339Gvva8j9Kc5HebekzTS2cLRa4'
                    },
                    function (data) {
                        $.each(data.items, function (i, item) {
                            console.log(item);
                            vidTitle = item.snippet.title;
                            duration = item.contentDetails.duration;
                            likes = item.statistics.likeCount;
                            dislikes = item.statistics.dislikeCount;
                            comments = item.statistics.commentCount;
                            viewcount = item.statistics.viewCount;
                            postParams(vidTitle, duration, likes, dislikes, viewcount, comments);
                        })
                    }
                );


                //function to send data into sql
                function postParams(vidTitle, duration, likes, dislikes, viewcount, comments) {
                    $.post("insertPlayListInfo.php", {
                            ptitle: "\'" + vidTitle + "\'",
                            pduration: "\'" + duration + "\'",
                            plikes: likes,
                            pdislikes: dislikes,
                            pviewcount: viewcount,
                            pcommentscount: comments,
                            pimageURL: imageURL
                        }, function (data) {
                            console.log("value of data=" + data);
                            if (data != null) {
                                console.log("Insertion of record " + vidTitle + " was successfull");
                                // console.log(imageURL);
                            }
                            else {
                                console.log("Insertion of record " + vidTitle + " was not successfull");
                            }
                        }
                    );
                }
            }

        });

    });
}




