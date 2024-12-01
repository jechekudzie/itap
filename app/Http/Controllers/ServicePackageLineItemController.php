<?php

namespace App\Http\Controllers;

use App\Models\LineItem;
use App\Models\LineItemCategory;
use App\Models\Package;
use App\Models\ServicePackage;
use App\Models\ServicePackageLineItem;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class ServicePackageLineItemController extends Controller
{
    //
    public function create(ServicePackage $servicePackage)
    {

        $service = $servicePackage->service;
        // Initialize an empty array for storing line item IDs and their quantities
        $selectedLineItems = [];

        // Check if there are any package line items associated with the service package
        if ($servicePackage->packageLineItems && $servicePackage->packageLineItems->isNotEmpty()) {
            foreach ($servicePackage->packageLineItems as $packageLineItem) {
                // Assuming each packageLineItem has a related lineItem
                if ($lineItem = $packageLineItem->lineItem) {
                    $selectedLineItems[$lineItem->id] = [
                        'quantity' => $packageLineItem->quantity,
                        'checked' => true // Since you're fetching existing line items, they are all "checked"
                        // Include any other properties you might need, such as 'on_discount', 'discount', etc.
                    ];
                }
            }
        }
        return view('admin.service_package_line_items.index', compact('service', 'servicePackage', 'selectedLineItems'));

    }

    public function store(Request $request, $servicePackageId)
    {
        $servicePackage = ServicePackage::findOrFail($servicePackageId);

        // Custom validation logic
        $validator = Validator::make($request->all(), [
            'line_items.*.quantity' => [
                'required_with:line_items.*.checked',
                'numeric',
                function ($attribute, $value, $fail) use ($request) {
                    list(, $lineItemId) = explode('.', $attribute);
                    $lineItem = LineItem::find($lineItemId);
                    $checked = $request->input("line_items.{$lineItemId}.checked");

                    if ($lineItem && $checked) {
                        if ($lineItem->is_billable && $value == 0) {
                            $fail('The quantity for billable line item ' . $lineItem->name . ' must be greater than 0.');
                        }

                        if (!$lineItem->is_billable && $value != 0) {
                            $fail('The quantity for non-billable line item ' . $lineItem->name . ' must be 0.');
                        }
                    }
                },
            ],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Retrieve all current line items IDs for the ServicePackage
        $currentLineItemIds = $servicePackage->packageLineItems()->pluck('line_item_id')->toArray();

        // Initialize an array to keep track of processed line item IDs
        $processedLineItemIds = [];

        // Loop through each line item in the request
        foreach ($request->input('line_items', []) as $lineItemId => $lineItemData) {
            if (isset($lineItemData['checked']) && isset($lineItemData['quantity'])) {
                // If checked and quantity is specified, update or create the line item
                $servicePackage->packageLineItems()->updateOrCreate(
                    ['line_item_id' => $lineItemId],
                    ['quantity' => $lineItemData['quantity']]
                // Include other fields that might need updating or setting
                );

                // Add the line item ID to the processed IDs array
                $processedLineItemIds[] = $lineItemId;
            }
        }

        // Find which line items need to be deleted (were unchecked in the form)
        $lineItemsToDelete = array_diff($currentLineItemIds, $processedLineItemIds);

        // Delete the unchecked line items
        foreach ($lineItemsToDelete as $lineItemIdToDelete) {
            $servicePackage->packageLineItems()->where('line_item_id', $lineItemIdToDelete)->delete();
        }

        return back()->with('success', 'Line items updated successfully for the service package.');


    }


    public function destroy(Package $package, LineItem $lineItem)
    {
        $package->lineItems()->detach($lineItem->id);

        return redirect()->route('packages.show', $package)
            ->with('success', 'Line item removed from package successfully.');
    }
}
