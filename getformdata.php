<html>
<?php
session_start();
$_SESSION['db'] = "project";
include('config.php');
$from = $_POST['from']; 
$to = $_POST['to'];
$date = $_POST['date'];
$str1 = "$from"."-"."$to";
$str2 = "$to"."-"."$from";
$count = 1;
?>
<link rel = "stylesheet" href = "chart.css" type = "text/css">
<ul>
        <li><a href="register.html">Sign Up</a></li>
        <li><a href = "login.html">Login</a></li>
        <li><a href="#">Offers</a></li>
        <li><a href = "#">Manage</a></li>
</ul>

<div class = "nav">
<?php
echo "<span style = 'font-size:20px;color:black;'>".$from." -> ".$to."</span>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;<span style = 'font-size:20px'> ".$date." </span>";
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class = "reset" onclick = "location.href = 'home.html'">Reset</button>
    
</div>
<?php
$con = mysqli_connect($server,$user,$password,$_SESSION['db']);

if(!$con)
{
    echo "There was a error in making the connection to DB".mysqli_connect_error()."<br>";
}

$sqlget = "SELECT * FROM buschart";
$res = mysqli_query($con,$sqlget);
if(mysqli_num_rows($res) > 0)
{
    echo "<div class = 'chart'>";
        echo "<table>";
        echo "<tr>";
        echo "<th> Index </th>";
        echo "<th> Bus </th>";
        echo "<th> Route </th>";
        echo "<th> Departure </th>";
        echo "<th> Reach </th>";
        echo "<th> Fare (₹) </th>";
        echo "<th> Seats Available</th>";
        echo "</tr>";
    while($disp = mysqli_fetch_assoc($res))
    {
        if(($disp['Route']==$str1) || ($disp['Route']==$str2)){
        echo "<tr>";
        echo "<td>$count)</td>";
        echo "<td>".$disp["Buses"]."</td>";
        echo "<td>".$str1."</td>";
        echo "<td>".str_replace(":00.000000"," ",$disp["StartTime"])."</td>";
        echo "<td>".str_replace(":00.000000"," ",$disp['EndTime'])."</td>";
        echo "<td>".$disp["Fare"]."</td>";
        echo "<td> 24 </td>";
        echo "<td colspan='7'><button class = 'book'>Book Seats</button></td>";
        echo "</tr>";
       
        $count+=1;
       }
        
    }
    echo "</table>";
    if($count==1){
    echo "<center><img src = 'nobuses.png'/>";
    echo "<h2>Sorry ! No Buses Found in this Route...</h2></center>";
    }
    echo "</div>";
}
mysqli_close($con);
?>
</html>
