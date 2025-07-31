<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Medicine;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('medicine')->latest()->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $medicines = Medicine::all();
        return view('purchases.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'supplier' => 'nullable|string|max:255',
        ]);

        // Create purchase
        $purchase = Purchase::create($request->all());

        // Update stock
        $medicine = Medicine::find($request->medicine_id);
        $medicine->increment('stock', $request->quantity);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase created successfully.');
    }

    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $medicines = Medicine::all();
        return view('purchases.edit', compact('purchase', 'medicines'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'supplier' => 'nullable|string|max:255',
        ]);

        // Restore previous stock
        $oldMedicine = Medicine::find($purchase->medicine_id);
        $oldMedicine->decrement('stock', $purchase->quantity);

        // Update purchase
        $purchase->update($request->all());

        // Update new stock
        $newMedicine = Medicine::find($request->medicine_id);
        $newMedicine->increment('stock', $request->quantity);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        // Restore stock
        $medicine = Medicine::find($purchase->medicine_id);
        $medicine->decrement('stock', $purchase->quantity);

        $purchase->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase deleted successfully.');
    }
} 