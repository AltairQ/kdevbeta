<?php

function printheader($title='KNet')
{

if (date("d.m") == "14.11") {
	$title = "Wszystkiego najlepszego!";
}

echo str_replace("{{title}}", $title, file_get_contents("templates/header.cpl"));
}

function printjsend()
{
	echo file_get_contents("templates/jsend.cpl");
}


function intprintnavbar($db)
{
	if (authcheck()) {
		printnavbar(getRepCount($db, $_SESSION['userid']));
		}
		else
		{
			printnavbar();
		}
		
}

function printnavbar($rcount = 0)
{
	if(authcheck())
	{
		if ($rcount == 0) {
			echo str_replace( array("{{login}}", "{{repcount}}"), array($_SESSION['login'], ""), file_get_contents("templates/navbar_login.cpl")); 

		}
		else
		{
			echo str_replace( array("{{login}}", "{{repcount}}"), array($_SESSION['login'], "<span class=\"badge\">$rcount</span>"), file_get_contents("templates/navbar_login.cpl")); 
		}

		
		}
	else
	{
		echo file_get_contents("templates/navbar.cpl");
	}
	
}


?>