<?php

namespace Core;

class ComponentSlot
{
    private $after;
    private $log;

    public function __construct($before_callback,$after)
    {
        $this->after = $after;
        $this->start($before_callback);
        $this->log = 'The Callback is not valid. You Should Pass a String of your function name e.g:\'myBeforeFunction\' or Pass a Array Which Contains Your Class Instence And the Mathod Name e.g:\'[$this, myBeforeMathod]\'';
    }

    private function start($before_callback)
    {
         
        if ( is_array($before_callback) ) {
            $before_callback[0]->before($before_callback[1] ?? []);
        } elseif ( is_string($before_callback) ) {
            $before_callback();
        } else {
            error_log($this->log);
        }
    }

    public function end()
    {
        $after_callback = $this->after;
        if ( is_array($after_callback) ) {
            $after_callback[0]->after($after_callback[1] ?? []);
        } elseif ( is_string($after_callback) ) {
            $after_callback();
        } else {
            error_log($this->log);
        }
    }
}
