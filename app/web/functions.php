<?php

    require_once( 'settings.php' );



    function read_websites_in_staging () {

        $stagings = array();

        $files = scandir( 'data/cur' );
        $files = array_diff( $files, array('..', '.') );

        foreach ( $files as $file ) {
            
            $stagings []= $file;

        }

        return $stagings;

    }



    function handle_actions () {

        $action = isset( $_GET['action'] ) ? $_GET['action'] : null;

        switch ( $action ) {

            case 'help' :

                show_help_message();
                break;
            
            case 'create' :

                create_website_in_staging();
                break;
            
            case 'delete' :

                delete_website_from_staging();
                break;
            
            case 'log' :

                show_log();
                break;
            
            default:
            
                break;

        }

    }



    function create_message ( $message, $type='info' ) {

        $icons = array(
            'info'    => '&#x260e;',
            'success' => '&#x2714;',
            'error'   => '&#x2716;'
        );

        echo
            '<section class = "message text ' . $type . '">' . 
                '<h3>' . $icons[$type] . ' Action results</h3>' . 
                $message . 
            '</section>';

    }



    function show_help_message () {

        create_message(
            '<p>
                Remember to set the necessary parameters in:
            </p>
            <ul>
                <li>&lt;ROOT_DIR&gt;/settings.php</li>
                <li>&lt;ROOT_DIR&gt;/script/bin/wp-staging-config.sh</li>
            </ul>
            <p>
                Also, set the following cron script to run as often as you need:
            </p>
            <ul>
                <li>* * * * * &lt;ROOT_DIR&gt;/script/wp-staging.cron.sh</li>
            </ul>
            <p>
                The &lt;ROOT_DIR&gt; is the root directory of this web application.
            </p>'
        );
        
    }



    function show_log () {

        $length = isset( $_GET['length'] ) ? intval( $_GET['length'] ) : 100;

        $log = file_get_contents( 'script/run.log' );
        $log_array = explode( "\n", $log );
        $total = sizeof( $log_array );
        $log_array = array_slice( $log_array, $total-$length, $total );

        create_message( 'Here are the last ' . $length . ' log lines: <hr /> <small>'. implode( '<br />', $log_array ) . '</small>' );

    }



    function create_website_in_staging () {

        $name = isset( $_POST['name'] ) ? $_POST['name'] : null;
        $path = isset( $_POST['path'] ) ? $_POST['path'] : null;

        if ( empty( $name ) || empty( $path ) ) {

            create_message( 'You must provide all necessary parameters.', 'error' );
            return;
            
        }

        $name = str_ireplace( array( '/', '\\', '.' ), '-', $name );

        $file = 'data/new/' . $name;

        if ( file_exists( $file ) ) {

            create_message( 'Staging website name already registered for creation: ' . $name, 'error' );
            return;
            
        }


        $staging_path = BASE_DIRECTORY . '/' . $name;

        if ( file_exists( $staging_path ) ) {

            create_message( 'Staging website path already exists: ' . $staging_path, 'error' );
            return;
            
        }

        $result = file_put_contents( $file, $path );

        if ( $result === false ) {
            create_message( 'Staging website could not be registered for creation, could not write to file: ' . $file, 'error' );
        } else {
            create_message( 'Staging website was successfully registered for creation! <br /> ' . $name . ' @ ' . $path . ' <br /> Come back in a little while when the staging process is complete.', 'success' );
        }

    }

  

    function delete_website_from_staging () {

        $staging = isset( $_GET['staging'] ) ? $_GET['staging'] : null;

        if ( empty( $staging ) ) {

            create_message( 'You must provide all necessary parameters.', 'error' );
            return;
            
        }

        $staging = str_ireplace( array( '/', '\\', '.' ), '-', $staging );

        $staging_file = 'data/cur/' . $staging;

        if ( ! file_exists( $staging_file ) ) {

            create_message( 'Could not find a staging website with name: ' . $staging, 'error' );
            return;
            
        }

        $staging_file_del = 'data/del/' . $staging;

        if ( rename( $staging_file, $staging_file_del ) === false ) {
            create_message( 'Staging website could not be registered for deletion: ' . $staging_file, 'error' );
        } else {
            create_message( 'Staging website was successfully registered for deletion! <br /> ' . $staging . ' @ ' . $staging_file_del, 'success' );
        }

    }

?>