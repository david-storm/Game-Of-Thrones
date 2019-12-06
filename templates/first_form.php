<?php
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