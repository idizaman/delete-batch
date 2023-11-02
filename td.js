// JavaScript Document

var xmlHttp

function delTopic(str1)

{


var str2="del";

var r=confirm("Are You want to delete");
if (r==true)
  {
 	if (str1.length==0)
			{ 
		 	  document.getElementById("txtHint").innerHTML=""
		  	  return
		  	}
			xmlHttp=GetXmlHttpObject()
			if (xmlHttp==null)
		  	{
		  	alert ("Browser does not support HTTP Request")
		  	return
		  	} 
			var url="showQuestion.php"
			//url=url+"?questype="+str1+"&questext="+str2+"&questext="+str3
			url=url+"?topicid="+str1+"&topicOpt="+str2
			xmlHttp.onreadystatechange=stateChanged 
			xmlHttp.open("GET",url,true)
			xmlHttp.send(null)
 }
		else
		  {
		  window.alert("You pressed Cancel!");
		  }
}





function deleteQues(str1)

{


var str2="del";
var r=confirm("Are You want to delete");
if (r==true)
  {
 	if (str1.length==0)
			{ 
		 	  document.getElementById("txtHint").innerHTML=""
		  	  return
		  	}
			xmlHttp=GetXmlHttpObject()
			if (xmlHttp==null)
		  	{
		  	alert ("Browser does not support HTTP Request")
		  	return
		  	} 
			var url="showQuestion.php"
			//url=url+"?questype="+str1+"&questext="+str2+"&questext="+str3
			url=url+"?quesid="+str1+"&quesOpt="+str2
			xmlHttp.onreadystatechange=stateChanged 
			xmlHttp.open("GET",url,true)
			xmlHttp.send(null)
 }
		else
		  {
		  window.alert("You pressed Cancel!");
		  }
}



function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("txtHint").innerHTML=xmlHttp.responseText 
 } 
}function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}




