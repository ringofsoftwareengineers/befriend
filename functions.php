<?php
define("host", "db669126949.db.1and1.com");
define("user", "dbo669126949");
define("password", "Lahore12");
define("database", "db669126949");

//define("host", "localhost");
//define("user", "root");
//define("password", "");
//define("database", "befriend");


function save_user() {
    include './mail.php';
    $login_name = $_POST['loginName'];
    $password = md5($_POST['password']);
    $firstName = $_POST['firstName'];
    $surName = $_POST['surName'];
    $phNo = $_POST['phNo'];
    $eMail = $_POST['eMail'];
    $gender = $_POST['gender'];
    $dob_day = $_POST['dob_day'];
    $dob_month = $_POST['dob_month'];
    $dob_year = $_POST['dob_year'];
    $dob = $dob_day . "-" . $dob_month . "-" . $dob_year;
    $address = $_POST['address'];
    $imageurl = saveImage();
    $sql = "insert into users (email,ph_no,user_login,user_password,firstname,surname,gender,dob,address,imageurl)values('$eMail','$phNo','$login_name','$password','$firstName','$surName','$gender','$dob','$address','$imageurl')";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
    $message = "<h2>Your User created in Befriend a Child Survey System</h2>";
    $message.="<label>Your User Name: </label>" . $login_name . "<br>";
    $message.="<label>password : </label>" . $_POST['password'] . "<br>";
    $Subject = "Volunteer user login created";
    send_mail_volunteer($Subject, $message, $eMail);
}
//end function

function save_monthly_report() {
    $volunteerID = $_SESSION['user_id'];
    $volunteerName = $_SESSION['user_name'];
    $month = $_POST['month'];
    $childName = $_POST['childName'];
    $report_year = $_POST['report_year'];
    $child_seen = $_POST['child_seen'];
    $numberOfVisits = $_POST['numberOfVisits'];
    $reasonOfNotVisiting = $_POST['reasonOfNotVisiting'];
    $concerns = $_POST['concerns'];
    $concernDetail = $_POST['concernDetail'];
    $numberOfHoursSpent = $_POST['numberOfHoursSpent'];

    //first outing    
    $activity1date = $_POST['activity1date'];
    $activity1Detail = $_POST['activity1Detail'];
    $childEnjoyed1 = $_POST['childEnjoyed1'];
    $activity1Reason = $_POST['activity1reason'];
    $mood1 = $_POST['mood1'];

    //second outing     
    $activity2date1 = $_POST['activity2date'];
    $activity2Detail = $_POST['activity2Detail'];
    $childEnjoyed2 = $_POST['childEnjoyed2'];
    $activity2Reason = $_POST['activity2reason'];
    $mood2 = $_POST['mood2'];

    //expenses claim
    $refvol = $_POST['refvol'];
    //first outing cost claim
    $first_outing_cost_detail = $_POST['first_outing_cost_detail'];
    $first_outing_cost_total = $_POST['first_outing_cost_total'];
    $first_travelling_expence = $_POST['first_outing_expense'];
    //first outing date is already there
    //second outng cost claim
    $second_outing_cost_detail = $_POST['second_outing_cost_detail'];
    $second_outing_cost_total = $_POST['second_outing_cost_total'];
    $second_travelling_expence = $_POST['second_outing_expense'];
    
    //2nd outing date is already there

    $gift_cost_detail = $_POST['gift_cost_detail'];
    $TotalClaim = $_POST['TotalClaim'];
//    $BankSortCode = $_POST['BankSortCode'];
//    $BankAccountNumber = $_POST['BankAccountNumber'];
//    $BankBranchName = $_POST['BankBranchName'];



    $con = new mysqli(host, user, password, database);

    if (mysqli_errno($con)) {
        die(mysqli_errno($con) . " Failed to connect database.");
    }

  
    $sql = "INSERT INTO   monthly_report  (  befriender_id ,  befriender_name ,  month ,  child_name ,  report_year ,"
            . "  is_child_seen ,  how_many_times ,  reason_for_not_seen ,  have_concerns ,  concerns ,  no_of_hours_spent ,"
            . "  first_outing_date ,  first_outing_activity ,is_child_enjoyed1 ,  reason_for_child_enjoyed_1 , mood1,"
            . "  second_outing_date ,  second_outing_activity , is_child_enjoyed_2 , reason_for_child_enjoyed_2 ,mood2,   ref_vol ,"
            . "  first_outing_cost_detail ,  first_outing_total ,  second_outing_cost_detail ,  second_outing_total ,  gift_detail_cost ,"
            . "  total_claim,first_travel_expense, second_travel_expense ) VALUES "
            . "( '$volunteerID', '$volunteerName', '$month', '$childName', '$report_year',"
            . " '$child_seen', '$numberOfVisits', '$reasonOfNotVisiting', '$concerns', '$concernDetail', '$numberOfHoursSpent',"
            . " '$activity1date', '$activity1Detail', '$childEnjoyed1', '$activity1Reason','$mood1',"
            . " '$activity2date1','$activity2Detail', '$childEnjoyed2', '$activity2Reason','$mood2', '$refvol',"
            . " '$first_outing_cost_detail', '$first_outing_cost_total', '$second_outing_cost_detail', '$second_outing_cost_total',"
            . " '$gift_cost_detail', '$TotalClaim', '$first_travelling_expence', '$second_travelling_expence')";
    
    //die($sql);
    $con->query($sql);
    $con->close();
}
//end function


function save_admin($email_id, $password, $full_name) {
    $enc_password = md5($password);
    $sql = "insert into admin (email_id, password,full_name)values('$email_id','$enc_password','$full_name')";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function
function update_admin($email_id, $password, $full_name, $id) {
    $sql = "update admin set email_id='$email_id', full_name='$full_name' where id='$id'";
    if (strlen(trim($password)) > 0) {
        $password = md5($password);
        $sql = "update admin set email_id='$email_id', password='$password', full_name='$full_name' where id='$id'";
    }


    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function
function saveQuestion() {
    $question_statement = $_POST['question_statement'];
    $input_type = $_POST['question_type'];
    $survey_id = $_POST['survey_id'];
    $sql = "insert into question (survey_id,input_type,question_statement)values('$survey_id','$input_type','$question_statement')";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function

function assign_survey($survey_id, $volunteer_id, $year, $month) {
    if (!assignment_exists($survey_id, $volunteer_id, $year, $month)) {
        include './mail.php';
        $month_nos = array();
        $month_nos['January'] = 1;
        $month_nos['February'] = 2;
        $month_nos['March'] = 3;
        $month_nos['April'] = 4;
        $month_nos['May'] = 5;
        $month_nos['June'] = 6;
        $month_nos['July'] = 7;
        $month_nos['August'] = 8;
        $month_nos['September'] = 9;
        $month_nos['October'] = 10;
        $month_nos['November'] = 11;
        $month_nos['December'] = 12;

        $month_no = $month_nos[$month];

        $sql = "insert into survey_assignments (survey_id,volunteer_id,year,month, month_no)values('$survey_id','$volunteer_id','$year','$month','$month_no')";
        $mysqli = new mysqli(host, user, password, database);
        $mysqli->query($sql);
        $mysqli->close();

        $Subject = "Befriend Survey Form";
        $message = "<h2>Please complete survey form for month $month $year</h2>";
        $address = get_user_email($volunteer_id);
        send_mail_volunteer($Subject, $message, $address);
        return true;
    } else {
        return false;
    }
}
//end function
function delete_assignment($id) {
    $sql = "delete from survey_assignments where id='$id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function
function assignment_exists($survey_id, $volunteer_id, $year, $month) {
    $sql = "select * from survey_assignments  where survey_id='$survey_id' "
            . " and volunteer_id='$volunteer_id' "
            . " and year ='$year' and month='$month' ";
    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);
    $mysqli->close();
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
//end functiion


function get_all_assigned_surveys() {

    $sql = "select * from survey_assignments where status !='taken' order by year ASC , month ASC";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function

function get_all_completed_surveys() {

    $sql = "select * from survey_assignments where status ='taken' order by year ASC , month ASC";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function

function getAllQuestions($survey_id) {
    $sql = "select * from question where survey_id='$survey_id'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end functiion

function getMCQs($survey_id) {
    $sql = "select * from question where survey_id='$survey_id' and input_type='radio'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end functiion

function getOpenTextQuestions($survey_id) {
    $sql = "select * from question where survey_id='$survey_id' and input_type!='radio'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end functiion


function getMCQsQuestions($survey_id) {
    $sql = "select * from question where survey_id='$survey_id' and input_type='radio'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end functiion

function getQuestion($id) {
    $sql = "select * from question where id='$id'";
    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function

function getSubQuestion($parent_question_id) {
    $sql = "select * from sub_question where parent_question_id='$parent_question_id'";
    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function

function getQuestionOptions($question_id) {
    $sql = "select * from question_choices where question_id='$question_id'";
    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
///end function
function deleteQuestion($id) {
    $sql = "delete from question where id ='$id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function
function saveQuestionOption() {
    $option_statement = $_POST['option_statement'];
    $question_id = $_SESSION['options_question_id'];
    $survey_id = $_SESSION['survey_id'];
    $sql = "insert into question_choices (choice_statement,question_id,survey_id)values('$option_statement','$question_id','$survey_id')";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end file

function saveQuestionAnswer($question_id, $user_id, $answer, $survey_id, $assignment_id) {

    $sql = "insert into question_answer (question_id,user_id,answer,survey_id,survey_assignment_id)values('$question_id','$user_id','$answer','$survey_id','$assignment_id')";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end file

function saveQuestionAnswerWithComments($question_id, $user_id, $answer, $comments, $survey_id, $assignment_id) {

    $sql = "insert into question_answer (question_id,user_id,answer,comments,survey_id,survey_assignment_id)values('$question_id','$user_id','$answer','$comments','$survey_id','$assignment_id')";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end file

function deleteOption($option_id) {
    $sql = "delete from question_choices where id ='$option_id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end question
function saveSurvey() {
    $title = $_POST['survey_title'];
    $instructions = $_POST['survey_instructions'];
    $status = $_POST['survey_status'];
    $entry_date = date("d-m-Y");
    $sql = "insert into survey (title,instructions,status,entry_date)values('$title','$instructions','$status','$entry_date')";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function
function saveSurveyTaken($volunteer_id, $survey_id, $survey_month, $survey_month_no, $survey_year, $assignment_id) {
    $survey_date = date("d-m-Y");
    update_assignment_status($survey_id, $assignment_id);
    $sql = "insert into taken_survey (volunteer_id,survey_id,survey_date,survey_month,survey_month_no,survey_year,survey_assignment_id)"
            . "values('$volunteer_id','$survey_id','$survey_date','$survey_month','$survey_month_no','$survey_year','$assignment_id')";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function

function update_assignment_status($survey_id, $assignment_id) {
    $sql = "update survey_assignments set status = 'taken' where survey_id ='$survey_id' and status !='taken' and id='$assignment_id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function

function getAllSurveys() {
    $sql = "select * from survey ORDER BY  entry_date ASC ";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
///end function

function getAllTakenSurveys() {
    $sql = "select * from taken_survey";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function
function getSurvey($id) {
    $sql = "select * from survey where id ='$id'";
    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);
    $mysqli->close();
    return $result;
}
//end fuction

function get_survey_name_by_id($id) {
    $result = getSurvey($id);
    $row = mysqli_fetch_array($result);
    $survey_name = $row['title'];
    return $survey_name;
    ;
}
//end function
function getAllTakentSurveys($volunteer_id) {
    $sql = "select survey.id,survey.title,taken_survey.survey_date from taken_survey,survey where taken_survey.survey_id=survey.id AND taken_survey.volunteer_id='$volunteer_id'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function

function getAllActiveSurveys() {
    $sql = "select * from survey where status='active' ";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function

function getNonTakenSurveysNew($volunteer_id) {
    $sql = "select * from survey_assignments where volunteer_id='$volunteer_id' and status !='taken' ";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function
function getNonTakentSurveys($volunteer_id) {
    $result = getAllActiveSurveys();
    $nonTakenSurveyIDs = array();
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $survey_id = $row['id'];
            if (!is_survey_taken_by_user($volunteer_id, $survey_id)) {
                $nonTakenSurveyIDs[] = $survey_id;
            }
        }
    }

    return $nonTakenSurveyIDs;
}
//end function

function getVolunteerID($user_login) {
    $sql = "select * from users where user_login='$user_login'";
    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);
    $mysqli->close();

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $user_id = $row['id'];
        return $user_id;
    } else {
        return -1;
    }
}
//end function

function getAllVolunteerIDs() {
    $sql = "select * from users";
    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);
    $mysqli->close();
    $volunteerIDs = array();
    while ($row = mysqli_fetch_array($result)) {
        $volunteerIDs[] = $row['id'];
    }

    return $volunteerIDs;
}
//end function


function is_survey_taken_by_user($volunteer_id, $survey_id) {
    $sql = "select * from taken_survey where volunteer_id='$volunteer_id' and survey_id='$survey_id'";
    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
//end function

function survey_assigned($survey_id) {
    $sql = "select * from survey_assignments  where survey_id='$survey_id' ";
    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);
    $mysqli->close();
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
//end functiion


function deleteSurvey($id) {
    $survey_id = $id;
    if (!survey_assigned($survey_id)) {
        deleteTakenSurvey($id);
        deleteQuestionAnswers($survey_id);
        deleteAllOptionsOfQuestionsOfSurvey($survey_id);
        deleteAllQuestionsOfSurvey($survey_id);
        $sql = "delete from survey where id ='$id'";
        $mysqli = new mysqli(host, user, password, database);
        $mysqli->query($sql);
        $mysqli->close();
    }//end if statement
}
//end function

function deleteTakenSurvey($id) {
    $sql = "delete from taken_survey where id ='$id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function
function deleteQuestionAnswers($survey_id) {
    $sql = "delete from question_answer where survey_id ='$survey_id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function
function deleteAllQuestionsOfSurvey($survey_id) {
    $sql = "delete from question where survey_id ='$survey_id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function
function deleteAllOptionsOfQuestionsOfSurvey($survey_id) {
    $sql = "delete from question_choices where survey_id ='$survey_id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function
function activateSurvey($id) {
    $sql = "update survey set status = 'active' where id ='$id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function

function deactivateSurvey($id) {
    $sql = "update survey set status = 'inactive' where id ='$id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function

function updateSurvey($id) {

    $title = $_POST['survey_title'];
    $instructions = $_POST['survey_instructions'];
    $status = $_POST['survey_status'];
    $sql = "update survey set status = '$status',title='$title',instructions='$instructions' where id ='$id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
function saveImage() {
    if (is_uploaded_file($_FILES["file"]["tmp_name"])) {

        $maxsize = 20000000;

        $size = $_FILES["file"]['size'];

        if (is_valid_type($_FILES['file']['type'])) {

            if ($size < $maxsize) {
                $TARGET_PATH = 'images/users/';
                $TARGET_PATH.=$_FILES['file']['name'];
//                echo $TARGET_PATH;
//                echo '';
//                die();
                move_uploaded_file($_FILES['file']['tmp_name'], $TARGET_PATH);
                return $TARGET_PATH;
            }
        }
    } else {
        return "";
    }
}
//end function
function is_valid_type($type) {

    // This is an array that holds all the valid image MIME types

    $valid_types = array("image/jpg", "image/jpeg", "image/bmp", "image/gif", "image/png");



    if (in_array($type, $valid_types))
        return true;

    return false;
}
//end is_valid_type()



function verifyAdminUserName($username) {
    $sql = "select * from admin where email_id='$username'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    if (mysqli_num_rows($result) > 0) {
        return TRUE;
    }
    return FALSE;
}
//end function

function verifyVolunteerUserName($username) {
    $sql = "select * from users where user_login='$username'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    if (mysqli_num_rows($result) > 0) {
        return TRUE;
    }
    return FALSE;
}
//end function
function verifyAdminPassword($username, $password) {
    // $sql = "select * from admin where email_id='$username' and password = '$password'";
    $password = md5($password);
    $sql = "select email_id,password from admin where email_id=? and password = ?";
    $mysqli = new mysqli(host, user, password, database);
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

//    die($stmt);
    //$result = $mysqli->query($sql);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user, $pass);
    $stmt->fetch();
    if (strlen($pass) > 0) {
        return TRUE;
        ;
    } else {
        return false;
    }
//    die($user." ".$pass);
//    if (mysqli_num_rows($result) > 0) {
//        return TRUE;
//    }
//    return FALSE;
}
//end functio

function verifyVolunteerPassword($username, $password) {
    $password = md5($password);
    $sql = "select * from users where login_name='$username' and user_password = '$password'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    if (mysqli_num_rows($result) > 0) {
        return TRUE;
    }
    return FALSE;
}
//end function
function verifyAdminUser($username, $password) {

    if (verifyAdminUserName($username)) {
        if (verifyAdminPassword($username, $password)) {
            return true;
        }
        return false;
    }
    return false;
}
//end function

function verifyVolunteerUser($username, $password) {

    if (verifyVolunteerUserName($username)) {
        if (verifyVolunteerPassword($username, $password)) {
            return true;
        }
        return true;
    }
    return false;
}
//end function

function displayVolunteerUserName() {
    $login_name = $_SESSION['user_login'];
    $result = getUser($login_name);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        ?>Welcome <?php echo $row['firstname'] . " " . $row['surname']; ?><?php
    }
}
//end function
function is_admin() {
    if (isset($_SESSION['is_admin_logged_in'])) {
        return true;
    } else {
        return false;
    }
}
//end function

function getAllRegisteredUsers() {
    $sql = "select * from users";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function

function getVolunteersWithPendingSurveys() {
    $sql = "select * from users";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function



function getAllAdminUsers() {
    $sql = "select * from admin";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function

function getAdminID($username) {
    $sql = "select * from admin where email_id='$username'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);
    $mysqli->close();

    $row = mysqli_fetch_array($result);
    $id = $row['id'];
    return $id;
}
//end function
function deleteUser($login_name) {

    $sql = "delete from users where user_login='$login_name'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function


function deleteAdminUser($id) {

    $sql = "delete from admin where id='$id'";
    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function

function getUser($user_id) {
    $sql = "select * from users where id='$user_id'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

//    $mysqli->close();

    return $result;
}
//end function

function getUserID($username) {
    $sql = "select * from users where user_login='$username'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);
    $mysqli->close();

    $row = mysqli_fetch_array($result);
    $id = $row['id'];
    return $id;
}
//end function

function get_user_email($user_id) {
    $result = getUser($user_id);
    $row = mysqli_fetch_array($result);
    $email = $row['email'];
    return $email;
}
//end function
function get_user_name_by_id($user_id) {
    $result = getUser($user_id);
    $row = mysqli_fetch_array($result);
    $name = $row['firstname'] . " " . $row['surname'];
    return $name;
}
//end function
function getAdminUser($id) {
    $sql = "select * from admin where id='$id'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function

function updateUser() {
    $login_name = $_POST['loginName'];
    $password = $_POST['password'];
    if (strlen(trim($password)) > 0) {
        $password = md5($_POST['password']);
    }

    $firstName = $_POST['firstName'];
    $surName = $_POST['surName'];
    $gender = $_POST['gender'];
    $phNo = $_POST['phNo'];
    $eMail = $_POST['eMail'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $user_id = $_POST['user_id'];
    $result = getUser($user_id);
    $row = mysqli_fetch_array($result);
    $imageurl_old = $row['imageurl'];
    $imageurl = saveImage();
    if (strlen($imageurl) == 0) {

        $imageurl = $imageurl_old;
    } else {
        unlink($imageurl_old);
    }
    if (strlen(trim($password)) > 0) {
        $sql = "update users set email='$eMail', ph_no='$phNo', user_login='$login_name',user_password='$password',firstname='$firstName',surname='$surName',gender='$gender',dob='$dob', address='$address', imageurl='$imageurl' where id='$user_id'";
    } else {
        $sql = "update users set email='$eMail', ph_no='$phNo', user_login='$login_name',firstname='$firstName',surname='$surName',gender='$gender',dob='$dob', address='$address', imageurl='$imageurl' where id='$user_id'";
    }

    $mysqli = new mysqli(host, user, password, database);
    $mysqli->query($sql);
    $mysqli->close();
}
//end function

function get_survey_assignment($id) {

    $sql = "select * from survey_assignments where id='$id'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function;
function getPreparedSurvey($id, $asssignment_id) {
    $survey = new Survey();
    $result = getSurvey($id);
    $assignment_result = get_survey_assignment($asssignment_id);
    $assignment = mysqli_fetch_array($assignment_result);
    $row = mysqli_fetch_array($result);
    $survey->month = $assignment['month'];
    $survey->year = $assignment['year'];
    $survey->year_no = $assignment['month_no'];
    $survey->title = $row['title'];
    $survey->survey_id = $id;
    $survey->instruction = $row['instructions'];
    $survey->assignment_id = $asssignment_id;

    $result1 = getAllQuestions($id);
    $Questions = array();
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_array($result1)) {
            $question = new Question();
            $question->id = $row['id'];
            $question->statement = $row['question_statement'];

            $question->type = $row['input_type'];
            $result2 = getSubQuestion($question->id);
            if (mysqli_num_rows($result2) > 0) {
                $sub_question = mysqli_fetch_array($result2);
                $question->sub_question_statement = $sub_question['sub_question_statement'];
            }

            $Questions[] = $question;
        }
    }
    $survey->questions = $Questions;
    return $survey;
}
//end function

function getAnswersOfTakenSurveyQuestions($survey_id, $volunteer_id) {
    $sql = "select * from question,question_answer where question.id=question_answer.question_id  "
            . "AND question_answer.survey_id='$survey_id' AND question_answer.user_id='$volunteer_id'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end function
function getTakenPreparedSurvey($survey_id, $volunteer_id) {
    $survey = new Survey();
    $result = getSurvey($survey_id);
    $row = mysqli_fetch_array($result);
    $survey->title = $row['title'];
    $survey->survey_id = $survey_id;
    $survey->instruction = $row['instructions'];

    $result1 = getAnswersOfTakenSurveyQuestions($survey_id, $volunteer_id);
    $Questions = array();
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_array($result1)) {
            $question = new Question();
            //$question->id = $row['id'];
            $question->statement = $row['question_statement'];
            $question->answer = $row['answer'];
            $Questions[] = $question;
        }
    }
    $survey->questions = $Questions;
    return $survey;
}
//end function


function getNoOfAnswersOfMCQ($question_id, $month, $year) {
    $sql = "select question_answer.answer"
            . "  from  question_answer join survey_assignments "
            . " ON question_answer.survey_assignment_id=survey_assignments.id "
            . " AND question_answer.question_id='$question_id' "
            . " AND survey_assignments.month='$month' AND survey_assignments.year='$year'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();
    $NoOfAnswers = array();
    while ($row = mysqli_fetch_array($result)) {
        $answer = $row['answer'];
        if (!isset($NoOfAnswers[$answer])) {
            $NoOfAnswers[$answer] = 1;
        } else {
            $number = $NoOfAnswers[$answer] + 1;
            $NoOfAnswers[$answer] = $number;
        }
    }
    return $NoOfAnswers;
}
//end getAnswersOfMCQ()
function getCommentsOnMCQ($question_id, $month, $year) {

    $sql = "select question_answer.comments "
            . "  from  question_answer join survey_assignments "
            . " ON question_answer.survey_assignment_id=survey_assignments.id "
            . " AND question_answer.question_id='$question_id' "
            . " AND survey_assignments.month='$month' AND survey_assignments.year='$year' "
            . " AND question_answer.comments IS NOT NULL";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    return $result;
}
//end getAnswersOfMCQ()
function getOpenTextAnswers($question_id, $month, $year) {
    $sql = "select question_answer.answer from  question_answer where question_answer.question_id='$question_id'";
    $sql = "select question_answer.answer "
            . "  from  question_answer join survey_assignments "
            . " ON question_answer.survey_assignment_id=survey_assignments.id "
            . " AND question_answer.question_id='$question_id' "
            . " AND survey_assignments.month='$month' AND survey_assignments.year='$year' ";



    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();
    $Answers = array();
    while ($row = mysqli_fetch_array($result)) {
        $answer = $row['answer'];
        $Answers[] = $answer;
    }
    return $Answers;
}
//end function
function getAllTakenSurveyIDs() {

    $sql = "select distinct survey_id from taken_survey";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    $surveyIDs = array();

    while ($row = mysqli_fetch_array($result)) {
        $surveyIDs[] = $row['survey_id'];
    }

    return $surveyIDs;
}
//end function

function getAllPreparedTakentSurveys() {
    $sql = "select distinct survey.title, survey_assignments.month,survey_assignments.year,survey_assignments.survey_id "
            . " from survey_assignments join survey "
            . " ON survey_assignments.survey_id=survey.id AND survey_assignments.status ='taken' "
            . " order by survey_assignments.year ASC, survey_assignments.month_no ASC";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    $surveys = array();

    while ($row = mysqli_fetch_array($result)) {
        $survey = new Survey();
        $survey->month = $row['month'];
        $survey->year = $row['year'];
        $survey->survey_id = $row['survey_id'];
        $survey->title = $row['title'];
        //$survey->assignment_id=$row['id'];
        $surveys[] = $survey;
    }

    return $surveys;
}
//end function
function isQuestionMCQ($question_id) {
    $sql = "select * from question where id='$question_id' and input_type='radio'";

    $mysqli = new mysqli(host, user, password, database);
    $result = $mysqli->query($sql);

    $mysqli->close();

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

//end function

class Survey {

    public $survey_id;
    public $title;
    public $instruction;
    public $questions = array(); //and array of Queations
    public $month;
    public $year;
    public $month_no;
    public $assignment_id;

}

//end class

class Question {

    public $id;
    public $statement;
    public $type;
    public $survey_id;
    public $choice_statements = array(); //an arry of strings
    public $sub_question_statement;
    public $answer;

}
//end class


