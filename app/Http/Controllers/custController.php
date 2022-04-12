<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\custRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use App\Models\Customer;

class custController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::leftJoin(
            "pets",
            "customers.id",
            "=",
            "pets.customer_id"
        )
            ->select(
                "customers.id",
                "customers.full_name",
                "customers.cell_number",
                "customers.pictures",
                "customers.deleted_at",
                "pets.pet_name"
            )
            ->orderBy("Customers.id", "ASC")
            ->withTrashed()
            ->paginate(10);
        //$customers = Customer::withTrashed()->paginate(10);

        return view("customers.index", ["customers" => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(custRequest $request)
    {
        $Customers = new Customer();
        $Customers->full_name = $request->input("full_name");
        $Customers->cell_number = $request->input("cell_number");
        if ($request->hasfile("pictures")) {
            $file = $request->file("pictures");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pictures/customers/", $filename);
            $Customers->pictures = $filename;
        }
        $Customers->save();
        return Redirect::to("cust")->with("success", "Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Customers = Customer::find($id);
        return View::make("customers.show", compact("customers"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::find($id);
        return View::make("customers.edit", compact("customers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(custRequest $request, $id)
    {
        $customers = Customer::find($id);
        $customers->full_name = $request->input("full_name");
        $customers->cell_number = $request->input("cell_number");
        if ($request->hasfile("pictures")) {
            $destination = "pictures/customers/" . $customers->pictures;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("pictures");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pictures/customers/", $filename);
            $customers->pictures = $filename;
        }
        $customers->update();
        return Redirect::to("cust")->with("success", "Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return Redirect::to("cust")->with("success", "Deleted");
    }

    public function restore($id)
    {
        Customer::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("cust.index")->with("success", "Restored");
    }

    public function forceDelete($id)
    {
        $customers = Customer::findOrFail($id);
        $destination = "pictures/customers/" . $customers->pictures;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $customers->forceDelete();
        return Redirect::route("cust.index")->with("success", "Permanently Deleted");
    }
}
