<?php
/**
 * touch_id module class
 *
 * @package munkireport
 * @author tuxudo
 **/
class Touch_id_controller extends Module_controller
{
    
    /*** Protect methods with auth! ****/
    public function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }
    
    /**
    * Default method
    *
    * @author AvB
    **/
    public function index()
    {
        echo "You've loaded the touch_id module!";
    }
    
    /**
    * Retrieve data in json format
    *
    * @return void
    * @author tuxudo
    **/
    public function get_tab_data($serial_number = '')
    {
        // Remove serial number characters
        $serial_number = preg_replace("/[^A-Za-z0-9_\-]]/", '', $serial_number);

        $sql = "SELECT `enabled`, `unlock`, `timeout`, `fingerprints`
                        FROM touch_id 
                        WHERE serial_number = '$serial_number'";

        $obj = new View();
        $queryobj = new Touch_id_model();
        $touch_id_tab_data = $queryobj->query($sql);
        if (array_key_exists(0, $touch_id_tab_data)){
            $obj->view('json', array('msg' => current(array('msg' => $touch_id_tab_data[0]))));
        }
    }
} // End class Touch_id_controller