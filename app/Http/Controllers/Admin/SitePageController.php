<?php

namespace App\Http\Controllers\Admin;

use App\SitePage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SitePageController extends Controller
{
    /**
     * SitePage list
     */
    public function index()
    {
        $pages = SitePage::paginate();

        return view('admin.site-page.index', compact('pages'));
    }

    /**
     * SitePage Edit
     */
    public function create()
    {
        $page = new SitePage();

        return view('admin.site-page.create', compact('page'));
    }

    /**
     * SitePage Store
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         =>  'required|string',
            'unique_name'   =>  'required|string',
            'content'       =>  'required|string',
        ]);

        $data = $request->only(['title', 'content', 'unique_name']);
        SitePage::create($data);

        return redirect()->route('admin.site-page.index');
    }

    /**
     * SitePage Edit
     */
    public function edit($pageId)
    {
        $page = SitePage::findOrFail($pageId);

        return view('admin.site-page.edit', compact('page'));
    }

    /**
     * SitePage Update
     */
    public function update(Request $request, $pageId)
    {
        $this->validate($request, [
            'title'         =>  'required|string',
            'unique_name'   =>  'required|string',
            'content'       =>  'required|string',
        ]);

        $page = SitePage::findOrFail($pageId);

        $data = $request->only(['title', 'content', 'unique_name']);
        $page->update($data);
        $page->save();

        return redirect()->route('admin.site-page.index');
    }
}
