
//Write a program that prints every number from 1 to 100. However, if it’s a multiple of 3, it should print “Fizz”. If it’s a multiple of 5, it should print “Buzz”. If it’s a multiple of 3 and 5, it should print “FizzBuzz”.

for (i=1;i<=100;i++){

    if (i%3==0) {
    console.log('Fizz');

    }
    else if (i%5==0){
    console.log("Buzz");

    }
    else {

    console.log(i);

    }
}