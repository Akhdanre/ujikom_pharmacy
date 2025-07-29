<?php

namespace App\Presentation\Controllers\Web;

use App\Presentation\Controllers\BaseController;
use Illuminate\Http\Request;

class BuyTransactionController extends BaseController
{
    public function index()
    {
        // Dummy data for buy transactions (purchases from suppliers)
        $buyTransactions = [
            [
                'id' => 1,
                'date' => '2024-06-01',
                'supplier_name' => 'PT. Medika Sejahtera',
                'supplier_phone' => '+62 21-555-0123',
                'supplier_email' => 'contact@medikasejahtera.com',
                'medicine_name' => 'Paracetamol 500mg',
                'quantity' => 100,
                'unit_price' => 15000,
                'total_price' => 1500000,
                'status' => 'completed',
                'payment_method' => 'Transfer',
                'payment_status' => 'Paid',
                'delivery_date' => '2024-06-03',
                'notes' => 'Regular monthly supply'
            ],
            [
                'id' => 2,
                'date' => '2024-06-01',
                'supplier_name' => 'CV. Farmasi Maju',
                'supplier_phone' => '+62 21-555-0456',
                'supplier_email' => 'sales@farmasimaju.co.id',
                'medicine_name' => 'Amoxicillin 500mg',
                'quantity' => 50,
                'unit_price' => 18000,
                'total_price' => 900000,
                'status' => 'pending',
                'payment_method' => 'Cash',
                'payment_status' => 'Pending',
                'delivery_date' => '2024-06-05',
                'notes' => 'Urgent order for low stock'
            ],
            [
                'id' => 3,
                'date' => '2024-05-31',
                'supplier_name' => 'PT. Kimia Farma',
                'supplier_phone' => '+62 21-555-0789',
                'supplier_email' => 'purchasing@kimiafarma.co.id',
                'medicine_name' => 'Ibuprofen 400mg',
                'quantity' => 75,
                'unit_price' => 16000,
                'total_price' => 1200000,
                'status' => 'completed',
                'payment_method' => 'Transfer',
                'payment_status' => 'Paid',
                'delivery_date' => '2024-06-02',
                'notes' => 'Bulk order discount applied'
            ],
            [
                'id' => 4,
                'date' => '2024-05-30',
                'supplier_name' => 'CV. Medika Utama',
                'supplier_phone' => '+62 21-555-0321',
                'supplier_email' => 'info@medikautama.com',
                'medicine_name' => 'Vitamin C 1000mg',
                'quantity' => 200,
                'unit_price' => 12000,
                'total_price' => 2400000,
                'status' => 'cancelled',
                'payment_method' => 'Card',
                'payment_status' => 'Refunded',
                'delivery_date' => '2024-06-01',
                'notes' => 'Supplier unable to meet delivery date'
            ],
            [
                'id' => 5,
                'date' => '2024-05-29',
                'supplier_name' => 'PT. Indofarma',
                'supplier_phone' => '+62 21-555-0654',
                'supplier_email' => 'sales@indofarma.co.id',
                'medicine_name' => 'Omeprazole 20mg',
                'quantity' => 60,
                'unit_price' => 25000,
                'total_price' => 1500000,
                'status' => 'completed',
                'payment_method' => 'Transfer',
                'payment_status' => 'Paid',
                'delivery_date' => '2024-06-01',
                'notes' => 'Premium quality medicine'
            ],
            [
                'id' => 6,
                'date' => '2024-05-28',
                'supplier_name' => 'CV. Farmasi Sehat',
                'supplier_phone' => '+62 21-555-0987',
                'supplier_email' => 'contact@farmasisehat.com',
                'medicine_name' => 'Cetirizine 10mg',
                'quantity' => 80,
                'unit_price' => 10000,
                'total_price' => 800000,
                'status' => 'completed',
                'payment_method' => 'Cash',
                'payment_status' => 'Paid',
                'delivery_date' => '2024-05-30',
                'notes' => 'Allergy season stock up'
            ]
        ];

        return view('buy-transactions.index', compact('buyTransactions'));
    }

    public function create()
    {
        // Dummy suppliers for dropdown
        $suppliers = [
            ['id' => 1, 'name' => 'PT. Medika Sejahtera', 'phone' => '+62 21-555-0123', 'email' => 'contact@medikasejahtera.com'],
            ['id' => 2, 'name' => 'CV. Farmasi Maju', 'phone' => '+62 21-555-0456', 'email' => 'sales@farmasimaju.co.id'],
            ['id' => 3, 'name' => 'PT. Kimia Farma', 'phone' => '+62 21-555-0789', 'email' => 'purchasing@kimiafarma.co.id'],
            ['id' => 4, 'name' => 'CV. Medika Utama', 'phone' => '+62 21-555-0321', 'email' => 'info@medikautama.com'],
            ['id' => 5, 'name' => 'PT. Indofarma', 'phone' => '+62 21-555-0654', 'email' => 'sales@indofarma.co.id'],
            ['id' => 6, 'name' => 'CV. Farmasi Sehat', 'phone' => '+62 21-555-0987', 'email' => 'contact@farmasisehat.com'],
        ];

        // Dummy medicines for dropdown
        $medicines = [
            ['id' => 1, 'name' => 'Paracetamol 500mg', 'current_stock' => 150, 'suggested_price' => 15000],
            ['id' => 2, 'name' => 'Amoxicillin 500mg', 'current_stock' => 80, 'suggested_price' => 18000],
            ['id' => 3, 'name' => 'Ibuprofen 400mg', 'current_stock' => 120, 'suggested_price' => 16000],
            ['id' => 4, 'name' => 'Vitamin C 1000mg', 'current_stock' => 200, 'suggested_price' => 12000],
            ['id' => 5, 'name' => 'Omeprazole 20mg', 'current_stock' => 60, 'suggested_price' => 25000],
            ['id' => 6, 'name' => 'Cetirizine 10mg', 'current_stock' => 90, 'suggested_price' => 10000],
        ];

        return view('buy-transactions.create', compact('suppliers', 'medicines'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'supplier_id' => 'required|integer',
            'medicine_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,card',
            'delivery_date' => 'required|date|after:today',
            'notes' => 'nullable|string|max:500',
        ]);

        // In a real application, you would save to database here
        return redirect()->route('buy-transactions.index')
            ->with('success', 'Buy transaction created successfully!');
    }

    public function show($id)
    {
        // Dummy buy transaction data
        $buyTransaction = [
            'id' => $id,
            'date' => '2024-06-01',
            'supplier_name' => 'PT. Medika Sejahtera',
            'supplier_phone' => '+62 21-555-0123',
            'supplier_email' => 'contact@medikasejahtera.com',
            'supplier_address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
            'medicine_name' => 'Paracetamol 500mg',
            'quantity' => 100,
            'unit_price' => 15000,
            'total_price' => 1500000,
            'status' => 'completed',
            'payment_method' => 'Transfer',
            'payment_status' => 'Paid',
            'delivery_date' => '2024-06-03',
            'notes' => 'Regular monthly supply',
            'purchaser' => 'Sarah Johnson',
            'invoice_number' => 'INV-2024-001'
        ];

        return view('buy-transactions.show', compact('buyTransaction'));
    }

    public function edit($id)
    {
        // Dummy buy transaction data for editing
        $buyTransaction = [
            'id' => $id,
            'supplier_id' => 1,
            'medicine_id' => 1,
            'quantity' => 100,
            'unit_price' => 15000,
            'payment_method' => 'transfer',
            'delivery_date' => '2024-06-03',
            'status' => 'pending',
            'notes' => 'Regular monthly supply'
        ];

        $suppliers = [
            ['id' => 1, 'name' => 'PT. Medika Sejahtera', 'phone' => '+62 21-555-0123'],
            ['id' => 2, 'name' => 'CV. Farmasi Maju', 'phone' => '+62 21-555-0456'],
            ['id' => 3, 'name' => 'PT. Kimia Farma', 'phone' => '+62 21-555-0789'],
        ];

        $medicines = [
            ['id' => 1, 'name' => 'Paracetamol 500mg', 'current_stock' => 150, 'suggested_price' => 15000],
            ['id' => 2, 'name' => 'Amoxicillin 500mg', 'current_stock' => 80, 'suggested_price' => 18000],
            ['id' => 3, 'name' => 'Ibuprofen 400mg', 'current_stock' => 120, 'suggested_price' => 16000],
        ];

        return view('buy-transactions.edit', compact('buyTransaction', 'suppliers', 'medicines'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'supplier_id' => 'required|integer',
            'medicine_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,card',
            'delivery_date' => 'required|date',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string|max:500',
        ]);

        // In a real application, you would update the database here
        return redirect()->route('buy-transactions.index')
            ->with('success', 'Buy transaction updated successfully!');
    }

    public function destroy($id)
    {
        // In a real application, you would delete from database here
        return redirect()->route('buy-transactions.index')
            ->with('success', 'Buy transaction deleted successfully!');
    }
} 