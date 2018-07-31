<?php

namespace App\Http\Controllers\Admin;

use App\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $specials = Special::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.special.index', compact('specials'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.special.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $special = new Special();
        $special->title = $request->title;
        $special->cover = $request->cover;
        $special->description = $request->description;
        $special->save();
        return redirect(route('admin.special.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $special = Special::findOrFail($id);
        return view('admin.special.edit', compact('special'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $special = Special::find($id);
        $special->title = $request->title;
        $special->cover = $request->cover;
        $special->description = $request->description;
        $special->save();
        return redirect(route('admin.special.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        Special::destroy($id);
        return redirect(route('admin.special.index'));
    }
}
