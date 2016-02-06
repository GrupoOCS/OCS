<?php
$TARJETA=$_POST["dato1"];
$mes=$_POST["mes"];
$ano=$_POST["ano"];
$codi=$_POST["codigo"];



require_once("2checkout-php-master/lib/Twocheckout.php");
Twocheckout::privateKey('sandbox-private-key');
Twocheckout::sellerId('sandbox-seller-id');
Twocheckout::sandbox(true);
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
        echo "Thanks for your Order!";
        echo "<h3>Return Parameters:</h3>";
        echo "<pre>";
        print_r($charge);
        echo "</pre>";

    }
} catch (Twocheckout_Error $e) {print_r($e->getMessage());}
?>