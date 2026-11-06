<?php
namespace App\Http\Middleware;

use App\Models\Tracker;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Flight;
class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // сторінки статистики не рахуємо
        if ($request->routeIs('stats.*')) {
            return $response;
        }

        try {
            $param = $request->route('flight');
            $flightId = $param instanceof Flight
                ? $param->getKey()
                : (is_numeric($param) ? (int)$param : null);

            $ua = (string)$request->userAgent();

            Tracker::create([
                'page' => $request->path(),
                'ip' => $request->ip(),
                'status' => $response->getStatusCode(),
                'visited_at' => now(),
                'method' => $request->method(),
                'route_name' => $request->route()?->getName(),
                'user_agent' => mb_substr($ua, 0, 255),
                'device' => $this->detectDevice($ua),
                'flight_id' => $flightId,
            ]);
        } catch (\Throwable $e) {
            report($e);
        }
        return $response;
    }
    private function detectDevice(string $ua): string
    {
        if (preg_match('/ipad|tablet/i', $ua)) {
            return 'tablet';
        }
        if (preg_match('/mobile|android|iphone/i', $ua)) {
            return 'mobile';
        }
        return 'desktop';
    }
}
