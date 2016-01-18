<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>

    <!-- Bootstrap CSS -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">


    <!--    added for bootstrap styling-->
    <script type="text/javascript" src="https://cdn.datatables.net/s/bs/dt-1.10.10,se-1.1.0/datatables.min.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">


    </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/default.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/jquery.tablesorter.min.js"></script>
    <script src="../js/loadYoutubeData.js"></script>
    <script src="../js/mainPageJS.js"></script>
    <script src="https://apis.google.com/js/plusone.js"></script>
    <script src="https://apis.google.com/js/client:plusone.js"></script>

    <style>

        .emailForm{
            border:1px solid grey;
            border-radius:10px;
            margin-top:20px;
        }
        textarea{
            height:120px;
        }

        form{
            padding-bottom:20px;
        }
    </style>
</head>


<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 emailForm">
            <h1>Insert into Player DB</h1>
            <form method="post" id="formname">
                <div class="form-group">
                    <label>Your key:</label>
                    <input type="text" name="keyid" class="form-control" placeholder="Youtube key" id="keyid"/>
                </div>
                <div class="form-group">
                    <label>AuthorName:</label>
                    <input type="text" name="name" class="form-control" placeholder="Author Name" id="authname"/>
                </div>
                <div class="form-group">
                    <label>AuthorID</label>
                    <input type="text" name="authorid" class="form-control" placeholder="Author ID" id="authid"/>
                </div>
                <div class="form-group">
                    <label>PlaylistName</label>
                    <input type="text" name="playlistName" class="form-control" placeholder="Playlist Name" id="playlistName"/>
                </div>
                <div class="form-group">
                    <label>Subject ID</label>
                    <input type="text" name="subjectID" class="form-control" placeholder="Subject ID" id="subjectID"/>
                </div>
                <div class="form-group">
                    <label>Number of records:</label>
                    <input type="text" name="maxrecords" class="form-control" placeholder="Max number of records" id="maxrecords"/>
                </div>
                <input type="button" class="btn btn-success btn-lg" value="Submit" id="submitbtn"/>
            </form>
        </div>
    </div>
</div>

</body>
</html