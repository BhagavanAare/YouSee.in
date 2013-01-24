<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="test.css">

<script src="../scripts/tabscripts.js"></script>
<script language="javascript" >
var group="donorReg";
createGroup(group);
registerTab(group,"tab1","1");
registerTab(group,"tab2","2");
registerTab(group,"tab3","3");
registerTab(group,"tab4","4");

</script>
</head>

<body >
<div id="tab" class="tab"   >
<ul  class="tabContainer" >  
<div id="tabs" class="tab-box">
    <a onclick="showTab('donorReg','tab1')" class="tabLink activeLink" id="tab1">Personal Info</a>
    <a onclick="showTab('donorReg','tab2')" class="tabLink" id="tab2">Contact Info</a>
    <a onclick="showTab('donorReg','tab3')" class="tabLink" id="tab3">Organisation Info</a>
    <a onclick="showTab('donorReg','tab4')" class="tabLink" id="tab4"> for UC</a>
</div>
<!--
<li><a class="tabLink activeLink" id="tab1" onclick="showTab1();">Personal Info</a></li>
<li><a class="tabLink" id="tab2" onclick="showTab2();">Contact Info</a></li>
<li><a class="tabLink" id="tab3" onclick="showTab3();">Organisation Info</a></li>
<li><a class="tabLink" id="tab4" onclick="showTab4();">For UC</a></li>
-->
</ul> 
</div>
<div style="display:block;" id="1">personal Info</div>
<div style="display:none;" id="2">contact info</div>
<div style="display:none;" id="3">Organisation info</div>
<div style="display:none;" id="4">for UC</div>
</body>
</html>
