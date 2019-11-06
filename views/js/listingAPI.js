/**
 * Robert Hill
 * 11/1/19
 * resourceTable.js
 * This is the JavaScript file has functions for the datatables, modal info,
 * and admin modal buttons for pending and declining resources status
 */


//Accept Button function for the Status of selected resource
function acceptedStatus($id) {

    $.post("model/ajax/puts/updateResourceStatus_ajax.php",
        {
            resID: $id,
            choice: 2
        },
        function(data, status)
        {
            //updated resource info
            var info = JSON.parse(data);
            if(info)
            {
                alert("\nThe listing: \n" + info.theraFname + " " + info.theraLname + " \nfrom: \n" +
                    info.Referral_fname + " " + info.Referral_lname + "\n approved for \nOneStop WA " +
                    "VIEW ALL resources");
            }
            else
            {
                console.log(info);
                console.log(status);
            }

        }
    );
}

//Decline Button function for the Status of selected resource
function declinedStatus($id) {

    $.post("model/ajax/puts/updateResourceStatus_ajax.php",
        {
            resID: $id,
            choice: 3
        },
        function(data, status)
        {
            //updated resource info
            var info = JSON.parse(data);
            if(info)
            {
                alert("\n The listing:\n" +
                    info.theraFname + " " + info.theraLname +
                    " \n from \n" + info.Referral_fname + " " + info.Referral_lname +
                    "\n will not be listed to on OneStop WA");
            }
            else
            {
                console.log(info);
                console.log(status);
            }

        }
    );
}

/**
 * Get all the selected info from the Listing resource
 * @param $res integer to Represent the ResourceID in the DB
 */
function getSelectedListingInfo($reso) {
    //ajax post call to php script
    $.post("model/ajax/gets/getResourceDatatable_ajax.php",
        {
            statusID: $reso
        },
        function (data,status) {
            if(data)
            {
                return JSON.parse(data)
            }
            else
            {
                console.log(data);
                console.log(status);
            }

        }
    );
}

// //Edit Button function to Modifiy the selected resource info in the DB
// $('#edit').click(function() {
//     //Post Variables
//     let $res = $('#here').text();
//     let $office = $('#office').text();
//     let $type = $("#Resource_ServiceType").text();
//     let $web = $('#website').text();
//     let $spec = $('#speciality').text();
//
//     //Second Row of Modal
//     let $offEmail= $('#officeEmail').text();
//
//     let $offPhone= $('#officePhone').text();
//
//     //Third Row of Modal
//     let $address = $('#address').text();
//     let $city = $('#city').text();
//     let $state = $('#state').text();
//     let $zip = $('#zip').text();
//
//     //Fourth Row of Modal
//     let $theraGen = $('#theraGender').text();
//
//     //Fifth Row of Modal
//     let $inter = $('#interpreter').text();
//
//     //Referral Row
//     let $refFname = $('#Referral_fname').text();
//     let $refEmail = $("#Referral_email").text();
//     let $refPhone = $("#Referral_phone").text();
//     let $insur = $("#insurance").text();
//     let $fees = $("#fees").text();
//
//     //Bind vars to Post
//     $.post("model/ajax/puts/updateResInfo_ajax.php",
//         //Post Var bind
//         {
//             id: $res,
//             office: $office,
//             type: $type,
//             web: $web ,
//             spec: $spec ,
//
//             //Second Row of Modal
//             offEmail: $offEmail,
//
//             offPhone: $offPhone,
//
//             //Third Row of Modal
//             address: $address ,
//             city:  $city,
//             state:  $state,
//             zip: $zip ,
//
//             //Fourth Row of Modal
//             theraGen: $theraGen ,
//
//             //Fifth Row of Modal
//             inter: $inter ,
//
//             //Referral Row
//             refFname: $refFname,
//             refEmail:  $refEmail,
//             refPhone:  $refPhone,
//             insur:  $insur,
//             fees: $fees
//         },
//         function (data, status) {
//             //updated resource info
//
//         })
// });

