<?php
session_start();

/* if there is a submit, check what form it came from */
if (!empty($_POST['submit'])) {
    
    if ($_POST['submit'] == 'Sign Up') {
        
        $result = loginOrRegUser();
        
        if (!empty($result['res'])){
            nextForm($result['res']);
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

/* form validation and authentication */
function loginOrRegUser() {
    $result = [];
    
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

/* Check if there is an email in the database and verify the password, or register a new user */
function auth_user($email, $password) {

    $fileName = $email . '.json';
    $fullName = 'db_users/' . $fileName;
    
    if (in_array($fileName, scandir('db_users'))) {
        $handle = fopen($fullName, 'r');
        $passInDB = json_decode(fread($handle, filesize($fullName)), TRUE)['password'];
        if ($passInDB == $password) {
            $result['res'] = 1;
        } else {
            $result = ['res' => 0, 'message' => ['password' => 'Wrong password']];
        }
    } else {

        $handle = fopen($fullName, 'x');
        fwrite($handle, json_encode(['password' => $password]));
        $result['res'] = 2;
    }
    fclose($handle);
    return $result;
}


/* form 2, data validation */
function validUserData() {
    $message = [];
    $validData = [];
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

    if ((isset($_POST['house']) && $house = intval($_POST['house'])) || isset($_SESSION['current_user']['house']) && $house = $_SESSION['current_user']['house']) {
        if ($house > 0 && $house < 10) {
            $validData['house'] = $house;
        } else {
            $message['house'] = 'You must choose one of the listed houses .';
        }
    } else {
        $message['house'] = 'You did not fill in the field house.';
    }

    if (isset($_POST['hobbi']) && $hobbi = strip_tags($_POST['hobbi'])) {
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
    }
    $validData['valid'] = FALSE;
    $GLOBALS['message'] = $message;
    return $validData;
}

function writeToSession($data) {
    $_SESSION['current_user']['name'] = isset($data['name']) ? $data['name'] : '';
    $_SESSION['current_user']['house'] = isset($data['house']) ? $data['house'] : '';
    $_SESSION['current_user']['hobbi'] = isset($data['hobbi']) ? $data['hobbi'] : '';
}

function saveUserData($data) {
    $fullName = 'db_users/' . $_SESSION['current_user']['email'] . '.json';
    $handle = fopen($fullName, 'r+');
    $data['password'] = json_decode(fread($handle, filesize($fullName)), TRUE)['password'];
    ftruncate($handle,0);
    rewind($handle);
    fwrite($handle, json_encode($data));

    fclose($handle);
}


$house = array(
    "Arryn of the Eyrie",
    "Baratheon of Storm's End",
    "Greyjoy of Pyke",
    "Lannister of Casterly Rock",
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

function nextForm($userLoad) {
    $_SESSION['form'] = 'second';
    if($userLoad === 2){
        return;
    }
    $handle = fopen('db_users/'.$_SESSION['current_user']['email'].'.json', 'r+');
    $data = json_decode(fread($handle, filesize('db_users/'.$_SESSION['current_user']['email'].'.json')), TRUE);
    writeToSession($data);
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

    require'./templates/first_form.php';
    require'./templates/second_form.php';

    if (empty($_SESSION['form'])) {
        return $formFirst;
    }
    if ($_SESSION['form'] == 'second') {
        return $formSecond;
    }
}

$form = viewsForm();
require './templates/page.php';
