<?php

namespace App\Filters;

use App\Models\MUser;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CheckProfile implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // if(){
        //     return redirect()->to(base_url('login'));
        // }
        // $users = new MUser();
        if (session()->get('userid') == '') {
            return redirect()->to(base_url('login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if (session()->get('fullname') == '') {
            return redirect()->to(base_url('profile'));
        }
    }
}
