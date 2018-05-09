<?php
/**
 * Created by PhpStorm.
 * User: GDB user
 * Date: 2018/5/9
 * Time: 上午 9:53
 */

namespace app\retrieve\controller;

use Thread;
class SenderThread extends Thread
{
    public function __construct($table, $content, $date = null) {
        $this -> table = $table;
        $this -> content = $content;
        $this -> date = $date;
    }

    public function run() {
        //TODO call send function
    }
}