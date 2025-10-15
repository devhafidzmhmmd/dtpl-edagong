<?php

namespace App;

class User extends \Konekt\AppShell\Models\User
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'postal_code',
        'address',
        'area_landmark',
        'city',
        'province',
        'store_name',
        'umkm_category',
        'product_category',
        'store_owner_name',
        'ktp_number',
        'store_description',
        'store_logo',
        'profile_picture',
        'is_verified',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'ktp_number'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Check if user is UMKM seller
     *
     * @return bool
     */
    public function isUmkmSeller()
    {
        return $this->user_type === 'umkm_seller';
    }

    /**
     * Check if user is buyer
     *
     * @return bool
     */
    public function isBuyer()
    {
        return $this->user_type === 'buyer' || $this->user_type === 'customer';
    }

    /**
     * Check if user is verified
     *
     * @return bool
     */
    public function isVerified()
    {
        return $this->is_verified;
    }

    /**
     * Get the user's notifications.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the user's unread notifications.
     */
    public function unreadNotifications()
    {
        return $this->notifications()->unread();
    }

    /**
     * Get the count of unread notifications.
     */
    public function unreadNotificationsCount()
    {
        return $this->unreadNotifications()->count();
    }
}
