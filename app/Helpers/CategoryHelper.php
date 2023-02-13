<?php

if (!function_exists('getCategoryId')) :
    function getCategoryId($model)
    {
        $category = $model->category->ward;

        return $ward->full_name_en . $operator . $ward->district->full_name_en . $operator . $ward->district->province->full_name_en;
    }
endif;
