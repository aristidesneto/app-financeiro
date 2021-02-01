<?php

if (! function_exists('formatMoney2Db')) {
    function formatMoney2Db($value)
    {
        if (explode(' ', $value)[0] === 'R$') {
            return trim(str_replace(',', '.', str_replace('.', '', explode(' ', $value)[1])));
        }

        return trim(str_replace(',', '.', str_replace('.', '', $value)));
    }
}
