<?php

namespace App\Http\Controllers;

use App\Models\LineItemCategory;
use App\Models\Package;
use App\Models\Service;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //
    public function index()
    {
        $packages = Package::all();

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $services = Service::all();
        $categories = LineItemCategory::all();

        return view('admin.packages.create', compact('services', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',

        ]);
        $package = Package::create($validatedData);
        return redirect()->route('packages.index')
            ->with('success', 'Package created successfully.');
    }

    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }


    public function update(Request $request, Package $package)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $package->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('packages.index', $package)
            ->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('packages.index')
            ->with('success', 'Package deleted successfully.');
    }
}
