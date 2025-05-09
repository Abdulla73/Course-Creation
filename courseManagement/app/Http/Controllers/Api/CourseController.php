<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'feature_video' => 'nullable|string',
            'modules' => 'required|array',
            'modules.*.title' => 'required|string',
            'modules.*.contents' => 'nullable|array',
            'modules.*.contents.*.title' => 'required|string',
            'modules.*.contents.*.video_source_type' => 'nullable|string',
            'modules.*.contents.*.video_url' => 'nullable|string',
            'modules.*.contents.*.video_length' => 'nullable|string',
        ]);


        $course = Course::create([
            'title' => $data['title'],
            'feature_video' => $data['feature_video'] ?? null
        ]);

        foreach ($data['modules'] as $moduleData) {
            $module = $course->modules()->create(['title' => $moduleData['title']]);
            foreach ($moduleData['contents'] ?? [] as $content) {
                $module->contents()->create($content);
            }
        }

        return response()->json(['message' => 'Course saved successfully']);
    }
}
