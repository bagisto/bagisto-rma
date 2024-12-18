<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\JsonResponse;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Http\Requests\{MassDestroyRequest,MassUpdateRequest};
use Webkul\RMA\DataGrids\Admin\ReasonDataGrid;
use Webkul\RMA\DataGrids\Admin\RulesDataGrid;
use Webkul\RMA\Repositories\ReasonResolutionsRepository;
use Webkul\RMA\Repositories\RMAReasonsRepository;
use Webkul\RMA\Repositories\RMAResolutionTypeRepository;
use Webkul\RMA\Repositories\RMARulesRepository;

class RmaRulesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected RMARulesRepository $rmaRulesRepository,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(RulesDataGrid::class)->toJson();
        }

        return view('rma::admin.sales.rma.rules.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): JsonResponse
    {
        $this->validate(request(), [
            'title'            => 'required',
            'status'           => 'required|boolean',
            'rule_description' => 'required',
        ]);

        $this->rmaRulesRepository->create(request()->input());

        return response()->json([
            'message' => trans('rma::app.admin.sales.rma.rules.create.success'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     */
    public function edit($id): JsonResponse
    {
        $reason = $this->rmaRulesRepository->find($id);

        if (! $reason) {
            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rules.update.not-found'),
            ], 404);
        }

        return new JsonResponse($reason);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(): JsonResponse
    {
        $this->validate(request(), [
            'title'            => 'required',
            'status'           => 'required|boolean',
            'rule_description' => 'required',
        ]);

        $this->rmaRulesRepository->update(request()->except('_method', 'id'), request()->id);

        return response()->json([
            'message' => trans('rma::app.admin.sales.rma.rules.edit.success', ['name' => 'Reason']),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->rmaRulesRepository->delete($id);

            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rules.index.datagrid.delete-success'),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rules.index.datagrid.reason-error'),
            ], 500);
        }
    }

    /**
     * Mass update rules status.
     */
    public function massUpdate(MassUpdateRequest $request): JsonResponse
    {
        $this->rmaRulesRepository
            ->whereIn('id', $request->indices)
            ->update(['status' => $request->value]);

        return new JsonResponse([
            'message' => trans('rma::app.admin.sales.rma.rules.edit.mass-update-success'),
        ]);
    }

    /**
     * Remove the specified resources from database.
     */
    public function massDestroy(MassDestroyRequest $request): JsonResponse
    {
        try {
            $this->rmaRulesRepository->whereIn('id', $request->indices)->delete();

            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rules.index.datagrid.mass-delete-success'),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rules.index.datagrid.reason-error'),
            ], 500);
        }
    }
}