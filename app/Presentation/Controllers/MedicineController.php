<?php

namespace App\Presentation\Controllers;

use App\Application\Services\MedicineApplicationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MedicineController extends Controller
{
    public function __construct(
        private MedicineApplicationService $medicineService
    ) {}

    public function index(): View
    {
        $medicines = $this->medicineService->getAllMedicines();
        $statistics = $this->medicineService->getMedicineStatistics();
        
        return view('medicines.index', compact('medicines', 'statistics'));
    }

    public function create(): View
    {
        return view('medicines.create');
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string|min:3|max:20',
                'name' => 'required|string|min:2',
                'description' => 'nullable|string',
                'category' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'min_stock_level' => 'required|integer|min:0',
                'supplier_id' => 'nullable|exists:suppliers,id',
            ]);

            $medicine = $this->medicineService->createMedicine($validated);

            return response()->json([
                'success' => true,
                'message' => 'Medicine created successfully',
                'data' => $medicine->toArray()
            ], 201);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating medicine'
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $medicine = $this->medicineService->getMedicine($id);

            if (!$medicine) {
                return response()->json([
                    'success' => false,
                    'message' => 'Medicine not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $medicine->toArray()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving medicine'
            ], 500);
        }
    }

    public function edit(int $id): View
    {
        $medicine = $this->medicineService->getMedicine($id);
        
        if (!$medicine) {
            abort(404);
        }

        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'code' => 'required|string|min:3|max:20',
                'name' => 'required|string|min:2',
                'description' => 'nullable|string',
                'category' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock_quantity' => 'required|integer|min:0',
                'min_stock_level' => 'required|integer|min:0',
                'supplier_id' => 'nullable|exists:suppliers,id',
            ]);

            $medicine = $this->medicineService->updateMedicine($id, $validated);

            return response()->json([
                'success' => true,
                'message' => 'Medicine updated successfully',
                'data' => $medicine->toArray()
            ]);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating medicine'
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $deleted = $this->medicineService->deleteMedicine($id);

            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Medicine not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Medicine deleted successfully'
            ]);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting medicine'
            ], 500);
        }
    }

    public function search(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q', '');
            
            if (empty($query)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Search query is required'
                ], 422);
            }

            $medicines = $this->medicineService->searchMedicines($query);

            return response()->json([
                'success' => true,
                'data' => $medicines
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while searching medicines'
            ], 500);
        }
    }

    public function lowStock(): JsonResponse
    {
        try {
            $medicines = $this->medicineService->getLowStockMedicines();

            return response()->json([
                'success' => true,
                'data' => $medicines
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving low stock medicines'
            ], 500);
        }
    }

    public function outOfStock(): JsonResponse
    {
        try {
            $medicines = $this->medicineService->getOutOfStockMedicines();

            return response()->json([
                'success' => true,
                'data' => $medicines
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving out of stock medicines'
            ], 500);
        }
    }

    public function adjustStock(Request $request, int $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'quantity' => 'required|integer|min:1',
                'type' => 'required|in:add,reduce'
            ]);

            $medicine = $this->medicineService->adjustStock(
                $id, 
                $validated['quantity'], 
                $validated['type']
            );

            return response()->json([
                'success' => true,
                'message' => 'Stock adjusted successfully',
                'data' => $medicine->toArray()
            ]);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adjusting stock'
            ], 500);
        }
    }

    public function inventoryReport(): JsonResponse
    {
        try {
            $report = $this->medicineService->getInventoryReport();

            return response()->json([
                'success' => true,
                'data' => $report
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while generating inventory report'
            ], 500);
        }
    }
} 