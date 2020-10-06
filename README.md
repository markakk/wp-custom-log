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

Write with prefix "ERROR" and function name:
```sh
culog_error( $message, $func_name );
```
*$message* - (required) String of message.  
*$func_name* - (optional) String of function name if want to see from where comes this log text (then output looks like `ERROR: My_message in func_name().`). Default: `''`

Write with prefix "NOTICE" and function name:
```sh
culog_error( $message, $func_name );
```
*$message* - (required) String of message.  
*$func_name* - (optional) String of function name if want to see from where comes this log text (then output looks like `NOTICE: My_message in func_name().`). Default: `''`
