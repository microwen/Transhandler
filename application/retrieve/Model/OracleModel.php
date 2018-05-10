<?php
/**
 * Created by PhpStorm.
 * User: GDB user
 * Date: 2018/5/7
 * Time: 下午 3:58
 */

namespace app\retrieve\Model;

class OracleModel {
    /**
     * Connect to the OracleDB
     *
     * @param $username
     * @param $password
     * @param $dbname
     * @param string $charset
     * @param string $pconnect
     * @return bool|resource
     */
    public function connect($username, $password, $dbname, $charset='UTF8',$pconnect='1') {
        if($pconnect) {
            $this->conn = oci_pconnect($username, $password, $dbname, $charset);
        }else {
            $this->conn = oci_connect($username, $password, $dbname, $charset);
        }

        if(!$this->conn) {
            return false;
        } else {
            return $this->conn;
        }
    }

    /**
     * Execute query and return results as an Object
     *
     * @param $sql
     * @return array
     */
    public function query($sql) {
        $this->query = oci_parse($this->conn,$sql);
        oci_execute($this->query);
        $rs = $this->fetch_array();
        return $rs;
    }

    /**
     * Transfers to Array
     *
     * @param int $type
     * @return array
     */
    public function fetch_array($type=OCI_ASSOC) {
        while( $row = oci_fetch_array($this->query,$type) ){
            $rs[] = $row;
        }
        if(1==count($rs)){
            $rs = $rs[0];
        }
        return $rs;
    }

    /**
     * Counts
     *
     * @return mixed
     */
    public function db_count(){
        oci_fetch($this->query);
        $count = oci_result($this->query,1);
        return $count;
    }

    /**
     * Close connection
     *
     * @return bool
     */
    public function close() {
        $re = oci_close($this->conn);
        return $re;
    }

    /**
     * @return mixed
     */
    public function result(){
        oci_fetch($this->query);
        return oci_result($this->query,1);
    }
}