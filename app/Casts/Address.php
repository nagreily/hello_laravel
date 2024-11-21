<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class Address implements CastsAttributes
{
    public $lineOne;
    public $lineTwo;

//  值对象类型转换
    public function get($model, string $key, $value, array $attributes)
    {
        // TODO: Implement get() method.

        return new Address(
            $attributes['address_line_one'],
            $attributes['address_line_two']
        );
    }

    public function set($model, string $key, $value, array $attributes)
    {
        // TODO: Implement set() method.

        if (! $value instanceof Address) {
            throw new InvalidArgumentException('The given value is not an Address instance.');
        }

        return [
            'address_line_one' => $value->lineOne,
            'address_line_two' => $value->lineTwo,
        ];

    }
}
