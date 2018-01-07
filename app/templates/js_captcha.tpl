
        <!-- Initialize the IconCaptcha -->
        <script async type="text/javascript">





            $(window).ready(function() {
                $('.captcha-holder').iconCaptcha( {
                    captchaTheme: ["light", "dark"], // Select the theme(s) of the Captcha(s). Available: light, dark
                    captchaFontFamily: '', // Change the font family of the captcha. Leaving it blank will add the default font to the end of the <body> tag.
                    captchaClickDelay: 500, // The delay during which the user can't select an image.
                    captchaHoverDetection: true, // Enable or disable the cursor hover detection.
                    sectoken: "{$pagedata.sectoken}", 
                    enableLoadingAnimation: true, // Enable of disable the fake loading animation. Doesn't do anything, just looks cool ;)
                    loadingAnimationDelay: 1500, // How long the fake loading animation should play.
                    requestIconsDelay: 1500, // How long should the script wait before requesting the hashes and icons? (to prevent a high(er) CPU usage during a DDoS attack)
                    captchaAjaxFile: '/captcha-request', // The path to the Captcha validation file.
                    captchaMessages: { // You can put whatever message you want in the captcha.
                        header: "{"Select the image that does not belong in the row"|gettext}",
                        correct: {
                            top: "{"Great!"|gettext}",
                            bottom: "{"You do not appear to be a robot."|gettext}"
                        },
                        incorrect: {
                            top: "{"Oops!"|gettext}",
                            bottom: "{"You've selected the wrong image."|gettext}"
                        }
                    }
                } )
                .bind('init.iconCaptcha', function(e, id) { // You can bind to custom events, in case you want to execute some custom code.
                    console.log('Event: Captcha initialized', id);
                } ).bind('selected.iconCaptcha', function(e, id) {
                    console.log('Event: Icon selected', id);
                } ).bind('refreshed.iconCaptcha', function(e, id) {
                    console.log('Event: Captcha refreshed', id);
                } ).bind('success.iconCaptcha', function(e, id) {
                    
                    $('#sndbtn').attr('type', 'submit');
                    $('#sndbtn').prop('onclick',null).off('click');
                    
                    console.log('Event: Correct input', id);
                } ).bind('error.iconCaptcha', function(e, id) {
                    console.log('Event: Wrong input', id);
                } );
            } );
        </script>











