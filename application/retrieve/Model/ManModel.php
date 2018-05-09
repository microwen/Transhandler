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
        $rtn = $this -> oracle -> connect($username, $password, $dbname);
        return $rtn;
    }

    public function get_all($table, $min, $max) {
        return $this -> oracle -> query("SELECT * FROM $table WHERE ROWNUM >= $min AND ROWNUM <= $max");
    }

    public function get_update($table, $min, $max, $date) {
        return $this -> oracle -> query("SELECT * FROM $table WHERE S_EXTDATETIME <= $date AND ROWNUM >= $min AND ROWNUM <= $max");
    }

    public function get_row($row, $table) {
        return $this -> oracle -> query("SELECT * FROM $table WHERE ROWNUM = $row");
    }
}