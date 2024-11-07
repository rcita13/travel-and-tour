<? php
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$location=$_POST['location'];
$guests=$_POST['guests'];
$arrival=$_POST['arrival'];
$leaving=$_POST['leaving'];


if (!empty($name) ||   !empty($email) ||    !empty($phone) ||   !empty($address) || 
!empty($location) ||   !empty($guests) ||   !empty($arrival) ||  !empty($leaving) )
{
$host="localhost";
$dbUsetname="root";
$dbPassword="";
$dbname="travel website";



$conn = new mysqli($host,$dbUsetname, $dbPassword, $dbname );

if (mysqli_connect_error()){
  die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
} else {
  $SELECT = "SELECT email From people db Where email= ? Limit";
  $INSERT ="INSERT Into people db(name, email, phone, address, location,
   guests, arrival, leaving) values(?,?,?,?,?,?,?,?)";
   $stmt= $conn-> prepare($SELECT);
   $stmt->bind_result($email);
   $stmt->execute();
   $stmt->bind_result($email);
   $stmt->store_result();
   $rnum= $stmt-> num_rows;

   if ($rnum==0){
     $stmt->close();

     $stmt=$conn->prepare($INSERT);
     $stmt->bind_param("ssssii", $name, $email, $phone, $address,  
     $location, $guests, $arrival, $leaving);
     $stmt->execute();
     echo" New record inserted successfully";
   } else {
    echo" Someone already registered using this email";
   }
}
$stmt->close();
$conn->close();

} else {
  echo" All fields are required";
  die();

}




?>
