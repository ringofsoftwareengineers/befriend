<?php
session_start();
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}

if (!isset($_SESSION['volunteer_id'])) {

    header("location: index.php");
}

if (isset($_GET['taken_survey_id'])) {
    $_SESSION['taken_survey_id'] = $_GET['taken_survey_id'];
    header('location: survey.php');
}
?>

        <?php include './header.php'; ?>
        <div class="clear"></div>

        <!-- start content-outer -->
        <div id="content-outer">
            <!-- start content -->
            <div id="content">


                <div id="page-heading"><h1>Volunteer List</h1></div>



                <div class="clear">&nbsp;</div>

                <div style="display: block;">
                    <table id="mydatatable" class="display" cellspacing="0" width="100%" style="margin-left: auto; margin-right: auto;">
                        <thead>
                        <tr style="background-color: red;height: 40px;font-size: 15px;color: white;">
                            <th class="table-style">Sr. #</th><th class="table-style">Survey Title</th><th class="table-style">Survey Date</th>
                        </tr>
                        </thead>
                        <?php
                        $volunteer_id = $_SESSION['volunteer_id'];
                        $result = getAllTakentSurveys($volunteer_id);

                        if (mysqli_num_rows($result) > 0) {

                            $counter = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $counter++;
                                ?>
                                <tr>
                                    <td class="table-style"><?php echo $counter; ?></td>
                                    <td class="table-style"><a href="?taken_survey_id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td><td class="table-style"><?php echo $row['survey_date'] ?></td>


                                </tr>
                                <?php
                            }//end of for loop
                        }//end if statement 
                        ?>

                    </table>

                </div>

            </div>
            <!--  end content -->
            <div class="clear">&nbsp;</div>
        </div>
        <!--  end content-outer -->



        <div class="clear">&nbsp;</div>

        <!-- start footer -->
        <!-- start footer -->
        <?php include './footer.php'; ?>
        <!-- end footer -->
        <!-- end footer -->

    </body>
</html>