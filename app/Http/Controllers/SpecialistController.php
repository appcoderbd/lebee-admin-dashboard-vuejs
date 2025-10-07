<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Pest\Expectation;

class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('specialist/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $specialist = Specialist::all();
        return Inertia::render('specialist/Create',[
            'specialist' => $specialist
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'specialist_name' => 'string|required|min:5|max:50',
            'description' => 'nullable|max:100',
            'icon' => 'nullable|mimes:png,jpg,gif,jpeg|max:1024'
        ]);

        try {
            if ($request->hasFile('icon')) {
                $file = $request->file('icon');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                // ✅ ফাইল সেভ হবে storage/app/public/icons এর ভিতরে
                $file->storeAs('icons', $filename, 'public');

                // ✅ ডাটাবেজে সঠিক path রাখো
                $validate['icon'] = 'storage/icons/' . $filename;
            }

            Specialist::create($validate);

            return back()->with('success', 'Specialist created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
