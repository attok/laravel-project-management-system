<?php

namespace App\Models\Interface;

use Illuminate\Http\Request;

interface Model
{
    public function validate(Request $request, $errorUrlRedirect);
    public function loadData($validated);
}
