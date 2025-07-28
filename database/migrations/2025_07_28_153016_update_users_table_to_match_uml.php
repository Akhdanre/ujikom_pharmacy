<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add username column first with default value
            $table->string('username')->nullable()->after('id');
        });
        
        // Update existing users with unique username
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            $username = 'user_' . $user->id;
            DB::table('users')->where('id', $user->id)->update(['username' => $username]);
        }
        
        // Make username unique and not nullable
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable(false)->change();
        });
        
        // Drop existing role column and re-add with correct enum values
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->enum('role', ['admin', 'pharmacist', 'buyer', 'supplier'])->default('buyer')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('role');
            $table->enum('role', ['admin', 'apoteker', 'users_pelanggan'])->default('users_pelanggan')->after('email');
        });
    }
};
