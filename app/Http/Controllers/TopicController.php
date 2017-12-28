<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Book;
use App\Models\Chapter;
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
	 * @param  Illuminate\Http\Request $request
	 * @param  App\Models\Book  $bookslug
     * @param  App\Models\Topic  $topic
     * @return View
     */
    public function show(Request $request, Book $book, Topic $topic)
    {
		// Redirect to slug link with http code 301.
		if ( !empty($topic->slug) && $topic->slug != $request->slug ) {
			return redirect($topic->link($book->slug), 301);
		}

		// Get previous topic and next topic
		$prev = Topic::where('id', '<', $topic->id)->where('book_id', $topic->book_id)->where('chapter_id', $topic->chapter_id)->orderBy('id', 'desc')->first();
		$next = Topic::where('id', '>', $topic->id)->where('book_id', $topic->book_id)->where('chapter_id', $topic->chapter_id)->orderBy('id', 'asc')->first();

		// Get comments and load user table to prevent N+1 problem.
		$comments = $topic->comments()->where('parent_id', null)->orderBy('star', 'desc')->orderBy('updated_at', 'desc')->get()->load('user');
		// Get author replies
		$replies = $topic->comments()->where('parent_id', '>', 0)->get();

        return view('topic.show', compact('topic', 'comments', 'replies', 'prev', 'next'));
    }

	/**
     * Create a new topic ui.
     *
     * @param  App\Models\Topic  $topic
     * @return View
     */
	public function create(Topic $topic)
	{
		$books = Book::all();
		$chapters = Chapter::all();

		return view('topic.create_and_edit', compact('books', 'chapters', 'topic'));
	}

	/**
     * Store a new topic.
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

		return redirect($topic->link())->with('message', '新建成功');
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

		return redirect($topic->link())->with('message', 'Updated successfully.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topic.index')->with('message', 'Deleted successfully.');
	}
}