<? session_start(); ?>
<html>
<head>
  <title>Bill Claims Management Application</title>
  <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css">
  <style type="text/css">
  #maintainable td.orange {color: #ff9912;}
  #maintainable td.red {color: #EE4000;}
  #maintainable td.green {color: #71C671;}
  </style>
  
  <script language="javascript">
  function home(){
		document.myForm.action="billHistory.php";
		document.myForm.submit();
	}
	function myhome(){
		document.myForm.action="onCancel_billHistory.php";
		document.myForm.submit();
	}
	function myresult(){
		  var s=window.event.srcElement.id;
          l=s.length; 
	      var num=s.substring(8,l);
					   var pmtdt1="pmtdt1"+num;
					   var exp1="exp1"+num;
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
                                    document.getElementById("mydiv").innerHTML = xmlhttp.responseText;
                                    }
									
                                  };
							 	
                              var id=encodeURIComponent(document.myForm.id.value);
							  var exp1=encodeURIComponent(document.getElementById(exp1).value);
                              var pmtdt1=encodeURIComponent(document.getElementById(pmtdt1).value);
                              var bill_type=encodeURIComponent(document.myForm.bill_type.value);
							   
							  var parameters="exp1="+exp1+"&pmtdt1="+pmtdt1+"&bill_type="+bill_type+"&id="+id;
							  
							  xmlhttp.open("POST","ajaxBillClaim_history.php",true);
						      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							  xmlhttp.send(parameters); 
	}
	function genBill1() {
   
   var exp=document.myForm.exp.value;
    if(exp!="Monthly"){
      document.myForm.action="history_billpdf.php";
      document.myForm.submit();
    }
    else
    {
      document.myForm.action="history_monthly_billpdf.php";
      document.myForm.submit();
    }
  }
  </script>
</head>
<body>
  <br>
  <br>  
  <form class="pure-form pure-form-stacked" name="myForm" method="post">
  <div id="mydiv">	
    <?php
    $dbhandle = mysqli_connect("localhost", "root", "123456","cabBills")
    or die("Unable to connect to MySQL");
    $id=$_SESSION['id'];
    $name=$_SESSION['name'];
	$emailid=$_SESSION['emailid'];
    $screen=$_POST['screen'];
	$bill_type = $_POST['bill_type'];
	$rows_per_page = 5;
    $sql="select *  from  employee where id='".$id."' and bill_type='".$bill_type."'";
    $result= mysqli_query($dbhandle,$sql);
    $total_records=mysqli_num_rows($result);
	$pages = ceil($total_records / $rows_per_page);
	$start = $screen * $rows_per_page;
	$sql1 = "select *  from  employee where id='".$id."' and bill_type='".$bill_type."'";
    $sql1 .= "LIMIT $start, 5";
	//echo $sql1;
    $result1 = mysqli_query( $dbhandle, $sql1);
    ?>
	<center>
	<h2><b>Your current status of claimed bill(s) for <? echo $bill_type ?> is/are:</b></h2>
    <table class="pure-table pure-table-bordered">
     <thead>
						<tr>
							<th>Bill Type:</th>
								<td>
									<select name="bill_type">
									<option selected value="<? echo $bill_type ?>"><? echo $bill_type ?>
				                       
					                </select>
								</tr>
</thead>
					<tbody>
						<tr>
							<th>Employee ID:</th>
								<td>
									<input type="text" id="id"  name="id" value="<?= $id ?>" readonly>
								</tr>
</tbody>
</table>
</center>
<br>
<br>
<center>

	
	
	
<table class="pure-table" id="maintainable">
							<thead>
                           <tr>  
                               
                               <td>#</td>
							   <td>Expense Nature</td>
							   <td>Bill Submission Date</td>
							   <td>Account#</td>
							   <td>Status</td>
							   <td>Remarks(if any)</td>
							   <td></td>
							   
                           </tr>
						   </thead>
						   <tbody>
        <?
					          $i=1; 
        while ($row = mysqli_fetch_array($result1,MYSQLI_NUM)) 
            { 
            $exp1 = "exp1".$i;  
            $pmtdt1="pmtdt1".$i; 
			$acc1="acc1".$i; 
            $status1 = "status1".$i; 
            $remarks1 = "remarks1".$i; 
			$history1 = "history1".$i; 
			if(is_null($row{7})){  
                                  	 $row{7}="Not Any";
                                     
							  }   
								    
				if($i%2!=0)
				   {		
            ?>
						
                        <tr class="pure-table-odd">
	                     <td><? echo $start+1 ?></td>
						 <td><input  type="text" id="<?= $exp1 ?>" value="<? echo $row{4} ?>" readonly></td>    
						 <td><input  type="text" id="<?= $pmtdt1 ?>" value="<? echo $row{5} ?>" readonly></td>    
						 <td><? echo $row{2} ?></td>
		    <?
			  if(strcmp($row{6},"Under Consideration")==0)
			  {
			?>
					    <td class="orange"><b><? echo $row{6} ?></b></td> 
			<?
			  }
			  else if(strcmp($row{6},"Approved")==0)
			  {	  
			?>	
                     	<td class="green"><b><? echo $row{6} ?></b></td> 
            <?
			  }
			  else
              {				  
			?>	 
                        <td class="red"><b><? echo $row{6} ?></b></td>
            <?
			  }
			  
			?> 						
						
						 <td><? echo $row{7} ?></td>  
						 <td><input type="button" id='<? echo $history1 ?>' class="pure-button pure-button-primary" value="See Records" onClick="myresult()"></td>    
							  
                       </tr>
					
					
            <? 
				   }
				else
				   { 
			?>
			           <tr>
	                     <td><? echo $start+1 ?></td>
						 <td><input  type="text" id="<?= $exp1 ?>" value="<? echo $row{4} ?>" readonly></td>    
						 <td><input id="pmtdt" type="text" name="<?= $pmtdt1 ?>" value="<? echo $row{5} ?>" readonly></td>    
						 <td><? echo $row{2} ?></td>    
		    <?
			  if(strcmp($row{6},"Under Consideration")==0)
			  {
			?>
					    <td class="orange"><b><? echo $row{6} ?></b></td> 
			<?
			  }
			  else if(strcmp($row{6},"Approved")==0)
			  {	  
			?>	
                     	<td class="green"><b><? echo $row{6} ?></b></td> 
            <?
			  }
			  else
              {				  
			?>	 
                        <td class="red"><b><? echo $row{6} ?></b></td>
            <?
			  }
			  
			?> 		
						 <td><? echo $row{7} ?></td>  
						 <td><input type="button" id='<? echo $history1 ?>' class="pure-button pure-button-primary" value="See Records" onClick="myresult()"></td>    
							  
                       </tr>
					
			<?
			   
				   }
                     $start=$start+1;				   
                     $i=$i+1;
            }
		    ?> 
				    </tbody>
					</table> 
			       	
                   <br>    
					  
					    <?


                           // let's create the dynamic links now
                           if ($screen > 0) {
                              	$sc11=$screen-1;
	
                               $url1 = "show_date1.php?screen=" . $sc11."&bill_type=" . $bill_type;
                                echo "<a href=\"$url1\">Previous</a>\n";
                              }
                            // page numbering links now
                           for ($i = 0; $i < $pages; $i++) {
                      		
                        		$j=$i+1;
                                $url1 = "show_date1.php?screen=" . $i."&bill_type=" . $bill_type;
                                 echo " | <a href=\"$url1\">$j</a> | ";
                              }
                          if (($screen+1) < $pages) {
                            	$sc21=$screen+1;
	
                               $url1 = "show_date1.php?screen=" . $sc21."&bill_type=" . $bill_type;
                               echo "<a href=\"$url1\">Next</a>\n";
                              }
                    ?>
			 
			 <br>
		
           <center> <input type="button" class="pure-button pure-button-primary" value="Back" onClick="home()"/> </center>
			</div>
			</center>
            </form>
          </body>
          </html>
