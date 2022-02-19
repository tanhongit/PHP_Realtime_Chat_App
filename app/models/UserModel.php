<?php

class UserModel extends BaseModel
{
    const TABLE = 'users';

    public function getAll()
    {
        return $this->all(self::TABLE);
    }

    public function findByID($id)
    {
        return $this->find(self::TABLE, $id);
    }

    public function deleteByID($id)
    {
        return $this->delete(self::TABLE, $id);
    }

    public function store($data)
    {
        return $this->create(self::TABLE, $data);
    }

    public function updateData($data)
    {
        $this->update(self::TABLE, $data);
    }

    public function findByAttribute($attributes)
    {
        return $this->all(self::TABLE, $attributes);
    }
}