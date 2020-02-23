<?php

namespace App\Http\Controllers\Chart;

use App\Model\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;

class ChartController extends Controller {
    public function orderChartByYear (Request $request) {
        $year = (new DateTime)->format('Y');

        if ($request->isMethod('post')) {
            $year = $request->get('year');
        }

        $countOrder = array();
        $colorPerMonth = array();
        $totalPerMonth = array();
        $total = 0;

        for ($month = 1; $month < 13; $month++) {
            $orderPerMonth = Payment::where('payment_status', 'PAID')
                                    ->whereMonth('created_at', $month)
                                    ->whereYear('created_at', $year)->get();

            foreach ($orderPerMonth as $order) {
                $total += $order->payment_total;
            }

            $totalPerMonth[] = $total;
            $total = 0;
            $countOrder[] = count($orderPerMonth);
            $colorPerMonth[] = $this->rand_color();
        }

        return view('admin.chart.order-chart', ['countOrderPerMonth' => $countOrder,
            'colorPerMonth' => $colorPerMonth,
            'yearSummary' => $year,
            'totalPerMonth' => $totalPerMonth]);
    }

    function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
