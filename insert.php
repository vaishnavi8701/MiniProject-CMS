<html><head><style>
div {
  width: 500px;
  height:500px;
  padding: 20px;
  border : 7px  solid white;
  margin-top:0.2cm;
  
  background-color:white;
 
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
body  {
  background-image: url("uni-image.jpg");
  background-color: white;
}</style></head>
<body>
<?php

$link = mysqli_connect("localhost", "root", "", "demo");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);

$Gender = mysqli_real_escape_string($link, $_REQUEST['Gender']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$FGname= mysqli_real_escape_string($link, $_REQUEST['FGname']);
$address= mysqli_real_escape_string($link, $_REQUEST['address']);
 $Year = mysqli_real_escape_string($link, $_REQUEST['Year']);

$sql = "INSERT INTO persons (first_name, last_name,Gender ,email,FGname,address,Year) VALUES ('$first_name', '$last_name','$Gender','$email','$FGname','$address','$Year')";


if(mysqli_query($link, $sql)){
	
	$sql = "SELECT Personid, first_name, last_name,email,FGname,address,Gender,Year FROM persons where email='$email' AND first_name='$first_name'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
		echo "<br><b><center><font size=12px><u>STUDENT DETAILS</u></font></center></b><br><br><br>";
    echo "<center><div><h1>Your Application Id is <font color=blue>". $row["Personid"]."</font></h1><table><tr><td><center>FIRST NAME :</td><td>".$row["first_name"] ."</td></tr></center><br>";
	echo "<tr><td><center>LAST NAME :</td><td>". $row["last_name"]."</td></tr></center><br>";
	echo "<tr><td><center>GENDER :</td><td>". $row["Gender"]."</td></tr></center><br>";
	echo "<tr><td><center>EMAIL :</td><td> ". $row["email"]."</td></tr></center><br>";
	
		
	echo "<tr><td><center>FATHER/GUARDIAN'S NAME :</td><td>". $row["FGname"]."</td></tr></center><br>";
	echo "<tr><td><center>RESIDENTIAL ADDRESS :</td><td>". $row["address"]."</td></tr></center><br>";
	
	echo "<tr><td><center>YEAR :</td><td>". $row["Year"]."</td></center></tr></table></div></center><br>";
    }
} else {
    echo "0 results";
}
	


	
	
	
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>
</body>
</html>