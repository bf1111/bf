<?php
class db_class
{
    public $db_url; //连接地址
    public $db_username; //连接名
    public $db_userpassword; //连接密码
    public $db_name; //数据库名
    public $db_tablename; //表名
    public $db_conn; //数据库连接
    public $db_order; //数据排序
    public $db_limit; //分页

    /**
     * 连接数据库服务器并选择数据库
     *
     * @return void
     */
    public function db_getconn()
    { //连接数据库
        $this->db_conn = mysqli_connect($this->db_url, $this->db_username, $this->db_userpassword, $this->db_name);
        if (!$this->db_conn) {
            echo "连接 MySQL 失败: " . mysqli_connect_error();
        }
    }

    /**
     * 构造函数
     *
     * @param [type] $db_url
     * @param [type] $db_username
     * @param [type] $db_userpassword
     * @param [type] $db_name
     */
    public function __construct($db_url, $db_username, $db_userpassword, $db_name)
    { //构造方法赋值
        $this->db_url = $db_url;
        $this->db_username = $db_username;
        $this->db_userpassword = $db_userpassword;
        $this->db_name = $db_name;
        $this->db_order = "";
        $this->db_limit = "";
        $this->db_getconn();
        mysqli_query($this->db_conn, 'set names utf8');
    }

    /**
     * 选择数据表
     *
     * @param [type] $db_tablename
     * @return void
     */
    public function db_settablename($db_tablename)
    { //设置表名
        $this->db_tablename = $db_tablename;
    }

    /**
     * 排序
     *
     * @param [type] $str
     * @return void
     */
    public function db_setorder($str)
    { //排序操作
        $this->db_order = "ORDER BY $str";
    }

    /**
     * 分页
     *
     * @param [type] $start  开始
     * @param [type] $end  结尾
     * @return void
     */
    public function db_setlimit($page, $pagesize = "15")
    { //分页操作
        // $this->db_limit = "limit $start,$end";
        //查询总数据数
        $sql = "SELECT * FROM $this->db_tablename";
        $result = mysqli_query($this->db_conn, $sql);
        $num = mysqli_num_rows($result);   //取得数据总数
        $allpage = $num / $pagesize;
        if (empty($page) || $page == 0) {
            $page = 1;
        }
        $start = ($page - 1) * $pagesize;   //开始数
        $sql = "SELECT * FROM $this->db_tablename $this->db_order LIMIT $start,$pagesize";
        $result = mysqli_query($this->db_conn, $sql);
        if ($result) {
            while ($row = $result->fetch_array()) {
                $arr[] = $row;
            }
        }
        $res['page'] = $allpage;
        $res['data'] = $arr;
        return $res;
    }

    /**
     * 数据查询
     *
     * @param string $typearr
     * @param string $where
     * @return void
     */
    public function db_select($typearr = "", $where = "")
    { //查询操作
        if (empty($typearr)) {
            $typearr = "*";
        } else {
            $typearr = implode(",", $typearr);
        }
        if (empty($where)) {
            $where = "";
        } else {
            $where = "WHERE " . $where;
        }
        $arr = array();
        $sql = "SELECT $typearr FROM $this->db_tablename $where $this->db_order $this->db_limit ";
        $result = mysqli_query($this->db_conn, $sql);
        if ($result) {
            while ($row = $result->fetch_array()) {
                $arr[] = $row;
            }
            return $arr;
        } else {
            return 0;
        }
    }

    /**
     * 数据更新
     *
     * @param [type] $typearr
     * @param [type] $valuearr
     * @param string $where
     * @return void
     */
    public function db_update($typearr, $valuearr, $where = "")
    { //更新操作
        $sql = "";
        if (empty($where)) {
            $where = "";
        } else {
            $where = " WHERE " . $where;
        }
        $sql .= "UPDATE $this->db_tablename SET ";
        foreach ($typearr as $key => $value) {
            if (count($typearr) - 1 == $key) {
                $sql .= $value . "='" . $valuearr[$key] . "'";
            } else {
                $sql .= $value . "='" . $valuearr[$key] . "'" . ",";
            }
        }
        $sql .= $where;
        if (mysqli_query($this->db_conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除数据
     *
     * @param [type] $typestr 字段
     * @param [type] $valuestr  条件
     * @return void
     */
    public function db_delete($typestr, $valuestr)
    { //删除操作
        $sql = "DELETE FROM $this->db_tablename WHERE $typestr=$valuestr";
        if (mysqli_query($this->db_conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 插入数据
     *
     * @param [type] $typearr  字段
     * @param [type] $valuearr  数据
     * @return void
     */
    public function db_insert($typearr, $valuearr)
    { //插入操作
        $sql = "insert into $this->db_tablename(" . implode(",", $typearr) . ") values(" . implode(",", $valuearr) . ")";
        if (mysqli_query($this->db_conn, $sql))
            return mysqli_insert_id($this->db_conn);
        else
            return 0;
    }

    /**
     * 析构函数
     */
    public function __destruct()
    { //析构方法关闭连接
        mysqli_close($this->db_conn);
    }
}
