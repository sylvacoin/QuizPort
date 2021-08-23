<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Imports\TeachersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $users = User::whereHas("roles", function ($q){
            $q->where('name', 'teacher');
        });
        $teachers = $users->paginate(4);

        return view('admin.account.index', compact('teachers'));
    }

    public function bulk_create()
    {
        return view('admin.account.bulk-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacherList' => 'required'
        ]);

        try{
            $file = $request->file('teacherList')->store('import');
            (new TeachersImport)->import($file);

            return back()->withStatus('Teachers were imported successfully');
        }catch(\Exception $ex)
        {
            Log::error($ex);
            return back()->withError('An error occurred list was not uploaded');

        }
    }

}
