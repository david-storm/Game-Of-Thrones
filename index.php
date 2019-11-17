<?php
session_start();


//if there is a submit, check what form it came from
if (isset($_POST) && isset($_POST['submit'])) {
    
    if ($_POST['submit'] == 'Sign Up') {
        $result = loginOrRegUser();
        if (isset($result['res']) && $result['res']) {
            nextForm();
        } else {
            $GLOBALS['message'] = $result['message'];
        }
    }
    if ($_POST['submit'] == 'Save') {
        $data = validUserData();
        writeToSession($data);
        if ($data['valid']) {
            unset($data['valid']);
            saveUserData($data);
            unset($_SESSION['current_user']);
            unset($_SESSION['form']);
        }
    }
}

//form validation and authentication
function loginOrRegUser() {
    $result = array();
    
    $email = isset($_POST['email']) ? strval($_POST['email']) : '';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result['message']['email'] = 'E-mail is not valid';
    }
    
    $password = isset($_POST['password']) ? strval($_POST['password']) : '';
    if (strlen($password) < 8) {
        $result['message']['password'] = 'Password is short';
    }
    
    if (empty($result)) {
        $_SESSION['current_user']['email'] = $email;
        $result = auth_user($email, $password);
    }
    return $result;
}

//Check if there is an email in the database and verify the password, or register a new user
function auth_user($email, $password) {

    $fileName = $email . '.json';
    $fullName = 'db_users/' . $fileName;
    
    if (in_array($fileName, scandir('db_users'))) {
        $handle = fopen($fullName, 'r');
        $passInDB = json_decode(fread($handle, filesize($fullName)), TRUE)['password'];
        if ($passInDB == $password) {
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


//form 2, data validation
function validUserData() {
    $message = array();
    $validData = array();
    if (isset($_POST['name']) && $name = $_POST['name']) {
        $validName = preg_match('/^[A-Z][a-z]{1,15}$/', $name);
        if ($validName) {
            $validData['name'] = $name;
        } else {
            $message['name'] = 'Your name must begin with a capital letter, from 2 to 16 letter long, must not contain special characters and spaces.';
        }
    } else {
        $message['name'] = 'You did not fill in the field name.';
    }

    if (isset($_POST['house']) && $house = intval($_POST['house'])) {
        if ($house > 0 && $house < 10) {
            $validData['house'] = $house;
        } else {
            $message['house'] = 'You must choose one of the listed houses .';
        }
    } else {
        $message['house'] = 'You did not fill in the field house.';
    }

    if (isset($_POST['hobbi']) && $hobbi = $_POST['hobbi']) {
        $validHobbi = preg_match('/^.{3,}?\h.{3,}/', $hobbi);
        if ($validHobbi) {
            $validData['hobbi'] = $hobbi;
        } else {
            $message['hobbi'] = 'You must write at least 2 hobbies, each hobia must be longer than 2 characters.';
        }
    } else {
        $message['hobbi'] = 'You did not fill in the field hobbi.';
    }

    if (empty($message)) {
        $validData['valid'] = TRUE;
        return $validData;
    } else {
        $validData['valid'] = FALSE;
        $GLOBALS['message'] = $message;
        return $validData;
    }
}

function writeToSession($data) {
    $_SESSION['current_user']['name'] = isset($data['name']) ? $data['name'] : '';
    $_SESSION['current_user']['house'] = isset($data['house']) ? $data['house'] : '';
    $_SESSION['current_user']['hobbi'] = isset($data['hobbi']) ? $data['hobbi'] : '';
}

function saveUserData($data) {
    $fullName = 'db_users/' . $_SESSION['current_user']['email'] . '.json';
    echo $fullName;
    $handle = fopen($fullName, 'r+');
    $data['password'] = json_decode(fread($handle, filesize($fullName)), TRUE)['password'];
    ftruncate($handle,0);
    rewind($handle);
    fwrite($handle, json_encode($data));


    fclose($handle);
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

$imagesSlaider = array_diff(scandir('img'), array('..', '.', 'fon.png', 'logo.jpg'));
$slaider = '';
foreach ($imagesSlaider as $img) {
    $slaider .= '<div><img src="img/' . $img . '" class="slider__img"></div>';
}

function nextForm() {
    $_SESSION['form'] = 'second';
}

function viewsForm() {

    $email = empty($_SESSION['current_user']['email']) ? '' : $_SESSION['current_user']['email'];
    $name = empty($_SESSION['current_user']['name']) ? '' : $_SESSION['current_user']['name'];
    $house = empty($_SESSION['current_user']['house']) ? '' : $_SESSION['current_user']['house'];
    $hobbi = empty($_SESSION['current_user']['hobbi']) ? '' : $_SESSION['current_user']['hobbi'];

    $messageEmail = empty($GLOBALS['message']['email']) ? '' : $GLOBALS['message']['email'];
    $messagePassword = empty($GLOBALS['message']['password']) ? '' : $GLOBALS['message']['password'];
    $messageName = empty($GLOBALS['message']['name']) ? '' : $GLOBALS['message']['name'];
    $messageHouse = empty($GLOBALS['message']['house']) ? '' : $GLOBALS['message']['house'];
    $messageHobbi = empty($GLOBALS['message']['hobbi']) ? '' : $GLOBALS['message']['hobbi'];

    $formFirst = '<form  id="formFirst" action="index.php" method="POST">
            <label for="email">Enter your email</label>
            <input type="email" name="email" id="email" placeholder="arya@westeros.com" value="' . $email . '">
            <div class="wrongField">' . $messageEmail . '</div>
            <hr color="#d3bb89">
            <label for="password">Choose secure password<br><span>Must be least 8 characters</span></label>
            <input type="password" name="password" placeholder="password" minlength="8" id="password">
            <div class="wrongField">' . $messagePassword . '</div>
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
            <input type="text" name="name" id="name" placeholder="arya" value="' . $name . '">
                  <div class="wrongField">' . $messageName . '</div>
            <hr color="#d3bb89">
            <label for="house">Your Great House</label>
            <select id="house" name="house" value="' . $house . '">
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
             <div class="wrongField">' . $messageHouse . '</div>
            <hr color="#d3bb89">
            <label for="hobbi">Your preferences, hobbies, wishes, etc.</label>
            <textarea id="hobbi" name="hobbi" rows="2" placeholder="I have a long TOKILL list...">' . $hobbi . '</textarea>
             <div class="wrongField">' . $messageHobbi . '</div>
            <hr color="#d3bb89">
            <input type="submit" name="submit" value="Save" id="save" class="button">
	</form>';


    if (empty($_SESSION['form'])) {
        return $formFirst;
    }
    if ($_SESSION['form'] == 'second') {
        return $formSecond;
    }
}

$form = viewsForm();

require 'template.php';
