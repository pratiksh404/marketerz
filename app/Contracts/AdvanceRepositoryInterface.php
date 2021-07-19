<?php

namespace App\Contracts;

use App\Models\Admin\Advance;
use App\Http\Requests\AdvanceRequest;

interface AdvanceRepositoryInterface
{
    public function indexAdvance();

    public function createAdvance();

    public function storeAdvance(AdvanceRequest $request);

    public function showAdvance(Advance $Advance);

    public function editAdvance(Advance $Advance);

    public function updateAdvance(AdvanceRequest $request, Advance $Advance);

    public function destroyAdvance(Advance $Advance);
}
