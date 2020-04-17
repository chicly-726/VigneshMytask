<?php
require_once "Collection_Class.php";
require_once "Data_Info.php";

	// $objAccesscrl=new Access_Controller();
	// $state = array("current_date"=> "03/18/2020", "current_page" =>"1137", "current_user" => "13");
	// //$primary_data = array("Userinfo"=>(new UserInfo(2, "vignesh","admin",new User_Memberships("junior_physics","12/03/2020"))), "Memberships"=>array((new Memberships("junior_physics","1 Year",array("1"=>"Introduction To Physics","2"=>"Newtonian Physics","3"=>"Laws of Motion")))),"Pages" => array(new Pages("category_id","1212")));
	// $flag=$objAccesscrl->getaccess_controller($state);
	// if($flag)
	// {
	// 	echo "<br>True";
	// }
	// else
	// {
	// 	echo "<br>False";
	// }
class Access_Controller
{
public function getaccess_controller($state,$primary_data=null)
{	
	$userDetails=getValues_fromUser($state['current_user']);
		if($userDetails!="Invalid")
		{
			$usrInfo=new \stdClass();
			$usrInfo=$userDetails;
		 //echo $usrInfo->getUserRole();
			switch($usrInfo->getUserRole())
			{
				case "admin":
				return true;
				break;
				case "editor":
				return true;
				break;
				case "subscriber":			
					$meObj=new \stdClass();
					
					$meObj=Memberships_values($usrInfo->getMember_Catg());
			if($meObj!="Invalid")
			{
					$dur=$meObj->getDuration();
					$allowed_categories=$meObj->getAllowed_categories();			
					if($this->calculateDuration($dur,$state['current_date']))
					{		
							$pageValue=new \stdClass();
							$pageValue=page_values($state['current_page']);
							if($pageValue!="Invalid")
							{
								$pageCateg=$pageValue->getPage_categ();					
								if($this->page_category_daywise_Show($allowed_categories,$state['current_date'],$pageCateg))
								return true;
								else 
									return false;
							}
							else
							{
								// echo "<br>Current Page Not avalibale<br>";
								return false;
							}
					}
					else
					{
						// echo "<br>Please activate Memberships<br>";
						return false;
					}	
			}else{
				// echo "Memberships categories not avalibale";
			}			
				break;
			}
	}else{
			// echo "Current User Not avalibale Please Register.";
		return false;
	}
}
private function page_category_daywise_Show($allowed_categories,$activationDate,$pageCateg)
{
		$keyFlag=false;
		$count=0;
		$curdateget=date("m/d/Y");
		$date1=date_create($curdateget);
		$date2=date_create($activationDate);
		$diff=date_diff($date1,$date2);
		$getdaysvalues=$diff->format("%a");
		
				foreach($allowed_categories as $key=>$values)
						{
							
							if($count<$getdaysvalues)
							{
								// echo $values."<br>";
							}
							if($key==$pageCateg)
							{
								$keyFlag=true;
								break;
							}
							
						}
				if(!$keyFlag)	
				{
							// echo "<br>Memberships categorid Not avalibale<br>";
							return false;
				}else{
					return true;
				}
					
}
private function calculateDuration($getdurtn,$compDuration)
{	
		$dateget=date("m/d/Y");
		$date1=date_create($dateget);
		$date2=date_create($compDuration);
		$diff=date_diff($date1,$date2);		
	if(strpos($getdurtn,"months")!= null)
	{
		
		$getvalues=(($diff->format("%a"))/30);
		$arr=explode(" ",$getdurtn);	
		if($arr[0]>=$getvalues){
			return true;
		}else
			return false;
	}
	else if(strpos($getdurtn,"year")!= null)
	{	
	$getvalues=(($diff->format("%a"))/365);
			$arr=explode(" ",$getdurtn);		
		if($arr[0]>=$getvalues){
			return true;
		}else
			return false;
	}
	else if(strpos($getdurtn,"days")!= null)
	{			
	$getvalues=(($diff->format("%a")));
			$arr=explode(" ",$getdurtn);		
		if($arr[0]>=$getvalues){
			return true;
		}else
			return false;
	}
	return false;
}
}
?>