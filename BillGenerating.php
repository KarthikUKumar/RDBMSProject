<!DOCTYPEHTML>
<html><head><title>Billing</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
body{
text-align: center;
}
/*p{text-align:center;  border: 1px solid black;
  width:65%;
  height:30%;
  display:block;
  overflow:hidden; }*/
h1{
text-align: center;
}
table{
        text-align:center;margin-right:auto;margin-left:auto;
        color:black;border-collapse: collapse;}
table, th, td {color:black;
              border: 1px solid black;padding:8px;
}
</style>
</head>
<body>
<script>function printdiv(){
window.frames["print_frame"].document.body.innerHTML=document.getElementById("Print_Table").innerHTML;
window.frames["print_frame"].window.focus();
window.frames["print_frame"].window.print();
}
</script>
<br>
<body>
<?php
$ft=$_POST["radio1"];
$qt=$_POST["Qty"];
$dt=$_POST["dat"];
$farmid=1000;
if($qt>0)
{
    $d=mysqli_connect('localhost','root','','fertManagement') or die("Error connecting to MySQL server.");
    $fq=explode(',',$ft);
    $qer1=mysqli_query($d,"Select Rem_Qty from STOCK where FId=$fq[1] and FarmId=$farmid");
    if(mysqli_num_rows($qer1)>0){
        $row1=mysqli_fetch_array($qer1,MYSQLI_NUM);
        $qer2=mysqli_query($d,"Update STOCK set Rem_Qty=$row1[0]+$qt where FId=$fq[1] and FarmId=$farmid");      
    }
    else{
        $qer3=mysqli_query($d,"Insert into STOCK values($farmid,$fq[1],$qt)");       
    }
    $qer5=mysqli_query($d,"Select Price from AVAILABLE_IN where FId=$fq[1] and DId=$fq[0]");
    $row2=mysqli_fetch_array($qer5,MYSQLI_NUM);
    $qer4=mysqli_query($d,"Insert into BILLING values($farmid,default,'$dt',$fq[1],$fq[0],$qt,$qt * $row2[0])");
    if($qer4){
        $id=mysqli_insert_id($d);
        $str1="select B.BDate,F.FName,F.FCompany,D.DName,D.DLocation,D.Mob_No,B.Qty,B.Amount,Fa.FarmId from FERTILIZER F,DEALER D,BILLING B,FARMER Fa Where B.FId=F.FId and D.DId=B.DId and Fa.FarmId=B.FarmId and B.Bill_Id=$id";
        $qer6=mysqli_query($d,$str1);
        $row3=mysqli_fetch_array($qer6,MYSQLI_NUM);
        $divs=$row3[7]/$row3[6];
        echo "<center><h3>Bill</h3></center>";
        echo "<h6><center><p>$row3[3]<br>$row3[4],+91 $row3[5]<br><center><table id='Print_Table'><span style='text-align:Left;'>Customer Id: $row3[8]</span><br><span style='text-align:Left;'>Date: ";
        echo date("d-m-Y",strtotime($row3[0]));
        echo "</span></h6><br><br><tr><th>Bill Id</th><th>Fertilizer Name</th><th>Fertilizer Company</th><th>Price/Kg</th><th>Quantity</th><th>Total Amount</th></tr>"; 
        echo "<tr><td>$id</td><td>$row3[1]</td><td>$row3[2]</td><td>&#8377  $divs</td><td>$row3[6]  Kg</td><td>&#8377  $row3[7]</td></tr></table><br></p></center></center>";
        echo "<b>Note:</b>Above Prices are inclusive of GST."; 
mysqli_close($d);         
}}
else
{
} 
?>
<br><br><div class="btn group"><a class="btn btn-dark" href="Home.html" style="text-align:right;">Go Back</a></div></div>
<iframe name="print_frame" width="0" height="0" frameborder="4" src="about:blank"></iframe>
</body></html>