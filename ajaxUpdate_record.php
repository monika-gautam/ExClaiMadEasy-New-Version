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
      $brdtm = $_POST['brdtm'];
      $amt = $_POST['amt'];
      //$amt=(int)$amt;
      $date = $_POST['date'];
      //$sql="update  temp_collectdata set brdtm='".$brdtm."' and round(amount,2)=".$amt." where date='".$date."'";
      $sql="update  temp_collectdata set amount=".$amt." where brdtm='".$brdtm."' and date='".$date."'";
      mysqli_query($dbhandle,$sql);
      $sql1 = "SELECT * from temp_collectdata ";
      $result1 = mysqli_query( $dbhandle, $sql1);
      ?>
      <br>
      <center> <div style ='font:18px Tahoma;color:Red'><b>Entry for Date -<font color="blue">"<? echo $date ?>"</font> and Board Time -<font color="blue">"<? echo $brdtm ?>"</font> has been updated.</b></div>
        <br>
        <center>
          <table class="pure-table pure-table-bordered">
            <thead>
              <tr>
                <th> Date</th>
                <th> Board Time</th>
                <th> Amount </th>
                <th> Rate</th>
                <th> </th>
                <th> </th>
              </tr>
            </thead>
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
                <td><center><input type="text" value="<? echo $row{0} ?>" id="<? echo $date ?>" readonly ></center></td>
                <td><center><input type="text" value="<? echo $row{1} ?>" id="<? echo $brdtm ?>" readonly></center></td>
                <td><center><input type="text" value="<? echo $row{2} ?>" id="<? echo $amt ?>" ></center></td>
                <td><center><input type="text" value="<? echo $row{3} ?>" id="<? echo $rate ?>" readonly></center></td>
                <td><center><input type="button" class="pure-button pure-button-primary" id='<? echo $update ?>' value="UPDATE" onClick="update()"></center></td>
                <?
                if($i%2!=0){
                  ?>
                  <td rowspan="2"><center><input type="button" class="pure-button pure-button-primary" id='<? echo $del ?>' value="DELETE" onClick="remove()"></center></td>
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
