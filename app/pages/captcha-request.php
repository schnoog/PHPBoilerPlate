<?php



//error_reporting(E_ALL);
error_log(print_r($_REQUEST,true));
IconCaptcha::setIconsFolderPath(FRONTEND_DIR  . "/images/icons/");
    if(!empty($_POST) && isAjaxRequest()) {
        if((isset($_POST['rT']) && is_numeric($_POST['rT'])) && (isset($_POST['cID']) && is_numeric($_POST['cID']))) {
            switch((int)$_POST['rT']) {
                case 1: // Requesting the image hashes
                    $captcha_theme = (isset($_POST['tM']) && ($_POST['tM'] === "light" || $_POST['tM'] === "dark")) ? $_POST['tM'] : "light";

                    echo IconCaptcha::getCaptchaData($captcha_theme, $_POST['cID']);
                    exit;
                case 2: // Setting the user's choice
                    echo IconCaptcha::setSelectedAnswer($_POST);
                    exit;
                default:
                    break;
            }
        }
    }

    // HTTP GET - Requesting the actual images
    if((!empty($_GET) && isset($_GET['hash']) && strlen($_GET['hash']) === 48) &&
        (isset($_GET['cid']) && is_numeric($_GET['cid'])) && !isAjaxRequest()) {
        IconCaptcha::getIconFromHash($_GET['hash'], $_GET['cid']);
        exit;
    }

    header("HTTP/1.1 400 Bad Request");
    exit;

    // Adds another level of security to the Ajax call.
    // Only requests made through Ajax are allowed.
    // NOTE: THE HEADER CAN BE SPOOFED
    function isAjaxRequest() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }