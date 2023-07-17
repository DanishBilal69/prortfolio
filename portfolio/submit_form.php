<?php
// Retrieve form values
$email = $_POST['email'];
$explanation = $_POST['explanation'];

// Validate form values (optional)
if (empty($email) || empty($explanation)) {
  echo 'Please fill in all fields.';
  exit;
}

// Perform database operations (e.g., save to MySQL)
$servername = "localhost";
$username = "danish";
$password = "123";
$dbname = "agency";

try {
  // Create a new PDO instance
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO form_data (email, explanation) VALUES (:email, :explanation)");

  // Bind the named parameters
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':explanation', $explanation);

  // Execute the SQL statement
  $stmt->execute();

  // Display success message
  echo "Form submitted successfully!";
} catch(PDOException $e) {
  // Display error message
  echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
