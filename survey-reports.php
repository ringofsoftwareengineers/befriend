<?php
session_start();
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}
?>

<!-- Start: page-top-outer -->
<?php include './header.php'; ?>

<div class="clear"></div>

<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
    <!-- start content -->
    <div id="content">

        <!--  start page-heading -->
        <div id="page-heading">
            <h1>Survey Reports</h1>
        </div>
        <!-- end page-heading -->


        <!--  start content-table-inner ...................................................................... START -->
        <table id="mydatatable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr style="background-color: red; color:white; font-size: 15px;">
                    <th>Year</th><th>Month</th>
                    <th>Survey</th><th>PIE Graph</th><th>Bar Graph</th><th>Open Text Questions</th>
                </tr>
            </thead>
            <?php
            $survey = new Survey();
            $counter = 0;
            $surveys = getAllPreparedTakentSurveys();
            foreach ($surveys as $survey) {
                ?>
                <tr>
                    <td><?PHP echo $survey->year; ?></td>
                    <td><?PHP echo $survey->month; ?></td>
                    <td><strong><?PHP echo $survey->title; ?></strong> </td>
                    <td>
                        <a class = "btn btn-default" style= "color: white; background-color: green;" href="survey-report-pie.php?survey=<?php echo $survey->survey_id; ?>&year=<?php echo $survey->year; ?>&month=<?php echo $survey->month; ?>">View Pie Graph</a>
                    </td>
                    <td> 
                        <a class="btn btn-default" style= "color: white; background-color: purple;" href="survey-report.php?survey=<?php echo $survey->survey_id; ?>&year=<?php echo $survey->year; ?>&month=<?php echo $survey->month; ?>">View Bar Graph
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-default" style= "color: white; background-color: blue;" href="survey-report-text.php?survey=<?php echo $survey->survey_id; ?>&year=<?php echo $survey->year; ?>&month=<?php echo $survey->month; ?>">View Open Text Questions</a>
                    </td>
                </tr>
                <?php
            }
            ?>


        </table>
        <!--  end content-table-inner ............................................END  -->

        <div class="clear">&nbsp;</div>

    </div>
    <!--  end content -->
    <div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>

<!-- start footer -->
<!-- start footer -->
<?php include './footer.php'; ?>
<!-- end footer -->
<!-- end footer -->

</body>
</html>
