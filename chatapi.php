<?php
include("chatapi_settings.php");
$key = "";

if ($message_cool_down == false){
    $message_timer = 0;
}

if($auth==true){
$key = $_GET['key'];

    if (in_array($key, $auth_keys)){

        run();

    } else {

        echo "bad auth (Please try again).";
        die();
    }

} else {

        run();
}
function array_in_string($str, array $arr) {
    foreach($arr as $arr_value) { //start looping the array
        if (strpos($str,$arr_value) !== false) return true; //if $arr_value is found in $str return true
    }
    return false; //else return false
}
function run(){
    $message = $_GET['message'];
    
    include("chatapi_settings.php");


    if (strlen($message) > $max_length || strlen($message) <= $min_length) { // Checks message length
        echo 'Message is either too long or too short.';
        die();
    }

    if (array_in_string(strtolower($message), $banned_words)){ // checks messages for bad words
        echo "Bad words not allowed.";
        die();
    }

    ## Checks if usernames is enabled and if the username is too long or too short.
    if ($username_inuse == true){
        if (strlen($_GET['username']) >= $username_max_letters || strlen($_GET['username']) <= $username_min_letters) {
            echo "Username too long or too short.";
             die();
        } else {
            $username = $_GET['username'];
            
        }
    } else 
    {
        $username = $default_username;
    }



    $t=time();
    if(file_exists("chat_fetch/chat_main.txt")){

    } else {
        $logs = fopen("chat_fetch/chat_main.txt", "w") or die("Unable to open file!");
        fwrite($logs, "");
        fclose($logs);
    }
    if(file_exists("chat_users/".$_SERVER['REMOTE_ADDR'].".txt"))
        {
            $myfile = fopen("chat_users/".$_SERVER['REMOTE_ADDR'].".txt", "r") or die("Unable to open file!");
            $Time_posted = fread($myfile,filesize("chat_users/".$_SERVER['REMOTE_ADDR'].".txt"));
            $Current_time = date('his', time());
            if ((int)$Current_time <= (int)$Time_posted + $message_timer) {

                echo 'Message sent too fast.';
                die();

            } else {

                ## cool down stuff.
                $myfile = fopen("chat_users/".$_SERVER['REMOTE_ADDR'].".txt", "w") or die("Unable to open file!");
                $txt = date('his', time());
                fwrite($myfile, $txt);
                fclose($myfile);

                ## actual chat sending stuff.
                echo "Successfully sent.";
                //echo "[".date('h:i:s', time())."] ".$username." : ".$message;
                $file = 'chat_fetch/chat_main.txt';
                $current = file_get_contents($file);
                $current .= "[".date('h:i:s', time())."] ".$username." : ".$message."\n";
                file_put_contents($file, $current);


            }

            
        } else {
                ## cool down stuff.
                $myfile = fopen("chat_users/".$_SERVER['REMOTE_ADDR'].".txt", "w") or die("Unable to open file!");
                $txt = date('his', time());
                fwrite($myfile, $txt);
                fclose($myfile);

                ## actual chat sending stuff.
                echo "Successfully sent.";
                //echo "[".date('h:i:s', time())."] ".$username." : ".$message;
                $file = 'chat_fetch/chat_main.txt';
                $current = file_get_contents($file);
                $current .= "[".date('h:i:s', time())."] ".$username." : ".$message."\n";
                file_put_contents($file, $current);
        }


    }