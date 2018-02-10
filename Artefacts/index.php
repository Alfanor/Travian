<?php
function __autoload($classe) {
    include 'Classes/' . $classe . '.php';
}

session_start();

require_once('Configuration/SQL.php');

$_SQL = new PDO($dsn, $user, $password);

$_SQL->exec("SET CHARACTER SET utf8");

$_HEADER = array();
$_CSS = array();
$_JS = array();

if((!isset($_SESSION['connexion'])) || ($_SESSION['connexion'] != true))
{
    require_once('Controleurs/connexion.php');
}

else if((isset($_SESSION['connexion'])) && ($_SESSION['connexion'] === true))
{
    require_once('Controleurs/artefact.php');
}
?>