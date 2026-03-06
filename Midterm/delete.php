<?php

//connect to db
require 'includes/connect.php'; 

// make sure we received an ID
$customerId = $_GET['id']; 

// create the query 
$sql = "DELETE from reviews WHERE customer_id = :customer_id"; 

//prepare 
$stmt = $pdo->prepare($sql); 

//bind 
$stmt->bindParam(':customer_id', $customerId);

//execute
$stmt->execute(); 

// Redirect back to order list 
header("Location: orders.php"); 
exit; 