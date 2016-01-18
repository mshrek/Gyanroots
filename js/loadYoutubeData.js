/**
 * Created by srikanthmannepalle on 1/1/16.
 */

if (typeof jQuery == "undefined"){
    alert('Jquery is not loaded');
} else {
    $(document).ready(function () {
       // alert('dom is ready now...');
        //variables for DB insertion
        var youtubekey;
        var authname;
        var authid;
        var playlistname;
        var maxrecords;
        var subjectID;

        //variables for making call to youtube api
        var vidTitle;
        var duration;
        var likes;
        var dislikes;
        var comments;
        var authorname;
        var authorid;
        var viewcount;
        var gplusid;
        var imageURL;
        var videolink;
        var publishedAt;
        var gexecutionComplete;

        $('#submitbtn').click(function () {
            var executionComplete=false;

            youtubekey=$('#keyid').val();
            authorname=$('#authname').val();
            authorid=$('#authid').val();
            playlistname=$('#playlistName').val();
            maxrecords=$('#maxrecords').val();
            subjectID=$('#subjectID').val();


            //section to retrieve playlist Items
            var channelName = authorname;
            var index = 1;


            $.get("https://www.googleapis.com/youtube/v3/channels", {
                    part: 'contentDetails,brandingSettings',
                    forUsername: channelName,
                    key: youtubekey
                },
                function (data) {
                    $.each(data.items, function (i, item) {
                        console.log(item);
                        channelid= item.id;
                        gplusid=item.contentDetails.googlePlusUserId;
                        getImageURL(gplusid);
                        getPlayListId(channelid);
                    })
                }
            );

            function getImageURL(_gplusid) {
                $.get("https://www.googleapis.com/plus/v1/people/"+_gplusid+"?fields=image"+"&key="+youtubekey,
                    function (data) {
                        imageURL=data.image.url;
                    });
            }




            function getPlayListId(_channelId) {

                $.get("https://www.googleapis.com/youtube/v3/playlists", {
                        part: 'snippet',
                        maxResults: maxrecords,
                        channelId: _channelId,
                        key: youtubekey
                    },

                    function (data) {

                        $.each(data.items, function (i, item) {
                            playListName = item.snippet.title;
                            playListid = item.id;
                            if(playListName==playlistname) {
                                console.log(item);
                                console.log(playlistname+' play list found !');
                                getPlayListItems(playListid,reOrder);
                            }
                        })
                    }
                );
            }

            function getPlayListItems(_playListid) {

                $.get("https://www.googleapis.com/youtube/v3/playlistItems", {
                        part: 'snippet',
                        maxResults: maxrecords,
                        playlistId: _playListid,
                        pageToken:'',
                        key: youtubekey
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
                        key: youtubekey
                    },
                    function (data) {
                        $.each(data.items, function (i, item) {
                            console.log(item);
                            vidTitle = item.snippet.title;
                            duration = item.contentDetails.duration;
                            likes = item.statistics.likeCount;
                            dislikes = item.statistics.dislikeCount;
                            videolink = item.id;
                            comments = item.statistics.commentCount;
                            viewcount = item.statistics.viewCount;
                            publishedAt = item.snippet.publishedAt;
                            console.log("Next page token=" + item.nextPageToken);
                            postParams(vidTitle, duration, likes, dislikes, authorname, authorid, viewcount, videolink, comments, publishedAt,subjectID);
                        })
                    }
                );
            }

                //function to send data into sql
                function postParams(vidTitle, duration, likes, dislikes,authorname,authorid,viewcount,videolink,comments,publishedAt,subjectID) {
                    $.post("../php/insertPlayListInfo.php", {
                            ptitle: "\'" + vidTitle + "\'",
                            pduration: "\'" + duration + "\'",
                            plikes: likes,
                            pdislikes: dislikes,
                            pauthorname:authorname,
                            pauthorID:authorid,
                            pviewcount: viewcount,
                            pcommentscount: comments,
                            pvideolink :videolink,
                            pimageURL: imageURL,
                            ppublishedAt: publishedAt,
                            psubjectID: subjectID,
                        }, function (data) {
                            console.log("value of data=" + data);
                            if (data) {
                                console.log("Insertion of record " + vidTitle + " was successfull");
                                // console.log(imageURL);
                            }
                            else {
                                console.log("Insertion of record " + vidTitle + " was not successfull");
                            }
                        }
                    );
                }

            delayedAlert();
        });

        function delayedAlert() {
            timeoutID = window.setTimeout(reOrder, 20000);
        }

        function reOrder() {

                alert("Reordering to be done..");
                $.get("../php/reOrderIndexes.php", function (data) {
                    alert("Reordering done successfully");
                });
        }
    });
}




