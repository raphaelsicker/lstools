<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct(public Address $model) {}

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $address = $this->model->when(
            $request?->filters ?? false,
            fn(Builder $query, $filters) => $query->where($filters)
        )->paginate();

        return response()->json($address);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $address = $this->model->create($request->all());

        return response()->json(
            $address->toArray(),
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
        $address = $this->model
            ->findOrFail($id)
            ->update($request->all());

        return response()->json($address);
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
}
