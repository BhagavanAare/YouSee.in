<?

//query for retreving all postpay donations
$query = "SELECT                             
         postpay_certificate_id \"Certificate ID\",
         certificate_id \"Project Phase ID\",
         date_format(payment_date,'%d-%b-%Y') \"Donation Date\",
         displayname \"Donor Name\",
         FORMAT(amount_for_project+amount_for_operations_grant,0) \"Total Donation (in INR)\",
         FORMAT(amount_for_project,0) \"For Project (in INR)\",
         FORMAT(amount_for_operations_grant,0) \"For Operations (in INR)\",
         village_town \"Donor Location\",
         location \" Project Location\",
         project_title \"Project\",
         name \"Project Partner\"
         FROM
             (SELECT  postpay_certificate_id,certificate_id, payment_date, displayname, amount_for_project, amount_for_operations_grant, village_town, location, project_title, partner_id
             FROM
                 (SELECT postpay_certificate_id, certificate_id, payment_date, displayname, instrument_amount, amount_for_project, amount_for_operations_grant, village_town
                 FROM DONORS
                 JOIN POSTPAY_CERTIFICATES USING (donor_id)
                 JOIN PAYMENTS USING (payment_id)
                 ORDER BY payment_date DESC)INFO
             LEFT OUTER JOIN PROJECT_CERTIFICATES USING (certificate_id)
             LEFT OUTER JOIN PROJECTS USING (project_id))FULL
          LEFT OUTER JOIN project_partners USING (partner_id)";

//connect to database
include("prod_conn.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
$rows = mysql_num_rows($result);

//dispaly data in a table
include 'display_table.php';

?>