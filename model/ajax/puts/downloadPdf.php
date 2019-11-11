<?php

//require_once 'vendor/autoload.php';
$ready = false;
if ($_COOKIE) {
    $ready = true;
//    echo "cookies set<br>";
//    debug_to_console($_COOKIE['age']);
//    echo json_decode($_COOKIE['age']);


    try {
        $mpdf = new \Mpdf\Mpdf(['debug' => true]);
        $mpdf->WriteHTML("<p>" . $_COOKIE['refresh'] . "</p>");

        $mpdf->WriteHTML("<p>" . $_COOKIE['age'] . "</p>");
        $mpdf->WriteHTML("<p><b>Resource Type</b> : " . $_COOKIE['resource'] . "</p>");
        $mpdf->WriteHTML("<p><b>Business Name</b> : " . $_COOKIE['office'] . "</p>");
        $mpdf->WriteHTML("<p><b>Website</b> : " . $_COOKIE['providerName'] . "</p>");
        $mpdf->WriteHTML("<p><b>Provider Name</b> : " . $_COOKIE['office'] . "</p>");
// Other code
        $mpdf->Output();
    } catch
    (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
        // Process the exception, log, print etc.
        echo $e->getMessage();
    }


    setcookie("age", "", time() - 3600);


}


if ($ready) {
//    header('Location: ' . $_SERVER['REQUEST_URI']);


}

/* JS resonse on click to be printed example
resourceID: "8", speciality: "Therapy", office: "test2", officeEmail: "testone@testtwo.com", officePhone: "4444444222"
Referral_email: "samanthadesmul@yahoo.com"
Referral_fname: "Samantha Desmul"
Referral_lname: "Ref Name"
Referral_phone: "5555555555"
Resource_ServiceType: "Therapy"
Resource_status: "Accepted"
address: "test333 33 st"
age: null
city: "test3city"
countyOne: "County"
countyThree: null
countyTwo: null
fee: ""
insurance: ""
interpreter: ""
office: "test2"
officeEmail: "testone@testtwo.com"
officePhone: "4444444222"
resourceID: "8"
speciality: "Therapy"
state: "WA"
theraFname: "testtherfnamonettete"
theraGender: ""
theraLname: "testherlnamonetttt"
website: ""
zip: "33333"

*/


//function debug_to_console($data)
//{
//    $output = $data;
//    if (is_array($output))
//        $output = implode(',', $output);
//
//    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
//}
