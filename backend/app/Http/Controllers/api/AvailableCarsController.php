<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailableCarsRequest;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class AvailableCarsController extends Controller
{
    /**
     * Возвращает список доступных машин для текущего пользователя
     * на заданный интервал времени с опциональной фильтрацией.
     *
     * @param  AvailableCarsRequest  $request
     * @return JsonResponse
     */
    public function index(AvailableCarsRequest $request): JsonResponse
    {
        $params = $request->validated();
        $start  = $params['start_at'];
        $end    = $params['end_at'];
        $model  = $params['model'];
        $catId  = $params['category'];
        $user   = $request->user();

        $query = Car::with([
            'model.comfortCategory',
            'driver'
        ]);

        $query = $this->applyUserCategoryFilter($query, $user->position->comfortCategories->pluck('id')->all());

        $query = $this->applyAvailabilityFilter($query, $start, $end);

        if ($model !== null) {
            $query->whereHas('model', function ($q) use ($model) {
                $q->where('name', 'LIKE', "%{$model}%");
            });
        }

        if ($catId !== null) {
            $query->whereHas('model.comfortCategory', function ($q) use ($catId) {
                $q->where('id', $catId);
            });
        }

        $cars = $query->get()->map(function (Car $car) {
            return [
                'id'          => $car->id,
                'model'       => $car->model->name,
                'category'    => $car->model->comfortCategory->name,
                'license'     => $car->license_plate,
                'driver_name' => $car->driver->name,
                'driver_phone'=> $car->driver->phone,
            ];
        });

        return response()->json([
            'data' => $cars,
        ]);
    }

    /**
     * Ограничивает выборку только теми машинами,
     * чей комфорт входит в разрешённые для пользователя категории.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int[]  $allowedCategoryIds
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function applyUserCategoryFilter($query, array $allowedCategoryIds)
    {
        return $query->whereHas('model.comfortCategory', function ($q) use ($allowedCategoryIds) {
            $q->whereIn('id', $allowedCategoryIds);
        });
    }

    /**
     * Исключает машины, у которых есть пересекающиеся бронирования.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Carbon\Carbon  $start
     * @param  \Carbon\Carbon  $end
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function applyAvailabilityFilter($query, $start, $end)
    {
        return $query->whereDoesntHave('reservations', function ($q) use ($start, $end) {
            $q->where(function ($sub) use ($start, $end) {
                $sub->whereBetween('start_at', [$start, $end])
                    ->orWhereBetween('end_at', [$start, $end])
                    ->orWhere(function ($inside) use ($start, $end) {
                        $inside->where('start_at', '<=', $start)
                            ->where('end_at', '>=', $end);
                    });
            });
        });
    }
}
