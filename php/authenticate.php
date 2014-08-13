<?php

function saml_authenticate() {
	require 'lib/onelogin/saml.php';

  $user_settings = new Settings();
	$user_settings->x509certificate = get_option('onelogin_saml_certificate');

	if (!$user_settings->x509certificate) {
		echo "Invalid SAML certificate";
		return false;
	}

	$samlresponse = new SamlResponse($_POST['SAMLResponse']);
	$samlresponse->user_settings = $user_settings;
	
	if ($samlresponse->is_valid())
	{
		require_once(ABSPATH . WPINC . '/registration.php');
		require_once(ABSPATH . WPINC . '/pluggable.php');

		$email = $samlresponse->get_nameid();

		if ($email && email_exists($email)) 
		{	
			global $current_user;
			get_currentuserinfo();

			wp_set_current_user(email_exists($email));
			wp_set_auth_cookie(email_exists($email));
			do_action('wp_login', email_exists($email));
			wp_redirect("wp-admin/");
			exit;
		} else {
			echo "No such user";
			// no such user
			return false;
		}
	}
	else
	{
		// invalid saml response
		echo "Invalid SAML response";
		return false;
	}
}

?>