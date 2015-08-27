<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TemplateController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $templates = Template::all();

        return view('pages.template_index', ['templates' => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.template_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $template = new Template([
            'name'    => $request->name,
            'title'   => $request->title,
            'content' => html_entity_decode($request->input('content')),
        ]);

        $template->save();

        return redirect()->route('template.index');
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $templateId
     * @return Response
     * @internal param int $id
     */
    public function edit($templateId)
    {
        $template = Template::findOrFail($templateId);

        return view('pages.template_create', ['template' => $template]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param $templateId
     * @return Response
     * @internal param int $id
     */
    public function update(Request $request, $templateId)
    {
        Template::findOrFail($templateId)->update([
            'name'    => $request->name,
            'title'   => $request->title,
            'content' => html_entity_decode($request->input('content')),
        ]);

        return redirect()->route('template.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $templateId
     * @return Response
     */
    public function destroy(Request $request, $templateId)
    {
        $templates = Template::whereIn('id', explode('+', $templateId))->get();

        if ($request->has('confirmed'))
        {
            foreach ($templates as $template)
            {
                $template->delete();
            }

            return redirect()->back();
        }

        $message = "Are you SURE you want to delete these templates? This cannot be undone." . PHP_EOL;
        foreach ($templates as $template)
        {
            $message .= "$template->id:" . $template->name . PHP_EOL;
        }

        return redirect()->back()->with([
            'askForConfirmation' => [
                'message'    => $message,
                'method'     => 'delete',
                'submitName' => 'Yes, Delete',
                'url'        => $request->path()
            ]
        ]);

    }
}
