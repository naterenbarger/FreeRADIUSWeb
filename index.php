<?php 
include './config/config.php';
include './config/opendb.php';
$post="index.php";

if (!isset($_POST['submit']))
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dli">
<html>
  <head>
    <title>Radius Log</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="config/datepick.js"></script>
  </head>
  <body>
    <h1> Radius Log </h1>
<form method="post" action="<?php echo $post; ?>">
Start Date (yyyy-mm-dd): <input type="text" name="sdate"><input type=button value="select" onclick="displayDatePicker('sdate', false, 'ymd', '-');"><input type="submit" name="submit" value="Submit">
</form><br>
<br>
    <table class="table">
      <tr>
        <th class="date">Date</th>
        <th class="user">User</th>
        <th class="reply">Reply</th>
        <th class="group">Group</th>
        <th class="source">Source</th>
        <th class="agent">Agent</th>
        <th class="nas">NAS</th>
        <th class="nasid">NAS ID</th>
      </tr>
<?php

if (isset($_REQUEST['user'])) {
  $query="SELECT * FROM radpostauth WHERE user=\"".$_REQUEST['user']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['reply'])) {
  $query="SELECT * FROM radpostauth WHERE reply=\"".$_REQUEST['reply']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['group'])) {
  $query="SELECT * FROM radpostauth WHERE ugroup=\"".$_REQUEST['group']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['source'])) {
  $query="SELECT * FROM radpostauth WHERE source=\"".$_REQUEST['source']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['agent'])) {
  $query="SELECT * FROM radpostauth WHERE agent=\"".$_REQUEST['agent']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['nas'])) {
  $query="SELECT * FROM radpostauth WHERE nas=\"".$_REQUEST['nas']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['nasid'])) {
  $query="SELECT * FROM radpostauth WHERE nasid=\"".$_REQUEST['nasid']."\" ORDER BY date DESC ";
}

else {
  $query  = "SELECT * FROM radpostauth WHERE date > DATE_ADD(NOW(), INTERVAL -10 MINUTE) ORDER BY date DESC ";
}

    $result = mysql_query($query);

    if ($result == false)
      die('Error, no data found');

    while($row = mysql_fetch_array($result, MYSQL_ASSOC))
    {
      echo "      <tr>\n";
      echo "        <td class=\"date\">".$row["date"]."</td>\n";
      echo "        <td class=\"user\"><a href=index.php?user=".$row["user"].">".$row["user"]."</a></td>\n";
      echo "        <td class=\"reply\"><a href=index.php?reply=".$row["reply"].">".$row["reply"]."</a></td>\n";
      echo "        <td class=\"group\"><a href=index.php?group=".$row["ugroup"].">".$row["ugroup"]."</a></td>\n";
      echo "        <td class=\"source\"><a href=index.php?source=".$row["source"].">".$row["source"]."</a></td>\n";
      echo "        <td class=\"agent\"><a href=index.php?agent=".$row["agent"].">".$row["agent"]."</a></td>\n";
      echo "        <td class=\"nas\"><a href=index.php?nas=".$row["nas"].">".$row["nas"]."</a></td>\n";
      echo "        <td class=\"nasid\"><a href=index.php?nasid=".$row["nasid"].">".$row["nasid"]."</a></td>\n";
      echo "      </tr>\n";
    } // end of while

?>
    </table>
  </body>
</html>

<?php

} else {
$sdate = $_POST["sdate"];
//$edate = $_POST["edate"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dli">
<html>
  <head>
    <title>Radius Log</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="config/datepick.js"></script>
  </head>
  <body>
    <h1> Radius Log </h1>
<form method="post" action="<?php echo $post;?>">
Start Date (yyyy-mm-dd): <input type="text" name="sdate"><input type=button value="select" onclick="displayDatePicker('sdate', false, 'ymd', '-');"><input type="submit" name="submit" value="Submit">
</form>
<br>
<br>
    <table class="table">
      <tr>
        <th class="date">Date</th>
        <th class="user">User</th>
        <th class="reply">Reply</th>
        <th class="group">Group</th>
        <th class="source">Source</th>
        <th class="agent">Agent</th>
        <th class="nas">NAS</th>
        <th class="nasid">NAS ID</th>
      </tr>
<?php

if (isset($_REQUEST['user'])) {
  $query="SELECT * FROM radpostauth WHERE user=\"".$_REQUEST['user']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['reply'])) {
  $query="SELECT * FROM radpostauth WHERE reply=\"".$_REQUEST['reply']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['group'])) {
  $query="SELECT * FROM radpostauth WHERE ugroup=\"".$_REQUEST['group']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['source'])) {
  $query="SELECT * FROM radpostauth WHERE source=\"".$_REQUEST['source']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['agent'])) {
  $query="SELECT * FROM radpostauth WHERE agent=\"".$_REQUEST['agent']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['nas'])) {
  $query="SELECT * FROM radpostauth WHERE nas=\"".$_REQUEST['nas']."\" ORDER BY date DESC ";
}

elseif (isset($_REQUEST['nasid'])) {
  $query="SELECT * FROM radpostauth WHERE nasid=\"".$_REQUEST['nasid']."\" ORDER BY date DESC ";
}

else {
  $query  = "SELECT * FROM radpostauth WHERE date LIKE \"".$sdate."%\" ORDER BY date DESC ";
}

    $result = mysql_query($query);

    if ($result == false)
      die('Error, no data found');

    while($row = mysql_fetch_array($result, MYSQL_ASSOC))
    {
      echo "      <tr>\n";
      echo "        <td class=\"date\">".$row["date"]."</td>\n";
      echo "        <td class=\"user\"><a href=index.php?user=".$row["user"].">".$row["user"]."</a></td>\n";
      echo "        <td class=\"reply\"><a href=index.php?reply=".$row["reply"].">".$row["reply"]."</a></td>\n";
      echo "        <td class=\"group\"><a href=index.php?group=".$row["ugroup"].">".$row["ugroup"]."</a></td>\n";
      echo "        <td class=\"source\"><a href=index.php?source=".$row["source"].">".$row["source"]."</a></td>\n";
      echo "        <td class=\"agent\"><a href=index.php?agent=".$row["agent"].">".$row["agent"]."</a></td>\n";
      echo "        <td class=\"nas\"><a href=index.php?nas=".$row["nas"].">".$row["nas"]."</a></td>\n";
      echo "        <td class=\"nasid\"><a href=index.php?nasid=".$row["nasid"].">".$row["nasid"]."</a></td>\n";
      echo "      </tr>\n";
    } // end of while

?>
    </table>
  </body>
</html>

<?php

}
include './config/closedb.php';
?>