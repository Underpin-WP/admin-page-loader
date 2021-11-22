<?php

use Underpin\Abstracts\Underpin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add this loader.
Underpin::attach( 'setup', new \Underpin\Factories\Observer( 'admin_pages', [
	'update' => function ( Underpin $plugin ) {
		if ( ! defined( 'UNDERPIN_ADMIN_PAGES_ROOT_DIR' ) ) {
			define( 'UNDERPIN_ADMIN_PAGES_ROOT_DIR', plugin_dir_path( __FILE__ ) );
		}

		require_once( UNDERPIN_ADMIN_PAGES_ROOT_DIR . 'lib/abstracts/Admin_Page.php' );
		require_once( UNDERPIN_ADMIN_PAGES_ROOT_DIR . 'lib/abstracts/Admin_Section.php' );
		require_once( UNDERPIN_ADMIN_PAGES_ROOT_DIR . 'lib/factories/Admin_Page_Instance.php' );
		require_once( UNDERPIN_ADMIN_PAGES_ROOT_DIR . 'lib/factories/Admin_Section_Instance.php' );
		$plugin->loaders()->add( 'admin_pages', [
			'name'        => 'Admin Pages',
			'description' => 'Makes it possible to add custom admin pages',
			'instance'    => 'Underpin_Admin_Pages\Abstracts\Admin_Page',
			'default'     => 'Underpin_Admin_Pages\Factories\Admin_Page_Instance',
		] );
	},
] ) );
