
<?php
session_start();
$errors = array();
include_once("includes/config.php");
if(isset($_POST['Submit'])){
	$username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (count($errors) == 0) {
  	//$password = md5($password);
  	$query = "SELECT * FROM admin_table WHERE username='$username' AND pwd='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: panel.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
		$message="Wrong username/password combination";
		echo"<script type='text/javascript'>alert('$message');</script>";
  	}
  }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Admin | RegenX</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--main CSS-->
    <link rel="stylesheet" href="css/main.css">
    <!--Font Awesome-->
    <script src="js/all.js"></script>
    <!-- Website Icon -->
    <link rel="shortcut icon" href="img/icon.ico">
    <!-- Map Api -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!--Preloader-->
<div class="preloader d-flex justify-content-center align-items-center">
    <img src="img/loading.gif" alt="LOADING!">
</div>
<!--End Preloader-->
<div class="default-header">
    <!--nav element-->
    <nav class="navbar navbar-expand-lg p-3" id="navBar">
    <a href="index.html">
        <img class src="img/wregenx.png" height="50" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle='collapse' data-target='#myNav'>
        <span class="navbar-icon">
            <i class="fas fa-bars"></i>
        </span>
    </button>
    <!--Nav List-->
    <div class="collapse navbar-collapse" id="myNav">
        <ul class="navbar-nav mx-auto"> 
        <li class="nav-item active"> 
            <a href="index.html" class="nav-link">HOME</a>
        </li>
        <li class="nav-item"> 
            <a href="inventory.php" class="nav-link">INVENTORY</a>
        </li>
        <li class="nav-item"> 
            <a href="story.html" class="nav-link">OUR STORY</a>
        </li>	
        <li class="nav-item"> 
            <a href="contact.html" class="nav-link">CONTACT</a>
        </li>	
        <li class="nav-item"> 
            <a href="sell.html" class="nav-link">SELL YOUR CAR</a>
        </li>
        <li class="nav-item"> 
            <a href="admin.php" class="nav-link">ADMIN</a>
        </li>		
        </ul> 
        <!--Social Icons-->
        <div class="nav-icons d-none d-lg-block">
            <a href="https://www.facebook.com" class="con-icon"> 
				<i class="fab fa-facebook"></i>
			</a>
			<a href="https://www.twitter.com" class="con-icon"> 
				<i class="fab fa-twitter"></i>
			</a>
			<a href="https://www.instagram.com" class="con-icon"> 
				<i class="fab fa-instagram"></i>
			</a>
			<a href="https://www.snapchat.com" class="con-icon"> 
				<i class="fab fa-snapchat"></i>
			</a>
        </div>
    </div>
    </nav>
    <!--End Nav element-->
    <!--Header Section-->
    <header class="header" id="header">
        <div class="container"> 
                <div class="d-flex justify-content-center py-5"> 
                    <div class="col-sm-6 col-lg-3 text-center my-3">
                        <h1 class="font-weight-bolder align-self-center mx-1">ADMIN</h1>
                        <div class="brand-underline"></div>	
                    </div>		
                </div>
            </div>
        </div>
    </header>
    <!--End Header Section-->
</div>

<!-- Map Section -->
<section id="mapsec">
    <div class="d-flex justify-content-center p-5">
        <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center text-center p-4">
                <div class="w-50">
                    <h5 class="font-weight-bolder my-0">ADMIN LOGIN</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Map Section -->
<!-- Message Section -->
<section id="message">
    <div class="message p-4">
        <div class="container">
        <form name="admin_form" action="admin.php" method="POST" onsubmit="return validate(admin_form)">
            <div class="row px-3">
                <div class="col-6 mx-auto my-3">
                    <input type="text" id="text" name="username" placeholder="Username" class="form-control form-control-lg">
                	<h6 class="hidden-text" id="invalid_name">*invalid username</h6>
                </div>
            </div>
                <div class="col-6 mx-auto my-3">
                    <input type="password" id="text" name="password" placeholder="Password" class="form-control form-control-lg">
                    <h6 class="hidden-text" id="invalid_subj">*incorrect password</h6>
                </div>
            </div>
            <div class="row">
                <div class="col my-3 text-center">
                  <!-- <input type="hidden" name="id" value=<?php echo $_GET['id'];?>> -->
                    <button type="submit" name="Submit" class="btn msg-btn">LOGIN</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</section>
<!-- End Message Section -->


<!-- Form Validation -->
<script type="text/javascript">
function validate(myform){
	
    document.getElementById('invalid_name').style.visibility = 'hidden';
    document.getElementById('invalid_pno').style.visibility = 'hidden';
    document.getElementById('invalid_email').style.visibility = 'hidden';
    document.getElementById('invalid_subj').style.visibility = 'hidden';
    document.getElementById('invalid_msg').style.visibility = 'hidden';

    var regex_name =  /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
    var regex_phoneno = /[7-9]{1}\d{9}/;
    var regex_emailid = /^([a-z A-z 0-9 \. _])+@([a-z A-Z 0-9])+\.([a-z A-z]){2,10}(\.([A-Z a-z]){2,10})?$/;
    var regex_subj =  /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
    var regex_msg =  /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;

    var flag  = 1;

    if(regex_name.test(myform.name.value) == false)
	    {
	    	flag  = 0;
			document.getElementById('invalid_name').style.visibility = 'visible'; 
			myform.name.focus();
	    }
    if(regex_phoneno.test(myform.phoneno.value) == false)
	    {
	    	flag  = 0;
			document.getElementById('invalid_pno').style.visibility = 'visible'; 
			myform.phoneno.focus();
	    }
    if(regex_emailid.test(myform.emailid.value) == false)
	    {
	    	flag  = 0;
			document.getElementById('invalid_email').style.visibility = 'visible'; 
			myform.emailid.focus();
	    }
	if(regex_subj.test(myform.subject.value) == false)
	    {
	    	flag  = 0;
			document.getElementById('invalid_subj').style.visibility = 'visible'; 
			myform.subject.focus();
	    }
	if(regex_msg.test(myform.message.value) == false)
	    {
	    	flag  = 0;
			document.getElementById('invalid_msg').style.visibility = 'visible'; 
			myform.message.focus();
	    }
    if(flag == 0){
    	return false;
    }
    else{
    	return true;
    }
}


</script>



<!-- End From Validation-->

<!-- Contact Section -->
<section id="contact">
    <div class="contact d-flex justify-content-center py-5">
        <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center pt-4">
                <a href="contact.html">
                    <img src="img/wregenx.png" alt="" class="contact-brand">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center text-center p-4">
                <div class="w-50">
                    <h5 class="main-text">SHOWROOM LOCATION:</h5>
                    <h5 class="info-text">Sector-V, Nerul, Navi Mumbai, Maharashtra 400706</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 my-2 col-md-4 d-flex justify-content-center text-center">
                <div class="text w-50">
                    <h5 class="main-text">PHONE:</h5>
                    <h5 class="info-text">+91 9911773355</h5>
                </div>
            </div>
            <div class="col-12 my-2 col-md-4 d-flex justify-content-center text-center">
                <div class="w-50">
                    <h5 class="main-text">HOURS:</h5>
                    <h5 class="info-text">Mon-Sun: 9am-8pm</h5>
                    <h5 class="info-text">(Tuesday: Closed)</h5>	
                </div>
            </div>
            <div class="col-12 my-2 col-md-4 d-flex justify-content-center text-center">
                <div class="w-50">
                    <h5 class="main-text">EMAIL:</h5>
                    <h5 class="info-text">xyz@siesgst.ac.in</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center text-center p-5">
                <div class="w-50">
                    <div class="nav-icons d-none d-lg-block"></div>
                    <a href="https://www.facebook.com/" class="con-icon"> 
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.twitter.com" class="con-icon"> 
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com" class="con-icon"> 
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.snapchat.com" class="con-icon"> 
                        <i class="fab fa-snapchat"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- End Contact Section -->

<!-- Footer -->
<footer class="footer py-3">
    <div class="footer-text col-12 d-flex justify-content-center my-2">
        DEVELOPED BY
    </div>
    <div class="footer-text col-12 d-flex justify-content-center my-2">
        SHARDUL | PIYUSH | SIDDHARTH
    </div>
</footer>
<!-- End Footer -->



</body>
<!--jQuery-->
<script src="js/jquery-3.4.1.min.js"></script>
<!--Bootstrap JS-->
<script src="js/bootstrap.bundle.min.js"></script>
<!--Script JS-->
<script src="js/script.js"></script>
</html>