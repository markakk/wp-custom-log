# Changelog

## [Unreleased]
### Changed
- removed CULOG_PARAMS global constant, but its use is still available

### Added
- added use of WP filters:
    - `culog_files_dir` - used to change the log file directory
    - `culog_file_name` - used to change the default log file name
    - `culog_param_value` - used to change any param value. Work together with CULOG_PARAMS constant
- added a custom page in the "Tools" section of the admin menu, where all log files can be viewed through the administration

## [1.0.3] - 2021-12-29
### Changed
- logging is always active regardless of the WP_DEBUG value

## [1.0.2] - 2021-09-24
### Changed
- moved all plugin functions from main file to separate files

## [1.0.1] - 2020-12-28
### Changed
- changed main function to culog()
- plugin main file moved to folder
