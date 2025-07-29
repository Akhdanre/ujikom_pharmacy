<?php

namespace App\Presentation\Controllers\Web;

use App\Application\Services\MedicineApplicationService;
use App\Presentation\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MedicineController extends BaseController {
    public function __construct(
        private MedicineApplicationService $medicineService
    ) {
    }

    /**
     * Display a listing of medicines
     */
    public function index(): View {
        $medicines = $this->medicineService->getAllMedicines();
        $statistics = $this->medicineService->getMedicineStatistics();

        return view('features.medicines.index', compact('medicines', 'statistics'));
    }

    /**
     * Show the form for creating a new medicine
     */
    public function create(): View {
        return view('features.medicines.create');
    }

    /**
     * Store a newly created medicine
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validated = $request->validate([
                'medicine_name' => 'required|string|min:2|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category_id' => 'nullable|exists:categories,id',
                'image_url' => 'nullable|string',
                'expired_at' => 'nullable|date|after:today',
            ]);

            $this->medicineService->createMedicine($validated);

            return redirect()->route('medicines.index')
                ->with('success', 'Obat berhasil ditambahkan');
        } catch (\InvalidArgumentException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menambahkan obat']);
        }
    }

    /**
     * Display the specified medicine
     */
    public function show(int $id): View {
        $medicine = $this->medicineService->getMedicine($id);

        if (!$medicine) {
            abort(404, 'Obat tidak ditemukan');
        }

        return view('features.medicines.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified medicine
     */
    public function edit(int $id): View {
        $medicine = $this->medicineService->getMedicine($id);

        if (!$medicine) {
            abort(404, 'Obat tidak ditemukan');
        }

        return view('features.medicines.edit', compact('medicine'));
    }

    /**
     * Update the specified medicine
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            $validated = $request->validate([
                'medicine_name' => 'required|string|min:2|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category_id' => 'nullable|exists:categories,id',
                'image_url' => 'nullable|string',
                'expired_at' => 'nullable|date|after:today',
            ]);

            $this->medicineService->updateMedicine($id, $validated);

            return redirect()->route('medicines.index')
                ->with('success', 'Obat berhasil diperbarui');
        } catch (\InvalidArgumentException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui obat']);
        }
    }

    /**
     * Remove the specified medicine
     */
    public function destroy(int $id): RedirectResponse {
        try {
            $deleted = $this->medicineService->deleteMedicine($id);

            if (!$deleted) {
                return redirect()->back()
                    ->withErrors(['error' => 'Obat tidak ditemukan']);
            }

            return redirect()->route('medicines.index')
                ->with('success', 'Obat berhasil dihapus');
        } catch (\InvalidArgumentException $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus obat']);
        }
    }

    /**
     * Display medicines with low stock
     */
    public function lowStock(): View {
        $medicines = $this->medicineService->getLowStockMedicines();
        return view('features.medicines.low-stock', compact('medicines'));
    }

    /**
     * Display medicines that are out of stock
     */
    public function outOfStock(): View {
        $medicines = $this->medicineService->getOutOfStockMedicines();
        return view('features.medicines.out-of-stock', compact('medicines'));
    }

    /**
     * Display inventory report
     */
    public function inventoryReport(): View {
        $report = $this->medicineService->getInventoryReport();
        return view('features.medicines.inventory-report', compact('report'));
    }

    /**
     * Search medicines
     */
    public function search(Request $request): View {
        $query = $request->get('q', '');

        if (empty($query)) {
            $medicines = $this->medicineService->getAllMedicines();
            $statistics = $this->medicineService->getMedicineStatistics();
            return view('features.medicines.index', compact('medicines', 'statistics'));
        }

        $medicines = $this->medicineService->searchMedicines($query);
        return view('features.medicines.search', compact('medicines', 'query'));
    }

    /**
     * Display expired medicines
     */
    public function expired(): View {
        $medicines = $this->medicineService->getExpiredMedicines();
        return view('features.medicines.expired', compact('medicines'));
    }

    /**
     * Display medicines expiring soon
     */
    public function expiringSoon(): View {
        $medicines = $this->medicineService->getExpiringSoonMedicines();
        return view('features.medicines.expiring-soon', compact('medicines'));
    }
}
