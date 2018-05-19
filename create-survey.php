<?php
session_start();
include './functions.php';

if (!is_admin()) {
    header("location: login.php");
}

if (isset($_POST['save_survey'])) {
    saveSurvey();
    header("location:create-survey.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    deleteSurvey($id);
    header("location:create-survey.php");
}
if (isset($_GET['activate'])) {
    $id = $_GET['activate'];
    activateSurvey($id);
    header("location:create-survey.php");
}

if (isset($_GET['deactivate'])) {
    $id = $_GET['deactivate'];
    deactivateSurvey($id);
    header("location:create-survey.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $_SESSION['edit_id'] = $id;
    header("location:create-survey.php");
}

if (isset($_POST['update_survey'])) {
    $id = $_SESSION['edit_id'];
    updateSurvey($id);
    unset($_SESSION['edit_id']);
    header("location:create-survey.php");
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
            <h1>CREATE NEW SURVEY</h1>
        </div>
        <!-- end page-heading -->



                            <div class="container">

<?php
if (isset($_SESSION['edit_id'])) {

    $id = $_SESSION['edit_id'];
    $result = getSurvey($id);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        ?>
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-md-3"><label>Survey Title</label></div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <input required="" value="<?php echo $row['title']; ?>" class="form-control" name="survey_title" type="text">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><label>Survey Status</label></div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <select class="form-control" name="survey_status">
                                                            <option selected="" value="<?php echo $row['status']; ?>" ><?php echo $row['status']; ?></option>
                                                            <option selected="" value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                            
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3"><label>Instructions</label></div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <textarea required="" class="form-control" id="survey_instructions" name="survey_instructions"><?php echo $row['instructions']; ?></textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-12" >
                                                    <div class="form-group">
                                                        <input value="Update Survey"  type="submit" class="btn btn-block" name="update_survey" style="margin-left: auto; margin-right: auto; color: white; width:33%; background-color: blue;">

                                                    </div>
                                                </div>
                                            </div>

                                        </form>

        <?php
    }//end inner if statement
} else {
    ?>
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-md-3"><label>Survey Title</label></div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <input required="" class="form-control" name="survey_title" type="text">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><label>Survey Status</label></div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <select class="form-control" name="survey_status">
                                                        <option value="inactive">Inactive</option>
                                                        <option value="active">Active</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><label>Instructions</label></div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <textarea required="" class="form-control" id="survey_instructions" name="survey_instructions"></textarea>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-12" >
                                                <div class="form-group">
                                                    <input value="Save Survey"  type="submit" class="btn btn-block" name="save_survey" style="margin-left: auto; margin-right: auto;color:white; width:103px; background-color: blue; float: right; margin-bottom: 10px">

                                                </div>
                                            </div>
                                        </div>

                                    </form>
<?php } ?>


                            </div>



                                <table id="mydatatable" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr style="background-color: red;height: 40px;font-size: 15px;color: white;">
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Questions</th>
                                            <th>Activate</th>
                                            <th>Deactivate</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
<?php
$result = getAllSurveys();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        ?>
                                            <tr>
                                                <td ><strong><?php echo $row['title']; ?></strong></td>
                                                <td ><?php echo $row['status']; ?></td>
                                                <td >
                                                    <a href="add-survey-questions.php?addQuestions=<?php echo $row['id']; ?>" class="btn btn-default" style="background-color: deeppink; color: white;">Questions</a>
                                                </td>
                                                <td>
                                                    <a href="?activate=<?php echo $row['id']; ?>" class="btn btn-default" style="background-color: blue; color: white;">Activate</a>
                                                    </td>
                                                    <td>
                                                    <a href="?deactivate=<?php echo $row['id']; ?>" class="btn btn-default" style="background-color: blueviolet; color: white;">Deactivate</a>
                                                    </td>
                                                    <td>
                                                    <a href="?edit=<?php echo $row['id']; ?>" class="btn btn-default" style="background-color: green; color: white">Edit</a>
                                                    </td>
                                                    <td>
                                                    <a onclick="return window.confirm('Confirm delete survey');" href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>

        <?php
    }
}//end if statement
?>
                                </table>




                        </div>
                        <!--  end table-content  -->

                        <div class="clear"></div>

                    </div>
                    <!--  end content-table-inner ............................................END  -->

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
