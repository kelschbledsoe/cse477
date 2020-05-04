function randomWord() {
    var words = ["moon","home","mega","blue","send","frog","book","hair","late",
        "club","bold","lion","sand","pong","army","baby","baby","bank","bird","bomb","book",
        "boss","bowl","cave","desk","drum","dung","ears","eyes","film","fire","foot","fork",
        "game","gate","girl","hose","junk","maze","meat","milk","mist","nail","navy","ring",
        "rock","roof","room","rope","salt","ship","shop","star","worm","zone","cloud",
        "water","chair","cords","final","uncle","tight","hydro","evily","gamer","juice",
        "table","media","world","magic","crust","toast","adult","album","apple",
        "bible","bible","brain","chair","chief","child","clock","clown","comet","cycle",
        "dress","drill","drink","earth","fruit","horse","knife","mouth","onion","pants",
        "plane","radar","rifle","robot","shoes","slave","snail","solid","spice","spoon",
        "sword","table","teeth","tiger","torch","train","water","woman","money","zebra",
        "pencil","school","hammer","window","banana","softly","bottle","tomato","prison",
        "loudly","guitar","soccer","racket","flying","smooth","purple","hunter","forest",
        "banana","bottle","bridge","button","carpet","carrot","chisel","church","church",
        "circle","circus","circus","coffee","eraser","family","finger","flower","fungus",
        "garden","gloves","grapes","guitar","hammer","insect","liquid","magnet","meteor",
        "needle","pebble","pepper","pillow","planet","pocket","potato","prison","record",
        "rocket","saddle","school","shower","sphere","spiral","square","toilet","tongue",
        "tunnel","vacuum","weapon","window","sausage","blubber","network","walking","musical",
        "penguin","teacher","website","awesome","attatch","zooming","falling","moniter",
        "captain","bonding","shaving","desktop","flipper","monster","comment","element",
        "airport","balloon","bathtub","compass","crystal","diamond","feather","freeway",
        "highway","kitchen","library","monster","perfume","printer","pyramid","rainbow",
        "stomach","torpedo","vampire","vulture"];

    return words[Math.floor(Math.random() * words.length)];
}

function hangman(event){
    console.clear();
    console.log("Game started");
    var solution, guess, guesses, letter="", outputSolution="", gameOver = false;

    present();

    var pGuess = document.getElementById('pGuess');
    var guessLetter = document.getElementById('guessLetter');
    var newGame = document.getElementById('newGame');
    var hangmanImg = document.getElementById('hangmanImg');

    newSolution();
    guessLetter.onclick = function(event){
        event.preventDefault();
        if(gameOver){return;}

        letter = document.getElementById('letter').value;
        console.log("Guessed: "+letter);
        runGuess();

        // check if won
        if(guess.replace(/ +/g, "")===solution){
            gameOver = true;
            console.log("Winner!");
            pGuess.innerHTML = guess;
            presentResults("w");
        }
        else if(guesses===0){
            gameOver = true;
            console.log("Loser!");
            pGuess.innerHTML = outputSolution;
            presentResults("l");
        }
        else{
            pGuess.innerHTML = guess;
        }


        letter = document.getElementById('letter').value = "";
    };

    newGame.onclick = function(event){
        event.preventDefault();
        console.log("New Game");
        newSolution();
    }

    function present(){
        // The HTML for the page
        var html = "<p><img src='images/hm0.png' id='hangmanImg' height='300'  width='125' alt='empty hangman'></p>" +
            "<form name='hangmanForm' id='hangmanForm'>" +
            "<input type='hidden' id='word' value=''>" +
            "<p id='pGuess'>" + guess + "</p>" +
            "<p><label for='letter'>Letter: </label>" +
            "<input type='text' name='letter' id='letter' maxlength='1'></p>" +
            "<p><input type='submit' name='guessLetter' id='guessLetter' value='Guess!'>&nbsp;" +
            "<input type='submit' name='newGame' id='newGame' value='New Game'></p>" +
            "<p id='results'></p>" +
            "</form>";

        document.getElementById("play-area").innerHTML = html;
    }

    function newSolution(){
        // Create a new game
        gameOver = false;
        guesses = 6;
        solution = randomWord();
        console.log("Solution: "+solution);
        guess = "";
        // Makes a _ for each letter
        for(var i = 0; i < solution.length; i++){
            guess += "_ ";
        }
        pGuess.innerHTML = guess;
        document.getElementById('word').value = solution;
        updateHangman();
        presentResults("r");
        outputSolution="";
        for(var i = 0; i < solution.length; i++){
            outputSolution += solution.charAt(i) + " ";
        }
    }

    function presentResults(val){
        // Present different message based on result
        // Loss
        if(val === "l"){
            document.getElementById('results').innerHTML = "You guessed poorly!";
        }
        // Reset message
        else if(val === "r"){
            document.getElementById('results').innerHTML = "";
        }
        // Win
        else if(val === "w"){
            document.getElementById('results').innerHTML = "You win!";
        }
        // Invalid input
        else if(val === "e"){
            document.getElementById('results').innerHTML = "You must enter a letter!";
        }
    }

    function runGuess(){
        // Check for valid input
        if(letter.match(/[A-Z]/i)=== null){
            console.log("User entered invalid input");
            presentResults("e");
            return;
        }
        presentResults("r");
        var newGuess = "", found=false;
        // Check each letter of guess
        for(var i = 0; i < solution.length; i++){
            if(letter === solution.charAt(i)){
                console.log("Found a letter!");
                newGuess += letter + " ";
                found = true;
            }
            else{
                newGuess += guess.charAt(i*2) + guess.charAt((i*2)+1);
            }
        }
        // If did not match any letters in the solution word, update hangman
        if(!found){
            guesses--;
            updateHangman();
        }
        guess = newGuess;
    }

    function updateHangman(){
        // Update hangman image based on number of guesses remaining
        if(guesses === 6){
            hangmanImg.src = "images/hm0.png";
        }
        else if(guesses === 5){
            hangmanImg.src = "images/hm1.png";
        }
        else if(guesses === 4){
            hangmanImg.src = "images/hm2.png";
        }
        else if(guesses === 3){
            hangmanImg.src = "images/hm3.png";
        }
        else if(guesses === 2){
            hangmanImg.src = "images/hm4.png";
        }
        else if(guesses === 1){
            hangmanImg.src = "images/hm5.png";
        }
        else if(guesses === 0){
            hangmanImg.src = "images/hm6.png";
        }
    }
}