# Custom development logs

This plugin helps programmers to print the desired data to a log file using a simple functions.

## Using

Write to log file:
```sh
custom_log( $variable, $file_name );
```
*$variable* - (required) Variable or expression which write to .log file.  
*$file_name* - (optional) String of .log file name, to which output logs (with extension). Default: `debug-custom.log`

Write using var_dump function (usefull for boolean values):
```sh
culog_vd( $variable, $file_name );
```
*$variable* - (required) Variable or expression which write to .log file.  
*$file_name* - (optional) String of .log file name, to which output logs (with extension). Default: `debug-custom.log`

Write log with prefix and with the ability to specify "in where" parameter for easier log recognition:
```sh
culog_msg( $msg_pref, $variable, $in_where, $file_name );
```
*$msg_pref* - (required) String of log prefix, e.g. 'NOTICE'.
*$variable* - (required) Variable or expression which write to .log file.
*$func_name* - (optional) String of custom recognition name if want to easer identify this log (then output looks like `NOTICE: My_message in Identifier_name`). Default: `''`
*$file_name* - (optional) String of .log file name, to which output logs (with extension). Default: `debug-custom.log`
