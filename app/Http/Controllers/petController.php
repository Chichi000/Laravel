<?php

namespace App\Http\Controllers;

use App\Models\pet;
use App\Models\customer;
use App\Models\kind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Http\Requests\petRequest;
use Illuminate\Support\Facades\View;

class petController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = pet::join(
            "customers",
            "customers.id",
            "=",
            "pets.customer_id"
        )
        ->join(
            "kind",
            "kind.id",
            "=",
            "pets.kind_id"
        )
            ->select(
                "customers.full_name",
                "pets.id",
                "pets.pet_name",
                "pets.sex",
                "kind.kind",
                "pets.pictures",
                "pets.customer_id",
                "pets.deleted_at"
            )
            ->orderBy("pets.id", "ASC")
            ->withTrashed()
            ->paginate(10);

        return view("pets.index", ["pets" => $pets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck("full_name", "id");
        $kind = kind::pluck("kind", "id");
        return view("pets.create", [
            "customers" => $customers,
            "kind" => $kind,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(petRequest $request)
    {
        $pets = new pet();
        $pets->pet_name = $request->input("pet_name");
        $pets->sex = $request->input("sex");
        $pets->kind_id = $request->input("kind_id");
        $pets->customer_id = $request->input("customer_id");
        if ($request->hasfile("pictures")) {
            $file = $request->file("pictures");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pictures/pets/", $filename);
            $pets->pictures = $filename;
        }
        $pets->save();
        return Redirect::to("/pets")->with("success", "Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pets = pet::join(
            "customers",
            "customers.id",
            "=",
            "pets.customer_id"
        )
        ->join(
            "kind",
            "kind.id",
            "=",
            "pets.kind_id"
        )
            ->select(
                "customers.full_name",
                "pets.id",
                "pets.pet_name",
                "pets.sex",
                "kind.kind",
                "pets.pictures",
                "pets.customer_id",
                "pets.deleted_at"
            )
            ->where('pets.id', $id)
            ->get();

        return View::make('pets.show', compact('pets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pets = Pet::find($id);
        $customers = Customer::pluck("full_name", "id");
        $kind = kind::pluck("kind", "id");
        return view("pets.edit", [
            "pets" => $pets,
            "customers" => $customers,
            "kind" => $kind,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(petRequest $request, $id)
    {
        $pets = pet::find($id);
        $pets->pet_name = $request->input("pet_name");
        $pets->sex = $request->input("sex");
        $pets->kind_id = $request->input("kind_id");
        $pets->customer_id = $request->input("customer_id");
        if ($request->hasfile("pictures")) {
            $destination = "pictures/pets/" . $pets->pictures;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file("pictures");
            $filename = uniqid() . "_" . $file->getClientOriginalName();
            $file->move("pictures/pets/", $filename);
            $pets->pictures = $filename;
        }
        $pets->update();
        return Redirect::to("/pets")->with("success", "Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pet::destroy($id);
        return Redirect::to("/pets")->with("success", "Deleted");
    }

    public function restore($id)
    {
        Pet::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("pets.index")->with("success", "Restored");
    }

    public function forceDelete($id)
    {
        $pets = Pet::findOrFail($id);
        $destination = "pictures/pets/" . $pets->pictures;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $pets->forceDelete();
        return Redirect::route("pets.index")->with("success", "Permanently Deleted");
    }
}
