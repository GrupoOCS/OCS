<?php
$idp=$_POST["idp"];
// echo $IDPEDIDO;
require_once("2checkout-php-master/lib/Twocheckout.php");
Twocheckout::privateKey('422AEC8E-9A5E-4963-AE4C-52C3BEE3FBFF');
Twocheckout::sellerId('901308282');
Twocheckout::sandbox(true);
Twocheckout::verifySSL(false);
try {
    $charge = Twocheckout_Charge::auth(array(
        "merchantOrderId" => "123",
        "token"      => $_POST['token'],
        "currency"   => 'USD',
        "total"      => '10.00',
        "billingAddr" => array(
            "name" => 'Testing Tester',
            "addrLine1" => '123 Test St',
            "city" => 'Columbus',
            "state" => 'OH',
            "zipCode" => '43123',
            "country" => 'USA',
            "email" => 'example@2co.com',
            "phoneNumber" => '555-555-5555'
        )
    ));

    if ($charge['response']['responseCode'] == 'APPROVED') {
        header('Location:tarjeta.php?idp='.$idp);
    }
} catch (Twocheckout_Error $e) { print_r($e->getMessage());}
?>