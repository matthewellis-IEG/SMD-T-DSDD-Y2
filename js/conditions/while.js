let count = 0;
let loop = true;

while (loop) {
    if (count < 5) {
        console.log(`Count is: ${count}`);
        count++;
    } else {
        loop = false;
    }
}