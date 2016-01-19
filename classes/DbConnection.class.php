<?php
/*
::::METHODS::::
getRows($sql)
insert($sql)
delete($sql)
*/

class DbConnection {
	
    private $db_host = 'localhost';
    private $db_user = 'danx2842';
    private $db_name = 'danx2842';
    private $db_pw   = 'kea111286#';
    private $db_link;

    /**
     * Create a new connection to the database
     */
    public function __construct() {
        $connection = mysql_connect($this->db_host, $this->db_user, $this->db_pw);
        if (!$connection) {
            die("Unable to connect to the server. " . mysql_error());
        }
        if (!mysql_select_db($this->db_name, $connection)) {
            die("Unable to connect to the database. " . mysql_error());
        }
        mysql_query('SET CHARACTER SET utf8', $connection);
        $this->db_link = $connection;
    }
	
	
    /**
     * insert into the database
     * @param string $sql is the INSERT statement
     */
	    public function insert($sql) {
        $result = mysql_query($sql, $this->db_link);
        if (!$result) {
            die("\"$sql\" seems to be an invalid query: " . mysql_error());
        }
		return true;
    }
	
	
    /**
     * delete from the database
     * @param string $sql is the DELETE statement
     */
	
	public function delete($sql) {
        $result = mysql_query($sql, $this->db_link);
        if (!$result) {
            die("\"$sql\" seems to be an invalid query: " . mysql_error());
        }
		return true;
    }
	
	
		public function update($sql) {
        $result = mysql_query($sql, $this->db_link);
        if (!$result) {
            die("\"$sql\" seems to be an invalid query: " . mysql_error());
        }
		return true;
    }
	

    /**
     * get the result of an SQL query as a PHP array
     * @param string $sql the query
     * @return array the query result formatted as an array
     */
    public function getRows($sql) {
        $result = array();
        $table = mysql_query($sql, $this->db_link);
        if (!$table) {
            die("\"$sql\" seems to be an invalid query: " . mysql_error());
        }
        while ($row = mysql_fetch_assoc($table)) {
            array_push($result, $row);
        }
        return $result;
    }




}

?>