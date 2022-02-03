<?php
# Created by Eddie aka R3mad3
# Version 1.0
# ChatAPI

### Chat fetching settings
# These settings are for fetching chat data.
//$delete_chats_after = 10 // clear log after 10 messages to keep everything small..
//coming soon


### Chat Settings
$max_length = 100; // Max char length per message.
$min_length = 1; // Minimum char length per message.
$banned_words = array("fuck","bitch","pussy"); // Add bad words here... message wont send through with badwords.. they will be replaced in next update.

### Auth & Cool-down & username settings.

$username_max_letters = 15; // max chars in username
$username_min_letters = 3; // minimum chars in username
$username_inuse = false; // Allows users to use there own username. else it sets username as the following "Anonymous"
$username = ""; // leave this alone
$default_username = "Anonymous"; // default username.

$auth = true; // They have to have a key to access.
$auth_keys = array("autyhqjdifmv", "authexample12345","test"); // Dont use special chars.

$message_cool_down = true; // Adds cool down after each 
$message_timer = 2; // 2s cool-down before next message




