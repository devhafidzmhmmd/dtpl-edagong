<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\User;

class HandleUmkmUserUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Handle before request is processed by vendor controller
        // This way we can save file first
        if ($request->isMethod('put') && str_contains($request->path(), 'admin/user')) {
            $this->handleUmkmFields($request);
        }
        
        $response = $next($request);
        
        return $response;
    }
    
    private function handleUmkmFields($request)
    {
        // Extract user ID from route
        $userId = $request->route('user');
        
        if (!$userId) {
            // Try to get from path
            preg_match('/\/admin\/user\/(\d+)/', $request->path(), $matches);
            if (!isset($matches[1])) {
                return;
            }
            $userId = $matches[1];
        }
        
        $user = User::find($userId);
        
        if (!$user) {
            return;
        }
        
        // Handle store logo upload - save to storage/app/public/store
        if ($request->hasFile('store_logo')) {
            try {
                // Delete old logo if exists
                if ($user->store_logo) {
                    // Check if it's a relative path or full path
                    $oldPath = str_starts_with($user->store_logo, '/private') 
                        ? null 
                        : $user->store_logo;
                    
                    if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
                
                // Store new logo in storage/app/public/store/
                $logoPath = $request->file('store_logo')->store('store', 'public');
                
                // Ensure we're getting a clean relative path
                if (str_starts_with($logoPath, 'store/')) {
                    $user->store_logo = $logoPath;
                } else {
                    $user->store_logo = 'store/' . basename($logoPath);
                }
                
                $user->save(); // Save immediately
                
                Log::info("Store logo updated for user: {$user->id}, path: {$user->store_logo}");
            } catch (\Exception $e) {
                Log::error("Error updating store logo: " . $e->getMessage());
            }
        }
        
        // Update other UMKM fields if present (will be saved by vendor controller)
        // We don't need to save these as vendor controller will handle it
    }
}

