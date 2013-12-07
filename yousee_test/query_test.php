<?

//query for retreving all postpay donations
$query = "SELECT
          department,
          MAX(num_equipment) max_equipment
          FROM
          (SELECT
          department,
          COUNT(equipment) num_equipment
          FROM equipments
          WHERE equipment=\"Ventilator\" AND hospital_id=1
          GROUP BY department
          ORDER BY department)INFO";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$rows = mysql_num_rows($result);

//dispaly data in a table
include 'display_table.php';

?>