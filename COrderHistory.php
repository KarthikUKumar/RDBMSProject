<!DOCTYPEHTML>
<html><head><title>Order History</title>
<meta charset="UTF-8">
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
input[type=text]{
    outline: none;
    font-size: 1.1em;
    padding: 20px 10px 20px 10px;
    border: none;
    font-family: 'Open Sans', sans-serif;
    background: none;
    border-bottom: 3px solid grey;
    width: 280px;
    display:inline;
    color: white;
    font-weight: 600;
}
button[type=submit]{
   width: 100px; 
}
input[type=reset]{
   width: 100px;
 }
input[type=text]{
  width: 280px;}
input[type=number]{
  width: 120px;
  outline:none;
}
input[type=date]{
   width: 200px;}
table{
       margin-right:auto;margin-left:auto;
        font:stencil;border-collapse: collapse;}
table, th, td {
              border: 2px solid grey;
}
body{
text-align: center;
background-color:white;
}
h1{
text-align: center;
}
</style>
</head></title>
<body>

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
      <a class="nav-link" href="http://localhost//CStockUpdate.php"><i class="fas fa-cart-plus"></i>&nbsp;Update Usage</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fas fa-history"></i>&nbsp;Order History</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fas fa-envelope"></i>&nbsp;Contact Us</a>
    </li>
  </ul>
</nav>
</h5>
<br><br><br>




<div><h1>Purchase History</h1>
<?php
$d=mysqli_connect('localhost','root','','fertManagement') or die("Error connecting to MySQL server.");
$rq=mysqli_query($d,"Select distinct(FName) from FERTILIZER");
echo "<form method='POST' action=''><div class=\"form-group\"><br><center><select class=\"form-control\" id=\"sel1\" name='fer' style=\"width:280px\" align='center'><option disbled selected value> -- Select a Fertilizer -- </option>";
while($rop=mysqli_fetch_array($rq,MYSQLI_NUM)){
echo "<option value='$rop[0]'>$rop[0]</option>";}
echo "</select> </center>    <br>    <button type=\"submit\" class=\"btn btn-primary\">OK</button></form><br><br>";
if(isset($_POST["fer"]))
{
     $farmid=1000;
     $f=$_POST["fer"];
     $q=mysqli_query($d,"select distinct(B.Bill_Id),B.BDate,F.FCompany,D.DName,B.Qty,B.Amount from Billing B,Fertilizer F,Dealer D,Farmer Fa where Fa.FarmId=B.FarmId and F.FId=B.FId and D.DId=B.DId and F.FName='$f'");
     if(mysqli_num_rows($q)>0)
     {  
         echo "<h4>Fertilizer:   $f</h4><br>";
         echo "<div class=\"container\"><i class=\"fas fa-search\"><input class=\"form-control\" id=\"myInput\" type=\"text\" placeholder=\"Search...\"></i><br><br><table class=\"table table-light table-hover\" style='text-align:left;'><thead><tr><th>Bill No.</th><th>Purchase Date</th><th>Company</th><th>Shop Name</th><th>Quantity</th><th>Amount</th></tr></thead><tbody id='myTable'>";
         while($ro=mysqli_fetch_array($q,MYSQLI_NUM))
         {
             echo '<tr><td>'.$ro[0].'</td><td>'.$ro[1].'</td><td>'.$ro[2].'</td><td>'.$ro[3].'</td><td>'.$ro[4].'  Kg</td><td>&#8377  '.$ro[5].'</td></tr>';
         }
         echo "</tbody></table>";
     }
     else
     {
         echo "<h4>You didn't buy $f fertilizer!!</h4>";
     }
}
else
{
     mysqli_close($d);
}
?>
<br><br><p style="text-align:right;color:red"><a href="Home.html" style="color:#16dbf5;" class="btn btn-dark">Go Back</a></p>
</div></div></div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1)
    });
  });
});
</script>
<footer class="footer">
      <div class="container">
      <p><br>Designed By Faraz Shaikh, Karthik U Kumar.</p>
      </div>
    </footer>
</body>
</html>

