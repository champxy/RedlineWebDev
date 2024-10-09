<?php

$files = glob( __DIR__ . "/*.func.php" );
foreach ( $files as $file )
{
    $filename = (string) $file;
    if ( strpos( $filename, '.func.php' ) !== false )
    {
        require_once $filename;
    }
}