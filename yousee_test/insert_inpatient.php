<html>
<head>
</head>

<body>
<form action="insert_inpatient.php" method="post">
IP_No: <input type="text" name="ip_no"><br/>
Admit_Date: <input type="text" name="admit_date"><br/>
Gender: <input type="text" name="gender"><br/>
Mother_Name: <input type="text" name="mother_name"><br/>
District: <input type="text" name="district"><br/>
Dellivery_Location: <input type="text" name="delivery_location"><br/>
<input type="submit" name="submit"><br/>
</form>

<?php
if (isset($_POST['submit'])){

 //connect to database
 include("db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");

 $sql = "INSERT INTO in_patients(ip_no, admit_date, gender, mother_name, district, delivery_location) VALUES ('$_POST[ip_no]', '$_POST[admit_date]', '$_POST[gender]', '$_POST[mother_name]', '$_POST[district]', '$_POST[delivery_location]')";

 mysql_query($sql);
}
?>

</body>
</html>
