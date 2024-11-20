<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['original_url', 'short_code'];

    public static function generateShortCode(): string
    {
        return substr(bin2hex(random_bytes(4)), 0, 6);
    }
}
