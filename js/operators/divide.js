function divide(a, b) {
    if (b === 0) {
        throw new Error('Division by zero is not allowed.');
    }
    return a / b;
}

// Example usage:
// console.log(divide(10, 2)); // Output: 5