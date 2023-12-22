<?php

// app/Http/Middleware/ValidateApiRequests.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidateApiRequests
{
    public function handle(Request $request, Closure $next)
    {
        // return $request;
        // dd($request->all());
        if ($request->isMethod('post') || $request->isMethod('put')) {
            # code...
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'date_of_birth' => 'required|date',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }
        }
            
        return $next($request);
    }
}

