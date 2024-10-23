<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralInfo;

class GeneralInfoController extends Controller
{
    public function index()
    {
        $generalInfo = GeneralInfo::all();
        return view('admin.generalinfo.index', compact('generalInfo'));
    }

    public function create()
    {
        return view('admin.generalinfo.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'general' => 'required|string',
            'picture_path' => 'required|string',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'instagram' => 'required|url',
            'linkedin' => 'required|url',
        ]);

        $generalInfoData = $request->all();

        if (isset($generalInfoData['picture_path']) && !empty($generalInfoData['picture_path'])) {
            if (filter_var($generalInfoData['picture_path'], FILTER_VALIDATE_URL)) {
                $generalInfoData['picture_path'] = $generalInfoData['picture_path'];
            }
        }

        GeneralInfo::create($generalInfoData);

        session()->flash('success', 'General info created successfully!');

        return redirect()->route('admin.generalinfo.index');
    }

    public function edit($id)
    {
        $generalInfo = GeneralInfo::findOrFail($id);
        return view('admin.generalinfo.edit', compact('generalInfo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'general' => 'required|string',
            'picture_path' => 'required|string',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'instagram' => 'required|url',
            'linkedin' => 'required|url',
        ]);

        $generalInfo = GeneralInfo::findOrFail($id);
        $generalInfo->update($request->all());

        session()->flash('success', 'General info updated successfully!');
        return redirect()->route('admin.generalinfo.index');
    }

    public function destroy($id)
    {
        $generalInfo = GeneralInfo::findOrFail($id);
        $generalInfo->delete();

        return response()->json(null, 204);
    }
}
