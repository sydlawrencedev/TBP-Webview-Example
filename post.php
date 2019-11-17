<?php
/*
The webview posts the form submission to this url
*/

// require my "database" functions
require_once('includes/data.php');

// WARNING! In production should be a lot of checks on post data to make sure it's xss or similar
$p = $_POST;
$p['timestamp'] = time();
$psid = $_POST['psid'];

// save the data against the psid
$data[$psid] = $p;
save_all_data($data);

// send back a success message
$p['success'] = 1;
echo json_encode($p);


