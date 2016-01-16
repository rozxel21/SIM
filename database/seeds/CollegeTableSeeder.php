<?php

use Illuminate\Database\Seeder;

class CollegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(__DIR__ . '/dumps/colleges.sql');

        if (! str_contains($sql, ['DELETE', 'TRUNCATE'])) {
            throw new Exception('Invalid sql file. This will not empty the tables first.');
        }

        // split the statements, so DB::statement can execute them.
        $statements = array_filter(array_map('trim', explode(';', $sql)));

        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
