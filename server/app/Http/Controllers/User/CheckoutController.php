<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipTown;

class CheckoutController extends Controller
{
    public function districtGetAjax($division_id)
    {
        $ships = ShipDistrict::where('division_id', $division_id)
            ->orderBy('district_name', 'DESC')
            ->get();

        return json_encode($ships);
    }

    public function townGetAjax($district_id)
    {
        $ships = ShipTown::where('district_id', $district_id)
            ->orderBy('town_name', 'DESC')
            ->get();

        return json_encode($ships);
    }
}
