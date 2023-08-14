<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payroll');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function dateRange(Request $request)
    {


        // $data = DB::table('employees')
        // ->join('sales', 'employees.employees_id', '=', 'sales.employees_id')
        // ->join('services', 'sales.service_id', '=', 'services.service_id')
        // ->join('products', 'sales.product_id', '=', 'products.product_id')
        // ->whereBetween('sales.date_id', [$request->start, $request->end])
        // ->sum('services.amount');

        // $employees = DB::table('employees')->get();

        // foreach ($employees as $employee) {
        //     $salesData = DB::table('sales')
        //         ->join('services', 'sales.service_id', '=', 'services.service_id')
        //         ->join('products', 'sales.product_id', '=', 'products.product_id')
        //         ->where('sales.employees_id', $employee->employees_id)
        //         ->whereBetween('sales.date_id', [$request->start, $request->end])
        //         ->select(
        //             DB::raw('SUM(services.amount) as services_amount'),
        //             DB::raw('SUM(products.price) as products_amount')
        //         )
        //         ->first();

        //     $employee->servicesAmount = $salesData->services_amount ?? 0;
        //     $employee->productsAmount = $salesData->products_amount ?? 0;
        // }



        // $employees = DB::table('employees')->get();

        // foreach ($employees as $employee) {
        //     $salesData = DB::table('sales')
        //         ->join('services', 'sales.service_id', '=', 'services.service_id')
        //         ->join('products', 'sales.product_id', '=', 'products.product_id')
        //         ->where('sales.employees_id', $employee->employees_id)
        //         ->whereBetween('sales.date_id', [$request->start, $request->end])
        //         ->select(
        //             DB::raw('SUM(services.amount) as services_amount'),
        //             DB::raw('SUM(products.price) as products_amount'),
        //             'services.category' // Include the category column
        //         )
        //         ->groupBy('services.category') // Group by category
        //         ->get(); // Retrieve multiple rows


        //     // Calculate standardpay from time_logs
        //     $timeLogData = DB::table('time_logs')
        //         ->join('employees', 'time_logs.employees_id', '=', 'employees.employees_id')
        //         ->where('time_logs.employees_id', $employee->employees_id)
        //         ->whereBetween('date_id', [$request->start, $request->end])
        //         ->sum('rate');

        //     $standardPay = $timeLogData * 7;




        //     $totalAmountServices = 0;
        //     // Calculate the totalAmountServices if services_amount meets the quota
        //     if ($salesData->sum('services_amount') >= 1350) {
        //         foreach ($salesData as $sale) {
        //             if ($sale->category === 'Hard') {
        //                 $totalAmountServices += $sale->services_amount * 0.10;
        //             } elseif ($sale->category === 'Light') {
        //                 $totalAmountServices += $sale->services_amount * 0.07;
        //             }
        //         }
        //     }

        //     $standardPay = $timeLogData * 7;



        //     // Calculate totalAmount for products only if quota is reached
        //     $productAmount = DB::table('sales')
        //         ->join('products', 'sales.product_id', '=', 'products.product_id')
        //         ->whereBetween('date_id', [$request->start, $request->end])
        //         ->select(
        //             DB::raw('SUM(products.price) as products_amount'),
        //         )
        //         ->get();


        //     $totalAmountProducts = 0;
        //     if ($productAmount->sum('products_amount')  >= 8000) {
        //         $totalAmountProducts += $productAmount->sum('products_amount') * 0.20;
        //     }


        //     $employee->totalAmountProducts = $totalAmountProducts;
        //     $employee->totalAmountServices = $totalAmountServices;
        //     $employee->standardPay = $standardPay;
        // }
        // dd($employees);







        $employees = DB::table('employees')->get();
        $totalAmountServices = 0;

        foreach ($employees as $employee) {
            if (isset($request->start) && isset($request->end)) {
                $currentDate = $request->start;
                while ($currentDate <= $request->end) {
                    $salesData = DB::table('sales')
                        ->join('services', 'sales.service_id', '=', 'services.service_id')
                        ->join('products', 'sales.product_id', '=', 'products.product_id')
                        ->where('sales.employees_id', $employee->employees_id)
                        ->where('sales.date_id', $currentDate) // Filter by current date
                        ->select(
                            DB::raw('SUM(services.amount) as services_amount'),
                            DB::raw('SUM(products.price) as products_amount'),
                            'services.category'
                        )
                        ->groupBy('services.category')
                        ->get();

                    if ($salesData->sum('services_amount') >= 1350) {
                        foreach ($salesData as $sale) {
                            if ($sale->category === 'Hard') {
                                $totalAmountServices += $sale->services_amount * 0.10;
                            } elseif ($sale->category === 'Light') {
                                $totalAmountServices += $sale->services_amount * 0.07;
                            }
                        }
                    }
                                $totalAmountServices += $salesData->sum('services_amount');
                                
                                
                                // Calculate standardpay from time_logs
                                $timeLogData = DB::table('time_logs')
                                ->join('employees', 'time_logs.employees_id', '=', 'employees.employees_id')
                                ->where('time_logs.employees_id', $employee->employees_id)
                                // ->where('time_logs.date_id', $currentDate) // Filter by current date
                                ->whereBetween('date_id', [$request->start, $request->end])
                                
                                ->sum('rate');
                                
                                $standardPay = $timeLogData * 7;
                                
                                // Calculate totalAmount for products only if quota is reached for the day
                                $productAmount = DB::table('sales')
                                ->join('products', 'sales.product_id', '=', 'products.product_id')
                                // ->where('sales.date_id', $request->start ) // Filter by current date
                        ->whereBetween('date_id', [$request->start, $request->end])

                        ->select(
                            DB::raw('SUM(products.price) as products_amount'),
                            )
                            ->get();
                            
                            $totalAmountProducts = 0;
                            if ($productAmount->sum('products_amount') >= 8000) {
                                $totalAmountProducts += $productAmount->sum('products_amount') * 0.20;
                            }
                            
                            // Assign the calculated values to the employee object
                            $employee->totalAmountProducts = $totalAmountProducts;
                            $employee->totalAmountServices = $totalAmountServices;
                            $employee->standardPay = $standardPay;
                            
                            // Move to the next day
                            $currentDate = date('m/d/Y', strtotime('+1 day', strtotime($currentDate)));
                            // echo $currentDate . "<br>";
                            // echo $salesData->sum('services_amount') . "<br> ";
                            // dd($currentDate);        
                        }
                    }
        }
   
        

        

        return view('payroll-show', ['payrolls' => $employees]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
