<?php
/**
 * Created by PhpStorm.
 * User: GDB user
 * Date: 2018/5/7
 * Time: 下午 4:11
 */

namespace app\retrieve\Model;

class ManModel {
    /**
     * ManModel constructor.
     * @param $username
     * @param $password
     * @param $dbname
     */
    public function __construct($username, $password, $dbname) {
        $this -> oracle = new OracleModel();
        $this -> oracle -> connect($username, $password, $dbname);
    }

    public function get_all($table, $min, $max) {
        return $this -> oracle -> query("SELECT * FROM (SELECT rownum NUM, t.* FROM $table t ) WHERE NUM BETWEEN $min AND $max");
    }

    public function get_update($table, $min, $max, $date) {
        //TODO need to be fixed
        //return $this -> oracle -> query("SELECT * FROM (SELECT rownum NUM, t.* FROM $table t WHERE to_char(S_EXT_DATATIME, 'YYYY-MM-DD') = $date) WHERE NUM BETWEEN $min AND $max");
    }

    public function close_db() {
        return $this -> oracle -> close();
    }
}