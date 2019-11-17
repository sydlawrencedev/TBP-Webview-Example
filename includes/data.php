<?php

/*
This is just a simple local file structure as the database, I'm sure in your production app you'd be using something much more advanced.

I've got three simple functions:

save_all_data - save all the data
get_data_for_psid - get the data for a specific psid
get_recent_user_data
*/

$file = './data/data.tmp';
$data = [];
if (file_exists($file)) {
	$data = (array) json_decode(file_get_contents($file));
}

// save the data to file
function save_all_data($data) {
	global $file;
	file_put_contents($file, json_encode($data));
}

// get the data from the psid
function get_data_for_psid($id) {
	global $data;
	if (isset($data[$id.""])) {
		return $data[$id];
	}
	foreach ($data as $key => $val) {
		if ($key === $id) {
			return $val;
		}
	}
	return false;
}

// get recent user data so that there is a timeout on the data after 5 minutes
function get_recent_user_data($psid) {
	$waitTimeout = 5 * 60;
	$item = get_data_for_psid($psid);
	if ($item) {
		if (isset($item->timestamp) && $item->timestamp > time() - $waitTimeout)
		return $item;
	}
	return false;
}