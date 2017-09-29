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
                        <div class="row">
                          <h2 >Interns Deployments</h2>
                                <div class="dontprint">
                                <a style="color:white; text-decoration: none;" href="SSCR_Homepage.php" id="white"><input type="button" class="btn btn-md btn-success" id="buttonwidth" value="Cancel"></a>
                                <form  class="form-group" action="Report_InternDeployment.php" enctype="multipart/form-data" method="post" runat="server">
                                                <div class="row">  
                                                <div class="col-xs-2">                                        
                                                    <label ><b>A.Y.</b></label></br>
                                                    <select class="form-control" name="ayEnrolled" id="ayEnrolled">     
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
                                                 <div class="col-xs-2">                                        
                                                    <label ><b>College</b></label></br>
                                                    <select class="form-control" name="college" id="college">     
                                                    <option  value=""></option>
                                                    <?php
                                                     require("Connect.php");
                                                    $getallGroups = mysqli_query($con,"SELECT DISTINCT college FROM tbl_courses  WHERE course_status='Active' ORDER BY college ASC");

                                                        while($viewallGroups = mysqli_fetch_array($getallGroups))

                                                            {?>
                                                            <option value="<?php echo $viewallGroups['college'];?>"><?php echo $viewallGroups['college'];?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                    </select>
                                                </div>       
                                                 <div class="col-xs-2">                                        
                                                    <label ><b>Course</b></label></br>
                                                    <select class="form-control" name="coursename" id="coursename">     
                                                    <option  value=""></option>
                                                    <?php
                                                     require("Connect.php");
                                                    $getallGroups = mysqli_query($con,"SELECT DISTINCT coursename FROM tbl_courses  WHERE course_status='Active' ORDER BY coursename ASC");

                                                        while($viewallGroups = mysqli_fetch_array($getallGroups))

                                                            {?>
                                                            <option value="<?php echo $viewallGroups['coursename'];?>"><?php echo $viewallGroups['coursename'];?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                    </select>
                                                </div>            
                                                <div class="col-xs-2">
                                                    <label>Semester</label></br>
                                                        <select class="form-control" style="margin-left: 5px;" name="practicumsem">
                                                          <option value=""> </option>
                                                          <option value="First Semester">First Semester</option>
                                                          <option value="Second Semester">Second Semester</option>
                                                          <option value="Summer">Summer</option>
                                                        </select></br>
                                                </div>                 
                                                  <div class="col-xs-2">                                        
                                                    <label ><b>Training Institution</b></label></br>
                                                    <select class="form-control" name="compName" id="compName">     
                                                    <option  value=""></option>
                                                     <?php
                                                     require("Connect.php");
                                                    $getallGroups = mysqli_query($con,"SELECT DISTINCT concat_ws('', compNameNP, compName) as 'company' FROM tbl_studinternshipinfo  ORDER BY company ASC");

                                                        while($viewallGroups = mysqli_fetch_array($getallGroups))

                                                            {?>
                                                            <option value="<?php echo $viewallGroups['company'];?>"><?php echo $viewallGroups['company'];?></option>
                                                            <?php
                                                            }
                                                            ?>

                                                    </select>
                                                </div>   
                                            <div class="col-xs-2"></br>
                                             <button type="submit" class="btn btn-success" name="search" id="search"><i class="fa fa-search fa-fw"></i></button>
                                            <input class="btn btn-success" type="button"  value='PRINT REPORT' onclick="printpage()">
                                            </div>
                                                </div>                                                
                                            </form>
                                 <form name="search_all" class="form-group" action="Report_InternDeployment.php" enctype="multipart/form-data" method="post" runat="server">
                                                    <button type="submit" class="btn btn-success" name="all" id="all">All Results</button>
                                                </form>
                                
                                </div>
                                        
                                           <table class="table table-bordered table-hover table-striped" width=1000 align='center'>
                                            <thead>
                                                <tr>
                                               <div  scaling='no'>                                        
                                                    
                                                    <th width='10%' align='center'>Student&nbsp;No.</th>
                                                    <th width='10%' align='center'>Last&nbsp;Name</th>
                                                    <th width='10%' align='center'>First&nbsp;Name</th>
                                                    <th width='10%' align='center'>Middle&nbsp;Name</th>
                                                    <th width='10%' align='center'>Course</th>
                                                    <th width='10%' align='center'>Training Institution&nbsp;Name</th>
                                                   <!--<th width='10%' align='center'>Training Institution Class</th>-->
                                                    <th width='10%' align='center'>Department</th>
                                                    <th width='10%' align='center'>Duration</th>
                                                    <th width='10%' align='center'>Hours Rendered</th>
                                                    <th width='10%' align='center'>Hours To Render</th>
                                                    <!--<th width='10%' align='center'>Onsite Supervisor</th>-->
                                                    <th width='10%' align='center'>Date Started</th>
                                                    <th width='10%' align='center'>Date Finished</th>
                                                    <!--<th width='10%' align='center'>Evaluation Status</th>
                                                    <th width='10%' align='center'>Intership Status</th>
                                                    <th width='10%' align='center'>Training Institution Evaluation Status</th>-->

                                                </tr>
                                            </thead>
                                            <tbody>
                                                       <?php
                                                            
                                                            include_once "Connect.php"; 

                        $selectSQL="SELECT concat_ws('', tbl_studinternshipinfo.compNameNP, tbl_studinternshipinfo.compName) as 'company', tbl_studinternshipinfo.dateStarted, tbl_studinternshipinfo.dateFinished,concat_ws('', tbl_studinternshipinfo.department, tbl_studinternshipinfo.npdept) as 'department', tbl_studinternshipinfo.duration, tbl_studinternshipinfo.supervisor, tbl_studinternshipinfo.evaluationStatus, tbl_studinternshipinfo.internshipStatus, tbl_studinternshipinfo.interninfoID , tbl_students.id,tbl_students.ayEnrolled,tbl_students.studidno, tbl_students.studLastname, tbl_students.studMiddlename, tbl_students.studFirstname, tbl_students.coursename, tbl_studinternshipinfo.companyID, tbl_studinternshipinfo.compClass, tbl_studinternshipinfo.evaluationCompany
                                    FROM sscrimsx_sscrims.tbl_studinternshipinfo LEFT JOIN sscrimsx_sscrims.tbl_students
                                                            ON tbl_studinternshipinfo.studidno=tbl_students.studidno ORDER BY company DESC" ;
                                                           
                                                            if( !( $selectRes = mysqli_query( $con,$selectSQL ) ) )
                                                                {
                                                                 echo 'Retrieval of data from Database Failed - #'.mysqli_errno().': '.mysqli_error();
                                                                }
                                                             elseif (isset($_POST['Ongoing'])) 
                                                            {
                                $selectSQL1="SELECT concat_ws('', tbl_studinternshipinfo.compNameNP, tbl_studinternshipinfo.compName) as 'company', tbl_studinternshipinfo.dateStarted, tbl_studinternshipinfo.dateFinished,concat_ws('', tbl_studinternshipinfo.department, tbl_studinternshipinfo.npdept) as 'department', tbl_studinternshipinfo.duration, tbl_studinternshipinfo.supervisor, tbl_studinternshipinfo.evaluationStatus, tbl_studinternshipinfo.internshipStatus, tbl_studinternshipinfo.interninfoID , tbl_students.id,tbl_students.ayEnrolled,tbl_students.studidno, tbl_students.studLastname, tbl_students.studMiddlename, tbl_students.studFirstname, tbl_students.coursename, tbl_studinternshipinfo.companyID, tbl_studinternshipinfo.compClass, tbl_studinternshipinfo.evaluationCompany
                                   FROM sscrimsx_sscrims.tbl_studinternshipinfo LEFT JOIN sscrimsx_sscrims.tbl_students
                                                            ON tbl_studinternshipinfo.studidno=tbl_students.studidno WHERE tbl_studinternshipinfo.internshipStatus= 'Ongoing' ORDER BY company DESC" ;
                                                               
                                                               /* $selectSQL1 = "SELECT * FROM tbl_students WHERE internStatus= 'Ongoing' ORDER BY studLastname";*/
                                                             if( !( $selectRes1 = mysqli_query($con, $selectSQL1 ) ) )
                                                                {
                                                                 echo 'Retrieval of data from Database Failed - #'.mysqli_errno().': '.mysqli_error();
                                                                }
                                                                else
                                                                {
                                                                    while( $row = mysqli_fetch_assoc( $selectRes1 ) ) 
                                                                        { ?>
                                                                        <tr class="odd gradeX">
                                                                        
                                                                        <td><?php echo $row['studidno']?></td>
                                                                        <td><?php echo $row['studLastname']?></td>
                                                                        <td><?php echo $row['studFirstname']?></td>
                                                                        <td><?php echo $row['studMiddlename']?></td>
                                                                        <td><?php echo $row['coursename']?></td>
                                                                        <td><?php echo $row['company']?></td>
                                                                       <!--<td><?php echo $row['compClass']?></td>-->
                                                                        <td><?php echo $row['department']?></td>
                                                                        <td><?php echo $row['duration']?></td>
                                                    			<td>                                                                
  <?php
$ID=$row['studidno'];

$selectHours=mysqli_query($con,"SELECT tbl_students.studidno,tbl_students.coursename, tbl_courses.practicumhours, tbl_courses.coursename FROM sscrimsx_sscrims.tbl_students LEFT JOIN sscrimsx_sscrims.tbl_courses ON tbl_students.coursename=tbl_courses.coursename WHERE tbl_students.studidno='$ID'");
$row2 = mysqli_fetch_assoc($selectHours);
$select=mysqli_query($con,"SELECT SUM(hours) AS totalhours FROM tbl_attendance WHERE studidno='$ID' AND attend_status='Verified'");
                                $row1 = mysqli_fetch_assoc( $select);
                                 $totalH=$row2['practicumhours']-$row1['totalhours'];  
                                 
                                               echo $row1['totalhours'];?>
                                               
									</td>
									<td><?php
									$duration=$row['duration']-$row1['totalhours'];  
									echo $duration;?></td>  
                                                                        <!--<td><?php echo $row['supervisor']?></td>-->
                                                                        <td><?php echo $row['dateStarted']?></td>
                                                                        <td><?php echo $row['dateFinished']?></td>
                                                                        <!-- <td><?php echo $row['evaluationStatus']?></td>
                                                                        <td><?php echo $row['internshipStatus']?></td>
                                                                       <td><?php echo $row['evaluationCompany']?></td>-->
                                                                        </tr>
                                                            <?php        
                                                                        }
                                                                }
                                                            }
                                                            elseif (isset($_POST['search'])) 
                                                            {
                                                                    $search_result = $_POST['college'];
                                                                    $search_result1 = $_POST['practicumsem'];
                                                                    $search_result3 = $_POST['coursename'];
                                                                    $search_result4 = $_POST['compName'];
                                                                    $search_result5 = $_POST['ayEnrolled'];

                        $query = mysqli_query($con,"

SELECT concat_ws('', tbl_studinternshipinfo.compNameNP, tbl_studinternshipinfo.compName) as 'company', tbl_studinternshipinfo.dateStarted, tbl_studinternshipinfo.dateFinished,concat_ws('', tbl_studinternshipinfo.department, tbl_studinternshipinfo.npdept) as 'department', tbl_studinternshipinfo.duration, tbl_studinternshipinfo.supervisor, tbl_studinternshipinfo.evaluationStatus, tbl_studinternshipinfo.internshipStatus, tbl_studinternshipinfo.interninfoID , tbl_students.id,tbl_students.ayEnrolled,tbl_students.studidno, tbl_students.studLastname, tbl_students.studMiddlename, tbl_students.studFirstname, tbl_students.coursename, tbl_studinternshipinfo.companyID, tbl_studinternshipinfo.compClass, tbl_studinternshipinfo.evaluationCompany
                                    FROM sscrimsx_sscrims.tbl_studinternshipinfo 
                                    LEFT JOIN sscrimsx_sscrims.tbl_students
                                    ON tbl_studinternshipinfo.studidno=tbl_students.studidno 

                                    LEFT JOIN sscrimsx_sscrims.tbl_courses  
                                    ON tbl_courses.coursename=tbl_students.coursename

                            
            WHERE  (tbl_students.college='$search_result' AND tbl_courses.coursename='$search_result3%') OR tbl_students.college='$search_result' OR tbl_courses.coursename='$search_result3' OR tbl_courses.practicumsem='$search_result1' OR tbl_studinternshipinfo.compName='$search_result4' OR tbl_students.ayEnrolled='$search_result5'") or die('Connection Failed'.mysqli_error());

                                                            if ($search_result=='CABAHM')
                                                            {$search_result5='College of Accountancy,Business Administration and Hospitality Management (CABAHM)';}
                                                            elseif ($search_result=='CASN')
                                                            {$search_result5='College of Arts, Sciences, and Nursing (CASN)';}
                                                            elseif ($search_result=='CCJE')
                                                            {$search_result5='College of Criminal Justice Education (CCJE)';}
                                                            elseif ($search_result=='CECST')
                                                            {$search_result5='College of Engineering, Computer Science and Technology (CECST)';}
                                                            $count = mysqli_num_rows($query);
                                                            echo "<label>$search_result5 </br> $search_result3 </br> $search_result1 </br> $search_result2 </br> $search_result4</label> </br>";
                                                            echo "<label>Total Results: $count</label>";
                                                                if($count ==0)
                                                                {
                                                                    echo 'No Results Found.';
                                                                }
                                                                else
                                                                {
                                                                
                                                                    while ($row = mysqli_fetch_assoc($query)) 
                                                                        { ?>
                                                                
                                                                        <tr class="odd gradeX">
                                                                        
                                                                        <td><?php echo $row['studidno']?></td>
                                                                        <td><?php echo $row['studLastname']?></td>
                                                                        <td><?php echo $row['studFirstname']?></td>
                                                                        <td><?php echo $row['studMiddlename']?></td>
                                                                        <td><?php echo $row['coursename']?></td>
                                                                        <td><?php echo $row['company']?></td>
                                                                        <!--<td><?php echo $row['compClass']?></td>-->
                                                                        <td><?php echo $row['department']?></td>
                                                                        <td><?php echo $row['duration']?></td>
                                                                        <td>                                                                
  <?php
  $ID=$row['studidno'];
$selectHours=mysqli_query($con,"SELECT tbl_students.studidno,tbl_students.coursename, tbl_courses.practicumhours, tbl_courses.coursename FROM sscrimsx_sscrims.tbl_students LEFT JOIN sscrimsx_sscrims.tbl_courses ON tbl_students.coursename=tbl_courses.coursename WHERE tbl_students.studidno='$ID'");
$row2 = mysqli_fetch_assoc($selectHours);
$select=mysqli_query($con,"SELECT SUM(hours) AS totalhours FROM tbl_attendance WHERE studidno='$ID' AND attend_status='Verified'");
                                $row1 = mysqli_fetch_assoc( $select);
                                 $totalH=$row2['practicumhours']-$row1['totalhours'];
                                               
                                               echo $row1['totalhours'];?>
									</td>
									<td><?php
									$duration=$row['duration']-$row1['totalhours'];  
									echo $duration;?></td>    
                                                                        <!--<td><?php echo $row['supervisor']?></td>-->
                                                                        <td><?php echo $row['dateStarted']?></td>
                                                                        <td><?php echo $row['dateFinished']?></td>
                                                                        <!--<td><?php echo $row['evaluationStatus']?></td>
                                                                        <td><?php echo $row['internshipStatus']?></td>
                                                                        <td><?php echo $row['evaluationCompany']?></td>-->
                                                                        </tr>
                                                            <?php        
                                                                        }
                                                                }
                                                            }



                                                            elseif (isset($_POST['Completed'])) 
                                                            {
                                                            $selectSQL1="SELECT concat_ws('', tbl_studinternshipinfo.compNameNP, tbl_studinternshipinfo.compName) as 'company', tbl_studinternshipinfo.dateStarted, tbl_studinternshipinfo.dateFinished,concat_ws('', tbl_studinternshipinfo.department, tbl_studinternshipinfo.npdept) as 'department', tbl_studinternshipinfo.duration, tbl_studinternshipinfo.supervisor, tbl_studinternshipinfo.evaluationStatus, tbl_studinternshipinfo.internshipStatus, tbl_studinternshipinfo.interninfoID , tbl_students.id,tbl_students.ayEnrolled,tbl_students.studidno, tbl_students.studLastname, tbl_students.studMiddlename, tbl_students.studFirstname, tbl_students.coursename, tbl_studinternshipinfo.companyID, tbl_studinternshipinfo.compClass, tbl_studinternshipinfo.evaluationCompany
                                    FROM sscrimsx_sscrims.tbl_studinternshipinfo LEFT JOIN sscrimsx_sscrims.tbl_students
                                                            ON tbl_studinternshipinfo.studidno=tbl_students.studidno WHERE tbl_studinternshipinfo.internshipStatus= 'Completed' ORDER BY company DESC" ;

                                                               /* $selectSQL1 = "SELECT * FROM tbl_students WHERE internStatus= 'completed' ORDER BY studLastname";*/
                                                             if( !( $selectRes1 = mysqli_query($con, $selectSQL1 ) ) )
                                                                {
                                                                 echo 'Retrieval of data from Database Failed - #'.mysqli_errno().': '.mysqli_error();
                                                                }
                                                                else
                                                                {
                                                                    while( $row = mysqli_fetch_assoc( $selectRes1 ) ) 
                                                                        { ?>
                                                                        <tr class="odd gradeX">
                                                                       <td><?php echo $row['studidno']?></td>
                                                                        <td><?php echo $row['studLastname']?></td>
                                                                        <td><?php echo $row['studFirstname']?></td>
                                                                        <td><?php echo $row['studMiddlename']?></td>
                                                                        <td><?php echo $row['coursename']?></td>
                                                                        <td><?php echo $row['company']?></td>
                                                                        <!--<td><?php echo $row['compClass']?></td>-->
                                                                        <td><?php echo $row['department']?></td>
                                                                        <td><?php echo $row['duration']?></td>
                                                                        <td>                                                                
  <?php
  $ID=$row['studidno'];
$selectHours=mysqli_query($con,"SELECT tbl_students.studidno,tbl_students.coursename, tbl_courses.practicumhours, tbl_courses.coursename FROM sscrimsx_sscrims.tbl_students LEFT JOIN sscrimsx_sscrims.tbl_courses ON tbl_students.coursename=tbl_courses.coursename WHERE tbl_students.studidno='$ID'");
$row2 = mysqli_fetch_assoc($selectHours);
$select=mysqli_query($con,"SELECT SUM(hours) AS totalhours FROM tbl_attendance WHERE studidno='$ID' AND attend_status='Verified'");
                                $row1 = mysqli_fetch_assoc( $select);
                                 $totalH=$row2['practicumhours']-$row1['totalhours'];
                                               
                                               echo $row1['totalhours'];?>
									</td>
									<td><?php
									$duration=$row['duration']-$row1['totalhours'];  
									echo $duration;?></td>     
                                                                        <!--<td><?php echo $row['supervisor']?></td>-->
                                                                        <td><?php echo $row['dateStarted']?></td>
                                                                        <td><?php echo $row['dateFinished']?></td>
                                                                        <!--<td><?php echo $row['evaluationStatus']?></td>
                                                                        <td><?php echo $row['internshipStatus']?></td>
                                                                      	<td><?php echo $row['evaluationCompany']?></td>-->
                                                                        </tr>
                                                            <?php        
                                                                        }
                                                                }
                                                            }        
                                                            else
                                                                {
                                                        
                                                                    while( $row = mysqli_fetch_assoc( $selectRes ) )
                                                                        { ?>
                                                                        <tr class="odd gradeX">
                                                                        <td><?php echo $row['studidno']?></td>
                                                                        <td><?php echo $row['studLastname']?></td>
                                                                        <td><?php echo $row['studFirstname']?></td>
                                                                        <td><?php echo $row['studMiddlename']?></td>
                                                                        <td><?php echo $row['coursename']?></td>
                                                                        <td><?php echo $row['company']?></td>
                                                                        <!--<td><?php echo $row['compClass']?></td>-->
                                                                        <td><?php echo $row['department']?></td>
                                                                        <td><?php echo $row['duration']?></td> 
                                                                        <td>                                                                
  <?php
  $ID=$row['studidno'];
$selectHours=mysqli_query($con,"SELECT tbl_students.studidno,tbl_students.coursename, tbl_courses.practicumhours, tbl_courses.coursename FROM sscrimsx_sscrims.tbl_students LEFT JOIN sscrimsx_sscrims.tbl_courses ON tbl_students.coursename=tbl_courses.coursename WHERE tbl_students.studidno='$ID'");
$row2 = mysqli_fetch_assoc($selectHours);
$select=mysqli_query($con,"SELECT SUM(hours) AS totalhours FROM tbl_attendance WHERE studidno='$ID' AND attend_status='Verified'");
                                $row1 = mysqli_fetch_assoc( $select);
                                 $totalH=$row2['practicumhours']-$row1['totalhours'];
                                               
                                               echo $row1['totalhours'];?>
									</td>   
									<td><?php
									$duration=$row['duration']-$row1['totalhours'];  
									echo $duration;?></td>                       
                                                                        <!--<td><?php echo $row['supervisor']?></td>-->
                                                                        <td><?php echo $row['dateStarted']?></td>
                                                                        <td><?php echo $row['dateFinished']?></td>
                                                                        <!-- <td><?php echo $row['evaluationStatus']?></td>
                                                                        <td><?php echo $row['internshipStatus']?></td>
                                                                       <td><?php echo $row['evaluationCompany']?></td>-->
                                                                        </tr>
                                                                           <?php      
                                                                       }
                                                                }
                                                                ?>
                                            </tbody>
                                        </table>
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