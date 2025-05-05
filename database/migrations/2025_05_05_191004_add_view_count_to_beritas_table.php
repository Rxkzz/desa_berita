<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('beritas', function (Blueprint $table) {
            if (!Schema::hasColumn('beritas', 'view_count')) {
                $table->unsignedBigInteger('view_count')->default(0);
            }
        });
    }
    
    public function down()
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn('view_count');
        });
    }
};
