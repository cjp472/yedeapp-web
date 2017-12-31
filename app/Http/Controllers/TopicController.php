<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Auth;

class TopicController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	/**
     * Course's topics page with chapters.
     *
     * @return View
     */
	public function index()
	{
		$topics = Topic::all();
		return view('topic.index', compact('topics'));
	}

	/**
     * A topic detail page.
     *
	 * @param  Illuminate\Http\Request $request
	 * @param  App\Models\Course  $courseslug
     * @param  App\Models\Topic  $topic
     * @return View
     */
    public function show(Request $request, Course $course, Topic $topic)
    {
		// Redirect to slug link with http code 301.
		if ( !empty($topic->slug) && $topic->slug != $request->slug ) {
			return redirect($topic->link($course->slug), 301);
		}

		// Get previous topic and next topic
		$prev = Topic::where('id', '<', $topic->id)->where('course_id', $topic->course_id)->where('chapter_id', $topic->chapter_id)->orderBy('id', 'desc')->first();
		$next = Topic::where('id', '>', $topic->id)->where('course_id', $topic->course_id)->where('chapter_id', $topic->chapter_id)->orderBy('id', 'asc')->first();

		// Get comments and load user table to prevent N+1 problem.
		$comments = $topic->comments()->where('parent_id', null)->orderBy('star', 'desc')->orderBy('updated_at', 'desc')->get()->load('user');
		$replies = $topic->comments()->where('parent_id', '>', 0)->get();

        return view('topic.show', compact('topic', 'comments', 'replies', 'prev', 'next'));
    }

	/**
     * Topic Creating UI.
     *
     * @param  App\Models\Topic  $topic
     * @return View
     */
	public function create(Topic $topic)
	{
		$courses = Course::all();

		return view('topic.create_and_edit', compact('courses', 'topic'));
	}

	/**
     * Store a new topic to db.
     *
     * @param  App\Http\Requests\TopicRequest  $request
	 * @param  App\Models\Topic  $topic
     * @return void
     */
	public function store(TopicRequest $request, Topic $topic)
	{
		$topic->fill($request->all());
		$topic->user_id = Auth::id();
		$topic->save();

		return redirect($topic->link())->with('message', '创建成功');
	}

	/**
     * Topic Editing UI.
     *
     * @param  App\Models\Topic  $topic
     * @return View
     */
	public function edit(Topic $topic)
	{
		$this->authorize('update', $topic);
		
		$courses = Course::all();

		return view('topic.create_and_edit', compact('courses', 'topic'));
	}

	/**
     * Updating a topic.
     *
     * @param  App\Http\Requests\TopicRequest  $request
	 * @param  App\Models\Topic  $topic
     * @return void
     */
	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect($topic->link())->with('message', '更新成功');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topic.index')->with('message', 'Deleted successfully.');
	}
}