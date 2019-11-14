<?php

function auth_user($email, $password){
   
    $fileName = $email . '.json'; 
    $fullName = 'db_users/' . $fileName; 
    if(in_array($fileName, scandir('db_users'))){
        $handle = fopen($fullName, 'r');
        $passInDB = json_decode(fread($handle, filesize($fullName)))['password'];
        if($passInDB == $password){
            $result = array('res' => 1);
        } else {
           $result = array('res' => 0, 'message' => array('password' => 'Wrong password'));
        }
    } else {
        
        $handle = fopen($fullName, 'x');
        $data = array('password' => $password);
        fwrite($handle, json_encode($data));
        $result = array('res' => 2);
    }
    fclose($handle);
    return $result;
}

function loginOrRegUser(){
    $email = isset($_POST['email']) ? strval($_POST['email']) : '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return array('res' => false, 'message' => array('email' => 'E-mail is not valid'));
    }
    $password = isset($_POST['password']) ? strval($_POST['password']) : '';
    if(strlen($password) < 8){
        return array('res' => false, 'message' => array('password' => 'Password is short'));
    }
    $_SESSION['current_user'] = array('email' => $email);
    $result = auth_user($email, $password);
    return $result;
}

if(isset($_POST)){
    if(isset($_POST['submit'])){
        if($_POST['submit'] == 'Sign Up'){
            $result = loginOrRegUser();
            if($result['res']){
                nextForm();
            } else {
                $GLOBALS['message'] = $result['message'];
            }
        }
    }
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
function nextForm(){
    $_SESSION['form'] = 'second';
}

function viewsForm(){
    
    $formFirst = '<form  id="formFirst" action="index.php" method="POST">
            <label for="email">Enter your email</label>
            <input type="email" name="email" id="email" placeholder="arya@westeros.com" value="'.
               isset($_SESSION['current_user']['email']) ? $_SESSION['current_user']['email'] : '' .'">
            '. isset($GLOBALS['message']['email']) ? $GLOBALS['message']['email'] : '' .'
            <hr color="#d3bb89">
            <label for="password">Choose secure password<br><span>Must be least 8 characters</span></label>
            <input type="password" name="password" placeholder="password" minlength="8" id="password">
             '. isset($GLOBALS['message']['password']) ? $GLOBALS['message']['password'] : '' .'
            <hr color="#d3bb89">
            <label >
                <input type="checkbox" class="checkbox" name="remember" id="checkbox"><span class="mycheckbox"></span>
                Remember me
            </label>
            <input type="submit" name="submit" id="login" value="Sign Up" class="button">
        </form>';
    
    $formSecond = '<form id="formSecond" action="index.php" method="POST">
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
    
    
    if(empty($_SESSION['form'])){
        return $formFirst;
    }
    if($_SESSION['form'] == 'second'){
        return $formSecond;
    }
}

			

$form = viewsForm();
		
require 'template.php';