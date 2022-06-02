<?php 

namespace CVP;

use CVP\Signer\AWS;


class Shortcode{
	public static function init() {
		add_shortcode('video', [ __CLASS__, 'html' ] );
	}

	public static function html($signed_url) {
		echo '<video width="320" height="240" controls autoplay>
					<source src="'.$signed_url.'" type="video/mp4">
					<source src="movie.ogg" type="video/ogg">
					Your browser does not support the video tag.
				</video>';
	}
	
}
?>