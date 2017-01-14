# WordPress staging bash script

A simple WordPress staging installation creation bash shell script.

The goal of this script is to provide an easy way for one to create staging
installations of their WordPress websites in any Linux environment where one
has at least _some_ privileges. It simply clones the source WordPress
directory but tries to be as intuitive as possible by detecting the Linux
user of the target, using the same database user as the source and making
all the necessary database string replacements, so that the result is a
full working clone of the source.

## Settings

Open `wp-staging-create.sh` and set the `BASE_DIRECTORY` and `BASE_URL` bash
variables so that they point to the directory where your staging websites will
be placed and the url at which this directory is exposed to the internet
respectively.

## Running

Call `wp-staging-create.sh` as `root` and provide it with the source WordPress
directory which is to be staged as a first argument and a name for the staging
installation. If both the source WordPress and the cloned one run under the 
same Linux user, then you may run it under this user as well. Rnning as `root`
allows one to clone any WordPress installation in their server.

## What it does

The script clones the source directory to the target directory, changes the 
clone's ownership to the same user as the base directory, updates the clone's
`.htaccess` and `wp-config.php` files, dumps the source database, creates a new 
database with the name of the staging installation, uses the same user as the
source database for simplicity, imports the source database dump to it, replaces
all the path and url strings in that database, thus creating a working clone of
the source WordPress installation in the target directory and at the target url.

## A common setup

Say you have a *CPanel* server with one user.

Create a subdomain where you will put your staging websites. They will all have
to be in this subdomain. This subdomain will thus have its own directory and 
base url.

Copy the contents of the `dist` directory in your CPanel user's home directory.
Set this directory and url in the `bin/wp-staging-create.sh` as the
`BASE_DIRECTORY` and `BASE_URL` variables which you will find at the top. These
are simple strings that should require no escaping.

**bin/wp-staging-create.sh**
```bash
BASE_DIRECTORY=/home/username/staging.mydomain.com
BASE_URL=http://staging.mydomain.com
```

Run the `bin/wp-staging-create.sh` script and provide it with 2 arguments: a) the
*path to the WordPress installation* that you want to clone and b) a simple *name*
for the staging installation that you want to create.

`_> ./wp-staging-dir/bin/wp-staging-create.sh /home/username/public_html/www.
mydomain.com mydomain-staging`

You should now have a staging website created at the directory `/home/username/
staging.mydomain.com/mydomain-staging` and which can be accessed at the url `http://
staging.mydomain.com/mydomain-staging`

For each staging website a staging database is created but the user of the 
original WordPress installation database user is used.

## Cleanup

In order to cleanup the staging directory after you are done with it you can 
call the `wp-staging-delete.sh` script and give it as a sole argument the 
directory of the staging website. It will take care of deleting the database and
all the files.

`_> ./wp-staging-dir/bin/wp-staging-delete.sh /home/username/public_html/www.
mydomain.com`

This should delete the staging directory and its database.

## Licence

The license for this project is GPL v.3.
