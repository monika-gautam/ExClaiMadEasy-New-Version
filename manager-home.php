<? session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MANAGER PANEL </title>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="clockp.js"></script>
<script type="text/javascript" src="clockh.js"></script> 
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="ddaccordion.js"></script>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
function home(){
	//alert("jjjj");  
    document.myForm.action="manager-home.php";
    document.myForm.submit();
  }
</script>

<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	function myresult(){
		  var s=window.event.srcElement.id;
          l=s.length; 
	      var num=s.substring(8,l);
					   var pmtdt1="pmtdt1"+num;
					   var exp1="exp1"+num;
					   var id1="id1"+num;
					   var bill_type1="bill_type1"+num;
					   //alert(pmtdt1);
					    if (window.XMLHttpRequest) {
                                       // code for IE7+, Firefox, Chrome, Opera, Safari
                                         xmlhttp = new XMLHttpRequest();
                                    } else {
                               // code for IE6, IE5
                                         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                    }
                                 xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									//alert("no error");
                                    document.getElementById("my").innerHTML = xmlhttp.responseText;
                                    }
									
                                  };
							 	
                              var id=encodeURIComponent(document.getElementById(id1).innerHTML);
							  var exp1=encodeURIComponent(document.getElementById(exp1).innerHTML);
                              var pmtdt1=encodeURIComponent(document.getElementById(pmtdt1).innerHTML);
                              var bill_type=encodeURIComponent(document.getElementById(bill_type1).innerHTML);
							   
							  var parameters="exp1="+exp1+"&pmtdt1="+pmtdt1+"&bill_type="+bill_type+"&id="+id;
							 // alert(parameters);
							  xmlhttp.open("POST","ajax-manager-BillClaim-history.php",true);
						      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							  xmlhttp.send(parameters); 
	}
	
	function approve(){
	var con=confirm(" Are you sure want to approve this claim?");
    if (con==true){
		                       if (window.XMLHttpRequest) {
                                       // code for IE7+, Firefox, Chrome, Opera, Safari
                                         xmlhttp = new XMLHttpRequest();
                                    } else {
                               // code for IE6, IE5
                                         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                    }
                                 xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									//alert("no error");
                                    document.getElementById("my").innerHTML = xmlhttp.responseText;
                                    }
									
                                  };
							 	
								  
							  var exp=encodeURIComponent(document.myForm.exp.value);

							  var id=encodeURIComponent(document.myForm.id.value);
							 
                              var pmtdt=encodeURIComponent(document.myForm.pmtdt.value);
                              var bill_type=encodeURIComponent(document.myForm.bill_type.value);
							   var total=encodeURIComponent(document.myForm.total.value);
							   
							  var parameters="exp="+exp+"&pmtdt="+pmtdt+"&bill_type="+bill_type+"&id="+id+"&total="+total;
							 
							  xmlhttp.open("POST","ajax-approve-claim.php",true);
						      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							  xmlhttp.send(parameters); 
                    
	}
  }
</script>

<script language="javascript" type="text/javascript" src="niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="niceforms-default.css" />

</head>
<body>
<div   id="mydiv">  
<?php
	$dbhandle = mysqli_connect("localhost", "root", "123456","cabBills")
    or die("Unable to connect to MySQL");
    $del2="drop table temp_collectdata";
    mysqli_query($dbhandle,$del2);
	if(isset($_SESSION['username'])){	
                        $screen = 0;
						$username = $_SESSION['username'];
	                    
			            $name=$_SESSION['name'];
			            $email=$_SESSION['email'];
			            $id= $_SESSION['id'];
						
						
						    $sql3="select count(*) from employee where status='Under Consideration'";
                            $result3 =mysqli_query($dbhandle,$sql3);
							while ($countrow = mysqli_fetch_array($result3,MYSQLI_NUM))
                            {
								  $total_records=$countrow{0};
							}	  
                            
							$rows_per_page = 5;
                           // $total_records=mysqli_num_rows($result3);
							echo $total_records;
	                        $pages = ceil($total_records / $rows_per_page);
	                        $start = $screen * $rows_per_page;	
                            $sql1 = "select * from employee where status='Under Consideration'";
                            $sql1 .= "LIMIT $start, 5";
							echo $sql1;
	                        $result1 = mysqli_query( $dbhandle, $sql1); 							
    ?>
	  
<div id="main_container">

	<div class="header">
    <div class="logo"><a href="#"><img src="images/xebia1.png" alt="" title="" border="0" /></a></div>
    
    <div class="right_header">Welcome <?= $name ?>, <a href="https://exclaimadeasy-monika.rhcloud.com">Visit site</a> | <a href="http://gmail.com" class="messages"> Messages</a> | <a href="#" class="logout">Logout</a></div>
    <div id="clock_a"></div>
    </div>
    
    <div class="main_content">
    
                    <div class="menu">
                    <ul>
                    <li><a class="current" href="#">Manager Home<i class="material-icons">home</i></a></a></li>
                    
					
                    </ul>
                    </div> 
                    
                    
                    
                    
    <div class="center_content">  
    
    
    
    <div class="left_content">
    
    		<div class="sidebar_search">
            <form>
            <input type="text" name="" class="search_input" value="search keyword" onclick="this.value=''" />
            <input type="image" class="search_submit" src="images/search.png" />
            </form>            
            </div>
    
            <div class="sidebarmenu">
            
                <a class="menuitem submenuheader" href="">Employee Ids</a>
                <div class="submenu">
                    <ul>
                    <li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>
                    <li><a href="">Sidebar submenu</a></li>
                    </ul>
                </div>
                
				
                <a class="menuitem" href="">User Reference</a>
                <a class="menuitem_red" href="">Edit Your Profile</a>
				
                    
            </div>
            
            
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                
				
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>
            
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                
				
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>
            
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                
				
                
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>  
            
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                
				
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>
              
    
    </div>  
    
    <div class="right_content" id="my">            
        
    <h2>Claimed Bills Under Consideration</h2> 
                    
                    
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	
            <th scope="col" class="rounded"><b>Employee Id</b></th>
			<th scope="col" class="rounded">Expense Nature</th>
			<th scope="col" class="rounded">Bill Type</th>
            <th scope="col" class="rounded">See Records</th>
            <th scope="col" class="rounded">Claimed Amount</th>
            <th scope="col" class="rounded">Submission Date</th>
            <th scope="col" class="rounded">Status</th>
			<th scope="col" class="rounded">Reject</th> 
            
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="6" class="rounded-foot-left"><em>These are the list of the newly claimed bills .</em></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
	<?
	   $i=1; 
	   while ($row1 = mysqli_fetch_array($result1,MYSQLI_NUM))
      {    
           $aed=0;
           $total=0.00;
           $exp1 = "exp1".$i;  
           $pmtdt1="pmtdt1".$i; 
		   $bill_type1 = "bill_type1".$i;  
           $id1="id1".$i; 
		   $details1 = "details1".$i; 
		   $sql2="select * from collectdata where id='".$row1{0}."' and submission_date='".$row1{5}."' and bill_type='".$row1{8}."'";
		   $result2=mysqli_query($dbhandle,$sql2);
		   while($row2 = mysqli_fetch_array($result2,MYSQLI_NUM))
           {
              $dbdate=$row2{2};
              $dbbrdtm=$row2{3};
              $dbamt=$row2{4};
              $dbrate=$row2{5}; 
			  $aed=  number_format(($dbamt*$dbrate), 2,'.', '');
              $total=number_format(($total+$aed), 2,'.', '');
          }
	?>
	
    	<tr>
        	
            <td id="<?= $id1 ?>"><?= $row1{0} ?></td>
			<td id="<?= $exp1 ?>"><?= $row1{4} ?></td>
            <td id="<?= $bill_type1 ?>"><?= $row1{8} ?></td>
            <td><img src="images/user_edit.png" alt="" title="" border="0" /><input type="button" id='<? echo $details1 ?>'  value="Details" onClick="myresult()">   
							</td>
			<td><?= $total ?></td>
           <td id="<?= $pmtdt1 ?>"><?= $row1{5} ?></td>

            <td><?= $row1{6} ?></a></td>
            <td><a href="#" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
        </tr>
    <?
	    $i=$i+1;    
         
	  }
	?>     
    	
        
    </tbody>
</table>

	<center> <a href="signin_index.html" class="bt_green"><span class="bt_green_lft"></span><strong>Back to Home</strong><span class="bt_green_r"></span></a></center>
     
     
     
        <div class="pagination">
		 <?


                           // let's create the dynamic links now
                           if ($screen > 0) {
                              	$sc11=$screen-1;
	
                               $url1 = "manager-dashboard1.php?screen=" . $sc11;
                                echo "<a href=\"$url1\">Previous<<</a>\n";
                              }
                            // page numbering links now
                           for ($i = 0; $i < $pages; $i++) {
                      		
                        		$j=$i+1;
								if($screen+1==$j)
								{
							    echo " | ";		            
		
		                       $url1 = "manager-dashboard1.php?screen=" . $i;
                                 echo "  <a href=\"$url1\"><b><font color=\"red\">$j</font></b> </a>  ";
		
		                      echo " | ";	
                       		    }
								else{
                                $url1 = "manager-dashboard1.php?screen=" . $i;
                                 echo " | <a href=\"$url1\">$j</a> | ";
								}
                              }
                          if (($screen+1) < $pages) {
                            	$sc21=$screen+1;
	
                               $url1 = "manager-dashboard1.php?screen=" . $sc21;
                               echo "<a href=\"$url1\">Next>></a>\n";
                              }
                    ?>
        
		</div> 
     
    
           
     
     
        
		
      
     
     </div><!-- end of right content-->
            
                    
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
    <div class="footer">
    
    	<div class="left_footer">IN MANAGER PANEL | Powered by <a href="https://exclaimadeasy-monika.rhcloud.com">Xebia India</a></div>
    	<div class="right_footer"><a href="http://indeziner.com"><img src="images/indeziner_logo.gif" alt="" title="" border="0" /></a></div>
    
    </div>

</div>	
<?
       } 
	   else
	       { 
 ?> 
	   <H1><center><font color="red">Permission Denied !!!</font></center></h1> 
 <? 
		                 } 
                  
		
 ?>	
 </div>
</body>
</html>