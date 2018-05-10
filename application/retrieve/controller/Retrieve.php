<?php
/**
 * Created by PhpStorm.
 * User: GDB user
 * Date: 2018/5/4
 * Time: 下午 2:44
 */

namespace app\retrieve\controller;

use app\retrieve\Model\ManModel;
use app\retrieve\Model\MysqlModel;
class Retrieve
{
    public function index() {
        $type = 'getall';
        $date = '2018-03-06';
        $manModel = new ManModel("system", "root", "10.10.2.159/ORCL");
        //Be award: Array order MATTERS! ↓
        //$tables = array("E_PRI_PERSON", "E_PB_OPERATOR", "E_BASEINFO", "E_PB_BASEINFO");
        $tables = array("E_BASEINFO");
        $rows_each_time = 1000;
        $start = time();
        switch ($type) {
            case 'getall':
                foreach ($tables as $t) {
                    for ($min = 1, $max = $rows_each_time; ; $min += $rows_each_time, $max += $rows_each_time) {
                        $rtn = $manModel -> get_all($t, $min, $max);
                        if ($rtn == null) {
                            break;
                        }
                        $this -> send2mysql($t, $rtn);
                        break;
                    }
                }
                break;
            case 'getallupdate':
                foreach ($tables as $t) {
                    for ($min = 0, $max = $rows_each_time; ; $min += $rows_each_time, $max += $rows_each_time) {
                        $rtn = $manModel -> get_update($t, $min, $max, $date);
                        if ($rtn == null) {
                            break;
                        } elseif (count($rtn) == 1000){
                            //TODO sending alert
                        }
                    }
                }
                break;
            default:
                return false;
        }
        $manModel -> close_db();
        $takes = time() - $start;
        return "done: ".$takes.'s';
    }

    private function send2mysql($table, $arr) {
        foreach ($arr as &$a) {
            unset($a['NUM']);
        }
        if (!strcmp("E_BASEINFO", $table)) {
            return MysqlModel::insert_data("E_BASEINFO_UP", $arr);
        } elseif (!strcmp("E_PB_BASEINFO", $table)) {
            return MysqlModel::insert_data("E_PB_BASEINFO_UP", $arr);
        }
        return MysqlModel::insert_data($table, $arr);
    }
}
