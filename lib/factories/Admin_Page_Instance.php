<?php
namespace Underpin_Admin_Pages\Factories;

use Underpin\Traits\Instance_Setter;
use Underpin_Admin_Pages\Abstracts\Admin_Page;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}




class Admin_Page_Instance extends Admin_Page {
use Instance_Setter;

	/**
	 * Admin_Page_Instance constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args = [] ) {
		$this->set_values( $args );
		parent::__construct();
	}
}