<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
.error{color: red;}
body {text-align: center;
      background-color: #D6FFD6;}
h2 {font-family: "Times New Roman", Times, serif;}
#error ul {color: red;}
input[type="text"], input[type="password"], input[type="submit"] {color: #800000; background-color: #d3d3d3;}
input[name="passconfirm"] {margin-left: 2px;}
</style>
</head>
<body>
 
<?php
// define variables and set to empty values
$fNameErr = $lNameErr = $passErr = $pconfErr = $bDayErr = $genderErr = $ageErr = $progErr = $emailErr = $websiteErr = "";
$fname = $lname = $password = $passconfirm = $day = $month = $year = $email = $gender = $age = $plang = $email = $website = "";
$validate = TRUE;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $fname = test_input($_POST["fname"]);
  $lname = test_input($_POST["lname"]);
  $password = test_input($_POST["password"]);
  $passconfirm = test_input($_POST["passconfirm"]);
  $day = test_input($_POST["day1"]);
  $month = test_input($_POST["month1"]);
  $year = test_input($_POST["year1"]);
  $email = test_input($_POST["email"]);
  $website = test_input($_POST["website"]);
}
 
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 
if(!$_POST)
{
  $validate = FALSE;
}
 
 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 
 
 
  //validation of forename
  if(!empty($_POST["fname"]))
  {
    if (!preg_match("/^[a-zA-Z '-]*$/", $fname))
    {
      $fNameErr = "Only letters, - , ' and whitespaces are allowed";
      $fname = "";
      $validate = FALSE;
    }
    else
    {
      $fname = test_input($_POST["fname"]);
    }
  }
  else
  {
    $fNameErr = "Forename is required";
    $validate = FALSE;
  }
 
  //validation of surname
  if (!empty($_POST["lname"]))
  {
    if (!preg_match("/^[a-zA-Z '-]*$/", $lname))
    {
      $lNameErr = "Only letters, - , ' and whitespaces are allowed";
      $lname = "";
      $validate = FALSE;
    }
    else
    {
      $lname = test_input($_POST['lname']);
    }
  }
  else
  {
    $lNameErr = "Last name is required";
    $validate = FALSE;
  }
 
  //validation of password
  if (!empty($_POST["password"]))
  {
    if (!preg_match("/^[a-zA-Z0-9]*$/", $password))
    {
      $passErr = "Password should contain each one of a-z, A-Z and 0-9 characters";
      $password = "";
      $validate = FALSE;
    }
    elseif (strlen($password) < 6)
    {
      $passErr = "Password should contain at least 6 characters";
      $password = "";
      $validate = FALSE;
    }
    else
    {
      $password = test_input($_POST["password"]);
    }
  }
  else
  {
    $passErr = "A password is required";
    $validate = FALSE;
  }
 
 
  //validation of confirmed password
  if (!empty($_POST["passconfirm"]))
  {
    if (!preg_match("/^[a-zA-Z0-9]*$/", $passconfirm))
    {
      $pconfErr = "Password should contain each one of a-z, A-Z and 0-9 characters";
      $passconfirm = "";
      $validate = FALSE;
    }
    elseif (strlen($passconfirm) < 6)
    {
      $pconfErr = "Password should contain at least 6 characters.";
      $passconfirm = "";
      $validate = FALSE;
    }
    elseif ($password !== $passconfirm)
    {
      $pconfErr = "Passwords do not match";
      $passconfirm = "";
      $validate = FALSE;
    }
    else
    {
      $passconfirm = test_input($_POST["passconfirm"]);
    }
  }
  else
  {
    $pconfErr = "A password is required";
    $validate = FALSE;
  }
 
  //birth date validation
  if (!empty($_POST["day1"]) && $_POST["month1"] && $_POST["year1"])
  {
    if (($year > 1997))
    {
      $bDayErr = "You should be 18 years or older to proceed";
      $validate = FALSE;
    }
    else
    {
      $day = test_input($_POST["day1"]);
      $month = test_input($_POST["month1"]);
      $year = test_input($_POST["year1"]);
    }
  }
  else
  {
    $bDayErr = "Your birth day is required";
    $validate = FALSE;
  }
 
  //validation of gender checkbox
  if (!isset($_POST["gender"]))
  {
    $genderErr = "Gender is not selected";
    $validate = FALSE;
  }
  else
  {
    $gender = test_input($_POST["gender"]);
  }
 
  //validation of age radio
  if (!isset($_POST["age"]))
  {
    $ageErr = "Age is not selected";
    $validate = FALSE;
  }
  else
  {
    $age = test_input($_POST["age"]);
  }
 
  //validation of proglang radio
  if (!isset($_POST["plang"]))
  {
    $progErr = "Programming language is not selected";
    $validate = FALSE;
  }
  else
  {
    $plang = test_input($_POST["plang"]);
  }
 
  //email validation
  if (!empty($_POST["email"]))
  {
    if (!((strpos($email, ".") > 0) && (strpos($email, "@") > 0)) || preg_match("/[^a-zA-Z0-9.@_-]/", $email))
    {
      $emailErr = "Invalid characters have been found, please re-type your e-mail";
      $email = "";
      $validate = FALSE;
    }
    else
    {
      $email = test_input($_POST["email"]);
    }
  }
  else
  {
    $emailErr = "Your e-mail is required";
    $validate = FALSE;
  }
 
  //validation of website
  if (!empty($_POST["website"]))
  {
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website))
    {
      $websiteErr = "Invalid URL";
      $website = "";
      $validate = FALSE;
    }
    else
    {
      $website = test_input($_POST["website"]);
    }
  }
  else
  {
    $websiteErr = "Your website is required";
    $validate = FALSE;
  }
}
 
  var_dump($validate);
 
 if (!$validate):
?>
 
<h2>Interviewee registration</h2>
<div id = "error">
  <ul style="list-style-type:none">
    <li><strong><?php echo $fNameErr;?></strong></li>
    <li><strong><?php echo $lNameErr;?></strong></li>
    <li><strong><?php echo $passErr;?></strong></li>
    <li><strong><?php echo $pconfErr;?></strong></li>
    <li><strong><?php echo $bDayErr;?></strong></li>
    <li><strong><?php echo $genderErr;?></strong></li>
    <li><strong><?php echo $ageErr;?></strong></li>
    <li><strong><?php echo $progErr;?></strong></li>
    <li><strong><?php echo $emailErr;?></strong></li>
    <li><strong><?php echo $websiteErr;?></strong></li>
  </ul> 
</div> 
<form method="post" font-color action="index.php">
   First name: <input type="text" name="fname" value="<?php echo $fname;?>">
   <span class="error">* Required field</span><br/><br/>
   Last name: <input type="text" name="lname" value="<?php echo $lname;?>">
   <span class="error">* Required field</span>
   <br><br>
   Password: <input type="password" name="password" value="<?php echo $password;?>">
     <span class="error">* Required field</span><br/><br/>
   Confirm Password: <input type="password" name="passconfirm" value="<?php echo $passconfirm;?>">
   <span class="error">* Required field</span>
   <br><br>
   Birthday: <input type="text" size="2" maxlength="2" name="day1"/>/
   <input type="text" size="2" maxlength="2" name="month1"/>/
   <input type="text"  size="4" maxlength="4" name="year1"/>
   <span class="error">* Required field</span><br><br>
   Gender:
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="Female">Female
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="Male">Male
   <span class="error">* Required field</span>
   <br><br>
   Age Range:
   <input type="radio" name="age" <?php if (isset($age) && $age=="18-25") echo "checked";?>  value="18-25">18-25
   <input type="radio" name="age" <?php if (isset($age) && $age=="26-30") echo "checked";?>  value="26-30">26-30
   <input type="radio" name="age" <?php if (isset($age) && $age=="31-35") echo "checked";?>  value="31-35">31-35
  <span class="error">* Required field</span>
   <br><br>
    Programming Languages:
   <input type="checkbox" name="plang" <?php if (isset($plang) && $plang=="C++") echo "checked";?>  value="C++">C++
   <input type="checkbox" name="plang" <?php if (isset($plang) && $plang=="Java") echo "checked";?>  value="Java">Java
   <input type="checkbox" name="plang" <?php if (isset($plang) && $plang=="Perl") echo "checked";?>  value="Perl">Perl
   <input type="checkbox" name="plang" <?php if (isset($plang) && $plang=="Ruby") echo "checked";?>  value="Ruby">Ruby
  <span class="error">* Required field</span>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* Required field</span>
   <br><br>
   Website: <input type="text" name="website" value="<?php echo $website;?>">
   <span class="error">* Required field</span>
   <br><br>
   <input type="submit" name="submit" value="Submit">
</form>
<?php else: ?>
  <p>Your candidature for the position of full-time back-end developer will be reviewed shortly, <br /> and you will be contacted immediately by one of our personnel officers.</p>
<h4>Please check the information below:</h4>
<table class="signup" border="0" cellpadding="4"
cellspacing="7" bgcolor="#eeeeee" align = "center">
<th colspan="2" align="center">Signup Form</th>
<form method="post" action="adduser.php">
<tr><td>Forename</td><td><input type="text" name="forename" value="<?php echo $fname;?>" readonly/></td></tr>
<tr><td>Surname</td><td><input type="text" name="surname" value="<?php echo $lname;?>" readonly/></td></tr>
<tr><td>Password</td><td><input type="password" name="password" value="<?php echo $password;?>" readonly/></td></tr>
<tr><td>Birth date</td><td><input type="text" name="birth" value="<?php echo $day;?>.<?php echo $month;?>.<?php echo $year;?>" readonly/></td></tr>
<tr><td>Gender</td><td><input type="text" name="gender" value="<?php echo $gender;?>" readonly/></td></tr>
<tr><td>Age</td><td><input type="text" name="age" value="<?php echo $age;?>" readonly/></td></tr>
<tr><td>Programming language</td><td><input type="text" name="plang" value="<?php echo $plang;?>" readonly/></td></tr>
<tr><td>E-mail</td><td><input type="text" name="email" value="<?php echo $email;?>" readonly/></td></tr>
<tr><td>Website</td><td><input type="text" name="website" value="<?php echo $website;?>" readonly/></td></tr>
 
<?php endif; ?>
 
 
</body>
</html>
