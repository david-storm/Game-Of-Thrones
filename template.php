<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    	<title>Game of thrones</title>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
		<link href="style/style.css" type="text/css" rel="stylesheet">
		<link href="style/nice-select.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<div class="left box">
			<div class="slaider">
				<div><img src="img/Lannister.png" class="slider__img"></div>
				<div><img src="img/Greyjoy.png" class="slider__img"></div>
				<div><img src="img/Arryn.png" class="slider__img"></div>
				<div><img src="img/Baratheon.png" class="slider__img"></div>
				<div><img src="img/Martell.png" class="slider__img"></div>
				<div><img src="img/Stark.png" class="slider__img"></div>
				<div><img src="img/Targaryen.png" class="slider__img"></div>
				<div><img src="img/Tully.png" class="slider__img"></div>
				<div><img src="img/Tyrell.png" class="slider__img"></div>
			</div>	  
		</div>
		<div class="right box">
			<h1>game of thrones</h1>

			<form  id="formFirst">
				<label for="email">Enter your email</label>
				<input type="email" id="email" placeholder="arya@westeros.com">
				<hr color="#d3bb89">
				<label for="password">Choose secure password<br><span>Must be least 8 characters</span></label>
				<input type="password" placeholder="password" minlength="8" id="password">
				<hr color="#d3bb89">
				<label >
				<input type="checkbox" class="checkbox" id="checkbox"><span class="mycheckbox"></span>
				Remember me</label>
				<input type="submit" id="login" value="Sign Up" class="button">
			</form>
			
			<form class="formHide" id="formSecond">
				<p>You've successfully joined the game.<br>
					Tell us more about yourself.</p>
				<label for="name">Who are you?<br><span>Alpha-numeric username</span></label>
				<input type="text" id="name" placeholder="arya">
				<hr color="#d3bb89">
				<label for="house">Your Great House</label>
				<select id="house">
					<option value="">Select House</option>
					<option value="1">Targaryen of King's Landing</option>
					<option value="2">Stark of Winterfell</option>
					<option value="3">Lannister of Casterly Rock</option>
					<option value="4">Arryn of the Eyrie</option>
					<option value="5">Tully of Riverrun</option>
					<option value="6">Greyjoy of Pyke</option>
					<option value="7">Baratheon of Storm's End</option>
					<option value="8">Tyrell of Highgarden</option>
					<option value="9">Martell of Sunspear</option>
				</select>
				<hr color="#d3bb89">
				<label for="hobbi">Your preferences, hobbies, wishes, etc.</label>
				<textarea id="hobbi" rows="2" placeholder="I have a long TOKILL list..."></textarea>
				<hr color="#d3bb89">
				<input type="submit" value="Save" id="save" class="button">
			</form>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="js/slick.min.js"></script>
		<script src="js/jquery.nice-select.min.js"></script>
		<script src="js/script.js" ></script>
	</body>		
</html>