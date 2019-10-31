<?php
/**
 * Robert Hill
 * 10/29/2019
 * CoderLite
 * This Class connects the db and returns a Modal populated with selected resource values
 */

//access the DB
//require_once("../model/database.php");
//$db = new Databases();

//get the key of the selected row
$id = isset($_POST['id']) ? $_POST['id'] : 1;

//pass the key of the selected row
//get the results from the DB
$db->getOneResource($id);

return $id;
//if($results)
//{
//    echo "omg";
//}
////Check if result has values
//if ($results) {
////create the Modal
//    foreach ($results as $row) {
//        echo '
//
//<!-- Central Modal-->
//<div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog">
//    <div class="modal-dialog modal-notify modal-warning modal-lg" role="document">
//        <!--Content-->
//        <div class="modal-content">
//            <!--Header-->
//            <div class="modal-header purple text-white">
//                <p class="heading lead">Browse Resource</p>
//
//                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                    <span aria-hidden="true" class="white-text">&times;</span>
//                </button>
//            </div>
//
//            <!--Modal body-->
//            <!--TODO: Update with DB information -->
//            <div class="modal-body">
//                <div class="text-center">
//
//                    <div class="container">
//                        <!--Recommended Resource information-->
//                        <h3 class="bg-light">Resource Information</h3>
//                        <div class="row">
//
//                            <div class="col">
//                                <h5>Resource Type</h5>
//                                <p>'.$row["speciality"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Business Name</h5>
//                                <p>'.$row["office"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Website</h5>
//                                <p>'.$row["website"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Provider Name</h5>
//                                <p>'.$row["insurance"].'</p>
//                            </div>
//                        </div>
//                        <hr>
//                        <div class="row">
//                            <div class="col">
//                                <h5>Email <a href="mailto:'.$row["officeEmail"].'?Subject=OneStop%20WA%20Recommendation%20"
//                                             target="_top">
//                                    <i class="fas fa-envelope"></i>
//                                </a></h5>
//                                <p>'.$row["officeEmail"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Phone <a href="tel:'.$row["officePhone"].'">
//                                    <i class="fas fa-phone"></i>
//                                </a></h5>
//                                <p>'.$row["officePhone"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Secondary Phone <a href="tel:'.$row["officePhone"].'">
//                                    <i class="fas fa-phone"></i>
//                                </a></h5>
//                                <p>'.$row["officePhone"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>County</h5>
//                                <p>King</p>
//                            </div>
//                        </div>
//                        <hr>
//                        <div class="row">
//                            <div class="col">
//                                <h5>Resource Address</h5>
//                                <p>'.$row["address"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Resource City</h5>
//                                <p>'.$row["city"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Resource State</h5>
//                                <p>WA</p>
//                            </div>
//                            <div class="col">
//                                <h5>Resource Zip</h5>
//                                <p>'.$row["zip"].'</p>
//                            </div>
//                        </div>
//                        <hr>
//                        <div class="row">
//                            <div class="col">
//                                <h5>Provider Gender</h5>
//                                <p>'.$row["theraGender"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Ages Seen</h5>
//                                <p>Need To put in DB</p>
//                            </div>
//                            <div class="col">
//                                <h5>Credentials</h5>
//                                <p>PhD</p>
//                            </div>
//                            <div class="col">
//                                <h5>Secondary Credentials</h5>
//                                <p>Licensed Clinical Social Worker</p>
//                            </div>
//                        </div>
//                        <hr>
//                        <div class="row">
//                            <div class="col">
//                                <h5>Languages/Interpreter</h5>
//                                <p>'.$row["interpreter"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Insurance Accepted</h5>
//                                <p>'.$row["insurance"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Fees</h5>
//                                <p>'.$row["fee"].'</p>
//                            </div>
//                            <div class="col">
//                                <h5>Secondary Credentials</h5>
//                                <p>Licensed Clinical Social Worker</p>
//                            </div>
//                        </div>
//                        <hr>
//                        <div class="row">
//                            <div class="col">
//                                <h5>Monday</h5>
//                                <p>9:00am-5:00pm</p>
//                            </div>
//                            <div class="col">
//                                <h5>Tuesday</h5>
//                                <p>9:00am-5:00pm</p>
//                            </div>
//                            <div class="col">
//                                <h5>Wednesday</h5>
//                                <p>9:00am-5:00pm</p>
//                            </div>
//                            <div class="col">
//                                <h5>Thursday</h5>
//                                <p>9:00am-5:00pm</p>
//                            </div>
//                            <div class="col">
//                                <h5>Friday</h5>
//                                <p>9:00am-4:00pm</p>
//                            </div>
//                            <div class="col">
//                                <h5>Saturday</h5>
//                                <p>Closed</p>
//                            </div>
//                            <div class="col">
//                                <h5>Sunday</h5>
//                                <p>Closed</p>
//                            </div>
//                        </div>
//                    </div>
//
////                    <!--Contact info for user who referred resource-->
////                    <h3 class="bg-light">Referee Information</h3>
////                    <div class="row">
////                        <div class="col">
////                            <h5>Name</h5>
////                            <p>John Doe</p>
////                        </div>
////                        <div class="col">
////                            <h5>Email <a href="mailto:Johndoe@gmail.com?Subject=OneStop%20WA%20Recommendation%20"
////                                         target="_top">
////                                <i class="fas fa-envelope"></i>
////                            </a></h5>
////                            <p>Johndoe@gmail.com</p>
////                        </div>
////                        <div class="col">
////                            <h5>Phone <a href="tel:{{@phoneNumber}}">
////                                <i class="fas fa-phone"></i>
////                            </a></h5>
////                            <p>(111)222-3333</p>
////                        </div>
////                    </div>
//                </div>
//            </div>
//
//            <!--Footer-->
//            <div class="modal-footer justify-content-center purple">
//                <h6 class="text-white"><i class="fa fa-exclamation-circle text-warning"
//                                          aria-hidden="true"></i><b class="text-warning">NOTE:
//                </b>There is no guarantee on quality of service, or that this
//                    resource\'s information is
//                    current!</h6>
//            </div>
//        </div>
//    </div>
//    <!--/.Content-->
//        ';
//    }
//}

////populate the modal with the results values
////display the modal to the html
//
//else
//    echo "<h3> No info found for the Resource</h3>";
