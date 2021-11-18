<?php
/**
 * Created by Rolf
 *
 * Date: 04.06.2021
 * Site: Pyrobyte.ru
 */

namespace App\Extensions\Grid\Entity;

class Button
{
    private string $text;
    private string $type;
    private string $url;

    const TYPE_SUCCESS = 'success';
    const TYPE_PRIMARY = 'primary';

    public function __construct(string $text, string $type, string $url)
    {
        $this->text = $text;
        $this->type = $type;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
