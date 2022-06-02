<?php
/**
 * Plugin Name:     Cloud Video Player
 * Plugin URI:      https://codeware.io
 * Description:    	
 * Author:          Codeware Team
 * Author URI:      https://codeware.io
 * Text Domain:     cloud-video-player
 * Requires PHP: 5.4
 * Requires at least: 5.0
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         CODEWARE
 */

use CVP\Plugin;

// defined required constants
define( 'CVP_URL', plugins_url( '', __FILE__ ) );
define( 'CVP_VERSION', '1.0.0');

require_once __DIR__ . '/vendor/autoload.php';

// init plugin
Plugin::init();
