<?php

function printheader($title='knet')
{
$hdr= file_get_contents("../templates/header.cpl");
echo str_replace("{{title}}", $title, $hdr);
}


?>