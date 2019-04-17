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
        $page = SitePage::findOrFail($pageId);

        $page->update($request->only(['title', 'content']));
        $page->save();

        return redirect()->route('admin.site-page.index');
    }
}
