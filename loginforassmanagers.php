<?php require_once('Connections/shoethai.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['ID'])) {
  $loginUsername=$_POST['ID'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "indexforassistantmanagers.php";
  $MM_redirectLoginFailed = "First.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_shoethai, $shoethai);
  
  $LoginRS__query=sprintf("SELECT ID, Password FROM loginassmanager WHERE ID=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "int")); 
   
  $LoginRS = mysql_query($LoginRS__query, $shoethai) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Index For Managers</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <style>
  
  img {
     width: 30%;
  }
  body{
   background-color: #3e3e3e;
  }
  .logo{
   text-align: center;
   height: auto;
   position: static;
  }
  .bar1{
   height: 70px;
   position: static;
  }
  .bt1{
   position: absolute;
   height: 70px;
   width: 20%;
   left: 40%;
   background-color: yellow;
   border-radius: 20px;
   font-family: Arial, Helvetica, sans-serif;
   font-size: 25px;
  }
  
  .bar2{
   height: 70px;
   position: static;
  }
  .bar3{
   height: 70px;
   position: static;
  }
  
  
  .bt3{
   position: absolute;
   height: 70px;
   width: 20%;
   left: 40%;
   border-radius: 20px;
   background-color: yellow;
   font-family: Arial, Helvetica, sans-serif;
   font-size: 25px;
  }
  .bt1:hover{
   background-color: white;
  }
  .bt2:hover{
   background-color: white;
  }
  .bt3:hover{
   background-color: white;
  }
  
 body,td,th {
	color: #FFFFFF;
}
 </style>
</head>
 

<body>
 <div class="logo">
  <a href="First.php">
   <img src="1.png" alt="logo">
  </a>
  <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
   <p align="center">&nbsp;
      &nbsp; 
       <label for="ID">Your ID</label>
       <input type="text" name="ID" id="ID">
     </p>
     <p align="center">
       <label for="Password">Password</label>
       <input type="password" name="Password" id="Password">
       <br>
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       &nbsp; 
       <input type="submit" name="Login" id="Login" value="LOGIN">
     </p>
   </form>
 </div>
 
  
  
 
 
</body>
</html>