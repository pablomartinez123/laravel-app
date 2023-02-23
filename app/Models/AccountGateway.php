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
 *     title="AccountGateway",
 *     required={"account_id", "gateway_id"},
 *     @OA\Property(
 *       property="account_id",
 *       type="int"
 *     ),
 *     @OA\Property(
 *       property="gateway_id",
 *       type="int"
 *     ),
 *     @OA\Property(
 *       property="name",
 *       type="string"
 *     )
 * )
 */
class AccountGateway extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    protected $casts = [
        'account_id' => 'int',
        'gateway_id' => 'int',
        'name' => 'string'
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function setAccount(Account $account): AccountGateway
    {
        $this->account_id = $account->getId();

        return $this;
    }

    public function setGateway(Gateway $gateway): AccountGateway
    {
        $this->gateway_id = $gateway->getId();

        return $this;
    }

    public function setName(string $name): AccountGateway
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }
}
