<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracker;

class StatsController extends Controller
{
    public function pages(Request $request)
    {
        $type = $request->query('type', 'page');
        if (!in_array($type, ['page', 'ip'], true)) {abort(400, 'Невідомий тип групування.');
        }
        $rows = Tracker::query()
                ->selectRaw(
                    "{$type}, count(*) as hits, max(visited_at) as last_visit"
                )->groupBy($type)
        ->orderByDesc('hits')
        ->get();
return view('stats.pages', compact('rows', 'type'));
}
    public function detail(Request $request)
    {
        $type = $request->query('type', 'page');
        $item = $request->query('item');
        if (!in_array($type, ['page', 'ip'], true)) {
            abort(400, 'Невідомий тип фільтрації.');
        }
        $rows = Tracker::query()
                ->when(
                    $item,
                    fn ($query, $value) =>
                    $query->where($type, $value)
                ) ->orderByDesc('visited_at')
        ->paginate(15)
        ->withQueryString();
return view('stats.detail',
    compact('rows', 'type', 'item')
);
}
    public function flights()
    {
        $flights = Tracker::query()
            ->join('flights', 'flights.id', '=', 'tracker.flight_id')
            ->where('tracker.route_name', 'flight.show')
            ->where('tracker.method', 'GET')
            ->select(
                'flights.id',
                'flights.departure_airport',
                'flights.arrival_airport',
                'flights.departure_date'
            )
            ->selectRaw('count(*) as views')
            ->selectRaw('max(tracker.visited_at) as last_view')
            ->groupBy(
                'flights.id',
                'flights.departure_airport',
                'flights.arrival_airport',
                'flights.departure_date'
            )
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        $devices = Tracker::query()
            ->select('device')
            ->selectRaw('count(*) as hits')
            ->groupBy('device')
            ->orderByDesc('hits')
            ->get();

        return view('stats.flights', compact('flights', 'devices'));
    }
}
