<?php

/**
 * Get the local file path and convert it to a CloudFront link.
 *
 * Usage:
 *
 *     <img src="{! cloudfront/path/to/a/file.jpg !}" />
 */

if (! $this->internal) {
	// No direct linking to /cloudfront/some/file.jpg
	exit;
}

$file = join ('/', $this->params);

if (strpos ($file, '..') !== false) {
	// No requests containing .. in the path
	return;
}

// Pass it on (first request fetches and stores the file)
echo Appconf::cloudfront ('CloudFront', 'protocol') . '://' . Appconf::cloudfront ('CloudFront', 'domain') . '/' . $file;
