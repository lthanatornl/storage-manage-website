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
  $insertSQL = sprintf("INSERT INTO ordercustomer (orderNo, customerNo, itemNo, totalOrder, dateOrder, taxNo, branchNo) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['orderNo'], "int"),
                       GetSQLValueString($_POST['customerNo'], "int"),
                       GetSQLValueString($_POST['itemNo'], "int"),
                       GetSQLValueString($_POST['totalOrder'], "int"),
                       GetSQLValueString($_POST['dateOrder'], "date"),
                       GetSQLValueString($_POST['taxNo'], "int"),
                       GetSQLValueString($_POST['branchNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($insertSQL, $shoethai) or die(mysql_error());

  $insertGoTo = "cus_ShowOrder.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO ordercustomer (orderNo, customerNo, itemNo, totalOrder, dateOrder, taxNo, branchNo) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['orderNo'], "int"),
                       GetSQLValueString($_POST['customerNo'], "int"),
                       GetSQLValueString($_POST['itemNo'], "int"),
                       GetSQLValueString($_POST['totalOrder'], "int"),
                       GetSQLValueString($_POST['dateOrder'], "date"),
                       GetSQLValueString($_POST['taxNo'], "int"),
                       GetSQLValueString($_POST['branchNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($insertSQL, $shoethai) or die(mysql_error());

  $insertGoTo = "cus_ShowOrder.php";
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
<style type="text/css">
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
body {
	margin-top: 40px;
	background-color:#3e3e3e;
}
</style>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="45" colspan="4" align="center" bgcolor="#00CCCC">Order Customer</td>
    </tr>
    <tr>
      <td width="145" bgcolor="#99FFFF">&nbsp;</td>
      <td width="200" bgcolor="#99FFFF">&nbsp;</td>
      <td width="162" bgcolor="#99FFFF">&nbsp;</td>
      <td width="193" bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">Order Number</td>
      <td bgcolor="#99FFFF"><label for="orderNo"></label>
      <input type="text" name="orderNo" id="orderNo" /></td>
      <td bgcolor="#99FFFF">Customer Number</td>
      <td bgcolor="#99FFFF"><label for="customerNo"></label>
      <input type="text" name="customerNo" id="customerNo" /></td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">Item Number</td>
      <td bgcolor="#99FFFF"><label for="itemNo"></label>
      <input type="text" name="itemNo" id="itemNo" /></td>
      <td bgcolor="#99FFFF">Total Order</td>
      <td bgcolor="#99FFFF"><label for="totalOrder"></label>
      <input type="text" name="totalOrder" id="totalOrder" /></td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">Date Order</td>
      <td bgcolor="#99FFFF"><label for="dateOrder"></label>
      <input type="text" name="dateOrder" id="dateOrder" /></td>
      <td bgcolor="#99FFFF">Tax. Number</td>
      <td bgcolor="#99FFFF"><label for="taxNo"></label>
      <input type="text" name="taxNo" id="taxNo" /></td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">Branch Number</td>
      <td bgcolor="#99FFFF"><label for="branchNo"></label>
      <input type="text" name="branchNo" id="branchNo" /></td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF"><input type="submit" name="Submit" id="Submit" value="Submit" /></td>
      <td bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<a href="indexforgeneralstaffs.php">
<button class="bt0">Back</button>
</a>
</body>
</html>