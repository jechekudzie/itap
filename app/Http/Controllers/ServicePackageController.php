<?php

namespace App\Http\Controllers;

use App\Models\LineItemCategory;
use App\Models\Package;
use App\Models\PackageCategory;
use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Http\Request;

class ServicePackageController extends Controller
{
    //
    public function index(Service $service)
    {
        $servicePackages = $service->servicePackages;
        $packages = Package::all();
        $packageCategories = PackageCategory::all();
        $lineItemCategories = LineItemCategory::all(); // Fetch all categories
        return view('admin.service_packages.index', compact('servicePackages','service','packages','packageCategories','lineItemCategories'));
    }

    public function store(Service $service, Request $request)
    {
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'package_id' => 'required|exists:packages,id',
            'package_category_id' => 'required|exists:package_categories,id',
            'description' => 'nullable',
            'standard_price' => 'required|numeric',
            'on_discount' => 'sometimes|boolean',
            'discount' => 'nullable|numeric',
        ]);

        $servicePackage = $service->servicePackages()->create($validatedData);

        return redirect()->route('service-packages.index', $service->slug);
    }


    public function show(ServicePackage $servicePackage)
    {
        return view('admin.service_packages.show', compact('servicePackage'));
    }


    public function edit(ServicePackage $servicePackage)
    {
        return view('admin.service_packages.edit', compact('servicePackage'));
    }


    public function update(Request $request, Service $service, ServicePackage $servicePackage)
    {
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'package_id' => 'required|exists:packages,id',
            'package_category_id' => 'required|exists:package_categories,id',
            'description' => 'nullable',
            'standard_price' => 'required|numeric',
            'on_discount' => 'sometimes|boolean',
            'discount' => 'nullable|numeric',
            'slug' => 'nullable|string',
        ]);

        //dd($validatedData);
        $servicePackage->update($validatedData);


        return redirect()->route('service-packages.index', $servicePackage->service->slug);
    }

    public function destroy(ServicePackage $servicePackage)
    {
        $servicePackage->delete();

        return redirect()->route('service-packages.index');
    }
}
