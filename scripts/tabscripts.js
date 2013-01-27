// JavaScript Document


	var tabGroup=new Array();

	var tabs=new Array();
	var contentGroup= new Array();
	var tabSelected="tabLink activeLink";
	var tabNormal="tabLink";
	
	//alert(tabGroups.length);
	var index=new Array();;
	
	function createGroup(groupName)
	{
		tabs[groupName]= new Array();
		contentGroup[groupName]= new Array();
		index[groupName]=-1;
		//alert('group created');

		

	}
	function registerTab(groupName,tabID,tabContentDiv)
	{
		index[groupName]++;
		
		tabs[groupName][index[groupName]]=tabID;
		//alert(tabs[groupName][index[groupName]]);
		contentGroup[groupName][index[groupName]]=tabContentDiv;
	}
	function showTab(groupName,tabID)
	{
		//alert(tabs[groupName].length);
		var len=tabs[groupName].length;

		//alert(len);
		for(var i=0;i<len;i++)
		{
			var tab=tabs[groupName][i];
			var	content=contentGroup[groupName][i];
			//alert(tab);
			//alert(content);
			//document.writeln("tabname=  "+tab+"content=  "+content);

			if(tabID==tab)
			{
				document.getElementById(content).style.display="block";
				document.getElementById(tab).className=tabSelected;
			}
			else
			{
				document.getElementById(content).style.display="none";
				document.getElementById(tab).className=tabNormal;
			}
			//alert(tabs[i]);
		}
	}
