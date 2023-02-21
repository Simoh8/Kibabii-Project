<?php require_once('Connections/conn.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO schooldetails (schoolID, schoolname, address, logo, nearesttown) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['schoolID'], "text"),
                       GetSQLValueString($_POST['schoolname'], "text"),
                       GetSQLValueString($_POST['address'], "text"),
                       GetSQLValueString($_POST['logo'], "text"),
                       GetSQLValueString($_POST['nearesttown'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT * FROM schooldetails";
$Recordset1 = mysql_query($query_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>training</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="skyblue">
<center>
<table width="100%" border="0" bgcolor="gold">
  <tr>
    <td> <center>
      <img src="images/IMG-20210729-WA0003.jpg" width="100" height="110" />  <br/>
      KIBABII UNIVERSITY
       <hr color="cccccc" size="5" width="100%">
    </center> </td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td><ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="#">Home</a>        </li>
      <li><a href="#" title="click to order">Register</a></li>
      <li><a href="#" title="view available program" class="MenuBarItemSubmenu">Examination</a>
        <ul>
          <li><a class="MenuBarItemSubmenu" href="#">course </a>
            <ul>
              <li><a href="#">BIT 324</a></li>
              <li><a href="#">BIT 325</a></li>
            </ul>
          </li>
          <li><a href="#">performance</a></li>
          <li><a href="#">Untitled Item</a></li>
          <li><a href="#">provisional result</a></li>
        </ul>
      </li>
      <li><a href="#">FEES Statment</a></li>
      <li><a href="#">login</a></li>
      <li><a href="#">log out</a></li>
    </ul></td>
  </tr>
</table>
<table width="100%" border="0" bgcolor="#ffffff">
  <tr>
    <td height="400"> <center>
      <table border="1" align="center">
        <tr>
          <td>schoolID</td>
          <td>schoolname</td>
          <td>address</td>
          <td>logo</td>
          <td>nearesttown</td>
        </tr>
        <?php do { ?>
          <tr>
            <td><a href="ph.php?recordID=<?php echo $row_Recordset1['schoolID']; ?>"> <?php echo $row_Recordset1['schoolID']; ?>&nbsp; </a></td>
            <td><?php echo $row_Recordset1['schoolname']; ?>&nbsp; </td>
            <td><?php echo $row_Recordset1['address']; ?>&nbsp; </td>
            <td><?php echo $row_Recordset1['logo']; ?>&nbsp; </td>
            <td><?php echo $row_Recordset1['nearesttown']; ?>&nbsp; </td>
          </tr>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
      </table>
      <br />
      <?php echo $totalRows_Recordset1 ?> Records Total
    </center></td>
       <td height="400"><center>
         <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
           <table align="center">
             <tr valign="baseline">
               <td nowrap="nowrap" align="right">SchoolID:</td>
               <td><input type="text" name="schoolID" value="" size="32" /></td>
             </tr>
             <tr valign="baseline">
               <td nowrap="nowrap" align="right">Schoolname:</td>
               <td><input type="text" name="schoolname" value="" size="32" /></td>
             </tr>
             <tr valign="baseline">
               <td nowrap="nowrap" align="right">Address:</td>
               <td><input type="text" name="address" value="" size="32" /></td>
             </tr>
             <tr valign="baseline">
               <td nowrap="nowrap" align="right">Logo:</td>
               <td><input type="text" name="logo" value="" size="32" /></td>
             </tr>
             <tr valign="baseline">
               <td nowrap="nowrap" align="right">Nearesttown:</td>
               <td><input type="text" name="nearesttown" value="" size="32" /></td>
             </tr>
             <tr valign="baseline">
               <td nowrap="nowrap" align="right">&nbsp;</td>
               <td><input type="submit" value="Insert record" /></td>
             </tr>
           </table>
           <input type="hidden" name="MM_insert" value="form1" />
         </form>
         <p>&nbsp;</p>
      </center></td> 
  </tr>
</table>
<table width="100%" border="0"  bgcolor="gold" >
  <tr>
    <td> <center> &copy; COPYRIGHT 2021 INDUSTRIAL TRAINING. ALL RIGHTS RESERVED  </center> </td> 
  </tr>
</table>
</center>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
