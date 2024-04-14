<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    use HasFactory;

    protected $table = 'log_history';

    protected $fillable = [
        'users_id',
        'notifications_id',
        'categories_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'notifications_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
}
