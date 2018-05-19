<div id="content">

    <!--  start page-heading -->
    <div id="page-heading">
        <?php
        $survey_id = $_GET['survey'];
        $month=$_GET['month'];
        $year = $_GET['year'];
        $result0 = getSurvey($survey_id);
        $survey = mysqli_fetch_array($result0);
        $survey_title = $survey["title"];
        ?>
        <h1><?PHP echo $survey_title; ?> for <?PHP echo $month . " ".$year; ?></h1>
        <?php
        ?>                    
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
                    <?php
                    $counter = 0;
                    $functionCounter = 1;
                    $result1 = getMCQs($survey_id);
                    while ($row = mysqli_fetch_array($result1)) {
                        $question_id = $row['id'];
                        $result2 = getQuestion($question_id);
                        $question = mysqli_fetch_array($result2);
                        $question_statement = $question['question_statement'];              
                        $NoOfAnswers = getNoOfAnswersOfMCQ($question_id,$month,$year);
                        ?>
                        <div id="chartContainer<?PHP echo $counter; ?>" style="height: 300px; width: 100%; margin-bottom: 40px; border-bottom: 1px black solid;">
                        </div>
                        <script type="text/javascript">
                            function myFunction<?php
                    echo $functionCounter;
                    $functionCounter++;
                    ?>() {
                                var chart = new CanvasJS.Chart("chartContainer<?PHP
                    echo $counter;
                    $counter++;
                    ?>",
                                {
                                title: {
                                text: "<?php echo $question_statement; ?>"
                                },
                                        animationEnabled: true,
                                        legend: {
                                        verticalAlign: "center",
                                                horizontalAlign: "left",
                                                fontSize: 20,
                                                fontFamily: "Helvetica"
                                        },
                                        theme: "theme2",
                                        data: [
                                        {
                                        type: "pie",
                                                indexLabelFontFamily: "Helvetica",
                                                indexLabelFontSize: 20,
                                                indexLabel: "{name} #percent% ({y})",
                                                indexLabelPlacement: "outside",
                                                startAngle:0,
                                                showInLegend: true,
                                                toolTipContent:"{name} #percent%",
                                                dataPoints: [
    <?php
    $options = count($NoOfAnswers);
    $optionsCounter = 1;
    foreach ($NoOfAnswers as $key => $value) {
        ?>
                                                    {y: <?PHP echo $value; ?>, name: "<?php echo $key; ?>", legendMarkerType: "circle"}
        <?php
        if ($optionsCounter < $options) {
            echo ',';
        }
    }
    ?>
                                                ]
                                        }
                                        ]
                                });
                                        chart.render();
                            }
                        </script>
                        <?PHP
                        
                        $comments = getCommentsOnMCQ($question_id,$month,$year);
                        
                        while ($comment = mysqli_fetch_array($comments))
                                         {
                                             echo '<p>'.$comment['comments']."</p>";
                                         }
                    }//end while
                    ?>


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