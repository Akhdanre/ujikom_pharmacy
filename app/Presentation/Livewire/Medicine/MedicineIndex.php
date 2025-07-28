<?php

namespace App\Livewire\Medicine;

use App\Application\Services\MedicineApplicationService;
use Livewire\Component;
use Livewire\WithPagination;

class MedicineIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $stockStatus = '';
    public $showLowStock = false;
    public $showOutOfStock = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'stockStatus' => ['except' => ''],
    ];

    public function mount()
    {
        // Initialize component
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function updatedStockStatus()
    {
        $this->resetPage();
    }

    public function toggleLowStock()
    {
        $this->showLowStock = !$this->showLowStock;
        $this->resetPage();
    }

    public function toggleOutOfStock()
    {
        $this->showOutOfStock = !$this->showOutOfStock;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'category', 'stockStatus', 'showLowStock', 'showOutOfStock']);
        $this->resetPage();
    }

    public function render()
    {
        $medicineService = app(MedicineApplicationService::class);
        
        $medicines = [];
        $statistics = [];

        if ($this->showLowStock) {
            $medicines = $medicineService->getLowStockMedicines();
        } elseif ($this->showOutOfStock) {
            $medicines = $medicineService->getOutOfStockMedicines();
        } elseif (!empty($this->search)) {
            $medicines = $medicineService->searchMedicines($this->search);
        } elseif (!empty($this->category)) {
            $medicines = $medicineService->getMedicinesByCategory($this->category);
        } else {
            $medicines = $medicineService->getAllMedicines();
        }

        $statistics = $medicineService->getMedicineStatistics();

        return view('livewire.medicine.medicine-index', [
            'medicines' => $medicines,
            'statistics' => $statistics
        ]);
    }
} 