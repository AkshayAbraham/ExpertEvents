<!---contact-us.php : Contact details of expert events--->
<?php
session_start();
if (isset($_SESSION["user_id"])) {
    //If session variable contains user_id then home_header.html will execute for header part otherwise header.html will execute
    if($_SESSION["role"] == 1){
        include "includes/home_header.html";
    }else{
        include "includes/user_home_header.html";
    }   
} else {
    include "includes/header.html";
}
?>
<img src="img/contactus.png" alt="Unable to load" class="contactUsMainImg">
<div class="row" style="display:inline-block;">
	<div class="column contactUsColumn">
		<div class="card cardFont">
			<img src="img/home.png" alt="Unable to load" class="contactUsImg">
			<p class="contactUsPara"><b>VISIT US</b></p>
			<p class="contactUsPara1">Address Edward Street S3 7GE UK</p>
		</div>
	</div>
	<div class="column contactUsColumn">
		<div class="card cardFont">
			<img src="img/phone-call.png" alt="Unable to load" class="contactUsImg">
			<p class="contactUsPara"><b>CALL US</b></p>
			<p class="contactUsPara1">+44 1234567891</p>
		</div>
	</div>
	<div class="column contactUsColumn">
		<div class="card cardFont">
			<img src="img/email.png" alt="Unable to load" class="contactUsImg">
			<p class="contactUsPara"><b>EMAIL US</b></p>
			<p class="contactUsPara1">info@expertevents.uk.co</p>
		</div>	
	</div>	
</div>

<?php include "includes/footer.html";
?>
