<?php


namespace App\Models\Relations;

use App\Models\Service;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait Motators
{


    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('Y-m-d', strtotime($value)),
        );
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
