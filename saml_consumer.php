<?php
/*
Plugin Name: OneLogin SAML SSO
Plugin URI: http://support.onelogin.com/entries/383540
Description: Give users secure one-click access to WordPress from OneLogin. This SAML integration eliminates passwords and allows you to authenticate users against your existing Active Directory or LDAP server as well increase security using YubiKeys or VeriSign VIP Access, browser PKI certificates and OneLogin's flexible security policies. OneLogin is pre-integrated with thousands of apps and handles all of your SSO needs in the cloud and behind the firewall.
Author: OneLogin, Inc.
Version: 1.0.1
Author URI: http://www.onelogin.com
*/

	// check for posted SAML Response
	if (isset($_POST["SAMLResponse"])) {
		add_action('init','saml_authenticate_hook');
	}

	function saml_authenticate_hook()
	{
		require_once(ABSPATH . '/wp-content/plugins/onelogin-saml-sso/php/authenticate.php');
		saml_authenticate();
	}

	// add menu option for configuration
	add_action('admin_menu', 'onelogin_saml_menu');

	function onelogin_saml_menu() {
		require_once(ABSPATH . '/wp-content/plugins/onelogin-saml-sso/php/configuration.php');
		onelogin_saml_configuration();
	}

?>
