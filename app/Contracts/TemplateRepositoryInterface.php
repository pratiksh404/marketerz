<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use App\Models\Admin\Template;
use App\Http\Requests\TemplateRequest;

interface TemplateRepositoryInterface
{
    public function indexTemplate();

    public function createTemplate();

    public function storeTemplate(TemplateRequest $request);

    public function showTemplate(Template $Template);

    public function editTemplate(Template $Template);

    public function updateTemplate(TemplateRequest $request, Template $Template);

    public function destroyTemplate(Template $Template);

    public function getChannelTemplates(Request $request);
}
