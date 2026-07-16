<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalRevenue = Order::where('status_pesanan', '!=', 'cancelled')->sum('total_harga');
        $activeOrders = Order::whereNotIn('status_pesanan', ['completed', 'cancelled'])->count();
        $lowStockProducts = Product::where('stok', '<', 5)->get();
        $recentOrders = Order::with('user')->orderBy('created_at', 'desc')->take(3)->get();

        // Server-Side Chart Logic
        $filter = $request->query('filter', 'today'); // today, this_week, this_month, this_year
        $labels = [];
        $salesData = [];

        $query = Order::where('status_pesanan', '!=', 'cancelled');

        if ($filter === 'today') {
            $startDate = Carbon::today();
            $endDate = Carbon::today()->endOfDay();
            
            $aggregated = $query->whereBetween('created_at', [$startDate, $endDate])
                                ->selectRaw('HOUR(created_at) as hour, SUM(total_harga) as total')
                                ->groupBy('hour')
                                ->pluck('total', 'hour')->toArray();
            
            for ($i = 0; $i < 24; $i++) {
                $labels[] = sprintf('%02d:00', $i);
                $salesData[$i] = isset($aggregated[$i]) ? (float) $aggregated[$i] : 0;
            }
            
        } elseif ($filter === 'this_week') {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
            
            $aggregated = $query->whereBetween('created_at', [$startDate, $endDate])
                                ->selectRaw('WEEKDAY(created_at) as weekday, SUM(total_harga) as total')
                                ->groupBy('weekday')
                                ->pluck('total', 'weekday')->toArray();
            
            $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            foreach ($days as $index => $day) {
                $labels[] = $day;
                $salesData[$index] = isset($aggregated[$index]) ? (float) $aggregated[$index] : 0;
            }
            
        } elseif ($filter === 'this_month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            $daysInMonth = $startDate->daysInMonth;
            
            $aggregated = $query->whereBetween('created_at', [$startDate, $endDate])
                                ->selectRaw('DAY(created_at) as day, SUM(total_harga) as total')
                                ->groupBy('day')
                                ->pluck('total', 'day')->toArray();
            
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $labels[] = (string) $i;
                $salesData[$i - 1] = isset($aggregated[$i]) ? (float) $aggregated[$i] : 0;
            }
            
        } elseif ($filter === 'this_year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
            
            $aggregated = $query->whereBetween('created_at', [$startDate, $endDate])
                                ->selectRaw('MONTH(created_at) as month, SUM(total_harga) as total')
                                ->groupBy('month')
                                ->pluck('total', 'month')->toArray();
            
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            foreach ($months as $index => $month) {
                $labels[] = $month;
                $monthKey = $index + 1;
                $salesData[$index] = isset($aggregated[$monthKey]) ? (float) $aggregated[$monthKey] : 0;
            }
        }

        return view('admin.dashboard', compact('totalRevenue', 'activeOrders', 'lowStockProducts', 'recentOrders', 'labels', 'salesData', 'filter'));
    }
}
