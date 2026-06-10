<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseAppSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $users = [
            [
                'name'       => 'Admin Course',
                'email'      => 'admin@course.test',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Budi Instruktur',
                'email'      => 'instruktur@course.test',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'role'       => 'instruktur',
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Sinta Siswa',
                'email'      => 'siswa@course.test',
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'role'       => 'siswa',
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('users')->insertBatch($users);

        $instructor = $this->db->table('users')->where('email', 'instruktur@course.test')->get()->getRowArray();
        $student = $this->db->table('users')->where('email', 'siswa@course.test')->get()->getRowArray();

        $courses = [
            [
                'title'         => 'Dasar Pemrograman Web',
                'slug'          => 'dasar-pemrograman-web',
                'category'      => 'Web Development',
                'description'   => 'Kursus pengantar untuk memahami HTML, CSS, JavaScript, dan struktur aplikasi web modern.',
                'level'         => 'pemula',
                'price'         => 150000,
                'status'        => 'published',
                'instructor_id' => $instructor['id'],
                'thumbnail'     => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'title'         => 'CodeIgniter 4 untuk Aplikasi MVC',
                'slug'          => 'codeigniter-4-untuk-aplikasi-mvc',
                'category'      => 'Framework PHP',
                'description'   => 'Kursus praktik membangun aplikasi berbasis MVC, CRUD, autentikasi, otorisasi, dan REST API menggunakan CodeIgniter 4.',
                'level'         => 'menengah',
                'price'         => 250000,
                'status'        => 'published',
                'instructor_id' => $instructor['id'],
                'thumbnail'     => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ];

        $this->db->table('courses')->insertBatch($courses);

        $course = $this->db->table('courses')->where('slug', 'codeigniter-4-untuk-aplikasi-mvc')->get()->getRowArray();

        $lessons = [
            [
                'course_id'  => $course['id'],
                'title'      => 'Pengenalan MVC pada CodeIgniter 4',
                'content'    => 'Materi ini menjelaskan hubungan Model, View, Controller, routing, dan template layout.',
                'video_url'  => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'order_no'   => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'course_id'  => $course['id'],
                'title'      => 'Membuat CRUD Kursus',
                'content'    => 'Materi ini membahas proses tambah, lihat, ubah, dan hapus data kursus menggunakan Model dan Controller.',
                'video_url'  => null,
                'order_no'   => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('lessons')->insertBatch($lessons);

        $this->db->table('enrollments')->insert([
            'user_id'     => $student['id'],
            'course_id'   => $course['id'],
            'status'      => 'aktif',
            'progress'    => 35,
            'enrolled_at' => $now,
        ]);
    }
}
