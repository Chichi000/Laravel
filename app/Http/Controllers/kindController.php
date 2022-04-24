<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kind;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class kindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kind = kind::withTrashed()->paginate(5);
        return view("kind.index", [
            "kind" => $kind,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make("kind.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        kind::create($request->all());
        return Redirect::to('kind');
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
        $kind = kind::find($id);
        return view('kind.edit', compact('kind'));
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
        $kind = kind::find($id);
        $kind->update($request->all());
        return Redirect::to('kind');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kind::destroy($id);
        return Redirect::to("kind");
    }
    public function restore($id)
    {
        kind::onlyTrashed()->findOrFail($id)->restore();
        return Redirect::route("kind.index");
    }
}
