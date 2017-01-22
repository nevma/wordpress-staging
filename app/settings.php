<?php

    // Read settings straight from the bash config file.

    $bash_config = 'script/bin/wp-staging-config.sh';

    if ( file_exists( $bash_config ) ) {

        $bash_config_contents = file_get_contents( $bash_config );

        if ( preg_match( '/BASE_DIRECTORY.*/', $bash_config_contents, $matches ) !== 0 ) {

            $base_directory = $matches[0];
            $base_directory = explode( '=', $base_directory );
            $base_directory = $base_directory[1];
            define( 'BASE_DIRECTORY', $base_directory );

        }
        
        if ( preg_match( '/BASE_URL.*/', $bash_config_contents, $matches ) !== 0 ) {

            $base_url = $matches[0];
            $base_url = explode( '=', $base_url );
            $base_url = $base_url[1];
            define( 'BASE_URL', $base_url );

        }

    }

?>