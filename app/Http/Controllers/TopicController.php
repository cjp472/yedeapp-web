<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Handlers\ImageUploadHandler;
use Carbon\Carbon;
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
        $this->middleware('auth', ['except' => 'show']);
    }

	/**
     * A topic detail page.
     *
	 * @param  Illuminate\Http\Request $request
	 * @param  App\Course  $courseslug
     * @param  App\Topic  $topic
     * @return View
     */
    public function show(Request $request, Course $course, Topic $topic)
    {
        // If the topic is free that it's no need to add any authorizations.
        if (!$topic->free) {
            $this->authorize('show', $topic);
        }

		// Redirect to slug link with http code 301.
		if ( !empty($topic->slug) && $topic->slug != $request->slug ) {
			return redirect($topic->link($course->slug), 301);
		}

		// Get previous topic and next topic
		$prev = Topic::where('id', '<', $topic->id)->where('course_id', $topic->course_id)->where('chapter_id', $topic->chapter_id)->orderBy('id', 'desc')->first();
		$next = Topic::where('id', '>', $topic->id)->where('course_id', $topic->course_id)->where('chapter_id', $topic->chapter_id)->orderBy('id', 'asc')->first();

		// Get comments and load user table to prevent N+1 problem.
		$comments = $topic->comments()->where('parent_id', null)->orderBy('star', 'desc')->orderBy('created_at', 'desc')->get()->load('user');
        $replies = $topic->comments()->where('parent_id', '>', 0)->orderBy('created_at', 'asc')->get();
        
        // Get this course's chapters
        $chapters = json_decode($course->chapters);

        // Only role Superadmin and Admin can delete or reply the comments
        if (Auth::check() && (Auth::user()->hasRole('Superadmin') || Auth::user()->hasRole('Admin'))) {
            $canDeleteComment = true;
            $canReplyComment = true;
        } else {
            $canDeleteComment = false;
            $canReplyComment = false;
        }

        return view('topic.show', compact('course', 'topic', 'chapters', 'comments', 'replies', 'prev', 'next', 'canDeleteComment', 'canReplyComment'));
    }

	/**
     * Topic Creating UI.
     *
     * @param  App\Topic  $topic
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
	 * @param  App\Topic  $topic
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
     * @param  App\Topic  $topic
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
	 * @param  App\Topic  $topic
     * @return void
     */
	public function update(TopicRequest $request, Topic $topic)
	{
        $this->authorize('update', $topic);
        
		$topic->update($request->all());

		return redirect($topic->link())->with('message', '更新成功');
	}

	/**
     * Upload images to server in simeditor.
     *
     * @param  App\Http\Requests\Request  $request
	 * @param  App\Handlers\ImageUploadHandler  $uploader
     * @return void
     */
	public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // Init return data
        $data = [
            'success' => false,
            'msg' => '上传失败',
            'file_path' => ''
		];
		
        // Get upload file request and do upload
        if ($file = $request->upload_file) {
            // Save
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
            // If success
            if ($result) {
				$data['success'] = true;
                $data['msg'] = "上传成功";
                $data['file_path'] = $result['path'];
            }
        }
        return $data;
    }

    /**
     * Delete a topic.
     *
     * @param  App\Topic  $topic
     * @return void
     */
	public function destroy(Topic $topic)
	{
        $this->authorize('destroy', $topic);
        
		$topic->delete();

		return redirect()->route('course.show', $topic->course)->with('message', '删除成功');
    }

    /**
     * Vote or abstain a topic by a user.
     *
     * @param  App\Topic  $topic
     * @return void
     */
    public function vote(Topic $topic)
    {
        $voteId = Auth::user()->vote->id;
        $voteTime = Carbon::now()->toDateTimeString();

        $topic->votes()->toggle([
            $voteId => [
                'created_at' => $voteTime,
                'updated_at' => $voteTime,
            ],
        ]);
    }
    
}