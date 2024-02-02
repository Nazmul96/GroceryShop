<?php

namespace App\Helper;


class ControllerHelper
{
    
    public static function getDateDetails($request){


        if ($request->has('date_range') && !empty($request->date_range)) {
            $data['date_range']  = $request->date_range;
            $date_ranges         = explode(' - ', $data['date_range']);

            $data['from_date']   = date_format(date_create_from_format('d/m/Y', $date_ranges[0]), 'Y-m-d');
            $data['to_date']     = date_format(date_create_from_format('d/m/Y', $date_ranges[1]), 'Y-m-d');
        }else {
            $data['date_range']     = date('d/m/Y') . ' - ' . date('d/m/Y');
            $date_ranges            = explode(' - ', $data['date_range']);
            $data['from_date']      = date_format(date_create_from_format('d/m/Y', $date_ranges[0]), 'Y-m-d');
            $data['to_date']        = date_format(date_create_from_format('d/m/Y', $date_ranges[1]), 'Y-m-d');
        }

        return $data;
    }
}