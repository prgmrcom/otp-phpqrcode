<?php
/**
 * Generates inline QR code images using phpqrcode
 *
 * @author prgmr.com <info@prgmr.com>
 */

require_once "/usr/share/phpqrcode/phpqrcode.php";

/**
 * Generates inline QR code
 *
 * This function returns a full img element
 * which can be echoed directly to a webpage.
 * The image data is base-64 encoded PNG.
 *
 *  @param Array $vars Array of OTP parameters
 *   issuer   string      company or entity that this OTP belongs to
 *   username string      username for this OTP
 *   secret   string      secret base-32 string used to calculate your OTP
 *   alt      string|null alt text for the QR image
 *   id       string|null ID for the image
 *
 * @return string
 */
function inline_otp($vars )
{
    $issuer=$vars["issuer"];
    $username=$vars["username"];
    $secret=$vars["secret"];
    $alt = "";
    $imgid = "";
    if (isset($vars["alt"])) {
        $alt=$vars["alt"];
    }
    if (isset($vars["id"])) {
        $imgid = $vars["id"];
    }
    $otpurl = 'otpauth://totp/' . $issuer . ':' . $username
    . '?secret=' . $secret . '&issuer=' . $issuer;
    ob_start();
    QRCode::png($otpurl, null);
    $imageString = base64_encode(ob_get_contents());
    ob_end_clean();
    $imageSrc="data:image/png;base64," . $imageString;
    echo('<img src="' . $imageSrc . '" id="' . $imgid . '" alt="' . $alt . '" />');
}
?>
