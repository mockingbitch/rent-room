<?php

if (!function_exists('getFullAddressVN')) :
    function getFullAddressVN($model, string $operator = ' - ')
    {
        $ward = $model->address->ward;

        return $ward->full_name . $operator . $ward->district->full_name . $operator . $ward->district->province->full_name;
    }
endif;

if (!function_exists('getFullAddressEN')) :
    function getFullAddressEN($model, string $operator = ' - ')
    {
        $ward = $model->address->ward;

        return $ward->full_name_en . $operator . $ward->district->full_name_en . $operator . $ward->district->province->full_name_en;
    }
endif;

