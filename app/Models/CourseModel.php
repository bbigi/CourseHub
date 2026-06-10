<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'title', 'slug', 'category', 'description', 'level', 'price',
        'status', 'instructor_id', 'thumbnail'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'title'         => 'required|min_length[3]|max_length[150]',
        'category'      => 'required|max_length[80]',
        'description'   => 'required|min_length[10]',
        'level'         => 'required|in_list[pemula,menengah,lanjutan]',
        'price'         => 'required|decimal|greater_than_equal_to[0]',
        'status'        => 'required|in_list[draft,published,archived]',
        'instructor_id' => 'required|integer',
    ];

    public function withInstructor()
    {
        return $this->select('courses.*, users.name AS instructor_name')
            ->join('users', 'users.id = courses.instructor_id', 'left');
    }
}
