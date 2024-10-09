<?php
use Illuminate\Support\Facades\Session;

function displayAlert()
{
    if ( Session::has( 'alert' ) )
    {
        list( $type, $message ) = explode( '|', Session::get( 'alert' ) );

        switch ( $type )
        {
        case 'error':
            $type = 'danger';
            break;

        case 'warning':
            $type = 'warning';
            break;

        case 'info':
            $type = 'secondary';
            break;

        default:
            $type = 'success';
            break;
        }

        return sprintf( '<div class="alert alert-%s py-2 px-3 shadow rounded-lg rounded-bottom">%s</div><script>fadeAlert()</script>', $type, $message );
    }

    if ( Session::has( 'swal' ) )
    {
        list( $type, $title, $message ) = explode( '|', Session::get( 'swal' ) );

        return sprintf( '<script>swal("%s", "%s", "%s");</script>', $title, $message, $type );
    }

    return '';
}

?>
