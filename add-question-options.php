<?php
session_start();
include './functions.php';
if (isset($_GET['options_question_id'])) {

    $id = $_GET['options_question_id'];
    $_SESSION['options_question_id'] = $id;
    header('location: add-question-options.php');
} elseif (isset($_POST['save_question_option'])) {    

    saveQuestionOption();
    header('location: add-question-options.php');
}elseif (isset ($_GET['deleteOption'])) {
    $option_id = $_GET['deleteOption'];
    deleteOption($option_id);
    header('location: add-question-options.php');
}
elseif (!isset($_SESSION['options_question_id'])) {
    header("location: index.php");
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
		<h1><?php
                        $id = $_SESSION['survey_id'];
                        $result = getSurvey($id);
                        $row = mysqli_fetch_array($result);
                        $title = $row['title'];
                        echo $title;
                        ?></h1>
	</div>
	<!-- end page-heading -->

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add Options in following Question:
                        <?php
                        $id = $_SESSION['options_question_id'];
                        $result = getQuestion($id);
                        $row = mysqli_fetch_array($result);
                        $statement = $row['question_statement'];
                        echo $statement;
                        ?></h2>           
                </div>
            </div>


            <form action="" method="post">
                <div class="row">
                    <div class="col-md-3"><label>Option Statement</label></div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input required="" class="form-control" name="option_statement">                          

                        </div>
                    </div>
                </div>
                <div class="row">                
                    <div class="col-md-12"><input  class="btn btn-block" style="margin-left: auto; margin-right: auto; background-color: blue; color:white; max-width: 33%;" type="submit" value="Save Question Option" name="save_question_option"></div>

                </div>
            </form>
            <table  id="mydatatable" class="display" cellspacing="0" width="100%">
                <thead>
            <tr style="background-color: red; height: 40px; font-size: 15px; color: white;">
                <td>Sr. #</td>
                <td>Option Statement</td>
                <td>Action</td>

            </tr>
            </thead>
                <?php
            $question_id = $_SESSION['options_question_id'];
            $result = getQuestionOptions($question_id);
            $counter=1;
            if (mysqli_num_rows($result) > 0) {
                while ($row=  mysqli_fetch_array($result))
                {
                ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row['choice_statement']; ?></td>
                    <td>
                        <a class="btn btn-danger" href="?deleteOption=<?php echo $row['id']; ?>" onclick="return window.confirm('Confirm delete ?')">Delete</a>
                    </td>

                </tr>
    <?php
                $counter++;
                }
}
?>

            </table>
        </div>

			
	
	
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
<div id="footer">
<!-- <div id="footer-pad">&nbsp;</div> -->
	<!--  start footer-left -->
	<div id="footer-left">
		Copyright 2016 Befriend A Child <a href="">http://www.befriendachild.org.uk/</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>

</html>
