<!DOCTYPEHTML>
<html><head><title>Stock_Update</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
.footer {
    bottom: 0px;
    width: 100%;
 
    height: 63px;
 
 color: white;
    background-color: black;
 
}
body {
  font-family: Arial, Helvetica, sans-serif;
  background-image: linear-gradient(to left bottom, #91d1bd, #80d3b4, #71d4a8, #64d59a, #5bd58a, #43d197, #29cda2, #00c8ac, #00b9ca, #00a7e3, #008fec, #516fdc);
}
input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button {
   -webkit-appearance: none;
   margin: 0;
}
span{ margin:0 0 0 0;
}
input[type=text]{
    outline: none;
    font-size: 1.1em;
    padding: 20px 10px 20px 10px;
    border: none;
    font-family: 'Open Sans', sans-serif;
    background: none;
    border-bottom: 2px solid #eee;
    width: 280px;
    display:inline;
    color: white;
    font-weight: 600;
}
table{
       margin-right:auto;margin-left:auto;
        font:stencil;border-collapse: collapse;}
table, th, td {
              border: 2px solid grey;
}
button[type=submit]{
   width: 100px; 
}
input[type=reset]{
   width: 100px;
 }
input[type=text]{
  width: 280px; display:inline;
}
input[type=number]{
  width: 80px; border: 1px solid light grey; height: 33px;
}
input[type=date]{
   width: 200px;}
body{
text-align: center;
background-color:white;
}
h1{
text-align: center;
}
.mk{
text-align:left;font:stencil;border-collapse: collapse;
              border: 0px solid;padding:4px;}
</style>
</head>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><h4>Fertilizer Management</h4></a>&nbsp;
<h5>
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="http://localhost//Home.html"><i class="fas fa-home"></i>     Home</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="http://localhost//CDealer.php"><i class="fas fa-search"></i>&nbsp;Find Dealer</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="http://localhost//CBilling.php"><i class="fas fa-shopping-cart"></i>&nbsp;Buy Fertilizer</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="http://localhost//CStockInfo.php"><i class="fas fa-store"></i>&nbsp;Stock Info</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fas fa-cart-plus"></i>&nbsp;Update Usage</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="http://localhost//COrderHistory.php"><i class="fas fa-history"></i>&nbsp;Order History</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fas fa-envelope"></i>&nbsp;Contact Us</a>
    </li>
  </ul>
</nav></h5>
<br><br><br><body>
<div><h1>Stock Update</h1>
<?php
$farmid=1000;
$i=0;
$f=45;
$d=mysqli_connect('localhost','root','','fertManagement') or die("Error connecting to MySQL server.");
echo "<form method='POST' action='update.php'><br><div class=\"form-group\">";
$rq=mysqli_query($d,"select F.FId,F.FName,F.FCompany,S.Rem_Qty from Stock S,Farmer Fa,Fertilizer F where S.FarmId=Fa.FarmId and F.FId=S.FId and Fa.FarmId=$farmid");
if(mysqli_num_rows($rq)>0){
echo "<div class=\"container\"><i class=\"fas fa-search\">           <input class=\"form-control\" id=\"myInput\" type=\"text\" placeholder=\"Search...\" align=\"right\"></i><br><br><table class=\"table table-light table-hover\" style='text-align:left;'><thead><tr><th></th><th>Fertilizer Name</th><th>Company</th><th>Available Quantity</th><th>Enter the Quantity Used</th></tr></thead><tbody id='myTable'>";
while($rop=mysqli_fetch_array($rq,MYSQLI_NUM)){
     $i=$i+1;
     $f=$f+2;
     echo "<tr><td><div class=\"custom-control custom-radio\"><input type=\"radio\" class=\"custom-control-input\" id=$f name=\"radio1\" value=\"$rop[0]\" onclick=\"yesnocheck($f,$i);\"><label class=\"custom-control-label\" for=$f></label></div></td><td>$rop[1]</td><td>$rop[2]</td><td>$rop[3]  Kg</td><td><center><input type=\"number\" id=$i min=0 max=$rop[3] step=0.5 name=\"$rop[0]\" class=\"form-control\" hidden>Kg</center></center></td></tr>";
}
echo "</tbody></table><br>";
echo "<button type=\"submit\" class=\"btn btn-primary\">OK</button></form><br><br>";
}
else{ echo "<h5>Your Stock is Empty!</h5>"; }
mysqli_close($d);
?>
<br><br><p style="text-align:right;"><a href="Home.html" style='color:#16dbf5' class="btn btn-dark">Go Back</a></p></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1)
    });
  });
});

function yesnocheck(r,i) {
    if(document.getElementById(r).checked){
        document.getElementById(i).removeAttribute('hidden');}
    else {
        document.getElementById(i).setAttribute('hidden');
}
}
</script>
<footer class="footer">
      <div class="container">
      <p><br>Designed By Faraz Shaikh, Karthik U Kumar.</p>
      </div>
    </footer>
</body>
</html>