<?php
session_start();
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}

if (!isset($_SESSION['taken_survey_id'])) {

    header("location: index.php");
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


                    <?php
                    $volunteer_id = $_SESSION['volunteer_id'];
                    $survey_id = $_SESSION['taken_survey_id'];
                    $taken_survey = getTakenPreparedSurvey($survey_id, $volunteer_id);
                    $counter = 0;
                    ?>
                    <h2><?php echo $taken_survey->title; ?></h2>
                    <table id="mydatatable" class="display" cellspacing="0" width="100%" style="margin-left: auto; margin-right: auto;">
                        <thead>
                        <tr style="background-color: red;height: 40px;font-size: 15px;color: white;">
                            <th class="table-style">Sr. #</th><th class="table-style">Question Statement</th><th class="table-style">Answer</th>
                        </tr>
                        </thead>
                        <?php
                        foreach ($taken_survey->questions as $question) {
                            $counter++;
                            ?>
                            <tr>
                                <td class="table-style"><?php echo $counter; ?></td>
                                <td class="table-style"><?php echo $question->statement; ?></td>
                                <td class="table-style"><?php echo $question->answer; ?></td>

                            </tr>
                            <?php
                        }//end of for loop
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
