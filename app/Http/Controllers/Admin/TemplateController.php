<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Template;
use Illuminate\Http\Request;
use App\Http\Requests\TemplateRequest;
use App\Http\Controllers\Controller;
use App\Contracts\TemplateRepositoryInterface;

class TemplateController extends Controller
{
    protected $templateRepositoryInterface;

    public function __construct(TemplateRepositoryInterface $templateRepositoryInterface)
    {
        $this->templateRepositoryInterface = $templateRepositoryInterface;
        $this->authorizeResource(Template::class, 'template');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.template.index', $this->templateRepositoryInterface->indexTemplate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.template.create', $this->templateRepositoryInterface->createTemplate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TemplateRequestt  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        $this->templateRepositoryInterface->storeTemplate($request);
        return redirect(adminRedirectRoute('template'))->withSuccess('Template Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        return view('admin.template.show', $this->templateRepositoryInterface->showTemplate($template));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return view('admin.template.edit', $this->templateRepositoryInterface->editTemplate($template));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TemplateRequest  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateRequest $request, Template $template)
    {
        $this->templateRepositoryInterface->updateTemplate($request, $template);
        return redirect(adminRedirectRoute('template'))->withInfo('Template Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $this->templateRepositoryInterface->destroyTemplate($template);
        return redirect(adminRedirectRoute('template'))->withFail('Template Deleted Successfully.');
    }

    /**
     *
     * Get Channel Template
     *
     */
    public function get_channel_templates(Request $request)
    {
        return $this->templateRepositoryInterface->getChannelTemplates($request);
    }

    /**
     *
     * Get Template
     *
     */
    public function get_template(Request $request)
    {
        if (isset($request->template_id)) {
            $template = Template::find($request->template_id);
            if (isset($template)) {
                return response()->json(['template' => $template], 200);
            }
        }
    }
}
