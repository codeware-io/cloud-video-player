<?php 
namespace CVP;

use CVP\Signer\AWS;

class Plugin{
	public static function init(){
		Ajax::init();

		add_action( 'wp_enqueue_scripts', [ 'CVP\Enqueue', 'init' ] );
		add_action( 'wp_loaded', [ 'CVP\Shortcode', 'init' ] );
		
	}
}
