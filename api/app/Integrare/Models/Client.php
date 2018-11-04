<?php

    namespace App\Integrare\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;

    class Client extends Model
    {
        /**
         *  The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable
            = [
                'name',
                'cep',
                'city',
                'state',
                'neighborhood',
                'address',
                'email',
            ];

        protected $dates = ['created_at','updated_at'];
        /**
         * @return BelongsToMany
         */
        public function products(): BelongsToMany
        {
            return $this->belongsToMany(Product::class)->withPivot('quantity','date','unit_price','total');
        }
    }
