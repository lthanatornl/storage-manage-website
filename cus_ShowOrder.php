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

$currentPage = $_SERVER["PHP_SELF"];

if ((isset($_POST['orderNo'])) && ($_POST['orderNo'] != "")) {
  $deleteSQL = sprintf("DELETE FROM ordercustomer WHERE orderNo=%s",
                       GetSQLValueString($_POST['orderNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($deleteSQL, $shoethai) or die(mysql_error());

  $deleteGoTo = "cus_ShowOrder.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_OrderCustomer = 10;
$pageNum_OrderCustomer = 0;
if (isset($_GET['pageNum_OrderCustomer'])) {
  $pageNum_OrderCustomer = $_GET['pageNum_OrderCustomer'];
}
$startRow_OrderCustomer = $pageNum_OrderCustomer * $maxRows_OrderCustomer;

mysql_select_db($database_shoethai, $shoethai);
$query_OrderCustomer = "SELECT * FROM ordercustomer ORDER BY dateOrder ASC";
$query_limit_OrderCustomer = sprintf("%s LIMIT %d, %d", $query_OrderCustomer, $startRow_OrderCustomer, $maxRows_OrderCustomer);
$OrderCustomer = mysql_query($query_limit_OrderCustomer, $shoethai) or die(mysql_error());
$row_OrderCustomer = mysql_fetch_assoc($OrderCustomer);

if (isset($_GET['totalRows_OrderCustomer'])) {
  $totalRows_OrderCustomer = $_GET['totalRows_OrderCustomer'];
} else {
  $all_OrderCustomer = mysql_query($query_OrderCustomer);
  $totalRows_OrderCustomer = mysql_num_rows($all_OrderCustomer);
}
$totalPages_OrderCustomer = ceil($totalRows_OrderCustomer/$maxRows_OrderCustomer)-1;$maxRows_OrderCustomer = 10;
$pageNum_OrderCustomer = 0;
if (isset($_GET['pageNum_OrderCustomer'])) {
  $pageNum_OrderCustomer = $_GET['pageNum_OrderCustomer'];
}
$startRow_OrderCustomer = $pageNum_OrderCustomer * $maxRows_OrderCustomer;

mysql_select_db($database_shoethai, $shoethai);
$query_OrderCustomer = "SELECT * FROM ordercustomer ORDER BY dateOrder ASC";
$query_limit_OrderCustomer = sprintf("%s LIMIT %d, %d", $query_OrderCustomer, $startRow_OrderCustomer, $maxRows_OrderCustomer);
$OrderCustomer = mysql_query($query_limit_OrderCustomer, $shoethai) or die(mysql_error());
$row_OrderCustomer = mysql_fetch_assoc($OrderCustomer);

if (isset($_GET['totalRows_OrderCustomer'])) {
  $totalRows_OrderCustomer = $_GET['totalRows_OrderCustomer'];
} else {
  $all_OrderCustomer = mysql_query($query_OrderCustomer);
  $totalRows_OrderCustomer = mysql_num_rows($all_OrderCustomer);
}

$pageNum_OrderCustomer = 0;
if (isset($_GET['pageNum_OrderCustomer'])) {
  $pageNum_OrderCustomer = $_GET['pageNum_OrderCustomer'];
}
$startRow_OrderCustomer = $pageNum_OrderCustomer * $maxRows_OrderCustomer;

mysql_select_db($database_shoethai, $shoethai);
$query_OrderCustomer = "SELECT * FROM ordercustomer ORDER BY dateOrder ASC";
$query_limit_OrderCustomer = sprintf("%s LIMIT %d, %d", $query_OrderCustomer, $startRow_OrderCustomer, $maxRows_OrderCustomer);
$OrderCustomer = mysql_query($query_limit_OrderCustomer, $shoethai) or die(mysql_error());
$row_OrderCustomer = mysql_fetch_assoc($OrderCustomer);

if (isset($_GET['totalRows_OrderCustomer'])) {
  $totalRows_OrderCustomer = $_GET['totalRows_OrderCustomer'];
} else {
  $all_OrderCustomer = mysql_query($query_OrderCustomer);
  $totalRows_OrderCustomer = mysql_num_rows($all_OrderCustomer);
}
$totalPages_OrderCustomer = ceil($totalRows_OrderCustomer/$maxRows_OrderCustomer)-1;

$queryString_OrderCustomer = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_OrderCustomer") == false && 
        stristr($param, "totalRows_OrderCustomer") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_OrderCustomer = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_OrderCustomer = sprintf("&totalRows_OrderCustomer=%d%s", $totalRows_OrderCustomer, $queryString_OrderCustomer);
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
	background-color:#3e3e3e;
}
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
</form>
<table border="1" align="center">
  <tr align="center">
    <td colspan="9" bgcolor="#FFCCFF">จำนวนคำสั่งซื้อ <?php echo $totalRows_OrderCustomer ?> รายการ</td>
  </tr>
  <tr align="center">
    <td bgcolor="#CCCCCC">orderNo</td>
    <td bgcolor="#CCCCCC">customerNo</td>
    <td bgcolor="#CCCCCC">itemNo</td>
    <td bgcolor="#CCCCCC">totalOrder</td>
    <td bgcolor="#CCCCCC">dateOrder</td>
    <td bgcolor="#CCCCCC">taxNo</td>
    <td bgcolor="#CCCCCC">branchNo</td>
    <td bgcolor="#FF9900">แก้ไขข้อมูล</td>
    <td bgcolor="#CC3300">ลบข้อมูล</td>
  </tr>
  <?php do { ?>
    <tr>
      <td bgcolor="#FFFFFF"><?php echo $row_OrderCustomer['orderNo']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_OrderCustomer['customerNo']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_OrderCustomer['itemNo']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_OrderCustomer['totalOrder']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_OrderCustomer['dateOrder']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_OrderCustomer['taxNo']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_OrderCustomer['branchNo']; ?></td>
      <td align="center" bgcolor="#FFCC99"><a href="cus_editOrder.php?orderNo=<?php echo $row_OrderCustomer['orderNo']; ?>">Edit</a></td>
      <td align="center" bgcolor="#FF6666"><form id="form2" name="form2" method="post" action="">
        <input type="submit" name="Delete" id="Delete" value="Delete" />
        <input name="orderNo" type="hidden" id="orderNo" value="<?php echo $row_OrderCustomer['orderNo']; ?>" />
      </form></td>
    </tr>
    <?php } while ($row_OrderCustomer = mysql_fetch_assoc($OrderCustomer)); ?>
</table>
<p>&nbsp;
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_OrderCustomer > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_OrderCustomer=%d%s", $currentPage, 0, $queryString_OrderCustomer); ?>"><img src="First.gif" /></a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_OrderCustomer > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_OrderCustomer=%d%s", $currentPage, max(0, $pageNum_OrderCustomer - 1), $queryString_OrderCustomer); ?>"><img src="Previous.gif" /></a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_OrderCustomer < $totalPages_OrderCustomer) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_OrderCustomer=%d%s", $currentPage, min($totalPages_OrderCustomer, $pageNum_OrderCustomer + 1), $queryString_OrderCustomer); ?>"><img src="Next.gif" /></a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_OrderCustomer < $totalPages_OrderCustomer) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_OrderCustomer=%d%s", $currentPage, $totalPages_OrderCustomer, $queryString_OrderCustomer); ?>"><img src="Last.gif" /></a>
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
mysql_free_result($OrderCustomer);
?>
