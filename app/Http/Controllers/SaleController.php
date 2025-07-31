<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Medicine;
use App\Models\Customer;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'medicine'])->latest()->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $medicines = Medicine::where('stock', '>', 0)->get();
        $customers = Customer::all();
        return view('sales.create', compact('medicines', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        $medicine = Medicine::findOrFail($request->medicine_id);
        
        if ($medicine->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock. Available: ' . $medicine->stock]);
        }

        // Create sale
        $sale = Sale::create($request->all());

        // Update stock
        $medicine->decrement('stock', $request->quantity);

        return redirect()->route('sales.index')
            ->with('success', 'Sale created successfully.');
    }

    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $medicines = Medicine::all();
        $customers = Customer::all();
        return view('sales.edit', compact('sale', 'medicines', 'customers'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ]);

        // Restore previous stock
        $oldMedicine = Medicine::find($sale->medicine_id);
        $oldMedicine->increment('stock', $sale->quantity);

        // Check new stock availability
        $newMedicine = Medicine::find($request->medicine_id);
        if ($newMedicine->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Insufficient stock. Available: ' . $newMedicine->stock]);
        }

        // Update sale
        $sale->update($request->all());

        // Update new stock
        $newMedicine->decrement('stock', $request->quantity);

        return redirect()->route('sales.index')
            ->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        // Restore stock
        $medicine = Medicine::find($sale->medicine_id);
        $medicine->increment('stock', $sale->quantity);

        $sale->delete();

        return redirect()->route('sales.index')
            ->with('success', 'Sale deleted successfully.');
    }
} 