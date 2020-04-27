<?php
class Utilitaire
{
    public static function duree_trajet($x_depart, $y_depart, $x_arrivee, $y_arrivee, $vitesse, $botte, $pt)
    {       
        $distance = sqrt(pow(($x_arrivee - $x_depart), 2) + pow(($y_arrivee - $y_depart), 2));
        
        // On calcule la durée pour les 20 premières cases
        ($distance > 20) ? ($buffer_distance = 20) : ($buffer_distance = $distance);
        
        $duree_trajet_heure = floor($buffer_distance / $vitesse);
        $duree_trajet_minute = floor((fmod($buffer_distance, $vitesse) / $vitesse) * 60);
        
        // S'il y a plus de 20 cases on calcule avec l'effet de la PT et des bottes
        if($distance > 20)
        {
            $buffer_distance = $distance - 20;
            
            $buffer_vitesse = $vitesse * (1 + $pt / 5);
            
            if($botte != null)
                $buffer_vitesse += ($vitesse * (VillageOffensif::$vitesse_botte[$botte] / 100));
            
            $duree_trajet_heure += floor($buffer_distance / $buffer_vitesse);
            $duree_trajet_minute += floor((fmod($buffer_distance, $buffer_vitesse) / $buffer_vitesse) * 60);
            
            if($duree_trajet_minute >= 60)
            {
                $duree_trajet_heure += floor($duree_trajet_minute / 60);
                $duree_trajet_minute %= 60;
            }
        }
        
        return array($duree_trajet_heure, $duree_trajet_minute);
    }
		
    public static function id_to_coordonnees($id)
    {
        // Coordonnées de l'id 0 = 0|0
        // Coordonnées de l'id 1 = -400|400
        // +1 en x = id + 1
        // -1 en y = id + 801
        if($id == 0)
            return array('x' => 0, 'y' => 0);

        $x = -400 + ($id % 801) - 1;
        $y = 400 - floor($id / 801);
        
        return array('x' => $x, 'y' => $y);
    }

    public static function nettoyer($rapport)
    {
        $patterns = array();
        $patterns[0] = '/\r/';
        $patterns[1] = '/\n/';
        $patterns[2] = '/\t/';
            
        $remplacement = array();
        $remplacement[0] = '';
        $remplacement[1] = '';	
        $remplacement[2] = '';		

        $rapport = preg_replace($patterns, $remplacement, $rapport);
        
        return $rapport;
    }
}
?>