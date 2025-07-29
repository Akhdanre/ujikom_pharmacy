<?php

namespace App\Domain\Shipping\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipping extends Model
{
    protected $primaryKey = 'shipping_id';

    protected $fillable = [
        'transaction_id',
        'transaction_type',
        'shipping_address',
        'status',
        'sender',
        'shipping_date'
    ];

    protected $casts = [
        'shipping_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Business Logic Methods
    public function isShipped(): bool
    {
        return $this->status === 'shipped';
    }

    public function isInTransit(): bool
    {
        return $this->status === 'in transit';
    }

    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }

    public function canBeInTransit(): bool
    {
        return $this->isShipped();
    }

    public function canBeDelivered(): bool
    {
        return $this->isInTransit();
    }

    public function updateStatus(string $newStatus): void
    {
        $validStatuses = ['shipped', 'in transit', 'delivered'];
        
        if (!in_array($newStatus, $validStatuses)) {
            throw new \InvalidArgumentException('Invalid status');
        }

        $this->status = $newStatus;
        $this->save();
    }

    public function markAsInTransit(): void
    {
        if (!$this->canBeInTransit()) {
            throw new \InvalidArgumentException('Shipping cannot be marked as in transit');
        }

        $this->updateStatus('in transit');
    }

    public function markAsDelivered(): void
    {
        if (!$this->canBeDelivered()) {
            throw new \InvalidArgumentException('Shipping cannot be marked as delivered');
        }

        $this->updateStatus('delivered');
    }

    public function updateShippingDate(\DateTime $shippingDate): void
    {
        $this->shipping_date = $shippingDate;
        $this->save();
    }

    public function updateAddress(string $newAddress): void
    {
        if (empty(trim($newAddress))) {
            throw new \InvalidArgumentException('Shipping address cannot be empty');
        }

        $this->shipping_address = trim($newAddress);
        $this->save();
    }

    public function updateSender(string $newSender): void
    {
        if (empty(trim($newSender))) {
            throw new \InvalidArgumentException('Sender cannot be empty');
        }

        $this->sender = trim($newSender);
        $this->save();
    }

    public function getStatusDisplayName(): string
    {
        return match($this->status) {
            'shipped' => 'Shipped',
            'in transit' => 'In Transit',
            'delivered' => 'Delivered',
            default => 'Unknown'
        };
    }

    public function getStatusColor(): string
    {
        return match($this->status) {
            'shipped' => 'blue',
            'in transit' => 'orange',
            'delivered' => 'green',
            default => 'gray'
        };
    }

    public function getFormattedShippingDate(): string
    {
        return $this->shipping_date ? $this->shipping_date->format('d M Y H:i') : 'Not set';
    }

    public function getEstimatedDeliveryDate(): ?\DateTime
    {
        if (!$this->shipping_date) {
            return null;
        }

        // Estimate 3-5 days for delivery
        return $this->shipping_date->addDays(rand(3, 5));
    }

    // Relationships
    public function purchaseTransaction(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Purchase\Entities\PurchaseTransaction::class, 'transaction_id')
            ->where('transaction_type', 'purchase');
    }

    public function salesTransaction(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Sales\Entities\SalesTransaction::class, 'transaction_id')
            ->where('transaction_type', 'sales');
    }

    public function transaction(): BelongsTo
    {
        if ($this->transaction_type === 'purchase') {
            return $this->purchaseTransaction();
        } else {
            return $this->salesTransaction();
        }
    }
} 