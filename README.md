
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
- composer (even if this project is not deployed over composer [yet], the required libraries are loaded and auto included with it)

## Installation
The installation directory should not be web accessible. Only the public folder needs to be web readable.

### Get the files

#### GIT based installation
- Clone the git repository to you server
- Open the console and change the directory to the target directory, where you want to create the checkout
```
git clone https://github.com/schnoog/PHPBoilerPlate.git
```
#### Download based installation
- Download the zip file and extract it to your webserver
```
https://github.com/schnoog/PHPBoilerPlate/archive/master.zip
```

### Install the depencies
Install the depencies by using composer
```
$ composer install
```

### Create a database (if you have one, skip this step)
Create a database for your application.

### Create the database structure and import the base data
1. app/SETUP/01_UserTables.sql
2. app/SETUP/02_PageStructure.sql
3. app/SETUP/03_BaseData.sql

### Setup your main.config.php
Copy the supplied sample configuration
```
cp app/config/main_config.php.dist app/config/main_config.php
```
#### Edit the file according your needings

## Done
You should now be able to access the system.
The administrator login is
Username: **test@test.de**
Password: **1234abcd**






