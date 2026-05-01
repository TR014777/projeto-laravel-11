<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'client',
        'date', 
        'weekday', 
        'start', 'end',
        'status', 
        'color'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            $appointment->weekday = self::getPortugueseWeekday($appointment->date);
        });

        static::updating(function ($appointment) {
            $appointment->weekday = self::getPortugueseWeekday($appointment->date);
        });
    }

    private static function getPortugueseWeekday($date)
    {
        $days = [
            'Sunday'    => 'Domingo',
            'Monday'    => 'Segunda',
            'Tuesday'   => 'Terça',
            'Wednesday' => 'Quarta',
            'Thursday'  => 'Quinta',
            'Friday'    => 'Sexta',
            'Saturday'  => 'Sábado',
        ];

        $englishDay = Carbon::parse($date)->format('l');
        return $days[$englishDay];
    }


    public function user() {
        return $this->belongsTo(User::class);
    }
    //protected $table = "agendamentos";
}
