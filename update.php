<?php 

if (!isset($_REQUEST['list'])) 
  die ('<b>No List Information Provided</b>');

$list = $_REQUEST['list'];

if (!isset($_REQUEST['ip'])) 
  die ('<b>No IP Address Provided</b>');

$updateip = $_REQUEST['ip'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<TITLE>IP Address Lists</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="ips_div.css">
<script src="js/m.js" type="text/javascript"></script></head>
<body>
<div id="main">
  <div class="title_top">
    <div class="title_text">
      <h1>IP Lists</h1>
    </div>
  </div>
  <div id="menu">
    <dl>
      <dt onMouseOver="javascript:montre();"><a href="index.php">Home</a></dt>
    </dl>
    <dl>
      <dt onMouseOver="javascript:montre('smenu2');"><a class="default_cursor" href="#">IP Address Lists</a></dt>
      <dd id="smenu2">
        <ul>
          <li><a href="index.php?list=servers" title="Server IP Range">Server IP List</a></li>
          <li><a href="index.php?list=vpn" title="VPN IP Range">VPN IP List</a></li>
          <li><a href="index.php?list=outside" title="Outside IP Range">Outside IP List</a></li>
          <li><a href="index.php?list=vendors" title="Vendors IP Range">Vendors IP List</a></li>
        </ul>
      </dd>
    </dl>
  </div>

  <div class="text">

    <div id="main_content">
      <div class="proxylist">
        <div class="left"> </div>
        <div class="title">Update</div>
        <div class="right"></div>
        <div class="box_text">

<table class="tablelist" style="font-size:1.1em" border="0" align="center" cellpadding="0" cellspacing="0" width="97%">

<?php
include './config/config_upd.php';
include './config/opendb.php';

// Server List Update Section

if ( $list == "servers" ) {
  
    $query  = 'SELECT ip_address, hostname, in_use FROM server_ips WHERE ip_address = "'.$updateip.'"';
    $result = mysql_query($query);

    if ($result == false)
      die('Error, no data found');

    while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

      $inuse = $row["in_use"];
      $hostname = $row["hostname"];
      
    } // end of while

    if (!isset($_POST['submit'])) {
      echo "<h2>Update Information for $updateip</h2>";
      ?>

      <form method="post" action="<?php echo 'update.php?list=servers&ip='.$updateip ?>">
        <input type="hidden" name="updateip" value="<?php echo $updateip; ?>">
          Hostname:  
        <input type="text" size="80" maxlen="80" name="upd_hostname" value="<?php echo $hostname; ?>">
        <br />
          In Use:
        <?php
        if ( $inuse == "1" ) {
          echo '<input type="checkbox" name="upd_inuse" value="1" checked>';
        } else {
          echo '<input type="checkbox" name="upd_inuse" value="1">';
        }
        ?>
        <br />
        <br />
        <input type="submit" name="submit" value="Update">
      </form>
      <br />
      <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><input type="button" name="cancel" value="Cancel" /></a>


    <?php
    } else {

      $upd_hostname = $_POST["upd_hostname"];
      $updateip = $_POST["updateip"];
      if (!isset($_POST['upd_inuse'])) {
        $_POST["upd_inuse"] = "0";
      }
      $inuse = $_POST["upd_inuse"];

      $query = 'UPDATE server_ips SET hostname = "'.$upd_hostname.'", in_use = "'.$inuse.'" WHERE ip_address="'.$updateip.'"';
      $result = mysql_query($query);

      if ($result == false)
        die('Error, update query failed' . mysql_error());

      echo "<h2>Information Successfully Updated for ".$updateip."</h2>\n";
      echo '<a class="list_sorted"'." href=index.php?list=servers#".$updateip."><strong>Return to list</strong></a>\n";

    }
  
// VPN List Update Section //

} else if ( $list == "vpn" ) {
  
    $query  = 'SELECT ip_address, username FROM vpn_ips WHERE ip_address = "'.$updateip.'"';
    $result = mysql_query($query);

    if ($result == false)
      die('Error, no data found');

    while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

      $username = $row["username"];

    } // end of while

    if (!isset($_POST['submit'])) {
      echo "<h2>Update Information for $updateip</h2>";
      ?>

      <form method="post" action="<?php echo 'update.php?list=vpn&ip='.$updateip ?>">
        <input type="hidden" name="updateip" value="<?php echo $updateip; ?>">
          Username:  
        <input type="text" size="80" maxlen="80" name="upd_username" value="<?php echo $username; ?>">
        <br />
        <br />
        <input type="submit" name="submit" value="Update">
      </form>
      <br />
      <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><input type="button" name="cancel" value="Cancel" /></a>


    <?php
    } else {

      $upd_username = $_POST["upd_username"];
      $updateip = $_POST["updateip"];

      $query = 'UPDATE vpn_ips SET username = "'.$upd_username.'" WHERE ip_address="'.$updateip.'"';
      $result = mysql_query($query);

      if ($result == false)
        die('Error, update query failed' . mysql_error());

      echo "<h2>Information Successfully Updated for ".$updateip."</h2>\n";
      echo '<a class="list_sorted"'." href=index.php?list=vpn#".$updateip."#".$updateip."><strong>Return to list</strong></a>\n";

    }

// Vendor List Update Section //

} else if ( $list == "vendors" ) {
  
    $query  = 'SELECT ip_address, location FROM vendor_ips WHERE ip_address = "'.$updateip.'"';
    $result = mysql_query($query);

    if ($result == false)
      die('Error, no data found');

    while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

      $location = $row["location"];

    } // end of while

    if (!isset($_POST['submit'])) {
      echo "<h2>Update Information for $updateip</h2>";
      ?>

      <form method="post" action="<?php echo 'update.php?list=vendors&ip='.$updateip ?>">
        <input type="hidden" name="updateip" value="<?php echo $updateip; ?>">
          Location:  
        <input type="text" size="80" maxlen="80" name="upd_location" value="<?php echo $location; ?>">
        <br />
        <br />
        <input type="submit" name="submit" value="Update">
      </form>
      <br />
      <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><input type="button" name="cancel" value="Cancel" /></a>


    <?php
    } else {

      $upd_location = $_POST["upd_location"];
      $updateip = $_POST["updateip"];

      $query = 'UPDATE vendor_ips SET location = "'.$upd_location.'" WHERE ip_address="'.$updateip.'"';
      $result = mysql_query($query);

      if ($result == false)
        die('Error, update query failed' . mysql_error());

      echo "<h2>Information Successfully Updated for ".$updateip."</h2>\n";
      echo '<a class="list_sorted"'." href=index.php?list=vendors#".$updateip."><strong>Return to list</strong></a>\n";

    }

// Outside IP List Update Section //

} else if ( $list == "outside" ) {
  
    $query  = 'SELECT outside_ip, inside_ip, name FROM outside_ips WHERE outside_ip = "'.$updateip.'"';
    $result = mysql_query($query);

    if ($result == false)
      die('Error, no data found');

    while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

      $insideip = $row["inside_ip"];
      $name = $row["name"];

    } // end of while

    if (!isset($_POST['submit'])) {
      echo "<h2>Update Information for $updateip</h2>";
      ?>

      <form method="post" action="<?php echo 'update.php?list=outside&ip='.$updateip ?>">
        <input type="hidden" name="updateip" value="<?php echo $updateip; ?>">
          Inside IP:  
        <input type="text" size="80" maxlen="80" name="upd_insideip" value="<?php echo $insideip; ?>">
        <br />
          Name:  
        <input type="text" size="80" maxlen="80" name="upd_name" value="<?php echo $name; ?>">
        <br />
        <br />
        <input type="submit" name="submit" value="Update">
      </form>
      <br />
      <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><input type="button" name="cancel" value="Cancel" /></a>


    <?php
    } else {

      $upd_insideip = $_POST["upd_insideip"];
      $upd_name = $_POST["upd_name"];
      $updateip = $_POST["updateip"];
      
      $iplong = ip2long($upd_insideip);

      $query = 'UPDATE outside_ips SET inside_ip = "'.$upd_insideip.'", inside_long = "'.$iplong.'", name = "'.$upd_name.'" WHERE outside_ip="'.$updateip.'"';
      
      $result = mysql_query($query);

      if ($result == false)
        die('Error, update query failed' . mysql_error());

      echo "<h2>Information Successfully Updated for ".$updateip."</h2>\n";
      echo '<a class="list_sorted"'." href=index.php?list=outside#".$updateip."><strong>Return to list</strong></a>\n";

    }
}


include './config/closedb.php';
?>

</table>

	    </div>
      </div>

    </div>
  </div>
</div>


</body>
</html>
