<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:Show Branch']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $n['mdata'] = Branch::orderBy('id','desc')->paginate(10);
        $n['count'] = Branch::get();
        return view('backend.product-attribute.branch.index', $n);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ccan('Create Branch');
        return view('backend.product-attribute.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        $this->ccan('Create Branch');

        Branch::create($request->all());
        return redirect()->route('pa.branch.index')->with('success', "$request->name is created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $Branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $Branch)
    {
        $this->ccan('Edit Branch');

        $n['datum'] = $Branch;
        return view('backend.product-attribute.branch.edit', $n);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $Branch)
    {
        $this->ccan('Edit Branch');

        $Branch->update($request->all());
        return redirect()->route('pa.branch.index')->with('success', "$request->name is Update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $Branch)
    {
        $this->ccan('Delete Branch');

        $status = $Branch->delete();

        if ($status) {
            request()->session()->flash('success', 'Branch successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting Branch');
        }
        return back();
    }
}
