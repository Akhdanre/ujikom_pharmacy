<?php

namespace App\Http\Livewire\Medicine;

use App\Application\Services\MedicineApplicationService;
use Livewire\Component;

class MedicineForm extends Component {
    public $medicineId = null;
    public $code = '';
    public $name = '';
    public $description = '';
    public $category = '';
    public $price = '';
    public $stock_quantity = '';
    public $min_stock_level = '';
    public $supplier_id = '';
    public $is_active = true;

    public $categories = [
        'Antibiotik',
        'Analgesik',
        'Antipiretik',
        'Vitamin',
        'Suplemen',
        'Obat Luar',
        'Obat Mata',
        'Obat Telinga',
        'Lainnya'
    ];

    protected $rules = [
        'code' => 'required|string|min:3|max:20',
        'name' => 'required|string|min:2',
        'description' => 'nullable|string',
        'category' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock_quantity' => 'required|integer|min:0',
        'min_stock_level' => 'required|integer|min:0',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'is_active' => 'boolean'
    ];

    public function mount($medicineId = null) {
        if ($medicineId) {
            $this->loadMedicine($medicineId);
        }
    }

    public function loadMedicine($id) {
        $medicineService = app(MedicineApplicationService::class);
        $medicine = $medicineService->getMedicine($id);

        if ($medicine) {
            $this->medicineId = $medicine->id;
            $this->code = $medicine->code;
            $this->name = $medicine->name;
            $this->description = $medicine->description;
            $this->category = $medicine->category;
            $this->price = $medicine->price;
            $this->stock_quantity = $medicine->stock_quantity;
            $this->min_stock_level = $medicine->min_stock_level;
            $this->supplier_id = $medicine->supplier_id;
            $this->is_active = $medicine->is_active;
        }
    }

    public function save() {
        $this->validate();

        try {
            $medicineService = app(MedicineApplicationService::class);

            $data = [
                'code' => $this->code,
                'name' => $this->name,
                'description' => $this->description,
                'category' => $this->category,
                'price' => (float) $this->price,
                'stock_quantity' => (int) $this->stock_quantity,
                'min_stock_level' => (int) $this->min_stock_level,
                'supplier_id' => $this->supplier_id ? (int) $this->supplier_id : null,
                'is_active' => $this->is_active,
            ];

            if ($this->medicineId) {
                $medicine = $medicineService->updateMedicine($this->medicineId, $data);
                session()->flash('message', 'Medicine updated successfully!');
            } else {
                $medicine = $medicineService->createMedicine($data);
                session()->flash('message', 'Medicine created successfully!');
            }

            $this->resetForm();
            $this->dispatch('medicine-saved', $medicine->toArray());
        } catch (\InvalidArgumentException $e) {
            session()->flash('error', $e->getMessage());
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving medicine.');
        }
    }

    public function resetForm() {
        $this->reset([
            'medicineId',
            'code',
            'name',
            'description',
            'category',
            'price',
            'stock_quantity',
            'min_stock_level',
            'supplier_id'
        ]);
        $this->is_active = true;
    }

    public function render() {
        return view('livewire.medicine.medicine-form');
    }
}
