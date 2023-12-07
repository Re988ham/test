<?php

namespace App\Http\Middleware;

use App\Models\File;
use Closure;
use Illuminate\Http\Request;

class CheckFileAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the file from the route parameter
        $file_id = $request->route('file_id');

        $file = File::find($file_id);

        // Check if the file exists
        if (!$file) {
            return abort(404, 'File not found');
        }

        // Check if the file status is free
        if ($file->status != 'free') {
            return abort(403, 'File is already in use');
        }

        // Pass the request to the next middleware
        return $next($request);
    }
}
