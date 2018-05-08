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

    public function get_all($min, $max) {
        return array(
            'e_baseinfo' => $this -> e_baseinfoA($min, $max),
            'e_pb_baseinfo' => $this -> e_pb_baseinfoA($min, $max),
            'e_pri_person' => $this -> e_pri_personA($min, $max),
            'e_pb_opeartor' => $this -> e_pb_opeartorA($min, $max)
            );
    }

    public function e_baseinfoA($min, $max) {
        return $this -> oracle -> query("SELECT * FROM E_BASEINFO WHERE ROWNUM >= $min AND ROWNUM <= $max");
    }

    public function e_pb_baseinfoA($min, $max) {
        return $this -> oracle -> query("SELECT * FROM E_PB_BASEINFO WHERE ROWNUM >= $min AND ROWNUM <= $max");
    }

    public function e_pri_personA($min, $max) {
        return $this -> oracle -> query("SELECT * FROM E_PRI_PERSON WHERE ROWNUM >= $min AND ROWNUM <= $max");
    }

    public function e_pb_opeartorA($min, $max) {
        return $this -> oracle -> query("SELECT * FROM E_PB_OPERATOR WHERE ROWNUM >= $min AND ROWNUM <= $max");
    }

    public function get_update($date) {

    }

    public function e_baseinfoU() {

    }

    public function e_pb_baseinfoU() {

    }

    public function e_pri_personU() {

    }

    public function e_pb_opeartorU() {

    }
}