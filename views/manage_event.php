<!DOCTYPE html>
<html>
<head>
    <title><?php echo $event_name; ?></title>
    <meta charset="utf-8"/>
</head>
<body>
<h1><?php echo $event_name; ?></h1>
<p>Upload pictures to share with your friends !</p>
<?php
if(isset($wrong_file_type_zip) && $wrong_file_type_zip == true) {
    echo "<div class='error'>";
    echo "One or more files in the archives are not pictures";
    echo "</div>";
}
?>
<form action="./<?php echo $url ?>" method="post" enctype="multipart/form-data">
    <label for="filename">File : </label><input type="file" name="filename" id="filename"/>
    <input type="hidden" value="<?php echo $url; ?>" name="event">
    <input type="submit" value="Upload"/>
</form>
<p><a href="http://d1d0vil9fyedp6.cloudfront.net/events/<?php echo $url; ?>/<?php echo $url; ?>.zip">Click here</a> to download
a zip containing all the pictures</p>
</body>
</html>
