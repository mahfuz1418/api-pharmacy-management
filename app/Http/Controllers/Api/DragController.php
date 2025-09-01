<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Drag;
use Exception;
use Illuminate\Http\Request;

class DragController extends Controller
{
       public function index()
    {
        try {
            $drags = Drag::with('vendor')->get();

            return response()->json([
                'message' => 'Drags list fetched successfully',
                'data' => $drags
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong while fetching drags',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Store new drag
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'      => 'required|string|max:255',
                'weight'    => 'nullable|numeric',
                'type'      => 'nullable|string|max:255',
                'vendor_id' => 'required|exists:vendors,id',
                'price'     => 'required|numeric|min:0',
                'quantity'  => 'required|integer|min:0',
            ]);

            $drag = Drag::create($request->all());

            return response()->json([
                'message' => 'Drag created successfully',
                'data' => $drag
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create drag',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Show single drag
    public function show($id)
    {
        try {
            $drag = Drag::with('vendor')->findOrFail($id);

            return response()->json([
                'message' => 'Drag details fetched successfully',
                'data' => $drag
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Drag not found',
                'error'   => $e->getMessage()
            ], 404);
        }
    }

    // Update drag
    public function update(Request $request, $id)
    {
        try {
            $drag = Drag::findOrFail($id);

            $request->validate([
                'name'      => 'required|string|max:255',
                'weight'    => 'nullable|numeric',
                'type'      => 'nullable|string|max:255',
                'vendor_id' => 'required|exists:vendors,id',
                'price'     => 'required|numeric|min:0',
                'quantity'  => 'required|integer|min:0',
            ]);

            $drag->update($request->all());

            return response()->json([
                'message' => 'Drag updated successfully',
                'data' => $drag
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update drag',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Delete drag
    public function destroy($id)
    {
        try {
            $drag = Drag::findOrFail($id);
            $drag->delete();

            return response()->json([
                'message' => 'Drag deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete drag',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
