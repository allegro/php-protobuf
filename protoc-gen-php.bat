@echo off
php -d display_errors=stderr -d log_errors=On -d error_log=Off %~dp0\protoc-gen-php.php %*