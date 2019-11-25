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
                jQuery.noConflict();
                //Confimation For user
                $("#confirmEditModalSuccess").modal("show");
                $("#confirmEdit").text("\nThe listing: \n" + info.theraFname + " " + info.theraLname + " \nfrom: \n" +
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
                jQuery.noConflict();
                //Confimation For user
                $("#confirmEditModalSuccess").modal("show");
                $("#confirmEdit").text("\n The listing:\n" +
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


