<?php
include("include/session.php");

?>
<html>
<head>
<title>Talent Hunt-results</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/jquery.js"></script>
<style>
#data tr{background-color:#BC7E7E;color:#301A1A;}
#data td{font-size:19px;}
#data{width:500px;padding-left:3px;}
a img {border:none;}
</style>
</head>
<body>
<?php
global $database;
global $session;
if(isset($_GET['admin']))
{
 if($session->isAdmin()){
   include("selectexam.html.php");
 }
}
if(isset($_POST['topic']))
{
  echo "<table align='center' border='1'>";
  $rows=$database->getreport($_POST['topic']);
  $count=1;
  foreach ($rows as $row) {
     echo "<tr><td>".$count++."</td><td>".$row['username']."</td><td>".$row['result']."</td></tr>";
  
     
  }
  echo "</table>";
  echo "<h1> please wait for announcement </h1>";
}
if(isset($_GET['id']))
{
 $examid=$_GET['id'];
  if(!$database->valid($examid))
  {
  echo "<font color=red><b>not a valid exam</b></font>";
  exit();
  }
 $result=$database->getresults($examid);
 echo "<h1> Please Wait for announcement <h1>";
 echo "<a href=\"?user=".$result['username'].'" title="Go back"><img src="images/back.png"></a>';
}
else if(isset($_GET['user']))
{
 if($_GET['result']=='latest')
 {
  $result=$database->getresults($database->latestExamID($_GET['user']));
  echo "<h1> <p> please wait for the announcement</p> </h1>";
  echo '<a href="index.php" title="Go back"><img src="images/back.png"></a>';
 }
 else{
  $username=$_GET['user'];
   if($database->noresults(($username)))
   {
    echo "<b><font color=red size=6>".$username."</font></b> hasn't attended exams until now";
    exit();
   }
  $exams=$database->getExams($username);
 echo "<h1> Please wait for the announcement</h1>";
 }
}
?>

