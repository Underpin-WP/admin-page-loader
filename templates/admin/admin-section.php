<?php
/**
 * Admin Section Template
 *
 * @author: Alex Standiford
 * @date  : 12/21/19
 */

use Underpin_Admin_Pages\Abstracts\Admin_Section;
use Underpin\Abstracts\Settings_Field;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $template ) || ! $template instanceof Admin_Section ) {
	return;
}

?>
	<tr>
		<td colspan="2">
			<h3><?= $template->name ?></h3>
			<hr>
		</td>
	</tr>
<?php
foreach ( $template->fields as $key => $field ) {
	$field = $template->get_field( $key );

	if ( $field instanceof Settings_Field ) {
		echo $field->place( true );
	}
}
?>