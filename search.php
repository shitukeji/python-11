<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<?php
echo '
<form name="SubmitForm" method="post" onSubmit="return InputCheck(this)">
<p>
<input type="submit" name="submit_back" value="  返 回  " style="width:80px;"/>
</p>
</form>
';

if($_POST['submit_back'])
	{
		 header("Location:index.php");
	}
echo '
<fieldset>
<legend>查询</legend>
';
search_status("web");
search_status("job");
search_status("service");
echo '
</fieldset>
';





################################# search status ##########################################
function search_status($uitemtype)
{
$mysql_server_name="101.251.215.31:3306";
$mysql_username="deploy";  
$mysql_password="ncpwd"; 
$mysql_db="deploy";
$mysql_table=$uitemtype;
$con=mysql_connect($mysql_server_name,$mysql_username,$mysql_password);  
if (!$con)
  {
  echo "<script language=\"JavaScript\">alert(\"连接Mysql数据库超时，请稍后重试！\");</script>";
//  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($mysql_db, $con);
$sql = mysql_query("SELECT * FROM $mysql_table");

echo "<table style='margin:0 50px 0 0;float:left;' border='1' align='left'>
<tr align='center' valign='middle'>
<th>项目IP</th>
<th>项目类型</th>
<th>项目名称</th>
<th>项目状态</th>
<th>最后部署时间</th>
</tr>";

while($row = mysql_fetch_array($sql))
  {
  echo "<tr align='center' valign='middle'>";
  echo "<td>" . $row['mitemip'] . "</td>";
  echo "<td>" . $row['mitemtype'] . "</td>";
  echo "<td>" . $row['mitemname'] . "</td>";
  if($row['mitemstatus']=='1')
	  {
		echo "<td bgcolor='#FF0000'>". "deploying" ."</td>";
      }
  else
	  {
    	echo "<td bgcolor='#00FF00'>". "running" ."</td>";
	  }
  echo "<td>" . $row['mitemdate'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
mysql_close($con);
}
?>
