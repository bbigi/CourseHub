<?php

namespace App\Controllers\Api;

use App\Models\EnrollmentModel;
use CodeIgniter\RESTful\ResourceController;

class Enrollments extends ResourceController
{
    protected $modelName = EnrollmentModel::class;
    protected $format = 'json';

    public function index()
    {
        return $this->respond([
            'status' => 200,
            'data'   => $this->model->withCourseAndStudent()->orderBy('enrolled_at', 'DESC')->findAll(),
        ]);
    }

    public function show($id = null)
    {
        $enrollment = $this->model->withCourseAndStudent()->where('enrollments.id', (int) $id)->first();

        if (! $enrollment) {
            return $this->failNotFound('Enrolmen tidak ditemukan.');
        }

        return $this->respond([
            'status' => 200,
            'data'   => $enrollment,
        ]);
    }

    public function create()
    {
        $data = $this->payload();
        $data['status'] = $data['status'] ?? 'aktif';
        $data['progress'] = $data['progress'] ?? 0;
        $data['enrolled_at'] = $data['enrolled_at'] ?? date('Y-m-d H:i:s');

        if (! $this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'status'  => 201,
            'message' => 'Enrolmen berhasil dibuat.',
            'data'    => $this->model->find($this->model->getInsertID()),
        ]);
    }

    public function update($id = null)
    {
        $enrollment = $this->model->find((int) $id);

        if (! $enrollment) {
            return $this->failNotFound('Enrolmen tidak ditemukan.');
        }

        $data = $this->payload();
        if (isset($data['progress']) && (int) $data['progress'] === 100) {
            $data['status'] = 'selesai';
            $data['completed_at'] = date('Y-m-d H:i:s');
        }

        if (! $this->model->update((int) $id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'status'  => 200,
            'message' => 'Enrolmen berhasil diperbarui.',
            'data'    => $this->model->find((int) $id),
        ]);
    }

    public function delete($id = null)
    {
        $enrollment = $this->model->find((int) $id);

        if (! $enrollment) {
            return $this->failNotFound('Enrolmen tidak ditemukan.');
        }

        $this->model->delete((int) $id);

        return $this->respondDeleted([
            'status'  => 200,
            'message' => 'Enrolmen berhasil dihapus.',
        ]);
    }

    private function payload(): array
    {
        $json = $this->request->getJSON(true);
        if (is_array($json) && $json !== []) {
            return $json;
        }

        $raw = $this->request->getRawInput();
        if (is_array($raw) && $raw !== []) {
            return $raw;
        }

        return $this->request->getPost();
    }
}
