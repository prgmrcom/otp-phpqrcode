# otp-phpqrcode

This library generates an image to embed directly in a web page using phpqrcode.
This method avoids:

  * Exposing sensitive data to a third-party web service.
  * Sending the OTP seed as a parameter to another page,
    potentially recording it to a web server log.
  * Testing a client-side implementation with
    multiple clients.

## Deploying

Edit:

   require_once "/usr/share/phpqrcode/phpqrcode.php"

in the source to the actual phpqrcode library path.

## Sample usage

    <?php
    require_once("otp-phpqrcode.php");
    inline_otp([
        'id' => "two_factor_qr",
        'username' => $username,
        'secret' =>  $two_factor_key_base32,
        'issuer' => $two_factor_issuer,
    ]);
    ?>
