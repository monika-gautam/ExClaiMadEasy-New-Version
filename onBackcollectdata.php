<? session_start(); ?><html>
<head>
  <title> Bill Claims Management Application </title>
  <link rel="stylesheet" type="text/css" media="all" href="/jsdate/jsDatePick_ltr.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css">
  <script type="text/javascript" src="/jsdate/jsDatePick.min.1.3.js"></script>
  <script language="javascript">
  //stopping browser back button
  history.pushState(null, null, 'Cab form');
  window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'Cab form');
  });
  function f(){
    new JsDatePick({
      useMode:2,
      target:"dateval",
      dateFormat:"%Y/%m/%d"
    });
  }
  function checkDt(thefield){
    //alert("checking date");
    var dt=thefield.value;
    d=dt.substring(8,10);
    m=dt.substring(5,7);
    y=dt.substring(0,4);
    //alert(""+d+m+y);
    sep1=dt.substring(4,5);
    sep2=dt.substring(7,8);
    if(sep1!='/' || sep2!='/')
    {
      //  alert("sep");
      return false;
    }
    else if(d<1 || d>31 || m<1 || m>12|| y<1950 || y>2017)
    {
      return false;
    }
    else if((m==4 || m==6 || m==9 || m==11) && d>30)
    {
      return false;
    }
    else if(m==2)
    {
      if(y%4==0 && !(y%400!=0  && y%100==100) )
      {
        if(d>29)
        return false;
      }
      else if(d>28)
      return false;
    }
    return true;
  }
  function isEmpty(thefield)
  {
    if(thefield.value=="")
    { return true;}
    else
    return false;
  }
  function isAlpha(thefield)
  {
    var v=thefield.value;
    l=v.length;
    for(i=0;i<l;i++)
    {
      c=v.substring(i,i+1);
      if(!(c>='A' && c<='Z' || c>='a' && c<='z' || c==' '))
      {
        thefield.focus();
        return false;
      }
    }
    return true;
  }
  function isnumeric(thefield)
  {
    s=thefield.value;
    l=s.length;
    for(i=0;i<l;i++)
    {v=s.substring(i,i+1);
      if(!(v>="0" && v<="9"))
      return false;
    }
    return true;
  }
  function isAmount(thefield)
  {
    s=thefield.value;
    l=s.length;
    for(i=0;i<l;i++)
    {v=s.substring(i,i+1);
      if(!((v>="0" && v<="9")|| v=="."))
      return false;
    }
    return true;
  }
  function f1(){
    if(isEmpty(document.myForm.dateval))
    {
      alert("Date Field can't be left empty");
      document.myForm.dateval.focus();
    }
    else if(!checkDt(document.myForm.dateval))
    {
      alert("Date  :  Invalid ");
      document.myForm.dateval.focus();
    }
    else if (isEmpty(document.myForm.amt1)){
      alert("Amount : Empty field");
      document.myForm.amt1.focus();
    }
    else if (isEmpty(document.myForm.amt2)){
      alert("  Amount: Empty field");
      document.myForm.amt2.focus();
    }
    else if (!isAmount(document.myForm.amt1)){
      alert("Amount: Non-numeric");
      document.myForm.amt1.focus();
    }
    else if (!isAmount(document.myForm.amt2)){
      alert("Amount: Non-numeric");
      document.myForm.amt2.focus();
    }
    else{
      document.myForm.action="collectdata.php";
      document.myForm.submit();
    }
  }
  function checkdt(){
    var day=document.myForm.dd.value;
    var l=day.length;
    for(i=0; i<l; i++)
    {
      c=day.substring(i,1);
      if(!(c>='0' && c<='9'))
      var f="false";
    }
    if(f=="false"){
      alert("Invalid day input");
      document.myForm.dd.focus();
    }
    else if(!(day<31 && day>1)){
      alert("Invalid day input");
      document.myForm.dd.focus();
    }
    else
    document.myForm.amt1.focus();
  }
  function genBill() {
    var exp=document.myForm.exp.value;
    if(exp!="Monthly"){
      document.myForm.action="genbillpdf.php";
      document.myForm.submit();
    }
    else
    {
      document.myForm.action="monthly_genbillpdf.php";
      document.myForm.submit();
    }
  }
  function genBill1() { var exp=document.myForm.exp.value;
    if(exp!="Monthly"){
      document.myForm.action="genbillpdf1.php";
      document.myForm.submit();
    }
    else
    {
      document.myForm.action="monthly_genbillpdf1.php";
      document.myForm.submit();
    }
  }
  function b(){
    var con=confirm("This will discard all the new entries made in this session. Are you sure you want to continue ?");
    if (con==true){
      document.myForm.action="onCancelHome.php";
      document.myForm.submit();
    }
  }
  function edit(){
    document.myForm.action="seeRecords.php";
    document.myForm.submit();
  }
  </script>
</head>
<body>
  <form class="pure-form pure-form-stacked" name="myForm" method="post">
    <fieldset>
      <center>
        <br>
        <h2><legend>Bill Claims Management Application </legend></h2>
        <br>
        <?php
        $dbhandle = mysqli_connect("localhost", "root", "123456","cabBills")
        or die("Unable to connect to MySQL");
        if(isset($_SESSION['id'])){
          $id = $_POST['id'];
          $sdate = $_POST['sdate'];
          $exp = $_POST['exp'];
          $hidd = $_POST['hidd'];
          $curr_val=intval($hidd);
          //echo $curr_val;
          ?>
          <input type="hidden" name="hidd" value="<?= $curr_val ?>">
          <input type="hidden" name="sdate" value="<?= $sdate ?>" >
          <input type="hidden" name="id" value="<?= $id ?>" >
          <input type="hidden" name="exp" value="<?= $exp ?>" >
          <?
          if( ($exp=="Weekly" && $curr_val>=5) || ($exp=="15 days" && $curr_val>=11) || ($exp=="Monthly" && $curr_val>=22)){
            //echo "You have exceeded the data entry limits beyond the choosen expenses nature";
            ?>
            <center>
              <h3><font color="Red">Error!!! You have exceeded the data entry limits for the chosen expense nature!!</font></h3>
              <br>
              <input type="button" class="pure-button pure-button-primary" value="Edit/See Record(s)" onClick="edit()">
              <input type="button" class="pure-button pure-button-primary" value="Cancel All" onClick="b()">
              <input type="button" class="pure-button pure-button-primary" value="Generate Bill" onClick="genBill1()">
            </center>
            <?
          }
          else{
            ?>
            <label for="nature">Expenses Nature:</label>
            <input type="text" name="exp" value="<?= $exp ?>" size="7" readonly>
            <br>
            <label for="dateval">Bill Payment Date: </label>
            <input id="dateval" type="text" placeholder="Choose Date" name="dateval" onClick="f()" size="12" autofocus>
            <br>
            <table class="pure-table pure-table-bordered">
              <thead>
                <tr>
                  <th> Cab Boarding Time</th>
                  <th> Amount </th>
                  <th> Rate</th>
                </tr>
              </thead>
              <tr>
                <td> <input type="text" name="brdtm1" value="Morning" readonly>
                </td>
                <td> <input type="text" name="amt1" size="10"> </td>
                <td> <input type="text" name="rate1" size="10"  value="1.00" readonly> </td>
              </tr>
              <tr>
                <td> <input type="text" name="brdtm2" value="Evening" readonly>
                </td>
                <td> <input type="text" name="amt2" size="10"> </td>
                <td> <input type="text" name="rate2" size="10"  value="1.00" readonly> </td>
              </tr>
            </table>
            <br><br>
            <input type="button" class="pure-button pure-button-primary" value="Edit/See Record(s)" onClick="edit()">
            <input type="button" class="pure-button pure-button-primary" value="Next" onClick="f1()">
            <input type="reset" class="pure-button pure-button-primary" value="Cancel">
            <input type="button" class="pure-button pure-button-primary" value="Cancel All" onClick="b()">
            <input type="button" class="pure-button pure-button-primary" value="Generate Bill" onClick="genBill()">
          </center>
          <?
        }
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
