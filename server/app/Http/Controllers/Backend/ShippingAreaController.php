<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ShipDivision;

class ShippingAreaController extends Controller
{
    public function divisionView()
    {
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();

        return view('backend.ship.division.view_division', compact('divisions'));
    }

    public function divisionStore(Request $request)
    {
        $validatedData = $request->validate([
            'division_name' => 'required|unique:ship_divisions',
        ], [
            'division_name.required' => '配送区分名は必須です。',
            'division_name.unique' => 'このエリアは既に登録されています。',
        ]);

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '配送エリアを作成しました。(Division Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }
}
