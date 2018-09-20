<?php

$conn = mysqli_connect("localhost", "root", "root", "fill_the_field");

if(!$conn)
    die("Connection failed: " . mysqli_connect_error());

$season = 1;