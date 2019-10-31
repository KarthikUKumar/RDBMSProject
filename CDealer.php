<!DOCTYPEHTML>
<html><head>
<title>Dealer Info</title>
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
    display: fixed;
    height: 63px;
 color: white;
    background-color: black;
 
}
body {
  font-family: Arial, Helvetica, sans-serif; display: no-repeat;
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
}
input[type=number]{
  width: 80px; 
}
input[type=date]{
   width: 200px;}
body{
text-align: center;
background-color:white;
}
h1{
text-align: center;
}h5{color:#000000;}
table{
        text-align:center;margin-right:auto;margin-left:auto;
        font:stencil;border-collapse: collapse;}
table, th, td {
              border: 2px solid grey;
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
      <a class="nav-link" href="#"><i class="fas fa-search"></i>&nbsp;Find Dealer</a>
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
      <a class="nav-link" href="http://localhost//COrderHistory.php"><i class="fas fa-history"></i>&nbsp;Order History</a>
    </li>&nbsp;
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="fas fa-envelope"></i>&nbsp;Contact Us</a>
    </li>
  </ul>
</nav>
<br></h5>

<br><br><div><h1>Dealer Information</h1>
<?php
$d=mysqli_connect('localhost','root','','fertManagement') or die("Error connecting to MySQL server.");
$rq=mysqli_query($d,"Select distinct(FName) from FERTILIZER");
echo "<form method='POST' action=''><div class=\"form-group\"><br>";
echo "<center><select class=\"form-control\" id=\"sel1\" name='fert' style=\"width:280px;\"><option disbled selected value> -- Select a Fertilizer -- </option>";
while($rop=mysqli_fetch_array($rq,MYSQLI_NUM)){
echo "<option value='$rop[0]'>$rop[0]</option>";}
echo "</select></center>  <br>      <button type=\"submit\" class=\"btn btn-primary\">OK</button></form><br><br>";
if(isset($_POST["fert"]))
{
     $dw=$_POST["fert"];
     $q=mysqli_query($d,"select D.DName,D.DLocation,D.Mob_No,A.Price,F.FCompany from Dealer D join Available_in A on D.DId=A.DId inner join FERTILIZER F on F.FId=A.FId where F.FName='$dw'");
     if(mysqli_num_rows($q)>0)
     {
         echo "<div class=\"container\"><i class=\"fas fa-search\"><input class=\"form-control\" id=\"myInput\" type=\"text\" placeholder=\"  Search the table\" style=\"align: rtl;\"></i><br><br><table class=\"table table-light table-hover\" style='text-align:left;'><thead><tr><th>Shop Name</th><th>Address</th><th style='width:13.5%;'>Mobile No.</th><th>Company</th><th>Price/KG</th></tr></thead><tbody id='myTable'>";
         while($row=mysqli_fetch_array($q,MYSQLI_NUM)){
            echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>+91 '.$row[2].'</td><td>'.$row[4].'</td><td>&#8377  '.$row[3].'</td></tr>';
         }
         echo "</tbody></table>";
     }
     else
     {
         echo "";
     }
}
else{
     echo "";
     mysqli_close($d);
}
?>
<br><br><p style="text-align:right;color:\'#ff0000\'"><a href="Home.html" style='color:#16dbf5' class="btn btn-dark">Go Back</a></p>
</div></div>
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

