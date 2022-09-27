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
  $updateSQL = sprintf("UPDATE ordercustomer SET totalOrder=%s, taxNo=%s, branchNo=%s WHERE orderNo=%s",
                       GetSQLValueString($_POST['totalOrder'], "int"),
                       GetSQLValueString($_POST['taxNo'], "int"),
                       GetSQLValueString($_POST['branchNo'], "int"),
                       GetSQLValueString($_POST['orderNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($updateSQL, $shoethai) or die(mysql_error());

  $updateGoTo = "cus_ShowOrder.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE ordercustomer SET taxNo=%s, branchNo=%s WHERE orderNo=%s",
                       GetSQLValueString($_POST['taxNo'], "int"),
                       GetSQLValueString($_POST['branchNo'], "int"),
                       GetSQLValueString($_POST['orderNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($updateSQL, $shoethai) or die(mysql_error());

  $updateGoTo = "cus_ShowOrder.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_editOrderCustomer = "-1";
if (isset($_GET['orderNo'])) {
  $colname_editOrderCustomer = $_GET['orderNo'];
}
mysql_select_db($database_shoethai, $shoethai);
$query_editOrderCustomer = sprintf("SELECT * FROM ordercustomer WHERE orderNo = %s", GetSQLValueString($colname_editOrderCustomer, "int"));
$editOrderCustomer = mysql_query($query_editOrderCustomer, $shoethai) or die(mysql_error());
$row_editOrderCustomer = mysql_fetch_assoc($editOrderCustomer);
$totalRows_editOrderCustomer = mysql_num_rows($editOrderCustomer);
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
	left: 601px;
	background-color: yellow;
	border-radius: 20px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 30px;
	top: 488px;	
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
      <td height="45" colspan="4" align="center" bgcolor="#00CCCC">Editing Order Customer</td>
    </tr>
    <tr>
      <td width="145" bgcolor="#99FFFF">&nbsp;</td>
      <td width="200" bgcolor="#99FFFF">&nbsp;</td>
      <td width="162" bgcolor="#99FFFF">&nbsp;</td>
      <td width="193" bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">Order Number:</td>
      <td bgcolor="#99FFFF"><label for="orderNo"></label>
      <?php echo $row_editOrderCustomer['orderNo']; ?></td>
      <td bgcolor="#99FFFF">Customer Number:</td>
      <td bgcolor="#99FFFF"><label for="customerNo"><?php echo $row_editOrderCustomer['customerNo']; ?></label></td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">Item Number:</td>
      <td bgcolor="#99FFFF"><label for="itemNo"><?php echo $row_editOrderCustomer['itemNo']; ?></label></td>
      <td bgcolor="#99FFFF">Total Order</td>
      <td bgcolor="#99FFFF"><label for="total"></label>
        <label for="total"></label>
        <label for="totalOrder"></label>
      <input name="totalOrder" type="text" id="totalOrder" value="<?php echo $row_editOrderCustomer['totalOrder']; ?>" />        <label for="totalOrder"></label></td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">Date Order:</td>
      <td bgcolor="#99FFFF"><label for="dateOrder"></label>
      <?php echo $row_editOrderCustomer['dateOrder']; ?></td>
      <td bgcolor="#99FFFF">Tax. Number</td>
      <td bgcolor="#99FFFF"><label for="taxNo"></label>
      <input name="taxNo" type="text" id="taxNo" value="<?php echo $row_editOrderCustomer['taxNo']; ?>" /></td>
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
      <input name="branchNo" type="text" id="branchNo" value="<?php echo $row_editOrderCustomer['branchNo']; ?>" /></td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF"><input type="submit" name="Submit" id="Submit" value="Save" /></td>
      <td bgcolor="#99FFFF"><input name="orderNo" type="hidden" id="orderNo" value="<?php echo $row_editOrderCustomer['orderNo']; ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
      <td bgcolor="#99FFFF">&nbsp;</td>
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
mysql_free_result($editOrderCustomer);
?>
