<?php

namespace App\Http\Controllers;

use App\Models\PackageCategory;
use Illuminate\Http\Request;

class PackageCategoryController extends Controller
{
    //
    public function index()
    {

        $packageCategories = PackageCategory::all();
        return view('admin.package_categories.index',compact('packageCategories'));
    }

    public function create()
    {
        return view('admin.package_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        PackageCategory::create($request->all());
        return redirect()->route('package-categories.index')
            ->with('success','Package Category created successfully.');
    }

    public function show(PackageCategory $packageCategory)
    {
        return view('admin.package_categories.show',compact('packageCategory'));
    }

    public function edit(PackageCategory $packageCategory)
    {
        return view('admin.package_categories.edit',compact('packageCategory'));
    }

    public function update(Request $request, PackageCategory $packageCategory)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $packageCategory->update($request->all());
        return redirect()->route('package-categories.index')
            ->with('success','Package Category updated successfully');
    }

    public function destroy(PackageCategory $packageCategory)
    {
        $packageCategory->delete();
        return redirect()->route('package-categories.index')
            ->with('success','Package Category deleted successfully');
    }
}
