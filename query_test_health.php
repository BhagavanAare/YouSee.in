<?

// test query
$query = "SELECT
          date_format(call_date,'%d-%b-%Y') \"Call Date\",
          equipment_location \"Equipment Location\",
          equipment_problem \"Problem\",
          service_provider \"Service Provider\",
          service_person \"Service Person\",
          date_format(service_date,'%d-%b-%Y') \"Service Date\",
          problem_status \"Status\",
          date_format(resolution_date,'%d-%b-%Y') \"Resolution Date\"
          FROM service_records
          WHERE asset_number=\"3\" AND hospital_id=1";

//connect to database
include("connect_activity.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$rows = mysql_num_rows($result);

//dispaly data in a table
include 'display_table_health.php';

?>