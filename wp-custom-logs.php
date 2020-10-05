<?php

/**
 * Plugin Name: Custom development logs
 * Plugin URI: http://markak.lt
 * Description: This plugin helps programmers to print the desired data to a log file using a simple function.
 * Version: 1.0.0
 * Author: markak
 * Author URI: http://markak.lt/
 * Requires at least: 4.1
 * Tested up to: 5.2.4
 *
 * Text Domain: culog
 * Domain Path: /languages
 *
 * @package custom_logs 
 * @category Core
 * @author markak
 */

define('CULOG_FILE','debug-custom.log');

/**
 * Write log file
 *
 * @param string / array / object $log - Log output
 * @param string $file_name - Output file name
 */
if ( ! function_exists('custom_log') ) {
  function custom_log($log, $file_name = CULOG_FILE) {
    if ( true === WP_DEBUG ) {
      if ( is_array($log) || is_object($log) ) {
        error_log(print_r($log, true), 3, WP_CONTENT_DIR . '/' . $file_name);
      } else {
        error_log($log . PHP_EOL, 3, WP_CONTENT_DIR . '/' . $file_name);
      }
    }
  }
}

/**
 * Log with function var_dump()
 *
 * @param string / array / object $variable - Log output
 * @param string $file_name - Output file name
 */
function culog_vd($variable, $file_name = CULOG_FILE) {
  ob_start();
  var_dump($variable);
  $result = ob_get_contents();
  ob_end_clean();
  error_log($result, 3, WP_CONTENT_DIR . '/' . CULOG_FILE);
}

/**
 * Log message output with label
 *
 * @param string $message - Log message
 * @param string $func_name - Function name if want write that in log file
 */
function culog_error($message, $func_name = '') {
  if ( $func_name != '' ) {
    $func_txt = ' in ' . $func_name . '().';
  } else {
    $func_txt = '.';
  }
  custom_log('ERROR: ' . $message . $func_txt);
}
function culog_notice($message, $func_name = '') {
  if ( $func_name != '' ) {
    $func_txt = ' in ' . $func_name . '().';
  } else {
    $func_txt = '.';
  }
  custom_log('NOTICE: ' . $message . $func_txt);
}