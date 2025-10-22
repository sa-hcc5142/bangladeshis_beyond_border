<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\University;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        // Get all universities with pagination
        $universities = University::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.universities.index', compact('universities'));
    }

    public function create()
    {
        return view('admin.universities.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'slug' => 'required|string|max:255|unique:universities',
            'website' => 'nullable|url',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        University::create([
            'name' => $request->name,
            'country' => $request->country,
            'city' => $request->city,
            'region' => $request->region,
            'slug' => $request->slug,
            'website' => $request->website,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return redirect()->route('admin.universities.index')
            ->with('success', 'University created successfully');
    }

    public function edit(University $university)
    {
        return view('admin.universities.edit', compact('university'));
    }

    public function update(Request $request, University $university)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'slug' => 'required|string|max:255|unique:universities,slug,' . $university->id,
            'website' => 'nullable|url',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $university->update([
            'name' => $request->name,
            'country' => $request->country,
            'city' => $request->city,
            'region' => $request->region,
            'slug' => $request->slug,
            'website' => $request->website,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.universities.index')
            ->with('success', 'University updated successfully');
    }

    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->route('admin.universities.index')
            ->with('success', 'University deleted successfully');
    }
}