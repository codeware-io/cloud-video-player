<?php 
namespace SUP;

class Plugin{
	public static function init(){
		Ajax::init();

		add_action( 'wp_enqueue_scripts', [ 'SUP\Enqueue', 'init' ] );
		add_action( 'wp_loaded', [ 'SUP\Shortcode', 'init' ] );
	}
}
