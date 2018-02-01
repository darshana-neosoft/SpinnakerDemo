

<?php



echo 'hii';
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

if(isset($_POST['case_size']))
{
$dbhost = 'localhost';
$dbuser = 'QPS_user';
$dbpass = 'QPS_user';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}


$case_id = "SA4".rand(10,100);
$case_size=$_POST['case_size'];
$face_amount =$_POST['face_amount'];
$industry =$_POST['industry'];
$industry_text = explode(',',$industry);
$industry_name = $industry_text[0];
$industry_score = $industry_text[1];
$state =$_POST['state'];
$seasonality =$_POST['seasonality'];
$broker =$_POST['broker'];
$case_priority = "1";
$quote_score = "123";
$case_status="NEW";


$sql = "INSERT INTO spin ".
       "(case_id,case_size,industry,state,face_amount,broker,quote_score,case_priority,case_status,seasonality) ".
       "VALUES ".
       "('$case_id','$case_size','$industry_name','$state','$face_amount','$broker','$industry_score','$case_priority','$case_status','$seasonality')";
       

mysqli_select_db($conn,'QPSDatabase');
$retval = mysqli_query($conn,$sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
mysqli_close($conn);

}



 
?>


