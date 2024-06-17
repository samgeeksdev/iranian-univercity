<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::paginate(10);
        return view('users.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $collages=College::all();
        return view('users.create',compact('collages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $roleConvert = [1 => 'educational_supervisor', 2 => 'faculty_head', 3 => 'professor'];
      User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password, // Hash the password
            'role' => $roleConvert[$request->role],
            'college_id' => $request->collages_id, // Use the correct field name
        ]);

        return back()->with('success', 'کاربر با موفقیت ایجاد شد!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $collages=College::all();
        $user=User::find($id);
        return view('users.create',compact('collages','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->name=$request->name;
        $user->username=$request->username;
        $user->role=$request->role;
        $user->collages_id=$request->collages_id;
        $user->save();
        return back()->with('success', 'کاربر با موفقیت ویرایش شد!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        return back()->with('success', 'کاربر با موفقیت حذف شد!');
    }
}
