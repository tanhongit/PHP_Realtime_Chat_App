<?php

class Database
{
    protected $connection = NULL;

    public function __construct()
    {
    }

    /**
     * Connection database
     * @return mysqli|null
     */
    public function connect()
    {
        // Create connection
        if (!$this->connection) {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->connection->set_charset('utf8mb4');
        }
        return $this->connection;
    }

    /**
     * Execute the query and process the returned results
     * @param $sql
     * @return mixed
     */
    public function select($sql)
    {
        $items = array();
        $sql->execute();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    /**
     * Get the data in the table according to the arbitrary request of option
     * @param $table
     * @param array $options
     * @return array|void
     */
    public function getByOptions($table, $options = array())
    {
        $select = isset($options['select']) ? $options['select'] : '*';
        $where = isset($options['where']) ? 'WHERE ' . $options['where'] : '';
        $join = isset($options['join']) ? 'LEFT JOIN ' . $options['join'] : '';
        $order_by = isset($options['order_by']) ? 'ORDER BY ' . $options['order_by'] : '';
        $limit = isset($options['offset']) && isset($options['limit']) ? 'LIMIT ' . $options['offset'] . ',' . $options['limit'] : '';
        $sql = "SELECT $select FROM `$table` $join $where $order_by $limit";
        $query = $this->_query($sql) or die(mysqli_error($this->connectResult));
        $data = array();
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
            mysqli_free_result($query);
        }
        return $data;
    }

    /**
     * Get data in table by id
     * @param $table
     * @param $id
     * @param string $select
     * @return array|false|string[]|void|null
     */
    public function getRecordByID($table, $id, $select = '*')
    {
        $id = intval($id);
        $sql = "SELECT $select FROM `$table` WHERE id=$id";
        $query = $this->_query($sql) or die(mysqli_error($this->connectResult));
        $data = NULL;
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            mysqli_free_result($query);
        }
        return $data;
    }

    /**
     * Save data to table (insert, update)
     * @param $table
     * @param array $data
     * @return int|string|void
     */
    public function save($table, $data = array())
    {
        $values = array();
        foreach ($data as $key => $value) {
            $value = mysqli_real_escape_string($this->connectResult, $value);
            $values[] = "`$key`='$value'";
        }
        $id = intval($data['id']);
        if ($id > 0) {
            $sql = "UPDATE `$table` SET " . implode(',', $values) . " WHERE id=$id";
        } else {
            $sql = "INSERT INTO `$table` SET " . implode(',', $values);
        }
        $query = $this->_query($sql) or die(mysqli_error($this->connectResult));
        $id = ($id > 0) ? $id : mysqli_insert_id($this->connectResult);
        return $id;
    }

    /**
     * Delete data from table by ID
     * @param $table
     * @param $id
     */
    public function destroy($table, $id)
    {
        $sql = "DELETE FROM `$table` WHERE id=$id";
        $this->_query($sql) or die(mysqli_error($this->connectResult));
    }
}
