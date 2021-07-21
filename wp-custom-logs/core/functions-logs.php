<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

/**
 * Write log file
 *
 * @param string / array / object $log - Log output
 * @param string $file_name - Output file name
 */
if ( ! function_exists('culog') ) {
  function culog( $log, $file_name = '' ) {
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
