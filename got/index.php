<?php

if($_POST){
    
}

$house = array(
    "Lannister of Casterly Rock",
    "Greyjoy of Pyke",
    "Arryn of the Eyrie",
    "Baratheon of Storm's End",
    "Martell of Sunspear",
    "Stark of Winterfell",
    "Targaryen of King's Landing",
    "Tully of Riverrun",
    "Tyrell of Highgarden"
);

$imagesSlaider = array_diff(scandir('img'), array('..', '.','fon.png', 'logo.jpg'));
$slaider = '';
foreach ($imagesSlaider as $img) {
    $slaider .= '<div><img src="img/'.$img.'" class="slider__img"></div>';
}
			
$form = '<form  id="formFirst" action="index.php" method="POST">
            <label for="email">Enter your email</label>
            <input type="email" name="email" id="email" placeholder="arya@westeros.com">
            <hr color="#d3bb89">
            <label for="password">Choose secure password<br><span>Must be least 8 characters</span></label>
            <input type="password" name="password" placeholder="password" minlength="8" id="password">
            <hr color="#d3bb89">
            <label >
                <input type="checkbox" class="checkbox" name="remember" id="checkbox"><span class="mycheckbox"></span>
                Remember me
            </label>
            <input type="submit" name="submit" id="login" value="Sign Up" class="button">
        </form>';
			
$form2= '<form id="formSecond" action="index.php" method="POST">
            <p>You\'ve successfully joined the game.<br>
                Tell us more about yourself.</p>
            <label for="name">Who are you?<br><span>Alpha-numeric username</span></label>
            <input type="text" name="name" id="name" placeholder="arya">
            <hr color="#d3bb89">
            <label for="house">Your Great House</label>
            <select id="house" name="house">
		<option value="">Select House</option>
		<option value="1">Targaryen of King\'s Landing</option>
		<option value="2">Stark of Winterfell</option>
		<option value="3">Lannister of Casterly Rock</option>
		<option value="4">Arryn of the Eyrie</option>
		<option value="5">Tully of Riverrun</option>
		<option value="6">Greyjoy of Pyke</option>
		<option value="7">Baratheon of Storm\'s End</option>
		<option value="8">Tyrell of Highgarden</option>
		<option value="9">Martell of Sunspear</option>
            </select>
            <hr color="#d3bb89">
            <label for="hobbi">Your preferences, hobbies, wishes, etc.</label>
            <textarea id="hobbi" name="hobbi" rows="2" placeholder="I have a long TOKILL list..."></textarea>
            <hr color="#d3bb89">
            <input type="submit" name="submit" value="Save" id="save" class="button">
	</form>';
		
require 'template.php';