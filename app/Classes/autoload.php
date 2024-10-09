<?php

$files = glob( __DIR__ . "/*.Class.php" );
foreach ( $files as $file )
{
    $filename = (string) $file;
    if ( strpos( $filename, '.Class.php' ) !== false )
    {
        require_once $filename;
    }
}
