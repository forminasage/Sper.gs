<?php
/*
 * register.php
 * 
 * Copyright (c) 2014 Andrew Jordan
 * 
 * Permission is hereby granted, free of charge, to any person obtaining 
 * a copy of this software and associated documentation files (the 
 * "Software"), to deal in the Software without restriction, including 
 * without limitation the rights to use, copy, modify, merge, publish, 
 * distribute, sublicense, and/or sell copies of the Software, and to 
 * permit persons to whom the Software is furnished to do so, subject to 
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be 
 * included in all copies or substantial portions of the Software. 
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
 
require "includes/init.php";

function checkInvite($db, $invite_code)
{
    $sql = "SELECT invited_by FROM InviteTree WHERE invite_code 
        COLLATE latin1_general_cs = :invite_code and invited_user IS 
        NULL and created > ".(time()-(60*60*72));
    $statement = $db->prepare($sql);
    $statement->bindParam(":invite_code", $invite_code);
    $statement->execute();
    return $statement->rowCount();
}

if ($site->getRegistrationStatus() == 0) {
    die("Site Registration is closed");
} elseif ($site->getRegistrationStatus() == 1) {
    $csrf->setPageSalt("register");
    if (isset($_GET['code'])) {
        // Validate invite code
        $invite_check = checkInvite($db, $_GET['code']);
        if ($invite_check) {
            $smarty->assign("invite_code", htmlentities($_GET['code']));
            $smarty->assign("invite", $invite_check);
        }
    }
    if ($csrf->validateToken(@$_POST['token'])) {
        if (isset($_POST['username']) && isset($_POST['email'])
            && isset($_POST['password']) && isset($_POST['password2'])
        ) {
            $error_msg = "";
            $smarty->assign("username", htmlentities($_POST['username']));
            $smarty->assign("email", htmlentities($_POST['email']));

            // Validate supplied data
            if (strlen($_POST['password']) < 8) {
                $error_msg = "Password must be at least 8 characters<br />";
            }
            if ($_POST['password'] != $_POST['password2']) {
                $error_msg .= "Password don't match<br />";
            }
            if (!$authUser->validateEmail($_POST['email'])) {
                $error_msg .= "Please enter a valid email address<br />";
            }
            if (checkInvite($db, $_POST['invite_code']) == 0) {
                $error_msg .= "Invalid invite code. Invite codes are case sensitive";
            }
            // Validate username does not exist and
            // check invite code. Then create account
            if ($error_msg == "") {
                $status = $authUser->createUser($_POST['username'], $_POST['password'], $_POST['email'], $site->getRegistrationStatus());
                switch($status){
                    case -1:
                        $error_msg .= "That username already exists<br />";
                        break;
                    case -2:
                        $error_msg
                            .= "Invalid invite code. Invite codes are case sensitive<br />";
                        break;
                    case 1:
                        header("Location: ./index.php?m=1");
                        break;
                }
            }
            $smarty->assign("message", $error_msg);
        }
    }
} elseif ($site->getRegistrationStatus() == 2) {
    if ($csrf->validateToken(@$_POST['token'])) {
        if (isset($_POST['username']) && isset($_POST['email'])
            && isset($_POST['password']) && isset($_POST['password2'])
        ) {
            $error_msg = "";
            $smarty->assign("username", htmlentities($_POST['username']));
            $smarty->assign("email", htmlentities($_POST['email']));

            // Validate supplied data
            if (strlen($_POST['password']) < 8) {
                $error_msg = "Password must be at least 8 characters<br />";
            }
            if ($_POST['password'] != $_POST['password2']) {
                $error_msg .= "Password don't match<br />";
            }
            if (!$authUser->validateEmail($_POST['email'])) {
                $error_msg .= "Please enter a valid email address";
            }
            // Validate username does not exist and
            // check invite code. Then create account
            if ($error_msg == "") {
                $status = $authUser->createUser($_POST['username'], $_POST['password'], $_POST['email'], $site->getRegistrationStatus());
                switch($status){
                    case -1:
                        $error_msg = "That username already exists<br />";
                        break;
                    case -2:
                        $error_msg
                            = "Invalid invite code. Invite codes are case sensitive<br />";
                        break;
                    case 1:
                        header("Location: ./index.php?m=1");
                        break;
                }
            }
            $smarty->assign("message", $error_msg);
        }
    }
}
$smarty->assign("registration_status", $site->getRegistrationStatus());
$smarty->assign("token", $csrf->getToken());
// Set template page
$display = "register.tpl";
$page_title = "Register";
require "includes/deinit.php";
