<?php

use phpDocumentor\Reflection\Types\This;


class Crud4 extends CI_Model
{

    public function get_where($table, $where)
    {
        $db4 = $this->load->database('ims', TRUE);

        $db4->order_by("id", "DESC");
        return $db4->get_where($table, $where);
    }

    public function get_where_date($table, $where)
    {
        $db4 = $this->load->database('ims', TRUE);

        $db4->order_by("date", "DESC");
        return $db4->get_where($table, $where);
    }

    function get_like($name, $like, $table)
    {
        $db4 = $this->load->database('ims', TRUE);

        $db4->like($name, $like, 'both');
        $db4->order_by($name, 'ASC');

        return $db4->get($table);
    }

    public function get_where_select($table, $select, $where)
    {
        $db4 = $this->load->database('ims', TRUE);

        $db4->order_by("id", "DESC");
        $db4->select($select);
        $db4->where($where);
        return $db4->get($table);
    }

    public function insert($table, $data)
    {
        $db4 = $this->load->database('ims', TRUE);

        return $db4->insert($table, $data);
    }
}
