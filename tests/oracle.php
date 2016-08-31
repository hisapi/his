<?php

$conn = oci_connect('hisdb', 'yourpassword', 'yourwebsite.com/hisdb');
print_r(oci_error());

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$s = oci_parse($conn, 'select table_name from all_tables');
oci_execute($s);
oci_fetch_all($s, $res);
echo "<pre>\n";
var_dump($res);
echo "</pre>\n";



echo "done";

?>
