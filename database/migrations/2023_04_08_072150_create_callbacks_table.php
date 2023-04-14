<?php

declare(strict_types=1);

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('callbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class)->nullable()->constrained();
            $table->string('name');
            $table->string('phone');
            $table->string('timezone')->nullable();
            $table->string('url')->nullable();
            $table->text('comment')->nullable();
            $table->integer('telegram_message_id')->nullable();
            $table->timestamps();
            $table->timestamp('answered_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callbacks');
    }
};
