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
            = ['name', 'description'];

        protected $dates = ['created_at','updated_at'];

        public function clients() : BelongsToMany{
            return $this->belongsToMany(Client::class);
        }
    }
