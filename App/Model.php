<?php

namespace App;

use App\Db;

abstract class Model
{
    public const TABLE = '';

    public function insert()
    {
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' === $name) {
                continue;
            }
            $cols[] = $name;
            $data[':' . $name] = $value;
        }

        $query = 'INSERT INTO ' . static::TABLE . '
        ('. implode(', ', $cols) .')
        VALUES
        ('. implode(', ', array_keys($data)) .')';

        $db = new Db();
        $db->execute($query, $data);
        $this->id = $db->getLastId();
    }

    public function update()
    {
        $fields = get_object_vars($this);

        $data = [];
        foreach ($fields as $name => $value) {
            $data[':' . $name] = $value;
        }

        $query = 'UPDATE ' . static::TABLE . ' SET ';

        foreach ($fields as $name => $value) {
            if ('id' === $name) {
                continue;
            }
            $query .= $name . '=:' . $name . ', ';
        }

        $query = substr($query, 0, -2);
        $query .= ' WHERE id=:id';

        $db = new Db();
        $db->execute($query, $data);
    }

    public function save()
    {
        $query = 'SELECT EXISTS(SELECT id FROM ' . static::TABLE . ' WHERE id=:id);';

        $db = new Db();
        if (1 === $db->checkID($query, [':id' => $this->id])) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        $db = new Db();
        $db->execute($query, [':id' => $this->id]);
    }

    public function getColumns()
    {
        return array_keys(get_object_vars($this));
    }

    public function unpacking($data)
    {
        foreach ($data as $name => $value) {
            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }
}