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
    $Culog_Core = new CuLog_Core(CULOG_PARAMS);
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
    $Culog_Core = new CuLog_Core(CULOG_PARAMS);
    $Culog_Core->vardump_log($log, $file_name);
  }
}

/**
 * Log message output with label
 *
 * @param string $msg_pref - Prefix in log message
 * @param string $log - Log message
 * @param string $in_where - Function or something name if want write that in log file
 * @param string $file_name - Output file name
 */
if ( ! function_exists('culog_msg') ) {
  function culog_msg( $msg_pref, $log, $in_where = '', $file_name = '' ) {
    $Culog_Core = new CuLog_Core(CULOG_PARAMS);
    $Culog_Core->message_log($msg_pref, $log, $in_where, $file_name);
  }
}
