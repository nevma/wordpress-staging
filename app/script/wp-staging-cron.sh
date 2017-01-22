#!/bin/bash



# Get this file's directory path
DIR=`dirname $0`
DIR=`readlink -f $DIR`



# If lock file exists previous instance is already running
LOCK_FILE=$DIR/staging.lock

if [ -f $LOCK_FILE ] ; then
    exit 0
fi

# Create a lock file in order not to run multiple times
touch $LOCK_FILE



# Read basic settings
source $DIR/dist/bin/wp-staging-config.sh



# The log file name
LOG_FILE=`dirname $0`/../data/log/run.log

echo -- `date` -- | tee -a $LOG_FILE
echo | tee -a $LOG_FILE



# Check if any config files to create staging websites exist
if [ ! "$(ls -A $DIR/../data/new)" ]; then

    # No new staging websites to create
    echo No config files to add staging websites found | tee -a $LOG_FILE
    echo | tee -a $LOG_FILE

else

    # Iterate over config files for staging websites to create
    for FILE in $DIR/../data/new/*; do

        echo Processing create file $FILE | tee -a $LOG_FILE

        # Set staging creation script parameters
        STAGING_NAME=`basename $FILE`
        SOURCE_DIRECTORY=`cat $FILE`

        echo Staging name $STAGING_NAME | tee -a $LOG_FILE
        echo Source directory $SOURCE_DIRECTORY | tee -a $LOG_FILE

        # Call the website staging creation script
        $DIR/dist/bin/wp-staging-create.sh $SOURCE_DIRECTORY $STAGING_NAME | tee -a $LOG_FILE

        # If staging creation script succeded move the file to the list of existing staging websites
        if [ $? -eq 0 ] ; then
            mv $FILE $DIR/../data/cur
        fi

        echo | tee -a $LOG_FILE

    done

fi



# Check if any config files to delete staging websites exist
if [ ! "$(ls -A $DIR/../data/del)" ]; then

    # No existing staging websites to delete
    echo No config files to delete staging websites found | tee -a $LOG_FILE
    echo | tee -a $LOG_FILE

else

    # Iterate over config files for staging websites to delete
    for FILE in $DIR/../data/del/*; do

        echo Processing delete file $FILE | tee -a $LOG_FILE

        # Set staging deletion script parameters
        STAGING_NAME=`basename $FILE`
        STAGING_DIRECTORY=$BASE_DIRECTORY/$STAGING_NAME

        echo Staging directory $STAGING_DIRECTORY | tee -a $LOG_FILE

        # Call the website staging deletion script
        $DIR/dist/bin/wp-staging-delete.sh $STAGING_DIRECTORY | tee -a $LOG_FILE

        # If staging deletion script succeded delete the file
        if [ $? -eq 0 ] ; then
            rm -rf $FILE
        fi

        echo | tee -a $LOG_FILE

    done

fi



# Remove the lock file
rm -rf $LOCK_FILE