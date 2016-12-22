<!DOCTYPE html>
<html>
<head>
    <title>Event</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container bg-1">
    <div class="row">
        <div class="col-sm-4">
            <div class="img"><img src="style/logo.png" alt="logo" class="img-responsive"></div>
        </div>
        <div class="col-sm-8">
            <p>Share your moments with the ones who deserve it</p>
        </div>
    </div>
</div>


<div class="container bg-2">
<form action="." method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="event_name">Event name : </label>
    <input type="text" name="event_name" id="event_name"/>
    <input type="submit" value="create"/>
    </div>
</form>
</div>
</body>
</html>
