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

if ((isset($_POST['staffNo'])) && ($_POST['staffNo'] != "")) {
  $deleteSQL = sprintf("DELETE FROM staff WHERE staffNo=%s",
                       GetSQLValueString($_POST['staffNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($deleteSQL, $shoethai) or die(mysql_error());

  $deleteGoTo = "staff_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_showStaff = 10;
$pageNum_showStaff = 0;
if (isset($_GET['pageNum_showStaff'])) {
  $pageNum_showStaff = $_GET['pageNum_showStaff'];
}
$startRow_showStaff = $pageNum_showStaff * $maxRows_showStaff;

mysql_select_db($database_shoethai, $shoethai);
$query_showStaff = "SELECT * FROM staff ORDER BY `position` DESC";
$query_limit_showStaff = sprintf("%s LIMIT %d, %d", $query_showStaff, $startRow_showStaff, $maxRows_showStaff);
$showStaff = mysql_query($query_limit_showStaff, $shoethai) or die(mysql_error());
$row_showStaff = mysql_fetch_assoc($showStaff);

if (isset($_GET['totalRows_showStaff'])) {
  $totalRows_showStaff = $_GET['totalRows_showStaff'];
} else {
  $all_showStaff = mysql_query($query_showStaff);
  $totalRows_showStaff = mysql_num_rows($all_showStaff);
}
$totalPages_showStaff = ceil($totalRows_showStaff/$maxRows_showStaff)-1;

$queryString_showStaff = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_showStaff") == false && 
        stristr($param, "totalRows_showStaff") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_showStaff = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_showStaff = sprintf("&totalRows_showStaff=%d%s", $totalRows_showStaff, $queryString_showStaff);

$query_ShowStaff = "SELECT * FROM staff ORDER BY `position` DESC";
$ShowStaff = mysql_query($query_ShowStaff, $shoethai) or die(mysql_error());
$row_ShowStaff = mysql_fetch_assoc($ShowStaff);
$totalRows_ShowStaff = mysql_num_rows($ShowStaff);
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
	
  }
.bt0:hover{
	background-color:white;
}
body{
	background-color: #3e3e3e;
}
</style>
<body marginheight="20">
<form id="form1" name="form1" method="post" action="">
</form>
<table border="1" align="center">
  <tr>
    <td colspan="14" align="center" bgcolor="#99CC99">พนักงานมีจำนวนทั้งหมด <?php echo $totalRows_showStaff ?>&nbsp;คน</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">staffNo</td>
    <td bgcolor="#CCCCCC">fname</td>
    <td bgcolor="#CCCCCC">lname</td>
    <td bgcolor="#CCCCCC">phoneNo</td>
    <td bgcolor="#CCCCCC">dob</td>
    <td bgcolor="#CCCCCC">age</td>
    <td bgcolor="#CCCCCC">email</td>
    <td bgcolor="#CCCCCC">address</td>
    <td bgcolor="#CCCCCC">startDateYYMMDD</td>
    <td bgcolor="#CCCCCC">branchNo</td>
    <td bgcolor="#CCCCCC">salary</td>
    <td bgcolor="#CCCCCC">position</td>
    <td bgcolor="#FF9900">แก้ไขข้อมูล</td>
    <td bgcolor="#CC3300">ลบข้อมูล</td>
  </tr>
  <?php do { ?>
    <tr>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['staffNo']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['fname']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['lname']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['phoneNo']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['dob']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['age']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['email']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['address']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['startDateYYMMDD']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['branchNo']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['salary']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_showStaff['position']; ?></td>
      <td align="center" bgcolor="#FFCC99"><a href="staff_edit.php?staffNo=<?php echo $row_showStaff['staffNo']; ?>">Edit</a></td>
      <td align="center" bgcolor="#FF6666"><form id="form2" name="form2" method="post" action="">
        <input type="submit" name="Delete" id="Delete" value="Delete" />
        <input name="staffNo" type="hidden" id="staffNo" value="<?php echo $row_showStaff['staffNo']; ?>" />
      </form></td>
    </tr>
    <?php } while ($row_showStaff = mysql_fetch_assoc($showStaff)); ?>
</table>
<p><strong>หมายเหตุ</strong>:&nbsp;&nbsp;Position ที่&nbsp;&nbsp;&nbsp;&nbsp; <em>1 หมายถึง พนักงานทั่วไป </em></p>
<p><em>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp; 2&nbsp; หมายถึง ผู้ช่วยผู้จัดการ</em></p>
<p><em>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;  &nbsp;    &nbsp;&nbsp;&nbsp;&nbsp; 3&nbsp; หมายถึง ผู้จัดการ</em></p>
<p>&nbsp;
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_showStaff > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_showStaff=%d%s", $currentPage, 0, $queryString_showStaff); ?>"><img src="First.gif" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_showStaff > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_showStaff=%d%s", $currentPage, max(0, $pageNum_showStaff - 1), $queryString_showStaff); ?>"><img src="Previous.gif" /></a>
    <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_showStaff < $totalPages_showStaff) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_showStaff=%d%s", $currentPage, min($totalPages_showStaff, $pageNum_showStaff + 1), $queryString_showStaff); ?>"><img src="Next.gif" /></a>
    <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_showStaff < $totalPages_showStaff) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_showStaff=%d%s", $currentPage, $totalPages_showStaff, $queryString_showStaff); ?>"><img src="Last.gif" /></a>
    <?php } // Show if not last page ?></td>
  </tr>
</table>
</p>
</body>
<a href="indexforgeneralstaffs.php">
<button class="bt0">Back</button>
</a>
</html>
<?php
mysql_free_result($showStaff);
?>
