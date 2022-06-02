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

use SUP\Plugin;

// defined required constants
define( 'SUP_URL', plugins_url( '', __FILE__ ) );
define( 'SUP_VERSION', '1.0.0');

require_once __DIR__ . '/lib/classes/functions.php';

require_once __DIR__ . '/vendor/autoload.php';

// init plugin
Plugin::init();
