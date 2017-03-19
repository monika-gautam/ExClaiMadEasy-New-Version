<? session_start(); ?>
<html>
<head>
    <title> Bill Claims Management Application </title>
    <link rel="stylesheet" type="text/css" media="all" href="/jsdate/jsDatePick_ltr.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css">
    <script type="text/javascript" src="/jsdate/jsDatePick.min.1.3.js"></script>
    <script language="javascript">
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
        var a=document.myForm.amt1.value;
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
    function b(){
        var con=confirm("This will discard all the new entries made in this session. Are you sure you want to continue?");
        if (con==true){
            document.myForm.action="onCancelHome.php";
            document.myForm.submit();
        }
    }
    </script>
</head>
<form class="pure-form pure-form-stacked" name="myForm" method="post">
    <center>
        <?php
        $dbhandle = mysqli_connect("localhost", "root", "123456","cabBills")
        or die("Unable to connect to MySQL");
        $id = $_POST['id'];
        
        if(isset($_SESSION['id'])){
            $name = $_POST['name'];
            $acc = $_POST['acc'];
            $manager = $_POST['mname'];
            $exp = $_POST['exp'];
            $dateval = $_POST['dateval'];
			$bill_type = $_POST['bill_type'];
			$_SESSION['bill_type']=$bill_type;
			$_SESSION['pmtdt']=$dateval;
            $sql="insert into employee(id,name,acc,manager_name,exp_nature,pmtdt,bill_type) values('".$id."','".$name."','".$acc."','".$manager."','".$exp."','".$dateval."','".$bill_type."')";
            mysqli_query($dbhandle,$sql);
            ?>
            <input type="hidden" name="sdate" value="<?= $dateval ?>" >
            <br>
            <fieldset>
                <center>
                    <h2><legend>Bill Claims Management Application </legend></h2>
                    <label for="nature">Expenses Nature:</label>
                    <input type="text" name="exp" value="<?= $exp ?>" size="7" readonly>
                    <br>
                    <label for="dateval">Bill Payment Date: </label>
                    <input id="dateval" type="text" placeholder="Choose Date" name="dateval" size="12" onClick="f()">
                    <br>
                    <table class="pure-table pure-table-bordered">
                        <tr>
                            <td> Cab Boarding Time</td>
                            <td> Amount </td>
                            <td> Rate</td>
                        </tr>
                        <tr>
                            <td> <input type="text" name="brdtm1" value="Morning" readonly>
                            </td>
                            <td> <input type="text" name="amt1" size="10"> </td>
                            <td> <input type="text" value="1.00" size="10" name="rate1" readonly> </td>
                        </tr>
                        <tr>
                            <td> <input type="text" name="brdtm2" value="Evening" readonly>
                            </td>
                            <td> <input type="text" name="amt2" size="10"> </td>
                            <td> <input type="text" name="rate2" size="10"  value="1.00" readonly> </td>
                        </tr>
                    </table>
                    <br><br>
                    <input type="hidden" name="hidd" value="0">
                    <input type="button" class="pure-button pure-button-primary" value="Next" onClick="f1()">
                    <input type="reset" class="pure-button pure-button-primary" value="Cancel">
                    <input type="button" class="pure-button pure-button-primary" value="Cancel All" onClick="b()">
                </center>
                <?
            }
            else{
                ?>
                <H1><center><font color="red">Permission Denied !!!</font></center></h1>
                    <?
                }
                ?>
            </fieldset>
        </form>
    </body>
    </html>
