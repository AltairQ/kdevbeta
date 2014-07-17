<?php
//załączamy wszystko za jedym zamachem
session_start();
foreach (glob("model/*.php") as $filename)
{
    require_once $filename;
}

foreach (glob("control/*.php") as $filename)
{
    require_once $filename;
}

foreach (glob("view/*.php") as $filename)
{
    require_once $filename;
}


$DB = db_init();


?>