<?php


namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TranslationController extends Controller
{
    // Store a new translation
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'locale' => 'required|string|max:10',
            'key' => 'required|string|unique:translations,key,NULL,id,locale,' . $request->locale,
            'content' => 'required|string',
            'context' => 'nullable|string',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()], 422);
        }

        $translation = Translation::create($request->all());

        return response()->json($translation, 201);
    }

    // Update a translation
    public function update(Request $request, $id)
    {
        $updated = Translation::where('id', $id)->update($request->only(['content', 'context']));
        if (!$updated) {
            return response()->json(['error' => 'Translation not found'], 404);
        }
        return response()->json(['message' => 'Translation updated successfully']);
    }

    // View a translation
    public function show($id)
    {
        $translation = Translation::findOrFail($id);
        if (!$translation) {
            return response()->json(['error' => 'Translation not found'], 404);
        }
        return response()->json($translation);
    }

    // search translations 
    public function search(Request $request)
    {
        $query = Translation::select(['key', 'content']);

        if ($request->has('locale')) {
            $query->where('locale', $request->locale);
        }
        if ($request->has('key')) {
            $query->where('key', 'like', "%{$request->key}%");
        }
        if ($request->has('content')) {
            $query->where('content', 'like', "%{$request->content}%");
        }
        if ($request->has('context')) {
            $query->where('context', $request->context);
        }

        $translations = $query->orderBy('id')->cursorPaginate($request->get('per_page', 50));
        return response()->json($translations);
    }

    // export translations 
    public function export()
    {
        $translations = Translation::select(['id', 'key', 'content'])
        ->orderBy('id') // Cursor pagination requires ordering
        ->cursorPaginate(50);
        return response()->json($translations);
    }
}
