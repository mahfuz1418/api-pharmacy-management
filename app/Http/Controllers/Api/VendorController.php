<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    // Get all vendors
    public function index()
    {
        try {
            $vendors = Vendor::all();

            return response()->json([
                'message' => 'Vendor list fetched successfully',
                'data' => $vendors
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong while fetching vendors',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Store new vendor
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $vendor = Vendor::create($request->all());

            return response()->json([
                'message' => 'Vendor created successfully',
                'data' => $vendor
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create vendor',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Show single vendor
    public function show($id)
    {
        try {
            $vendor = Vendor::findOrFail($id);

            return response()->json([
                'message' => 'Vendor details fetched successfully',
                'data' => $vendor
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Vendor not found',
                'error'   => $e->getMessage()
            ], 404);
        }
    }



    // Update vendor
    public function update(Request $request, $id)
    {
        try {
            $vendor = Vendor::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $vendor->update($request->all());

            return response()->json([
                'message' => 'Vendor updated successfully',
                'data' => $vendor
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update vendor',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Delete vendor
    public function destroy($id)
    {
        try {
            $vendor = Vendor::findOrFail($id);
            $vendor->delete();

            return response()->json([
                'message' => 'Vendor deleted successfully'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete vendor',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
