/**
 * Created by srikanthmannepalle on 12/28/15.
 */

//    Scrollbar addition section
if (typeof jQuery == "undefined") {
} else {
    $(document).ready(function () {
            //clicked video sorted_id
            var clickedId;
            //Star rating section

            //audio
            var $star_ratingA = $('.star-ratingA .fa');
            var SetRatingStarA = function (audioRatingID) {
                console.log("passed param ="+audioRatingID);
                $selectedAudioObj=$('#'+audioRatingID + '.star-ratingA .fa');
                console.log("passed param class ="+$selectedAudioObj.attr("class"));
                return $selectedAudioObj.each(function () {
                    if (parseInt($selectedAudioObj.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                        return $(this).removeClass('fa-star-o').addClass('fa-star');
                    } else {
                        return $(this).removeClass('fa-star').addClass('fa-star-o');
                    }
                });
            };
            $star_ratingA.on('click', function () {
                console.log($(this).data('rating'));
                $star_ratingA.siblings('input.rating-value').val($(this).data('rating'));
                return SetRatingStarA($(this).closest('div').attr('id'));
            });// end of audio .checking the clicked value and setting number of stars according to that


            //video
            var $star_ratingV = $('.star-ratingV .fa');
            var SetRatingStarV = function (videoRatingID) {
                console.log("passed param ="+videoRatingID);
                $selectedVideoObj=$('#'+videoRatingID + '.star-ratingV .fa');
                console.log("passed param class ="+$selectedVideoObj.attr("class"));
                return $selectedVideoObj.each(function () {
                    if (parseInt($selectedVideoObj.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                        return $(this).removeClass('fa-star-o').addClass('fa-star');
                    } else {
                        return $(this).removeClass('fa-star').addClass('fa-star-o');
                    }
                });
            };
            $star_ratingV.on('click', function () {
                console.log($(this).data('rating'));
                $star_ratingV.siblings('input.rating-value').val($(this).data('rating'));
                return SetRatingStarV($(this).closest('div').attr('id'));
            });// end of video .checking the clicked value and setting number of stars according to that


            //content
            var $star_ratingC = $('.star-ratingC .fa');
            var SetRatingStarC = function (contentRatingID) {
                console.log("passed param ="+contentRatingID);
                $selectedContentObj=$('#'+contentRatingID + '.star-ratingC .fa');
                console.log("passed param class ="+$selectedContentObj.attr("class"));
                return $selectedContentObj.each(function () {
                    if (parseInt($selectedContentObj.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                        return $(this).removeClass('fa-star-o').addClass('fa-star');
                    } else {
                        return $(this).removeClass('fa-star').addClass('fa-star-o');
                    }
                });
            };
            $star_ratingC.on('click', function () {
                console.log($(this).data('rating'));
                $star_ratingC.siblings('input.rating-value').val($(this).data('rating'));
                return SetRatingStarC($(this).closest('div').attr('id'));
            });// end of content. checking the clicked value and setting number of stars according to that


            //Add scrollbar and initialize the data table
            $('.playList').DataTable({
                select: {
                    style: 'os'
                },
                "scrollY": "260px",
                "scrollCollapse": true,
                "fnInitComplete": function() {
                    selectFirstRow($(this));
                },
                "paging": true
            });

            //selects first row as default after initialization
            function selectFirstRow(playlistObject) {
                console.log("Play list id ="+playlistObject.attr("id"));
                clickedId=1;
                playlistID=playlistObject.attr("id");
                resetRatingValues(playlistID);
                fetchfromMysqlDatabase(clickedId,playlistID);
            }

            //assigns id on row click
            $('body').delegate('.sendIdOnClick', 'click', function () {
                clickedId = $(this).closest('tr').find('td:first').text();
                onClickAuthid=$(this).closest('table').attr('id');
                resetRatingValues(onClickAuthid);
                fetchfromMysqlDatabase(clickedId,onClickAuthid);
            });

            //warning sign with row click handled across pagination
            $('body').delegate('.warning', 'click', function (){
                //$(this).css("color", "#FF3300");
                $clickedElement=$(this);
                onClickAuthid=$(this).closest('table').attr('id');
                getcolor=rgbToHex($(this).css("color"));
                if(getcolor=="#676a6c")
                {
                    setColor("#cc433d");
                    brokenVal=1
                }
                else
                {
                    setColor("#676a6c");
                    brokenVal=0;
                }

                function setColor(colorcode){
                    $clickedElement.css("color",colorcode);
                }
                warningId=($(this).closest('tr').find('span:last').attr('id')).split('g')[1];
                console.log("warning symbol belongs to author id ="+onClickAuthid);
                resetRatingValues(onClickAuthid);
                reportBroken(warningId,brokenVal,onClickAuthid);
            })

            //onclick event , sends selected id of the row to the fetchvideourl.php script. This is ok
            function fetchfromMysqlDatabase(onClickId,authid) {
                console.log("fetched auth id ="+authid);
                //for right section iframe
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: {"id": onClickId,"authid":authid},
                    url: "../php/fetchVideoURL.php",
                    cache: false,
                    beforeSend: function () {
                        $('#videoPreview'+authid).html('<iframe src="http://www.youtube.com/embed/" width="100%" height="289px" frameborder="0" allowfullscreen></iframe>');
                        //$('#videoPreview1002').html('<iframe src="http://www.youtube.com/embed/" width="100%" height="289px" frameborder="0" allowfullscreen></iframe>');
                        console.log('current authid ='+authid);
                        //alert(onClickId);
                    },
                    success: function (htmldata) {
                        $('#videoPreview'+authid).html(htmldata);
                    }
                });

                //for right side of the dashboard
                $.ajax({
                    type: "POST",
                    dataType: "text",
                    data: {"id": onClickId,"authid":authid},
                    url: "../php/rightDashboardStats.php",
                    cache: false,
                    beforeSend: function () {
                        $('#viewcount'+authid).html('NA');
                    },
                    success: function (data) {
                        console.log('tag current authid ='+authid);
                        dataVal = data.split(",");
                        $('#viewcount'+authid).html(dataVal[0]);
                        //starArr=[$star_ratingA,$star_ratingV,$star_ratingC];
                        starAbyIDString='#audioRating'+authid+' .fa';
                        starVbyIDString='#videoRating'+authid+' .fa';
                        starCbyIDString='#contentRating'+authid+' .fa';
                        $starAbyID=$(starAbyIDString);
                        $starVbyID=$(starVbyIDString);
                        $starCbyID=$(starCbyIDString);
                        starArr=[$starAbyID,$starVbyID,$starCbyID];

                        for(j=0;j<starArr.length;j++){
                            starArr[j].siblings('input.rating-value').val(dataVal[j+1]);
                            starArr[j].each(function () {
                                if (parseInt(starArr[j].siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                                    $(this).removeClass('fa-star-o').addClass('fa-star');
                                }
                            });
                        }
                        favrating=dataVal[4];
                        if(favrating==1)
                        {
                            $('#favicon'+authid).css("color","#cc433d");
                        }

                    }
                });
            }

            //Section for capturing user clicked values and storing them in db. This is ok
            $('.audioRating').on('click',function(){
                audioRatingID=$(this).attr("id");
                console.log("id ="+audioRatingID);
                valueA=parseInt($star_ratingA.siblings('input.rating-value').val());
                setRatingValue("audio_rating",valueA,clickedId,audioRatingID);
            })

            $('.videoRating').on('click',function(){
                videoRatingID=$(this).attr("id");
                console.log("id ="+videoRatingID);
                valueV=parseInt($star_ratingV.siblings('input.rating-value').val());
                setRatingValue("video_rating",valueV,clickedId,videoRatingID);
            })

            $('.contentRating').on('click',function(){
                contentRatingID=$(this).attr("id");
                console.log("id ="+contentRatingID);
                valueC=parseInt($star_ratingC.siblings('input.rating-value').val());
                setRatingValue("content_rating",valueC,clickedId,contentRatingID);
            })

            //to set the favicon values..all OK
            $('.favicon').on('click',function(){
                faviconID=$(this).attr("id");
                console.log("favicon with id ="+faviconID+" is clicked");
                getcolor=rgbToHex($('#'+faviconID).css("color"));

                if(getcolor=="#676a6c") {
                    setColor("#cc433d");
                    favVal=1;
                }
                else {
                    setColor("#676a6c");
                    favVal=0;
                }

                function rgbToHex(a){
                    a=a.replace(/[^\d,]/g,"").split(",");
                    return"#"+((1<<24)+(+a[0]<<16)+(+a[1]<<8)+ +a[2]).toString(16).slice(1)
                }
                function setColor(colorcode){
                    $('#'+faviconID).css("color",colorcode);
                }
                setRatingValue("fav_rating_flag",favVal,clickedId,faviconID);
            })

            //function for rgb to hex code conversion
            function rgbToHex(a){
                a=a.replace(/[^\d,]/g,"").split(",");
                return"#"+((1<<24)+(+a[0]<<16)+(+a[1]<<8)+ +a[2]).toString(16).slice(1)
            }

            //For setting the int values for audio,video,content and fav
            function setRatingValue(ratingfor,value,clickedId,objectID){
                var numberPattern = /\d+/g;
                var extractedAuthID=objectID.match(numberPattern)[0];
                console.log("TAG1 : Extracted auth id ="+extractedAuthID+" with value = "+value+"  rating for ="+ratingfor+" and element ID="+clickedId);
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: {"ratingfor":ratingfor,"value":value,"elementID":clickedId,"authid":extractedAuthID},
                    url: "../php/ratingFavs.php",
                    cache: false,
                    beforeSend: function () {
                        //$('#viewcount').html('NA');
                        //alert(onClickId);
                    },
                    success: function (htmldata) {
                        //$('#viewcount').html(htmldata);
                    }
                });
            }

            //resetting star values and favicon color on video change. this is ok
            function resetRatingValues(playlistID){
                $('#favicon'+playlistID).css("color","#676a6c");
                console.log("resetting value for id ="+playlistID);
                //startArr=[$star_ratingA,$star_ratingV,$star_ratingC];
                starAbyIDString='#audioRating'+playlistID+' .fa';
                starVbyIDString='#videoRating'+playlistID+' .fa';
                starCbyIDString='#contentRating'+playlistID+' .fa';
                $starAbyID=$(starAbyIDString);
                $starVbyID=$(starVbyIDString);
                $starCbyID=$(starCbyIDString);
                starArr=[$starAbyID,$starVbyID,$starCbyID];

                for(i=0;i<starArr.length;i++) {
                    item = starArr[i];
                    item.each(function () {
                        $(this).removeClass('fa-star');
                        $(this).addClass('fa-star-o');
                    })
                }
            }

            //For setting reportbroken int value..all OK
            function reportBroken(clickedId,brokenVal,authid){
                console.log("Broken value for "+authid+" = "+brokenVal);
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: {"elementID":clickedId,"value":brokenVal,"authid":authid},
                    url: "../php/linkBroken.php",
                    cache: false,
                    beforeSend: function () {
                        //$('#viewcount').html('NA');
                        //alert(onClickId);
                    },
                    success: function (htmldata) {
                        //$('#viewcount').html(htmldata);
                    }
                });
            }
            /*support functions
             */

        }//end of ready function
    );//end of ready function
}//end of else