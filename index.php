<!DOCTYPE html>
<html>
<head>
<title>Tree View</title>
  <meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <style>
 .withoutChild:before {  
    content:url("images/blank.gif");
	margin-right:20px;
	margin-left:0px;
}

/* Icon when the collapsible content is hidden */
.withoutChild.collapsed:before {
   
	content:url("images/blank.gif");
margin-right:20px;
}  
.btn.btn-light:before {   
    content:url("images/collapse.gif");
	margin-right:5px;
}

/* Icon when the collapsible content is hidden */
.btn.btn-light.collapsed:before {  
	content:url("images/expand.gif");
} 
      
  p.G {
    display: none;
}
 span.G {
    display: none;
}
div.G{
    display: none;
}

   </style>

</head>
<body>
									
<script>

var array1 = []; // array1: the array of clicked elements 
var ind=1; //0 if the element wasn't found, 1 when the element is found 
var indg=-1;
function showNode(str) { 	
     if(array1.length == 0  ){
        var xmlhttp = new XMLHttpRequest();
		
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {                
											var x = document.getElementById('justAjax');
											
						array1.push(str); 
						x.innerHTML += '<div id="'+str+'">'+this.responseText+'</div>';						
						
															}
												};
        xmlhttp.open("POST", "getNode1.php?q=" + str, true);
        xmlhttp.send();
 
						}
	else{ind=0; for (i = 0; i < array1.length; i++) {if(str == array1[i]){ind=1;}
	else{w=-1; }
													} 
		}if(ind==0){array1.push(str);var xmlhttp = new XMLHttpRequest();
		
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {  
		indg=-1*str;
											var x = document.getElementById(str); 
						array1.push(str); 
						x.innerHTML += this.responseText;
															}
												};
        xmlhttp.open("POST", "getNode1.php?q=" + str, true);
        xmlhttp.send();
					} }
 
 
</script>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" >Show Tree</a>

    </div>
    <ul class="nav navbar-nav">
	<li id="complet"><a href="#">Show Complete Tree</a></li>
      <li id="AjaxTree" onclick="showNode('.$y.')"><a href="#">Show Ajax Tree</a></li>
     
    </ul>
   
	<button id="eng1complet" class="btn btn-danger navbar-btn">ENG</button>
	<button id="ger1complet" class="btn btn-warning navbar-btn">GER</button>
	
	 <button id="eng1ajax" class="btn btn-danger navbar-btn">ENG</button>
	<button id="ger1ajax" class="btn btn-warning navbar-btn">GER</button>
	
  </div>
</nav>


<div id="justAjax"></div> 

<div id="justE" class="just-paddingE"><div>

<script>
 
    window.onload = function() {
document.getElementById('eng1ajax').style.display = 'none';
document.getElementById('ger1ajax').style.display = 'none';
document.getElementById('justE').style.display = 'none';
document.getElementById('ajax').style.display = 'none';
}; 			

$("#eng1complet").click(function(){

	$("#germanDiv").hide();
	$("#englishDiv").show();	
}); 

$("#ger1complet").click(function(){

	$("#englishDiv").hide();
	$("#germanDiv").show();	
}); 

$("#AjaxTree").click(function(){

	$("#justE").hide();
	$("#justAjax").show();
	$("#eng1complet").hide();
	$("#ger1complet").hide();
	$("#eng1ajax").show();
	$("#ger1ajax").show();	
});
$("#complet").click(function(){

	$("#justAjax").hide();
	$("#justE").show();
	$("#englishDiv").show();
	$("#germanDiv").hide();
	$("#englesko").show();
	$("#eng1complet").show();
	$("#ger1complet").show();
	$("#eng1ajax").hide();
	$("#ger1ajax").hide();	
});


$("#eng1ajax").click(function(){
   
	$("#G").hide();
	$(".G").hide();
	$(".E").show();	
});
$("#ger1ajax").click(function(){
	$("#G").show();
	$(".G").show();
	$(".E").hide();	 
});
</script>
<?php

//Bsaic Setup - should not be changed justAjax txtHint

error_reporting(E_ALL);
ini_set("display_startup_errors","1");
ini_set("display_errors","1");


//Includes
require('myTreeView.class.php');
//
$treeView=new myTreeView();
$treeView->showCompleteTree();
$treeView->showAjaxTree();
/** Add more code here for mode selection / showing etc. **/
?>
	

		