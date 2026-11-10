<?php

namespace App\Enums;

enum UserRole: string
{
    case Officer = 'officer';
    case User = 'user';

    public function label(): string
    {
        return match ($this) {
            self::Officer => 'Petugas (Officer)',
            self::User => 'Pengendara (User)',
        };
    }

    public static function resolve(self|string|null $role): ?self
    {
        if ($role instanceof self) {
            return $role;
        }

        if ($role === 'admin') {
            return self::Officer;
        }

        return self::tryFrom((string) $role);
    }
}
