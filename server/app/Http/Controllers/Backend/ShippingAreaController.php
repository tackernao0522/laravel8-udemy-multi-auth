<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipTown;

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
        $districts = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();

        return view('backend.ship.district.view_district', compact('divisions', 'districts'));
    }

    public function districtStore(Request $request)
    {
        $validatedData = $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ], [
            'division_id.required' => '都道府県名は必須です。',
            'district_name.required' => '区市町村名は必須です。',
        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '区市町村名を作成しました。(District Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function districtEdit($id)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);

        return view('backend.ship.district.edit_district', compact('divisions', 'district'));
    }

    public function districtUpdate(Request $request, $id)
    {
        $district = ShipDistrict::findOrFail($id);
        $validatedData = $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ], [
            'division_id.required' => '都道府県名は必須です。',
            'district_name.required' => '区市町村名は必須です。',
        ]);

        $district->division_id = $request->division_id;
        $district->district_name = $request->district_name;
        $district->updated_at = Carbon::now();
        $district->save();

        $notification = array(
            'message' => '区市町村ID：' . $district->id . 'を更新しました(District Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-district')
            ->with($notification);
    }

    public function districtDelete($id)
    {
        $district = ShipDistrict::findOrFail($id);
        $district->delete();

        $notification = array(
            'message' => '区市町村名：' . $district->district_name . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function townView()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $towns = ShipTown::with('division', 'district')->orderBy('id', 'DESC')->get();

        return view('backend.ship.town.view_town', compact('divisions', 'districts', 'towns'));
    }

    public function townStore(Request $request)
    {
        $validatedData = $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'town_name' => 'required',
        ], [
            'division_id.required' => '都道府県名は必須です。',
            'district_id.required' => '区市町村名は必須です。',
            'town_name.required' => '町名は必須です。',
        ]);

        ShipTown::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'town_name' => $request->town_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => '町名を作成しました。(Town Name Inserted Successfully)',
            'alert-type' => 'success',
        );

        return redirect()->back()
            ->with($notification);
    }

    public function townEdit($id)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $town = ShipTown::findOrFail($id);

        return view('backend.ship.town.edit_town', compact('divisions', 'districts', 'town'));
    }

    public function townUpdate(Request $request, $id)
    {
        $town = ShipTown::findOrFail($id);
        $validatedData = $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'town_name' => 'required',
        ], [
            'division_id.required' => '都道府県名は必須です。',
            'district_id.required' => '区市町村名は必須です。',
            'town_name.required' => '町名は必須です。',
        ]);

        $town->division_id = $request->division_id;
        $town->district_id = $request->district_id;
        $town->town_name = $request->town_name;
        $town->updated_at = Carbon::now();
        $town->save();

        $notification = array(
            'message' => '町名ID：' . $town->id . 'を更新しました(Town Updated Successfully)。',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-town')
            ->with($notification);
    }

    public function townDelete($id)
    {
        $town = ShipTown::findOrFail($id);
        $town->delete();

        $notification = array(
            'message' => '町名：' . $town->town_name . 'を削除しました。',
            'alert-type' => 'error',
        );

        return redirect()->back()
            ->with($notification);
    }
}
