<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @author  Pablo Martinez <pablomartinez123@hotmail.com>
 *
 * @OA\Schema(
 *     title="GatewayValue",
 *     required={"gateway_id", "code", "name"},
 *     @OA\Property(
 *       property="gateway_id",
 *       type="int"
 *     ),
 *     @OA\Property(
 *       property="code",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="name",
 *       type="string"
 *     ),
 *     @OA\Property(
 *       property="description",
 *       type="string"
 *     )
 * )
 */
class GatewayValue extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    protected $casts = [
        'gateway_id' => 'int',
        'code' => 'string',
        'name' => 'string',
        'description' => 'string',
    ];

    public function getId(): int
    {
        return $this->id;
    }
}
