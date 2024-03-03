<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Http\Requests\StoreSizeRequest;
use App\Http\Requests\UpdateSizeRequest;

class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:Show Size']);
    }
    /**
     * a listing of the resource.
     */
    public function index()
    {
        $n['mdata'] = Size::orderBy('id','desc')->paginate(10);
        $n['count'] = Size::get();
        return view('backend.product-attribute.size.index', $n);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ccan('Create Size');
        return view('backend.product-attribute.size.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeRequest $request)
    {
        $this->ccan('Create Size');

        Size::create($request->all());
        return redirect()->route('pa.size.index')->with('success', "$request->name is created successfully");
    }

    /**
     * the specified resource.
     */
    public function show(Size $Size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $Size)
    {
        $this->ccan('Edit Size');

        $n['datum'] = $Size;
        return view('backend.product-attribute.size.edit', $n);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, Size $Size)
    {
        $this->ccan('Edit Size');

        $Size->update($request->all());
        return redirect()->route('pa.size.index')->with('success', "$request->name is Update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $Size)
    {
        $this->ccan('Delete Size');

        $status = $Size->delete();

        if ($status) {
            request()->session()->flash('success', 'Size successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting Size');
        }
        return back();
    }
}
