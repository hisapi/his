<?php

$dbconn = pg_connect("host=ec2-23-20-225-122.compute-1.amazonaws.com
 dbname=test user=test password=pgtest1")
    or die('Could not connect: ' . pg_last_error());


// Performing SQL query
$query = 'SELECT datname FROM pg_database WHERE datistemplate = false;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table>\n";
print_r($result);
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);
?>
