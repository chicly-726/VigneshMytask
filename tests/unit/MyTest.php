<?php 
class MyTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests

    public function testExpiredMembership()
    {
        require_once dirname(dirname(dirname(__FILE__))).'/Access_Controller.php';

        // 1. Membership expired for 14
        $state = array("current_date"=> "03/18/2020", "current_page" =>"1137", "current_user" => "14");
        
        $access_controller = new Access_Controller();
        $result = $access_controller->getaccess_controller($state);

        $this->assertFalse($result);  
    }

    public function testInvalidMembership()
    {
        // 1. Invalid Membership expired for user_15
        $state = array("current_date"=> "03/18/2020", "current_page" =>"1137", "current_user" => "15");

        $access_controller = new Access_Controller();
        $result = $access_controller->getaccess_controller($state);
        $this->assertFalse($result);
    }

    public function testExcludedPage()
    {
        // 1. Invalid Membership expired for user_15
        $state = array("current_date"=> "03/18/2020", "current_page" =>"1125", "current_user" => "13");

        $access_controller = new Access_Controller();
        $result = $access_controller->getaccess_controller($state);
        $this->assertFalse($result);
    }



}