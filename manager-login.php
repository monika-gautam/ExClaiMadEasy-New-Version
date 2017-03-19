<!--Developed by Monika Gautam <monika315gtm@gmail.com* -->
<? session_start(); ?> <html>
   <head>
   <title>Xebia India Asset Management Application.</title>
   <meta charset="UTF-8">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="js/jquery-1.10.1.min.js"></script>
  <script src="jquery-ui-1.10.2/ui/jquery-ui.js"></script>
  <link rel="stylesheet" href="jquery-ui-themes-1.10.4/themes/sunny/jquery-ui.css">
  <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css">
  <script language="javascript">
		
		$(function(){
			$('#dialog').dialog({
				modal: true,
				autoOpen: false,
				title : "Bill Claims Management",
				width: 600,
				height: 350
			});
				
		$('#opener').click(function(){
			$('#dialog').dialog('open');
		   });
		 
       $('#opener1').click(function(){
			$('#dialog').dialog('open');
		   });
		}); 
		function home(){
        
            document.myForm.action="signin_index.html";
            document.myForm.submit();
        
    }
      </script>
   </head>
   <body>
    <br>
    <br>
    <div id="dialog"><form action="manager-dashboard.php" method="post" id="mform" name="form">
	<b><center><h1><div class="hvr-pulse"><font face="calibri">Enter Login Details </font></div></h1>
	<table cellspacing="2" cellpadding="2">
	<tr><td>Username</td><td><input type="text" name="username" autofocus required></td></tr>
	<tr></tr>
	<tr><td>Password</td><td><input type="password" name="passwd" required></td></tr>
	
	</table>
	<br>
    </form>
	<input type="submit" value="SUBMIT" form="mform"></center>
	</div>
    <form name="myForm" method="post" class="pure-form">
    <center></b>
    <input type="button" style="width:160px;height:185px;font-size:110px;position:absolute;margin-top:1.5cm;background-color:#0198E1;right: 45%;" title="Manager? Login Here." id="opener" name="opener">
    <i class="material-icons" style="font-size:130px;color:red;text-shadow:2px 2px 4px #000000;position:absolute;margin-top:2cm;right: 46%;">person</i>
    <h1><font color="blue"><legend><B>MANAGER PANEL</B></legend></h1>
	<br>
	<br>
    <br>
	<br>
    <br>
	<br>
    <br>
	<br>
    <br> 
    	
    <H2><b> Authentication Requires </b></H2><input type="button" name="opener1" id="opener1" class="pure-button pure-button-primary" style="height:45px;" value="SIGN IN">&nbsp;&nbsp;&nbsp;&nbsp;<button value="  Home  " id="opener1" class="pure-button pure-button-primary" onClick="home()"> HOME<i class="material-icons"  onClick="home()">home</i></button>
     <br> 
    <br>
	</center>
    </form> 
	 </body>
</html>
        