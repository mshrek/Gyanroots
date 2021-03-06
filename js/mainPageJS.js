/**
 * Created by srikanthmannepalle on 12/28/15.
 */

//    Scrollbar addition section
if (typeof jQuery == "undefined") {
    console.log('Jquery is not loaded');
} else {
    $(document).ready(function () {

            //clicked video sorted_id
            var clickedId;
            var sessionSubjectID;
            var searchString = 'Programming';
            //Assigning click ids and rendering mainpageoutput as per subject id
            $("#Prog1001").click(function(){
                sessionSubjectID=1001;
                setSessionSubjectID(sessionSubjectID);
                searchString = "Java Books";
                waitingDialog.show();
                setTimeout(function () {waitingDialog.hide();}, 4500);
                return false;
            });

            $("#Prog1002").click(function(){
                sessionSubjectID=1002;
                setSessionSubjectID(sessionSubjectID);
                searchString = "C Books";
                waitingDialog.show();
                setTimeout(function () {waitingDialog.hide();}, 4500);
                return false;
            });

            $("#Prog1003").click(function(){
                sessionSubjectID=1003;
                setSessionSubjectID(sessionSubjectID);
                searchString = "Python Books";
                waitingDialog.show();
                setTimeout(function () {waitingDialog.hide();}, 4500);
                return false;
            });

            //Star rating section
            //audio
            var $star_ratingA = $('.star-ratingA .fa');
            var SetRatingStarA = function (audioRatingID) {
                console.log("passed param = "+audioRatingID);
                $selectedAudioObj=$('#'+audioRatingID + '.star-ratingA .fa');
                console.log("passed param class = "+$selectedAudioObj.attr("class"));
                return $selectedAudioObj.each(function (index,ele) {
                    if (parseInt($selectedAudioObj.siblings('input.rating-value').val()) >= parseInt($(ele).data('rating'))) {
                        return $(ele).removeClass('fa-star-o').addClass('fa-star');
                    } else {
                        return $(ele).removeClass('fa-star').addClass('fa-star-o');
                    }
                });
            };
            //$star_ratingA.on('click', function () {
            $('body').delegate($star_ratingA,'click',function(){
                console.log($(this).data('rating'));
                $(event.target).siblings('input.rating-value').val($(event.target).data('rating'));
                return SetRatingStarA($(event.target).closest('div').attr('id'));
            });// end of audio .checking the clicked value and setting number of stars according to that

            //video
            var $star_ratingV = $('.star-ratingV .fa');
            var SetRatingStarV = function (videoRatingID) {
                console.log("passed param = "+videoRatingID);
                $selectedVideoObj=$('#'+videoRatingID + '.star-ratingV .fa');
                console.log("passed param class = "+$selectedVideoObj.attr("class"));
                return $selectedVideoObj.each(function (index,ele) {
                    if (parseInt($selectedVideoObj.siblings('input.rating-value').val()) >= parseInt($(ele).data('rating'))) {
                        return $(ele).removeClass('fa-star-o').addClass('fa-star');
                    } else {
                        return $(ele).removeClass('fa-star').addClass('fa-star-o');
                    }
                });
            };

            $('body').delegate($star_ratingV,'click',function(){
                console.log($(this).data('rating'));
                $(event.target).siblings('input.rating-value').val($(event.target).data('rating'));
                return SetRatingStarV($(event.target).closest('div').attr('id'));
            });// end of video .checking the clicked value and setting number of stars according to that


            //content
            var $star_ratingC = $('.star-ratingC .fa');
            var SetRatingStarC = function (contentRatingID) {
                console.log("passed param = "+contentRatingID);
                $selectedContentObj=$('#'+contentRatingID + '.star-ratingC .fa');
                console.log("passed param class = "+$selectedContentObj.attr("class"));
                return $selectedContentObj.each(function (index,ele) {
                    if (parseInt($selectedContentObj.siblings('input.rating-value').val()) >= parseInt($(ele).data('rating'))) {
                        return $(ele).removeClass('fa-star-o').addClass('fa-star');
                    } else {
                        return $(ele).removeClass('fa-star').addClass('fa-star-o');
                    }
                });
            };

            $('body').delegate($star_ratingC,'click',function(){
                console.log($(this).data('rating'));
                $(event.target).siblings('input.rating-value').val($(event.target).data('rating'));
                return SetRatingStarC($(event.target).closest('div').attr('id'));
            });// end of content. checking the clicked value and setting number of stars according to that

            //selects first row as default after initialization
            function selectFirstRow(playlistObject) {
                console.log("Play list id = " + playlistObject.attr("id"));
                clickedId=1;
                playlistID=playlistObject.attr("id");
                resetRatingValues(playlistID);
                fetchfromMysqlDatabase(clickedId,playlistID);
            }

            //assigns id on row click
            $('body').delegate('.sendIdOnClick', 'click', function () {
                clickedId = $(this).closest('tr').find('td:first').text();
                playListID=$(this).closest('table').attr('id');
                resetRatingValues(playListID);
                fetchfromMysqlDatabase(clickedId,playListID,sessionSubjectID);
            });

             //to set the favicon values , sends complete id e.g favicon1001001
            $('body').delegate('.favicon','click',function(){
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
            });

            //Section for capturing user clicked values and storing them in db. This is ok
            //audiorating check , sends complete id e.g audioRating1001001
            $('body').delegate('.audioRating','click',function(){
                audioRatingID=$(this).attr("id");
                console.log("id ="+audioRatingID);
                valueA=parseInt($(event.target).data('rating'));
                setRatingValue("audio_rating",valueA,clickedId,audioRatingID);
            });

            //videorating check , sends complete id e.g audioRating1001001
            $('body').delegate('.audioRating','click',function(){
                videoRatingID=$(this).attr("id");
                console.log("id ="+videoRatingID);
                valueV=parseInt($(event.target).data('rating'));
                setRatingValue("video_rating",valueV,clickedId,videoRatingID);
            });

            //contentrating check, sends complete id e.g contentRating1001001
            $('body').delegate('.contentRating','click',function(){
                contentRatingID=$(this).attr("id");
                console.log("id ="+contentRatingID);
                valueC=parseInt($(event.target).data('rating'));
                setRatingValue("content_rating",valueC,clickedId,contentRatingID);
            });

            //warning sign with row click handled across pagination
            $('body').delegate('.warning', 'click', function (){
                //$(this).css("color", "#FF3300");
                $clickedElement=$(this);
                playListID=$(this).closest('table').attr('id'); //slice first 2 letters for authorid from playListID of table
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
                //pick row id
                clickedID= parseInt($(this).closest('tr').find('td:first').html());
                console.log("Row selected = "+ clickedID);
                console.log("warning symbol belongs to playList id ="+playListID);
                resetRatingValues(playListID);
                reportBroken(clickedID,brokenVal,playListID);
            })

            //onclick event , sends selected id of the row to the fetchvideourl.php script. This is ok
            function fetchfromMysqlDatabase(onClickId,playlistID) {
                authid=playlistID.substr(0,3);
                subjectID=playlistID.substr(3,7);
                console.log("fetched auth id = "+authid);
                console.log("fetched subject id = "+subjectID);
                //for right section iframe
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: {"id": onClickId,"authid":authid,"subjectID":subjectID},
                    url: "../php/fetchVideoURL.php",
                    cache: false,
                    beforeSend: function () {
                        $('#videoPreview'+playlistID).html('<iframe src="http://www.youtube.com/embed/" width="100%" height="289px" frameborder="0" allowfullscreen></iframe>');
                        console.log('current authid ='+authid+" and subject id = "+subjectID);
                    },
                    success: function (htmldata) {
                        $('#videoPreview'+playlistID).html(htmldata);
                    }
                });

                //for right side of the dashboard
                $.ajax({
                    type: "POST",
                    dataType: "text",
                    data: {"id": onClickId,"authid":authid,"subjectID":subjectID},
                    url: "../php/rightDashboardStats.php",
                    cache: false,
                    beforeSend: function () {
                        $('#viewcount'+ playlistID).html('NA');
                    },
                    success: function (data) {
                        console.log('right dashboard stats for current authid = '+authid+" and subjectID = "+subjectID);
                        dataVal = data.split(",");
                        $('#viewcount'+ playlistID).html(dataVal[0]);
                        //starArr=[$star_ratingA,$star_ratingV,$star_ratingC];
                        starAbyIDString='#audioRating'+playlistID+' .fa';
                        starVbyIDString='#videoRating'+playlistID+' .fa';
                        starCbyIDString='#contentRating'+playlistID+' .fa';
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
                            $('#favicon'+authid+''+subjectID).css("color","#cc433d");
                        }

                    }
                });
            }

            //function for rgb to hex code conversion
            function rgbToHex(a){
                a=a.replace(/[^\d,]/g,"").split(",");
                return"#"+((1<<24)+(+a[0]<<16)+(+a[1]<<8)+ +a[2]).toString(16).slice(1)
            }

            //For setting the int values for audio,video,content and fav
            function setRatingValue(ratingfor,value,clickedId,objectID){
                var numberPattern = /\d+/g;
                var extractedAuthID=(objectID.match(numberPattern)[0]).substr(0,3);
                var subjectID = (objectID.match(numberPattern)[0]).substr(3,6);
                console.log("TAG1 : Extracted auth id ="+extractedAuthID+" with value = "+value+"  rating for ="+ratingfor+" and element ID="+clickedId+" and subjectID ="+subjectID);
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: {"ratingfor":ratingfor,"value":value,"elementID":clickedId,"authid":extractedAuthID,"subjectID":subjectID},
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
            function reportBroken(clickedId,brokenVal,playListID){
                authid = playListID.substr(0,3);
                subjectID = playListID.substr(3,7);
                console.log("Broken value for "+authid+" = "+brokenVal);
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: {"elementID":clickedId,"value":brokenVal,"authid":authid,"subjectID":subjectID},
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

            function setSessionSubjectID(subjectID) {
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: {"subjectID": subjectID},
                    url: "../php/mainpageAutogen.php",
                    cache: false,
                    beforeSend: function () {
                        $("#mainpageAutogen").html("");
                    },
                    success: function (htmldata) {
                        $("#mainpageAutogen").html(htmldata);
                        $('.playList').DataTable({
                            select: {
                                style: 'os'
                            },
                            "scrollY": "260px",
                            "deferRender": true,
                            "scrollCollapse": true,
                            "fnInitComplete": function() {
                                selectFirstRow($(this));
                            },
                            "paging": true
                        });
                    }
                });
            }

            //Backbutton handling
            $("#aboutBack").on('click',function () {
                location.href = '../php/Landingpage.php';
            });

            //Coming soon selector
            var commingSoonSelector=$('[id="scripting"],[id="dbms"],[id="bigdata"],[id="security"],[id="gaming"],[id="webdevelopment"],[id="setups"],' +
                '[id="automation"],[id="testing"],[id="expertview"],[id="certifications"]')

            $(commingSoonSelector).hover(function (){
                $(this).next("span").find('img').show();
            },function (){
                $(this).next("span").find('img').hide();
            })
            //end of Coming soon selector

            /*support functions
             */
        }//end of ready function
    );//end of ready function


    //Loading window script
    var waitingDialog = waitingDialog || (function ($) {
            'use strict';

            // Creating modal dialog's DOM
            var $dialog = $(
                '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
                '<div class="modal-dialog modal-m">' +
                '<div class="modal-content">' +
                '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
                '<div class="modal-body">' +
                '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
                '</div>' +
                '</div></div></div>');

            return {
                /**
                 * Opens our dialog
                 * @param message Custom message
                 * @param options Custom options:
                 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
                 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
                 */
                show: function (message, options) {
                    // Assigning defaults
                    if (typeof options === 'undefined') {
                        options = {};
                    }
                    if (typeof message === 'undefined') {
                        message = 'Loading the webpage ...';
                    }
                    var settings = $.extend({
                        dialogSize: 'm',
                        progressType: '',
                        onHide: null // This callback runs after the dialog was hidden
                    }, options);

                    // Configuring dialog
                    $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
                    $dialog.find('.progress-bar').attr('class', 'progress-bar');
                    if (settings.progressType) {
                        $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
                    }
                    $dialog.find('h3').text(message);
                    // Adding callbacks
                    if (typeof settings.onHide === 'function') {
                        $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                            settings.onHide.call($dialog);
                        });
                    }
                    // Opening dialog
                    $dialog.modal();
                },
                /**
                 * Closes dialog
                 */
                hide: function () {
                    $dialog.modal('hide');
                }
            };

        })(jQuery);
}//end of else