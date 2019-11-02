/**
 * Robert Hill
 * 11/1/19
 * resourceTable.js
 * This is the JavaScript file has functions for the datatables, modal info,
 * and admin modal buttons for pending and declining resources status
 */

//Listing Data Table
$(document).ready(function() {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

//Modal information
$('#dtBasicExample').on('click', 'tr', function() {

    //get value of resource from the datatable
    let $res = $(this).attr("title");
    //ajax post call to php script
    $.post("model/ajax/gets/getResourceDatatable_ajax.php", {
            statusID: $res
        },
        function(data, status) {
            var info = JSON.parse(data);

            if (info) {
                //First Row of form
                $('#office').text(info.office);
                $("#Resource_ServiceType").text(info.Resource_ServiceType);
                $('#website').text(info.website);
                $('#speciality').text(info.theraFname + " " + info.theraLname);

                //Second Row of Modal
                $('#officeEmail').text(info.officeEmail);

                $('#officePhone').text(info.officePhone);

                //Third Row of Modal
                $('#address').text(info.address);
                $('#city').text(info.city);
                $('#state').text(info.state);
                $('#zip').text(info.zip);

                //Fourth Row of Modal
                $('#theraGender').text(info.theraGender);

                //Fifth Row of Modal
                $('#interpreter').text(info.interpreter);

                //Referral Row
                $('#Referral_fname').text(info.Referral_fname + " " + info.Referral_lname);
                $("#Referral_email").text(info.Referral_email);
                $("#Referral_phone").text(info.Referral_phone);
                $("#insurance").text(info.insurance);
                $("#fees").text(info.insurance);

                //admin Row
                $('#here').text(info.resourceID);
            }
        });
    $(this).attr("data-toggle", "modal");
    $(this).attr("data-target", "#centralModalSuccess");

});

//Accept Button function for the Status of selected resource
$('#approve').click(function() {

    let $res = $('#here').text();

    $.post("model/ajax/puts/updateResourceStatus_ajax.php", {
            statusID: $res,
            choice: 2
        },
        function(data, status) {
            //updated resource info
            var info = JSON.parse(data);
            alert("\nThe listing: \n" + info.theraFname + " " + info.theraLname + " \nfrom: \n" +
                info.Referral_fname + " " + info.Referral_lname + "\n approved for \nOneStop WA " +
                "VIEW ALL resources");
        }
    );
});
//Decline Button function for the Status of selected resource
$('#decline').click(function() {

    let $res = $('#here').text();

    $.post("model/ajax/puts/updateResourceStatus_ajax.php", {
            statusID: $res,
            choice: 3
        },
        function(data, status) {
            //updated resource info
            var info = JSON.parse(data);
            alert("\n The listing:\n" +
                info.theraFname + " " + info.theraLname +
                " \n from \n" + info.Referral_fname + " " + info.Referral_lname +
                "\n will not be listed to on OneStop WA");
        }
    );
});