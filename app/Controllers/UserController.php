<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('users/index', [
            'title' => 'Manajemen User',
            'users' => $this->userModel->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('users/form', [
            'title'  => 'Tambah User',
            'user'   => null,
            'method' => 'post',
            'action' => site_url('users'),
        ]);
    }

    public function create()
    {
        $rules = [
            'name'     => 'required|min_length[3]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required|in_list[admin,instruktur,siswa]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'      => $this->request->getPost('role'),
            'is_active' => (int) $this->request->getPost('is_active'),
        ]);

        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $user = $this->userModel->find($id);
        if (! $user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan.');
        }

        return view('users/form', [
            'title'  => 'Edit User',
            'user'   => $user,
            'method' => 'put',
            'action' => site_url('users/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $user = $this->userModel->find($id);
        if (! $user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan.');
        }

        $rules = [
            'name'      => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'role'      => 'required|in_list[admin,instruktur,siswa]',
            'is_active' => 'required|in_list[0,1]',
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'role'      => $this->request->getPost('role'),
            'is_active' => (int) $this->request->getPost('is_active'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/users')->with('success', 'User berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        if ($id === (int) session()->get('user_id')) {
            return redirect()->to('/users')->with('error', 'Akun yang sedang digunakan tidak boleh dihapus.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/users')->with('success', 'User berhasil dihapus.');
    }
}
