<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait Uuid_Trait
{
    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
           $model->id = Uuid::uuid4()->toString();
        });
    }
}