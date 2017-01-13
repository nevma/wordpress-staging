# WordPress staging bash script

A simple WordPress staging installation creation bash shell script.

## Setup

Open `wp-staging-create.sh` and set the `BASE_DIRECTORY` and `BASE_URL` bash
variables so that they point to the directory where your staging websites will
be placed and the url at which this directory is exposed to the internet
respectively.

## Running

Call `wp-staging-create.sh` as `root` and provide it with the source WordPress
directory which is to be staged as a first argument and a name for the staging
installation.

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
call the `wp-staging-delete.sh` script and give it as a sole argument the 
directory of the staging website. It will take care of deleting the database and
all the files.

## Licence

The license for this project is GPL v.3.