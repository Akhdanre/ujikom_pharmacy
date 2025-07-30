<?php

namespace App\Http\Controllers\SellTransaction;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SellTransactionController extends BaseController {
    public function index() {
        // Dummy data for transactions
        $transactions = [
            [
                'id' => 1,
                'date' => '2024-06-01',
                'customer_name' => 'John Doe',
                'customer_phone' => '+62 812-3456-7890',
                'medicine_name' => 'Paracetamol 500mg',
                'quantity' => 2,
                'unit_price' => 20000,
                'total_price' => 40000,
                'status' => 'completed',
                'payment_method' => 'Cash',
                'cashier' => 'Sarah Johnson'
            ],
            [
                'id' => 2,
                'date' => '2024-06-01',
                'customer_name' => 'Jane Smith',
                'customer_phone' => '+62 813-9876-5432',
                'medicine_name' => 'Amoxicillin 500mg',
                'quantity' => 1,
                'unit_price' => 25000,
                'total_price' => 25000,
                'status' => 'pending',
                'payment_method' => 'Transfer',
                'cashier' => 'Mike Wilson'
            ],
            [
                'id' => 3,
                'date' => '2024-05-31',
                'customer_name' => 'Michael Lee',
                'customer_phone' => '+62 814-5678-9012',
                'medicine_name' => 'Ibuprofen 400mg',
                'quantity' => 3,
                'unit_price' => 25000,
                'total_price' => 75000,
                'status' => 'completed',
                'payment_method' => 'Cash',
                'cashier' => 'Sarah Johnson'
            ],
            [
                'id' => 4,
                'date' => '2024-05-30',
                'customer_name' => 'Anna Kim',
                'customer_phone' => '+62 815-1234-5678',
                'medicine_name' => 'Vitamin C 1000mg',
                'quantity' => 5,
                'unit_price' => 20000,
                'total_price' => 100000,
                'status' => 'cancelled',
                'payment_method' => 'Card',
                'cashier' => 'Mike Wilson'
            ],
            [
                'id' => 5,
                'date' => '2024-05-29',
                'customer_name' => 'David Chen',
                'customer_phone' => '+62 816-8765-4321',
                'medicine_name' => 'Omeprazole 20mg',
                'quantity' => 2,
                'unit_price' => 35000,
                'total_price' => 70000,
                'status' => 'completed',
                'payment_method' => 'Transfer',
                'cashier' => 'Sarah Johnson'
            ],
            [
                'id' => 6,
                'date' => '2024-05-28',
                'customer_name' => 'Lisa Wang',
                'customer_phone' => '+62 817-2345-6789',
                'medicine_name' => 'Cetirizine 10mg',
                'quantity' => 1,
                'unit_price' => 15000,
                'total_price' => 15000,
                'status' => 'completed',
                'payment_method' => 'Cash',
                'cashier' => 'Mike Wilson'
            ]
        ];

        return view('features.transactions.index', compact('transactions'));
    }

    public function create() {
        // Dummy medicines for dropdown
        $medicines = [
            ['id' => 1, 'name' => 'Paracetamol 500mg', 'stock' => 150, 'price' => 20000],
            ['id' => 2, 'name' => 'Amoxicillin 500mg', 'stock' => 80, 'price' => 25000],
            ['id' => 3, 'name' => 'Ibuprofen 400mg', 'stock' => 120, 'price' => 25000],
            ['id' => 4, 'name' => 'Vitamin C 1000mg', 'stock' => 200, 'price' => 20000],
            ['id' => 5, 'name' => 'Omeprazole 20mg', 'stock' => 60, 'price' => 35000],
            ['id' => 6, 'name' => 'Cetirizine 10mg', 'stock' => 90, 'price' => 15000],
        ];

        return view('features.transactions.create', compact('medicines'));
    }

    public function store(Request $request) {
        // Validate the request
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'medicine_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,transfer,card',
        ]);

        // In a real application, you would save to database here
        // For now, we'll just redirect with a success message
        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully!');
    }

    public function show($id) {
        // Dummy transaction data
        $transaction = [
            'id' => $id,
            'date' => '2024-06-01',
            'customer_name' => 'John Doe',
            'customer_phone' => '+62 812-3456-7890',
            'customer_email' => 'john.doe@email.com',
            'medicine_name' => 'Paracetamol 500mg',
            'quantity' => 2,
            'unit_price' => 20000,
            'total_price' => 40000,
            'status' => 'completed',
            'payment_method' => 'Cash',
            'cashier' => 'Sarah Johnson',
            'notes' => 'Customer requested for headache relief'
        ];

        return view('features.transactions.show', compact('transaction'));
    }

    public function edit($id) {
        // Dummy transaction data for editing
        $transaction = [
            'id' => $id,
            'customer_name' => 'John Doe',
            'customer_phone' => '+62 812-3456-7890',
            'medicine_id' => 1,
            'quantity' => 2,
            'payment_method' => 'cash',
            'status' => 'pending'
        ];

        $medicines = [
            ['id' => 1, 'name' => 'Paracetamol 500mg', 'stock' => 150, 'price' => 20000],
            ['id' => 2, 'name' => 'Amoxicillin 500mg', 'stock' => 80, 'price' => 25000],
            ['id' => 3, 'name' => 'Ibuprofen 400mg', 'stock' => 120, 'price' => 25000],
        ];

        return view('features.transactions.edit', compact('transaction', 'medicines'));
    }

    public function update(Request $request, $id) {
        // Validate the request
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'medicine_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,transfer,card',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        // In a real application, you would update the database here
        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully!');
    }

    public function destroy($id) {
        // In a real application, you would delete from database here
        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully!');
    }
}
