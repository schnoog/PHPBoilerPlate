
# PHPBoilerPlate

## What's that?
A boilerplate for php webapps, without the need to go object orientated for every single step.

### It includes
- User registration
- User management
- OAuth implementation
- Cookie and Session Management
- Multilanguage support (i18n, gettext. Supplied languages: en_GB & de_DE)
- XSS and CSRF protection
- Easy routing
- Input validation in jQuery and php (with an interface function)
- Growing documentation (within base installation)
- Page generation (you decide if the new created page is automatically created with an ajax backend)
- ACL for pages and navigation tree entries

### The following libraries and plugins are used:
- delight-im/PHP-Auth -- PHP-Auth (https://github.com/delight-im/PHP-Auth |MIT License)
- phpmailer/phpmailer -- PHPMailer (https://github.com/phpmailer/phpmailer |GNU Lesser General Public License v2.1)
- sergeytsalkov/meekrodb/ -- MeekroDB (https://github.com/SergeyTsalkov/meekrodb/ |GNU Lesser General Public License v3.0)
- smarty/smarty -- Smarty Template Engine (https://github.com/smarty-php/smarty |GNU Lesser General Public License v2.1 (or later))
- Bootstrap4 -- Bootstrap 4 (https://getbootstrap.com |MIT license)
- bootstrap-4-multi-dropdown-navbar -- Bootstrap4 Multi Dropdown Navbar (https://github.com/bootstrapthemesco/bootstrap-4-multi-dropdown-navbar/ |GPL license)
- cookieconsent -- Cookie Consent (https://cookieconsent.insites.com |MIT License)
- nestable-fork -- Nestable (https://github.com/ozdemirburak/nestable-fork |BSD & MIT license)
- datatables -- DataTables Table plug-in for jQuery (https://datatables.net/ |MIT license)
- summernote/summernote -- wysiwyg rich text editor for Bootstrap (https://github.com/summernote/summernote/ |MIT License)
- anti-xss -- anti-xss (https://github.com/voku/anti-xss |MIT license)
- werx/validation -- werx/validation (https://github.com/werx/validation |MIT License)
- jQuery Form Validator -- formvalidator.net (http://www.formvalidator.net |MIT License)
- Hybridauth -- Hybridauth 3.0 (https://hybridauth.github.io |MIT License)
- fontawesome -- Font Awesome (http://fontawesome.io/ |MIT License & SIL OFL 1.1)

## Requirements
- A webserver capable to run php (with intl extension, PHP 5.6.0+, PDO extension , OpenSSL extension)
- A MySQL database server (MySQL 5.5.3+ or MariaDB 5.5.23+)
- To use internationalisation, you may need to run locale-gen on your linux server
- composer

## Prerequisites
- You need the login data to an empty mysql database
- You need the login data to an email server

## Installation
The installation directory should not be web accessible. Only the public folder needs to be web readable.

I suggest to install this boilerplate over composer.
This will ensure random salts are defined for the hashing functions.

### Install with composer
To install the boilerplate, run this within the target directory
```
composer create-project schnoog/boilerplate . dev-master
```
or set a target directory
```
composer create-project schnoog/boilerplate targetdir dev-master
```
### Installation with git or Download
- Open the console and change the directory to the target directory, where you want to create the checkout

#### Get the files
```
git clone https://github.com/schnoog/PHPBoilerPlate.git .
```
or download the package and unzip it
```
https://github.com/schnoog/PHPBoilerPlate/archive/master.zip
```
#### Create the configuration
This can be done by a little helper script
```
php ./appconsole create
```
or by hand
copy the distributed example
```
cp app/config/main_config.php.dist app/config/main_config.php
```
replace SECSALT1 and SECSALT2 with random strings by hand.

## Configuration
Please adjust the settings in
```
app/config/main_config.php
```
to match your needings.
## Initialization
Now you need to populate the database.
This can be done by a little helper script
```
php ./appconsole db
```
or by importing each NUM_xxxx.sql file within app/SETUP/
(starting from 001_....)
```
mysql DATABASE < app/SETUP/001_UserTables.sql
mysql DATABASE < app/SETUP/002_PageStructure.sql
...
...
```

## Done
You should now be able to access the system.
The administrator login is
Username: **test@test.de**
Password: **1234abcd**

## Updates
I suggest to use the "php ./appconsole db" to install and update the database.
This will set a database version tag to be able to update the database without dataloss in later releases.




