<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;

/**
 * @author  Pablo Martinez <pablomartinez123@hotmail.com>
 *
 * @OA\Schema(
 *     title="PaymentMethod",
 *     required={"customer_id", "name"},
 *     @OA\Property(
 *       property="customer_id",
 *       type="int"
 *     ),
 *     @OA\Property(
 *       property="name",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="external_id",
 *       type="string"
 *     )
 * )
 */
class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    protected $casts = [
        'customer_id' => 'int',
        'name' => 'string',
        'external_id' => 'string',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function setCustomer(Customer $customer): PaymentMethod
    {
        $this->customer_id = $customer->getId();

        return $this;
    }

    public function getCustomer(): Customer
    {
        return Customer::findOrFail($this->customer_id);
    }

    public function setName(string $name): PaymentMethod
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setExternalId(string $externalId): PaymentMethod
    {
        $this->external_id = $externalId;

        return $this;
    }

    public function getExternalId(): string
    {
        return $this->external_id;
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
