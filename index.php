<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Recaptcha 2 sample</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link href="./css/styles.css" rel="stylesheet">
</head>
<body>

<form action="./" method="post" onsubmit="return formValidate()">
    <div>
        <input type="text" name="username" placeholder="Username" required>
    </div>
    <div>
        <input type="email" name="email" placeholder="Email">
    </div>
    <div class="g-recaptcha" data-sitekey="6LdjECQUAAAAAHEBViLSQ67X6G0yqAyAyZoUP_Z_"></div>
    <div>
        <button type="submit">Submit form</button>
    </div>
</form>

<?php
if (count($_POST)) {
    // PHP library that handles calling reCAPTCHA
    // get in from here: https://github.com/formvalidation/addon-recaptcha/blob/master/demo/v2/recaptchalib.php
    require_once "recaptchalib.php";
    $secret = '6LdjECQUAAAAAPwdM5LfKaySior3fATBbBT68LId';
    $reCaptcha = new ReCaptcha($secret);
    // if submitted check response
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
        if ($response != null && $response->success) {
            ?><div class="results"><h3>Success!</h3><pre><?php print_r($_POST); ?></pre></div><?php
        }
    }
}
?>

<script>
    // do browser validation
    // this is required for captcha frontend validation, a user must click on recaptcha before submit
    function formValidate() {
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
            alert('Please confirm than you are not a robot');
            return false;
        } return true;
    }
</script>


</body>

</html>