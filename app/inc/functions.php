<?php

    /**
     * Gets the base url of the current app.
     */

    function get_base_url () {

        $url = $_SERVER['REQUEST_URI'];
        $pos = strpos( $url, '?' );
        if ( $pos !== false ) {
            $url = substr( $_SERVER['REQUEST_URI'], 0, $pos );
        }

        return $url;

    }



    /**
     * Gets the websites who are currently in staging.
     */

    function read_websites_in_staging () {

        $stagings = array();

        $files = scandir( 'data/cur' );
        $files = array_diff( $files, array( '..', '.' ) );

        foreach ( $files as $file ) {
            
            $stagings []= $file;

        }

        return $stagings;

    }



    /**
     * Gets the websites who are currently in staging.
     */

    function get_wordpress_websites () {

        $websites_list_file = 'data/websites.list';

        if ( ! file_exists( $websites_list_file ) ) {
            return array();
        }

        $websites_list_string = file_get_contents( $websites_list_file );
        $websites_list_array = explode( "\n", $websites_list_string );
        $websites_list_array = array_diff( $websites_list_array, array( '' ) );

        return $websites_list_array;

    }



    /**
     * Maps requests to their actions.
     */

    function handle_actions () {

        $action = isset( $_GET['action'] ) ? $_GET['action'] : null;

        switch ( $action ) {

            case 'help' :

                show_help_message();
                break;
            
            case 'create' :

                create_website_in_staging();
                break;
            
            case 'create-success' :

                create_website_in_staging_success();
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



    /**
     * Utility function to show information and error messages.
     */

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



    /**
     * Outputs the help message of the app.
     */

    function show_help_message () {

        create_message(
            '<p>
                In order for the app to work you need to to the following:
            </p>
            <ol>
                <li>Set the necessary parameters in: <br /> <code>&lt;ROOT_DIR&gt;/inc/settings.php</code></li>
                <li>Set the cron script to be executable: <br /> <code>chmod u+x &lt;ROOT_DIR&gt;/script/wp-staging-cron.sh</code></li>
                <li>Set the cron script to run in the system cron jobs: <br /> <code>*/2 * * * * &lt;ROOT_DIR&gt;/script/wp-staging.cron.sh &gt; /dev/null 2&gt;&amp;1</code></li>
            </ol>
            <p>
                The <code>&lt;ROOT_DIR&gt;</code> is the root directory of this web application.
            </p>
            <p>
                Your current settings are:
            </p>
            <ul>
                <li>BASE_URL=' . BASE_URL . '</li>
                <li>BASE_DIRECTORY=' . BASE_DIRECTORY . '</li>
            </ul>'
        );
        
    }



    /**
     * Outputs the last-N lines of the cron script log file.
     */

    function show_log () {

        $log_length = isset( $_GET['log-length'] ) ? intval( $_GET['log-length'] ) : 100-1;

        $lines = array();
        $fp = fopen( 'data/log/run.log', "r" );
        while( ! feof( $fp ) ) {
            $line = fgets( $fp, 4096 );
            array_push( $lines, $line );
            if ( count( $lines ) > $log_length ) {
                array_shift( $lines );
            }
        }
        $log_message = implode( '<br />', $lines );
        fclose( $fp );

        create_message( '<p>Here are the last ' . $log_length . ' log lines:</p><p><small><code class="log-lines">'. $log_message . '</code></small></p>' );

    }



    /**
     * Checks whether the settings of the app have been set.
     */

    function check_settings () {

        if ( ! defined( 'BASE_DIRECTORY' ) || ! defined( 'BASE_URL' ) ) {
            create_message( 'The "BASE_DIRECTORY" and "BASE_URL" settings have not been set in "script/bin/wp-staging-config.sh"' , 'error');
        }

    }



    /**
     * Ensures the directories where the data are saved have been created.
     */

    function ensure_directories () {

        $dir_cur = 'data/cur';
        $dir_del = 'data/del';
        $dir_log = 'data/log';
        $dir_new = 'data/new';

        if ( ! file_exists( $dir_cur ) ) {
            mkdir( $dir_cur, fileperms( '.' ), true );
        }

        if ( ! file_exists( $dir_del ) ) {
            mkdir( $dir_del, fileperms( '.' ), true );
        }

        if ( ! file_exists( $dir_log ) ) {
            mkdir( $dir_log, fileperms( '.' ), true );
        }

        if ( ! file_exists( $dir_new ) ) {
            mkdir( $dir_new, fileperms( '.' ), true );
        }

    }



    /**
     * Handles the request for staging website creation.
     */

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
            create_message( 'Staging website was successfully registered for creation! <br /> ' . $name . ' @ ' . $path . ' <br /> Come back in a little while, when the staging process will be complete.', 'success' );
        }

    }

    

    /**
     * Handles the request for staging website deletion.
     */

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