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
     * Get fingerprints for fingerprints widget
     *
     * @author tuxudo
     **/
    public function get_touch_id_fingerprints()
    {
        $sql = "SELECT COUNT(CASE WHEN `fingerprints` <> 'No fingerprints' AND `fingerprints` IS NOT NULL THEN 1 END) AS fingerprints
                    FROM touch_id
                    LEFT JOIN reportdata USING (serial_number)
                    WHERE ".get_machine_group_filter('');

        $out = [];
        $queryobj = new Touch_id_model();
        foreach($queryobj->query($sql)[0] as $label => $value){
                $out[] = ['label' => $label, 'count' => $value];
        }

        jsonView($out);
    }

    /**
    * Get data for button widget
    *
    * @author tuxudo
    **/
    public function get_button_widget($column)
    {
         // Remove non-column name characters
        $column = preg_replace("/[^A-Za-z0-9_\-]]/", '', $column);

        $sql = "SELECT COUNT(CASE WHEN `".$column."` = '1' THEN 1 END) AS 'yes',
                    COUNT(CASE WHEN `".$column."` = '0' THEN 1 END) AS 'no'
                    FROM touch_id
                    LEFT JOIN reportdata USING (serial_number)
                    WHERE ".get_machine_group_filter('');

        $out = [];
        $queryobj = new Touch_id_model();
        foreach($queryobj->query($sql)[0] as $label => $value){
                $out[] = ['label' => $label, 'count' => $value];
        }

        jsonView($out);
    }

    /**
    * Retrieve data in json format
    *
    * @author tuxudo
    **/
    public function get_tab_data($serial_number = '')
    {
        // Remove serial number characters
        $serial_number = preg_replace("/[^A-Za-z0-9_\-]]/", '', $serial_number);

        $sql = "SELECT `enabled`, `unlock`, `timeout`, `match_timeout`, `passcode_input_timeout`, `fingerprints`
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