<?php

use phpDocumentor\Reflection\Types\This;


class Crud3 extends CI_Model
{

    public function get_where($table, $where)
    {
        $db3 = $this->load->database('ps', TRUE);

        $db3->order_by("id", "DESC");
        return $db3->get_where($table, $where);
    }

    function get_like($name, $like, $table)
    {
        $db3 = $this->load->database('ps', TRUE);

        $db3->like($name, $like, 'both');
        $db3->order_by($name, 'ASC');

        return $db3->get($table);
    }

    public function get_where_select($table, $select, $where)
    {
        $db3 = $this->load->database('ps', TRUE);

        $db3->order_by("id", "DESC");
        $db3->select($select);
        $db3->where($where);
        return $db3->get($table);
    }

    public function insert($table, $data)
    {
        $db3 = $this->load->database('ps', TRUE);

        return $db3->insert($table, $data);
    }
}
