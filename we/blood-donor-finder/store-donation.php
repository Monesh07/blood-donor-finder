<?php
$servername = "localhost:3307";  
$username = "root";              
$password = "Jeevanjk@4";        
$dbname = "blood_donation";      


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $bloodtype = $_POST['bloodtype'];
    $location = $_POST['location'];
    $last_donation = $_POST['last-donation'];
    $phone = $_POST['phone'];  
    $stmt = $conn->prepare("INSERT INTO donations (name, bloodtype, location, last_donation, phone_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $bloodtype, $location, $last_donation, $phone);  
    if ($stmt->execute()) {
        echo "Donation details stored successfully.";  
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
