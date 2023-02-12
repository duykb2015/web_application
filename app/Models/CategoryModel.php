<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'category';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Custom function. Find all category from database with specific conditions.
     * 
     * @return array|null
     *
     */

    public function customFindAll()
    {
        $query = $this->select([
            'category.id',
            'category.parent_id',
            'category.name',
            'pc.name as parent_name',
            'category.status',
        ])->join('category as pc', 'pc.id = category.parent_id', 'left')->orderBy('id', 'desc');

        $data['categorys'] = $query->paginate(RESULT_LIMIT);
        $data['pager'] = $query->pager;
        return $data;
    }

    /**
     * Add condition to query before find all category.
     * 
     * @return array|null
     *
     */
    public function filter($data)
    {
        if ($data['name']) {
            $this->like('category.name', $data['name']);
        }
        if ($data['parent_id']) {
            $this->where('category.parent_id', $data['parent_id']);
        }
        if (isset($data['status']) && $data['status'] != '') {
            $this->where('category.status', $data['status']);
        }
        return $this;
    }
}
