<?php

/**
 * Get the local file path and convert it to a CloudFront link.
 */

if (! $this->internal) {
	// No direct linking to /cloudfront/some/file.jpg
	exit;
}

$file = join ('/', $this->params);

if (strpos ($file, '..') !== false) {
	// No requests containing .. in the path
	exit;
}

// Pass it on (first request fetches and stores the file)
echo 'http://' . $appconf['CloudFront']['domain'] . '/' . $file;

?>