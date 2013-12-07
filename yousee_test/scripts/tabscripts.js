// JavaScript Document


	var tabGroup=new Array();

	var tabs=new Array();
	var contentGroup= new Array();
	var tabSelected="tabLink activeLink";
	var tabNormal="tabLink";
	var backID=new Array();
	var registerID=new Array();
	var nextID=new Array();
	var activeTabID=new Array();
	
	//alert(tabGroups.length);
	var index=new Array();;
	
	function createGroup(groupName)
	{
		tabs[groupName]= new Array();
		contentGroup[groupName]= new Array();
		index[groupName]=-1;
		backID[groupName]= new Array();
		registerID[groupName]= new Array();
		nextID[groupName]= new Array();
		//alert('group created');
	}
	function setActiveTab(groupName,tabID)
	{
		activeTabID[groupName]=tabID;
	}
	function registerButtons(groupName,back,register,next)
	{

		backID[groupName]= back;
		registerID[groupName]= register;
		nextID[groupName]= next;
		//alert(nextID[groupName]);
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
				activeTabID[groupName]=tab;
				
			}
			else
			{
				document.getElementById(content).style.display="none";
				document.getElementById(tab).className=tabNormal;
			}
			//alert(tabs[i]);
		}
	}
	
	function showNextTab(groupName)
	{
		var len=tabs[groupName].length;
		var tab;
		//alert(len);
		
		for(var i=0;i<len;i++)
		{
			var tab=tabs[groupName][i];
			if(tab==activeTabID[groupName] && i<len-1)
			{
				showTab(groupName,tabs[groupName][i+1]);
				activateNormalMode(groupName);
				return;
			}
		}
		activateLastTab(groupName);
	}

	function showPreviousTab(groupName,tabID)
	{
		var len=tabs[groupName].length;
		var tab;
		//alert(len);
		
		for(var i=0;i<len;i++)
		{
			var tab=tabs[groupName][i];
			//alert(tab);
			//alert(activeTabID[groupName]);
			//alert(i);
			//alert(len-1);
			if(tab==activeTabID[groupName] && i>0)
			{
				showTab(groupName,tabs[groupName][i-1]);
				activateNormalMode(groupName);
				return;
			}
			
			//alert(tabs[i]);
		}
		activateFirstTab(groupName);
	}
	function activateNormalMode(groupName)
	{
		document.getElementById(backID[groupName]).disabled=false;
		document.getElementById(nextID[groupName]).disabled=false;
	}
	function activateFirstTab(groupName)
	{
		document.getElementById(backID[groupName]).disabled=true;
		//alert(document.getElementById(registerID[groupName]));
		//document.getElementById(registerID[groupName]).disabled=true;
		document.getElementById(nextID[groupName]).disabled=false;
	}
	function activateLastTab(groupName)
	{
		document.getElementById(backID[groupName]).disabled=false;
		//document.getElementById(registerID[groupName]).disabled=false;
		document.getElementById(nextID[groupName]).disabled=true;
	}