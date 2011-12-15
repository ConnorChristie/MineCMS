<?php

class logger {

    public $script;
    public $timestamp;
    public $code;

    public function error($code, $script, $timestamp) {
        $this->code = $code;
        $this->script = $script;
        $this->timestamp = $timestamp;
        $handle = fopen("logs/errors.txt", "a");
        fwrite($handle, "$timestamp - $code error encountered in script $script\r\n");
        fclose($handle);
    }

}