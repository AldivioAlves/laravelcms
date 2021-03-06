<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $pages = Page::paginate(10);;

        return view('admin.pages.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $data = $request->only(['title', 'body']);

        $data['slug'] = Str::slug($data['title'], '-');

        $validator = Validator::make($data, [
            'title' => 'required|string|max:100',
            'body' => 'string',
            'slug' => 'required|string|max:100|unique:pages'
        ]);
        if ($validator->fails()) {
            return redirect()->route('pages.create')
                ->withErrors($validator)
                ->withInput();
        }
        $page = new Page();
        $page->title = $data['title'];
        $page->body = $data['body'];
        $page->slug = $data['slug'];
        $page->save();
        return redirect()->route('pages.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $page = Page::find($id);
        if ($page) {
            return view('admin.pages.edit', [
                'page' => $page
            ]);
        }
        return redirect()->route('pages.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {

        $page = Page::find($id);
        if (!$page) {
            return redirect()->route('pages.index');
        }

        $data = $request->only([
            'title',
            'body'
        ]);
        $toValidate = [
            'title' => ['required', 'string', 'max:100'],
            'body' => ['string']
        ];
        if ($data['title'] !== $page->title) { //alterou o titulo
            $data['slug'] = Str::slug($data['title'], '-');
            $toValidate['slug'] = ['required', 'string', 'max:100', 'unique:pages'];
        }

        $validator = Validator::make($data, $toValidate);

        if ($validator->fails()) {
            return redirect()->route('pages.edit', [
                'page'=>$id
            ])
                ->withErrors($validator)
                ->withInput();
        }

        $page['title'] = $data['title'];
        $page['body']= $data['body'];

        if(!empty($data['slug'])){
            $page['slug']= $data['slug'];
        }

        $page->save();

        return redirect()->route('pages.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        Page::find($id)->delete();
        return redirect()->route('pages.index');
    }
}
