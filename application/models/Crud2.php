<?php

use phpDocumentor\Reflection\Types\This;


class Crud2 extends CI_Model
{

    public function get_where($table, $where)
    {
        $db2 = $this->load->database('arsip', TRUE);

        $db2->order_by("id", "DESC");
        return $db2->get_where($table, $where);
    }

    function get_like($name, $like, $table)
    {
        $db2 = $this->load->database('arsip', TRUE);

        $db2->like($name, $like, 'both');
        $db2->order_by($name, 'ASC');

        return $db2->get($table);
    }

    public function get_where_select($table, $select, $where)
    {
        $db2 = $this->load->database('arsip', TRUE);

        $db2->order_by("id", "DESC");
        $db2->select($select);
        $db2->where($where);
        return $db2->get($table);
    }
}
