<?php
session_start();
include './functions.php';
$title = "";
if (isset($_GET['addQuestions'])) {
    $id = $_GET['addQuestions'];
    $_SESSION['survey_id'] = $id;
    header("location: add-survey-questions.php");
} elseif (isset($_POST['save_question'])) {
    saveQuestion();
    header("location: add-survey-questions.php");
} elseif (isset($_GET['delete_question_id'])) {
    $id = $_GET['delete_question_id'];
    deleteQuestion($id);
    header("location: add-survey-questions.php");
} elseif (!isset($_SESSION['survey_id'])) {
    header('location: index.php');
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
            <h1>Add Questions in Survey: <?php
                $id = $_SESSION['survey_id'];
                $result = getSurvey($id);
                $row = mysqli_fetch_array($result);
                $title = $row['title'];
                echo $title;
                ?></h1> 
        </div>
        <!-- end page-heading -->

        <div class="container">

            <form method="post">
                <input type="hidden" name="survey_id" value="<?php echo $_SESSION['survey_id']; ?>">
                <div class="row">                
                    <div class="col-md-3"><label>Question Statement</label></div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <textarea required="" class="form-control" name="question_statement"></textarea>                          

                        </div>
                    </div>
                </div>
                <div class="row">                
                    <div class="col-md-3"><label>Question</label></div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input value="text" type="radio" required="" name="question_type" > <label>Open Text</label><br>
                            <input value="radio" type="radio" required="" name="question_type" > <label>MCQs  </label>                          

                        </div>
                    </div>
                </div>
                <div class="row">                
                    <div class="col-md-12"><input  class="btn btn-block" style="margin-left: auto; margin-right: auto; color: white; background-color:blue;  max-width: max-content;" type="submit" value="Save Question" name="save_question"></div>

                </div>
            </form>

            <div class="row">                
                <div class="col-md-12"><h1> Added Questions</h1></div>                    
            </div>
            <table id="mydatatable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr style="background-color: red; height: 40px; font-size: 15px; color: white;">  
                        <th>Sr No.</th>
                        <th>Question Statement</th></div>
                        <th>Type</th>
                        <th>Options</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                $survey_id = $_SESSION['survey_id'];
                $result = getAllQuestions($survey_id);
                $counter=1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $type = $row['input_type'];
                        $question_statement = $row['question_statement'];
                        $display_text = "";
                        if ($type == 'text') {
                            $display_text = "Open Text";
                        } else {
                            $display_text = "MCQs";
                        }
                        ?>
                        <tr>
                            <td><?PHP echo $counter; $counter++; ?></td>
                            <td><?php echo $question_statement; ?></td>
                            <td ><?php echo $display_text; ?></td>
                            <td >
                                <?php
                                if ($type == 'radio') {
                                    ?>
                                    <a class="btn btn-default" style="background-color: green; color:white;" href="add-question-options.php?options_question_id=<?php echo $row['id']; ?>">Add Options</a>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="return window.confirm('Do you want to delete ?')" href="?delete_question_id=<?php echo $row['id']; ?>" style="float: right;">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }//lend while
                }//end if
                ?>
            </table>
        </div>

        <div class="clear">&nbsp;</div>

    </div>
    <!--  end content -->
    <div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>

<!-- start footer -->
<?php include './footer.php'; ?>
<!-- end footer -->

</body>

</html>
