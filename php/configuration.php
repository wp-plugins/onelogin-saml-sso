<?php

	function onelogin_saml_configuration() {	
		$current_screen = add_submenu_page( 'options-general.php', 'SSO/SAML Settings', 'SSO/SAML Settings', 'manage_options', 'onelogin_saml_configuration', 'onelogin_saml_configuration_render');
		add_settings_section('certificates', 'Insert the X.509 Certificate from your OneLogin account. ', 'plugin_section_text', 'onelogin_saml_configuration');
		add_settings_field('onelogin_saml_certificate', 'X.509 Certificate', 'plugin_setting_string', 'onelogin_saml_configuration', 'certificates');
		register_setting('onelogin_saml_configuration','onelogin_saml_certificate');

		add_contextual_help($current_screen,
			'<p>' . __('Use OneLogin SAML-based single sign-on for password-free signon into WordPress') . '</p>' .
			'<p><strong>' . __('For more information:') . '</strong></p>' .
			'<p>' . __('<a href="http://support.onelogin.com/entries/383540" target="_blank">Setup instructions</a>') . '</p>' .
			'<p>' . __('<a href="http://onelogin.com/" target="_blank">OneLogin, Inc.</a>') . '</p>'
		);
	}

	function plugin_setting_string() {
		echo '<textarea name="onelogin_saml_certificate" id="onelogin_saml_certificate" style="width:600px; height:220px; font-size:12px; font-family:courier,arial,sans-serif;">';
		echo get_option('onelogin_saml_certificate');
		echo '</textarea>';
	}
	
	function plugin_section_text() {}

	function onelogin_saml_configuration_render() {
		$title = "OneLogin SSO/SAML Settings";
		?>
			<div class="wrap">
				<?php screen_icon(); ?>
				<h2><?php echo esc_html( $title ); ?></h2>
				<form action="options.php" method="post">

					<?php settings_fields('onelogin_saml_configuration'); ?>
					<?php do_settings_sections('onelogin_saml_configuration'); ?>

					<p class="submit">
						<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
					</p>

				</form>
			</div>
		<?php
	}

?>
