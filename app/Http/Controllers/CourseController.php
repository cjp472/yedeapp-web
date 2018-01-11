<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use App\Handlers\ImageUploadHandler;
use App\Course;
use Auth;

class CourseController extends Controller
{
    /**
     * Upload image's restraint.
     *
     * @var integer
     */
    protected $cover_max_width = 800;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'view']]);
    }

    /**
     * The course's intro page.
     *
     * @param  App\Course  $course
     * @return View
     */
    public function show(Course $course)
    {
        return view('course.show', compact('course'));
    }

    /**
     * The course's chapters page.
     *
     * @param  App\Course  $course
     * @return View
     */
    public function chapters(Course $course)
    {
        $chapters = json_decode($course->chapters);
        return view('course.chapters', compact('course', 'chapters'));
    }

    /**
     * Creating a course.
     *
     * @param  App\Course  $course
     * @return View
     */
    public function create(Course $course)
	{
		return view('course.create_and_edit', compact('course'));
    }
    
    /**
     * Store a new course to db.
     *
     * @param  App\Http\Requests\CourseRequest  $request
     * @param  App\Handlers\ImageUploadHandler  $uploader
	 * @param  App\Course  $course
     * @return void
     */
	public function store(CourseRequest $request, ImageUploadHandler $uploader, Course $course)
	{
        $course->fill($request->all());

        $cover_max_width = $this->cover_max_width;

        if ($request->cover) {
            $result = $uploader->save($request->cover, 'courses', Auth::id(), $cover_max_width);
            if ($result) {
                $course->cover = $result['path'];
            }
        }

        $course->user_id = Auth::id();

        $course->save();
        
		return redirect()->route('course.show', $course->slug)->with('message', '创建成功');
	}

    /**
     * Editing a course.
     *
     * @param  App\Course  $course
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
	 * @param  App\Course  $course
     * @return void
     */
	public function update(CourseRequest $request, ImageUploadHandler $uploader, Course $course)
	{
        $this->authorize('update', $course);
        
        $data = $request->all();

        $cover_max_width = $this->cover_max_width;

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
