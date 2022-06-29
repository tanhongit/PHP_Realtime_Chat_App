<?php

class BaseModel extends Model
{
    protected $connectResult;

    public function __construct()
    {
        $this->connectResult = $this->connect();
    }

    /**
     * Create new data to table
     * @param $table
     * @param $data
     * @return int|string|void
     */
    public function create($table, $data)
    {
        $data['id'] = 0; //set new row
        return $this->save($table, $data);
    }

    /**
     * Update data to table (use ID in $data)
     * @param $table
     * @param $data
     * @return int|string|void
     */
    public function update($table, $data)
    {
        return $this->save($table, $data);
    }

    /**
     * Delete data from table by ID
     * @param $table
     * @param $id
     */
    public function delete($table, $id)
    {
        return $this->destroy($table, $id);
    }

    /**
     * Get all data in the table
     * @param $table
     * @return array|void
     */
    public function all($table, $attributes = array())
    {
        return $this->getByOptions($table, $attributes);
    }

    /**
     * Get data in table by ID
     * @param $table
     * @param $id
     * @return array|false|string[]|void|null
     */
    public function find($table, $id)
    {
        return $this->getRecordByID($table, $id);
    }

    /**
     * @param $sql
     * @return bool|mysqli_result
     */
    public function _query($sql)
    {
        return mysqli_query($this->connectResult, $sql);
    }

    /**
     * Escape special characters in string
     * @param $str
     */
    public function escape($str)
    {
        return mysqli_real_escape_string($this->connectResult, $str);
    }
}