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
    public function index() {
        if (empty($_REQUEST['type'])) {
            return "金互通数据库交换程序";
        }
        $manModel = new ManModel("root", "root", "db");
        switch ($_REQUEST['type']) {
            case 'getall':
                return json($manModel -> get_all($_REQUEST['min'], $_REQUEST['max']));
            case 'getallupdate':
                return json($manModel -> get_update($_REQUEST['date'], $_REQUEST['min'], $_REQUEST['max']));
        }
    }
}