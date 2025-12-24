<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $db = "db_words";
    private $table = "tbl_stats_categories";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable("{$this->db}.{$this->table}")) {
            Schema::create("{$this->db}.{$this->table}", function (Blueprint $table) {
                $table->id();
                $table->string("name");
                $table->dateTime("created_at");
                $table->dateTime("updated_at");
                $table->boolean("active")->default(1);
            });

            $now = Carbon::now("UTC")->format("Y-m-d H:i:s");

            DB::statement("INSERT INTO {$this->db}.{$this->table} (name, created_at, updated_at) VALUES 
                ('Unscrambled Sentences', '$now', '$now'), 
                ('Failed Sentences', '$now', '$now'),
                ('Unscrambling Rate', '$now', '$now'),
                ('Quickest Round', '$now', '$now')
            ");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("{$this->db}.{$this->table}");
    }
};
