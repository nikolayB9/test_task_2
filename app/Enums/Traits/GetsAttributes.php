<?php

namespace App\Enums\Traits;

use App\Enums\Attributes\Description;
use ReflectionClassConstant;

trait GetsAttributes
{
    public static function getDescription(self $enum): string
    {
        $ref = new ReflectionClassConstant(self::class, $enum->name);
        $classAttributes = $ref->getAttributes(Description::class);

        if (count($classAttributes) === 0) {
            return $enum->name;
        }

        return $classAttributes[0]->newInstance()->description;
    }

    /**
     * @return array<array{name: string, value: int}>
     */
    public static function asSelectArray(): array
    {
        /** @var array<array{name: string, value: int}> $values */
        $values = collect(self::cases())
            ->map(function ($enum) {
                return [
                    'name' => self::getDescription($enum),
                    'value' => $enum->value,
                ];
            })->toArray();

        return $values;
    }
}
