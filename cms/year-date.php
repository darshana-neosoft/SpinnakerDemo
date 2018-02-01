<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
if($_SESSION['status']!="Active")
{
    header("location:index.php");
}

if(isset($_POST['submit']))
{
$dbhost = 'localhost';
$dbuser = 'QPS_user';
$dbpass = 'QPS_user';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$case_size=$_POST['case_size'];
if ($case_size >=0 && $case_size <= 99) {
 $case_score = -2;
}
elseif ($case_size >=100 && $case_size <= 199) {
	$case_score = -23;
}
elseif ($case_size >=200 && $case_size <= 499) {
	$case_score = -16;
}
elseif ($case_size >=500 && $case_size <= 999) {
	$case_score = -4;
}
elseif ($case_size >=1000 && $case_size <= 2999) {
	$case_score = 32;
}
elseif ($case_size >=3000) {
	$case_score = 334;
}
$case_id = "SA4".rand(10,100);

$face_amount =$_POST['face_amount'];
$industry =$_POST['industry'];
$industry_text = explode(',',$industry);
$industry_name = $industry_text[0];
$industry_score = $industry_text[1];
$state =$_POST['state'];
$state_text = explode(',',$state);
$state_name = $state_text[1];
$state_score = (int)$state_text[0];
$seasonality =$_POST['seasonality'];
$seasonality_text = explode(',',$seasonality);
$seasonality_name = $seasonality_text[1];
$seasonality_score = (int)$seasonality_text[0];
$broker =$_POST['broker'];
$broker_text = explode('+',$broker);
$broker_name = $broker_text[1];
$broker_score = (int)$broker_text[0];
$case_priority = "1";
$quote_score = $state_score + $seasonality_score+$broker_score+$industry_score+$case_score;
$case_status="New";


$sql = "INSERT INTO spin ".
       "(case_id,case_size,industry,state,face_amount,broker,quote_score,case_priority,case_status,seasonality) ".
       "VALUES ".
       "('$case_id','$case_size','$industry_name','$state_name','$face_amount','$broker_name','$quote_score','$case_priority','$case_status','$seasonality_name')";
       

mysqli_select_db($conn,'QPSDatabase');
$retval = mysqli_query($conn,$sql);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
mysqli_close($conn);
header ("Location: year-date.php");
exit;
}


if(isset($_POST['update']))
{
$dbhost = 'localhost';
$dbuser = 'QPS_user';
$dbpass = 'QPS_user';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$new_status=$_POST['new_status'];
$assessment =$_POST['assessment'];
$new_case_id =$_POST['new_case_id'];

$sql4 = "UPDATE spin SET case_status='".$new_status."', case_assessment='".$assessment."' WHERE id='".$new_case_id."'";
mysqli_select_db($conn,'QPSDatabase');
$retval = mysqli_query($conn,$sql4);
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Updated data successfully\n";
mysqli_close($conn);

}

?>
<!DOCTYPE html>
<html>
<head>

	<title>CMS</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
	<link rel="stylesheet" type="text/css" href="css/sales.css">
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
</head>
<body>


<div class="container-fluid">
	<div class="row">
		<div class="side-bar">
			<div class="row">
				<h4 class="text-center">CASE MANAGEMENT SYSTEM</h4>
			</div>
			<div class="row">
				<ul class="side-menu nav nav-pills">
					<li class="active">
					<div class="hide-line"></div>
						<a  href="#home" aria-controls="home" role="tab" data-toggle="tab" class="btn-block">In-Basket <span class="right-angle" ></span><span class=" line"></span></a>
					</li>
					<li>
						<a href="#sales-track" aria-controls="sales-track" role="tab" data-toggle="tab" class="btn-block">Case Tracker <span class="right-angle"></span><span class=" line"></span></a>
					</li>
					<li class="disabled">
						<a href="#return-track" aria-controls="return-track" role="tab" data-toggle="tab" class="btn-block">Productivity Tracker by Role <span class="right-angle"></span><span class=" line"></span></a>
					</li>
					<li>
						<a href="#customer-dashboard" aria-controls="customer-dashboard" role="tab" data-toggle="tab" class="btn-block">Sales Projection<span class="right-angle"></span><span class=" line"></span></a>
					</li>
					<li class="disabled">
						<a href="#variance-diagnostics" aria-controls="variance-diagnostics" role="tab" data-toggle="tab" class="btn-block">Scenario Planning <span class="right-angle"></span><span class=" line"></span></a>
					</li>
					
					<li>
						<a href="#score-calculator" aria-controls="variance-diagnostics" role="tab" data-toggle="tab" class="btn-block">Score Calculator <span class="right-angle"></span><span class=" line"></span></a>
					</li>
					<li>
						<a href="#scorecard-engine" aria-controls="home" role="tab" data-toggle="tab" class="btn-block">Scorecard Engine <span class="right-angle"></span><span class=" line"></span></a>
						<div class="buttom-hide-line"></div>
					</li>
					
				</ul>
			</div>

		</div>
		<div class="right-screen">		
		 <div class="tab-content">
		 <div class="row row-screen">
				<h4><span class="pull-right dashbord-title"><span class="pull-right rectangle">	
				<div class="" >
				<ul class="nav navbar-nav pull-right">
					<li >
						<a href="logout.php">		
						<i style="color:white;" class="fa fa-power-off"></i>
							</a>
					</li>
				</ul>
			</div>

			</b></span><br>Powered by Spinnaker Analytics</span></span><br></h4>
		</div>

		 <div role="tabpanel" class="tab-pane active" id="home">
		 <div class="row row-screen">
			<div class="clearfix date-track">
			<h2 class="title-income date1">In-Basket</h2>
			<h4 class="title-income date2"><div class="todaydate"></div></h4>
		</div>
			<hr class="hr-line"/>
		</div>
		<div class="row row-screen border-radius">
		<div class="clearfix">
										
											<div class="filter-block pull-right">
													<a href="#" data-toggle="modal" data-target="#modaladd" class="btn btn-info pull-right">
														<i class="fa fa-plus-circle fa-lg"></i> Add Case
													</a>
											</div>
											</div>


											 

            <table class="table table-stripped table-bordered table-custom table-responsive" id="myTable">
      <thead>
        <tr class="table-head">

         <th class="text-center "> <B>#</B></th>
          <th class="text-center "><B>Case ID</B></th>
          <th class="text-center"><B>Date</B></th>
          <th class="text-center"><B>Case Size</B></th>
          <th class="text-center"><B>Industry</B></th>
          <th class="text-center"><B>State</B></th>
          <th class="text-center"><B>Face Amount ($)</B></th>
          <th class="text-center"><B>Broker</B></th>
          <th class="text-center"><B>Quote Score</B></th>
          <th class="text-center"><B>Case Priority</B></th>
          <th class="text-center"><B>Status</B></th>
        </tr>
      </thead>
      <tbody>
 		
 		
<?php
$username = "QPS_user";
      $password = "QPS_user";
      $host = "localhost";

      $connector = mysqli_connect($host,$username,$password)
          or die("Unable to connect");
      $selected = mysqli_select_db($connector,"QPSDatabase")
        or die("Unable to connect");

      //execute the SQL query and return records
      //$sql2 ="SELECT * FROM spin where case_status!='Completed'";
      $sql2="SELECT id, case_date, case_id, case_size, industry, state, face_amount, broker, quote_score, case_priority, case_status, seasonality, case_assessment, FIND_IN_SET( quote_score, (
			SELECT GROUP_CONCAT( quote_score
			ORDER BY cast(quote_score as SIGNED) desc) 
			FROM spin where case_status!='Completed')
			) AS rank
			FROM spin where case_status!='Completed'";   
	  $result = mysqli_query($connector,$sql2);

?>




 
<?php
    while ($rows=mysqli_fetch_array($result))
 {
 
?>
<tr>
          <th class="text-center" scope="row">	<?php echo $rows['id']; ?> </th>	
          <td class="text-center" >	<a href="#" data-toggle="modal" data-target="#casemodal<?php echo $rows['id'];?>" ><?php echo $rows['case_id']; ?></a></td>	
          <td class="text-center" >	<?php echo $rows['case_date'] ?> </td>	
          <td class="text-center" >	<?php echo $rows['case_size'] ?>	</td>	
          <td class="text-center" >	<?php echo $rows['industry'] ?> </td>	
          <td class="text-center" >	<?php echo $rows['state'] ?> </td>	
          <td class="text-center" >	<?php echo $rows['face_amount'] ?></td>	
          <td class="text-center " >	<?php echo $rows['broker'] ?>	</td>	
          <td class="text-center " >	<?php echo $rows['quote_score'] ?>	</td>
          <td class="text-center" >	<?php echo $rows['rank'] ?>	</td>
           <td class="text-center" >	<?php echo $rows['case_status'] ?>	</td>
        </tr>

<div id="casemodal<?php echo $rows['id'];?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Case Model</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
			<div class="form-group col-md-4">
			 <label> Case ID:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="<?php echo $rows['case_id'] ?>" disabled></input>
			<input type="text"  name="new_case_id"  value="<?php echo $rows['id'] ?>" hidden></input>
			</div>
		</div>
        <div class="row">
			<div class="form-group col-md-4">
			 <label> Incoming Date:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="<?php echo $rows['case_date'] ?>" disabled></input>
			</div>
		</div>
        
        <div class="row">
			<div class="form-group col-md-4">
			 <label> Case Size:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="<?php echo $rows['case_size'] ?>" disabled></input>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
			 <label> State:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="<?php echo $rows['state'] ?>" disabled></input>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
			 <label> Broker:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="<?php echo $rows['broker'] ?>" disabled></input>
			</div>
			<div class="form-group col-md-2">
			<button type="button" class="btn btn-info">Contact Broker</button>	
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
			 <label> Industry:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="<?php echo $rows['industry'] ?>" disabled></input>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
			 <label> Assessment:</label>
			  </div>
			<div class="form-group col-md-5">
		  	<select required class="form-control" id="Assessment" name="assessment">
		    <option value="" selected>--Select Assessment--</option>
			<option value="DTQ">	DTQ	</option>
			<option value="More Info Required">	More Info Required</option>
			<option value="High Risk">	High Risk	</option>
			<option value="Medium Risk">	Medium Risk	</option>
			<option value="Low Risk">	Low Risk	</option>
		  </select>
		  </div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
			 <label> Status:</label>
			  </div>
			<div class="form-group col-md-5">
		  	<select required class="form-control" id="new_status" name="new_status">
		    <option value="" selected>--Select Status--</option>
			<option value="Active">	Active</option>
			<option value="Completed">	Completed	</option>
			
		  </select>
		  </div>
		</div>
        </div>
      <div class="modal-footer">
      <input type="submit" class="btn btn-success" value="Update" name="update"></input>
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
</form>
  </div>
  
</div>
<?php
        }
    ?>
       
      
      
 </tbody>
    </table>
  
   
		</div>
<div id="modaladd" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title select-option">Add Case</h4>
      </div>
      <div class="modal-body">
       <form autocomplete="off" id="score_form" name="score_form" action="year-date.php" method="POST">
				 <div class="table-container">
				 <div class="row  row-screen border-radius">
		
<div class="row">
 <div class="form-group col-md-6">
  <label >Case Size:</label>
  </div>
  <div class="form-group col-md-6">
<input type="text" class="form-control" name="case_size" required></input>
  </div>
  </div>

<div class="row">
 <div class="form-group col-md-6">
  <label >Face Amount:</label>
  </div>
  <div class="form-group col-md-6">
<input type="text" class="form-control" name="face_amount" required></input>
  </div>
  </div>

<div class="row">
 <div class="form-group col-md-6">
  <label class="">Industry:</label>
  </div>
  <div class="form-group col-md-6">
  <select required class="selectpicker form-control" id="industry" name="industry">
  <option selected value="">--Select Industry--</option>
    <option value="Agriculture,-232">	Agriculture	</option>
	<option value="Nonclassifiable,-232">	Nonclassifiable	</option>
	<option value="Membership Organizations,-191">	Membership Organizations	</option>
	<option value="Mining,-117">	Mining	</option>
	<option value="Public Administration,-60">	Public Administration	</option>
	<option value="Wholesale Trade,-56">	Wholesale Trade	</option>
	<option value="Legal Services,-31">	Legal Services	</option>
	<option value="Transportation,-29">	Transportation	</option>
	<option value="Manufacturing,-23">	Manufacturing	</option>
	<option value="Retail,-13">	Retail	</option>
	<option value="Health Services,-6">	Health Services	</option>
	<option value="Social Services,28">	Social Services	</option>
	<option value="Construction,50">	Construction	</option>
	<option value="Personal & Business Services,79">	Personal & Business Services	</option>
	<option value="Communications & Utilities,103">	Communications & Utilities	</option>
	<option value="Professional Services,105">	Professional Services	</option>
	<option value="Entertainment & Recreation,108">	Entertainment & Recreation	</option>
	<option value="Financial Services,127">	Financial Services	</option>
	<option value="Education,175">	Education	</option>

  </select>
  </div>
  </div>

<div class="row">
 <div class="form-group col-md-6">
  <label >State:</label>
  </div>
  <div class="form-group col-md-6">
  <select required class="form-control" id="state" name="state">
    <option value="" selected>--Select State--</option>
 
    <option	value="-276,DE">DE	</option>
<option	value="-265,WV">WV	</option>
<option	value="-247,MS">MS	</option>
<option	value="-230,NM">NM	</option>
<option	value="-182,AL">AL	</option>
<option	value="-148,ND">ND	</option>
<option	value="-110,UT">UT	</option>
<option	value="-105,KY">KY	</option>
<option	value="-100,TN">TN	</option>
<option	value="-96,VT">VT	</option>
<option	value="-93,NE">NE	</option>
<option	value="-85,GA">GA	</option>
<option	value="-80,MI">MI	</option>
<option	value="-77,ID">ID	</option>
<option	value="-56,WI">WI	</option>
<option	value="-55,LA">LA	</option>
<option	value="-53,OH">OH	</option>
<option	value="-52,KS">KS	</option>
<option	value="-47,IA">IA	</option>
<option	value="-45,WY">WY	</option>
<option	value="-38,IL">IL	</option>
<option	value="-32,IN">IN	</option>
<option	value="-30,TX">TX	</option>
<option	value="-27,VA">VA	</option>
<option	value="-23,SD">SD	</option>
<option	value="-16,OK">OK	</option>
<option	value="-10,AR">AR	</option>
<option	value="-4,CA">CA	</option>
<option	value="10,MT">MT	</option>
<option	value="16,AZ">AZ	</option>
<option	value="30,MA">MA	</option>
<option	value="30,DC">DC	</option>
<option	value="46,ME">ME	</option>
<option	value="51,MO">MO	</option>
<option	value="75,NC">NC	</option>
<option	value="86,PA">PA	</option>
<option	value="86,MD">MD	</option>
<option	value="89,MN">MN	</option>
<option	value="98,NJ">NJ	</option>
<option	value="109,NY">NY	</option>
<option	value="118,NV">NV	</option>
<option	value="142,SC">SC	</option>
<option	value="147,AK">AK	</option>
<option	value="151,CO">CO	</option>
<option	value="152,FL">FL	</option>
<option	value="162,NH">NH	</option>
<option	value="180,CT">CT	</option>
<option	value="227,OR">OR	</option>
<option	value="243,WA">WA	</option>
<option	value="315,RI">RI	</option>
  </select>
  </div>
  </div>
<div class="row">
 <div class="form-group col-md-6">
  <label >Seasonality:</label>
  </div>
  <div class="form-group col-md-6">
  <select required class="form-control" id="seasonality" name="seasonality">
    <option value="" selected>--Select Seasonality--</option>
	<option value="30,Jan">	Jan	</option>
	<option value="20,Feb">	Feb	</option>
	<option value="119,March">	March	</option>
	<option value="39,April">	April	</option>
	<option value="102,May">	May	</option>
	<option value="91,June">	June	</option>
	<option value="54,July">	July	</option>
	<option value="-15,Aug">	Aug	</option>
	 <option value="-171,Sep">	Sep	</option>
	<option value="-50,Oct">	Oct	</option>
	<option value="93,Nov">	Nov	</option>
	<option value="250,Dec">	Dec	</option>

  </select>
  </div>
  </div>


<div class="row">
<div class="form-group col-md-6">
 <label> Broker:</label>
  </div>
<div class="form-group col-md-6">
<select required class="form-control" id="broker" name="broker" required>
<option value="" selected>--Select Broker--</option>
<option value="-198+AUXIANT">	AUXIANT	</option>
<option value="-165+Alternative Risk Solutions">	Alternative Risk Solutions	</option>
<option value="-111+Stop Loss Insurance Services / AmWINS Group Benefits">	Stop Loss Insurance Services / AmWINS Group Benefits	</option>
<option value="-64+stHealth Benefit Solutions / Formerly Comrisk">	stHealth Benefit Solutions / Formerly Comrisk	</option>
<option value="-55+EMPLOYEE BENEFIT CONSULTANTS">	EMPLOYEE BENEFIT CONSULTANTS	</option>
<option value="-51+McGriff Seibels & Williams, Inc.">	McGriff Seibels & Williams, Inc.	</option>
<option value="-41+MERITAIN HEALTH">	MERITAIN HEALTH	</option>
<option value="-26+GROUP & PENSION ADMINISTRATORS INC">	GROUP & PENSION ADMINISTRATORS INC	</option>
<option value="-22+United Benefits, Inc. / FBMC / Brown & Brown">	United Benefits, Inc. / FBMC / Brown & Brown	</option>
<option value="-20+MUTUAL ASSURANCE ADMINISTRATORS">	MUTUAL ASSURANCE ADMINISTRATORS	</option>
<option value="-19+National Medical Excess, LLC">	National Medical Excess, LLC	</option>
<option value="-19+COMPREHENSIVE BENEFITS ADMINISTRATOR, INC/EBPA">	COMPREHENSIVE BENEFITS ADMINISTRATOR, INC/EBPA	</option>
<option value="-17+LOOMIS">	LOOMIS	</option>
<option value="-14+FIRST ADMINISTRATORS">	FIRST ADMINISTRATORS	</option>
<option value="-14+KEY FAMILY OF COMPANIES (KBA / EBS)">	KEY FAMILY OF COMPANIES (KBA / EBS)	</option>
<option value="-11+CORESOURCE">	CORESOURCE	</option>
<option value="-10+AULTRA GROUP">	AULTRA GROUP	</option>
<option value="-1+Other">	Other	</option>
<option value="2+WILLIS / HRH">	WILLIS / HRH	</option>
<option value="2+INSURANCE RISK MANAGEMENT / OLD NATIONAL">	INSURANCE RISK MANAGEMENT / OLD NATIONAL	</option>
<option value="2+RMSCO INC.">	RMSCO INC.	</option>
<option value="5+Mutual Health Services">	Mutual Health Services	</option>
<option value="8+Comrisk / BenefitMall">	Comrisk / BenefitMall	</option>
<option value="10+CCHI">	CCHI	</option>
<option value="10+AMERIHEALTH ADMINISTRATORS, INC.">	AMERIHEALTH ADMINISTRATORS, INC.	</option>
<option value="14+MEDICAL BENEFITS ADMINISTRATORS, INC.">	MEDICAL BENEFITS ADMINISTRATORS, INC.	</option>
<option value="15+INSURANCE MANAGEMENT SERVICES">	INSURANCE MANAGEMENT SERVICES	</option>
<option value="16+NCAS">	NCAS	</option>
<option value="16+HUB International">	HUB International	</option>
<option value="21+Lockton Benefits Company">	Lockton Benefits Company	</option>
<option value="25+BENEFIT ADMINISTRATIVE SYSTEMS, LTD">	BENEFIT ADMINISTRATIVE SYSTEMS, LTD	</option>
<option value="28+Cottingham & Butler, Inc.">	Cottingham & Butler, Inc.	</option>
<option value="35+Gallagher Benefit Services">	Gallagher Benefit Services	</option>
<option value="38+Hays Companies">	Hays Companies	</option>
<option value="40+Diversified Group Brokerage">	Diversified Group Brokerage	</option>
<option value="42+Acordia / Wells Fargo / Wachovia">	Acordia / Wells Fargo / Wachovia	</option>
<option value="47+UNITED HEALTHCARE / UMR / FISERV">	UNITED HEALTHCARE / UMR / FISERV	</option>
<option value="50+Kibble & Prentice">	Kibble & Prentice	</option>
<option value="52+USI Administrators">	USI Administrators	</option>
<option value="59+PREFERRED ONE ADMINISTRATIVE SERVICES">	PREFERRED ONE ADMINISTRATIVE SERVICES	</option>
<option value="59+Holmes Murphy & Associates">	Holmes Murphy & Associates	</option>
<option value="89+MERCER HEALTH & BENEFITS LLC">	MERCER HEALTH & BENEFITS LLC	</option>
<option value="96+AON Consulting / Hewitt & Associates">	AON Consulting / Hewitt & Associates	</option>
<option value="97+Health Plans Inc">	Health Plans Inc	</option>
<option value="110+CNIC HEALTH SOLUTIONS">	CNIC HEALTH SOLUTIONS	</option>
<option value="129+PLANNED ADMINISTRATORS INC">	PLANNED ADMINISTRATORS INC	</option>
<option value="135+Consolidated Benefits, Inc.">	Consolidated Benefits, Inc.	</option>
<option value="141+Alliant Insurance Services">	Alliant Insurance Services	</option>
<option value="625+Towers Perrin / Watson Wyatt">	Towers Perrin / Watson Wyatt	</option>

  </select>
  </div>
  </div>

</div>
</div>
</div>
      <div class="modal-footer">
       <div class="text-center">
<!--<input type = "submit" class = "btn btn-success select-option" value="Submit"></input>
<input type = "reset" id="reset-button" onclick="reset_div()" class = "btn btn-info select-option" value="Reset"></input>-->
<input type = "submit" class = "btn btn-success" value="Submit" name="submit">
<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
</div>

       
</form>

      
      </div>
    </div>

  </div>

</div>
<div id="casemodal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Case Model</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
			<div class="form-group col-md-4">
			 <label> Case ID:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="" disabled></input>
			</div>
		</div>
        <div class="row">
			<div class="form-group col-md-4">
			 <label> Incoming Date:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="" disabled></input>
			</div>
		</div>
        
        <div class="row">
			<div class="form-group col-md-4">
			 <label> Case Size:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="" disabled></input>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
			 <label> State:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="" disabled></input>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
			 <label> Broker:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="" disabled></input>
			</div>
			<div class="form-group col-md-2">
			<button type="button" class="btn btn-info">Contact Broker</button>	
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
			 <label> Industry:</label>
			  </div>
			<div class="form-group col-md-5">
			<input type="text" class="form-control" value="" disabled></input>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-4">
			 <label> Assessment:</label>
			  </div>
			<div class="form-group col-md-5">
		  	<select required class="form-control" id="Assessment">
		    <option value="" selected>--Select Assessment--</option>
			<option value="DTQ">	DTQ	</option>
			<option value="More Info Required">	More Info Required</option>
			<option value="High Risk">	High Risk	</option>
			<option value="Medium Risk">	Medium Risk	</option>
			<option value="Low Risk">	Low Risk	</option>
		  </select>
		  </div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
			 <label> Status:</label>
			  </div>
			<div class="form-group col-md-5">
		  	<select required class="form-control" id="Assessment">
		    <option value="" selected>--Select Status--</option>
			<option value="Active">	Active</option>
			<option value="Completed">	Completed	</option>
			
		  </select>
		  </div>
		</div>
        </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" >Submit</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
  
</div>
</div>



<div role="tabpanel" class="tab-pane" id="sales-track">
<div class="row row-screen">
		<div class="clearfix date-track">
			<h2 class="title-income date1">Case Tracker</h2>
			<h4 class="title-income date2"><div class="todaydate"></div></h4>
		</div>
			<hr class="hr-line"/>
		</div>

	<div class="row row-screen whiteboard" id="navigation">
		<div class="" >
			<div class="pull-right date-time dropdown "><a  href="" class="dropdown-toggle" id="menu1" data-toggle="dropdown">Year To Date View <i class="fa fa-caret-down" aria-hidden="true" ></i></a>

			<ul class="dropdown-menu " role="menu" aria-labelledby="menu1">
		      <li role="presentation"><a role="menuitem" tabindex="-1" href="month-date.php#sales-track">Month To Date</a></li>
		      <li role="presentation"><a role="menuitem" tabindex="-1" href="quarterdate.php#sales-track">Quarter To Date</a></li>
		      <li role="presentation"><a role="menuitem" tabindex="-1" href="lastfullmonth.php#sales-track">Last Full Month</a></li>
		   
		      <li role="presentation"><a role="menuitem" tabindex="-1" href="lastfullquarter.php#sales-track">Last Full Quarter
			</a></li>
		    </ul>
		    <h3 style="margin-top:0px;"><small>Jan 1, 2017 - May 9, 2017</small></h3>
			</div>
		</div>
	</div>
	<br>
	<div class="row row-screen">
		<div class=" ">
		<div class="table-container">
		<div class="table-inner1">
			<table class="table marB15">
				<thead>
					<tr>
						<th class="text-center">Year To Date</th>
						<th class="text-center">Vs. Plan</th>
						<th class="text-center">Vs. Last Year</th>
					</tr>
				</thead>
				<tbody>
							<h3 class="text-center" style="font-weight: bold;">Overview</h3>

					<tr>
						<td class="btn-group-sale "  width="45%">
						<div class="gross-year padT10"># of Cases Quoted</div><button class="btn ">3,675</button>
						
						</td>
						<td class="">
							<div class="btn-handle">
							<button class="btn btn-sales-down btn-block retative">3,510<i class="fa fa-arrow-up" aria-hidden="true"></i><span>5%</span></button>
							</div>

						</td>
						<td class="">
						<div class="btn-handle">
							<button class="btn btn-sales-down1 btn-block retative">3,308 <i class="fa fa-arrow-up" aria-hidden="true"></i><span>11%</span></button>
						</div>
						</td>
					</tr>
					<tr>
						<td class="btn-group-sale "  width="45%">
						
						<div class="gross-year padT10">Face Amount of Cases Quoted ($M)</div><button class="btn ">$2,034</button>
						
						</td>
						<td class="">
						<div class="btn-handle">
							<button class="btn btn-sales-down btn-block retative">$1,762<i class="fa fa-arrow-up" aria-hidden="true"></i><span>15%</span></button>
							</div>
						</td>
						<td class="">
							<div class="btn-handle">
							<button class="btn btn-sales-down1 btn-block retative">$1,612<i class="fa fa-arrow-up" aria-hidden="true"></i><span>26%</span></button>
							</div>
						</td>
					</tr>

					<tr>
						<td class="btn-group-sale "  width="45%">
						
						<div class="gross-year padT10">Quote Ratio </div><button class="btn ">43%</button>
						
						</td>
						<td class="">
						<div class="btn-handle">
							<button class="btn btn-sales-down btn-block retative">40%<i class="fa fa-arrow-up" aria-hidden="true"></i><span>7%</span></button>
							</div>
						</td>
						<td class="">
						<div class="btn-handle">
							<button class="btn btn-sales-down1 btn-block retative">38%<i class="fa fa-arrow-up" aria-hidden="true"></i><span>13%</span></button>
							</div>
						</td>
					</tr>
					
				</tbody>
			</table></div>
</div>
</div>

				<div class="row row-screen">

						<h3 class="text-center title-dg">Historical Trend</h3>

			<div class="table-container">

			<div class="row row-screen table-inner1" >
			<h4 class="text-center" style="font-weight: bold;"># of Quoted Cases</h4>
			<div class="retative">
			<div class="dot-hide"></div>		
			<div id="yeartodate" style="width: 50% ;margin-bottom: 30px;"></div>
			</div>
			<div style="float:right;" >
			<div class="row">
				<div class="foo blue"> </div>
				<div class="" style="font-weight: bold;">
				Pre Implementation  </div>
		  	</div>
			<div class="row">
			  <div class="foo darkblue"> </div>
			  <div class="" style="font-weight: bold;">
				Post Implementation  </div>
			  </div>
		 	</div>
			
			<h4 class="text-center" style="font-weight: bold;">Face Amount of Quoted Cases ($M)</h4>
			<div class="retative">
			<div class="dot-hide"></div>
			<div id="yeartodate1" style="width: 50% ;margin-bottom: 30px;"></div>
			</div>
			</div>
			</div>
			</div>
		</div>
	
	
	
	<div class="row row-screen">
	<h3 class="text-center title-dg">Cases By Broker</h3>
		<div class=" ">
		<div class="table-container1">
		<div class="table-inner">
			<table class="table marB15" border="1">
				<thead>
					<tr>
						
						<th >Broker</th>
						<th class="text-center">Quote FA ($)</th>
						<th class="text-center">Quote FA Mix %</th>
						<th class="text-center">Total Prospects</th>
						<th class="text-center"># Of Quoted Cases </th>
						<th class="text-center">Quote Ratio</th>
						<th class="text-center">Avg. FA per Quote</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<td >	Mercer Health & Benefits Llc	</td>
					<td class="text-center">	$9,15,55,734	</td>
					<td class="text-center">	4.5%	</td>
					<td class="text-center">	354	</td>
					<td class="text-center">	163	</td>
					<td class="text-center">	46%	</td>
					<td class="text-center">	$5,61,649	</td>	</tr>
					<tr>
					<td >	Willis / HRH	</td>
					<td class="text-center">	$7,62,96,445	</td>
					<td class="text-center">	3.8%	</td>
					<td class="text-center">	295	</td>
					<td class="text-center">	142	</td>
					<td class="text-center">	48%	</td>
					<td class="text-center">	$5,38,247	</td>	</tr>
					<tr>
					<td >	Hays Companies	</td>
					<td class="text-center">	$6,71,40,872	</td>
					<td class="text-center">	3.3%	</td>
					<td class="text-center">	260	</td>
					<td class="text-center">	117	</td>
					<td class="text-center">	45%	</td>
					<td class="text-center">	$5,74,130	</td>	</tr>
					<tr>
					<td >	Gallagher Benefit Services	</td>
					<td class="text-center">	$6,10,37,156	</td>
					<td class="text-center">	3.0%	</td>
					<td class="text-center">	236	</td>
					<td class="text-center">	104	</td>
					<td class="text-center">	44%	</td>
					<td class="text-center">	$5,87,178	</td>	</tr>
					<tr>
					<td >	Consolidated Benefits, Inc.	</td>
					<td class="text-center">	$6,10,37,156	</td>
					<td class="text-center">	3.0%	</td>
					<td class="text-center">	236	</td>
					<td class="text-center">	102	</td>
					<td class="text-center">	43%	</td>
					<td class="text-center">	$6,00,833	</td>	</tr>
					<tr>
					<td >	Acordia / Wells Fargo / Wachovia	</td>
					<td class="text-center">	$5,79,85,298	</td>
					<td class="text-center">	2.9%	</td>
					<td class="text-center">	224	</td>
					<td class="text-center">	101	</td>
					<td class="text-center">	45%	</td>
					<td class="text-center">	$5,74,130	</td>	</tr>
					<tr>
					<td >	Health Plans Inc	</td>
					<td class="text-center">	$5,34,07,512	</td>
					<td class="text-center">	2.6%	</td>
					<td class="text-center">	207	</td>
					<td class="text-center">	95	</td>
					<td class="text-center">	46%	</td>
					<td class="text-center">	$5,61,649	</td>	</tr>
					<tr>
					<td >	Coresource	</td>
					<td class="text-center">	$4,88,29,725	</td>
					<td class="text-center">	2.4%	</td>
					<td class="text-center">	189	</td>
					<td class="text-center">	79	</td>
					<td class="text-center">	42%	</td>
					<td class="text-center">	$6,15,139	</td>	</tr>
					<tr>
					<td >	Insurance Management Services	</td>
					<td class="text-center">	$4,57,77,867	</td>
					<td class="text-center">	2.3%	</td>
					<td class="text-center">	177	</td>
					<td class="text-center">	78	</td>
					<td class="text-center">	44%	</td>
					<td class="text-center">	$5,87,178	</td>	</tr>
					<tr>
					<td >	Holmes Murphy & Associates	</td>
					<td class="text-center">	$4,47,60,581	</td>
					<td class="text-center">	2.2%	</td>
					<td class="text-center">	173	</td>
					<td class="text-center">	78	</td>
					<td class="text-center">	45%	</td>
					<td class="text-center">	$5,74,130	</td>	</tr>

				</tbody>
			</table>
			</div>
			<button class="btn btn-sm" style="color:#fff;background: gray;">View Other Brokers</button>
			</div>
		</div>
	</div>

	<div class="row row-screen">
	<h3 class="text-center title-dg">Case Characteristics</h3>
		<div class=" ">
		<div class="table-container1">
		<div class="row retative">
		<div class="bg-white"></div>
			<div id='piechart' ></div>
			
		</div>
		<div class="row retative">
		<div class="bg-white"></div>
			<div id='piechart1'></div>
			
		</div>	
		</div>
		</div>
		</div>


	<div class="row row-screen">
	<h3 class="text-center title-dg">Cases By Geography</h3>
		<div class=" ">
		<div class="table-container1">
		<div class="table-inner">
			<table class=" table marB15" border="1">
				<thead>
					<tr>
						<th >State</th>
						<th class="text-center">Quote FA ($)</th>
						<th class="text-center">Quote FA Mix %</th>
						<th class="text-center">Total Prospects</th>
						<th class="text-center"># of Quoted Cases</th>
						<th class="text-center">Quote Ratio</th>
						<th class="text-center">Avg. FA per Quote</th>
					</tr>
				</thead>
				<tbody>
					<tr>	
					<td >	MA	</td>	
					<td class="text-center">	$18,31,11,469	</td>	
					<td class="text-center">	9%	</td>	
					<td class="text-center">	709	</td>	
					<td class="text-center">	333	</td>	
					<td class="text-center">	47%	</td>	
					<td class="text-center">	$5,49,699	</td>
					</tr>
					<tr>	
					<td >	CA	</td>	
					<td class="text-center">	$15,25,92,891	</td>	
					<td class="text-center">	8%	</td>	
					<td class="text-center">	591	</td>	
					<td class="text-center">	272	</td>	
					<td class="text-center">	46%	</td>	
					<td class="text-center">	$5,61,649	</td>
					</tr>
					<tr>	
					<td >	PA	</td>	
					<td class="text-center">	$13,42,81,744	</td>	
					<td class="text-center">	7%	</td>	
					<td class="text-center">	520	</td>	
					<td class="text-center">	223	</td>	
					<td class="text-center">	43%	</td>	
					<td class="text-center">	$6,00,833	</td>
					</tr>
					<tr>	
					<td >	TX	</td>	
					<td class="text-center">	$12,20,74,313	</td>	
					<td class="text-center">	6%	</td>	
					<td class="text-center">	473	</td>	
					<td class="text-center">	213	</td>	
					<td class="text-center">	45%	</td>	
					<td class="text-center">	$5,74,130	</td>
					</tr>
					<tr>	
					<td >	ME	</td>	
					<td class="text-center">	$12,20,74,313	</td>	
					<td class="text-center">	6%	</td>	
					<td class="text-center">	473	</td>	
					<td class="text-center">	222	</td>	
					<td class="text-center">	47%	</td>	
					<td class="text-center">	$5,49,699	</td>
					</tr>
					<tr>	
					<td >	AR	</td>	
					<td class="text-center">	$11,59,70,597	</td>	
					<td class="text-center">	6%	</td>	
					<td class="text-center">	449	</td>	
					<td class="text-center">	193	</td>	
					<td class="text-center">	43%	</td>	
					<td class="text-center">	$6,00,833	</td>
					</tr>
					<tr>	
					<td >	NY	</td>	
					<td class="text-center">	$10,68,15,023	</td>	
					<td class="text-center">	5%	</td>	
					<td class="text-center">	413	</td>	
					<td class="text-center">	203	</td>	
					<td class="text-center">	49%	</td>	
					<td class="text-center">	$5,27,262	</td>
					</tr>
					<tr>	
					<td >	IN	</td>	
					<td class="text-center">	$9,76,59,450	</td>	
					<td class="text-center">	5%	</td>	
					<td class="text-center">	378	</td>	
					<td class="text-center">	159	</td>	
					<td class="text-center">	42%	</td>	
					<td class="text-center">	$6,15,139	</td>
					</tr>
					<tr>	
					<td >	GA	</td>	
					<td class="text-center">	$9,15,55,734	</td>	
					<td class="text-center">	5%	</td>	
					<td class="text-center">	354	</td>	
					<td class="text-center">	142	</td>	
					<td class="text-center">	40%	</td>	
					<td class="text-center">	$6,45,896	</td>
					</tr>
					<tr>	
					<td >	MI	</td>	
					<td class="text-center">	$8,95,21,163	</td>	
					<td class="text-center">	4%	</td>	
					<td class="text-center">	347	</td>	
					<td class="text-center">	142	</td>	
					<td class="text-center">	41%	</td>	
					<td class="text-center">	$6,30,142	</td>
					</tr>

				</tbody>
			</table>
			</div>
		<button class="btn btn-sm" style="color:#fff;background: gray;">View Other States</button>
		
		</div>
		</div>
		
		</div>
		
		<div class="row row-screen">
	<h3 class="text-center title-dg">Cases By Top Sectors</h3>
		<div class=" ">
		<div class="table-container1">
		<div class="table-inner">
			<table class=" table marB15" border="1">
				<thead>
					<tr>
						<th >Industry/Sector</th>
						<th class="text-center">Quote FA ($)</th>
						<th class="text-center">Quote FA Mix %</th>
						<th class="text-center">Total Prospects</th>
						<th class="text-center"># of Quoted Cases</th>
						<th class="text-center">Quote Ratio</th>
						<th class="text-center">Avg. FA per Quote</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<td >	Manufacturing	</td>
					<td class="text-center">	$25,63,56,056	</td>
					<td class="text-center">	13%	</td>
					<td class="text-center">	992	</td>
					<td class="text-center">	427	</td>
					<td class="text-center">	43%	</td>
					<td class="text-center">	$6,00,833	</td>	</tr>
					<tr>
					<td >	Construction	</td>
					<td class="text-center">	$21,36,30,047	</td>
					<td class="text-center">	11%	</td>
					<td class="text-center">	827	</td>
					<td class="text-center">	339	</td>
					<td class="text-center">	41%	</td>
					<td class="text-center">	$6,30,142	</td>	</tr>
					<tr>
					<td >	Health Services	</td>
					<td class="text-center">	$18,79,94,441	</td>
					<td class="text-center">	9%	</td>
					<td class="text-center">	728	</td>
					<td class="text-center">	327	</td>
					<td class="text-center">	45%	</td>
					<td class="text-center">	$5,74,130	</td>	</tr>
					<tr>
					<td >	Professional Services	</td>
					<td class="text-center">	$17,09,04,038	</td>
					<td class="text-center">	8%	</td>
					<td class="text-center">	662	</td>
					<td class="text-center">	311	</td>
					<td class="text-center">	47%	</td>
					<td class="text-center">	$5,49,699	</td>	</tr>
					<tr>
					<td >	Entertainment & Recreation	</td>
					<td class="text-center">	$17,09,04,038	</td>
					<td class="text-center">	8%	</td>
					<td class="text-center">	662	</td>
					<td class="text-center">	318	</td>
					<td class="text-center">	48%	</td>
					<td class="text-center">	$5,38,247	</td>	</tr>
					<tr>
					<td >	Public Administration	</td>
					<td class="text-center">	$16,23,58,836	</td>
					<td class="text-center">	8%	</td>
					<td class="text-center">	628	</td>
					<td class="text-center">	295	</td>
					<td class="text-center">	47%	</td>
					<td class="text-center">	$5,49,699	</td>	</tr>
					<tr>
					<td >	Wholesale Trade	</td>
					<td class="text-center">	$14,95,41,033	</td>
					<td class="text-center">	7%	</td>
					<td class="text-center">	579	</td>
					<td class="text-center">	260	</td>
					<td class="text-center">	45%	</td>
					<td class="text-center">	$5,74,130	</td>	</tr>
					<tr>
					<td >	Membership Organizations	</td>
					<td class="text-center">	$13,67,23,230	</td>
					<td class="text-center">	7%	</td>
					<td class="text-center">	529	</td>
					<td class="text-center">	249	</td>
					<td class="text-center">	47%	</td>
					<td class="text-center">	$5,49,699	</td>	</tr>
					<tr>
					<td >	Transportation	</td>
					<td class="text-center">	$12,81,78,028	</td>
					<td class="text-center">	6%	</td>
					<td class="text-center">	496	</td>
					<td class="text-center">	208	</td>
					<td class="text-center">	42%	</td>
					<td class="text-center">	$6,15,139	</td>	</tr>
					<tr>
					<td >	Retail	</td>
					<td class="text-center">	$12,61,43,456	</td>
					<td class="text-center">	6%	</td>
					<td class="text-center">	488	</td>
					<td class="text-center">	208	</td>
					<td class="text-center">	43%	</td>
					<td class="text-center">	$6,07,902	</td>	</tr>

				</tbody>
			</table>
			</div>
		<button class="btn btn-sm" style="color:#fff;background: gray;">View Other Sectors</button>
		
		</div>
		</div>
		
		</div>

		<div class="row row-screen">
	<h3 class="text-center title-dg">Selling Ratio vs. Quoting Ratio By Top Brokers</h3>
		<div class="image-set">
	<img src="images/Top Broker Bubble SR QR.png" class="width-fluid">
		</div>
		</div>

		<div class="row row-screen">
	<h3 class="text-center title-dg">Selling Ratio vs. Quoting Ratio By States</h3>
		<div class="image-set">
	<img src="images/States SR QR.png" class="width-fluid">
		</div>
		</div>


</div>




<div role="tabpanel" class="tab-pane" id="score-calculator">
		 <div class="row row-screen">

			<div class="clearfix date-track">
			<h2 class="title-income date1">Score Calculator</h2>
			<h4 class="title-income date2"><div class="todaydate"></div></h4>
		</div>
			<hr class="hr-line"/>
		</div>


		<form id="score_calculator" name="score_calculator">
				 <div class="table-container">
				 <div class="row row-screen">
				 <label class="tab-title date1">Case Characteristics</label>
				 </div>
				 <br>
		<div class="row row-screen border-radius">
		
		<div class="row select-option">

 <div class="form-group col-md-4">
  <label >Case Size Bucket:</label>
  </div>
  <div class="form-group col-md-6">
  <select required class="selectpicker form-control" id="cal_case-size">
  <option value="" selected>--Select Case Size--</option>
  <option value="-2">U100</option>
    <option value="-23">100-199</option>
    <option value="-16">200-499</option>
    <option value="-4">500-999</option>
    <option value="32">1000-2999</option>
    <option value="334">3000+</option>
  </select>
  </div>
  </div>




<div class="row select-option">
 <div class="form-group col-md-4">
  <label class="">Industry:</label>
  </div>
  <div class="form-group col-md-6">
  <select required class="selectpicker form-control" id="cal_industry">
  <option selected value="">--Select Industry--</option>
    <option value="-232">	Agriculture	</option>
	<option value="-232">	Nonclassifiable	</option>
	<option value="-191">	Membership Organizations	</option>
	<option value="-117">	Mining	</option>
	<option value="-60">	Public Administration	</option>
	<option value="-56">	Wholesale Trade	</option>
	<option value="-31">	Legal Services	</option>
	<option value="-29">	Transportation	</option>
	<option value="-23">	Manufacturing	</option>
	<option value="-13">	Retail	</option>
	<option value="-6">	Health Services	</option>
	<option value="28">	Social Services	</option>
	<option value="50">	Construction	</option>
	<option value="79">	Personal & Business Services	</option>
	<option value="103">	Communications & Utilities	</option>
	<option value="105">	Professional Services	</option>
	<option value="108">	Entertainment & Recreation	</option>
	<option value="127">	Financial Services	</option>
	<option value="175">	Education	</option>

  </select>
  </div>
  </div>

<div class="row select-option">
 <div class="form-group col-md-4">
  <label >State:</label>
  </div>
  <div class="form-group col-md-6">
  <select required class="form-control" id="cal_state">
    <option value="" selected>--Select State--</option>
 
    <option value="-276">	DE	</option>
	<option value="-265">	WV	</option>
	<option value="-247">	MS	</option>
	<option value="-230">	NM	</option>
	<option value="-182">	AL	</option>
	<option value="-148">	ND	</option>
	<option value="-110">	UT	</option>
	<option value="-105">	KY	</option>
	<option value="-100">	TN	</option>
	<option value="-96">	VT	</option>
	<option value="-93">	NE	</option>
	<option value="-85">	GA	</option>
	<option value="-80">	MI	</option>
	<option value="-77">	ID	</option>
	<option value="-56">	WI	</option>
	<option value="-55">	LA	</option>
	<option value="-53">	OH	</option>
	<option value="-52">	KS	</option>
	<option value="-47">	IA	</option>
	<option value="-45">	WY	</option>
	<option value="-38">	IL	</option>
	<option value="-32">	IN	</option>
	<option value="-30">	TX	</option>
	<option value="-27">	VA	</option>
	<option value="-23">	SD	</option>
	<option value="-16">	OK	</option>
	<option value="-10">	AR	</option>
	<option value="-4">	CA	</option>
	<option value="10">	MT	</option>
	<option value="16">	AZ	</option>
	<option value="30">	MA	</option>
	<option value="30">	DC	</option>
	<option value="46">	ME	</option>
	<option value="51">	MO	</option>
	<option value="75">	NC	</option>
	<option value="86">	PA	</option>
	<option value="86">	MD	</option>
	<option value="89">	MN	</option>
	<option value="98">	NJ	</option>
	<option value="109">	NY	</option>
	<option value="118">	NV	</option>
	<option value="142">	SC	</option>
	<option value="147">	AK	</option>
	<option value="151">	CO	</option>
	<option value="152">	FL	</option>
	<option value="162">	NH	</option>
	<option value="180">	CT	</option>
	<option value="227">	OR	</option>
	<option value="243">	WA	</option>
	<option value="315">	RI	</option>
  </select>
  </div>
  </div>
<div class="row select-option">
 <div class="form-group col-md-4">
  <label >Seasonality:</label>
  </div>
  <div class="form-group col-md-6">
  <select required class="form-control" id="cal_seasonality">
      <option value="" selected>--Select Seasonality--</option>
	<option value="30">	Jan	</option>
	<option value="20">	Feb	</option>
	<option value="119">	March	</option>
	<option value="39">	April	</option>
	<option value="102">	May	</option>
	<option value="91">	June	</option>
	<option value="54">	July	</option>
	<option value="-15">	Aug	</option>
	 <option value="-171">	Sep	</option>
	<option value="-50">	Oct	</option>
	<option value="93">	Nov	</option>
	<option value="250">	Dec	</option>

  </select>
  </div>
  </div>


<div class="row select-option">
 <div class="form-group col-md-4">
  <label> Broker:</label>

  </div>
  <div class="form-group col-md-6">
  <select required class="form-control" id="cal_broker" required>
    <option value="" selected>--Select Broker--</option>
  <option value="-198">	AUXIANT	</option>
<option value="-165">	Alternative Risk Solutions	</option>
<option value="-111">	Stop Loss Insurance Services / AmWINS Group Benefits	</option>
<option value="-64">	stHealth Benefit Solutions / Formerly Comrisk	</option>
<option value="-55">	EMPLOYEE BENEFIT CONSULTANTS	</option>
<option value="-51">	McGriff Seibels & Williams, Inc.	</option>
<option value="-41">	MERITAIN HEALTH	</option>
<option value="-26">	GROUP & PENSION ADMINISTRATORS INC	</option>
<option value="-22">	United Benefits, Inc. / FBMC / Brown & Brown	</option>
<option value="-20">	MUTUAL ASSURANCE ADMINISTRATORS	</option>
<option value="-19">	National Medical Excess, LLC	</option>
<option value="-19">	COMPREHENSIVE BENEFITS ADMINISTRATOR, INC/EBPA	</option>
<option value="-17">	LOOMIS	</option>
<option value="-14">	FIRST ADMINISTRATORS	</option>
<option value="-14">	KEY FAMILY OF COMPANIES (KBA / EBS)	</option>
<option value="-11">	CORESOURCE	</option>
<option value="-10">	AULTRA GROUP	</option>
<option value="-1">	Other	</option>
<option value="2">	WILLIS / HRH	</option>
<option value="2">	INSURANCE RISK MANAGEMENT / OLD NATIONAL	</option>
<option value="2">	RMSCO INC.	</option>
<option value="5">	Mutual Health Services	</option>
<option value="8">	Comrisk / BenefitMall	</option>
<option value="10">	CCHI	</option>
<option value="10">	AMERIHEALTH ADMINISTRATORS, INC.	</option>
<option value="14">	MEDICAL BENEFITS ADMINISTRATORS, INC.	</option>
<option value="15">	INSURANCE MANAGEMENT SERVICES	</option>
<option value="16">	NCAS	</option>
<option value="16">	HUB International	</option>
<option value="21">	Lockton Benefits Company	</option>
<option value="25">	BENEFIT ADMINISTRATIVE SYSTEMS, LTD	</option>
<option value="28">	Cottingham & Butler, Inc.	</option>
<option value="35">	Gallagher Benefit Services	</option>
<option value="38">	Hays Companies	</option>
<option value="40">	Diversified Group Brokerage	</option>
<option value="42">	Acordia / Wells Fargo / Wachovia	</option>
<option value="47">	UNITED HEALTHCARE / UMR / FISERV	</option>
<option value="50">	Kibble & Prentice	</option>
<option value="52">	USI Administrators	</option>
<option value="59">	PREFERRED ONE ADMINISTRATIVE SERVICES	</option>
<option value="59">	Holmes Murphy & Associates	</option>
<option value="89">	MERCER HEALTH & BENEFITS LLC	</option>
<option value="96">	AON Consulting / Hewitt & Associates	</option>
<option value="97">	Health Plans Inc	</option>
<option value="110">	CNIC HEALTH SOLUTIONS	</option>
<option value="129">	PLANNED ADMINISTRATORS INC	</option>
<option value="135">	Consolidated Benefits, Inc.	</option>
<option value="141">	Alliant Insurance Services	</option>
<option value="625">	Towers Perrin / Watson Wyatt	</option>

  </select>
  </div>
  </div>

</div>
</div>
 <div class="text-center">
<input type = "button" class = "btn btn-success select-option" onclick="calculator()" value="Submit"></input>
<input type = "reset" id="reset-button" onclick="reset_div()" class = "btn btn-info select-option" value="Reset"></input>

</div>
<br>
</form>


<br>
 <div class="row row-screen" style="display: none;" id="score-output-div">
<div class="row row-screen select-option">
 <div class="score_div  panel panel-info">
  <div class="text-center panel-heading"><label >SCORE</label></div>
  
  
  <div class="score_div text-center panel-body" id="score-output-value">
  </div>
  </div>
  </div>
      </div>      
</div>




<div role="tabpanel" class="tab-pane" id="scorecard-engine">
<div class="clearfix date-track">
			<h2 class="title-income date1">Scorecard Engine</h2>
			<h4 class="title-income date2"><div class="todaydate"></div></h4>
		</div>
		<hr class="hr-line"/>
<h3 class="text-center title-dg">Overall Methodology</h3>
<div class="image-set">
	<img src="images/QPS Methodology Slide.png" class="width-fluid">
</div>

<h3 class="text-center title-dg">Variables Considered</h3>
<div class="btn-set">

  <a class="btn btn-green">Broker</a>
 <a class="btn btn-green">State</a>
  <a class="btn btn-green">Urban/Rural</a>
  <a class="btn btn-default">TTM Broker Prospects</a>
  <a class="btn btn-default">Rep Experience Cohort</a>
  <a class="btn btn-default">Product</a>
  <a class="btn btn-green">Case Size</a>
  <a class="btn btn-default">Zip Code</a>
   <a class="btn btn-green"># of Lives</a>
  <a class="btn btn-default">Broker Previous Prospect Gestation Period</a>
  <a class="btn btn-default">Broker Discounting</a>
  <a class="btn btn-green">Seasonality</a>
  <a class="btn btn-green">FO Presence</a>
  <a class="btn btn-default">TTM Broker QR</a>
  <a class="btn btn-default">TTM Broker Profitability</a>
  <a class="btn btn-default">Rep Discounting</a>
  <a class="btn btn-green">Industry</a>
   <a class="btn btn-green">Market Type (BUCA vs. TPA)</a>
   <a class="btn btn-default">TTM Broker FA</a>
  <a class="btn btn-default">Industry Profitability</a>
  <a class="btn btn-default">BUCA %</a>
  <a class="btn btn-green">Sub-industry</a>
  <a class="btn btn-green">Rep</a>
   <a class="btn btn-default">TTM Broker SR</a>
    <a class="btn btn-default">Region/State Profitability</a>
    <a class="btn btn-default">Self Insured vs. Fully Insured</a>
       <a class="btn btn-default">TTM Broker Sold Cases</a>

   
</div>
<h3 class="text-center title-dg">Attribute Ranking By Variables</h3>
<div class="image-set">
	<img src="images/Attribute Scoring pic.png" class="width-fluid">
</div>
<h3 class="text-center title-dg">Cross Attribute Ranking</h3>
<div class="image-set">
	<img src="images/Attribute Ranking Pic.png" class="width-fluid">
</div>

<h3 class="text-center title-dg">Attribute Score By Influencing Variables</h3>
<div class="image-set">
	<img src="images/Attribute Scores.png" class="width-fluid">
</div>


</div>


<div role="tabpanel" class="tab-pane" id="return-track"> 
<div class="row row-screen">
		<div class="clearfix date-track">
			<h2 class="title-income date1">Productivity Tracker by Role</h2>
			<h4 class="title-income date2"><div class="todaydate"></div></h4>
		</div>
			<hr class="hr-line"/>
		</div>
	<div class="row row-screen">
	<h3 class="text-center" style="font-weight: bold;">Access Restricted</h3>
</div>
</div>

<div role="tabpanel" class="tab-pane" id="customer-dashboard">
<div class="row row-screen">
		<div class="clearfix date-track">
			<h2 class="title-income date1">Sales Projection</h2>
			<h4 class="title-income date2"><div class="todaydate"></div></h4>
		</div>
			<hr class="hr-line"/>
		</div>
	<div class="row row-screen">
<div class="image-set">
	<img src="images/QPS Sales Projection.png" class="width-fluid">
</div>
</div>
</div>

<div role="tabpanel" class="tab-pane" id="variance-diagnostics">
	<div class="row row-screen">
		<div class="clearfix date-track">
			<h2 class="title-income date1">Scenario Planning</h2>
			<h4 class="title-income date2"><div class="todaydate"></div></h4>
		</div>
			<hr class="hr-line"/>
		</div>
	<div class="row row-screen">
	<h3 class="text-center" style="font-weight: bold;">Access Restricted</h3>
</div>
</div>
</div>
</div>
</div>
</div>


	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>

<script src="js/highcharts.js"></script>

<script src="js/exporting.js"></script>
<script type="text/javascript" src="js/zingchart.min.js"></script>
<script type="text/javascript" src="js/zingchart-pie.min.js"></script>
<script type="text/javascript" src="js/pie.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
function calculator() {
    var case_size = document.getElementById("cal_case-size");
    var case_size_score = Number(case_size.options[case_size.selectedIndex].value);
    var industry = document.getElementById("cal_industry");
    var industry_score = Number(industry.options[industry.selectedIndex].value);
    var states = document.getElementById("cal_state");
    var state_score = Number(states.options[states.selectedIndex].value);
    var seasonality = document.getElementById("cal_seasonality");
    var seasonality_score = Number(seasonality.options[seasonality.selectedIndex].value);
    var broker = document.getElementById("cal_broker");
    var broker_score =Number(broker.options[broker.selectedIndex].value);
    var total_score = case_size_score+industry_score+state_score+seasonality_score+broker_score
      $("#score-output-value").html(total_score);   
    $("#score-output-div").show();

}


function reset_div() {
    $('#score-output-div').hide();
}

$(document).ready(function() {
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
} 
if(mm<10){
    mm='0'+mm;
} 
var text = "Date: "
var today = yyyy+'-'+mm+'-'+dd;
document.getElementsByClassName("todaydate")[0].innerHTML = text+today; 
document.getElementsByClassName("todaydate")[1].innerHTML = text+today; 
document.getElementsByClassName("todaydate")[2].innerHTML = text+today; 
document.getElementsByClassName("todaydate")[3].innerHTML = text+today;  
document.getElementsByClassName("todaydate")[4].innerHTML = text+today; 
document.getElementsByClassName("todaydate")[5].innerHTML = text+today; 
document.getElementsByClassName("todaydate")[6].innerHTML = text+today; 


});


		</script> 

</body>
</html>