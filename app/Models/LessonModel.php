<?php

namespace App\Models;

use CodeIgniter\Model;

class LessonModel extends Model
{
    protected $table = 'lessons';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['course_id', 'title', 'content', 'video_url', 'order_no'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'course_id' => 'required|integer',
        'title'    => 'required|min_length[3]|max_length[150]',
        'content'  => 'required|min_length[10]',
        'video_url'=> 'permit_empty|valid_url_strict',
        'order_no' => 'required|integer|greater_than_equal_to[1]',
    ];
}
