/*import $ from '../node_modules/jquery';*/
import * as $ from 'jquery';

export const Simon = function(sel) {
    const that = this;

    this.state = "initial";
    this.sequence = [];
    this.current = 0;
    this.sequence.push(Math.floor(Math.random() * 4));

    this.initialize = function() {
        console.log('Simon started');

        const div = $(sel);
        div.html(
            '<form>' +
            '<p>' +
            '<input type="button" value="Red">' +
            '<input type="button" value="Green">' +
            '<input type="button" value="Blue">' +
            '<input type="button" value="Yellow">' +
            '</p>' +
            '<p>' +
            '<input id="start" type="button" value="Start">' +
            '</p>' +
            '</form>' +
            '<audio id="red" src="audio/red.mp3" preload="auto"></audio>' +
            '<audio id="green" src="audio/green.mp3" preload="auto"></audio>' +
            '<audio id="blue" src="audio/blue.mp3" preload="auto"></audio>' +
            '<audio id="yellow" src="audio/yellow.mp3" preload="auto"></audio>' +
            '<audio id="buzzer" src="audio/buzzer.mp3" preload="auto"></audio>'
        );

        this.form = div.find('form');
        const start = this.form.find('#start');
        start.click(function(event) {
            that.onStart();
        });
    }

    this.onStart = function() {
        console.log('Start button pressed');

        const start = this.form.find('#start');
        start.remove();

        this.configureButton(0, "red");
        this.configureButton(1, "green");
        this.configureButton(2, "blue");
        this.configureButton(3, "yellow");

        this.play();
    }

    this.configureButton = function(ndx, color) {
        var button = $(this.form.find("input").get(ndx));
        var that = this;

        button.click(function(event) {
            document.getElementById(color).currentTime = 0;
            document.getElementById(color).play();
            that.buttonPress(ndx, color);
        });

        button.mousedown(function(event) {
            button.css("background-color", color);
        });

        button.mouseup(function(event) {
            button.css("background-color", "lightgrey");
        });
    }

    this.play = function() {
        this.state = "play";    // State is now playing
        this.current = 0;       // Starting with the first one
        this.playCurrent();
    }

    this.playCurrent = function() {
        var that = this;
        if(this.current < this.sequence.length) {
            // We have one to play
            var colors = ['red', 'green', 'blue', 'yellow'];
            document.getElementById(colors[this.sequence[this.current]]).play();
            this.buttonOn(this.sequence[this.current]);
            this.current++;

            window.setTimeout(function() {
                that.playCurrent();
            }, 1000);
        } else {
            this.current=0;
            this.state="enter";
            this.buttonOn(-1);
        }
    }

    this.buttonOn = function(button, color) {
        var colors = ['red', 'green', 'blue', 'yellow'];
        for(var i = 0; i <= 3; i++){
            if(button === i){
                $(this.form.find("input").get(i)).css('background-color',colors[i]);
            }
            else{
                $(this.form.find("input").get(i)).css('background-color',"lightgrey");
            }
        }
    }

    this.buttonPress = function(button, color) {
        console.log(that.sequence);
        console.log(that.current);
        if(that.sequence.length-1===that.current){
            // Add new number to sequence
            this.sequence.push(Math.floor(Math.random() * 4));
            window.setTimeout(function(){
                that.play();
            }, 2000);
        }
        else if(button !== that.sequence[that.current]){
            console.log("Wrong Guess!");
            that.state = "lose";
            document.getElementById('buzzer').play();
            window.setTimeout(function(){
                that.initialize();
                that.state = "initial";
                that.sequence = [];
                that.current = 0;
                that.sequence.push(Math.floor(Math.random() * 4));
            }, 1000);
        }
        else{
            that.current = that.current+1;
        }
    }

    // Ensure this is the last line of the function!
    this.initialize();
}
