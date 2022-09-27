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

if ((isset($_POST['itemNo'])) && ($_POST['itemNo'] != "")) {
  $deleteSQL = sprintf("DELETE FROM item WHERE itemNo=%s",
                       GetSQLValueString($_POST['itemNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($deleteSQL, $shoethai) or die(mysql_error());

  $deleteGoTo = "item_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_shoethai, $shoethai);
$query_Recordset1 = "SELECT * FROM item ORDER BY itemNo ASC";
$Recordset1 = mysql_query($query_Recordset1, $shoethai) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
	left: 601px;
	background-color: yellow;
	border-radius: 20px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 30px;
	
  }
.bt0:hover{
	background-color:white;
}
body {
	margin-top: 40px;
	background-color: #3e3e3e;
}
</style>
</head>

<body>
<table width="1193" border="1" align="center">
  <tr>
    <td width="173" bgcolor="#999999">รหัสสินค้า</td>
    <td width="201" bgcolor="#999999">ชนิดของสินค้า</td>
    <td width="153" bgcolor="#999999">ยี่ห้อ</td>
    <td width="209" bgcolor="#999999">ชื่อสินค้า</td>
    <td width="156" bgcolor="#999999">ราคา</td>
    <td width="150" bgcolor="#999999">จำนวน</td>
    <td width="139" bgcolor="#FF9900">แก้ไขข้อมูล</td>
  </tr>
  <?php do { ?>
    <tr>
        <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['itemNo']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['typeOfitem']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['band']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['nameOfitem']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['price']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_Recordset1['total']; ?></td>
        <td align="center" bgcolor="#FFCC99"><a href="item_edit.php?itemNo=<?php echo $row_Recordset1['itemNo']; ?>">Edit</a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
 
<p>&nbsp;</p>
</body>
<a href="indexforgeneralstaffs.php">
<button class="bt0">Back</button>
</a>
</html>
<?php
mysql_free_result($Recordset1);
?>
