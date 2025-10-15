<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'read_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(): void
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    /**
     * Mark notification as unread.
     */
    public function markAsUnread(): void
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }

    /**
     * Scope a query to only include unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope a query to only include read notifications.
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Create a new order notification for merchants.
     */
    public static function createOrderNotification($merchantId, array $orderData): self
    {
        return self::create([
            'user_id' => $merchantId,
            'type' => 'order_placed',
            'title' => 'Pesanan Baru',
            'message' => "Pesanan baru dari {$orderData['customer_name']} dengan total Rp " . number_format($orderData['total'], 0, ',', '.'),
            'data' => [
                'order_id' => $orderData['order_id'],
                'customer_name' => $orderData['customer_name'],
                'total' => $orderData['total'],
                'items_count' => $orderData['items_count'] ?? 0
            ]
        ]);
    }
}