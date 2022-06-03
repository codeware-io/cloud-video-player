<?php 

namespace CVP;
use CVP\Signer\AWS;

class Shortcode{
	public static function init() {
		add_shortcode('video', [ __CLASS__, 'html' ] );
	}

	public static function html($atts) {
		$videoSrc = shortcode_atts( array(
			'src' => '',
		), $atts );

		AWS::init($videoSrc['src']);
	}
}
?>