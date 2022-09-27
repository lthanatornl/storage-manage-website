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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE staff SET fname=%s, lname=%s, phoneNo=%s, dob=%s, email=%s, address=%s, branchNo=%s, salary=%s WHERE staffNo=%s",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['phoneNo'], "text"),
                       GetSQLValueString($_POST['dob'], "date"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['branchNo'], "int"),
                       GetSQLValueString($_POST['salary'], "int"),
                       GetSQLValueString($_POST['staffNo'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($updateSQL, $shoethai) or die(mysql_error());

  $updateGoTo = "staff_show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_EditStaff = "-1";
if (isset($_GET['staffNo'])) {
  $colname_EditStaff = $_GET['staffNo'];
}
mysql_select_db($database_shoethai, $shoethai);
$query_EditStaff = sprintf("SELECT * FROM staff WHERE staffNo = %s", GetSQLValueString($colname_EditStaff, "int"));
$EditStaff = mysql_query($query_EditStaff, $shoethai) or die(mysql_error());
$row_EditStaff = mysql_fetch_assoc($EditStaff);
$totalRows_EditStaff = mysql_num_rows($EditStaff);
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
	top: 711px;
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
  <table width="808" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="45" colspan="4" align="center" bgcolor="#00CCCC">Editing Staff </td>
    </tr>
    <tr>
      <td width="188" bgcolor="#CCCCCC">&nbsp;</td>
      <td width="181" align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td width="155" bgcolor="#CCCCCC">&nbsp;</td>
      <td width="284" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">ID&nbsp; &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><?php echo $row_EditStaff['staffNo']; ?></td>
      <td align="right" bgcolor="#CCCCCC"><label for="idNo">Position&nbsp; &nbsp;</label></td>
      <td bgcolor="#CCCCCC"><?php echo $row_EditStaff['position']; ?></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">First Name&nbsp; &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><label for="fname2"></label>
      <input name="fname" type="text" id="fname2" value="<?php echo $row_EditStaff['fname']; ?>" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="fname">Last Name&nbsp; &nbsp;</label></td>
      <td bgcolor="#CCCCCC"><label for="lname2"></label>
      <input name="lname" type="text" id="lname2" value="<?php echo $row_EditStaff['lname']; ?>" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">Date Of Birth &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><label for="dob2"></label>
      <input name="dob" type="text" id="dob2" value="<?php echo $row_EditStaff['dob']; ?>" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="lname"></label>
        Age&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCCC"><?php echo $row_EditStaff['age']; ?></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp; &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">Phone Number&nbsp; </td>
      <td align="left" bgcolor="#CCCCCC"><label for="phoneNo2"></label>
      <input name="phoneNo" type="text" id="phoneNo2" value="<?php echo $row_EditStaff['phoneNo']; ?>" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="dob">E-Mail&nbsp; </label></td>
      <td bgcolor="#CCCCCC"><label for="email"></label>
      <input name="email" type="text" id="email" value="<?php echo $row_EditStaff['email']; ?>" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">Address &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><label for="address2"></label>
      <input name="address" type="text" id="address2" value="<?php echo $row_EditStaff['address']; ?>" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="age"></label>
        Branch Number&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCCC"><label for="branchNo2"></label>
      <input name="branchNo" type="text" id="branchNo2" value="<?php echo $row_EditStaff['branchNo']; ?>" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">Date Of Start&nbsp;&nbsp;&nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><?php echo $row_EditStaff['startDateYYMMDD']; ?></td>
      <td align="right" bgcolor="#CCCCCC"><label for="address">Salary&nbsp; &nbsp;</label></td>
      <td bgcolor="#CCCCCC"><label for="salary"></label>
      <input name="salary" type="text" id="salary" value="<?php echo $row_EditStaff['salary']; ?>" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC"><em>(YY-MM-DD)&nbsp; </em></td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><input name="staffNo" type="hidden" id="staffNo" value="<?php echo $row_EditStaff['staffNo']; ?>" /></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;    &nbsp;  &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;                                              &nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;</p></td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><input type="submit" name="Save" id="Save" value="Save" /></td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="right"><p>&nbsp;&nbsp;</p></td>
    </tr>
    <tr>
      <td height="70" colspan="4" align="right"><p>หมายเหตุ: Position ใส่เลข <em>1 หมายถึง พนักงานทั่วไป </em></p>
        <p><em>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;           &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;            &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;            &nbsp;      &nbsp;          &nbsp;        &nbsp;      &nbsp;&nbsp;&nbsp;  &nbsp;  &nbsp;    &nbsp;&nbsp;                                                                &nbsp;&nbsp;  &nbsp;  &nbsp;                                               &nbsp;&nbsp;&nbsp;                                                            &nbsp;              &nbsp;     &nbsp;         &nbsp;    &nbsp;&nbsp;                                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                 &nbsp;      &nbsp;    &nbsp;  &nbsp;      &nbsp;        &nbsp;  &nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;      &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2&nbsp; หมายถึง ผู้ช่วยผู้จัดการ</em></p>
        <p><em>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;  &nbsp;    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                                                        &nbsp;&nbsp;&nbsp;          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3&nbsp; หมายถึง ผู้จัดการ</em></p></td>
    </tr>
    <tr>
      <td height="70" colspan="4" align="right">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
</form>
<a href="indexforassistantmanagers.php">
<button class="bt0">Back</button>
</a>
</body>
</html>
<?php
mysql_free_result($EditStaff);
?>
