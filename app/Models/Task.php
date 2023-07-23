<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
    ];

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case 'pending':
                return 'Ожидание';
            case 'in_progress':
                return 'В работе';
            case 'resolved':
                return 'Решено';
            default:
                return '';
        }
    }

    public function isDeadlineClose()
    {
        $now = Carbon::now();
        $deadline = Carbon::parse($this->deadline);
        $diff = $deadline->diffInHours($now);
        return $diff < 24;
    }

    public function isDeadlinePassed()
    {
        return $this->deadline && $this->deadline < now();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
