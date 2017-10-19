var playing = false;
var score;
var trialsLeft;
var step;
var action;
var fruits = ["apple", "banana", "cherries", "grapes", "mango", "orange", "peach", "pear", "watermelon"];
$(function () {
  //click on start reset button
  $("#startreset").click(function () {
    //we are playing
    if (playing === true) {

      //reload page
      location.reload();
    } else {

      //we are not playing
      playing = true; //game initiated

      //set score to 0
      score = 0;
      $("#scorevalue").html(score);

      //show trials left
      $("#trialsLeft").show();
      trialsLeft = 3;
      addHearts();

      //hide game over box
      $("#gameOver").hide();

      //change button to reset game
      $("#startreset").html("Reset Game");

      //start sending fruits
      startAction();
    }
  });

  $("#fruit1").mouseover(function(){
    score++;
    $("#scorevalue").html(score); //update score
    $("#slicesound")[0].play(); //play sound
    
    //stop fruit $ hide it
    clearInterval(action);
    
    //hide fruit with animation
    $("#fruit1").hide("explode", 500);
    
    //send new fruit
    setTimeout(startAction, 500);
  })
  
  function addHearts() {
    $("#trialsLeft").empty();
    for (var i = 0; i < trialsLeft; i++) {
      $("#trialsLeft").append('<img src="./images/heart.png" class="life">');
    }
  };

  function startAction() {
    //generate Fruit
    generateFruit();

    //move fruit down by one step every 10ms
    action = setInterval(function () {

      //move fruit by one step
      $("#fruit1").css('top',
        $("#fruit1").position().top + step);



      //check if the fruit is too low
      if ($("#fruit1").position().top > $("#fruitsContainer").height()) {
        //check if we have trials left
        if (trialsLeft > 1) {
          generateFruit();

          //reduce trials by one
          trialsLeft--;

          //populate trialsLeft box
          addHearts();

        } else {
          //game over
          playing = false; //we are not playinf anymore

          //change button to Start Game
          $("#startreset").html("Start Game");
          $("#gameOver").show();
          $("#gameOver").html('<p>Game Over!</p><p>Your score is ' + score + '</p>');
          $("#trialsLeft").hide();
          stopAction();
        }
      }
    }, 10);
  }

  //generate a random fruit
  function chooseFruit() {
    $("#fruit1").attr('src', './images/fruits/' + fruits[Math.round(8 * Math.random())] + '.png');
  }

  //stop droping fruit
  function stopAction() {
    clearInterval(action);
    $("#frui1").hide();
  }

  function generateFruit() {
    //generate a fruit
    $("#fruit1").show();
    chooseFruit(); //choose a random fruit
    $("#fruit1").css({
      'left': Math.round(550 * Math.random()),
      'top': -50
    });
    //random position

    //generate a random step
    step = 1 + Math.round(5 * Math.random()); //change step
  }

});
