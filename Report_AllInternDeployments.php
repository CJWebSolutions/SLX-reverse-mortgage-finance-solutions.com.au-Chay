    <?php
    include('Connect.php');

session_start();
if(!isset($_SESSION['Username'])) {

  header("Location: http://sscrims.x10host.com/SSCR_Login_User.php");
//       header("Location: http://localhost/SSCR-OJT/SSCR_Login_User.php");
}


    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Report | IMS</title>
        <link rel="icon" type="image/png" href="logo1.png">
        <link href="../css/listviews.css" rel="stylesheet">
            <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
            th, td {
                text-align: center;
            }
            #row {
                margin:0px 0px 0 0px;
            }
            .row {
                margin: 0 0px 0px 0px;
            }
            h2 {
                padding: 10px 0px 5px 10px;
                color: white;
                background-color: #009900;
                margin-bottom: -5px;
                margin-top: -1px;
            }
            .dontprint {
                padding-top: 10px;
                background-color: #ffffe2;
                border: 1px solid #dddddd;
            }
            #buttons {
                padding-left: 10px;
            }
            .panel panel-default {
                padding-bottom: 10px;
            }
        </style>
    <script>
            function printpage ()
                {
                    window.print()
                }
        </script>
        <style type="text/css" media="print">
        .dontprint
            { display: none; }
        </style>
        <style type ="text/css" >
       .footer { 
                tex-align:center;
                position:fixed; 
                bottom: 0px; 
                } 
        </style>
        <style type="text/css" media="print">
          @page { size: landscape; }
           table {
        table-layout: auto;
        border-collapse: collapse;
        width: 100%;
        white-space:pre-wrap ; word-wrap:break-word;
    }

        </style>
    </head>

    <body>

        <div id="wrapper">


            <div id="page-wrapper">

                <div class="container-fluid">
                     <!-- Page Heading -->
                    <div class="row">
                             <h3 id="headertitle">
                               San Sebastian College - Recoletos de Cavite
                <?php
                     include_once "Connect.php";                                    
                     $callcourse=mysqli_query($con,"SELECT * FROM tbl_adminacct WHERE Username='{$_SESSION['Username']}'");
                    $name = mysqli_fetch_assoc($callcourse);
                    $names= $name['facidno'];   
                      $callname=mysqli_query($con,"SELECT * FROM tbl_admin WHERE facidno='$names'");
                     $rowname = mysqli_fetch_array($callname);
                    ?>
                    <h4> <label>Prepared By:</label> <?php echo $rowname['iocFirstname']?> <?php echo $rowname['iocLastname']?></h4>
                    <h4> <label>Position:</label> Institutional Practicum Coordinator</h4>
                    <h4 style="text-aligh:right;"> <label>Date Prepared:</label> <?php echo date('Y-m-d'); ?></h4>
                            </h3>
                    </div>
                    <!-- /.row -->
                    <div class="col-lg-12">
                    <div class="row">
                    <div class="panel panel-default">
                        <div class="row">
                          <h2 >INTERNS DEPLOYMENTS</h2>
                            <div class="dontprint">
                                <form  class="form-group" action="Report_AllInternDeployments.php" enctype="multipart/form-data" method="post" runat="server">
                                        <div id="row" class="row">  
                                                    <div class="col-xs-1">
                                                        <label ><b>Academic Yr.</b></label>
                                                    </div>
                                                        <div class="col-xs-2">
                                                            <select required="true" class="form-control" name="ayEnrolled" id="ayEnrolled">     
                                                                <option  value=""></option>
                                                                <?php require("Connect.php");
                                                                $getallGroups = mysqli_query($con,"SELECT DISTINCT ayEnrolled FROM tbl_students  ORDER BY ayEnrolled ASC");

                                                                    while($viewallGroups = mysqli_fetch_array($getallGroups)) {?>
                                                                <option value="<?php echo $viewallGroups['ayEnrolled'];?>"><?php echo $viewallGroups['ayEnrolled'];?></option>
                                                                    <?php } ?>
                                                            </select>
                                                        </div>
                                                    <div class="col-s-2">
                                                         <button type="submit" class="btn btn-success" name="search" id="search"><i class="fa fa-search fa-fw"></i></button>
                                                        <input class="btn btn-success" type="button"  value='PRINT REPORT' onclick="printpage()">
                                                    </div>
                                        </div>                                                     
                                </form>
                                <div id="buttons" class="col-l-7">
                                    <form name="search_all" class="form-group" action="Report_AllInternDeployments.php" enctype="multipart/form-data" method="post" runat="server">
                                        <button type="submit" class="btn btn-success" name="all" id="all">All Results</button>
                                        <a style="color:white; text-decoration: none;" href="SSCR_Homepage.php" id="white"><input type="button" class="btn btn-md btn-success" id="buttonwidth" value="Cancel"></a>
                                    </form>
                                </div>
                                
                            </div>
                                
<div class="panel-body">                                        
    <?php include_once "Connect.php"; 

        $selectSQL="SELECT DISTINCT concat_ws('', tbl_studinternshipinfo.compNameNP, tbl_studinternshipinfo.compName) as 'company', tbl_studinternshipinfo.companyID FROM sscrimsx_sscrims.tbl_studinternshipinfo ORDER BY company DESC";
                                                           
                        if( !( $selectRes = mysqli_query( $con,$selectSQL ) ) )
                            {
                                echo 'Retrieval of data from Database Failed - #'.mysqli_errno().': '.mysqli_error();
                            }
                        elseif (isset($_POST['search'])) 
                            {   
                    $search_result = $_POST['ayEnrolled'];
                    $result = substr($search_result, 0, 4);
                                ?>
                                <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                                        <thead>
                                                            <tr>
                                                           <div scaling='no'>                                        
                                                                <th width='15%' align='center'>Training Institution Name</th>
                                                                <th width='5%' align='center'>Incomplete</th>
                                                                <th width='5%' align='center'>Completed</th>
                                                                <th width='5%' align='center'>Total Interns</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                            <?php                            while( $row = mysqli_fetch_assoc( $selectRes) )
                                                            { ?>
                                                         <tr class="odd gradeX">
                                                            <td><?php echo $row['company']?></td>
                                                            <td width='10'><?php 

                    $inc = mysqli_query($con, "SELECT * FROM sscrimsx_sscrims.tbl_studinternshipinfo WHERE (DATEPART(yyyy, tbl_studinternshipinfo.dateStarted) = $result) AND tbl_studinternshipinfo.compName = '$row[company]' AND tbl_studinternshipinfo.internshipStatus='Ongoing'") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                            echo $count1?></td>
                                                            <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT * FROM sscrimsx_sscrims.tbl_studinternshipinfo WHERE tbl_studinternshipinfo.compName = '$row[company]' AND (DATEPART(yyyy, tbl_studinternshipinfo.dateStarted) = $result) AND tbl_studinternshipinfo.internshipStatus='Completed'") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                            echo $count2?></td>
                                                            <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT * FROM sscrimsx_sscrims.tbl_studinternshipinfo WHERE tbl_studinternshipinfo.compName = '$row[company]' AND (DATEPART(yyyy, tbl_studinternshipinfo.dateStarted) = $result)") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                            echo $countall?></td>
                                                        </tr>
                                                   </tbody> <?php }                        

                            }  
                        else
                            {?>
                                                        <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                                        <thead>
                                                            <tr>
                                                           <div scaling='no'>                                        
                                                                <th width='15%' align='center'>Training Institution Name</th>
                                                                <th width='5%' align='center'>Incomplete</th>
                                                                <th width='5%' align='center'>Completed</th>
                                                                <th width='5%' align='center'>Total Interns</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                            <?php                            while( $row = mysqli_fetch_assoc( $selectRes) )
                                                            { ?>
                                                         <tr class="odd gradeX">
                                                            <td><?php echo $row['company']?></td>
                                                            <td width='10'><?php 
                    $inc = mysqli_query($con,"SELECT tbl_studinternshipinfo.compNameNP, tbl_studinternshipinfo.compName, tbl_studinternshipinfo.internshipStatus FROM sscrimsx_sscrims.tbl_studinternshipinfo WHERE  tbl_studinternshipinfo.internshipStatus='Ongoing' AND (tbl_studinternshipinfo.compNameNP= '$row[company]' OR tbl_studinternshipinfo.compName= '$row[company]')") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                            echo $count1?></td>
                                                            <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT tbl_studinternshipinfo.compNameNP, tbl_studinternshipinfo.compName, tbl_studinternshipinfo.internshipStatus FROM sscrimsx_sscrims.tbl_studinternshipinfo WHERE  tbl_studinternshipinfo.internshipStatus='Completed' AND (tbl_studinternshipinfo.compNameNP= '$row[company]' OR tbl_studinternshipinfo.compName= '$row[company]')") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                            echo $count2?></td>
                                                            <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT tbl_studinternshipinfo.compNameNP, tbl_studinternshipinfo.compName, tbl_studinternshipinfo.internshipStatus FROM sscrimsx_sscrims.tbl_studinternshipinfo WHERE  tbl_studinternshipinfo.compNameNP= '$row[company]' OR tbl_studinternshipinfo.compName= '$row[company]'") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                            echo $countall?></td>
                                                        </tr>
                                                   </tbody>  <?php }
                            }
                                                                ?>
</div>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->
            <!--Footer-->
                <div id="footer">
                    <footer class="w3-container w3-blue w3-text-white">
                        <center>
                            <font size="1">
                            Contact Us (046) 431-0861 loc. 817</a><br/>
                            Copyright <?php echo "&copy;"." " . "2016"." "; ?> San Sebastian College - Recoletos de Cavite <br/>
                            Developed by Krizza Jowanna Marie S. Barzaga & Nikka R. Franco<br/>
                            All rights reserved.</p>
                            </font>
                        </center>
                    </footer>
                </div>
            <!--End Footer-->
        </div>
        <!-- /#wrapper -->
        <script src="../js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

    </body>

    </html>