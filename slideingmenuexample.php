<html>
<head>
<style>
body{font-family:arial;}
a{color:black;text-decoration:none;font:bold}
a:hover{color:#606060}
td.menu{background:lightblue}

table.nav
{
background:black;
position:relative;
font:bold 80%;
top:0px;
left:-135px;
}
</style>
<script type="text/javascript">
var i=-135
var intHide
var speed=3
function showmenu()
{
clearInterval(intHide)
intShow=setInterval("show()",10)
}
function hidemenu()
{
clearInterval(intShow)
intHide=setInterval("hide()",10)
}
function show()
{
if (i<-12)
	{
	i=i+speed
	document.getElementById('myMenu').style.left=i
	}
}
function hide()
{
if (i>-135)
	{
	i=i-speed
	document.getElementById('myMenu').style.left=i
	}
}
</script>
</head>

<body>
<table id="myMenu" class="nav" width="150" onmouseover="showmenu()" onmouseout="hidemenu()">
<tr><td class="menu"><a href="/default.asp">HOME</a></td>
<td rowspan="5" align="center" bgcolor="#FF8080">M<br>E<br>N<br>U</td></tr>
<tr><td class="menu"><a href="/asp/default.asp">ASP</a></td></tr>
<tr><td class="menu"><a href="/js/default.asp">JavaScript</a></td></tr>
<tr><td class="menu"><a href="default.asp">DHTML</a></td></tr>
<tr><td class="menu"><a href="/vbscript/default.asp">VBScript</a></td></tr>
</table>
<p>Mouse over the MENU to show/hide the menu</p>
<p>Try changing the "speed" variable in the script, to change the menus's sliding speed</p>
</body>
</html>

## End of first example This example follows you click on tag

<html>
<head>
<style>
body{font-family:arial;}
a{color:black;text-decoration:none;font:bold}
a:hover{color:#606060}
td.menu{background:lightblue}

table.nav
{
background:black;
position:relative;
font:bold 80%;
top:0px;
left:-135px;
margin-left:3px;
}
</style>
<script type="text/javascript">
var i=-135
var c=0
var intHide
var speed=3
function show_hide_menu()
{
if (c==0)
	{
	c=1
	clearInterval(intHide)
	intShow=setInterval("show()",10)
	}
else
	{
	c=0
	clearInterval(intShow)
	intHide=setInterval("hide()",10)
	}
}
function show()
{
if (i<-12)
	{
	i=i+speed
	document.getElementById('myMenu').style.left=i
	}
}
function hide()
{
if (i>-135)
	{
	i=i-speed
	document.getElementById('myMenu').style.left=i
	}
}
</script>
</head>

<body>
<table id="myMenu" class="nav" width="150" onclick="show_hide_menu()">
<tr><td class="menu"><a href="/default.asp">HOME</a></td>
<td rowspan="5" align="center" bgcolor="#FF8080">M<br>E<br>N<br>U</td></tr>
<tr><td class="menu"><a href="/asp/default.asp">ASP</a></td></tr>
<tr><td class="menu"><a href="/js/default.asp">JavaScript</a></td></tr>
<tr><td class="menu"><a href="default.asp">DHTML</a></td></tr>
<tr><td class="menu"><a href="/vbscript/default.asp">VBScript</a></td></tr>
</table>
<p>Click on the MENU to show/hide the menu</p>
<p>Try changing the "speed" variable in the script, to change the menus's sliding speed</p>
</body>
</html>


