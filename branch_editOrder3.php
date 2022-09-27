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
  $updateSQL = sprintf("UPDATE orderbranch SET total=%s, staff=%s WHERE lotNo=%s",
                       GetSQLValueString($_POST['total'], "int"),
                       GetSQLValueString($_POST['staff'], "int"),
                       GetSQLValueString($_POST['lotNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($updateSQL, $shoethai) or die(mysql_error());

  $updateGoTo = "branch_ShowOrder.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_editBranchOrder = "-1";
if (isset($_GET['lotNo'])) {
  $colname_editBranchOrder = $_GET['lotNo'];
}
mysql_select_db($database_shoethai, $shoethai);
$query_editBranchOrder = sprintf("SELECT * FROM orderbranch WHERE lotNo = %s", GetSQLValueString($colname_editBranchOrder, "int"));
$editBranchOrder = mysql_query($query_editBranchOrder, $shoethai) or die(mysql_error());
$row_editBranchOrder = mysql_fetch_assoc($editBranchOrder);
$totalRows_editBranchOrder = mysql_num_rows($editBranchOrder);
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
      <td align="right" bgcolor="#CCCCFF">Lot Number</td>
      <td bgcolor="#CCCCFF"><?php echo $row_editBranchOrder['lotNo']; ?></td>
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
      <td align="right" bgcolor="#CCCCFF">Item Number:&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCFF"><label for="itemNo"></label>
      <?php echo $row_editBranchOrder['itemNo']; ?></td>
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
        <label for="total"></label>
      <input name="total" type="text" id="total" value="<?php echo $row_editBranchOrder['total']; ?>" /></td>
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
      <td align="right" bgcolor="#CCCCFF">Price Order:&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCFF"><label for="priceOrderbranch"></label>
      <?php echo $row_editBranchOrder['priceOrderbranch']; ?></td>
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
      <td align="right" bgcolor="#CCCCFF">Date Order:&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCFF"><label for="dateOrderbranch"></label>
      <?php echo $row_editBranchOrder['dateOrderbranch']; ?></td>
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
      <input name="staff" type="text" id="staff" value="<?php echo $row_editBranchOrder['staff']; ?>" /></td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF"><input name="lotNo" type="hidden" id="lotNo" value="<?php echo $row_editBranchOrder['lotNo']; ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
      <td align="center" bgcolor="#CCCCFF">&nbsp;
        &nbsp; &nbsp; &nbsp;
        <input type="submit" name="submit" id="submit" value="Save" /></td>
      <td bgcolor="#CCCCFF">&nbsp;</td>
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
mysql_free_result($editBranchOrder);
?>
