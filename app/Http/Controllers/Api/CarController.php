<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailableCarsRequest;
use App\Models\Car;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function available(AvailableCarsRequest $request)
    {
        $user = Auth::user();

        // Получаем позицию и допустимые категории комфорта для сотрудника
        $employee = $user->employee()->with('position.comfortCategories')->firstOrFail();
        $allowedCategoryIds = $employee->position->comfortCategories->pluck('id');

        // ID занятых машин в указанный период
        $busyCarIds = Trip::where(function ($q) use ($request) {
            $q->whereBetween('start_time', [$request->start_time, $request->end_time])
                ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                ->orWhere(function ($q2) use ($request) {
                    $q2->where('start_time', '<=', $request->start_time)
                        ->where('end_time', '>=', $request->end_time);
                });
        })->pluck('car_id');

        // Основной запрос
        $query = Car::with(['model', 'driver', 'comfortCategory'])
            ->whereIn('comfort_category_id', $allowedCategoryIds)
            ->whereNotIn('id', $busyCarIds);

        if ($request->car_model_id) {
            $query->where('car_model_id', $request->car_model_id);
        }

        if ($request->comfort_category_id) {
            $query->where('comfort_category_id', $request->comfort_category_id);
        }

        return response()->json($query->get());
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
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
