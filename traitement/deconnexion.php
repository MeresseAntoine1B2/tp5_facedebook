<?php
// Celui la aussi ressemble au TP4
session_start();

if(isset($_SESSION["login"]) && isset($_SESSION["id"]))
{
	unset($_SESSION["login"]);
	unset($_SESSION["id"]);
}
?>