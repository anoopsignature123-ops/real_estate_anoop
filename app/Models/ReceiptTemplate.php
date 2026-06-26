<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceiptTemplate extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'view_path',
        'description',
        'is_active',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function activate(): void
    {
        DB::transaction(function () {
            self::query()->update(['is_active' => false]);
            $this->update(['is_active' => true, 'status' => 'active']);
        });
    }
}
