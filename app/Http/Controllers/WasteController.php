<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Waste;
use App\Models\WasteType;
use Illuminate\Http\Request;

class WasteController extends Controller
{
public function index()
{
    $wastes = Waste::with('wasteType')->get(); 
    $wasteTypes = WasteType::all();
    return view('waste.index', compact('wastes', 'wasteTypes'));
}

    public function create()
    {
        $wasteTypes = WasteType::all();
        return view('waste.create', compact('wasteTypes'));
    }

  public function store(Request $request)
{
    // Step 1: Validate input
    $validated = $request->validate([
        'waste_type_id' => 'required|exists:waste_types,id',
        'weight' => 'required|numeric|min:0.01',
        'price' => 'required|numeric|min:0.00',
        'food_quality' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192', // Max 8MB
    ]);

    // Step 2: Add user_id manually
    $validated['user_id'] = auth()->id();

    // Step 3: Handle image upload (binary storage)
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $validated['image'] = file_get_contents($file->getRealPath());
        $validated['mime_type'] = $file->getMimeType(); // Only if your DB has a mime_type column
    }

    // Step 4: Create the record
    Waste::create($validated);

    return redirect()->route('waste.index')->with('success', 'Waste successfully posted!');
}


    public function getImage($id)
    {
        $waste = Waste::findOrFail($id);

        if (!$waste->image) {
            abort(404);
        }

        // Use stored MIME type or fallback to JPEG
        $mimeType = $waste->mime_type ?? 'image/jpeg';

        return response($waste->image)->header('Content-Type', $mimeType);
    }

    public function show(Waste $waste)
    {
        return view('waste.show', compact('waste'));
    }
}