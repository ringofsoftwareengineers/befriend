<div id="content">

    <!--  start page-heading -->
    <div id="page-heading">
        <?php
        $survey_id = $_GET['survey'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        $result = getSurvey($survey_id);
        $row = mysqli_fetch_array($result);
        $survey_title = $row["title"];
        ?>
        <h1><?PHP echo $survey_title; ?></h1>
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
                    $result0 = getOpenTextQuestions($survey_id);
                    while ($row = mysqli_fetch_array($result0)) {
                        $question_id = $row['id'];
                        $result1 = getQuestion($question_id);
                        $question = mysqli_fetch_array($result1);
                        $question_statement = $question['question_statement'];

                        echo "<b><p>$question_statement</p></b>";
                        $OpenTextAnswers = getOpenTextAnswers($question_id,$month,$year);
                        foreach ($OpenTextAnswers as $answer) {
                            echo '<br>' . $answer . "<br>";
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