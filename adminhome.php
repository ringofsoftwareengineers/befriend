<?php
session_start();
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}
?>
<!-- Start: page-top-outer jjjjjjjjjjj-->
<?php include './header.php'; ?>
<!-- End: page-top-outer jjjjjjjjjjj-->
<div class="clear"></div>

<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
    <!-- start content -->
    <div id="content">

        <!--  start page-heading -->
        <div id="page-heading">
            <h1>Administrator Home Page</h1>
        </div>
        <!-- end page-heading -->

        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
            <tr>
                <th rowspan="3" class="sized"><img src="imagesadminpage/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
                <th class="topleft"></th>
                <td id="tbl-border-top">&nbsp;</td>
                <th class="topright"></th>
                <th rowspan="3" class="sized"><img src="imagesadminpage/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
            </tr>
            <tr>
                <td id="tbl-border-left"></td>
                <td>
                    <!--  start content-table-inner ...................................................................... START -->
                    <div id="content-table-inner">

                        <!--  start table-content  -->
                        <div id="table-content">
                            <h3>
                                <a style="color: white; background-color: blue;" class="btn btn-default linkButton"  href="createlogin.php">
                                    Create User Login
                                </a>
                            </h3>
                            <h3>
                                <a style="color: white; background-color: darkorange;" class="btn btn-default linkButton"  href="create-admin.php">
                                    Create Admin User
                                </a>
                            </h3>
                            <h3>
                                <a style="color: white; background-color: green;" class="btn btn-default linkButton"  href="create-survey.php">
                                    Add Survey
                                </a>
                            </h3>
                            <h3>
                                <a style="color: white; background-color: red;" class="btn btn-default linkButton"  href="volunteer-list.php">
                                    Volunteers' List
                                </a>
                            </h3>
                            <h3>
                                <a style="color: white; background-color: purple;" class="btn btn-default linkButton"  href="survey-reports.php">
                                    Survey Reports
                                </a>
                            </h3>
                            <h3>
                                <a style="color: white; background-color: deeppink;" class="btn btn-default linkButton"  href="assign-survey.php">
                                    Assign Surveys
                                </a>
                            </h3>
                            <h3>
                                <a style="color: white; background-color: darkslateblue;" class="btn btn-default linkButton"  href="volunteer-survey-pending.php">
                                    Pending Surveys
                                </a>
                            </h3>
                            <h3>
                                <a style="color: white; background-color: brown;" class="btn btn-default linkButton"  href="volunteer-survey-completed.php">
                                    Completed Surveys
                                </a>
                            </h3>
                            <h3>
                                <a style="color: white; background-color: purple;" class="btn btn-default linkButton"  href="display-report-list.php">
                                    Monthly Reports 
                                </a>
                            </h3>


                        </div>
                        <!--  end table-content  -->

                        <div class="clear"></div>

                    </div>
                    <!--  end content-table-inner ............................................END  -->
                </td>
                <td id="tbl-border-right"></td>
            </tr>
            <tr>
                <th class="sized bottomleft"></th>
                <td id="tbl-border-bottom">&nbsp;</td>
                <th class="sized bottomright"></th>
            </tr>
        </table>
        <div class="clear">&nbsp;</div>

    </div>
    <!--  end content -->
    <div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>

<!-- start footer -->
<?php
include './footer.php';
?>
<!-- end footer -->

</body>


</html>
