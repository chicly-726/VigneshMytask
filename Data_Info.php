<?php
require_once "Collection_Class.php";
class User_Memberships
{
	private $cat;
	private $activation;
	 public function __construct($cat,$activation)
	{
		$this->cat = $cat;
        $this->activation = $activation;        
    }
	public function getCat()
	{
		return $this->cat;
	}
	public function getactivation()
	{
		return $this->activation;
	}
	public function __toString() 
	{
		return $this->cat."<br>". $this->activation;
	}
}
class UserInfo
{
    private $id;
    private $name;
	private $userRole;	
	private $membership;
    public function __construct($id,$name,$userRole,$temp) 
	{
		$this->id = $id;
        $this->name = $name;
        $this->userRole = $userRole;
		$this->membership=new \stdClass();
		$this->membership=$temp;
		//foreach(Mebershiob::$ars as $car)
    }
public function getUserRole()
{
	return $this->userRole;
}
public function getMember_Catg()
{	
	return $this->membership->getCat();
}
 public function getMember_activation()
{	
	return $this->membership->getactivation();
}   
public function __toString()
 {
        return $this->id."<br>". $this->name."<br>".$this->userRole."<br>". $this->membership->__toString();
 }
}


class Memberships
{
	private $categories;
	private $duration;
	private $allowed_categories;
	public function __construct($categories,$duration,$allowed_categories)
	{
		$this->categories = $categories;
        $this->duration = $duration; 
	    $this->allowed_categories=$allowed_categories;
    }
	public function getDuration()
	{
		return $this->duration;
	}
	public function getAllowed_categories()
	{
		return $this->allowed_categories;
	}
	public function __toString() 
	 {
        return $this->duration."<br>". $this->categories;
	 }
	
}
class Pages
{
	private $id;
	private $categories;
	public function __construct($categories,$id)
	{
		$this->id = $id; 
		$this->categories = $categories;
        
	}
	public function getPage_categ()
	{
	return 	$this->categories;
	}	
	 public function __toString() {
        return $this->id."<br>". $this->categories;
    }
}
function getValues_fromUser($getKey=null)
{
$c = new Collection();
$c->addItem(new UserInfo(2, "vignesh","admin",new User_Memberships("junior_physics","1/03/2020")), "2");
$c->addItem(new UserInfo(3, "sarath","editor",new User_Memberships("junior_physics","02/02/2020")), "3");
$c->addItem(new UserInfo(13, "mani","subscriber",new User_Memberships("junior_chemistry","3/18/2020")), "13");
$c->addItem(new UserInfo(13, "mani","subscriber",new User_Memberships("junior_chemistry","3/18/2019")), "14");
$get="";
if($getKey!=null)
$get=$c->getItem($getKey);
else
$get=$c->showItem();	
return $get;
}
function Memberships_values($getKey=null)
{
	
$d = new Collection();
$d->addItem(new Memberships("junior_physics","1 Year",array("1"=>"Introduction To Physics","2"=>"Newtonian Physics","3"=>"Laws of Motion")),"junior_physics");
$d->addItem(new Memberships("junior_chemistry","3 months",array("21"=>"Introduction To Chemistry","22"=>"Molecular Chemistry","23"=>"Inorganic Chemistry")),"junior_chemistry");
$userDetails=$d->showItem();
$get="";
if($getKey!=null)
$get=$d->getItem($getKey);
else
$get=$d->showItem();	
return $get;
}
function page_values($getKey=null)
{
$e = new Collection();
$e->addItem(new Pages("11","1124"),"1124");
$e->addItem(new Pages("11","1125"),"1125");
$e->addItem(new Pages("11","1126"),"1126");
$e->addItem(new Pages("12","1127"),"1127");
$e->addItem(new Pages("12","1128"),"1128");
$e->addItem(new Pages("13","1129"),"1129");
$e->addItem(new Pages("21","1130"),"1130");
$e->addItem(new Pages("21","1131"),"1131");
$e->addItem(new Pages("21","1132"),"1132");
$e->addItem(new Pages("21","1134"),"1134");
$e->addItem(new Pages("23","1137"),"1137");
$userDetails=$e->showItem();
$get="";
if($getKey!=null)
$get=$e->getItem($getKey);
else
$get=$e->showItem();	
return $get;
}

?>