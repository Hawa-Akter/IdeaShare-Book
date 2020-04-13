
<?php
 
include_once 'dbCon.php';
$conn= connect();
session_start();
$ideaid=$_POST['ideaid'];
$sql="update ideas set views=views+1 where id=".$ideaid;
$result =$conn->query($sql);

$sqli="select views from ideas where id=".$_SESSION['ideaid'];
$resultofview = $conn->query($sqli);
$resultofview=mysqli_fetch_assoc($resultofview);
$resultofview=$resultofview['views'];

echo $resultofview;

?>