<?php
require_once 'process.php';

class Services extends Process
{
    public function get($value = [])
    {
        if (empty($value)) {
            return $this->selectAll($this);
        }
        foreach ($value as $i => $val) {
            $this->$i = $val;
        }
        return $this->select($this);
    }

    public function post($value = [])
    {
        foreach ($value as $i => $val) {
            $this->$i = $val;
        }
        return $this->insert($this);
    }

    public function delete($value = [])
    {
        foreach ($value as $i => $val) {
            $this->$i = $val;
        }
        return $this->remove($this);
    }

    public function put($value = [])
    {
        foreach ($value as $i => $val) {
            $this->$i = $val;
        }
        return $this->update($this);
    }
}
