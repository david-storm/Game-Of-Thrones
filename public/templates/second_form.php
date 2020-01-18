<?php

$formSecond = '<form id="formSecond" action="index.php" method="POST">
            <p>You\'ve successfully joined the game.<br>
                Tell us more about yourself.</p>
            <label for="name">Who are you?<br><span>Alpha-numeric username</span></label>
            <input type="text" name="name" id="name" placeholder="arya" value="' . $name . '">
            <div class="wrongField"></div>
            <hr color="#d3bb89">
            <label for="house">Your Great House</label>
            <select id="house" name="house" value="' . $house . '">
		<option value="">Select House</option>
		<option value="1">Arryn of the Eyrie</option>
		<option value="2">Baratheon of Storm\'s End</option>
		<option value="3">Greyjoy of Pyke</option>
		<option value="4">Lannister of Casterly Rock</option>
		<option value="5">Martell of Sunspear</option>
		<option value="6">Stark of Winterfell</option>
		<option value="7">Targaryen of King\'s Landing</option>
		<option value="8">Tully of Riverrun</option>
		<option value="9">Tyrell of Highgarden</option>
            </select>
            <div class="wrongField"></div>
            <hr color="#d3bb89">
            <label for="hobbi">Your preferences, hobbies, wishes, etc.</label>
            <textarea id="hobbi" name="hobbi" rows="2" placeholder="I have a long TOKILL list...">' . $hobbi . '</textarea>
            <div class="wrongField"></div>
            <hr color="#d3bb89">
            <input type="submit" name="submit" value="Save" id="save" class="button">
	</form>
        <form action="index.php" method="POST">
             <input type="submit" name="submit" value="Logout" id="logout" class="button">
        </form>';
