<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\JsonResponse;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Http\Requests\{MassDestroyRequest,MassUpdateRequest};
use Webkul\RMA\DataGrids\Admin\ReasonDataGrid;
use Webkul\RMA\Repositories\ReasonResolutionsRepository;
use Webkul\RMA\Repositories\RMAReasonsRepository;
use Webkul\RMA\Repositories\RMAResolutionTypeRepository;

class ReasonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected RMAReasonsRepository $rmaReasonRepository,
        protected ReasonResolutionsRepository $reasonResolutionsRepository,
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
            return app(ReasonDataGrid::class)->toJson();
        }

        return view('rma::admin.sales.rma.reasons.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): JsonResponse
    {
        $this->validate(request(), [
            'title'    => 'required',
            'status'   => 'required|boolean',
            'position' => 'required',
        ]);
        
        $resolutionTypes = request()->resolution_type;
        
        $rmaReason = $this->rmaReasonRepository->create(request()->only('title', 'status', 'position'));
        
        foreach ($resolutionTypes as $resolutionType) {
            $this->reasonResolutionsRepository->create([
                'rma_reason_id'   => $rmaReason->id,
                'resolution_type' => $resolutionType,
            ]);
        }

        return response()->json([
            'message' => trans('rma::app.admin.sales.rma.reasons.create.success'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     */
    public function edit($id): JsonResponse
    {
        $reason = $this->rmaReasonRepository->where('id', $id)
            ->with('reasonResolutions')
            ->first();

        if (! $reason) {
            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.reasons.update.not-found'),
            ], 404);
        }

        $reasonResolutions = [];
        
        foreach ($reason->reasonResolutions as $reasonResolution) {
            $reasonResolutions[] = $reasonResolution->resolution_type;
        }

        $reason->reasonResolutions = $reasonResolutions;

        return new JsonResponse($reason);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(): JsonResponse
    {
        $this->validate(request(), [
            'title'    => 'required',
            'status'   => 'required|boolean',
            'position' => 'required',
        ]);

        $rmaReason = $this->rmaReasonRepository->update(request()->only('title', 'status', 'position'), request()->id);
        
        $resolutionTypes = request()->resolution_type;

        $existResolution = $this->reasonResolutionsRepository->where('rma_reason_id', $rmaReason->id)->get();

        if(! empty($existResolution)) {
            $this->reasonResolutionsRepository->where('rma_reason_id', $rmaReason->id)->delete();
        }

        foreach ($resolutionTypes as $resolutionType) {
            $this->reasonResolutionsRepository->create([
                'rma_reason_id'   => $rmaReason->id,
                'resolution_type' => $resolutionType,
            ]);
        }
        
        return response()->json([
            'message' => trans('rma::app.admin.sales.rma.reasons.edit.success', ['name' => 'Reason']),
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
            $this->rmaReasonRepository->delete($id);

            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.delete-success'),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.reason-error'),
            ], 500);
        }
    }

    /**
     * Mass update reasons status.
     */
    public function massUpdate(MassUpdateRequest $request): JsonResponse
    {
        $this->rmaReasonRepository
            ->whereIn('id', $request->indices)
            ->update(['status' => $request->value]);

        return new JsonResponse([
            'message' => trans('rma::app.admin.sales.rma.reasons.edit.mass-update-success'),
        ]);
    }

    /**
     * Remove the specified resources from database.
     */
    public function massDestroy(MassDestroyRequest $request): JsonResponse
    {
        try {
            $this->rmaReasonRepository->whereIn('id', $request->indices)->delete();

            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.mass-delete-success'),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.reason-error'),
            ], 500);
        }
    }
}