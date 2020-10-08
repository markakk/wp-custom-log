<?php
/**
 * Plugin Name: Custom development logs
 * Plugin URI: http://markak.lt
 * Description: This plugin helps programmers to print the desired data to a log file using a simple function.
 * Version: 1.0.0
 * Author: markak
 * Author URI: http://markak.lt/
 * Requires at least: 4.1
 * Tested up to: 5.5.1
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
  function custom_log( $log, $file_name = '' ) {
    $Culog_Core = new CuLog_Core();
    $Culog_Core->simple_log($log, $file_name);
  }
}

/**
 * Log with function var_dump()
 *
 * @param string / array / object $variable - Log output
 * @param string $file_name - Output file name
 */
if ( ! function_exists('culog_vd') ) {
  function culog_vd( $log, $file_name = '' ) {
    $Culog_Core = new CuLog_Core();
    $Culog_Core->vardump_log($log, $file_name);
  }
}

/**
 * Log message output with label
 *
 * @param string $message - Log message
 * @param string $func_name - Function name if want write that in log file
 */
if ( ! function_exists('culog_msg') ) {
  function culog_msg( $msg_pref, $log, $in_where = '', $file_name = '' ) {
    $Culog_Core = new CuLog_Core();
    $Culog_Core->message_log($msg_pref, $log, $in_where, $file_name);
  }
}

/**
 * Functionality of the plugin
 */
class CuLog_Core {
  /* Output file settings */
  private $directory = WP_CONTENT_DIR . '/';
  private $default_name = 'debug-custom.log';

  /* Public functions */
  public function simple_log( $log, $file_name) {
    if ( true === WP_DEBUG ) {
      error_log( $this->build_log_text( $this->value_to_string($log, 'print_r') ), 3, $this->get_filepath( $file_name ));
    }
  }

  public function vardump_log( $log, $file_name ) {
    if ( true === WP_DEBUG ) {
      $this->simple_log( $this->value_to_string($log, 'var_dump'), $file_name );
    }
  }

  public function message_log( $type, $log, $in_where, $file_name ) {
    if ( true === WP_DEBUG ) {
      $in_where = empty($in_where) ? '' : ' in ' . $in_where;
      $output = strtoupper($type) . ': ' . $this->value_to_string($log, 'print_r') . $in_where;
      error_log( $this->build_log_text( $output ), 3, $this->get_filepath( $file_name ));
    }
  }

  /* Private functions */
  private function value_to_string( $log, $method = 'print_r' ) {
    if ( $method == 'print_r' ) {
      if ( is_array($log) || is_object($log) ) {
        return print_r($log, true);
      } else {
        return $log;
      }
    }
    if ( $method == 'var_dump' ) {
      ini_set("xdebug.overload_var_dump", "off");
      ob_start();
      var_dump($log);
      return ob_get_clean();
    }
  }

  private function get_filepath( $file_name ) {
    if ( empty($file_name) ) return $this->directory . $this->default_name;
    
    $file = pathinfo( sanitize_file_name($file_name) );
    if ( ! isset($file['extension']) ) $file['extension'] = 'log';
    return $this->directory . $file['filename'] . '.' . $file['extension'];
  }

  private function build_log_text( $log ) {
    $log_pref = '[' . date("Y-m-d H:i:s") . ']: ';
    return $log_pref . $log . PHP_EOL;
  }
}