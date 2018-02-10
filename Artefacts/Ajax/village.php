<?php
(!empty($_GET['id']) && is_numeric($_GET['id'])) ? ($id = $_GET['id']) : $id = -1;

if($id == -1)
    echo json_encode(array('retour' => 1));
    
else
{
    require_once('../Classes/VillageOffensif.php');
    require_once('../Configuration/SQL.php');
    
    $_SQL = new PDO($dsn, $user, $password);

    $_SQL->exec("SET CHARACTER SET utf8");
    
    $req = 'SELECT valider FROM village_offensif WHERE id = :id';
    $rep = $_SQL->prepare($req);
    $rep->execute(array(':id' => $id));
    
    $valider = $rep->fetch();
    $valider = $valider['valider'];
    
    if($valider == 1)
    {
        $req = 'UPDATE village_offensif SET valider = 0 WHERE id = :id';
        $rep = $_SQL->prepare($req);
        $rep->execute(array(':id' => $id));
        
        if($rep->rowCount() == 1)
             echo json_encode(array('retour' => 2)); 
             
        else
             echo json_encode(array('retour' => 1));
    }

    else
    {
        $req = 'UPDATE village_offensif SET valider = 1 WHERE id = :id';
        $rep = $_SQL->prepare($req);
        $rep->execute(array(':id' => $id));
        
        if($rep->rowCount() == 1)
             echo json_encode(array('retour' => 3)); 
             
        else
             echo json_encode(array('retour' => 1));
    }
}
?>