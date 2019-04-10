<? php

	function custom_settings_page_setup() {
		add_settings_section( 'section', 'SN Settings', null, 'theme-options' );
		add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section' );
		add_settings_field( 'github', 'Github URL', 'setting_github', 'theme-options', 'section' );

		register_setting('section', 'facebook');
		register_setting('section', 'github');
	}

	add_action( 'admin_init', 'custom_settings_page_setup' );