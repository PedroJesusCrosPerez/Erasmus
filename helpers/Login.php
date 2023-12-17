<?php

class Login
{

    static function login($coordinator, $remember=false)
    {
        if ( !(empty($coordinator) && $coordinator == null) ) 
        {
            Session::save("coordinator", $coordinator);
            header("Location: ?role=coordinator");
        }
    }

    static function logout()
    {
        Session::start();
        Session::delete("coordinator");
    }

    static function isLoged() 
    {
        Session::start();
        return Session::exist("coordinator");
    }

}

?>