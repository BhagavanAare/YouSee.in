// JavaScript Document


	var tabs=new Array();


	var contentGroup= new Array(4);
	var tabSelected="tabLink activeLink";
	var tabNormal="tabLink";
	
	//alert(tabGroups.length);
	var index=-1;
	
	function createGroup(groupName)
	{
		tabs[groupName]= new Array();
		contentGroup[groupName]= new Array();
		

	}
	function registerTab(groupName,tabID,tabContentDiv)
	{
		index++;
		
		tabs[groupName][index]=tabID;
		contentGroup[groupName][index]=tabContentDiv;
	}
	function showTab(groupName,tabID)
	{

		var len=4;

		
		for(var i=0;i<len;i++)
		{
			var tab=	tabs[groupName][i];
			var	content=contentGroup[groupName][i];
			//alert(tab);
			document.writeln("tabname=  "+tab+"content=  "+content);

			if(tabID==tab)
			{
				document.getElementById(contentGroup[groupName][i]).style.display="block";
				document.getElementById(tabs[groupName][i]).className="tabLink activeLink";
			}
			else
			{
				document.getElementById(contentGroup[groupName][i]).style.display="none";
				document.getElementById(tabs[groupName][i]).className="tabLink";
			}
			//alert(tabs[i]);
		}
	}
