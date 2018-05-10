<?php
/**
 * Created by PhpStorm.
 * User: GDB user
 * Date: 2018/5/9
 * Time: 上午 10:45
 */

namespace app\retrieve\Model;


use think\Db;
use think\Model;

class MysqlModel extends Model
{
    public static function insert_data($table, $content) {
        return Db::table($table) -> insertAll($content, true);
    }
}