<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use App\Model\ShopSiteInfo;

/**
 * クライアントのリアルIPがホワイトリストに存在するかチェックするためのミドルウェア
 */
class IpLimit
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
        $ipAddressList = array_flatten(\Config::get('auth.ip_limit'));

        // 設定されていない場合は通す
        if (empty($ipAddressList)) return $next($request);

        // システム内からのリクエストの場合は通す
        if ($request->input('is_system_request')) return $next($request);


        if ($this->isAllow($request->ip(), $ipAddressList) === false) {
            Log::debug('cannot access from : ' . $request->ip());
            abort('403');
        }

        return $next($request);
    }

    private function isAllow(string $remoteIp, array $accepts)
    {
        foreach ($accepts as $accept) {
            if ($this->isIn($remoteIp, $accept)) {
                return true;
            }
        }
        return false;
    }
    private function isIn(string $remoteIp, string $accept)
    {
        if (strpos($accept, '/') === false) {
            return ($remoteIp === $accept);
        }
        list($acceptIp, $mask) = explode('/', $accept);
        $acceptLong            = ip2long($acceptIp) >> (32 - $mask);
        $remoteLong            = ip2long($remoteIp) >> (32 - $mask);

        return ($acceptLong == $remoteLong);
    }
}
