<?php

namespace CategoriesManager;

use DB\Database;
use FN\Functions;

class Categories
{

    private $db;
    private $fn;

    public function __construct()
    {

        $this->db = new Database();
        $this->fn = new Functions();
    }

    // Save (insert,update)
    public function save($data = [])
    {

        $name = trim(arr_val($data, 'name', 'Untitled'));
        $slug = to_slug($name);
        $type = arr_val($data, 'type', '');
        $id = arr_val($data, 'id');



        $data = [
            'name' => $name,
            'slug' => $slug,
            'type' => $type
        ];

        $saved = false;

        if ($id) {
            $data['modified_at'] = datetime();
            $saved = $this->db->update('categories', $data, ['id' => $id]);
        } else
            $saved = $this->db->insert('categories', $data);


        if ($saved) return $this->fn->success('Category saved');
        return $this->fn->error("Category can't saved");
    }

    // Delete
    public function delete($id)
    {
        // Delete
        $deleted = $this->db->delete('categories', ['uid' => $id]);
        return $deleted;
    }

    // Get All
    public function getAll($data = [])
    {
        $cols = arr_val($data, 'columns', '*');
        $type = arr_val($data, 'type', '');
        $id = arr_val($data, 'category_id');

        $condition =  [
            'type' => $type
        ];

        if ($id) $condition['id'] =  $id;

        $categories = $this->db->select("categories", $cols, $condition);
        return $categories;
    }
    // Get Category
    public function get($condition, $cols = "*")
    {
        $category = $this->db->select_one('categories', $cols, $condition);
        if (!$category) return false;
        return $category;
    }
    // Is Exists
    public function is_exists($id)
    {
        $category = $this->db->select_one("categories", 'id', ['uid' => $id]);
        if (!$category) return false;
        return $category['id'];
    }
}

$_category = new Categories();
