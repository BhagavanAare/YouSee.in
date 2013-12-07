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
$task =$_REQUEST['task'];

if(!$task)
{
$stateq= " SELECT statename FROM lookup_state";
$state=mysql_query($stateq);

?>
<html>
<head>
<style type="text/css">
body
{
background-color:#ADDFFF;
}
</style>
</head>
<!--<fieldset align="center">-->
<!--<legend>DonorRegistrationForm</legend>-->
<form action="<?php echo 'donorregform.php?task=insert';?>" method="post" onsubmit="return formValidation();">
	<script language=JavaScript>
	function formValidation()
	{
		var g;
		var f;
		g=document.getElementsByName("donortype")[0];
		f=document.getElementsByName("dname")[0];

		if(g.value == -1 ||  f.value=="")
		{
			alert("Please fill the Type of donor and the DisplayName to submit the form");
			return false;
		}

	}
	</script><br /><br />
			<h2><center>Donor Registration Form</center></h2>
    <table width="60%" align="center" border="0" cellpadding="5" cellspacing="0">
        <tbody>        <tr>

                        <td align="Right">Type Of Donor&nbsp;&nbsp;
                           <td><select name="donortype">
			        <option value="-1">Select</option>
				<option value="1">Group</option>
				<option value="2" >Individual</option>


                                </select>
                        </tr>
                        </td>
			<tr>
                        <td style="padding-leftt:20px" align="Right">Gender&nbsp;&nbsp;</td>
                        <td><input type="radio" name="gender" value="M">Male &nbsp;&nbsp;
                        <input type="radio" name="gender" value="F">Female

                        </td>
                    </tr>
                    <tr>
                        <td align="Right">First Name&nbsp;&nbsp;</td>
                        <td align="left"><input type="text" name="fname" size="20">

                        </td></tr>
			<tr>
                        <td align="Right">Last Name&nbsp;&nbsp;</td>
                        <td align="left"><input type="text" name="lname" size="20">

                        </td>
                    </tr>
                    <tr>

                        <td align="Right">Display Name&nbsp;&nbsp;</td>
                        <td align="left"><input type="text" name="dname" size="20">


                        </td></tr>
                    <tr>    <td align="Right">Organization/Group Name&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><input type="text" name="gname" size="20">

                        </td>

                    </tr>
                    <tr>
                        <td align="Right">Address&nbsp;&nbsp;&nbsp;</td>
                       <td align="left"><textarea name="addr" rows="3" cols="25"></textarea>
		    </tr>
		    <tr>
                        <td align="Right">Town/City&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><input type="text" name="town" size="20">
                        </td>
                    </tr>
                    <tr>
                        <td align="Right">State&nbsp;&nbsp;&nbsp;</td>
                        <td><select name="state">
						<option >Select</option>
						<?php
                          while($st=mysql_fetch_array($state))
						   { ?>
						    <option><?php echo $st['statename'] ;?></option>
							<?php } ?>
                            </select>

                        </td></tr>
			<tr><td align="Right">Country&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><input type="text" name="country" value="India">

                        </td>
                    </tr>
                    <tr>
                        <td align="Right">Personal Mail&nbsp;&nbsp;&nbsp;</td>
                         <td align="left"> <input type="text" name="mail1" size="20">

                            </td></tr><tr>
                        <td align="Right">Official Mail&nbsp;&nbsp;&nbsp;</td>
                        <td align="left"><input type="text" name="mail2" size="20">

                        </td>

                    </tr>
                    <tr>
                        <td align="Right">Mobile Phone&nbsp;&nbsp;&nbsp;
</td>
                        <td align="left"><input type="text" name="mobile" size="20">
		    </tr>
					<tr></tr>
		    <tr>
				<td></td>
                 <td rowspan="3" align="left">
		 <input  type="submit"  class="button" value="submit"/>
		    </td>
                    </tr>
                </tbody>
		 </table>
		 </form>
<!--</fieldset>-->
<?php }
if($task == 'insert')
{

$donor1=$_REQUEST['donortype'];
$gender=$_REQUEST['gender'];
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$dname=$_REQUEST['dname'];
$gname=$_REQUEST['gname'];
$addr=$_REQUEST['addr'];
$town=$_REQUEST['town'];
$state=$_REQUEST['state'];
$country=$_REQUEST['country'];
$mail1=$_REQUEST['mail1'];

$mail2=$_REQUEST['mail2'];
$mobile=$_REQUEST['mobile'];

$insertq="insert into DONORS (TYPE_OF_DONOR,FIRST_NAME,LAST_NAME,GENDER,ADDRESS,VILLAGE_TOWN,STATE,COUNTRY,
MOBILE_PHONE_NO,PERSONAL_E_MAIL_ID,OFFICIAL_E_MAIL_ID,DISPLAYNAME,Org_Grp_Name) values ('$donor1','$fname','$lname','$gender','$addr','$town','$state','$country','$mobile','$mail1','$mail2','$dname','$gname')";

$insert=mysql_query($insertq);
//echo $insert;
header('Location:donorregform.php?task=display');
}
//echo $insert;
if($task=='display')
{
$donor1=$_REQUEST['donortype'];
$gender=$_REQUEST['gender'];
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$dname=$_REQUEST['dname'];
$gname=$_REQUEST['gname'];
$addr=$_REQUEST['addr'];
$town=$_REQUEST['town'];
$state=$_REQUEST['state'];
$country=$_REQUEST['country'];
$mail1=$_REQUEST['mail1'];
$mail2=$_REQUEST['mail2'];
$mobile=$_REQUEST['mobile'];

$idq="select max(DONOR_ID) from DONORS";
$id=mysql_result(mysql_query($idq),0);

$selectq="select DISPLAYNAME,DONOR_ID from DONORS where DONOR_ID='$id'";
 $select=mysql_query($selectq);

?>
<html>

<head>
<style type="text/css">
body
{
background-color:#ADDFFF;
}

</style>
</head>

<div style="height:125px;"> </div>
<table align="left" width="100%">
	<tr><th align="left">Dear user,please note down the new donor details for further reference.</th></tr>
</table>
<br/>
<!--<fieldset align="center">-->
<!--<legend>DONOR DETAILS:</legend>-->
<h4><center>DONOR DETAILS</center></h4>
<table align="center" width="40%" border="1">
<?php
while ($row = mysql_fetch_array($select)) {
   $name=$row['DISPLAYNAME'];
   $id=$row['DONOR_ID'];


}
?>
<tr>
<th>Name</th>
<th>Donor ID</th>
</tr>
<tr>

<td align="center"><?php echo $name?></td>
<td align="center"><?php echo $id?></td></tr>

</table>
<table align="center">
	<tr> <td>
<input  type="button"  class="button" value="Back" onclick="self.location='donorregform.php'"/>
</td> </tr>
</table>

<!--</fieldset>-->
</html>
<?php } ?>





