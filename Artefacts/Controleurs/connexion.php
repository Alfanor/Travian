<?php
$_TITRE = 'Connexion à la partie privée';

$_CSS[] = 'connexion.css';

$donnees = ob_start();

require_once('Vues/Template/header.php');
require_once('Vues/Template/connexion.php');

if(isset($_GET['connexion']) && ($_GET['connexion'] == 1))
{
    if(!empty($_POST['pseudo']) && !empty($_POST['passe']))
    {
        if(($_POST['pseudo'] == 'travian_artefact') && ($_POST['passe'] == 'travian_artefact'))
        {
            $_SESSION['connexion'] = true;
            
            ob_end_clean();
            
            header('location: index.php');
            
            exit;
        }
    }
    
}

ob_end_flush();
?>
