<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;

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
     * Book's topics page with chapters.
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
     * @param  App\Models\Topic  $topic
     * @return View
     */
    public function show(Topic $topic)
    {
		$prev = Topic::where('id', '<', $topic->id)->orderBy('id', 'desc')->first();
		$next = Topic::where('id', '>', $topic->id)->orderBy('id', 'asc')->first();

        return view('topic.show', compact('topic', 'prev', 'next'));
    }

	public function create(Topic $topic)
	{
		return view('topic.create_and_edit', compact('topic'));
	}

	public function store(TopicRequest $request)
	{
		$topic = Topic::create($request->all());
		return redirect()->route('topic.show', $topic->id)->with('message', 'Created successfully.');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('topic.create_and_edit', compact('topic'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topic.show', $topic->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topic.index')->with('message', 'Deleted successfully.');
	}
}