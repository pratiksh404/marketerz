<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Admin\Template;
use App\Services\TemplateTags;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\TemplateRequest;
use App\Contracts\TemplateRepositoryInterface;

class TemplateRepository implements TemplateRepositoryInterface
{
    // Template Index
    public function indexTemplate()
    {
        $templates = config('coderz.caching', true)
            ? (Cache::has('templates') ? Cache::get('templates') : Cache::rememberForever('templates', function () {
                return Template::latest()->get();
            }))
            : Template::latest()->get();
        return compact('templates');
    }

    // Template Create
    public function createTemplate()
    {
        $template_tags = TemplateTags::getTags();
        return compact('template_tags');
    }

    // Template Store
    public function storeTemplate(TemplateRequest $request)
    {
        Template::create($request->validated());
    }

    // Template Show
    public function showTemplate(Template $template)
    {
        return compact('template');
    }

    // Template Edit
    public function editTemplate(Template $template)
    {
        $template_tags = TemplateTags::getTags();
        return compact('template', 'template_tags');
    }

    // Template Update
    public function updateTemplate(TemplateRequest $request, Template $template)
    {
        $template->update($request->validated());
    }

    // Template Destroy
    public function destroyTemplate(Template $template)
    {
        $template->delete();
    }

    // Get Channel Template
    public function getChannelTemplates(Request $request)
    {
        return response()->json([
            'templates' => $request->channel_id == 1 ? Template::email()->get() : Template::sms()->get()
        ], 200);
    }
}
