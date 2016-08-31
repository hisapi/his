<?php


// Server in the this format: <computer>\<instance name> or 
// <server>,<port> when using a non default port number
$server = 'yourserver.com';
// Connect to MSSQL
$link = mssql_connect($server, 'hisdb', 'yourpasswordhere');
if (!$link) {
    die('Something went wrong while connecting to MSSQL');
}
echo "HI";
print_r($link);
?>
