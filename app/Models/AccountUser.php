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
 *     title="AccountUser",
 *     required={"account_id", "user_id"},
 *     @OA\Property(
 *       property="account_id",
 *       type="int"
 *     ),
 *     @OA\Property(
 *       property="user_id",
 *       type="int"
 *     )
 * )
 */
class AccountUser extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    protected $casts = [
        'account_id' => 'int',
        'user_id' => 'int'
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function setAccount(Account $account): AccountUser
    {
        $this->account_id = $account->getId();

        return $this;
    }

    public function setUser(User $user): AccountUser
    {
        $this->user_id = $user->getId();

        return $this;
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
