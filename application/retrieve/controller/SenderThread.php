<?php
/**
 * Created by PhpStorm.
 * User: GDB user
 * Date: 2018/5/9
 * Time: 上午 9:53
 */

namespace app\retrieve\controller;

use app\retrieve\Model\MysqlModel;

class SenderThread extends \Thread
{
    public function __construct($table, $content) {
        $this -> table = $table;
        $this -> content = $content;
    }

    public function run() {
        if (!strcmp("E_BASEINFO", $this -> table)) {
            return MysqlModel::insert_data("E_BASEINFO_UP", $this -> content);
        } elseif (!strcmp("E_PB_BASEINFO", $this -> table)) {

        }
        return MysqlModel::insert_data($this -> table, $this -> content);
    }
}