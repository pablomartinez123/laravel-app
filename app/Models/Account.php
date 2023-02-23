<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Annotations as OA;

/**
 * @author  Pablo Martinez <pablomartinez123@hotmail.com>
 *
 * @OA\Schema(
 *     title="Account",
 *     required={"name"},
 *     @OA\Property(
 *       property="name",
 *       type="string"
 *     )
 * )
 */
class Account extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    protected $casts = [
        'name' => 'string'
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Account
    {
        $this->name = $name;

        return $this;
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
