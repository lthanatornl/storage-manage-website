
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO customer (customerNo, fname, lname, address, province, postcode, phoneNo, email) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['customerNo'], "int"),
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['province'], "text"),
                       GetSQLValueString($_POST['postcode'], "int"),
                       GetSQLValueString($_POST['phoneNo'], "text"),
                       GetSQLValueString($_POST['email'], "text"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($insertSQL, $shoethai) or die(mysql_error());

  $insertGoTo = "cus_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
.bt0{
	position: absolute;
	height: 70px;
	width: 20%;
	left: 600px;
	background-color: yellow;
	border-radius: 20px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 30px;
	top: 599px;
  }
.bt0:hover{
	background-color:white;
}
body{
	background-color: #3e3e3e;
	margin-top: 100px;
}
</style>
<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="45" colspan="4" align="center" valign="middle" bgcolor="#00CCCC">Customer Register</td>
    </tr>
    <tr>
      <td width="23" align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td width="331" align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td width="286" align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td width="60" align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">ID&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="customerNo"></label> 
      <input name="customerNo" type="text" id="customerNo" size="20" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">First Name&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="fname"></label>
      <input type="text" name="fname" id="fname" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">Last Name&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="lname"></label>
      <input type="text" name="lname" id="lname" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">Address&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><input name="address" type="text" id="address" size="40" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC"><label for="address"></label></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">Province&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="province"></label>
      <input type="text" name="province" id="province" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">PostCode&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="postcode"></label>
      <input name="postcode" type="text" id="postcode" size="15" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">Phone Number&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="phoneNo"></label>
      <input type="text" name="phoneNo" id="phoneNo" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">&nbsp;&nbsp; E-Mail&nbsp; &nbsp; &nbsp; </td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="email"></label>
      <input type="text" name="email" id="email" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC"><input type="submit" name="save" id="save" value="Submit" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
  </table>
</form>
<a href="indexforassistantmanagers.php">
<button class="bt0">Back</button>
</a>
</body>
</html>