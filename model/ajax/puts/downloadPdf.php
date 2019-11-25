<?php
session_start();

$ready = false;
//echo print_r($_POST);
$_SESSION['ready'] = false;


//require_once 'vendor/autoload.php';
if ($_COOKIE) {

    try {
        $mpdf = new \Mpdf\Mpdf(['debug' => true]);

        $mpdf->WriteHTML("<h1 align=\"center\">One Stop WA</h1>");

        //first segment
        $mpdf->WriteHTML("<p><b>Resource Type</b> : " . $_COOKIE['resource'] . "</p>" .
            "<p><b>Business Name</b> : " . $_COOKIE['office'] . "</p>" .
            "<p><b>Website</b> : " . $_COOKIE['website'] . "</p>" .
            "<p><b>Provider Name</b> : " . $_COOKIE['providerName'] . "</p>");

        //Second segment
        $mpdf->WriteHTML("<p><b>Email</b> : " . $_COOKIE['officeEmail'] . "</p>" .
            "<p><b>Phone</b> : " . $_COOKIE['officePhone'] . "</p>" .
            "<p><b>County</b> : " . $_COOKIE['county'] . "</p>" .
            "<p><b>Provider Gender</b> : " . $_COOKIE['providerGender'] . "</p>");

        //Third segment
        $mpdf->WriteHTML("<p><b>Address</b> : " . $_COOKIE['address'] . "</p>" .
            "<p><b>Ages Seen</b> : " . $_COOKIE['agesSeen'] . "</p>" .
            "<p><b>Credentials</b> : " . $_COOKIE['credentials'] . "</p>");

        //Forth segment
        $mpdf->WriteHTML("<p><b>Languages/Interpreter</b> : " . $_COOKIE['interpreter'] . "</p>" .
            "<p><b>Insurance Accepted</b> : " . $_COOKIE['insurance'] . "</p>" .
            "<p><b>Fees</b> : " . $_COOKIE['fee'] . "</p>");

        //Days table
        $table = '<table class="tg">
  <tr>
    <th class="tg-0lax">Monday</th>
    <th class="tg-0lax">Tuesday</th>
    <th class="tg-0lax">Wednesday</th>
    <th class="tg-0lax">Thursday</th>
    <th class="tg-0lax">Friday</th>
    <th class="tg-0lax">Saturday</th>
    <th class="tg-0lax">Sunday</th>
  </tr>
  <tr>
    <td class="tg-0lax">9:00am-5:00pm</td>
    <td class="tg-0lax">9:00am-5:00pm</td>
    <td class="tg-0lax">9:00am-5:00pm</td>
    <td class="tg-0lax">9:00am-5:00pm</td>
    <td class="tg-0lax">10:00am-3:00pm</td>
    <td class="tg-0lax">Closed</td>
    <td class="tg-0lax">Closed</td>
  </tr>
</table>';

        $tableStyles = file_get_contents("css/pdfStyles.css");
        $mpdf->WriteHTML($tableStyles, 1);
        $mpdf->WriteHTML($table);


    } catch
    (\Mpdf\MpdfException $e) { // Note: safer fully qualified exception name used for catch
        // Process the exception, log, print etc.
        echo $e->getMessage();
    } finally {
        if ($ready == false) {


//            echo "in " . $ready;
//            $mpdf->Output('oneStopWaResource.pdf', 'I');

            clearstatcache();
            $mpdf->Output('oneStopWaResource.pdf', 'I');

            header('https://coderlite.greenriverdev.com/IT355/oneStopWa/download');

        }
    }

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


function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
