<? session_start(); ?>
<html>
<head>
  <title> Bill Claim - Recors Status </title>
</head>
<body bgcolor="LightGray">
  <form name="myForm" method="post">
    <?php
    $dbhandle = mysqli_connect("localhost", "root", "123456","cabBills")
    or die("Unable to connect to MySQL");
    if(isset($_SESSION['id'])){
      // $brdtm = $_POST['brdtm'];
      //$amt = $_POST['amt'];
      $date = $_POST['date'];
      //$sql="delete from temp_collectdata where brdtm='".$brdtm."' and amt=".$amt." and date='".$date."'";
      $sql="delete from temp_collectdata where date='".$date."'";
      $result= mysqli_query($dbhandle,$sql);
      $sql1 = "SELECT * from temp_collectdata ";
      $result1 = mysqli_query( $dbhandle, $sql1);
      ?>
      <br>
      <center> <div style ='font:16px Tahoma;color:Red'><b>Details regarding Date -<font color="blue">"<? echo $date ?>"</font>  is permanently removed from the list. </b></div>
        <br>
        <center>
          <table cellspacing="2" cellpadding="2" border="1">
            <tr>
              <th align="right" bgcolor="PeachPuff"><center>Date</center></th>
              <th bgcolor="PeachPuff">Board Time</th>
              <th bgcolor="PeachPuff"><center>Amount</center></th>
              <th align="right" bgcolor="PeachPuff"><center>Rate</center></th>
              <th align="right" bgcolor="PeachPuff"> <center> </center></th>
              <th align="right" bgcolor="PeachPuff"> <center> </center></th>
            </tr>
            <?
            $i=1;
            while ($row = mysqli_fetch_array($result1,MYSQLI_NUM))
            {
              $date = "date".$i;
              $brdtm="brdtm".$i;
              $amt = "amt".$i;
              $rate = "rate".$i;
              $update = "update".$i;
              $del = "del".$i;
              ?>
              <tr>
                <td> <center><input type="text"  style="border: 0;"  value="<? echo $row{0} ?>" id="<? echo $date ?>" size="10" readonly></center></th>
                  <td><center><input type="text"  style="border: 0;"  value="<? echo $row{1} ?>" id="<? echo $brdtm ?>" size="10" readonly></center></th>
                    <td><center><input type="text"  style="border: 0;"  value="<? echo $row{2} ?>" id="<? echo $amt ?>" size="4" ></center></th>
                      <td><center><input type="text"  style="border: 0;"  value="<? echo $row{3} ?>" id="<? echo $rate ?>" size="3" readonly></center></th>
                        <td><center><input type="button" id='<? echo $update ?>' style="background-color: PaleGreen;" onMouseOver="this.style.backgroundColor='Red'" onMouseOut="this.style.backgroundColor='PaleGreen'" value="UPDATE" onClick="update()"></center></td>
                        <?
                        if($i%2!=0){
                          ?>
                          <td rowspan="2"><center><input type="button" id='<? echo $del ?>' style="background-color: PaleGreen;" onMouseOver="this.style.backgroundColor='Red'" onMouseOut="this.style.backgroundColor='PaleGreen'" value="DELETE" onClick="remove()"></center></td>
                          <?
                        }
                        ?>
                      </tr>
                      <?
                      $i=$i+1;
                    }
                    ?>
                  </table>
                </center>
                <?
              }
              else{
                ?>
                <H1><center><font color="red">Permission Denied !!!</font></center></h1>
                  <?
                }
                ?>
              </form>
            </body>
            </html>
