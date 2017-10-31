<?php
if (! function_exists('assemble_url')) {

    /**
     * Assemble url and add custom params after '?'
     *
     * @param null $url
     * @param array $params
     * @param bool $reset
     * @return string
     */
    function assemble_url($url = null, $query = [], $reset = false)
    {
        if (!$url) {
            $url = request()->fullUrl();
        }

        $parsed = parse_url($url);
        $params = [];

        if (!$reset && !empty($parsed['query'])) {
            parse_str($parsed['query'], $params);
        }

        foreach ($query as $name => $value) {
            $params[$name] = $value;
        }

        return rtrim($parsed['path'] . '?' . http_build_query($params), '?');
    }
}