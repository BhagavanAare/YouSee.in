<?
session_start();
if(!session_is_registered(myusername)){
header("location:main_login.php");
}
// Check if session is not registered , redirect back to main page.
// Put this code in first line of web page.
?>

<?php
//include DB configuration file
include('prod_conn.php');

//Connect to database
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");


$catagoryq="select * from uc_category";
$catagory=mysql_query($catagoryq);

$displaynameq="select * from DONORS order by DONOR_ID";
$displayname=mysql_query($displaynameq);

$donid=$_REQUEST['donorid'];
$catid=$_REQUEST['catgorycode']; //echo $catid;
$subid=$_REQUEST['subjectname'];
$task=$_REQUEST['task'];
$title=$_REQUEST['title'];//echo $title;
$author=$_REQUEST['author'];
$publisher=$_REQUEST['publisher'];
$location=$_REQUEST['location'];

$subjectq="select * from uc_subject us, uc_category uc where uc.categoryid=us.categoryid and us.categoryid=$catid";
$subject=mysql_query($subjectq); //cho $subjectq;

$displayname1=mysql_result(mysql_query("select DISPLAYNAME from DONORS where DONOR_ID=$donid"),0);
//$displayname1=mysql_result($displayname1q);echo $displayname1;

$catagory1=mysql_result(mysql_query("select categoryname from uc_category where categoryid=$catid"),0);

//$catagory1=mysql_query($catagory1q);

?>
<script type="text/javascript">	
function formCheck(formobj){
            //alert('ramathi');
           var browserCheck = (document.all) ? 1 : 0;

        var fieldRequired = Array("donorid","catgorycode","subjectname","location");	
        var fieldDescription = Array("Donar ID","Category Name","Subject Name","Location"); 
       
        
var alertMsg = "Please complete the following fields:\n";
var l_Msg = alertMsg.length;
for (var i = 0; i < fieldRequired.length; i++){
var obj = formobj.elements[fieldRequired[i]];
if (obj){
	switch(obj.type){
		case "select-one":
			if (obj.selectedIndex =="0" || obj.options[obj.selectedIndex].text ==''){
				alertMsg += " - " + fieldDescription[i] + "\n";
			}
		break;
		case "file":
                        if (obj.value == "" || obj.value == null){
				alertMsg += " - " + fieldDescription[i] + "\n";
			}
		break;
		case "select-multiple":
			if (obj.selectedIndex == ''){
				alertMsg += " - " + fieldDescription[i] + "\n";
			}
		break;
		case "text":
		case "textarea":
                        if (obj.value == "" || obj.value == null){
				alertMsg += " - " + fieldDescription[i] + "\n";
			}
		break;
		default:
	}
                       
	if (obj.type == undefined){
                var blnchecked = false;
                for (var j = 0; j < obj.length; j++){
                        if (obj[j].checked){
                                blnchecked = true;
                }
                }
                if (!blnchecked){
                        alertMsg += " - " + fieldDescription[i] + "\n";
                }
	}
}
}

if (alertMsg.length == l_Msg){
	return true;
}
else{
	alert(alertMsg);

	return false;
       
}
}
</script>

<script language=JavaScript>
		
                function reload1(form)
		{
		   
			
		var val=form.donorid.options[form.donorid.options.selectedIndex].value;//alert(val);
		var val2=form.catgorycode.options[form.catgorycode.options.selectedIndex].value;
                var val3=form.subjectname.options[form.subjectname.options.selectedIndex].value; //alert(val3);
                var val7=form.location.options[form.location.options.selectedIndex].value;
                var val4= document.getElementById('title').value; //alert(val4);
                var val5= document.getElementById('author').value;
                var val6= document.getElementById('publisher').value; 
                //var val7= document.getElementById('location').value;
                 //alert(val7);
                /*self.location='uc_donor.html.php?&task=insert&donorid=' + val+'&catgorycode=' + val2+'&subjectname=' + val3+'&title='+val4+'&author='+val5+'&publisher='+val6+'&location='+val7;*/
                self.location='uc_donor.html.php?&task=insert&donorid=' + val+'&catgorycode=' + val2+'&subjectname=' + val3+'&location='+val7+'&title='+val4+'&author='+val5+'&publisher='+val6;
	        	
		}
                
                /*function validate(view)
                {
                var val1=document.view.donorid.value; alert(val1);
                var val2=document.view.catgorycode.value; alert(val1);
                var val3=document.view.subjectname.value; alert(val1);
                if(val1=="")
                {
                    alert("1");
                    return false;
                }
                else if(val2=="")
                {
                    alert("1");
                    return false;
                }
                else if(val3=="")
                {
                    alert("1");
                    return false;
                }
                else
                {
                    alert("1");
                    return true;
                }
                
                }*/
                
                
var alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";
function res(t,v){
var w = "";
for (i=0; i < t.value.length; i++) {
x = t.value.charAt(i);
if(v.indexOf(x,0) != -1)
w += x;
}
t.value = w;
//document.write(w);
}
                
		
		
</script>
<style type="text/css">
body
{
background-color:#ADDFFF;
}
</style>
<form action="uc_donor_view.php" method="post" name="view" onsubmit="return formCheck(this);">
    <br />
    <tr><h2><center>Book Receipt Form</center></h2></tr>
    <table width="35%" align="center" border="0" cellpadding="5" cellspacing="0">
        <tbody>
            <tr>
                <td align="right">Donor ID </td><td align="left">
		<select name="donorid" id="donorid" onchange="reload1(this.form)">
                        <option value="">-Select-</option>
                        <?php
                           while($row=mysql_fetch_array($displayname))
                           {
                           ?>
                           <option value="<?php echo $row['DONOR_ID']?>" <?php if($row['DONOR_ID']==$donid) { echo "selected"; } ?>><?php echo $row['DONOR_ID']?></option>
                           <?php
                           }
                           ?>                     
                </select>
		</td>
	    </tr>
            <tr>
                <td align="right">Display Name </td><td align="left">
                <input value="<?php echo $displayname1?>" disabled="disabled">	
		</td>
            </tr>
            <tr>
                <td align="right">Donation Date </td><td><input disabled="disabled"  value="<?php $today=date("Y-m-d"); echo $today; ?>" size="10" name="curdate"/></td>
            </tr>
            
            <tr>
                <td align="right">Category Name </td><td align="left">
                    <select name="catgorycode" id="catgorycode" onchange="reload1(this.form)">
                        <option>-Select-</option>
                        <?php
                           while($row=mysql_fetch_array($catagory))
                           {
                           ?>
                           <option value="<?php echo $row['categoryid']; ?>" <?php if($row['categoryid']==$catid) { echo "selected"; } ?>><?php echo $row['categoryname']?></option>
                           <?php
                           }
                           ?>                     
                    </select>
                </td>
            </tr>
             
            <tr>
                <td align="right">Subject </td><td align="left">
                    <select name="subjectname" id="subjectname" onchange="reload1(this.form)">
                        <option value="">-Select-</option>
                        <?php
                           while($row=mysql_fetch_array($subject))
                           {?>
 
                           <option value="<?php echo $row['subjectid']; ?>" <?php if($row['subjectid']==$subid) { echo "selected"; } ?>><?php echo $row['subjectname']?></option>
                           <?php
                           }
                           ?>                     
                    </select>
                </td>
            </tr>
            
            <tr>
                <td align="right">Store Location </td><td align="left">
                <select name="location" id="location" onchange="reload1(this.form)">
                    <option value="">-Select-</option>
                    <option value="absi" <?php if($location=='absi'){ echo "selected"; } ?>>ABSI</option>
                    <option value="adc" <?php if($location=='adc'){ echo "selected"; } ?>>ADC</option>
                </select>
                </td>
            </tr>
            <tr>
                <td align="right">Title </td><td align="left"><input type="text" name="title" id="title" value= "<?php echo $title;?>"></td>
            </tr>
            <tr>
                <td align="right">Author </td><td align="left"><input type="text" name="author" id="author" value= "<?php echo $author;?>"></td>
            </tr>
            <tr>
                <td align="right">Publisher </td><td align="left"><input type="text" name="publisher" id="publisher" value= "<?php echo $publisher;?>" ></td>
            </tr>
            <!--<tr>
                <td align="right">Store Location :&nbsp; &nbsp</td><td align="left">
                <select name="location" id="location" onchange="reload1(this.form)">
                    <option value="">-Select-</option>
                    <option value="absi" <?php if($location=='absi'){ echo "selected"; } ?>>ABSI</option>
                    <option value="adc" <?php if($location=='adc'){ echo "selected"; } ?>>ADC</option>
                </select>
                </td>
            </tr>-->
            <tr><td /><td align="left"><input type="submit" value="Submit" /></center></td><td /></tr>
        </tbody>
    </table>
</form>
