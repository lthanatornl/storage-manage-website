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

if ((isset($_POST['lotNo'])) && ($_POST['lotNo'] != "")) {
  $deleteSQL = sprintf("DELETE FROM orderbranch WHERE lotNo=%s",
                       GetSQLValueString($_POST['lotNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($deleteSQL, $shoethai) or die(mysql_error());

  $deleteGoTo = "branch_ShowOrder.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_ShowBranchOrder = 10;
$pageNum_ShowBranchOrder = 0;
if (isset($_GET['pageNum_ShowBranchOrder'])) {
  $pageNum_ShowBranchOrder = $_GET['pageNum_ShowBranchOrder'];
}
$startRow_ShowBranchOrder = $pageNum_ShowBranchOrder * $maxRows_ShowBranchOrder;

mysql_select_db($database_shoethai, $shoethai);
$query_ShowBranchOrder = "SELECT * FROM orderbranch ORDER BY dateOrderbranch ASC";
$query_limit_ShowBranchOrder = sprintf("%s LIMIT %d, %d", $query_ShowBranchOrder, $startRow_ShowBranchOrder, $maxRows_ShowBranchOrder);
$ShowBranchOrder = mysql_query($query_limit_ShowBranchOrder, $shoethai) or die(mysql_error());
$row_ShowBranchOrder = mysql_fetch_assoc($ShowBranchOrder);

if (isset($_GET['totalRows_ShowBranchOrder'])) {
  $totalRows_ShowBranchOrder = $_GET['totalRows_ShowBranchOrder'];
} else {
  $all_ShowBranchOrder = mysql_query($query_ShowBranchOrder);
  $totalRows_ShowBranchOrder = mysql_num_rows($all_ShowBranchOrder);
}
$totalPages_ShowBranchOrder = ceil($totalRows_ShowBranchOrder/$maxRows_ShowBranchOrder)-1;
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
  <tr>
    <td colspan="8" align="center" bgcolor="#99CC66">สาขามีทั้งหมด <?php echo $totalRows_ShowBranchOrder ?> รายการ</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">lotNo</td>
    <td bgcolor="#CCCCCC">itemNo</td>
    <td bgcolor="#CCCCCC">total</td>
    <td bgcolor="#CCCCCC">priceOrderbranch</td>
    <td bgcolor="#CCCCCC">dateOrderbranch</td>
    <td bgcolor="#CCCCCC">staff</td>
    <td bgcolor="#FF9900">แก้ไขข้อมูล</td>
    <td bgcolor="#CC3300">ลบข้อมูล</td>
  </tr>
  <?php do { ?>
    <tr>
      <td bgcolor="#FFFFFF"><?php echo $row_ShowBranchOrder['lotNo']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_ShowBranchOrder['itemNo']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_ShowBranchOrder['total']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_ShowBranchOrder['priceOrderbranch']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_ShowBranchOrder['dateOrderbranch']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $row_ShowBranchOrder['staff']; ?></td>
      <td align="center" bgcolor="#FFCC99"><a href="branch_editOrder.php?lotNo=<?php echo $row_ShowBranchOrder['lotNo']; ?>">Edit</a></td>
      <td align="center" bgcolor="#FF6666"><form id="form2" name="form2" method="post" action="">
        <input type="submit" name="Delete" id="Delete" value="Delete" />
        <input name="lotNo" type="hidden" id="lotNo" value="<?php echo $row_ShowBranchOrder['lotNo']; ?>" />
      </form></td>
    </tr>
    <?php } while ($row_ShowBranchOrder = mysql_fetch_assoc($ShowBranchOrder)); ?>
</table>
<a href="Indexformanagers.php">
<button class="bt0">Back</button>
</a>
</body>
</html>
<?php
mysql_free_result($ShowBranchOrder);
?>
