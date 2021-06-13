<?php

namespace App\Contracts;

use App\Models\Admin\Source;
use App\Http\Requests\SourceRequest;

interface SourceRepositoryInterface
{
    public function indexSource();

    public function createSource();

    public function storeSource(SourceRequest $request);

    public function showSource(Source $Source);

    public function editSource(Source $Source);

    public function updateSource(SourceRequest $request, Source $Source);

    public function destroySource(Source $Source);
}
