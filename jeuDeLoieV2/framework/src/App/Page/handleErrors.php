<?php

ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL);
set_error_handler( "log_error" );
set_exception_handler( "log_exception" );

function log_error( $num, $str, $file, $line, $context = null )
{

    log_exception( new ErrorException( $str, 0, $num, $file, $line ) );
}

function log_exception( Exception $e )
{
    header("Location: /");
    exit();
}