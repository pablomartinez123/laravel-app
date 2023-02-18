<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
