<?php

use phpDocumentor\Reflection\Types\This;

class Crud extends CI_Model
{
    public function get_where($table, $where)
    {
        $this->db->order_by("id", "DESC");
        return $this->db->get_where($table, $where);
    }

    public function get_where_or($table, $where, $or_where)
    {
        $this->db->order_by("id", "DESC");
        $this->db->where($where);
        $this->db->or_where($or_where);
        return $this->db->get($table);
    }

    public function get_where_in($table, $kolom, $data)
    {
        $this->db->where_in($kolom, $data);
        $this->db->order_by("id", "DESC");
        return $this->db->get($table);
    }

    public function get_where_select($table, $select, $where)
    {
        $this->db->order_by("id", "DESC");
        $this->db->select($select);
        $this->db->where($where);
        return $this->db->get($table);
    }

    public function get_where_like($table, $select, $where)
    {
        $this->db->order_by("id", "DESC");
        $this->db->select($select);
        $this->db->limit(20);
        $this->db->like('nama_barang', $where);
        return $this->db->get($table);
    }

    public function get_all($table)
    {
        $this->db->order_by("id", "DESC");
        return $this->db->get($table);
    }

    public function get_distinct($table, $select)
    {
        $this->db->select($select);
        $this->db->distinct();
        return $this->db->get($table);
    }

    public function get_distinct_where($table, $select, $where)
    {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->distinct();
        return $this->db->get($table);
    }

    public function get_select($select, $table)
    {
        $this->db->select($select);
        return $this->db->get($table);
    }

    public function get_all_limit($table)
    {
        $this->db->order_by("id", "DESC");
        $this->db->limit(1);
        return $this->db->get($table);
    }

    public function get_all_limit_where($table, $where)
    {
        $this->db->where($where);
        $this->db->order_by("id", "DESC");
        $this->db->limit(1);
        return $this->db->get($table);
    }
    public function get_all_limit_where_count($table, $where, $start, $end)
    {
        $this->db->where($where);
        $this->db->order_by("id", "DESC");
        $this->db->limit($end, $start);
        return $this->db->get($table);
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function delete($table, $data)
    {
        $this->db->delete($table, $data);
        return $this->db->affected_rows();
    }

    public function update($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function join_data($select, $table1, $table2, $like, $where)
    {
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2, $like);
        $this->db->where($where);
        return $this->db->get();
    }

    private function _get_datatables_query($table, $select, $column_order, $column_search, $order, $where, $group)
    {
        // $this->db->select("id, invoice_number, invoice_date, reference2");
        $this->db->select($select);
        $this->db->from($table);
        // $this->db->distinct('tiket_no');

        if (!empty($group))
            $this->db->group_by($group);

        if (!empty($where))
            $this->db->where($where);

        $i = 0;
        foreach ($column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else
                    $this->db->or_like($item, $_POST['search']['value']);


                if (count($column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order']))
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        else if (isset($this->order))
            $this->db->order_by(key($order), $order[key($order)]);
    }

    function get_datatables($table, $select, $column_order, $column_search, $order = null, $where = null, $group = null)
    {
        $this->_get_datatables_query($table, $select, $column_order, $column_search, $order, $where, $group);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        return $this->db->get()->result();
        // return ["data" => $this->db->get()->result(), "query" => $this->db->last_query()];
    }

    function count_filtered($table, $select, $column_order, $column_search, $order = null, $where = null, $group = null)
    {
        $this->_get_datatables_query($table, $select, $column_order, $column_search, $order, $where, $group);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function count_where($table, $where)
    {
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->count_all_results();
    }

    public function sum_where($table, $where, $select)
    {
        $this->db->select_sum($select);
        $this->db->where($where);
        return $this->db->get($table);
    }

    function get_task_autocomplete($title, $table, $where)
    {
        $this->db->like('name', $title, 'both');
        $this->db->order_by('name', 'ASC');
        $this->db->where($where);
        $this->db->limit(10);
        return $this->db->get($table)->result();
    }

    function get_task_autocomplete_sampah($title, $table)
    {
        $this->db->like('nama_sampah', $title, 'both');
        $this->db->order_by('nama_sampah', 'ASC');
        $this->db->limit(10);
        return $this->db->get($table)->result();
    }

    function get_nomor_transaksi_terakhir($select, $table, $where)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $this->db->limit(1);
        $this->db->order_by('id', 'desc');
        return $this->db->get();
    }

    public function get_postcodes($q)
    {
        $query = $this->db->select('kode_barang, nama_barang')
            // ->group_by('kode_barang, nama_barang')
            ->group_start()
            ->like('kode_barang', $q)
            ->or_like('nama_barang', $q)
            ->group_end()
            ->where('status_barang', 'NOT ACTIVE')
            ->get('mst_barang');

        return $query->result_array();
        // echo json_encode($json);
    }

    public function get_subgroup_bulus($q)
    {
        $query = $this->db->select('subgroup')
            ->like('subgroup', $q)
            ->get('subgroup_bulus');

        return $query->result_array();
        // echo json_encode($json);
    }

    function qr($kodeqr)
    {
        if ($kodeqr) {
            $filename = 'qr/' . $kodeqr;
            if (!file_exists($filename)) {
                $this->load->library('ciqrcode');
                $params['data'] = $kodeqr;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH . 'qr/' . $kodeqr . ".png";
                return  $this->ciqrcode->generate($params);
            }
        }
    }
}
