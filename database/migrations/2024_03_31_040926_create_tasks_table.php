<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('instagram_link')->nullable()->default(null);
            $table->string('tiktok_link')->nullable()->default(null);
            $table->timestamp('visit_at');
            $table->timestamp('post_at')->nullable()->default(null);
            $table->enum('payment_status', [\App\Enums\PaymentStatus::Unpaid->value, \App\Enums\PaymentStatus::Paid->value])->default(\App\Enums\PaymentStatus::Unpaid->value);
            $table->enum('type', [\App\Enums\TaskType::ProductReview->value, \App\Enums\TaskType::VisitStore->value])->default(\App\Enums\TaskType::VisitStore->value);
            $table->enum('status',[\App\Enums\TaskStatus::Todo->value, \App\Enums\TaskStatus::OnProgress->value, \App\Enums\TaskStatus::Done->value])->default(\App\Enums\TaskStatus::Todo->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
