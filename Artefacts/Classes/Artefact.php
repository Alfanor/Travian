<?php
class Artefact
{
	protected $id;
	protected $nom;
	protected $x;
	protected $y;
	protected $type;
    protected $valider;
	
	protected $connexion;
    
    public static $unique_id = array(11, 22, 33, 44, 65, 76, 87);
    public static $majeur_id = array(1, 2, 3, 4, 12, 13, 14, 15, 23, 24, 25, 26, 34, 35, 36, 37, 45, 46, 47, 48, 55, 56 ,57, 58, 66, 67, 68, 69);
    public static $mineur_id = array(5, 6, 7, 8, 9, 10, 16, 17, 18, 19, 20, 21, 27, 28, 29, 30, 31, 32, 38, 39, 40, 41, 42, 43, 49, 50, 51, 52, 53, 54, 59, 60, 61, 62, 63, 64, 70, 71, 72, 73, 74, 75, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 88, 89, 90, 91, 92, 93, 94, 95, 96);
	
	public function __construct(&$_SQL)
	{
		$this->connexion = $_SQL;
    }

    public static function insererListe($_SQL, $id_artes, $noms_artes, $liste_coordonnees)
    {
        $req = 'INSERT INTO artefacts (id, nom, x, y, type, valider) VALUES ';

        for($i = 0; $i < count($noms_artes); $i++)
        {
            $position = Utilitaire::id_to_coordonnees($liste_coordonnees[$i]);

            if(in_array($id_artes[$i], Artefact::$mineur_id))
                $type = 'mineur';

            if(in_array($id_artes[$i], Artefact::$majeur_id))
                $type = 'majeur';

            if(in_array($id_artes[$i], Artefact::$unique_id))
                $type = 'unique';
        
            if($i == (count($noms_artes)- 1))
                $req .= '(' . $id_artes[$i] . ', "' . $noms_artes[$i] . '", ' . $position['x'] . ', ' . $position['y'] . ', "' . $type . '", 0)';
            
            else				
                $req .= '(' . $id_artes[$i] . ', "' . $noms_artes[$i] . '", ' . $position['x'] . ', ' . $position['y'] . ', "' . $type . '", 0), ';
        }

        $req .= 'ON DUPLICATE KEY UPDATE x=VALUES(x), y=VALUES(y)';

        $nombre = $_SQL->exec($req);

        if($i > 1)
            return true;
            
        return false;
    }

    public static function getAll($_SQL)
	{
		$retour = array();
		
		$req = 'SELECT * FROM artefacts';
		
		foreach($_SQL->query($req) as $artefact)
		{
			$retour[$artefact['id'] ]= new Artefact($_SQL);
			
			$retour[$artefact['id']]->setId($artefact['id']);
			$retour[$artefact['id']]->setNom($artefact['nom']);
			$retour[$artefact['id']]->setX($artefact['x']);
			$retour[$artefact['id']]->setY($artefact['y']);
			$retour[$artefact['id']]->setType($artefact['type']);
            $retour[$artefact['id']]->setValider($artefact['valider']);
		}
        
		return $retour;
    }

    public static function getAllMap($_SQL)
	{
		$retour = array();
		
		$req = 'SELECT * FROM artefacts';
		
		foreach($_SQL->query($req) as $artefact)
		{
			$retour[$artefact['id'] ]= new Artefact($_SQL);
			
			$retour[$artefact['id']]->setId($artefact['id']);
			$retour[$artefact['id']]->setNom($artefact['nom']);
			$retour[$artefact['id']]->setX($artefact['x']);
			$retour[$artefact['id']]->setY($artefact['y']);
			$retour[$artefact['id']]->setType($artefact['type']);
            $retour[$artefact['id']]->setValider($artefact['valider']);
		}
        
		return $retour;
    }

	public function save()
	{
		$req = 'INSERT INTO artefacts (id, nom, x, y, type, valider) VALUES (:id, :nom, :x, :y, :type, 0)';

		$req .= 'ON DUPLICATE KEY UPDATE x=VALUES(x), y=VALUES(y)';

		$rep = $this->connexion->prepare($req);

		$rep->execute(array(	':id' => $this->id,
                                ':x' => $this->x,
                                ':y' => $this->y,
                                ':type' => $this->type));
							
		if($rep->rowCount() == 1)
			return true;
            
        else if($rep->rowCount() == 2)
            return true;
			
		else
            return false;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function setNom($nom)
	{
		$this->nom = $nom;
	}
	
    public function setX($x)
	{
        $this->x = $x;
	}
	
	public function setY($y)
	{
		$this->y = $y;
	}
	
	public function setType($type)
	{
		$this->type = $type;
    }

    public function setValider($valider)
    {
        $this->valider = $valider;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getValider()
    {
        return $this->valider;
    }
}
?>
