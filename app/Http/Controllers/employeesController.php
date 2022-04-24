<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\employeeRequest;
use App\Http\Requests\employeeEditRequest;
use App\Http\Requests\employeeLoginRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Models\employee;
use Illuminate\Support\Facades\Auth;

class employeesController extends Controller
{

    public function getSignup()
    {
        return view("employees.signup");
    }

    public function postSignup(employeeRequest $request)
    {
        $employees = new employee();
        $employees->full_name = $request->input("full_name");
        $employees->email = $request->input("email");
        $employees->password = Hash::make($request->input("password"));
        if ($request->hasfile("pictures")) {
            $file = $request->file("pictures");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pictures/employees/", $filename);
            $employees->pictures = $filename;
        }
        $employees->save();
        Auth::login($employees);
        return redirect::route("employees.admin");
    }

    public function admin()
    {
        return view("employees.admin");
    }

    public function getLogout()
    {
        Auth::logout();
        return view("employees.signin");
    }

    public function getSignin()
    {
        return view("employees.signin");
    }

    public function postSignin(employeeLoginRequest $request)
    {
        if (
            Auth::attempt([
                "email" => $request->input("email"),
                "password" => $request->input("password"),
            ])
        ) {
            return redirect::route("employees.admin");
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = employee::withTrashed()->paginate(10);

        return view("employees.index", [
            "employees" => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = DB::table('employees')
        ->select('employees.id','employees.full_name', 'employees.email','employees.pictures')
            ->where('employees.id', $id)
            ->get();

        return View::make('employees.show', compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = employee::find($id);
        return view("employees.edit")->with("employees", $employees);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employees = employee::find($id);
        $employees->full_name = $request->input("full_name");
        $employees->email = $request->input("email");
        $employees->update();
        return Redirect::to("employees");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        employee::destroy($id);
        return Redirect::to("employees");
    }

    public function restore($id)
    {
        employee::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("employees.index");
    }

    public function forceDelete($id)
    {
        $employees = employee::findOrFail($id);
        $employees->forceDelete();
        return Redirect::route("employees.index");
    }
}
