<?php

$this->require_acl ('admin', $this->app);

$page->layout = 'admin';
$page->title = __ ('CloudFront Settings');

$form = new Form ('post', $this);

$form->data = Appconf::cloudfront ('CloudFront');

echo $form->handle (function ($form) {
	$merged = Appconf::merge ('cloudfront', array (
		'CloudFront' => $_POST
	));
	
	if (! Ini::write ($merged, 'conf/app.cloudfront.' . ELEFANT_ENV . '.php')) {
		printf (
			'<p>%s</p>',
			__ ('Unable to save changes. Check your permissions and try again.')
		);
		return;
	}
	
	$form->controller->add_notification (__ ('Settings saved.'));
	$form->controller->redirect ('/cloudfront/settings');
});
