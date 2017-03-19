<? session_start(); ?>
<html>
<head>
  <title> Manager Panel- Record Status </title>
  <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css">
  
  <script type="text/javascript">
  //stopping browser back button
  history.pushState(null, null, 'Cab form');
  window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'Cab form');
  });
  
  
  
  </script>
</head>
<body>
  <form class="pure-form pure-form-stacked" name="myForm" method="post">
  <?php
  $dbhandle = mysqli_connect("localhost", "root", "123456","cabBills")
  or die("Unable to connect to MySQL");
  $dateval = $_POST['pmtdt'];
  $exp = $_POST['exp'];
  $bill_type = $_POST['bill_type'];
  $id = $_POST['id'];
  $total = $_POST['total'];
  $sql5="update employee set status='Approved' where id='".$id."' and pmtdt='".$dateval."' and bill_type='".$bill_type."' and exp_nature='".$exp."'";
  //echo $sql5;
  mysqli_query($dbhandle,$sql5);
  // fetching the emailid of employee from master table
  $manager_email=$_SESSION['email'];
  $get_eid="select emailid,name from employee_info where employee_id='".$id."'";
  $sresult = mysqli_query($dbhandle,$get_eid);
  while ($srow = mysqli_fetch_array($sresult,MYSQLI_NUM)){
				  $email_add=$srow{0};
				  $name=$srow{1};
				 
	 }
	  $email_add1=$email_add.",".$manager_email;
  ?>
  
  
  <?


			$sql="SELECT * FROM temp_collectdata";
           $result1 = mysqli_query($dbhandle,$sql);




                             $subject="Welcome to Xebia | Claimed Bill Status for Employee Id $id";

                            $headers = "From: Xebia Admins ";
                            $headers.= "MIME-Version: 1.0\n";
                            $headers.= "Content-Type: text/html; charset=utf-8\n";

                             $message ='Bill Expense Claim for '.$bill_type.' by '.$name.' (Employee id : '.$id.') have been accepted having Bill Submission Date:- '.$dateval.' and have following details';

                              $message.="\r\n".' Bill Status:- APPROVED';
							  $message.="\r\n".' Bill Submission Date:- '.$dateval;
							  $message.="\r\n".' Amount Reimbursed:- '.$total.'
							  
							  <br>
							  <br>
							  ';
                                $msg='<? session_start(); ?> <html>
                                         <head>
                                           <title>Claimed Bill Status</title>
                                        </head>
                                        <body>
                                            ';

                              $msg.=$message;

                              $msg.='
							  <form>
							           <table cellspacing="2" cellpadding="2" border="1">

                           <tr>
                               <th><center>Date</center></th>
                               <th><center>Board Time</center></th>
                               <th><center>Amount</center></th>
                               <th><center>Rate</center></th>
                           </tr> ';

					         
                             while ($row = mysqli_fetch_array($result1,MYSQLI_NUM))
                                {



                          $msg.=' <tr>


                       <tr>
                          <td><center><? echo $row{2} ?></center></td>
                           <td><? echo $row{3} ?></td>
                           <td><center><? echo $row{4} ?></center></td>
                           <td><center><? echo $row{5} ?></center></td>
                           </tr>
                    </tr>';


                    
                    }




						 $msg.='  </table>
						   </form>
							        </body>
                                    </html>
                                    ';
                             $err=mail($email_add1,$subject,$msg,$headers);
							 if (!$err)
							 {
		?>						 
 
  <br>
  <br>
  <center>
    <h2><legend> Expense Claim for Date:- "<?= $dateval ?>" of  employee having Employee Id:- "<?= $id ?>" has been approved by you now.</legend></h2>
	<br>
	<br>
	 <h4><label for="msg">A mail has is also sent to you and the employee for whom expense claim is concerned.</label></h4>
    <br>
    <?
	   $del2="drop table temp_collectdata";
       mysqli_query($dbhandle,$del2);
					 }
	 ?>
        <center>
		<style scoped>

        .button-success,
        .button-error,
        .button-warning,
        .button-secondary {
            color: white;
            border-radius: 4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        }

        .button-success {
            background: rgb(28, 184, 65); /* this is a green */
        }

        .button-error {
            background: rgb(202, 60, 60); /* this is a maroon */
        }

        .button-warning {
            background: rgb(223, 117, 20); /* this is an orange */
        }

        .button-secondary {
            background: rgb(66, 184, 221); /* this is a light blue */
        }

    </style>

      
	   
	 	<input type="button" class="button-secondary pure-button" value="Main panel" onClick="home()"/>
	 	
		
        </center>
      </form>
    </body>
    </html>
