<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Handlers\ImageUploadHandler;
use Auth;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * A course's preface page.
     *
     * @param  App\Models\Course  $course
     * @return View
     */
    public function show(Course $course)
    {
        $chapters = json_decode($course->chapters);
        return view('course.show', compact('course', 'chapters'));
    }

    /**
     * Creating a course.
     *
     * @param  App\Models\Course  $course
     * @return View
     */
    public function create(Course $course)
	{
		return view('course.create_and_edit', compact('course'));
    }
    
    /**
     * Store a new course to db.
     *
     * @param  App\Http\Requests\TopicRequest  $request
	 * @param  App\Models\Topic  $topic
     * @return void
     */
	public function store(CourseRequest $request, Course $course)
	{
		$course->fill($request->all());
		$course->user_id = Auth::id();
		$course->save();

		return redirect()->route('course.show', $course->slug)->with('message', '创建成功');
	}

    /**
     * Editing a course.
     *
     * @param  App\Models\Course  $course
     * @return View
     */
    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        
        return view('course.create_and_edit', compact('course'));
    }

    /**
     * Updating a course.
     *
     * @param  App\Http\Requests\CourseRequest  $request
     * @param  App\Handlers\ImageUploadHandler  $uploader
	 * @param  App\Models\Course  $course
     * @return void
     */
	public function update(CourseRequest $request, ImageUploadHandler $uploader, Course $course)
	{
        $this->authorize('update', $course);
        
        $data = $request->all();

        $cover_max_width = 800;

        if ($request->cover) {
            $result = $uploader->save($request->cover, 'courses', Auth::id(), $cover_max_width);
            if ($result) {
                $data['cover'] = $result['path'];
            }
        }

		$course->update($data);

		return redirect()->route('course.show', $course->slug)->with('message', '更新成功');
	}

}