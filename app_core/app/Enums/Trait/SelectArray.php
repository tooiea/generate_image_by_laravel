<?php
namespace App\Enums\Trait;

trait SelectArray
{

    /**
     * @return array
     */
    public static function asSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($enum) => [
                $enum->value => $enum->getExtension(),
            ])
            ->all();
    }
}
