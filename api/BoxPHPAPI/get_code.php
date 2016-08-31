<?php

if (!isset($_GET['id'])) exit;
if (!isset($_GET['secret'])) exit;
if (!isset($_GET['redirect'])) exit;

$url = "https://app.box.com/api/oauth2/authorize?response_type=code&client_id=".$_GET['id'];//."&state=security_token%3DKnhMJatFipTAnM0nHlZA";

header("Location: $url");
exit;