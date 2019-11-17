<?php
/*
The webhook from the bot platform calls this url and expects a json response
More info: https://github.com/TheBotPlatform/The-Bot-Platform-API-docs
*/

// require my "database" functions
require_once("includes/data.php");

// get the raw data from the HTTP headers of the request
$input = json_decode(file_get_contents("php://input"));

// Within The Bot Platform you need to setup two messages, one for when a user has successfully completed the form, and one for when they haven't
// workplace test bot
$messageIds = array(
	"form_success" => "92581",
	"form_error" => "92582"
);

// messenger test bot
$messageIds = array(
	"form_success" => "92568",
	"form_error" => "92570"
);


// Within The Bot Platform you also need to create two attributes, in the platform itself, you need to create them with the names without a prceeding $, however, when used in either the webhooks, or in the platform itself, you need to specify them with a preceeding $ 
$attributes = array(
	"switch" => "\$switch", // need to escape the dollar sign so that it isn't used a variable
	"text" => "\$text" // need to escape the dollar sign so that it isn't used a variable
);

// useful for testing
$test = false;
if (isset($_GET["test"])) {
	$test = true;
}

// if it's been triggered by a message
if (isset($input->item) || $test) {
	$psid = $input->fbuser->fbid;
	if ($test) {
		$psid = "512349862853940";
	}

	// if there is recent data about the person
	if ($item = get_recent_user_data($psid)) {
		// construct a response to the person
		$response = array(
		    "recipient" => array(
				"id" => $psid
		    ),
		    // set the user attributes
		    "set" => array(
		    	$attributes["switch"] => $item->switch,
		    	$attributes["text"] => $item->text
		    ),
		    // send a success message built in TBP
		    "message" => array(
				"id" => "@BP:MESSAGE:".$messageIds["form_success"]
		    )
		);
	}
	// no data stored on the person
	else {
		// send the form_error message back to the person
		$response = array(
		    "recipient" => array(
				"id" => $psid
		    ),
		    "message" => array(
				"id" => "@BP:MESSAGE:".$messageIds["form_error"]
		    )
		);
	}
}
// this is just the check The Bot Platform does on the URL to make sure it's valid
else {
  $response = array();
}

// respond as json
echo json_encode($response);