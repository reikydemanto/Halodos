<?php

namespace App\Controllers;

use App\Models\Msuser;

class Login extends BaseController
{

	function __construct()
	{
		$this->user = new Msuser();
	}

	public function index($param = 'user')
	{
		$view = '';
		$title = '';
		if ($param == 'administrator') {
			$view = 'login/login_admin';
			$title = 'Login Administrator';
		} elseif ($param == 'dospem') {
			$title = 'Login Dosen Pembimbing';
			$view = 'login/login_dospem';
		} else {
			$title = 'Login User';
			$view = 'login/login_user';
		}
		return view($view, ['title' => $title]);
	}

	function authLogin()
	{
		$email = $this->getPost('email');
		$password = $this->getPost('password');
		$page = $this->getPost('page');
		$res = ['sukses' => 0];
		$cek = $this->user->checkEmailLogin($email, $page);
		if ($cek) {
			if (password_verify($password, rtrim($cek['password']))) {
				session()->set('fullname', $cek['fullname']);
				session()->set('role', $cek['role']);
				session()->set('jeniskelamin', $cek['jeniskelamin']);
				session()->set('userid', $cek['userid']);
				session()->set('kampusid', $cek['kampusid']);
				session()->set('prodiid', $cek['prodiid']);
				$res['sukses'] = 1;
			}
		}
		echo json_encode($res);
	}

	function registerUser($tipe = '')
	{
		$role = 'user';
		if ($tipe != '') {
			$role = 'dospem';
		}
		$data = [
			'title' => 'Register Page',
			'role' => $role
		];
		return view('login/register_user', $data);
	}

	function processRegister()
	{
		$email = $this->getPost('email');
		$password = $this->getPost('password');
		$code = $this->getPost('code');
		$role = $this->getPost('tipe');
		$res = ['sukses' => 0];
		$password_confirmation = $this->getPost('password_confirmation');
		$cek = $this->user->checkEmail($email);
		if ($cek) {
			$res['msg'] = 'Email sudah ada';
			echo json_encode($res);
			die;
		}
		if ($password != $password_confirmation) {
			$res['msg'] = 'Password tidak sama';
			echo json_encode($res);
			die;
		}
		$data = [
			'email' => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'role' => $role,
			'usercode' => $code,
			'createddate' => date('Y-m-d H:i:s'),
			'updateddate' => date('Y-m-d H:i:s'),
		];
		$query = $this->user->store($data);
		if ($query) {
			$res['sukses'] = 1;
		}
		echo json_encode($res);
	}

	function logout()
	{
		session()->destroy();
		return redirect()->to(base_url('welcome'));
	}

	function forgotPass()
	{
		return view('login/forgot_password', ['title' => 'Forgot Password']);
	}

	function sendForgot()
	{
		$mails = $this->getPost('email');
		$res = ['sukses' => 0];
		$enkripsi = enkripsi_forgot($mails);
		$email = \Config\Services::email();
		$email->setFrom('doflamingo9804@gmail.com', 'HaloDos');
		$email->setTo($mails);
		$email->setSubject("Halodos Forgot Password");
		$email->setMessage(view('login/mail_forgot', ['enkripsi' => $enkripsi]));
		$sending = $email->send();
		$res['sukses'] = "1";
		$res['msg'] = 'Email reset password sudah terkirim. Jika belum ada, coba submit ulang form ini';
		echo json_encode($res);
	}

	function resetView($mail)
	{
		$deskripsi = deskripsi_forgot($mail);
		return view('login/reset_password', ['title' => 'Reset Password', 'email' => $deskripsi]);
	}

	function resetPass()
	{
		$email = $this->getPost('email');
		$password = $this->getPost('password');
		$res = ['sukses' => 0];
		$password_confirmation = $this->getPost('password_confirmation');
		if ($password != $password_confirmation) {
			$res['msg'] = 'Password tidak sama';
			echo json_encode($res);
			die;
		}
		$cek = $this->user->checkEmail($email);
		$role = $cek['role'];
		$url = "";
		if ($role == 'admin') {
			$url = "login/administrator";
		} elseif ($role == 'dospem') {
			$url = "login/dospem";
		} elseif ($role == 'user') {
			$url = "login";
		}
		$res['url'] = $url;
		$data = [
			'password' => password_hash($password, PASSWORD_DEFAULT),
		];
		$query = $this->user->edit($data, $cek['userid']);
		if ($query) {
			$res['sukses'] = 1;
		}
		echo json_encode($res);
	}
}
