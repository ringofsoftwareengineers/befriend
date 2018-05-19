<?php
session_start();
include './functions.php';
if (!is_admin()) {
    header("location: login.php");
}

if (!isset($_GET["survey"])) {
    header("location: survey-reports.php");
}
?>
<!-- Start: page-top-outer -->
<?php include './header.php'; ?>

<div class="clear"></div>

<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
    <!-- start content -->
    <?php include './content-piechart.php'; ?>
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
<script type="text/javascript">
    NoOfFunctions = <?php echo $functionCounter; ?>;
    window.onload = function () {

<?php
for ($i = 1; $i < $functionCounter; $i++) {
    echo "myFunction" . $i . "();";
}
?>

    };
</script>

</body>
</html>