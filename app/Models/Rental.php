<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Rental extends Model {
        use HasFactory;

        protected $fillable = [
            'user_id',
            'car_id',
            'start_date',
            'end_date',
            'total_cost',
        ];

        // Define the relationship with Car
        public function car() {
            return $this->belongsTo(Car::class);
        }

        // Define the relationship with User
        public function user() {
            return $this->belongsTo(User::class);
        }
    }
