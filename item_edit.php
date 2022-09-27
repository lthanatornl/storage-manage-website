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
  $updateSQL = sprintf("UPDATE item SET price=%s, total=%s WHERE itemNo=%s",
                       GetSQLValueString($_POST['price'], "double"),
                       GetSQLValueString($_POST['total'], "int"),
                       GetSQLValueString($_POST['itemNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($updateSQL, $shoethai) or die(mysql_error());

  $updateGoTo = "item_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_ItemEdit = "-1";
if (isset($_GET['itemNo'])) {
  $colname_ItemEdit = $_GET['itemNo'];
}
mysql_select_db($database_shoethai, $shoethai);
$query_ItemEdit = sprintf("SELECT * FROM item WHERE itemNo = %s", GetSQLValueString($colname_ItemEdit, "int"));
$ItemEdit = mysql_query($query_ItemEdit, $shoethai) or die(mysql_error());
$row_ItemEdit = mysql_fetch_assoc($ItemEdit);
$totalRows_ItemEdit = mysql_num_rows($ItemEdit);
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
      <td height="45" colspan="4" align="center" valign="middle" bgcolor="#00CCCC">Editing Item</td>
    </tr>
    <tr>
      <td width="23" align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td width="331" align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td width="286" align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td width="60" align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">ID:&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><?php echo $row_ItemEdit['itemNo']; ?></td>
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
      <td align="right" valign="top" bgcolor="#FFFFCC">Type:&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="fname"></label>
      <?php echo $row_ItemEdit['typeOfitem']; ?></td>
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
      <td align="right" valign="top" bgcolor="#FFFFCC">Band:&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="lname"></label>
      <?php echo $row_ItemEdit['band']; ?></td>
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
      <td align="right" valign="top" bgcolor="#FFFFCC">Item Name:&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><?php echo $row_ItemEdit['nameOfitem']; ?></td>
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
      <td align="right" valign="top" bgcolor="#FFFFCC">Price&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="province"></label>
        <label for="price"></label>
        <input name="price" type="text" id="price" value="<?php echo $row_ItemEdit['price']; ?>" />
        Bath</td>
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
      <td align="right" valign="top" bgcolor="#FFFFCC">Total&nbsp; &nbsp;&nbsp; &nbsp;</td>
      <td align="left" valign="top" bgcolor="#FFFFCC"><label for="phoneNo"></label>
        <label for="total"></label>
        <input name="total" type="text" id="total" value="<?php echo $row_ItemEdit['total']; ?>" />
        &nbsp; ea.</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="right" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC"><input name="itemNo" type="hidden" id="itemNo" value="<?php echo $row_ItemEdit['itemNo']; ?>" /></td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
      <td align="center" valign="top" bgcolor="#FFFFCC"><input type="submit" name="save" id="save" value="Save" /></td>
      <td align="center" valign="top" bgcolor="#FFFFCC">&nbsp;</td>
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
<a href="Indexformanagers.php">
<button class="bt0">Back</button>
</a>
</body>
</html>
<?php
mysql_free_result($ItemEdit);
?>
