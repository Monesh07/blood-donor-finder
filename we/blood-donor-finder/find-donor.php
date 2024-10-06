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
    $bloodtype = filter_var($_POST['bloodtype'], FILTER_SANITIZE_STRING);
    $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
    $stmt = $conn->prepare("SELECT name, phone_number, location, last_donation FROM donations WHERE bloodtype = ? AND location LIKE ?");
    $searchLocation = '%' . $location . '%';  
    $stmt->bind_param("ss", $bloodtype, $searchLocation);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<h2>Matching Donors:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>Name:</strong> " . htmlspecialchars($row['name']) . "<br>";
            echo "<strong>Phone:</strong> " . htmlspecialchars($row['phone_number']) . "<br>";
            echo "<strong>Location:</strong> " . htmlspecialchars($row['location']) . "<br>";
            echo "<strong>Last Donation:</strong> " . htmlspecialchars($row['last_donation']) . "</li><br>";
            echo "<a href='tel:" . htmlspecialchars($row['phone_number']) . "'><button>Call</button></a><br>"; 
        }
        echo "</ul>";
    } else {
        echo "No matching donors found for the selected blood type and location.";
    }
    $stmt->close();
    $conn->close();
}
?>
