<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    const STRIPE = 'stripe';

    protected $fillable = ['*'];

    protected $casts = [
        'display_name' => 'string',
        'code' => 'string',
        'description' => 'string',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    public function setDisplayName(string $display_ame): Gateway
    {
        $this->display_ame = $display_ame;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Gateway
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Gateway
    {
        $this->description = $description;

        return $this;
    }
}
