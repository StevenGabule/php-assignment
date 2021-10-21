<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $guarded = [];

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
    }
}
