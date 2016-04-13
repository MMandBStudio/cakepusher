<?php
/**
 * Package: MMandBStudio/CakePusher
 * Version 0.1
 *
 * Author: MM&B Studio
 *
 * Description: A small class of tools to use Pusher (https://pusher.com/) with CakePHP 3.*.* 
 * Based on the Pusher Activity class
 *
 * License: MIT
 *
 */

class CakePusher {

    /**
     * Constructor for the class
     *
     */
    public function __construct($activity_type, $action_text, $options = array()) {
    
        $options = $this->set_default_options($options);
          
        date_default_timezone_set('UTC');

        $this->type = $activity_type;
        $this->id = uniqid();
        $this->date = date('r');

        $this->action_text = $action_text;
        $this->display_name = $options['displayName'];
        $this->image = $options['image'];
    }
  
    /**
     * Build a message
     *
     */
    public function getMessage() {
        $activity = [];
        $activity['id'] = $this->id;
        $activity['body'] = $this->action_text;
        $activity['published'] = $this->date;
        $activity['type'] = $this->type;
        $activity['actor'] = [
            'displayName' => $this->display_name,
            'objectType' => 'person',
            'image' => $this->image
        ];
        return $activity;
    }

    /**
     * Set up default options
     *
     */
    private function set_default_options($options) {
        $defaults = array ( 'email' => null,
                        'displayName' => null,
                        'image' => array(
                            'url' => 'http://marketsmeet.s3.amazonaws.com/temp-avatar.png',
                            'width' => 48,
                            'height' => 48
                         )
                      );
        foreach ($defaults as $key => $value) {
            if ( isset($options[$key]) == false ) {
                $options[$key] = $value;
            }
        }
        return $options;
    }


} // End Activity Class
