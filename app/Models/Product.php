<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @param int $id
 * @param string $code
 * @param string $title
 * @param string $description
 * @param integer $price
 * @param boolean $published
 * @param Carbon $created_at
 * @param Carbon $updated_at
 * @param Carbon $deleted_at
 */
class Product extends Model
{
    use HasFactory;

    /**
     * Relationship for the Product's versions.
     *
     * @return HasMany
     */
    public function versions(): HasMany
    {
        return $this->hasMany(ProductVersion::class);
    }
}
