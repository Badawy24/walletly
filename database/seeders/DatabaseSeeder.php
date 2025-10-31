<?php

namespace Database\Seeders;

use App\Models\Deposit;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Categories for expenses
        $categories = ['food', 'transport', 'entertainment', 'shopping', 'bills', 'health', 'education', 'other'];

        // Create 20 users
        $users = User::factory(20)->create([
            'balance' => fn() => rand(1000, 10000),
            'daily_limit' => fn() => rand(50, 500),
            'weekly_limit' => fn() => rand(200, 2000),
            'monthly_limit' => fn() => rand(1000, 5000),
        ]);

        // Create expenses (approximately 300 records)
        $expenseCount = 0;
        while ($expenseCount < 300) {
            $user = $users->random();
            Expense::create([
                'user_id' => $user->id,
                'amount' => rand(10, 1000) + (rand(0, 99) / 100),
                'category' => $categories[array_rand($categories)],
                'date' => now()->subDays(rand(0, 90)),
                'notes' => rand(0, 1) ? 'Sample expense note ' . $expenseCount : null,
            ]);
            $expenseCount++;
        }

        // Create deposits (approximately 200 records)
        $depositCount = 0;
        while ($depositCount < 200) {
            $user = $users->random();
            Deposit::create([
                'user_id' => $user->id,
                'amount' => rand(100, 2000) + (rand(0, 99) / 100),
                'date' => now()->subDays(rand(0, 90)),
                'notes' => rand(0, 1) ? 'Sample deposit note ' . $depositCount : null,
            ]);
            $depositCount++;
        }

        // Total: 20 users + 300 expenses + 200 deposits = 520 records
        // Adjust to exactly 500 by removing some expenses
        if (($expenseCount + $depositCount + 20) > 500) {
            $toRemove = ($expenseCount + $depositCount + 20) - 500;
            Expense::inRandomOrder()->limit($toRemove)->delete();
        }
    }
}
