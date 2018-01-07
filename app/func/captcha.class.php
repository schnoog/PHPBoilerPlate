<?php
    /**
     * Icon Captcha Plugin: v2.2.0
     * Copyright © 2017, Fabian Wennink (https://www.fabianwennink.nl)
     *
     * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
     */

    class IconCaptcha {

        /**
         * @var string                      A JSON encoded error message, which will be shown to the user.
         */
        private static $error;

        /**
         * @var int                         The current captcha identifier.
         */
        private static $captcha_id = 0;

        /**
         * @var array                       The (possible) custom error messages.
         */
        private static $error_messages = array();

        /**
         * @var CaptchaSession              The session containing captcha information.
         */
        private static $session;


        /**
         * Sets the icon folder path variable.
         *
         * @since 2.0.0                     Function was introduced.
         *
         * @param string $file_path         The path to the icons folder.
         */
        public static function setIconsFolderPath($file_path) {
            $_SESSION['icon_captcha']['icon_path'] = $file_path;
        }

        /**
         * Sets the custom error messages array. When set, these messages will
         * be returned by getErrorMessage() instead of the default messages.
         *
         * Message 1 = You've selected the wrong image.
         * Message 2 = No image has been selected.
         * Message 3 = You've not submitted any form.
         * Message 4 = The captcha ID was invalid.
         *
         * Array format: array('', '', '', '')
         *
         * @since 2.1.1                     Function was introduced.
         *
         * @param array $messages           The array containing the custom error messages.
         */
        public static function setErrorMessages($messages = array()) {
            if(!empty($messages)) self::$error_messages = $messages;
        }

        /**
         * Returns the validation error message.
         *
         * @since 2.0.0                     Function was introduced.
         *
         * @return string			        The JSON encoded error message containing the error ID and message.
         */
        public static function getErrorMessage() {
            return self::$error;
        }

        /**
         * Return a correct icon class + multiple incorrect classes
         *
         * @since 2.0.1                     Function was introduced.
         *
         * @param string $theme             The theme of the captcha.
         * @param int $captcha_id           The captcha identifier.
         *
         * @return string			        The JSON array containing the correct icon, incorrect icon and hashes.
         */
        public static function getCaptchaData($theme, $captcha_id) {
            $a = rand(1, 89); // Get a random number (correct image)
            $b = 0; // Get another random number (incorrect image)

            // Set the captcha id property
            self::$captcha_id = $captcha_id;

            // Load the session data, if there is any present.
            // Default data will be used in case no data exists.
            self::$session = new CaptchaSession($captcha_id, $theme);

            // Pick a random number for the incorrect icon.
            // Loop until a number is found which doesn't match the correct icon ID.
            while($b === 0) {
                $c = rand(1, 89);
                if($c !== $a) $b = $c;
            }

            $d = -1; // At which position the correct hash will be stored in the array.
            $e = array(); // Array containing the hashes

            // Pick a random number for the correct icon.
            // Loop until a number is found which doesn't match the previously clicked icon ID.
            while($d === -1) {
                $f = rand(1, 5);
                $g = (self::$session->last_clicked > -1) ? self::$session->last_clicked : 0;

                if($f !== $g) $d = $f;
            }

            for($i = 1; $i < 6; $i++) {
                if($i === $d) {
                    array_push($e, self::getImageHash('icon-' . $a . '-' . $i));
                } else {
                    array_push($e, self::getImageHash('icon-' . $b . '-' . $i));
                }
            }

            // Unset the previous session data
            self::$session->clear();

            // Set (or override) the hashes and reset the icon request count.
            self::$session->hashes = array($a, $b, $e); // correct id, incorrect id, hashes
            self::$session->correct_hash = $e[$d - 1];
            self::$session->icon_requests = 0;
            self::$session->save();

            // Return the JSON encoded array
            return json_encode($e);
        }

        /**
         * Validates the user form submission. If the captcha is incorrect, it
         * will set the error variable and return false, else true.
         *
         * @since 2.0.0                     Function was introduced.
         *
         * @param array $post			    The HTTP POST request.
         *
         * @return boolean			        TRUE if the captcha was correct, FALSE if not.
         */
        public static function validateSubmission($post) {
            if(!empty($post)) {

                // Check if the captcha ID is set.
                if(!isset($post['captcha-idhf']) || !is_numeric($post['captcha-idhf'])
                    || !CaptchaSession::exists($post['captcha-idhf'])) {
                    self::$error = json_encode(array('id' => 4, 'error' => ((!empty(self::$error_messages[3]))
                        ? self::$error_messages[3] : 'The captcha ID was invalid.')));
                    return false;
                }

                // Set the captcha id property
                self::$captcha_id = $post['captcha-idhf'];

                // If the session is not loaded yet, load it.
                if(!isset(self::$session)) {
                    self::$session = new CaptchaSession(self::$captcha_id);
                }

                // Check if the hidden captcha field is set.
                if(!empty($post['captcha-hf'])) {

                    // If the hashes match, the form can be submitted. Return true.
                    if(self::$session->completed === true && self::getCorrectIconHash() === $post['captcha-hf']) {
                        return true;
                    } else {
                        self::$error = json_encode(array('id' => 1, 'error' => ((!empty(self::$error_messages[0]))
                            ? self::$error_messages[0] : 'You\'ve selected the wrong image.')));
                    }
                } else {
                    self::$error = json_encode(array('id' => 2, 'error' => ((!empty(self::$error_messages[1]))
                        ? self::$error_messages[1] : 'No image has been selected.')));
                }
            } else {
                self::$error = json_encode(array('id' => 3, 'error' => ((!empty(self::$error_messages[0]))
                    ? self::$error_messages[0] : 'You\'ve not submitted any form.')));
            }

            return false;
        }

        /**
         * Checks and sets the captcha session. If the user selected the
         * correct image, the value will be true, else false.
         *
         * @since 2.0.0                     Function was introduced.
         *
         * @param array $post			    The HTTP Post request.
         *
         * @return boolean			        TRUE if the correct image was selected, FALSE if not.
         */
        public static function setSelectedAnswer($post) {
            if(!empty($post)) {

                // Check if the captcha ID is set.
                if(!isset($_POST['cID']) || !is_numeric($_POST['cID'])) {
                    return false;
                }

                // Set the captcha id property
                self::$captcha_id = $_POST['cID'];

                // If the session is not loaded yet, load it.
                if(!isset(self::$session)) {
                    self::$session = new CaptchaSession(self::$captcha_id);
                }

                // Check if the hash is set and matches the correct hash.
                if(isset($post['pC']) && (self::getCorrectIconHash() === $post['pC'])) {
                    self::$session->completed = true;

                    // Unset the data to at least save some space in the session.
                    self::$session->clear();
                    self::$session->save();

                    return true;
                } else {
                    self::$session->completed = false;
                    self::$session->save();

                    // Set the clicked icon ID
                    if(in_array($_POST['pC'], self::$session->hashes[2])) {
                        $i = array_search($_POST['pC'], self::$session->hashes[2]);
                        self::$session->last_clicked = $i + 1;
                    }
                }
            }

            return false;
        }

        /**
         * Shows the icon image based on the hash. The hash matches either the correct or incorrect id
         * and will fetch and show the right image.
         *
         * @since 2.0.1                     Function was introduced.
         *
         * @param string|null $hash         The icon hash.
         * @param int|null $captcha_id      The captcha identifier.
         */
        public static function getIconFromHash($hash = null, $captcha_id = null) {

            // Check if the hash and captcha id are set
            if(!empty($hash) && (isset($captcha_id) && $captcha_id > -1)) {

                // Set the captcha id property
                self::$captcha_id = $captcha_id;

                // If the session is not loaded yet, load it.
                if(!isset(self::$session)) {
                    self::$session = new CaptchaSession(self::$captcha_id);
                }

                // Check the amount of times an icon has been requested
                if(self::$session->icon_requests >= 5) {
                    header("HTTP/1.1 403 Forbidden");
                    exit;
                }

                // Update the request counter
                self::$session->icon_requests += 1;
                self::$session->save();

                // Check if the hash is present in the session data
                if(in_array($hash, self::$session->hashes[2])) {
                    $icons_path = $_SESSION['icon_captcha']['icon_path']; // Icons folder path

                    $file = $icons_path . ((substr($icons_path, -1) === '/') ? '' : '/') . self::$session->theme . '/icon-' .
                        ((self::getCorrectIconHash() === $hash) ? self::$session->hashes[0] : self::$session->hashes[1]) . '.png';

                    // Check if the icon exists
                    if (file_exists($file)) {
                        $mime = null;

                        // Grab the MIME type of the image (all default images are image/png)
                        // Use either finfo_open or mime_content_type, depending on the PHP version
                        if (function_exists("finfo_open")) {
                            $file_info = finfo_open(FILEINFO_MIME_TYPE);
                            $mime = finfo_file($file_info, $file);
                        } else if (function_exists("mime_content_type")) {
                            $mime = mime_content_type($file);
                        }

                        // Show the image and exit the code
                        header('Content-type: ' . $mime);
                        readfile($file);

                        exit;
                    }
                }
            }
        }

        /**
         * Returns the correct icon hash. Used to validate the user's input.
         *
         * @since 2.0.1                     Function was introduced.
         *
         * @return string			        The correct icon hash.
         */
        private static function getCorrectIconHash() {
            if(!isset(self::$session)) {
                self::$session = new CaptchaSession(self::$captcha_id);
            }

            return (isset(self::$captcha_id) && is_numeric(self::$captcha_id))
                ? self::$session->correct_hash : "";
        }

        /**
         * Returns the hash of an image name.
         *
         * @since 2.0.1                     Function was introduced.
         *
         * @param null|string $image        The image name which will be hashed.
         *
         * @return string                   The image hash.
         */
        private static function getImageHash($image = null) {
            if(!isset(self::$session)) {
                self::$session = new CaptchaSession(self::$captcha_id);
            }

            return (!empty($image) && (isset(self::$captcha_id) && is_numeric(self::$captcha_id)))
                ? hash('tiger192,4', $image . hash('crc32', uniqid())) : "";
        }
    }
?>