<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function routeByRole()
    {
        $currentUserRole = Auth::user()->getRole();

        if ($currentUserRole == 'student')
        {
            redirect(route('student.dashboard'));
        }else if ($currentUserRole == 'teacher')
        {
            redirect(route('teacher.dashboard'));
        }else if($currentUserRole == 'administrator')
        {
            redirect(route('admin.dashboard'));
        }else{
            redirect(route('/'));
        }
    }
}
