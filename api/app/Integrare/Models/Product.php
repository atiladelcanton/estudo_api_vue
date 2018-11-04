<?php

    namespace App\Integrare\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;

    class Product extends Model
    {
        /**
         *  The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable
            = ['name', 'description', 'unit_price'];

        public function clients() : BelongsToMany{
            return $this->belongsToMany(Client::class);
        }
    }
