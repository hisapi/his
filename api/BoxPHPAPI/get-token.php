<?php

if (!isset($_GET['id'])) exit;
if (!isset($_GET['secret'])) exit;
if (!isset($_GET['redirect'])) exit;
if (!isset($_GET['code'])) exit;

include('BoxAPI.class.php'); 
$box=new Box_API($_GET['id'], $_GET['secret'], $_GET['redirect']);
if ($box)
{
    echo $box->get_token($_GET['code'], true);
}
