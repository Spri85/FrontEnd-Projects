//if we click on the start/reset
var scoreDisplay = document.getElementById('scorevalue');
var score;
var isPlaing = false;
var timeremandingvalue = document.getElementById('timeremandingvalue');
var Result = document.getElementById('gameover');
var timeBase = 6;
var time;
var minDigit = 1;
var maxDigit = 9;



function init() {
  score = 0;
  scoreDisplay.innerHTML = score;
  time = timeBase;
  isPlaing = true;
  timeremandingvalue.innerHTML = time;
  timeRemanding();
  document.getElementById('timeremanding').style.display = 'block';
  Result.style.display = 'none';
  
}

function gameover() {
  document.getElementById('timeremanding').style.display = 'none';
  isPlaing = false;
  Result.style.display = 'block';
  Result.innerHTML = '<p>Game over!</p><p>Your score is ' + score + '</p>';
  
}

function newGame() {
  init();
  createQuestion();
}


function roundDigit(minDigit, maxDigit) {
  return (Math.round(Math.random() * (maxDigit - minDigit)) + minDigit);
}

var answ = function() { return roundDigit(1, 9) * roundDigit(1, 9)};

function createQuestion(){
  var questionDisplay = document.getElementById('question');
  var x = roundDigit(1, 9);
  var y = roundDigit(1, 9);
  var answers = [];
  for(var i=0; i<4; i++){
    answers[i] = answ();
  }
  console.log(answers);
  answers[roundDigit(0, 3)] = x * y;
  
  questionDisplay.innerHTML = x + " x " + y;
  for(var i = 0; i<4; i++) {
    document.getElementById(`box${i+1}`).innerHTML = answers[i];
  }
}


function timeRemanding() {
  setInterval(function () {
    time--;
    if (time <= 0) {
      gameover();
    }
    timeremandingvalue.textContent = time;
  }, 1000);
}



    //if we are playing
        //reload page
    //if we are not playing
        //set score to 0
        //show countdown box
        //reduce time by 1sec in loops
          //time left?
              //yes-->continue
              //no-->gameover
        //change button to reset
        //generate new Q&A


//if we click on answer box
    //if we are playing
        //correct?
          //yes
              //increase score
              //show correct box for 1sec
              //generate new Q&A
          //no
              //show try again box for 1sec
          