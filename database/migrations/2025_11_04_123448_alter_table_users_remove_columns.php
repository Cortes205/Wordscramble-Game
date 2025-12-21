<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    private $db = "db_words";
    private $table = "users";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("{$this->db}.{$this->table}", function (Blueprint $table) {
            $table->dropColumn("email");
            $table->dropColumn("email_verified_at");
            $table->dropColumn("two_factor_secret");
            $table->dropColumn("two_factor_recovery_codes");
            $table->dropColumn("two_factor_confirmed_at");
            $table->boolean("active")->after("updated_at")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("{$this->db}.{$this->table}", function (Blueprint $table) {
            $table->string("email")->after("name");
            $table->timestamp("email_verified_at")->after("email");
            $table->text("two_factor_secret")->after("password");
            $table->text("two_factor_recovery_codes")->after("two_factor_secret");
            $table->timestamp("two_factor_confirmed_at")->after("two_factor_recovery_codes");
            $table->dropColumn("active");
        });
    }
};
