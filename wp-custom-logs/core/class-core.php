<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

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
