<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Enums;

enum Node: string
{
    case PeerOne = 'http://peer1.arionum.com';
    case PeerTwo = 'http://peer2.arionum.com';
    case PeerThree = 'http://peer3.arionum.com';
    case PeerFour = 'http://peer4.arionum.com';
    case PeerFive = 'http://peer5.arionum.com';
    case PeerSix = 'http://peer6.arionum.com';
    case PeerSeven = 'http://peer7.arionum.com';
    case PeerEight = 'http://peer8.arionum.com';
    case PeerNine = 'http://peer9.arionum.com';
    case PeerTen = 'http://peer10.arionum.com';

    public static function providedOrRandom(string|null $uri = null): string
    {
        if (str_starts_with($uri, 'http')) {
            return $uri;
        }

        return self::cases()[array_rand(self::cases())]->value;
    }
}
