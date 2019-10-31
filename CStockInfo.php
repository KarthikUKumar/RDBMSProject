<!DOCTYPEHTML>
<html><head><title>Stock Info</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
input[type=text]{
  width: 280px;}
body{
text-align: center;
background-color:white;
}
table{
       margin-right:auto;margin-left:auto;
        font:stencil;border-collapse: collapse;}
table, th, td {
              border: 2px solid grey;
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
      <a class="nav-link" href="#"><i class="fas fa-store"></i>&nbsp;Stock Info</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="http://localhost//CStockUpdate.php"><i class="fas fa-cart-plus"></i>&nbsp;Update Usage</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="http://localhost//COrderHistory.php"><i class="fas fa-history"></i>&nbsp;Order History</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fas fa-envelope"></i>&nbsp;Contact Us</a>
    </li>
  </ul>
</nav>
<br></h5>
<br><br><br>
<div><h1><br>Stock Information</h1><br>
<?php
$farmid=1000;
$d=mysqli_connect('localhost','root','','fertManagement') or die("Error connecting to MySQL server.");
$q=mysqli_query($d,"select F.FName,F.FCompany,S.Rem_Qty from Stock S join Farmer Fa on S.FarmId=Fa.FarmId join Fertilizer F on F.FId=S.FId where Fa.FarmId=$farmid");
if(mysqli_num_rows($q)>0)
{
   mysqli_query($d,"Delete from Stock where Rem_Qty=0 and FarmId=$farmid");
   $i=0;
   echo "<div class=\"container\"><i class=\"fas fa-search\"><input class=\"form-control\" id=\"myInput\" type=\"text\" placeholder=\"Search...\"></i><br><br><table class=\"table table-light table-hover\"><thead><tr><th></th><th>Fertilizer Name</th><th>Company</th><th>Remaining Quantity</th></tr></thead><tbody id='myTable'>";
   while($row=mysqli_fetch_array($q))
   {
      $i=$i+1;
      echo "<tr><td>$i</td>";
      echo '<td>'.$row['FName'].'</td><td>'.$row['FCompany'].'</td><td>'.$row['Rem_Qty'].'  Kg</td></tr>';
   }
   echo "</tbody></table>";
   mysqli_close($d);
}
else
{
   echo "<h4>Your Stock is Empty!";
}
?>
<br><br><p style="text-align:right;color:red"><a href="Home.html" style='color:#16dbf5' class="btn btn-dark">Go Back</a></p>
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



