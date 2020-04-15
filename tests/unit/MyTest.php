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
    public function testSomeFeature()
    {
        require_once dirname(dirname(dirname(__FILE__))).'/Access_Controller.php';
        $state = array("current_date"=> "03/18/2020", "current_page" =>"1137", "current_user" => "14");
        
        $access_controller = new Access_Controller();
        $result = $access_controller->getaccess_controller($state);

        $this->assertTrue($result);

    }
}