<?php

class Controller_Logout extends Controller
{
	function action_index()
	{
        session_start();

        $_SESSION = array();
        session_destroy();

        header("location: /HR/login");
        exit;

	}
}