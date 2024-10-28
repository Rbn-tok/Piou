<?php

use App\Models\Feed;
use App\Models\Link;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('link_id');

            $table->after('user_id', function ($table) {
                $table->string('reference')->nullable();
                $table->foreignIdFor(Feed::class);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->foreignIdFor(Link::class);
            $table->dropColumn(['reference', 'feed_id']);
        });
    }
};
