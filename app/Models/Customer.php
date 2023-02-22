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
 *     title="Customer",
 *     required={"first_name", "last_name", "email"},
 *     @OA\Property(
 *       property="first_name",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="last_name",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="email",
 *       type="string"
 *     )
 * )
 */
class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): Customer
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): Customer
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Customer
    {
        $this->email = $email;

        return $this;
    }

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }
}
