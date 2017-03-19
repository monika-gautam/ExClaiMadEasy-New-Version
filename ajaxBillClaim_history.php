<? session_start(); ?>
<html>
<head>
  <title> Bill Claim - Record Status </title>
  <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css">
  <script type="text/javascript">
  //stopping browser back button
  history.pushState(null, null, 'Cab form');
  window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'Cab form');
  });
  function home(){
	//alert("jjjj");  
    document.myForm.action="billHistory.php";
    document.myForm.submit();
  }
  
  
  </script>
</head>
<body>
  <form class="pure-form pure-form-stacked" name="myForm" method="post">
  <?php
  $dbhandle = mysqli_connect("localhost", "root", "123456","cabBills")
  or die("Unable to connect to MySQL");
  $dateval = $_POST['pmtdt1'];
  $exp = $_POST['exp1'];
  $bill_type = $_POST['bill_type'];
  $id = $_POST['id'];
  $sql1="select * from collectdata where id='".$id."' and submission_date='".$dateval."' and bill_type='".$bill_type."'";
  $result1= mysqli_query($dbhandle,$sql1);
  $c="create table if not exists temp_collectdata(date varchar(10),brdtm varchar(7),amount numeric(7,2),rate numeric(5,2))";
  mysqli_query($dbhandle,$c);
  ?>
  <input type="hidden" name="id" value="<? echo $id ?>">
  <br>
  <br>
  <center>
    <h2><legend>Below are the details of the Expense Claim for Date:- "<?= $dateval ?>"</legend></h2>
    <br>
    <center>	<div id="mydiv">
      <label for="id">Expenses Nature</label>
      <input  type="text" name="exp" value="<? echo $exp ?>" size="5" readonly>
      <br>
      <label for="dateval">Submission Date(yyyy/mm/dd)</label>
      <input type="text" name="dateval" id="dateval" value="<? echo $dateval ?>" size="8" readonly>
      <br>
      <center>
        <table class="pure-table pure-table-bordered">
          <thead>
            <tr>
              <th><center>Date</center></th>
              <th><center>Board Time</center></th>
              <th><center>Amount</center></th>
              <th><center>Rate</center></th>
            </tr>
</thead>
          <?
            $total=0.00;
            while ($row = mysqli_fetch_array($result1,MYSQLI_NUM))
            {
              $aed=  number_format(($row{4}*$row{5}), 2,'.', '');
              $total=number_format(($total+$aed), 2,'.', '');
              ?>
              <tr>
                <td><center><? echo $row{2} ?></center></td>
                <td><? echo $row{3} ?></td>
                <td><center><? echo $row{4} ?></center></td>
                <td><center><? echo $row{5} ?></center></td>
              </tr>
              <?
			   $sql11="insert into temp_collectdata values('".$row{2}."','".$row{3}."',".$row{4}.",".$row{5}.")";
               // echo $sql1;
               mysqli_query($dbhandle,$sql11);
            }
            ?>
          </table>
          <br>
          <div style ='font:17px Tahoma;color:#Blue'> TOTAL : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $total ?></div>
          <br>
        </div>
        <center>
      
	    <input type="button" class="pure-button pure-button-primary" value="Generate PDF" onClick="genBill1()"/>
	 	
		<input type="button" class="pure-button pure-button-primary" value="Back" onClick="myhome()"/> </center>
        </center>
      </form>
    </body>
    </html>
