#!/bin/bash



################################################################################
#                                                                              #
#   ██████╗                                                                    #
#  ██╔═████╗    Read and parse command line parameters.                        #
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
        "--base-url")
            BASE_URL=$VALUE
        ;;
        "--base-directory")
            BASE_DIRECTORY=$VALUE
            BASE_DIRECTORY=`readlink -f $BASE_DIRECTORY`
        ;;
        "--source-directory")
            SOURCE_DIRECTORY=$VALUE
            SOURCE_DIRECTORY=`readlink -f $SOURCE_DIRECTORY`
        ;;
        "--staging-name")
            STAGING_NAME=$VALUE
        ;;
    esac

done



# Check if necessary command line parameters have been given
if [[ -z "${BASE_URL// }" || 
      -z "${BASE_DIRECTORY// }" ||
      -z "${SOURCE_DIRECTORY// }" ||
      -z "${STAGING_NAME// }" ]] ; then 
      
    echo
    echo \*\* Error: correct usage is
    echo 
    echo ./wp-staging-create.sh
    echo
    echo "    "--base-url=\<The base url from which staging websites are accessed\>
    echo "    "--base-directory=\<The base directory where the staging websites are copied\>
    echo "    "--source-directory=\<The directory of the website to create a staging from\>
    echo "    "--staging-name=\<A code name for the staging website to be created\>
    echo
    echo You must provide all necessary parameters!
    echo
    exit 1

fi

echo
echo Creating WordPress staging website
echo ==================================
echo



################################################################################
#                                                                              #
#   ██╗                                                                        #
#  ███║    Read the configuration and prepare the necessary variables.         #
#  ╚██║                                                                        #
#   ██║                                                                        #
#   ██║ ██                                                                     #
#   ╚═╝                                                                        #
#                                                                              #
################################################################################



echo \#\#\# 1. Reading configuration

# Define target (staging) installation directory
TARGET_DIRECTORY=$BASE_DIRECTORY/$STAGING_NAME

# Check if base directory doesn't exist
if [ ! -d $BASE_DIRECTORY ]; then
    echo
    echo \*\* Error: base directory does not exist $BASE_DIRECTORY
    echo
    exit 1
fi

# Check if source directory already exists
if [ ! -d $SOURCE_DIRECTORY ]; then
    echo
    echo \*\* Error: source directory does not exist $SOURCE_DIRECTORY
    echo
    exit 1
fi

# Check if staging name is valid
if [[ ! $STAGING_NAME =~ ^[a-zA-Z0-9\-]+$ ]]; then
    echo
    echo \*\* Error: staging name $STAGING_NAME should only contain characters - \(that\'s a dash\), a-z, A-Z and 0-9
    echo
    exit 1
fi

# Check if target directory already exists
if [ -d $TARGET_DIRECTORY ]; then
    echo
    echo \*\* Error: target directory already exists $TARGET_DIRECTORY
    echo
    exit 1
fi

# Read source installation WordPress config file
SOURCE_WP_CONFIG=$SOURCE_DIRECTORY/wp-config.php

# Check if source directory is actually a WordPress installation
if [ ! -f $SOURCE_WP_CONFIG ]; then
    echo
    echo \*\* Error: source directory doesn\'t have a wp-config.php file $SOURCE_DIRECTORY
    echo
    exit 1
fi



# Prepare source database variables
SOURCE_DB_HOST=`cat $SOURCE_WP_CONFIG | grep \'DB_HOST\' | cut -d \' -f 4`
SOURCE_DB_NAME=`cat $SOURCE_WP_CONFIG | grep \'DB_NAME\' | cut -d \' -f 4`
SOURCE_DB_USER=`cat $SOURCE_WP_CONFIG | grep \'DB_USER\' | cut -d \' -f 4`
SOURCE_DB_PASSWORD=`cat $SOURCE_WP_CONFIG | grep \'DB_PASSWORD\' | cut -d \' -f 4`

# Prepare target database variables
TARGET_DB_HOST=$SOURCE_DB_HOST
TARGET_DB_NAME=$STAGING_NAME
TARGET_DB_USER=$SOURCE_DB_USER
TARGET_DB_PASSWORD=$SOURCE_DB_PASSWORD

# Check if target database already exists
TEST_DB_EXISTS=`mysql -e "show databases like '$TARGET_DB_NAME'";`

if [ ! -z "${TEST_DB_EXISTS// }" ]; then
    echo
    echo \*\* Error: target database already exists $TARGET_DB_NAME
    echo
    exit 1
fi



# Target installation WordPress config file
TARGET_WP_CONFIG=$TARGET_DIRECTORY/wp-config.php

# Target installation url
TARGET_URL=$BASE_URL/$STAGING_NAME

# Source database dump file
DB_DUMP_FILE=$TARGET_DIRECTORY/$SOURCE_DB_NAME.sql

# Output log file
LOG_FILE=staging.$STAGING_NAME.log



# Get this file's directory path
DIR=`dirname $0`
DIR=`readlink -f $DIR`



# Find out target directory owner user and group
TARGET_FS_USER=`stat -c "%U" $BASE_DIRECTORY`
TARGET_FS_GROUP=`stat -c "%G" $BASE_DIRECTORY`



# Detect php cli version (vs the cgi version)
source $DIR/wp-staging-php-cli.sh
PHP_CLI_PATH=$( detect_php_cli )

# Detect Interconnect.it search and replace PHP script.
SRDB_CLI_PHP=`readlink -f $DIR/../srdb/srdb.cli.php`

# Detect WP-CLI path.
WP_CLI_PATH=`readlink -f $DIR/../wpcli/wp-cli.phar`



################################################################################
#                                                                              #
#  ██████╗                                                                     #
#  ╚════██╗     Copy the source directory to the target directory and fix its  #
#   █████╔╝     permissions.                                                   #
#  ██╔═══╝                                                                     #
#  ███████╗ ██                                                                 #
#  ╚══════╝                                                                    #
#                                                                              #
################################################################################



echo \#\#\# 2. Copying source directory

# Clone source directory to target directory
cp -r $SOURCE_DIRECTORY $TARGET_DIRECTORY

# Change ownership of target directory to specified user
chown -R $TARGET_FS_USER:$TARGET_FS_GROUP $TARGET_DIRECTORY

# Make target directory readable and executable for everyone
chmod ugo+rx $TARGET_DIRECTORY



################################################################################
#                                                                              #
#  ██████╗                                                                     #
#  ╚════██╗     Dump the source database to a file.                            #
#   █████╔╝                                                                    #
#   ╚═══██╗                                                                    #
#  ██████╔╝ ██                                                                 #
#  ╚═════╝                                                                     #
#                                                                              #
################################################################################



echo \#\#\# 3. Dumping source database

# Dump the source database
mysqldump $SOURCE_DB_NAME > $DB_DUMP_FILE

# Change the dump file ownership to the current user
chown -R $TARGET_FS_USER:$TARGET_FS_GROUP $DB_DUMP_FILE

# Extract source url from database dump
SOURCE_URL=`grep \'siteurl\' $DB_DUMP_FILE | head -c 1000 | cut -d \, -f 3 | cut -d \' -f 2`



################################################################################
#                                                                              #
#  ██╗  ██╗                                                                    #
#  ██║  ██║    Create target database, but use the same database user as the   #
#  ███████║    source database for simplicity.                                 #
#  ╚════██║                                                                    #
#       ██║ ██                                                                 #
#       ╚═╝                                                                    #
#                                                                              #
################################################################################



echo \#\#\# 4. Creating target database

# Create target database script
SQL1="CREATE DATABASE IF NOT EXISTS  \`$TARGET_DB_NAME\`;"

# Give source database user access to the target database
SQL2="GRANT ALL PRIVILEGES ON \`$TARGET_DB_NAME\`.* TO \`$TARGET_DB_USER\`@localhost;"
SQL3="FLUSH PRIVILEGES;"
SQL_CREATE="${SQL1}${SQL2}${SQL3}"

# Execute target database scripts
mysql -e "$SQL_CREATE"

# Import source database to target database
mysql $TARGET_DB_NAME < $DB_DUMP_FILE



################################################################################
#                                                                              #
#  ███████╗                                                                    #
#  ██╔════╝    Update the target installation wp-config.php file, set the      #
#  ███████╗    target database name but leave the source database user.        #
#  ╚════██║                                                                    #
#  ███████║ ██                                                                 #
#  ╚══════╝                                                                    #
#                                                                              #
################################################################################



echo \#\#\# 5. Updating target wp-config.php

# Get the line of the database name in the target wp-config.php file
TARGET_DB_NAME_WP_CONFIG=`cat $TARGET_WP_CONFIG | grep \'DB_NAME\'`

# Make the replacement with the target database name
TARGET_DB_NAME_WP_CONFIG_REPLACED=`echo $TARGET_DB_NAME_WP_CONFIG | replace -s $SOURCE_DB_NAME $TARGET_DB_NAME`

# Replace the line with the database name in the target wp-config.php file
replace -s "$TARGET_DB_NAME_WP_CONFIG" "$TARGET_DB_NAME_WP_CONFIG_REPLACED" -- $TARGET_WP_CONFIG



################################################################################
#                                                                              #
# Add a PHP constant to the wp-config.php to disable Redis functions           #
#                                                                              #
# MATCH='<?php'                                                                #
# INSERT="define('WP_REDIS_DISABLED', true);"                                  #
# sed -i "s/$MATCH/$MATCH\n\n$INSERT/" $TARGET_WP_CONFIG                       #
#                                                                              #
################################################################################



################################################################################
#                                                                              #
#   ██████╗                                                                    #
#  ██╔════╝     Replace urls and paths in the target database with both the    #
#  ███████╗     Interconnectit php database search and replace script and      #
#  ██╔═══██╗    WPCLI consecutively.                                           #
#  ╚██████╔╝ ██                                                                #
#   ╚═════╝                                                                    #
#                                                                              #
################################################################################



echo \#\#\# 6. Replacing target database strings

# Replace occurences of source directory with target directory
echo 6.1 Replacing source directory in target database (via script)
$PHP_CLI_PATH -f $SRDB_CLI_PHP -- -v true -h $TARGET_DB_HOST -n $TARGET_DB_NAME -u $TARGET_DB_USER -p $TARGET_DB_PASSWORD -s $SOURCE_DIRECTORY -r $TARGET_DIRECTORY
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY search-replace $SOURCE_DIRECTORY $TARGET_DIRECTORY

# Replace occurences of source url with target url
echo 6.2 Replacing source url in target database (via wpcli)
$PHP_CLI_PATH -f $SRDB_CLI_PHP -- -v true -h $TARGET_DB_HOST -n $TARGET_DB_NAME -u $TARGET_DB_USER -p $TARGET_DB_PASSWORD -s $SOURCE_URL -r $TARGET_URL
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY search-replace $SOURCE_URL $TARGET_URL



################################################################################
#                                                                              #
#  ███████╗                                                                    #
#  ╚════██║    Update the target .htaccess file because now we are in a        #
#      ██╔╝    subdirectory.                                                   #
#     ██╔╝                                                                     #
#     ██║   ██                                                                 #
#     ╚═╝                                                                      #
#                                                                              #
################################################################################



echo \#\#\# 7. Updating target htaccess file

replace -s "RewriteBase /" "RewriteBase /$STAGING_NAME/" -- $TARGET_DIRECTORY/.htaccess
replace -s "RewriteRule . /index.php [L]" "RewriteRule . /$STAGING_NAME/index.php [L]" -- $TARGET_DIRECTORY/.htaccess



################################################################################
#                                                                              #
#   █████╗                                                                     #
#  ██╔══██╗    Deactivate certain WordPress plugins unnecessary in the         #
#  ╚█████╔╝    staging environment.                                            #
#  ██╔══██╗                                                                    #
#  ╚█████╔╝ ██                                                                 #
#   ╚════╝                                                                     #
#                                                                              #
################################################################################



echo \#\#\# 8. Deactivating unnecessary plugins

$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate bwp-minify
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate iwp-client
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate jetpack
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate litespeed-cache
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate redis-cache
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate varnish-http-purge

$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate modirumeb-for-woocommerce2
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate hellaspay-for-woocommerce2
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate nbghps-for-woocommerce2
$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY plugin deactivate modirum-for-woocommerce2

$WP_CLI_PATH --allow-root --path=$TARGET_DIRECTORY cache flush



################################################################################
#                                                                              #
#   █████╗                                                                     #
#  ██╔══██╗    Do some (more) logging finally.                                 #
#  ╚██████║                                                                    #
#   ╚═══██║                                                                    #
#   █████╔╝ ██                                                                 #
#   ╚════╝                                                                     #
#                                                                              #
################################################################################



# Echo staging website creation data
echo \#\#\# 9. Done
echo
printf "Source directory : $SOURCE_DIRECTORY\n"
printf "Source http url  : $SOURCE_URL\n"
printf "Target directory : $TARGET_DIRECTORY\n"
printf "Target http url  : $TARGET_URL\n"



echo
echo WordPress staging website creation process is complete
echo