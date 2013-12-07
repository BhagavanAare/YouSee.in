<?php 
$dbhost = "205.178.146.91";
$dbuser = "ucdbuser";
$dbpass = "Only4yousee";
$dbdatabase = "ucdblive";
backup_tables($dbhost,$dbuser,$dbpass,$dbdatabase);

$dbhost = "205.178.146.110";
$dbuser = "youseedb1";
$dbpass = "volunteeR1";
$dbdatabase = "ucactivity";
backup_tables($dbhost,$dbuser,$dbpass,$dbdatabase);

$dbhost = "205.178.146.112";
$dbuser = "wastedonor";
$dbpass = "wasteDonor2";
$dbdatabase = "yousee";
backup_tables($dbhost,$dbuser,$dbpass,$dbdatabase);


/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
  
  $link = mysql_connect($host,$user,$pass);
  mysql_select_db($name,$link);
  echo "Starting to backup Database : ".$name."<br>";  
  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysql_query('SHOW TABLES');
    while($row = mysql_fetch_row($result))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
  
  //cycle through
  foreach($tables as $table)
  {
    echo "Starting to backup table : ".$table."<br>";	
    $result = mysql_query('SELECT * FROM '.$table);
    $num_fields = mysql_num_fields($result);
    
    $return.= 'DROP TABLE IF EXISTS '.$table.';';
    $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";
    
    for ($i = 0; $i < $num_fields; $i++) 
    {
      while($row = mysql_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }
    $return.="\n\n\n";
  }
  
  //save file
  $filename = 'db-backup-'.time().'-'.$name.'-'.(md5(implode(',',$tables))).'.sql';	
  $handle = fopen($filename,'w+');
  fwrite($handle,$return);
  fclose($handle);
  echo "Backed up Database ".$name." to ".$filename." successfully<br>";	
}
?>
