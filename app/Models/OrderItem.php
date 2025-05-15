<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'knife_id', 'quantity', 'price'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function knife(): BelongsTo
    {
        return $this->belongsTo(Knife::class);
    }
}
