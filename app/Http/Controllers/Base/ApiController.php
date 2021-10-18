<?php

namespace App\Http\Controllers\Base;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @property Model $model
 */
class ApiController extends Controller
{
    protected int $defaultPerPage = 10;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = $this->model->when(
            $request?->filters ?? false,
            fn(Builder $query, $filters) => $query->where(json_decode($filters, true))
        )->when(
            $request?->search ?? false,
            fn(Builder $query, $search) => $this->model->makeSearch($query, $search)
        );

        foreach($this->model->orderBy ?? [] as $orderBy => $direction) {
            $query->orderBy($orderBy, $direction);
        }

        $perPage = $request?->per_page ?? $this->defaultPerPage;

        if($perPage == "false" || $perPage === false) {
            return response()->json($query->get());
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $model = $this->model->create($request->all());
        $model = $model->find($model->id);

        return response()->json(
            $model->toArray(),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json(
            $this->model->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $model = $this->model->findOrFail($id);

        if(!$model->update($request->all())) {
            return response()->json([
                'message' => 'Erro ao atualizar o registro'
            ], 500);
        }

        $model->refresh();
        return response()->json($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $ids = $this->model->destroy($id);
        return response()->json($ids);
    }

    public function all(): JsonResponse
    {
        $ids = $this->model->all();
        return response()->json($ids);
    }
}
