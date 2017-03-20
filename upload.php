<html>
 <head>
     <title>Upload Image</title>
     
  <script type="text/javascript">
  function f(){
  alert("jhg");
          document.frm.action="fpdf/atacetfeedDetail.php";
          document.frm.submit();
      }
   </script>
  </head>
<body>
<form action="imageUpload.php" method="post" enctype="multipart/form-data" name="frm">
<?php
 $dbhandle = mysqli_connect("localhost", "athenagu_db", "yatish@18061997","athenagu_db")
           or die("Unable to connect to MySQL");
                   
       $eid = $_POST['eid'];
     $passwd = $_POST['passwd'];         
     $cpasswd = $_POST['cpasswd'];
     $name = $_POST['name'];         
     $pname = $_POST['pname'];
     $gender = $_POST['gender'];         
     $add1 = $_POST['add1'];
     $add2 = $_POST['add2'];
     $add3 = $_POST['add3'];  
     $date = $_POST['dateval'];
     $yr = substr($date,0,4); 
     $mo =substr($date,5,2); 
     $dt =substr($date,8,2); 
     
     $class = $_POST['class']; 
     $sch_name = $_POST['sch_name']; 
     $sadd1 = $_POST['sadd1'];
     $sadd2 = $_POST['sadd2'];
     $sadd3 = $_POST['sadd3']; 
     $board = $_POST['board']; 
     $marks = $_POST['marks'];
     $contact1 = $_POST['contact1'];
     $contact2 = $_POST['contact2']; 
     $addr=$add1.", ".$add2.", ".$add3;
     $saddr=$sadd1.", ".$sadd2.", ".$sadd3;
     $dob=$dt."/".$mo."/".$yr;  


    $sql1="select id from atacetFormdata order by id desc limit 1";
                     $result1=mysqli_query( $dbhandle,$sql1);
                    while ($row = mysqli_fetch_array($result1,MYSQLI_NUM)) 
                     { 
                         $prev_id=$row{0};
                     }
                       $id_val=intVal($prev_id);
                       $id_val=$id_val+1; 
                      // $id=strval($id_val);
                       $id=(string)$id_val;  
                       $sid="B".$id;
                    $sql2="insert into atacetFormdata(emailid,passwd,name,pname,sex,address,dob,class,schoolName,schoolAddr,board,marks,scontact,pcontact,id) values('".$eid."','".$passwd."','".$name."','".$pname."','".$gender."','".$addr."','".$date."','".$class."','".$sch_name."','".$saddr."','".$board."','".$marks."','".$contact1."','".$contact2."','".$id."')";
                                                    mysqli_query( $dbhandle,$sql2);


?>
<input type="hidden" name="idhidd" value="<?= $id ?>">
<fieldset>
<legend>Image Upload</legend>
<label for="userFile">Small image to upload: </label>
<input type="file" size="40" name="userFile" id="userFile"/><br />
<br />
<input type="submit" value="Upload File" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Skip" onClick="f()">
</fieldset>
</form>
</body>
</html>