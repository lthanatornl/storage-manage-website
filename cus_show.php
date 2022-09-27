<?php require_once('Connections/shoethai.php'); ?>
<?php require_once('Connections/shoethai.php'); ?>
<?php require_once('Connections/shoethai.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

if ((isset($_POST['customerNo'])) && ($_POST['customerNo'] != "")) {
  $deleteSQL = sprintf("DELETE FROM customer WHERE customerNo=%s",
                       GetSQLValueString($_POST['customerNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($deleteSQL, $shoethai) or die(mysql_error());

  $deleteGoTo = "cus_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

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

$maxRows_ShowCustomer = 10;
$pageNum_ShowCustomer = 0;
if (isset($_GET['pageNum_ShowCustomer'])) {
  $pageNum_ShowCustomer = $_GET['pageNum_ShowCustomer'];
}
$startRow_ShowCustomer = $pageNum_ShowCustomer * $maxRows_ShowCustomer;

mysql_select_db($database_shoethai, $shoethai);
$query_ShowCustomer = "SELECT * FROM customer ORDER BY customerNo ASC";
$query_limit_ShowCustomer = sprintf("%s LIMIT %d, %d", $query_ShowCustomer, $startRow_ShowCustomer, $maxRows_ShowCustomer);
$ShowCustomer = mysql_query($query_limit_ShowCustomer, $shoethai) or die(mysql_error());
$row_ShowCustomer = mysql_fetch_assoc($ShowCustomer);

if (isset($_GET['totalRows_ShowCustomer'])) {
  $totalRows_ShowCustomer = $_GET['totalRows_ShowCustomer'];
} else {
  $all_ShowCustomer = mysql_query($query_ShowCustomer);
  $totalRows_ShowCustomer = mysql_num_rows($all_ShowCustomer);
}
$totalPages_ShowCustomer = ceil($totalRows_ShowCustomer/$maxRows_ShowCustomer)-1;

mysql_select_db($database_shoethai, $shoethai);
$query_Recordset1 = "SELECT * FROM customer ORDER BY customerNo ASC";
$Recordset1 = mysql_query($query_Recordset1, $shoethai) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_shoethai, $shoethai);
$query_Recordset2 = "SELECT * FROM customer ORDER BY customerNo ASC";
$Recordset2 = mysql_query($query_Recordset2, $shoethai) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$queryString_ShowCustomer = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_ShowCustomer") == false && 
        stristr($param, "totalRows_ShowCustomer") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_ShowCustomer = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_ShowCustomer = sprintf("&totalRows_ShowCustomer=%d%s", $totalRows_ShowCustomer, $queryString_ShowCustomer);
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
	margin-top: 50px;
	background-color: #3e3e3e;
}
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="1000" border="1" align="center">
    <tr>
      <td height="40" colspan="10" align="center" bgcolor="#66FFCC">ข้อมูลลูกค้ามีจำนวน <?php echo $totalRows_ShowCustomer ?>&nbsp;รายการ</td>
    </tr>
    <tr>
      <td width="238" bgcolor="#CCCCCC">รหัสลูกค้า</td>
      <td width="190" bgcolor="#CCCCCC">ชื่อ</td>
      <td width="190" bgcolor="#CCCCCC">นามสกุล</td>
      <td width="204" bgcolor="#CCCCCC">ที่อยู่</td>
      <td width="213" bgcolor="#CCCCCC">จังหวัด</td>
      <td width="214" bgcolor="#CCCCCC">รหัสไปรษณีย์</td>
      <td width="214" bgcolor="#CCCCCC">เบอร์โทรศัพท์</td>
      <td width="187" bgcolor="#CCCCCC">อีเมล</td>
      <td width="167" align="center" bgcolor="#FF9900">แก้ไขข้อมูล</td>
      <td width="167" align="center" bgcolor="#CC3300">ลบข้อมูล</td>
    </tr>
    <?php do { ?>
      <tr>
        <td bgcolor="#FFFFFF"><?php echo $row_ShowCustomer['customerNo']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_ShowCustomer['fname']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_ShowCustomer['lname']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_ShowCustomer['address']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_ShowCustomer['province']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_ShowCustomer['postcode']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_ShowCustomer['phoneNo']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $row_ShowCustomer['email']; ?></td>
        <td align="center" bgcolor="#FFCC99"><a href="cus_edit.php?customerNo=<?php echo $row_ShowCustomer['customerNo']; ?>" class="btn btn-warning">Edit</a></td>
        <td align="center" bgcolor="#FF6666"><input type="submit" name="Delete" id="Delete" value="Delete" onclick="return comfirm('คุณแน่ใจที่จะลบข้อมูลหรือไม่?');"/>
        <input name="customerNo" type="hidden" id="customerNo" value="<?php echo $row_ShowCustomer['customerNo']; ?>" /></td>
      </tr>
      <?php } while ($row_ShowCustomer = mysql_fetch_assoc($ShowCustomer)); ?>
  </table>
</form>
<p>&nbsp;
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_ShowCustomer > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_ShowCustomer=%d%s", $currentPage, 0, $queryString_ShowCustomer); ?>"><img src="First.gif" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_ShowCustomer > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_ShowCustomer=%d%s", $currentPage, max(0, $pageNum_ShowCustomer - 1), $queryString_ShowCustomer); ?>"><img src="Previous.gif" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_ShowCustomer < $totalPages_ShowCustomer) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_ShowCustomer=%d%s", $currentPage, min($totalPages_ShowCustomer, $pageNum_ShowCustomer + 1), $queryString_ShowCustomer); ?>"><img src="Next.gif" /></a>
    <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_ShowCustomer < $totalPages_ShowCustomer) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_ShowCustomer=%d%s", $currentPage, $totalPages_ShowCustomer, $queryString_ShowCustomer); ?>"><img src="Last.gif" /></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
</body>
<a href="Indexformanagers.php">
<button class="bt0">Back</button>
</a>
</html>
<?php
mysql_free_result($ShowCustomer);

mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
