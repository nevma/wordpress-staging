#!/bin/bash



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



# Parse command line parameters
for ARG do

    NAME=`echo $ARG | cut -d = -f 1`
    VALUE=`echo $ARG | cut -d = -f 2`

    case $NAME in
        "--staging-directory")
            STAGING_DIRECTORY=$VALUE
            STAGING_DIRECTORY=`readlink -f $STAGING_DIRECTORY`
        ;;
    esac

done



# Check if necessary command line parameters have been given
if [[ -z "${STAGING_DIRECTORY// }" ]] ; then 

    echo
    echo \*\* Error: correct usage is
    echo 
    echo ./wp-staging-delete.sh
    echo
    echo "    "--staging-directory=\<The directory where the staging websites is located\>
    echo
    echo You must provide all necessary parameters!
    echo
    exit 1
    
fi

echo
echo Cleaning up staging site
echo ========================
echo



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



echo \#\#\# 1. Delete staging website files

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



echo \#\#\# 2. Delete staging website database

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
echo \#\#\# 3. Done
echo
printf "Staging directory : $STAGING_DIRECTORY\n"
printf "Staging database  : $STAGING_DB_NAME\n"



echo
echo Cleanup process is complete
echo