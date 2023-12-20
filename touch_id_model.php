<?php

use CFPropertyList\CFPropertyList;

class Touch_id_model extends \Model
{
    public function __construct($serial = '')
    {
        parent::__construct('id', 'touch_id'); // Primary key, tablename
        $this->rs['id'] = '';
        $this->rs['serial_number'] = $serial;
        $this->rs['enabled'] = null; // Boolean 0/1
        $this->rs['unlock'] = null; // Boolean 0/1
        $this->rs['fingerprints'] = null;
        $this->rs['timeout'] = null;
        $this->rs['match_timeout'] = null;
        $this->rs['passcode_input_timeout'] = null;

        if ($serial) {
            $this->retrieve_record($serial);
        }

        $this->serial_number = $serial;
    }


    // ------------------------------------------------------------------------
    /**
     * Process data sent by postflight
     *
     * @param string data
     *
     **/
    public function process($data)
    {
        // If data is empty, echo out error
        if (! $data) {
            echo ("Error Processing touch_id module: No data found");
        } else { 

            // Process incoming touch_id.plist
            $parser = new CFPropertyList();
            $parser->parse($data, CFPropertyList::FORMAT_XML);
            $plist = $parser->toArray();

            // Process all the plist keys
            foreach (array('enabled', 'unlock', 'fingerprints', 'timeout', 'match_timeout', 'passcode_input_timeout') as $item) {
                // If key does not exist in $plist, null it
                if ( ! array_key_exists($item, $plist) || $plist[$item] == '') {
                    $this->$item = null;
                // Set the db fields to be the same as those in the plist cache file
                } else {
                    $this->$item = $plist[$item];
                }
            }

            // Save the data, finger the prints
            $this->save(); 
        }
    }
}