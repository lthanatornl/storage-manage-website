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
  $insertSQL = sprintf("INSERT INTO orderbranch (lotNo, itemNo, total, priceOrderbranch, dateOrderbranch, staff) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['lotNo'], "int"),
                       GetSQLValueString($_POST['itemNo'], "int"),
                       GetSQLValueString($_POST['total'], "int"),
                       GetSQLValueString($_POST['priceOrderbranch'], "double"),
                       GetSQLValueString($_POST['dateOrderbranch'], "date"),
                       GetSQLValueString($_POST['staff'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($insertSQL, $shoethai) or die(mysql_error());

  $insertGoTo = "branch_ShowOrder.php";
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
      <td height="45" colspan="4" align="center" bgcolor="#FF66CC">Order Branch</td>
    </tr>
    <tr>
      <td width="204" bgcolor="#CCCCFF">&nbsp;</td>
      <td width="141" bgcolor="#CCCCFF">&nbsp;</td>
      <td width="231" bgcolor="#CCCCFF">&nbsp;</td>
      <td width="124" bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">Lot Number&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCFF"><label for="lotNo"></label>
      <input type="text" name="lotNo" id="lotNo" /></td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">Item Number&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCFF"><label for="itemNo"></label>
      <input type="text" name="itemNo" id="itemNo" /></td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">Total&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCFF"><label for="total"></label>
      <input type="text" name="total" id="total" /></td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">Price Order&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCFF"><label for="priceOrderbranch"></label>
      <input type="text" name="priceOrderbranch" id="priceOrderbranch" /></td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">Date Order&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCFF"><label for="dateOrderbranch"></label>
      <input type="text" name="dateOrderbranch" id="dateOrderbranch" /></td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="right" bgcolor="#CCCCFF">Staff&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCFF"><label for="staff"></label>
      <input type="text" name="staff" id="staff" /></td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="center" bgcolor="#CCCCFF"> &nbsp;
      &nbsp; &nbsp; &nbsp; <input type="submit" name="submit" id="submit" value="Submit" /></td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<a href="Indexformanagers.php">
<button class="bt0">Back</button>
</a>
</body>
</html>