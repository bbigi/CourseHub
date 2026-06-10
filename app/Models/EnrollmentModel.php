<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['user_id', 'course_id', 'status', 'progress', 'enrolled_at', 'completed_at'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'user_id'   => 'required|integer',
        'course_id' => 'required|integer',
        'status'    => 'required|in_list[aktif,selesai,dibatalkan]',
        'progress'  => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
    ];

    public function withCourseAndStudent()
    {
        return $this->select('enrollments.*, courses.title AS course_title, users.name AS student_name')
            ->join('courses', 'courses.id = enrollments.course_id', 'left')
            ->join('users', 'users.id = enrollments.user_id', 'left');
    }
}
