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
  function status_back(){
    document.myForm.action="onBackcollectdata.php";
    document.myForm.submit();
  }
  function remove(){
    var con=confirm("Are you sure you want to delete this record?");
    if (con==true){
      var s=window.event.srcElement.id;
      l=s.length;
      var num=s.substring(3,l);
      //var brdtm="brdtm"+num;
      var date="date"+num;
      //  var amt="amt"+num;
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("mydiv").innerHTML = xmlhttp.responseText;
        }
      };
      var date=encodeURIComponent(document.getElementById(date).value);
      // var brdtm=encodeURIComponent(document.getElementById(brdtm).value);
      // var amt=encodeURIComponent(document.getElementById("amt").value);
      // var parameters="date="+date+"&amt="+amt+"&brdtm="+brdtm;
      var parameters="date="+date;
      xmlhttp.open("POST","ajaxDelete_record.php",true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send(parameters);
    }
  }
  function update(){
    var con=confirm("Are you sure you want to submit the changes?");
    if (con==true){
      var s=window.event.srcElement.id;
      l=s.length;
      var num=s.substring(6,l);
      var brdtm="brdtm"+num;
      var date="date"+num;
      var amt="amt"+num;
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("mydiv").innerHTML = xmlhttp.responseText;
        }
      };
      var date=encodeURIComponent(document.getElementById(date).value);
      var brdtm=encodeURIComponent(document.getElementById(brdtm).value);
      var amt=encodeURIComponent(document.getElementById(amt).value);
      var parameters="date="+date+"&amt="+amt+"&brdtm="+brdtm;
      xmlhttp.open("POST","ajaxUpdate_record.php",true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send(parameters);
    }
  }
  </script>
</head>
<body>
  <form class="pure-form pure-form-stacked" name="myForm" method="post">
    <fieldset>
      <center>
        <?php
        $dbhandle = mysqli_connect("localhost", "root", "123456","cabBills")
        or die("Unable to connect to MySQL");
        if(isset($_SESSION['id'])){
          $id=$_SESSION['id'];
          $exp = $_POST['exp'];
          $hidd = $_POST['hidd'];
          $curr_val=intval($hidd);
          $sdate = $_POST['sdate'];
          $sql1="select * from temp_collectdata";
          $result1= mysqli_query($dbhandle,$sql1);
          ?>
          <input type="hidden" name="id" value="<?= $id ?>" >
          <input type="hidden" name="sdate" value="<?= $sdate ?>" >
          <input type="hidden" name="exp" value="<?= $exp ?>" >
          <input type="hidden" name="hidd" value="<?= $curr_val ?>">
          <h2><legend>Bill Claims Management Application </legend></h2>
          <br>
          <h3><legend>Below is the list of entries you have added in this session.</legend></h3>
          <div id="mydiv">
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
                $j=$i;
                while ($row = mysqli_fetch_array($result1,MYSQLI_NUM))
                {
                  // if($i==2)
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
              <br>
            </div>
            <center>    <input type="button" class="pure-button pure-button-primary" value="Back" onClick="status_back()">
            </center>
            <?
          }
          else{
            ?>
            <H1><center><font color="red">Permission Denied!!!</font></center></h1>
              <?
            }
            ?>
          </fieldset>
        </form>
        </html>
