<html>
	<head>
		<title>Sign In</title>
		<link rel="stylesheet" href="index.css">
		<script type = "text/javascript"  src = "verifyInput.js" > </script> 
	</head>
<body>

<?php
	include "header.php";
	include 'connectvars.php'; 
	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$sid = mysqli_real_escape_string($conn, $_POST['sid']);
		$sname = mysqli_real_escape_string($conn, $_POST['uname']);
		$queryIn = "SELECT * FROM Account where Account.Account_ID='$sid' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
            echo "<script>window.location = 'account.php?uid=$sid&uname=$sname'</script>";		
        } else {
            $msg ="<h2>No user found</h2>";
		}
}
// close connection
mysqli_close($conn);
?>
<div class="container">
<div class="row">
<div class="col-lg-2">
</div>
<div class="col-lg-8">

	<section>
    <h2> <?php echo $msg; ?> </h2>

<form method="post" id="addForm">
<fieldset>
	<h4>Login:</h4>
    <div class="form-group">
        <label for="sID">Student ID:</label>
        <input type="number" min=1 max = 999999 class="form-control required" name="sid" id="sid" title="sid should be numeric">
    </div>
    <div class="form-group">
        <label for="Name">Username:</label>
        <input type="text" class="form-control required" name="uname" id="uname">
    </div>
</fieldset>
      <div class="text-center">
	  	<button type="submit" value="Submit" class="btn btn-secondary" style="width:50%">Submit</button>
		<button type="reset" value="Clear Form" class="btn btn-secondary" style="width:49%">Clear Fields</button>
      </div>
</form>
<button type="button" class="btn btn-secondary btn-block" onclick="window.location = 'createaccount.php'">Create Account</button>
</div>
</div>
</div>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     