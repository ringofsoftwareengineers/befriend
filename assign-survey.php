<?php
session_start();
$message = "";
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}

if (isset($_POST['submit'])) {
    $survey_id = $_POST['survey'];
    $volunteer_id = $_POST['volunteer'];
    $year = $_POST['year'];
    $month=$_POST['month'];
    if(!assign_survey($survey_id, $volunteer_id,$year,$month))
    {
        $message="This survey already assigned to the volunteer for  $month $year";
    }
}elseif(isset ($_POST['submit_all']))
{
    $survey_id = $_POST['survey'];    
    $year = $_POST['year'];
    $month=$_POST['month'];
    
    $volunteerIDs= getAllVolunteerIDs();
    foreach ($volunteerIDs as $volunteer_id)
    {
        assign_survey($survey_id, $volunteer_id,$year,$month);
    }//end foreach
    
    
}//endelseif
if (isset($_GET['assignment_id'])) {
    $id = $_GET['assignment_id'];
    delete_assignment($id);
    header("location: assign-survey.php");
}//end function
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
            <h1>Assign Surveys</h1>
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
                            <?php
                            if(strlen($message)>0)
                            {
                                ?>
                            <h3 style="color:red; text-align: center;"><?php echo $message; ?></h3>
                            <?php
                            }
                            ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6" style="margin-left: auto; margin-right: auto; float: none;">
                                        <form method="post">
                                            <div class="row">
                                                <?php
                                                $result = getAllRegisteredUsers();
                                                ?>
                                                <div class="col-xs-12 col-sm-6 col-md-6"><label>Select Volunteer</label></div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <select class="form-control" name="volunteer" required="">
                                                        <?php
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['firstname'] . " " . $row['surname']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">
                                                <?php
                                                $result1 = getAllActiveSurveys();
                                                ?>
                                                <div class="col-xs-12 col-sm-6 col-md-6"><label>Select Survey</label></div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <select class="form-control" name="survey" required="">
                                                        <?php
                                                        while ($row = mysqli_fetch_array($result1)) {
                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['title'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>


                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <label>Enter Year</label>
                                                </div>
                                                <?php 
                                                $year = date("Y");
                                                 $min = $year-2; 
                                                 $max = $year+2;
                                                ?>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <input min="<?php echo $min; ?>" max="<?php echo $max; ?>" type="number" name="year" required="" value="<?php echo $year; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <label>Select Month</label>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                    <select class="form-control" name="month" required="">
                                                        <option value="">Select a month</option>
                                                        <option value="January">January</option>
                                                        <option value="February">February</option>
                                                        <option value="March">March</option>
                                                        <option value="April">April</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="July">July</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="October">October</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6 col-md-6">

                                                    <input style="background-color: blue; color: white; float: right"  type="submit" name="submit" value="Assign Survey" class="form-control">

                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-md-6">

                                                    <input style="background-color: orange; color: white; float: left;"  type="submit" name="submit_all" value="Assign to All" class="form-control">

                                                </div>
                                            </div>
                                        </form> 
                                    </div>
                                </div>
                            </div>

                            <table id="mydatatable" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="background-color: red;height: 40px;font-size: 15px;color: white;">
                                        <th>Sr. No</th> <th>Volunteer</th><th>Month</th> <th>Survey</th><th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 1;
                                    $result2 = get_all_assigned_surveys();
                                    while ($row = mysqli_fetch_array($result2)) {
                                        $survey_title = get_survey_name_by_id($row['survey_id']);

                                        $user_name = get_user_name_by_id($row['volunteer_id']);
                                        ?>
                                        <tr>
                                            <td><?php echo $counter;
                                    $counter++;
                                        ?></td>
                                            <td><?php echo $user_name; ?></td>
                                            <td><?php echo $row['month']." ".$row['year']; ?></td>
                                            <td><?php echo $survey_title; ?></td>
                                            <td><a class="btn btn-danger" onclick="return window.confirm('Are you sure to delete?')" href="?assignment_id=<?php echo $row['id']; ?>" style="color:white;">Delete</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>  
                                </tbody>
                            </table>


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
