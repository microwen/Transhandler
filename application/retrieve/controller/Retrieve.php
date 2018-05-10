<?php
/**
 * Created by PhpStorm.
 * User: GDB user
 * Date: 2018/5/4
 * Time: 下午 2:44
 */

namespace app\retrieve\controller;

use app\retrieve\Model\ManModel;

class Retrieve
{
    public function index($type, $date) {
        $manModel = new ManModel("root", "root", "localhost/dbname");
        //Be award: Array order MATTERS! ↓
        $tables = array("E_PRI_PERSON", "E_PB_OPERATOR", "E_BASEINFO_UP", "E_PB_BASEINFO_UP");
        $rows_each_time = 1000;
        switch ($type) {
            case 'getall':
                foreach ($tables as $t) {
                    for ($min = 1, $max = $rows_each_time; $manModel -> get_row($max, $t); $min += $rows_each_time, $max += $rows_each_time) {
                        $senderThread = new SenderThread($t, $manModel -> get_all($t, $min, $max));
                        $senderThread -> start();
                    }
                }
                break;
            case 'getallupdate':
                foreach ($tables as $t) {
                    for ($min = 1, $max = $rows_each_time; $manModel -> get_row($max, $t); $min += $rows_each_time, $max += $rows_each_time) {
                        $senderThread = new SenderThread($t, $manModel -> get_update($t, $min, $max, $date));
                        $senderThread -> start();
                    }
                }
                break;
            default:
                return false;
        }
        $manModel -> close_db();
        return true;
    }
}
