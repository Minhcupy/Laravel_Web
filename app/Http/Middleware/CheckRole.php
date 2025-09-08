<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Nếu chưa đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Lấy user hiện tại
        $user = Auth::user();

        // Nếu role của user không nằm trong danh sách roles cho phép
        if (!in_array($user->role, $roles)) {
            // Redirect thay vì abort
            return redirect()->route('shop.index')
                ->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }

        return $next($request);
    }
}
