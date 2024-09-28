<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void {
            Schema::create('rentals', function (Blueprint $table) {
                $table->id();
                $table->date('start_date');
                $table->date('end_date');
                $table->decimal('total_cost', 8, 2);
                $table->foreignId('car_id')->constrained('cars')->restrictOnDelete()->cascadeOnUpdate();
                $table->foreignId('user_id')->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void {
            Schema::dropIfExists('rentals');
        }
    };
