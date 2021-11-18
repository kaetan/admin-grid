<?php

namespace App\Helpers\Admin;

/**
 * Хелпер для ассетов в админке
 *
 * Class Assets
 */
class Assets
{
    /**
     * Ссылка на путь с ассетами
     *
     * @return string
     */
    public static function getAssetsPath(): string
    {
        return env('APP_URL');
    }

    /**
     * Ссылка на ассеты CSS
     *
     * @return string
     */
    public static function getAssetCssUrl(): string
    {
        return self::getAssetsPath() . '/admin-static-files/css/app.css?v=' . env('ASSETS_VERSION', '');
    }

    /**
     * Ссылка на публичные ассеты CSS
     *
     * @return string
     */
    public static function getAssetCssPublicUrl(): string
    {
        return self::getAssetsPath() . '/css/style.css?v=' . env('ASSETS_VERSION', '');
    }

    /**
     * Ссылка на ассеты JS
     *
     * @return string
     */
    public static function getAssetJsUrl(): string
    {
        return self::getAssetsPath() . '/admin-static-files/js/app.js?v=' . env('ASSETS_VERSION', '');
    }
}
