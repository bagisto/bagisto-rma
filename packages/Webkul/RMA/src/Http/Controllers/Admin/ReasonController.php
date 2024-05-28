<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use Symfony\Component\HttpFoundation\JsonResponse;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Http\Requests\MassDestroyRequest;
use Webkul\Admin\Http\Requests\MassUpdateRequest;
use Webkul\RMA\DataGrids\Admin\ReasonDataGrid;
use Webkul\RMA\Repositories\RMAReasonsRepository;

class ReasonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected RMAReasonsRepository $rmaReasonRepository)
    {
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('rma::admin.sales.rma.reasons.create');
    }

    /**
     * Show the form for Store a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function store()
    {
        $data = request()->except('_token');

        $this->rmaReasonRepository->create($data);

        return new JsonResponse([
            'message' => trans('rma::app.admin.sales.rma.reasons.create.create-success'),
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $reasonData = $this->rmaReasonRepository->find($id);

        return view('rma::admin.sales.rma.reasons.edit', compact('reasonData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return response
     */
    public function update()
    {
        $data = request()->except('_token');

        $reason = $this->rmaReasonRepository->find($data['id']);

        if (!$reason) {
            return new JsonResponse([
                'error' => trans('rma::app.admin.sales.rma.reasons.update.not-found'),
            ], 404);
        }

        $reason->update($data);

        return new JsonResponse([
            'message' => trans('rma::app.admin.sales.rma.reasons.update.success'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->rmaReasonRepository->delete($id);

        return new JsonResponse([
            'message' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.delete-success'),
        ]);
    }

    /**
     * Mass update reasons
     *
     * @return response
     */
    public function massUpdate(MassUpdateRequest $massUpdateRequest)
    {
        $data = $massUpdateRequest->all();

        $reasonIds = $data['indices'];

        foreach ($reasonIds as $reasonId) {
            $rmaReason = $this->rmaReasonRepository->find($reasonId);

            $rmaReason->status = $massUpdateRequest->input('value');

            $rmaReason->save();
        }

        return new JsonResponse([
            'message' => trans('rma::app.admin.sales.rma.reasons.edit.mass-update-success'),
        ]);
    }

    /**
     * Remove the specified resources from database.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function massDestroy(MassDestroyRequest $massDestroyRequest)
    {
        $suppressFlash = false;

        $indices = $massDestroyRequest->input('indices');

        foreach ($indices as $index) {
            $this->rmaReasonRepository->delete($index);
        }

        if (! $suppressFlash) {
            $suppressFlash = true;

            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.reasons.index.datagrid.mass-delete-success'),
            ]);
        }

        session()->flash('error', trans('rma::app.admin.sales.rma.reasons.index.datagrid.reason-error'));

        return redirect()->back();
    }
}
