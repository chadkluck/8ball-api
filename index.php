<?php
// api returning json data

require_once __DIR__."/custom/inc.php"; // this is required to be placed at start of execution - it loads the config, app vars, core app functions, and init

function generateResponse() {

	// randomly pick a response
	
	$responses = array();
	$responses = [ "It is certain",
				  "It is decidedly so",
				  "Without a doubt",
				  "Yes definitely",
				  "You may rely on it",
				  "As I see it, yes",
				  "Most likely",
				  "Outlook good",
				  "Yes",
				  "Signs point to yes",
				  "Reply hazy try again",
				  "Ask again later",
				  "Better not tell you now",
				  "Cannot predict now",
				  "Concentrate and ask again",
				  "Don't count on it",
				  "My reply is no",
				  "My sources say no",
				  "Outlook not so good",
				  "Very doubtful"
				];

	$json = array();
	$json['item'] = $responses[array_rand($responses)];
	
	return $json;
	
}

/* **********************************************
 *  START
 */

// begin JSON output

if(isApprovedOrigin()) {

	$json = generateResponse();

	if(!debugOn()) {

		httpReturnHeader(getCacheExpire("api"), getRequestOrigin(), "application/json");
		echo json_encode($json);

	} else {
		echo "<h3>JSON RAW</h3>";
		echo "<p>";
		echo json_encode($json);
		echo "</p>";
		echo "<h3>JSON FORMATTED</h3>";
		echo "<pre>";
		print_r($json);
		echo "</pre>";
		appExecutionEnd();
	}

} else {
	echo (getRequestOrigin()." not an allowed origin");
}

?>