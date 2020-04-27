<?php
class VillageOffensif
{
	protected $id;
	protected $proprietaire;
	protected $x;
	protected $y;
	protected $pt;
	protected $bottes;
	protected $cible;
    protected $cdt;
    protected $valider;
	
	private $connexion;
    
    public static $vitesse_botte = array('mercenaire' => 25, 'guerrier' => 50, 'archer' => 75);
	
	public function __construct(&$_SQL)
	{
		$this->connexion = $_SQL;
	}
    
	public static function getAll($_SQL)
	{
		$retour = array();
		
		$req = 'SELECT * FROM village_offensif';
		
		foreach($_SQL->query($req) as $village)
		{
			$retour[$village['id']] = new VillageOffensif($_SQL);
			
			$retour[$village['id']]->setId($village['id']);
			$retour[$village['id']]->setProprietaire($village['proprietaire']);
			$retour[$village['id']]->setX($village['x']);
			$retour[$village['id']]->setY($village['y']);
			$retour[$village['id']]->setPt($village['pt']);
			$retour[$village['id']]->setBottes($village['bottes']);
			$retour[$village['id']]->setCible($village['cible']);
            $retour[$village['id']]->setCdt($village['cdt']);
            $retour[$village['id']]->setValider($village['valider']);
		}
		
		return $retour;
	}
	
	public function save()
	{
		$req = 'INSERT INTO village_offensif(proprietaire, x, y, pt, bottes, cible, cdt, valider) VALUES (:proprietaire, :x, :y, :pt, :bottes, :cible, :cdt, :valider)';

		$req .= 'ON DUPLICATE KEY UPDATE pt=VALUES(pt), bottes=VALUES(bottes), cible=VALUES(cible), cdt=VALUES(cdt)';

		$rep = $this->connexion->prepare($req);

		$rep->execute(array(	':proprietaire' => $this->proprietaire,
                                                ':x' => $this->x,
                                                ':y' => $this->y,
                                                ':pt' => $this->pt,
                                                ':bottes' => $this->bottes,
                                                ':cible' => $this->cible,
												':cdt' => $this->cdt,
												':valider' => 0));
							
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
	
	public function setProprietaire($proprietaire)
	{
		$this->proprietaire = $proprietaire;
	}
	
	public function setX($x)
	{
		$this->x = $x;
	}
	
	public function setY($y)
	{
		$this->y = $y;
	}
	
	public function setPt($pt)
	{
		$this->pt = $pt;
	}
	
	public function setBottes($bottes)
	{
		$this->bottes = $bottes;
    }

    public function setCible($cible)
	{
		$this->cible = $cible;
    }

    public function setCdt($cdt)
    {
        $this->cdt = $cdt;
    }

    public function setValider($valider)
    {
        $this->valider = $valider;
    }
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getProprietaire()
	{
		return $this->proprietaire;
	}
	
	public function getX()
	{
		return $this->x;
	}
	
	public function getY()
	{
		return $this->y;
	}
	
	public function getPt()
	{
		return $this->pt;
	}
	
	public function getBottes()
	{
		return $this->bottes;
    }
    
    public function getCible()
    {
        return $this->cible;
    }  

    public function getCDT()
    {
        return $this->cdt;
    }  

    public function getValider()
    {
        return $this->valider;
    }
}
?>