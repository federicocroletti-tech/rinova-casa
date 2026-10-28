<?php
/**
 * Prevent smoke-test messages from leaving the CI runner.
 */
add_filter(
	'pre_wp_mail',
	static function ( $return, $atts ) {
		if ( null !== $return ) {
			return $return;
		}

		$capture_file = getenv( 'RINOVA_TEST_MAIL_CAPTURE' );
		if ( ! $capture_file ) {
			return false;
		}

		$captured = file_put_contents( $capture_file, wp_json_encode( $atts ) );
		return false === $captured ? false : true;
	},
	10,
	2
);
