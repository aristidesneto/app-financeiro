<?php

if (!function_exists('formatMoney2Db')) {
    function formatMoney2Db($value)
    {
        if ('R$' === explode(' ', $value)[0]) {
            return trim(str_replace(',', '.', str_replace('.', '', explode(' ', $value)[1])));
        }

        return trim(str_replace(',', '.', str_replace('.', '', $value)));
    }
}

if (!function_exists('formatMoney')) {
    function formatMoney($value, $prefix = false)
    {
        if ($prefix) {
            return 'R$ ' . number_format($value, 2, ',', '.');
        }

        return number_format($value, 2, ',', '.');
    }
}

if (!function_exists('shortMonths')) {
    function shortMonths(int $value)
    {
        if ($value) {
            $months = [
                1 => 'Jan',
                2 => 'Fev',
                3 => 'Mar',
                4 => 'Abr',
                5 => 'Mai',
                6 => 'Jun',
                7 => 'Jul',
                8 => 'Ago',
                9 => 'Set',
                10 => 'Out',
                11 => 'Nov',
                12 => 'Dez',
            ];

            return $months[$value];
        }
    }
}

if (!function_exists('fullMonths')) {
    function fullMonths(int $value)
    {
        if ($value) {
            $months = [
                1 => 'Janeiro',
                2 => 'Fevereiro',
                3 => 'Março',
                4 => 'Abril',
                5 => 'Maio',
                6 => 'Junho',
                7 => 'Julho',
                8 => 'Agosto',
                9 => 'Setembro',
                10 => 'Outubro',
                11 => 'Novembro',
                12 => 'Dezembro',
            ];

            return $months[$value];
        }
    }
}
