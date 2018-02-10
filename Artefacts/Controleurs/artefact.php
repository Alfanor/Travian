<?php
(!empty($_GET['action'])) ? ($action = $_GET['action']) : ($action = 0);
(!empty($_GET['id'])) ? ($id_artefact = $_GET['id']) : ($id_artefact = 0);

$_TITRE = 'Gestion des artefacts';

$_CSS[] = 'artefact.css';
$_CSS[] = 'jquery-ui.min.css';

$_JS[] = 'jquery.min.js';
$_JS[] = 'jquery-ui.min.js';
$_JS[] = 'artefact.php?action=' . $action . '&amp;id=' . $id_artefact;

$success = false;

if($action == 1)
{    
    $source = Utilitaire::nettoyer($_POST['code']);

    preg_match_all('/<td class="nam"><a href="build\.php(.*)show=(.*)">(.*)<\/a>/U', $source, $donnees);
    preg_match_all('/<td class="pla"><a href="karte\.php\?d=(.*)">(.*)<\/a>/U', $source, $proprietaires);
        
    $noms_artes = array_values($donnees[3]);
    $id_artes = array_values($donnees[2]);

    $noms_joueurs = array_values($proprietaires[2]);
    $coordonnees = array_values($proprietaires[1]);

    $success = Artefact::insererListe($_SQL, $id_artes, $noms_artes, $coordonnees);
}

else if($action == 2)
{
    if(!empty($_POST['proprietaire']) && isset($_POST['x']) && isset($_POST['y']) && !empty($_POST['bottes']) && isset($_POST['pt']) && !empty($_POST['cible']) && isset($_POST['cdt']))
    {
        if(($_POST['x'] < 401) && ($_POST['x'] > -401) && ($_POST['y'] < 401) && ($_POST['y'] > -401) && in_array($_POST['bottes'], array('aucune', 'mercenaire', 'guerrier', 'archer')) && in_array($_POST['cible'], array('unique', 'majeur', 'mineur', 'tournante')) && ($_POST['pt'] >= 0) && ($_POST['pt'] <= 20) && ($_POST['cdt'] == 10 || $_POST['cdt'] == 20 || $_POST['cdt'] == 0))
        {
            if($_POST['bottes'] == 'aucune')
                $_POST['bottes'] = null;

            // Si tout semble bon on enregistre sans chercher à comprendre
            $village = new VillageOffensif($_SQL);
            $village->setProprietaire($_POST['proprietaire']);
            $village->setX($_POST['x']);
            $village->setY($_POST['y']);
            $village->setPt($_POST['pt']);
            $village->setBottes($_POST['bottes']);
            $village->setCible($_POST['cible']);
            $village->setCDT($_POST['cdt']);
            
            $success = $village->save();
        }
    }
}

$liste_artefacts = Artefact::getAll($_SQL);
$liste_villages = VillageOffensif::getAll($_SQL);

if(!empty($id_artefact))
{
    /* On calcule les distances entre les villages et les artefacts */
    $distances = array();

    foreach($liste_artefacts as $artefact)
    {
        $distances[$artefact->getId()] = array();
        
        $minimum_duree = null;
        $minimum_id = null;
        
        foreach($liste_villages as $village)
        {
                if(($artefact->getType() == 'unique' && ($village->getCible() == $artefact->getType() || $village->getCible() == 'tournante')) ||
                    ($artefact->getType() == 'majeur' && ($village->getCible() == $artefact->getType() || $village->getCible() == 'tournante' || $village->getCible() == 'unique')) ||
                    $artefact->getType() == 'mineur')
                {
                    if($village->getCible() != 'tournante')
                        $duree = Utilitaire::duree_trajet($village->getX(), $village->getY(), $artefact->getX(), $artefact->getY(), 3, $village->getBottes(), $village->getPt());
                        
                    else
                        $duree = Utilitaire::duree_trajet($village->getX(), $village->getY(), $artefact->getX(), $artefact->getY(), 3, $village->getBottes(), $village->getPt());
                        
                    $duree_buffer = $duree[0] * 60 + $duree[1];
                    
                    if(($minimum_duree == null) || ($minimum_duree > $duree_buffer))
                    {
                        $minimum_id = $village->getId();
                        $minimum_duree = $duree_buffer;
                    }
                        
                    $distances[$artefact->getId()][$village->getId()] = $duree;    
                }
        } 
            
            $distances[$artefact->getId()][0] = $minimum_id;
    }

    // On va trier les villages offensifs selon la durée de trajet qu'ils ont pour rejoindre l'artefact demandé
    asort($distances[$id_artefact]);

    $liste_villages_buffer = array();

    foreach($distances[$id_artefact] as $id_village => $distance)
    {
        foreach($liste_villages as $cle => $village)
        {
            if($cle == $id_village)
            {
                $liste_villages_buffer[] = $liste_villages[$cle];
                
                break;
            }
        }
    }

    /*var_dump($distances[$_GET['id']]);
    var_dump($liste_villages_buffer);*/

    $liste_villages  = $liste_villages_buffer;
}

else
{
    /* On calcule les distance entre les villages et les artefacts */
    $distances = array();

    foreach($liste_artefacts as $artefact)
    {
        $distances[$artefact->getId()] = array();
        
        $minimum_duree = null;
        $minimum_id = null;
        
        foreach($liste_villages as $village)
        {
            if(($artefact->getType() == 'unique' && ($village->getCible() == $artefact->getType() || $village->getCible() == 'tournante')) ||
                    ($artefact->getType() == 'majeur' && ($village->getCible() == $artefact->getType() || $village->getCible() == 'tournante' || $village->getCible() == 'unique')) ||
                    $artefact->getType() == 'mineur')
            {
                $duree = Utilitaire::duree_trajet($village->getX(), $village->getY(), $artefact->getX(), $artefact->getY(), 3, $village->getBottes(), $village->getPt());
            
                $duree_buffer = $duree[0] * 60 + $duree[1];
                
                if(($minimum_duree == null) || ($minimum_duree > $duree_buffer))
                {
                    $minimum_id = $village->getId();
                    $minimum_duree = $duree_buffer;
                }
                    
                $distances[$artefact->getId()][$village->getId()] = $duree;    
            }
        } 
            
            $distances[$artefact->getId()][0] = $minimum_id;
    }
}

ob_start();

require_once('Vues/Template/header.php');
require_once('Vues/Template/artefact.php');

ob_get_contents();
?>
