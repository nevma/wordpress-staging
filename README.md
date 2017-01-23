# WordPress staging bash script

A simple WordPress staging installation creation bash shell script.

The goal of this script is to provide an easy way for one to create staging
installations of their WordPress websites in a Linux. It simply clones the
source WordPress directory, trying to be as intuitive as possible by detecting
the Linux user of the target, using the same database user as the source and
making all the necessary database string replacements, so that the result is
a full working staging clone of the source.

## Running

Call `wp-staging-create.sh`, preferrably as `root`, so that there will be no
file access issues, and provide it with the following parameters:

 - --base-url
 - --base-directory
 - --source-directory
 - --staging-name

## What it does

The script clones the source directory to the target directory, changes the 
clone's ownership to the same user as the base directory, updates the clone's
`.htaccess` and `wp-config.php` files, dumps the source database, creates a new 
database with the name of the staging installation, uses the same user as the
source database for simplicity, imports the source database dump to it, replaces
all the path and url strings in that database, thus creating a working clone of
the source WordPress installation in the target directory and at the target url.

## Cleanup

In order to cleanup the staging directory after you are done with it you can 
call the `wp-staging-delete.sh` script and give the following parameter:

- --staging-directory

## Web app

The `/app/` directory provides a special web application wrapper that enables the
easy usage of the scripts. You may install it in a CPanel user that will hold your
staging websites and then follow the instructions in the `Help` menu. Note that it 
will require  settig a cron script in your system.

## Credits

Uses the ["Interconnect/it Database search and replacement script"](https://interconnectit.com/products/search-and-replace-for-wordpress-databases/).

## Licence

The license for this project is GPL v.3.
