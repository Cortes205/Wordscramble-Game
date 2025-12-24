<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $db = "db_words";
    private $table = "tbl_stats";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable("{$this->db}.{$this->table}")) {
            Schema::create("{$this->db}.{$this->table}", function (Blueprint $table) {
                $table->id();
                $table->bigInteger("fk_stats_category");
                $table->bigInteger("fk_user_id");
                $table->text("info_json");
                $table->dateTime("created_at");
                $table->dateTime("updated_at");
                $table->boolean("active")->default(1);
            });
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
