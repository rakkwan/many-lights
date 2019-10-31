/*
Datatable.js

this file will include the data table and the clickable row functionality


TODO: Insert PDO
TODO: Fill Modal with pulled data
 */
$(document).ready(function () {

    console.log("start");
    $.ajax({
        url: '../../../index.php',
        method: 'POST',
        dataType: 'json',
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                console.log(data[i]);
            }
        }
    });

    console.log("end");


    // $('#resources').DataTable({
    //     "ajax": {
    //         "url": "https://coderlite.greenriverdev.com/IT355/oneStopWa/views/javascript/resources.txt"
    //     }
    // });
    $('#resources').DataTable({
        "data": [
            [
                "Therapist",
                "Kristie Baber, MSW, LICSW",
                "LodeStar Therapy",
                "(206)673-3730",
                "N/A",
                "4500 9Tth Ave Ne Suite 300" +
                "Seattle, WA 98105"
            ],
            [
                "Therapist",
                "Amy Baker D' Alessandro",
                "N/A",
                "(206)661-2466",
                "abaker@nwfamilylife.org",
                "10550 Lake City Way NE suit E " +
                "Seattle, WA 98125"
            ],
            [
                "Therapist",
                "Jessie Brooks",
                "Janzen, MSW",
                "(206)905-9931",
                "N/A",
                "5100 S Dawson St " +
                "Suit #104 Seattle, WA 98118"
            ],
            [
                "Therapist",
                "Megan Clarke, MA, LMFT",
                "N/A",
                "N/A",
                "N/A",
                "1800 112th Avenue NE 240W Bellevue, WA 98004"
            ],
            [
                "Therapist",
                "Amy Dutt, LMFT",
                "N/A",
                "(509)378-7753",
                "N/A",
                "7409 W. Grandridge Blvd, Ste " +
                "101 Kennewick, WA 99336"
            ],
            [
                "Crisis",
                "Child Protective Services",
                "N/A",
                "1-866-363-4276",
                "N/A",
                "N/A"
            ],
            [
                "Food Assistance",
                "Enumclaw Kiwanis Food Bank",
                "N/A",
                "360-825-6188 ",
                "N/A",
                "N/A"
            ],
            [
                "Food Assistance",
                "Childrens Home Society Of Washington",
                "N/A",
                "206-364-7930",
                "N/A",
                "North Seattle Family Center"
            ],
            [
                "Food Assistance",
                "Highline Area Food Bank",
                "N/A",
                "206-433-9900 ",
                "N/A",
                "N/A"
            ],
            [
                "Therapist",
                "Lindsay P. Dye, MA, LMHC, NCC",
                "N/A",
                "(509)378-7753",
                "N/A",
                "7409 W. Grandridge Blvd, Ste 101 " +
                "Kennewick, WA 99336"
            ],
            [
                "Therapist",
                "Jill Dziko",
                "N/A",
                "(206)542-7516",
                "N/A",
                "18532 Firlands Way N " +
                "Shoreline, WA 98133"
            ]
        ]
    });
    $('#adminResources').DataTable({
        "data": [
            [
                "Therapist",
                "Kristie Baber, MSW, LICSW",
                "LodeStar Therapy",
                "(206)673-3730",
                "N/A",
                "4500 9Tth Ave Ne Suite 300" +
                "Seattle, WA 98105"
            ],
            [
                "Therapist",
                "Amy Baker D' Alessandro",
                "N/A",
                "(206)661-2466",
                "abaker@nwfamilylife.org",
                "10550 Lake City Way NE suit E " +
                "Seattle, WA 98125"
            ],
            [
                "Therapist",
                "Jessie Brooks",
                "Janzen, MSW",
                "(206)905-9931",
                "N/A",
                "5100 S Dawson St " +
                "Suit #104 Seattle, WA 98118"
            ],
            [
                "Therapist",
                "Megan Clarke, MA, LMFT",
                "N/A",
                "N/A",
                "N/A",
                "1800 112th Avenue NE 240W Bellevue, WA 98004"
            ],
            [
                "Therapist",
                "Amy Dutt, LMFT",
                "N/A",
                "(509)378-7753",
                "N/A",
                "7409 W. Grandridge Blvd, Ste " +
                "101 Kennewick, WA 99336"
            ],
            [
                "Crisis",
                "Child Protective Services",
                "N/A",
                "1-866-363-4276",
                "N/A",
                "N/A"
            ],
            [
                "Food Assistance",
                "Enumclaw Kiwanis Food Bank",
                "N/A",
                "360-825-6188 ",
                "N/A",
                "N/A"
            ],
            [
                "Food Assistance",
                "Childrens Home Society Of Washington",
                "N/A",
                "206-364-7930",
                "N/A",
                "North Seattle Family Center"
            ],
            [
                "Food Assistance",
                "Highline Area Food Bank",
                "N/A",
                "206-433-9900 ",
                "N/A",
                "N/A"
            ],
            [
                "Therapist",
                "Lindsay P. Dye, MA, LMHC, NCC",
                "N/A",
                "(509)378-7753",
                "N/A",
                "7409 W. Grandridge Blvd, Ste 101 " +
                "Kennewick, WA 99336"
            ],
            [
                "Therapist",
                "Jill Dziko",
                "N/A",
                "(206)542-7516",
                "N/A",
                "18532 Firlands Way N " +
                "Shoreline, WA 98133"
            ]
        ]
    });
    console.log("JS loaded");

    //     Reroute to a new page with clickable rows
    // $('#resources tbody').on('click', 'tr', function () {
    //     // console.log($(this)[0].cells[0].textContent);
    //     let serviceName = $(this)[0].cells[0].textContent;
    //     let reroute = "https://coderlite.greenriverdev.com/IT355/oneStopWa/resources/service/" + serviceName;
    //
    //     console.log(reroute);
    //
    //     //reroute manually
    //     window.location = reroute;
    //
    //     //send with ajax
    //     $.ajax({
    //         type: "POST",
    //         url: reroute,
    //         data: {name: serviceName},
    //
    //         success: function (data) {
    //
    //             // do stuff
    //
    //             // call next ajax function
    //             console.log(data);
    //         }
    //
    //
    //     });
    //
    // });
    //

    /*
     "data": [
            [
                "Therapist",
                "Kristie Baber, MSW, LICSW",
                "LodeStar Therapy",
                "(206)673-3730",
                "N/A",
                "4500 9Tth Ave Ne Suite 300" +
                "Seattle, WA 98105"
            ],
            [
                "Therapist",
                "Amy Baker D' Alessandro",
                "N/A",
                "(206)661-2466",
                "abaker@nwfamilylife.org",
                "10550 Lake City Way NE suit E " +
                "Seattle, WA 98125"
            ],
            [
                "Therapist",
                "Jessie Brooks",
                "Janzen, MSW",
                "(206)905-9931",
                "N/A",
                "5100 S Dawson St " +
                "Suit #104 Seattle, WA 98118"
            ],
            [
                "Therapist",
                "Megan Clarke, MA, LMFT",
                "N/A",
                "N/A",
                "N/A",
                "1800 112th Avenue NE 240W Bellevue, WA 98004"
            ],
            [
                "Therapist",
                "Amy Dutt, LMFT",
                "N/A",
                "(509)378-7753",
                "N/A",
                "7409 W. Grandridge Blvd, Ste " +
                "101 Kennewick, WA 99336"
            ],
            [
                "Crisis",
                "Child Protective Services",
                "N/A",
                "1-866-363-4276",
                "N/A",
                "N/A"
            ],
            [
                "Food Assistance",
                "Enumclaw Kiwanis Food Bank",
                "N/A",
                "360-825-6188 ",
                "N/A",
                "N/A"
            ],
            [
                "Food Assistance",
                "Childrens Home Society Of Washington",
                "N/A",
                "206-364-7930",
                "N/A",
                "North Seattle Family Center"
            ],
            [
                "Food Assistance",
                "Highline Area Food Bank",
                "N/A",
                "206-433-9900 ",
                "N/A",
                "N/A"
            ],
            [
                "Therapist",
                "Lindsay P. Dye, MA, LMHC, NCC",
                "N/A",
                "(509)378-7753",
                "N/A",
                "7409 W. Grandridge Blvd, Ste 101 " +
                "Kennewick, WA 99336"
            ],
            [
                "Therapist",
                "Jill Dziko",
                "N/A",
                "(206)542-7516",
                "N/A",
                "18532 Firlands Way N " +
                "Shoreline, WA 98133"
            ]
        ]
     */


    /*
    * pop-up modal information
    *
    * */
    $('#resources tbody').on('click', 'tr', function () {

        let serviceName = $(this)[0].cells[0].textContent;

        console.log(serviceName);

        // data-toggle = "modal"
        // data - target = "#centralModalSuccess"

        let a = $(this)[0];
        console.log($(this)[0]);
        // console.log($(this)[0].text);
        $(this).attr("data-toggle", "modal");
        $(this).attr("data-target", "#centralModalSuccess");

        // $("#centralModalSuccess").modal(serviceName);

        // Fill modal with content from link href


    });
    $('#adminResources tbody').on('click', 'tr', function () {

        let serviceName = $(this)[0].cells[0].textContent;

        console.log(serviceName);

        // data-toggle = "modal"
        // data - target = "#centralModalSuccess"

        let a = $(this)[0];
        console.log($(this)[0]);
        // console.log($(this)[0].text);
        $(this).attr("data-toggle", "modal");
        $(this).attr("data-target", "#centralAdminModalSuccess");

        // $("#centralModalSuccess").modal(serviceName);

        // Fill modal with content from link href


    });

    $('#approveButton').on('click', function () {
        alert("Approved!");
    });
    $('#declineButton').on('click', function () {
        alert("Declined!");
    });

});
