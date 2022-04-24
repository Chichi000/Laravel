<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\disInjury;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class disInjuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disInjury = disInjury::withTrashed()->paginate(5);
        return view("disInjury.index", [
            "disInjury" => $disInjury,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("disInjury.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        disInjury::create($request->all());
        return Redirect::to('disInjury');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disInjury = disInjury::find($id);
        return view('disInjury.edit', compact('disInjury'));
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
        $disInjury = disInjury::find($id);
        $disInjury->update($request->all());
        return Redirect::to('disInjury');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        disInjury::destroy($id);
        return Redirect::to("disInjury");
    }
    public function restore($id)
    {
        disInjury::onlyTrashed()->findOrFail($id)->restore();
        return Redirect::route("disInjury.index");
    }
}
