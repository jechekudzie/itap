<?php

namespace App\Http\Controllers;

use App\Models\LineItemCategory;
use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function servicePackage(Service $service)
    {
        // Assuming $service is already loaded, retrieve its service packages
        $servicePackages = $service->servicePackages;

        // Group the service packages by 'packageCategory' relationship
        $groupedPackages = $servicePackages->groupBy(function ($item, $key) {
            // Use the category ID (or any unique attribute) as the grouping key
            return $item->packageCategory->id;
        });

        $lineItemCategories = LineItemCategory::all(); // Fetch all categories

        return view('web.service_packages', compact('service', 'servicePackages','groupedPackages','lineItemCategories'));
    }

    public function step1($servicePackageId)
    {

        $servicePackage = ServicePackage::with(['service', 'service.serviceCategory','packageCategory'])->find($servicePackageId);


        return view('web.booking-form', compact('servicePackageId','servicePackage'));
    }
}
