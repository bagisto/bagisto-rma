<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\JsonResponse;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Http\Requests\MassDestroyRequest;
use Webkul\Admin\Http\Requests\MassUpdateRequest;
use Webkul\RMA\DataGrids\Admin\RmaStatusDataGrid;
use Webkul\RMA\Repositories\RMAStatusRepository;

class RmaStatusController extends Controller
{
    /**
     * @var string
     */
    public const ACCEPT = 'Accept';

    /**
     * @var string
     */
    public const ITEMCANCELED = 'Item Canceled';

    /**
     * @var string
     */
    public const ORDERCANCELED = 'Canceled';

    /**
     * @var string
     */
    public const CANCELED = 'canceled';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected RMAStatusRepository $rmaStatusRepository,
    ) {
    }

    /**
     * RMA Status list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(RmaStatusDataGrid::class)->toJson();
        }

        return view('rma::admin.sales.rma.status.index');
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(): JsonResponse
    {
        $this->validate(request(), [
            'title'  => 'required',
            'status' => 'required|boolean',
        ]);

        $this->rmaStatusRepository->create(request()->input());

        return response()->json([
            'message' => trans('rma::app.admin.sales.rma.rma-status.create.success'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     */
    public function edit($id): JsonResponse
    {
        $reason = $this->rmaStatusRepository->find($id);

        if (! $reason) {
            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rma-status.update.not-found'),
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
            'title'  => 'required',
            'status' => 'required|boolean',
        ]);

        $this->rmaStatusRepository->update(request()->except('_method', 'id'), request()->id);

        return response()->json([
            'message' => trans('rma::app.admin.sales.rma.rma-status.edit.success', ['name' => 'RMA Status']),
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
            $this->rmaStatusRepository->delete($id);

            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rma-status.index.datagrid.delete-success'),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rma-status.index.datagrid.reason-error'),
            ], 500);
        }
    }

    /**
     * Mass update rma status.
     */
    public function massUpdate(MassUpdateRequest $request): JsonResponse
    {
        $this->rmaStatusRepository
            ->whereIn('id', $request->indices)
            ->update(['status' => $request->value]);

        return new JsonResponse([
            'message' => trans('rma::app.admin.sales.rma.rma-status.edit.mass-update-success'),
        ]);
    }

    /**
     * Remove the specified resources from database.
     */
    public function massDestroy(MassDestroyRequest $request): JsonResponse
    {
        try {
            $this->rmaStatusRepository->whereIn('id', $request->indices)->delete();

            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rma-status.index.datagrid.mass-delete-success'),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.rma-status.index.datagrid.reason-error'),
            ], 500);
        }
    }
}   