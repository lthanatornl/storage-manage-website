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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE customer SET fname=%s, lname=%s, address=%s, province=%s, postcode=%s, phoneNo=%s, email=%s WHERE customerNo=%s",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['province'], "text"),
                       GetSQLValueString($_POST['postcode'], "int"),
                       GetSQLValueString($_POST['phoneNo'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['customerNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($updateSQL, $shoethai) or die(mysql_error());

  $updateGoTo = "cus_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_editcustomer = "-1";
if (isset($_GET['customerNo'])) {
  $colname_editcustomer = $_GET['customerNo'];
}
mysql_select_db($database_shoethai, $shoethai);
$query_editcustomer = sprintf("SELECT * FROM customer WHERE customerNo = %s", GetSQLValueString($colname_editcustomer, "int"));
$editcustomer = mysql_query($query_editcustomer, $shoethai) or die(mysql_error());
$row_editcustomer = mysql_fetch_assoc($editcustomer);
$totalRows_editcustomer = mysql_num_rows($editcustomer);

$colname_customer_edit = "-1";
if (isset($_GET['customerNo'])) {
  $colname_customer_edit = $_GET['customerNo'];
}
mysql_select_db($database_shoethai, $shoethai);
$query_customer_edit = sprintf("SELECT * FROM customer WHERE customerNo = %s", GetSQLValueString($colname_customer_edit, "int"));
$customer_edit = mysql_query($query_customer_edit, $shoethai) or die(mysql_error());
$row_customer_edit = mysql_fetch_assoc($customer_edit);
$totalRows_customer_edit = mysql_num_rows($customer_edit);
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
      <td height="45" colspan="4" align="center" valign="middle" bgcolor="#00CCCC">Editing&nbsp;  Customer </td>
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
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="customerNo3"></label>
      <?php echo $row_editcustomer['customerNo']; ?></td>
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
        <input name="fname" type="text" id="fname" value="<?php echo $row_editcustomer['fname']; ?>" /></td>
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
        <input name="lname" type="text" id="lname" value="<?php echo $row_editcustomer['lname']; ?>" /></td>
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
      <td align="left" valign="top" bgcolor="#FFFFCC"><input name="address" type="text" id="address" value="<?php echo $row_editcustomer['address']; ?>" size="40" /></td>
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
        <input name="province" type="text" id="province" value="<?php echo $row_editcustomer['province']; ?>" /></td>
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
        <input name="postcode" type="text" id="postcode" value="<?php echo $row_editcustomer['postcode']; ?>" size="15" /></td>
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
        <input name="phoneNo" type="text" id="phoneNo" value="<?php echo $row_editcustomer['phoneNo']; ?>" /></td>
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
        <input name="email" type="text" id="email" value="<?php echo $row_editcustomer['email']; ?>" /></td>
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
      <td align="center" valign="top" bgcolor="#FFFFCC"><input type="submit" name="save" id="save" value="Save" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC"><input name="customerNo" type="hidden" id="customerNo" value="<?php echo $row_editcustomer['customerNo']; ?>" /></td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
</form>
<a href="indexforgeneralstaffs.php">
<button class="bt0">Back</button>
</a>
</body>
</html>
<?php
mysql_free_result($editcustomer);

mysql_free_result($customer_edit);
?>
