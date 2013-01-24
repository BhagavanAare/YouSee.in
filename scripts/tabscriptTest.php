<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../test/test.css">
<script src="tabscripts.js"></script>
</head>

<body>
<div id="tab"    style="width:inherit;">
<ul id="tablist">  
<script language="javascript" >

registerTab("tab1","1");
registerTab("tab2","2");
registerTab("tab3","3");
registerTab("tab4","4");

</script>
<li><a class="currentTab" id="tab1"  onclick="showTab('tab1')">Personal Info</a></li>
<li><a class="normal" id="tab2" onclick="showTab('tab2')">Contact Info</a></li>
<li><a class="normal" id="tab3" onclick="showTab('tab3')">Organisation Info</a></li>
<li><a class="normal" id="tab4" onclick="showTab('tab4')">For UC</a></li>
</ul> 
</div>
<div style="display:block;" id="1">personal Info</div>
<div style="display:none;" id="2">contact info</div>
<div style="display:none;" id="3">Organisation info</div>
<div style="display:none;" id="4">for UC</div>
</body>
</html>
