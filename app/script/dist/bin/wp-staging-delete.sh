#!/bin/bash

echo
echo Cleaning up staging site
echo ========================
echo



################################################################################
#                                                                              #
#   ██████╗                                                                    #
#  ██╔═████╗    Basic settings for the staging websites that will be created.  #
#  ██║██╔██║                                                                   #
#  ████╔╝██║                                                                   #
#  ╚██████╔╝ ██                                                                #
#   ╚═════╝                                                                    #
#                                                                              #
################################################################################



echo 1. Reading parameters

# Check if adequate command line parameters have been given
if [ $# -ne 1 ]; then
    echo
    echo \*\* Error: correct usage is $0 \<STAGING_DIRECTORY\>
    echo
    exit 1
fi

# Prepare source installation variables
STAGING_DIRECTORY=`readlink -f $1`

# Check if target directory exists
if [ ! -d $STAGING_DIRECTORY ]; then
    echo
    echo \*\* Error: staging directory doesn\'t exist $STAGING_DIRECTORY
    echo
    exit 1
fi

# Prepare source installation variables
STAGING_WP_CONFIG=$STAGING_DIRECTORY/wp-config.php

# Check if staging directory is actually a WordPress installation
if [ ! -f $STAGING_WP_CONFIG ]; then
    echo
    echo \*\* Error: staging directory doesn\'t have a wp-config.php file $STAGING_DIRECTORY
    echo
    exit 1
fi

# Prepare source installation variables
STAGING_DB_NAME=`cat $STAGING_WP_CONFIG | grep \'DB_NAME\' | cut -d \' -f 4`



################################################################################
#                                                                              #
#   ██╗                                                                        #
#  ███║    Delete staging WordPress installation files.                        #
#  ╚██║                                                                        #
#   ██║                                                                        #
#   ██║ ██                                                                     #
#   ╚═╝                                                                        #
#                                                                              #
################################################################################



echo 2. Delete staging website files

rm -rf $STAGING_DIRECTORY



################################################################################
#                                                                              #
#  ██████╗                                                                     #
#  ╚════██╗     Remove staging website database.                               #
#   █████╔╝                                                                    #
#  ██╔═══╝                                                                     #
#  ███████╗ ██                                                                 #
#  ╚══════╝                                                                    #
#                                                                              #
################################################################################



echo 3. Delete staging website database

mysql -e "DROP database \`$STAGING_DB_NAME\`;"



################################################################################
#                                                                              #
#  ██████╗                                                                     #
#  ╚════██╗     Do some logging finally.                                       #
#   █████╔╝                                                                    #
#   ╚═══██╗                                                                    #
#  ██████╔╝ ██                                                                 #
#  ╚═════╝                                                                     #
#                                                                              #
################################################################################



# Echo staging website deletion data
echo 4. Done
echo
printf "Staging directory : $STAGING_DIRECTORY\n"
printf "Staging database  : $STAGING_DB_NAME\n"



echo
echo Cleanup process is complete
echo