<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->dropColumn("name");
            $table->dropColumn("tokenable_id");
            $table->dropColumn("tokenable_type");
            $table->dropColumn("abilities");
            $table->uuid('userid');
            $table->uuid("tokenid");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->morphs('tokenable');
            $table->string('name');
            $table->text('abilities')->nullable();
            $table->dropColumn('userid');
            $table->dropColumn("tokenid");
        });
    }
};
