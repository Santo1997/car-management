<?php

    namespace App\Models;

    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class User extends Authenticatable {
        use HasFactory, Notifiable;

        protected $fillable = [
            'name',
            'email',
            'password',
            'phone',
            'address',
            'role',
        ];

        public function isAdmin() {
            return $this->role === 'admin';
        }

        public function isCustomer() {
            return $this->role === 'customer';
        }

        // Define the relationship with Rental
        public function rentals() {
            return $this->hasMany(Rental::class);
        }
    }
