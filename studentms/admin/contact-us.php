<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        $pagetitle = $_POST['pagetitle'];
        $pagedes = $_POST['pagedes'];
        $mobnum = $_POST['mobnum'];
        $email = $_POST['email'];
        $sql = "update tblpage set PageTitle=:pagetitle,PageDescription=:pagedes,Email=:email,MobileNumber=:mobnum where  PageType='contactus'";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pagetitle', $pagetitle, PDO::PARAM_STR);
        $query->bindParam(':pagedes', $pagedes, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Contact us has been updated")</script>';
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
<head>

    <title>Contact Us</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css"/>
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Update Contact Us </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Update Contact Us</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Update Contact Us</h4>

                                <form class="forms-sample" method="post">
                                    <?php

                                    $sql = "SELECT * from  tblpage where PageType='contactus'";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) { ?>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Page Title:</label>
                                                <input type="text" name="pagetitle"
                                                       value="<?php echo $row->PageTitle; ?>" class="form-control"
                                                       required='true'>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Page Description:</label>
                                                <textarea type="text" name="pagedes" class="form-control"
                                                          required='true'><?php echo $row->PageDescription; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Email:</label>
                                                <input type="text" name="email" id="email" required="true"
                                                       value="<?php echo $row->Email; ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Mobile Number:</label>
                                                <input type="text" name="mobnum" id="mobnum" required="true"
                                                       value="<?php echo $row->MobileNumber; ?>" class="form-control"
                                                       maxlength="10" pattern="[0-9]+">
                                            </div>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                    <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>
</div>
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/select2/select2.min.js"></script>
<script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
<script src="js/typeahead.js"></script>
<script src="js/select2.js"></script>
</body>
    </html><?php } ?>