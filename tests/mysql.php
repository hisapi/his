<?php

echo "<pre>";
// Server in the this format: <computer>\<instance name> or 
// <server>,<port> when using a non default port number
$server = 'myserver.com';
// Connect to MYSQL
$link = mysqli_connect($server,"myusername","mypassword","hisdb");
if (!$link) {
    die('Something went wrong while connecting to MYSQL');
}
echo "HI\n";
print_r($link);
?>
