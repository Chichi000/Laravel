<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Pet;
use App\Models\Consultation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\consultationRequest;
use App\Models\disInjury;

class consultationController extends Controller
{
    public function search()
    {
        $consultations = Consultation::join(
            "employees",
            "employees.id",
            "=",
            "consultations.employee_id"
        )
            ->leftjoin("pets", "pets.id", "=", "consultations.pet_id")
            ->leftjoin("dis_injury", "dis_injury.id", "=", "consultations.dis_injury_id")
            ->select(
                "employees.full_name",
                "pets.pet_name",
                "consultations.id",
                "pets.pet_name",
                "dis_injury.dis_injury",
                "consultations.cost",
                "consultations.date",
                "consultations.comment",
                "consultations.deleted_at"
            )
            ->orderBy("consultations.id", "ASC")
            ->get();
        return view("consultations.search", [
            "consultations" => $consultations,
        ]);
    }

    public function results()
    {
        $result = $_GET["result"];
        $consultations = Consultation::join(
            "employees",
            "employees.id",
            "=",
            "consultations.employee_id"
        )
            ->leftjoin("pets", "pets.id", "=", "consultations.pet_id")
            ->leftjoin("dis_injury", "dis_injury.id", "=", "consultations.dis_injury_id")
            ->select(
                "employees.full_name",
                "pets.pet_name",
                "consultations.id",
                "pets.pet_name",
                "dis_injury.dis_injury",
                "consultations.cost",
                "consultations.date",
                "consultations.comment",
                "consultations.deleted_at"
            )            ->where("pets.pet_name", "LIKE", "%" . $result . "%")
            ->get();
        return view("consultations.result", [
            "consultations" => $consultations,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultations = Consultation::join(
            "employees",
            "employees.id",
            "=",
            "consultations.employee_id"
        )
            ->leftjoin("pets", "pets.id", "=", "consultations.pet_id")
            ->leftjoin("dis_injury", "dis_injury.id", "=", "consultations.dis_injury_id")
            ->select(
                "employees.full_name",
                "pets.pet_name",
                "consultations.id",
                "pets.pet_name",
                "dis_injury.dis_injury",
                "consultations.cost",
                "consultations.date",
                "consultations.comment",
                "consultations.deleted_at"
            )
            ->orderBy("consultations.id", "ASC")
            ->withTrashed()
            ->paginate(6);


        return view("consultations.index", ["consultations" => $consultations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pets = Pet::pluck("pet_name", "id");
        $employees = Employee::pluck("full_name", "id");
        $disInjury = disInjury::pluck("dis_injury", "id");
        return view("consultations.create", [
            "pets" => $pets,
            "employees" => $employees,
            "dis_injury" => $disInjury,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $consultations = new Consultation();
            $consultations->date = $request->input("date");
            $consultations->dis_injury_id = $request->input("dis_injury_id");
            $consultations->cost = $request->input("cost");
            $consultations->comment = $request->input("comment");
            $consultations->employee_id = $request->input("employee_id");
            $consultations->pet_id = $request->input("pet_id");
            $consultations->save();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route("consultation.index")
                ->with("error", $e->getMessage());
        }
        DB::commit();
        return Redirect::to("/consultation");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consultations = Consultation::find($id);
        $pets = Pet::pluck("pet_name", "id");
        $employees = Employee::pluck("full_name", "id");
        return view("consultations.show", [
            "pets" => $pets,
            "employees" => $employees,
            "consultations" => $consultations,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consultations = Consultation::find($id);
        $pets = Pet::pluck("pet_name", "id");
        $employees = Employee::pluck("full_name", "id");
        $disInjury = disInjury::pluck("dis_injury", "id");
        return view("consultations.edit", [
            "pets" => $pets,
            "employees" => $employees,
            "consultations" => $consultations,
            "dis_injury" => $disInjury,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(consultationRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $consultations = Consultation::find($id);
            $consultations->date = $request->input("date");
            $consultations->dis_injury_id = $request->input("dis_injury_id");
            $consultations->cost = $request->input("cost");
            $consultations->comment = $request->input("comment");
            $consultations->employee_id = $request->input("employee_id");
            $consultations->pet_id = $request->input("pet_id");
            $consultations->update();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route("consultation.index")
                ->with("error", $e->getMessage());
        }
        DB::commit();
        return Redirect::to("/consultation")->withSuccessMessage(
            "New Consultation Data Updated!"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Consultation::destroy($id);
        return Redirect::route("consultation.index")->withSuccessMessage(
            "Consultation Data Deleted!"
        );
    }

    public function restore($id)
    {
        Consultation::onlyTrashed()
            ->findOrFail($id)
            ->restore();
        return Redirect::route("consultation.index")->withSuccessMessage(
            "Consultation Data Restored!"
        );
    }

    public function forceDelete($id)
    {
        Consultation::findOrFail($id)->forceDelete();
        return Redirect::route("consultation.index")->withSuccessMessage(
            "Consultation Data Permanently Deleted!"
        );
    }
}
