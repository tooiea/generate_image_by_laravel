<?php

namespace App\Enums;

use App\Enums\Trait\SelectArray;

enum EnumImage: int {

    use SelectArray;

    case JPEG = 1;
    case JPG = 2;
    case PNG = 3;
    case GIF = 4;
    case SVG = 5;
    case TIF = 6;
    case BMP = 7;
    case ICO = 8;
    case PSD = 9;
    case WEBP = 10;

    /**
     * 拡張子取得
     *
     * @return string
     */
    public function getExtension(): string
    {
        return match($this) {
            self::JPEG => 'jpeg',
            self::JPG => 'jpg',
            self::PNG => 'png',
            self::GIF => 'gif',
            self::SVG => 'svg',
            self::TIF => 'tif',
            self::BMP => 'bmp',
            self::ICO => 'ico',
            self::PSD => 'psd',
            self::WEBP => 'webp',
        };
    }
}