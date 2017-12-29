
# PHPBoilerPlate

## What's that?
A boilerplate for php webapps, without the need to go object orientated for every single step.

### It includes
- User registration
- User management
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

### Requirements
- A webserver capable to run php (with intl extension, PHP 5.6.0+, PDO extension , OpenSSL extension)
- A MySQL database server (MySQL 5.5.3+ or MariaDB 5.5.23+)
- To use internationalisation, you may need to run locale-gen on your linux server
- composer (even if this project is not deployed over composer [yet], the required libraries are loaded and auto included with it)
- 
