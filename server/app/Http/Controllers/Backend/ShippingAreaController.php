<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;

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
            'division_name.required' => '都道府県名は必須です。',
            'division_name.unique' => 'この都道府県名は既に登録されています。',
        ]);

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '都道府県名を作成しました。(Division Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function divisionEdit($id)
    {
        $division = ShipDivision::findOrFail($id);

        return view('backend.ship.division.edit_division', compact('division'));
    }

    public function divisionUpdate(Request $request, $id)
    {
        $division = ShipDivision::findOrFail($id);
        $validatedData = $request->validate([
            'division_name' => 'required',
        ], [
            'division_name.required' => '都道府県名は必須です。',
        ]);

        $division->division_name = $request->division_name;
        $division->updated_at = Carbon::now();
        $division->save();

        $notification = array(
            'message' => '都道府県名ID：' . $division->id . 'を更新しました(Division Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-division')
            ->with($notification);
    }

    public function divisionDelete($id)
    {
        $division = ShipDivision::findOrFail($id);
        $division->delete();

        $notification = array(
            'message' => '都道府県名：' . $division->division_name . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function districtView()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('id', 'DESC')->get();

        return view('backend.ship.district.view_district', compact('divisions', 'districts'));
    }
}
