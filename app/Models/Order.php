<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Illuminate\Events\queueable;

class Order extends Model
{
    protected $guarded = [];

    use HasFactory;


    protected static function boot()
    {
        parent::boot();
        /**
         * Write code on Method
         *
         * @return void
         */
        static::updated(queueable(function ($order) {
            send_update($order);
        }));
    }

    public function combined_order(){
        return $this->belongsTo(CombinedOrder::class);
    }
}
