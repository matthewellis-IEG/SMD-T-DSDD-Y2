<?php
// This function takes a name as input and returns a greeting message.
function greetUser($name) {
    return "Hello, " . $name . "! Welcome to our site.";
}

// Call the function with a sample name and display the result.
$userGreeting = greetUser("Alice");
echo $userGreeting;

// Explanation:
// 1. The function 'greetUser' accepts one parameter: $name.
// 2. It returns a greeting string that includes the provided name.
// 3. We call the function with "Alice" as the argument.
// 4. The result is stored in $userGreeting and then printed.
?>