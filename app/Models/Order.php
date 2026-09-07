<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUSES = [
        'en_attente' => ['label' => 'En attente', 'class' => 'badge-warning'],
        'expediee'   => ['label' => 'Expédiée', 'class' => 'badge-info'],
        'livree'     => ['label' => 'Livrée', 'class' => 'badge-success'],
        'annulee'    => ['label' => 'Annulée', 'class' => 'badge-danger'],
    ];

    protected $fillable = [
        'reference', 'user_id', 'customer_name', 'email', 'phone', 'address',
        'city', 'zone', 'payment_method', 'promotion_code', 'status', 'subtotal',
        'discount', 'shipping', 'total', 'items',
    ];

    protected function casts(): array
    {
        return [
            'items' => 'array',
            'subtotal' => 'integer',
            'discount' => 'integer',
            'shipping' => 'integer',
            'total' => 'integer',
        ];
    }

    public function getRefAttribute(): string
    {
        return '#'.$this->reference;
    }

    public function getClientAttribute(): string
    {
        return $this->customer_name;
    }
}
