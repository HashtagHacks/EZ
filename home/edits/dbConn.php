<?php

$mysqli = mysqli_connect("localhost","root","","edits");

if(!$mysqli)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>