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
 *     title="AccountGatewayValue",
 *     required={"account_gateway_id", "gateway_value_id", "value"},
 *     @OA\Property(
 *       property="account_gateway_id",
 *       type="int"
 *     ),
 *     @OA\Property(
 *       property="gateway_value_id",
 *       type="int"
 *     ),
 *     @OA\Property(
 *       property="value",
 *       type="string"
 *     )
 * )
 */
class AccountGatewayValue extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    protected $casts = [
        'account_gateway_id' => 'int',
        'gateway_value_id' => 'int',
        'value' => 'string'
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function setValue(string $value): AccountGatewayValue
    {
        $this->value = $value;

        return $this;
    }

    public function setAccountGateway(AccountGateway $accountGateway): AccountGatewayValue
    {
        $this->account_gateway_id = $accountGateway->getId();

        return $this;
    }

    public function setGatewayValue(GatewayValue $gatewayValue): AccountGatewayValue
    {
        $this->gateway_value_id = $gatewayValue->getId();

        return $this;
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function gatewayValue(): BelongsTo
    {
        return $this->belongsTo(GatewayValue::class);
    }
}
