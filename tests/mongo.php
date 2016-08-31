<?php

$m = new Mongo("mongodb://username:password@myserver.comcom:45637/mydatabase");
$collections = $m->selectDB("mydatabase")->getCollectionNames();
var_dump($collections);

?>
