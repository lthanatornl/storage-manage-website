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
  $insertSQL = sprintf("INSERT INTO staff (staffNo, fname, lname, phoneNo, dob, age, email, address, startDateYYMMDD, branchNo, salary, `position`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['staffNo'], "int"),
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['phoneNo'], "text"),
                       GetSQLValueString($_POST['dob'], "date"),
                       GetSQLValueString($_POST['age'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['startDateYYMMDD'], "date"),
                       GetSQLValueString($_POST['branchNo'], "int"),
                       GetSQLValueString($_POST['salary'], "int"),
                       GetSQLValueString($_POST['position'], "int"));

  mysql_select_db($database_shoethai, $shoethai);
  $Result1 = mysql_query($insertSQL, $shoethai) or die(mysql_error());

  $insertGoTo = "staff_show.php";
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
<form action="<?php echo $editFormAction; ?><?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  &nbsp; 
            &nbsp; 
               &nbsp; 
               &nbsp; 
               &nbsp; 
                    &nbsp; 
                         &nbsp; 
                               &nbsp; 
                                      &nbsp; 
                                      &nbsp; 
                                      &nbsp; 
                                      &nbsp; 
                                             &nbsp; 
                                                       &nbsp; 
                                                                         &nbsp;
                                                                         <table width="808" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="45" colspan="4" align="center" bgcolor="#00CCCC">Staff Register</td>
    </tr>
    <tr>
      <td width="188" bgcolor="#CCCCCC">&nbsp;</td>
      <td width="181" align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td width="155" bgcolor="#CCCCCC">&nbsp;</td>
      <td width="284" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">ID&nbsp; &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><label for="staffNo"></label>
        <label for="staffNo2"></label>
      <input type="text" name="staffNo" id="staffNo2" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="staffNo">Position&nbsp; &nbsp;</label></td>
      <td bgcolor="#CCCCCC"><input type="text" name="position" id="position" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">First Name&nbsp; &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><input type="text" name="fname" id="fname" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="fname">Last Name&nbsp; &nbsp;</label></td>
      <td bgcolor="#CCCCCC"><input type="text" name="lname" id="lname" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp; </td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">Date Of Birth &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><input type="text" name="dob" id="dob" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="lname"></label>
      Age&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCCC"><input type="text" name="age" id="age" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp; &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">Phone Number&nbsp; </td>
      <td align="left" bgcolor="#CCCCCC"><input type="text" name="phoneNo" id="phoneNo" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="dob">E-Mail&nbsp; </label></td>
      <td bgcolor="#CCCCCC"><input type="text" name="email" id="email" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp; </td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">Address &nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><input type="text" name="address" id="address" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="age"></label>
      Branch Number&nbsp; &nbsp;</td>
      <td bgcolor="#CCCCCC"><input type="text" name="branchNo" id="branchNo" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="left" bgcolor="#CCCCCC">&nbsp;</td>
      <td align="right" bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC">Date Of Start&nbsp;&nbsp;&nbsp;</td>
      <td align="left" bgcolor="#CCCCCC"><input type="text" name="startDateYYMMDD" id="startDateYYMMDD" /></td>
      <td align="right" bgcolor="#CCCCCC"><label for="address">Salary&nbsp; &nbsp;</label></td>
      <td bgcolor="#CCCCCC"><input type="text" name="salary" id="salary" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#CCCCCC"><em>(YY-MM-DD)&nbsp; </em></td>
      <td align="left" bgcolor="#CCCCCC">&nbsp; </td>
      <td align="right" bgcolor="#CCCCCC">&nbsp; </td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;    &nbsp;  &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;                                              &nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;</p></td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><input type="submit" name="Save" id="Save" value="Submit" /></td>
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
    <tr></tr>
  </table>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;                                &nbsp;&nbsp;&nbsp;                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                &nbsp;&nbsp;&nbsp;&nbsp;            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp; &nbsp;                                                 &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; </p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<a href="Indexformanagers.php">
<button class="bt0">Back</button>
</a>
</body>
</html>