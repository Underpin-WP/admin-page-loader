<?php

namespace Underpin_Admin_Pages\Factories;

use Underpin\Abstracts\Admin_Section;
use Underpin\Traits\Instance_Setter;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Admin_Section_Instance extends Admin_Section {

	use Instance_Setter;

	public function __construct( $args ) {
		$this->set_values( $args );
		parent::__construct();
	}

}