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
          @page { size: portrait; }
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
                               San Sebastian College - Recoletos de Cavite</h3>
                <?php
                     include_once "Connect.php";                                    
                     $callcourse=mysqli_query($con,"SELECT * FROM tbl_adminacct WHERE Username='{$_SESSION['Username']}'");
                    $name = mysqli_fetch_assoc($callcourse);
                    $names= $name['facidno'];   
                      $callname=mysqli_query($con,"SELECT * FROM tbl_admin WHERE facidno='$names'");
                     $rowname = mysqli_fetch_array($callname);
                    ?>
                    <h4> <label>Prepared By:</label> <?php echo $rowname['iocFirstname']?> <?php echo $rowname['iocMiddlename']?> <?php echo $rowname['iocLastname']?></br>
                        <label>Position:</label> INSTITUTIONAL PRACTICUM COORDINATOR</br>
                    <label>Date Prepared:</label> <?php echo date('Y-m-d'); ?></h4>  
                    </div>
                    <!-- /.row -->
                    <div class="col-lg-12">
                    <div class="row">
                    <div class="panel panel-default">
                        <div class="row">
                              <h2 >INTERNS</h2>
                                <div class="dontprint">
                                <form  class="form-group" action="Report_AllIntern.php" enctype="multipart/form-data" method="post" runat="server">
                                        <div id="row" class="row">  
                                                    <div class="col-xs-1">
                                                    <label ><b>Academic Yr.</b></label>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <select required="true" class="form-control" name="ayEnrolled" id="ayEnrolled">     
                                                        <option  value=""></option>
                                                        <?php
                                                         require("Connect.php");
                                                        $getallGroups = mysqli_query($con,"SELECT DISTINCT ayEnrolled FROM tbl_students  ORDER BY ayEnrolled ASC");

                                                            while($viewallGroups = mysqli_fetch_array($getallGroups))

                                                                {?>
                                                                <option value="<?php echo $viewallGroups['ayEnrolled'];?>"><?php echo $viewallGroups['ayEnrolled'];?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-s-2">
                                                         <button type="submit" class="btn btn-success" name="search" id="search"><i class="fa fa-search fa-fw"></i></button>
                                                        <input class="btn btn-success" type="button"  value='PRINT REPORT' onclick="printpage()">
                                                    </div>
                                        </div>                                                
                                            </form>
                        <div id="buttons" class="col-l-7">
                            <form name="search_all" class="form-group" action="Report_AllIntern.php" enctype="multipart/form-data" method="post" runat="server">
                                <button type="submit" class="btn btn-success" name="all" id="all">All Results</button>
                                <a style="color:white; text-decoration: none;" href="SSCR_Homepage.php" id="white"><input type="button" class="btn btn-md btn-success" id="buttonwidth" value="Cancel"></a>
                            </form>
                        </div>
                               
                                
                        </div>
<div class="panel-body">                                        
    <?php
    include_once "Connect.php";

    $selectSQL='SELECT tbl_students.id,tbl_students.ayEnrolled,tbl_students.studidno, tbl_students.studLastname, tbl_students.studMiddlename, tbl_students.studFirstname, tbl_courses.coursename, tbl_courses.practicumsem, tbl_students.evaluationStatus, tbl_students.internStatus, tbl_students.dateRegistered,tbl_students.ayEnrolled, tbl_students.addedby
        FROM sscrimsx_sscrims.tbl_students LEFT JOIN sscrimsx_sscrims.tbl_courses
        ON tbl_courses.coursename=tbl_students.coursename ORDER BY tbl_students.studLastname' ;

        $selectRes1 = mysqli_query($con, $selectSQL);
        $count = mysqli_num_rows($selectRes1);
            if( !( $selectRes = mysqli_query($con, $selectSQL ) ) )
                { echo 'Retrieval of data from Database Failed - #'.mysqli_errno().': '.mysqli_error();}    
                                                            
            elseif (isset($_POST['search'])) 
                {
                    $search_result = $_POST['ayEnrolled'];

                    $query = mysqli_query($con,"SELECT tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.ayEnrolled 
                        FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.ayEnrolled='$search_result'") or die('Connection Failed'.mysqli_error());

                    $inc = mysqli_query($con,"SELECT tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.ayEnrolled
                        FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Ongoing' AND tbl_students.ayEnrolled='$search_result'") or die('Connection Failed'.mysqli_error());

                    $com = mysqli_query($con,"SELECT tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.ayEnrolled FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Completed' AND tbl_students.ayEnrolled='$search_result'") or die('Connection Failed'.mysqli_error());

                    $count = mysqli_num_rows($query);
                    $count1 = mysqli_num_rows($inc);
                    $count2 = mysqli_num_rows($com);
                    $countall = mysqli_num_rows($selectRes1);

                                            if($count ==0)
                                                {   echo 'No Results Found.'; }
                                            else
                                                {?>
                                            <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                            <thead>
                                                <tr>
                                               <div scaling='no'>                                        
                                                    <th width='15%' align='center'>Academic Yr.</th>
                                                    <th width='5%' align='center'>Incomplete</th>
                                                    <th width='5%' align='center'>Completed</th>
                                                    <th width='5%' align='center'>Total Interns</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX">
                                                    <td width='10'><?php echo $search_result?></td>
                                                    <td width='10'><?php echo $count1?></td>
                                                    <td width='10'><?php echo $count2?></td>
                                                    <td width='10'><?php echo $count?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>

                                        <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                            <thead>
                                                <tr>
                                               <div scaling='no'>      <br/>                                  
                                                    <th width='15%' align='center'>College</th>
                                                    <th width='5%' align='center'>Incomplete</th>
                                                    <th width='5%' align='center'>Completed</th>
                                                    <th width='5%' align='center'>Total Interns</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                   <?php 
                                            $select1 =mysqli_query($con,"SELECT DISTINCT tbl_courses.college FROM sscrimsx_sscrims.tbl_courses");
                                                                   while($row1 = mysqli_fetch_assoc( $select1) )
                                                                        { 
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                        <td width='10'><?php echo $row1['college']?></td>
                                                                        <td width='10'><?php 
                    $inc = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.college FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Ongoing' AND tbl_students.college= '$row1[college]' AND tbl_students.ayEnrolled='$search_result'") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                                        echo $count1?></td>
                                                                        <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.college FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Completed' AND tbl_students.college= '$row1[college]' AND tbl_students.ayEnrolled='$search_result'") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                                        echo $count2?></td>
                                                                        <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.college FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.college= '$row1[college]' AND tbl_students.ayEnrolled='$search_result'") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                                        echo $countall?></td>
                                                                        </tr>
                                           <?php } ?>
                                            </tbody>
                                        <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                            <thead>
                                                <tr>
                                               <div scaling='no'>      <br/>                                  
                                                    <th width='15%' align='center'>Course</th>
                                                    <th width='5%' align='center'>Incomplete</th>
                                                    <th width='5%' align='center'>Completed</th>
                                                    <th width='5%' align='center'>Total Interns</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                   <?php 
                                            $select1 =mysqli_query($con,"SELECT DISTINCT tbl_courses.coursename FROM sscrimsx_sscrims.tbl_courses");
                                                                   while($row1 = mysqli_fetch_assoc( $select1) )
                                                                        { 
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                        <td width='40'><?php echo $row1['coursename']?></td>
                                                                        <td width='10'><?php 
                    $inc = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.coursename FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Ongoing' AND tbl_students.coursename= '$row1[coursename]' AND tbl_students.ayEnrolled='$search_result'") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                                        echo $count1?></td>
                                                                        <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.coursename FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Completed' AND tbl_students.coursename= '$row1[coursename]' AND tbl_students.ayEnrolled='$search_result'") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                                        echo $count2?></td>
                                                                        <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.coursename FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.coursename= '$row1[coursename]' AND tbl_students.ayEnrolled='$search_result'") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                                        echo $countall?></td>
                                                                        </tr>
                                        </tbody>                    <?php }                        

                }  











            elseif (isset($_POST['all'])) 
                {
                    $select=mysqli_query($con,"SELECT DISTINCT tbl_students.ayEnrolled FROM sscrimsx_sscrims.tbl_students");?>
                                        <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                            <thead>
                                                <tr>
                                               <div scaling='no'>                                        
                                                    <th width='15%' align='center'>Academic Yr.</th>
                                                    <th width='5%' align='center'>Incomplete</th>
                                                    <th width='5%' align='center'>Completed</th>
                                                    <th width='5%' align='center'>Total Interns</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                   <?php while($row = mysqli_fetch_assoc( $select) )
                                                                        { 
                                                                        ?>

                                                                        <tr class="odd gradeX">
                                                                        <td width='10'><?php echo $row['ayEnrolled']?></td>
                                                                        <td width='10'><?php 
                    $inc = mysqli_query($con,"SELECT DISTINCT tbl_students.id,tbl_students.ayEnrolled, tbl_students.internStatus FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Ongoing' AND tbl_students.ayEnrolled= '$row[ayEnrolled]'") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                                        echo $count1?></td>
                                                                        <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT DISTINCT tbl_students.id,tbl_students.ayEnrolled, tbl_students.internStatus FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Completed' AND tbl_students.ayEnrolled= '$row[ayEnrolled]'") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                                        echo $count2?></td>
                                                                        <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT DISTINCT tbl_students.id,tbl_students.ayEnrolled FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.ayEnrolled= '$row[ayEnrolled]'") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                                        echo $countall?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                            </tbody>
                                                                        
                                        <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                            <thead>
                                                <tr>
                                               <div scaling='no'>      <br/>                                  
                                                    <th width='15%' align='center'>College</th>
                                                    <th width='5%' align='center'>Incomplete</th>
                                                    <th width='5%' align='center'>Completed</th>
                                                    <th width='5%' align='center'>Total Interns</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                   <?php 
                                            $select1 =mysqli_query($con,"SELECT DISTINCT tbl_courses.college FROM sscrimsx_sscrims.tbl_courses");
                                                                   while($row1 = mysqli_fetch_assoc( $select1) )
                                                                        { 
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                        <td width='10'><?php echo $row1['college']?></td>
                                                                        <td width='10'><?php 
                    $inc = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.college FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Ongoing' AND tbl_students.college= '$row1[college]'") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                                        echo $count1?></td>
                                                                        <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.college FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Completed' AND tbl_students.college= '$row1[college]'") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                                        echo $count2?></td>
                                                                        <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.college FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.college= '$row1[college]'") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                                        echo $countall?></td>
                                                                        </tr>
                                                                        <?php }?>
                                            </tbody>
                                        <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                            <thead>
                                                <tr>
                                               <div scaling='no'>      <br/>                                  
                                                    <th width='15%' align='center'>Course</th>
                                                    <th width='5%' align='center'>Incomplete</th>
                                                    <th width='5%' align='center'>Completed</th>
                                                    <th width='5%' align='center'>Total Interns</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                   <?php 
                                            $select1 =mysqli_query($con,"SELECT DISTINCT tbl_courses.coursename FROM sscrimsx_sscrims.tbl_courses");
                                                                   while($row1 = mysqli_fetch_assoc( $select1) )
                                                                        { 
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                        <td width='40'><?php echo $row1['coursename']?></td>
                                                                        <td width='10'><?php 
                    $inc = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.coursename FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Ongoing' AND tbl_students.coursename= '$row1[coursename]'") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                                        echo $count1?></td>
                                                                        <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.coursename FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Completed' AND tbl_students.coursename= '$row1[coursename]'") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                                        echo $count2?></td>
                                                                        <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.coursename FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.coursename= '$row1[coursename]'") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                                        echo $countall?></td>
                                                                        </tr>
                                        </tbody>                    <?php }  
            }   














            else 
                {
                    $selectSQL = 'SELECT * FROM tbl_companies ORDER BY companyID';
                    $selectSQL="SELECT concat_ws('', tbl_studinternshipinfo.compNameNP, tbl_studinternshipinfo.compName) as 'company'";
                    $select=mysqli_query($con,"SELECT DISTINCT tbl_students.ayEnrolled FROM sscrimsx_sscrims.tbl_students"); ?>  
                                    <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                            <thead>
                                                <tr>
                                               <div scaling='no'>                                        
                                                    <th width='15%' align='center'>Academic Yr.</th>
                                                    <th width='5%' align='center'>Incomplete</th>
                                                    <th width='5%' align='center'>Completed</th>
                                                    <th width='5%' align='center'>Total Interns</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                    <?php
                                                                    while($row = mysqli_fetch_assoc( $select) )
                                                                        { 
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                        <td width='10'><?php echo $row['ayEnrolled']?></td>
                                                                        <td width='10'><?php 
                    $inc = mysqli_query($con,"SELECT DISTINCT tbl_students.id,tbl_students.ayEnrolled, tbl_students.internStatus FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Ongoing' AND tbl_students.ayEnrolled= '$row[ayEnrolled]'") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                                        echo $count1?></td>
                                                                        <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT DISTINCT tbl_students.id,tbl_students.ayEnrolled, tbl_students.internStatus FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Completed' AND tbl_students.ayEnrolled= '$row[ayEnrolled]'") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                                        echo $count2?></td>
                                                                        <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT DISTINCT tbl_students.id,tbl_students.ayEnrolled FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.ayEnrolled= '$row[ayEnrolled]'") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                                        echo $countall?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                            </tbody>
                                                                        
                                        <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                            <thead>
                                                <tr>
                                               <div scaling='no'>      <br/>                                  
                                                    <th width='15%' align='center'>College</th>
                                                    <th width='5%' align='center'>Incomplete</th>
                                                    <th width='5%' align='center'>Completed</th>
                                                    <th width='5%' align='center'>Total Interns</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                   <?php 
                                            $select1 =mysqli_query($con,"SELECT DISTINCT tbl_courses.college FROM sscrimsx_sscrims.tbl_courses");
                                                                   while($row1 = mysqli_fetch_assoc( $select1) )
                                                                        { 
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                        <td width='10'><?php echo $row1['college']?></td>
                                                                        <td width='10'><?php 
                    $inc = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.college FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Ongoing' AND tbl_students.college= '$row1[college]'") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                                        echo $count1?></td>
                                                                        <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.college FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Completed' AND tbl_students.college= '$row1[college]'") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                                        echo $count2?></td>
                                                                        <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.college FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.college= '$row1[college]'") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                                        echo $countall?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                            </tbody>
                                        <table class="table-bordered table-hover table-striped" width="65%" align='center'>
                                            <thead>
                                                <tr>
                                               <div scaling='no'>      <br/>                                  
                                                    <th width='15%' align='center'>Course</th>
                                                    <th width='5%' align='center'>Incomplete</th>
                                                    <th width='5%' align='center'>Completed</th>
                                                    <th width='5%' align='center'>Total Interns</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                                   <?php 
                                            $select1 =mysqli_query($con,"SELECT DISTINCT tbl_courses.coursename FROM sscrimsx_sscrims.tbl_courses");
                                                                   while($row1 = mysqli_fetch_assoc( $select1) )
                                                                        { 
                                                                        ?>
                                                                        <tr class="odd gradeX">
                                                                        <td width='40'><?php echo $row1['coursename']?></td>
                                                                        <td width='10'><?php 
                    $inc = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.coursename FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Ongoing' AND tbl_students.coursename= '$row1[coursename]'") or die('Connection Failed'.mysqli_error());
                    $count1 = mysqli_num_rows($inc);
                                                                        echo $count1?></td>
                                                                        <td width='10'><?php 
                    $com = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.internStatus, tbl_students.coursename FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.internStatus='Completed' AND tbl_students.coursename= '$row1[coursename]'") or die('Connection Failed'.mysqli_error());
                    $count2 = mysqli_num_rows($com);
                                                                        echo $count2?></td>
                                                                        <td width='10'><?php 
                    $count = mysqli_query($con,"SELECT  tbl_students.ayEnrolled, tbl_students.coursename FROM sscrimsx_sscrims.tbl_students WHERE  tbl_students.coursename= '$row1[coursename]'") or die('Connection Failed'.mysqli_error());
                    $countall = mysqli_num_rows($count);
                                                                        echo $countall?></td>
                                                                        </tr>
                                        </tbody>                    <?php }                                                        

                }//else
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