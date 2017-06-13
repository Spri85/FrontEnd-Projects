numOfSquares = 6
var colors = generateRandomColors(numOfSquares);
var squares = document.querySelectorAll(".square");
var pickedColor = pickColor();
var colorDisplay = document.getElementById("colorDisplay");
var message = document.getElementById('message');
var h1 = document.querySelector("h1");
var resetButton = document.getElementById("reset");
var easyBtn = document.querySelector("#easyBtn");
var hardBtn = document.querySelector("#hardBtn");

easyBtn.addEventListener("click", function(){
    
    easyBtn.classList.toggle("selected");
    hardBtn.classList.toggle("selected");
    numOfSquares = 3
    colors = generateRandomColors(numOfSquares);
    pickedColor = pickColor();
    colorDisplay.textContent = pickedColor;
    for(var i=0; i< squares.length; i++) {
        if(colors[i]){
            squares[i].style.background = colors[i];
            squares[i].style.display = "block"
        } else {
            squares[i].style.display = "none";
        }
    }
})


hardBtn.addEventListener("click", function(){
    easyBtn.classList.toggle("selected");
    hardBtn.classList.toggle("selected");
    numOfSquares = 6
    colors = generateRandomColors(numOfSquares);
    pickedColor = pickColor();
    colorDisplay.textContent = pickedColor;
    for(var i=0; i< squares.length; i++) {
        squares[i].style.background = colors[i];
        squares[i].style.display = "block";
    }
})

resetButton.addEventListener("click", function(){
    resetButton.textContent = "New Colors";
    message.textContent = "";
    h1.style.background = "232323";
    //generate all new colors
    colors = generateRandomColors(numOfSquares);
    
    //pick a new random color from array
    pickedColor = pickColor();
    
    //change colorDisplay to match picked color
    colorDisplay.textContent = pickedColor;
    
    //change colors of squeares
    for(var i = 0; i < squares.length; i++) {
        squares[i].style.background = colors[i];
    }
})

colorDisplay.textContent = pickedColor;

for(var i = 0; i < squares.length; i++) {
    //add initial colors squares
    squares[i].style.background = colors[i];
    
    //add click listeners to squares
    squares[i].addEventListener("click", function(){
        
        //grab color of clicked square
        var clickedColor = this.style.background;
        
        //Compare color to pickedColor
        if(clickedColor === pickedColor) {
            message.textContent = "Correct!"
            changeColors(clickedColor);
            h1.style.background = clickedColor;
            resetButton.textContent = "Play again?";
            }
        else {
            this.style.background = "#232323";
            message.textContent = "Try again";
        }
    })
}

function changeColors(color){
    //loop through all squares
    //change each color to mach given color
    for(var i = 0; i < squares.length; i++){
        squares[i].style.background = color;
    }
}

function pickColor() {
   var random = Math.floor(Math.random() * colors.length);

    return colors[random];
}

function generateRandomColors(num){
    //make an array
    var arr = [];
    //repeat num times
    for(var i=0; i<num; i++){
        //get random color and push into array
        arr.push(randomColor());    
    }
    
    //return that arr
    return arr;
}

function randomColor(){
    //pic a "red" from 0 to 255
    var r = Math.floor(Math.random() * 256);
    
    //pic a "green" from 0 to 255
    var g = Math.floor(Math.random() * 256);
    
    //pic a "blue" from 0 to 255
    var b = Math.floor(Math.random() * 256);
    
    return "rgb(" + r + ", " + g + ", " + b + ")";
}


//E:\Download\FRONTEND\UDEMY\the-web-developer-bootcamp\15 Color Game Project - you should open 140 video






