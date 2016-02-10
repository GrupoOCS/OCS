<?php
// $IDPEDIDO=$_POST["idpedido"];
// echo $IDPEDIDO;
require_once("2checkout-php-master/lib/Twocheckout.php");
Twocheckout::privateKey('C8217C30-D48B-44CD-B4D4-8E88CA82638C');
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
        echo "true";
    }
} catch (Twocheckout_Error $e) { print_r($e->getMessage());}
?>