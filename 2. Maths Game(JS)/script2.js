var playing = false;
var score;
var action;
var timeremanding;
var correctAnswer;

document.getElementById("startreset").onclick = function () {
  //if we are playing
  if (playing === true) {
    location.reload(); //reload or page
  } else {
    //change mode to playing
    playing = true;

    //set score to 0
    score = 0;

    //show countdown box
    document.getElementById("scorevalue").innerHTML = score;
    show("timeremanding");
    timeremanding = 60;
    document.getElementById("timeremandingvalue").innerHTML = timeremanding;

    //hide gameover box
    hide("gameover");

    //change button to reset
    document.getElementById("startreset").innerHTML = "Reset Game";

    //start coundown
    startCountdown();

    //generate a new question
    generateQA();
  }
};

//clicking on answer box
for (i = 1; i < 5; i++) {
  document.getElementById("box" + i).onclick = function () {
    //check if we are playing
    if (playing === true) {
      if (Number(this.innerHTML) === correctAnswer) { //correct answer
        //correct answer

        //increase score by 1
        score++;
        document.getElementById("scorevalue").innerHTML = score;

        //hide wrong box and show correct
        hide("wrong");
        show("correct");
        setTimeout(function () {
          hide("correct");
        }, 1000);

        //Generate new Q&A
        generateQA();
      } else {
        //wrong answer
        hide("correct");
        show("wrong");
        setTimeout(function () {
          hide("wrong");
        }, 1000);
      }
    }
  };

}

//functions

//start counter
function startCountdown() {
  action = setInterval(function () {
    timeremanding -= 1;
    document.getElementById("timeremandingvalue").innerHTML = timeremanding;
    if (timeremanding === 0) {
      //game over
      stopCountdown();
      show("gameover");
      document.getElementById("gameover").innerHTML = "<p>Game Over!</><p>Your score is " + score + ".</p>";
      hide("timeremanding");
      hide("correct");
      hide("wrong");
      playing = false;

      document.getElementById("startreset").innerHTML = "Start Game";
    }
  }, 1000);
}

//stop counter

function stopCountdown() {
  clearInterval(action);
}
//hide an element
function hide(Id) {
  document.getElementById(Id).style.display = "none";
}

//show an element
function show(Id) {
  document.getElementById(Id).style.display = "block";
}

//generate question and multiple answers
function generateQA() {
  var x = 1 + Math.round(9 * Math.random());
  var y = 1 + Math.round(9 * Math.random());
  correctAnswer = x * y;
  document.getElementById("question").innerHTML = x + " x " + y;
  var correctPosition = 1 + Math.round(3 * Math.random());
  document.getElementById("box" + correctPosition).innerHTML = correctAnswer; //fill one box with the correct answer

  //fill other with wrong answers
  var answers = [correctAnswer];

  for (i = 1; i < 5; i++) {
    if (i !== correctPosition) {
      var wrongAnswer;
      do {
        wrongAnswer = (1 + Math.round(9 * Math.random())) * (1 + Math.round(9 * Math.random())); //a wrong answer
      } while (answers.indexOf(wrongAnswer) > -1);
      document.getElementById("box" + i).innerHTML = wrongAnswer;
      answers.push(wrongAnswer);
    }
  }
}
