<?php
/**
 * Plugin Name: Custom development logs
 * Plugin URI: http://plugins.markak.lt
 * Description: This plugin helps programmers to print the desired data to a log file using a simple function.
 * Version: 1.0.4
 * Author: markak
 * Author URI: http://markak.lt/
 *
 * Requires at least: 4.1
 * Tested up to: 6.8.2
 *
 * Text Domain: culog
 * Domain Path: /languages
 *
 * @package custom_logs 
 * @category Core
 * @author markak
 */

define('CULOG_VERSION', '1.0.4');
define('CULOG_DIR', plugin_dir_path( __FILE__ ));
define('CULOG_URL', plugin_dir_url( __FILE__ ));

require_once CULOG_DIR . 'core/class-core.php';
require_once CULOG_DIR . 'core/class-actions.php';
require_once CULOG_DIR . 'core/functions-logs.php';

new CuLog_Actions();
