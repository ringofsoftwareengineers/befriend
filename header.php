<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Be Friend a child</title>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery.min/jquery-3.1.0.min.js" type="text/javascript"></script>
<!--        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>  -->
        <script src="canvasjs-1.8.1/canvasjs.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="cssadminpage/screen.css" type="text/css" media="screen" title="default" />
        <link href="datatable-api/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="datatable-api/jquery.dataTables.min.js" type="text/javascript"></script>
        <link href="datatable-api/dataTables.responsive.css" rel="stylesheet" type="text/css"/>
        <script src="datatable-api/dataTables.responsive.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#mydatatable')
                        .addClass('nowrap')
                        .dataTable({
                            responsive: true
                        });

            });
        </script>


        <style type="text/css">
            .header{
                background-color: #FAC835;
                height: 92px;
               
            }
            label{
                font-size: 15px;
               
            }
            td{
                font-size: 15px;
                line-height: 15px;
                padding: 10px;
            }
            body{
                font-size: 12px;
                line-height: 12px;
            }
            th{
                font-size: 15px;
                line-height: 15px;
                padding: 15px;
            }
            
            .logo{
                margin-right: auto;
                margin-left: auto;
                width: 275px;
                float: left;

            }
            .navbar-custom{
                background-color: #4C4C4C;
                min-height: 38px;
                color: white;
                line-height: 35px;
                font-size: 16px;
                font-weight: bold;
                padding-left: 10px;
                padding-right: 10px;
                min-width: 255px;
            }
            .logout
            {
                float: right;
            }
            .navbar-custom a {
                text-decoration: none;
                color: inherit;
            }
            .header-style{

                background-color: red;
                height: 40px;
                font-size: 15px;
                color: white
            }
            table.dataTable tbody tr.odd{
                background-color: #F2F2B8;
            }
            table.dataTable tbody tr.even{
                background-color: #e6ffe6;
            }
            .text-box-gap{
                margin-bottom: 10px;
            }

            #footer-left {
                padding-top:30px;
            }

        </style>
    </head>

    <body>
        <!-- Start: page-top-outer -->
        <div class="header">
            <div class="logo"><img src="images/bf-logo.jpg"></div>
        </div>
        <!-- End: page-top-outer -->

        <div class="clear">&nbsp;</div>
        <?php
        $username = $_SESSION['is_admin_logged_in'];
        $id = getAdminID($username);
        ?>
        <div class="container-fluid" style="background-color: #4C4C4C;">
            <div class="row">
        <div class="navbar-custom col-md-12">
            <a href="adminhome.php"><b>Home</b></a> | 
            <a href="my-account.php?update_id=<?php echo $id; ?>">My Account </a>
            <span style="margin-right: 10px; float: right;">
                <a style="color: orange;" href="my-account.php?update_id=<?php echo $id; ?>">
                    Welcome <?php echo $_SESSION['admin_user_name']; ?>!
                </a>
                <a style="margin-left: 10px;" href="log-out.php">Logout</a>
            </span>
        </div>
        </div>
        </div>