<?php
// Enable full error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Example usage: trigger an error
echo $undefinedVariable; // This will generate a notice

// You can also set a custom error handler
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "Error [$errno]: $errstr in $errfile on line $errline\n";
    // Return true to prevent PHP's default error handler
    return true;
}

set_error_handler('customErrorHandler');

// Trigger a user error
trigger_error("This is a custom error!", E_USER_WARNING);
?>