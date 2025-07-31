<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Domain\Medicine\Entities\Medicine;
use App\Domain\Sales\Entities\SalesTransaction;
use App\Domain\Sales\Entities\SalesTransactionDetail;
use Carbon\Carbon;

class SalesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create dummy sales transactions for the last 7 days
        $this->createDummySalesData();
    }

    private function createDummySalesData()
    {
        // Get some medicines
        $medicines = Medicine::all();
        if ($medicines->isEmpty()) {
            $this->command->info('No medicines found. Please run MedicineSeeder first.');
            return;
        }

        // Get or create a customer user
        $customer = User::where('role', 'buyer')->first();
        if (!$customer) {
            $customer = User::create([
                'username' => 'customer_test',
                'name' => 'Customer Test',
                'email' => 'customer@test.com',
                'password' => bcrypt('password'),
                'role' => 'buyer'
            ]);
        }

        // Create sales transactions for the last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            // Create 1-5 transactions per day
            $numTransactions = rand(1, 5);
            
            for ($j = 0; $j < $numTransactions; $j++) {
                $transaction = SalesTransaction::create([
                    'user_id' => $customer->id,
                    'total_price' => 0,
                    'status' => 'completed',
                    'created_at' => $date->copy()->addHours(rand(9, 17))->addMinutes(rand(0, 59)),
                    'updated_at' => $date->copy()->addHours(rand(9, 17))->addMinutes(rand(0, 59)),
                ]);

                // Add 1-3 medicines per transaction
                $numMedicines = rand(1, 3);
                $totalPrice = 0;
                
                for ($k = 0; $k < $numMedicines; $k++) {
                    $medicine = $medicines->random();
                    $quantity = rand(1, 3);
                    $price = $medicine->price;
                    
                    SalesTransactionDetail::create([
                        'transaction_id' => $transaction->transaction_id,
                        'product_id' => $medicine->id,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);
                    
                    $totalPrice += $quantity * $price;
                }
                
                // Update transaction total
                $transaction->update(['total_price' => $totalPrice]);
            }
        }

        $this->command->info('Dummy sales data created successfully!');
    }
} 