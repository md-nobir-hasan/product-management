<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:Show Color']);
    }
    /**
     * a listing of the resource.
     */
    public function index()
    {
        $n['mdata'] = Color::orderBy('id','desc')->paginate(10);
        $n['count'] = Color::get();
        return view('backend.product-attribute.color.index', $n);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ccan('Create Color');

        return view('backend.product-attribute.color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {
        $this->ccan('Create Color');

        Color::create($request->all());
        return redirect()->route('pa.color.index')->with('success', "$request->name is created successfully");
    }

    /**
     * the specified resource.
     */
    public function show(Color $Color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $Color)
    {
        $this->ccan('Edit Color');

        $n['datum'] = $Color;
        return view('backend.product-attribute.color.edit', $n);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $Color)
    {
        $this->ccan('Edit Color');

        $Color->update($request->all());
        return redirect()->route('pa.color.index')->with('success', "$request->name is Update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $Color)
    {
        $this->ccan('Delete Color');

        $status = $Color->delete();

        if ($status) {
            request()->session()->flash('success', 'Type successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting Color');
        }
        return back();
    }
}
