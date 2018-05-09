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
        $tables = array("E_BASEINFO", "E_PB_BASEINFO", "E_PRI_PERSON", "E_PB_OPERATOR");
        switch ($type) {
            case 'getall':
                foreach ($tables as $t) {
                    for ($min = 1, $max = 3000; $manModel -> get_row($max, $t); $min += 3000, $max += 3000) {
                        $senderThread = new SenderThread($t, $manModel -> get_all($t, $min, $max));
                        $senderThread -> start();
                    }
                }
                break;
            case 'getallupdate':
                foreach ($tables as $t) {
                    for ($min = 1, $max = 3000; $manModel -> get_row($max, $t); $min += 3000, $max += 3000) {
                        $senderThread = new SenderThread($t, $manModel -> get_update($t, $min, $max, $date));
                        $senderThread -> start();
                    }
                }
                break;
            default:
                return false;
        }
        return true;
    }
}