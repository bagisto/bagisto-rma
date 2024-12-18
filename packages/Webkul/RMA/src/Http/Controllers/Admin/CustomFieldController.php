<?php

namespace Webkul\RMA\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Event;
use Webkul\RMA\DataGrids\Admin\CustomFieldRMADataGrid;
use Webkul\RMA\Repositories\RmaCustomFieldOptionRepository;
use Webkul\RMA\Repositories\RmaCustomFieldRepository;

class CustomFieldController extends Controller
{
    /**
     * @var int
     */
    public const INACTIVE = 0;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected RmaCustomFieldRepository $rmaCustomFieldRepository,
        protected RmaCustomFieldOptionRepository $rmaCustomFieldOptionRepository,
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
            return app(CustomFieldRMADataGrid::class)->toJson();
        }

        return view('rma::admin.sales.rma.custom-field.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() 
    {
        return view('rma::admin.sales.rma.custom-field.create');
    }

    /**
     * @return void
     */
    public function store()
    {
        $dataOptions = [];

        $this->validate(request(), [
            'label' => 'required',
            'code'  => 'required',
            'type'  => 'required',
        ]);

        $data = request()->except('_token', 'options', 'value');

        $rmaCustomField = $this->rmaCustomFieldRepository->create($data);

        if (request()->input( 'options')) {
            $dataOptions['options'] = request()->input('options');

            $dataOptions['value'] = request()->input('value');

            $this->rmaCustomFieldOptionRepository->createOption($dataOptions, $rmaCustomField->id);
        }

        session()->flash('success', trans('rma::app.admin.sales.rma.custom-field.create.success'));

        return redirect()->route('admin.sales.rma.custom-field.index');
    }

    /**
     * @return void
     */
    public function edit($id)
    {
        $rmaData = $this->rmaCustomFieldRepository->with('options')->find($id);

        return view('rma::admin.sales.rma.custom-field.edit', compact('rmaData'));
    }

    /**
     * @return void
     */
    public function update($id)
    {
        $this->validate(request(), [
            'label' => 'required',
            'code'  => ['required', 'unique:custom_rma_field,code,'.$id],
            'type'  => 'required',
        ]);

        $data = request()->except('_token');

        if (! isset($data['status'])) {
            $data['status'] = self::INACTIVE;
        }

        if (! isset($data['is_required'])) {
            $data['is_required'] = self::INACTIVE;
        }

        $rmaCustomField = $this->rmaCustomFieldRepository->update($data, $id);

        if (request()->input( 'options')) {
            $dataOptions['options'] = request()->input('options');

            $dataOptions['value'] = request()->input('value');

            $this->rmaCustomFieldOptionRepository->where('additional_rma_field_id', $rmaCustomField->id)->delete();

            $this->rmaCustomFieldOptionRepository->createOption($dataOptions, $rmaCustomField->id);
        }

        session()->flash('success', trans('rma::app.admin.sales.rma.custom-field.edit.success'));

        return redirect()->route('admin.sales.rma.custom-field.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            Event::dispatch('rma.custom-field.delete.before', $id);

            $this->rmaCustomFieldRepository->delete($id);

            Event::dispatch('rma.custom-field.delete.after', $id);

            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.custom-field.index.datagrid.delete-success'),
            ]);
        } catch (\Exception $e) {
        }

        return new JsonResponse([
            'message' => trans('admin::app.catalog.attributes.delete-failed'),
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function massUpdate(): JsonResponse
    {
        $this->rmaCustomFieldRepository
            ->whereIn('id', request()->indices)
            ->update(['status' => request()->value]);

        return new JsonResponse([
            'message' => trans('rma::app.admin.sales.rma.custom-field.edit.success'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function massDestroy(): JsonResponse
    {
        try {
            $this->rmaCustomFieldRepository->whereIn('id', request()->indices)->delete();

            return new JsonResponse([
                'message' => trans('rma::app.admin.sales.rma.custom-field.index.datagrid.delete-success'),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('admin::app.catalog.attributes.delete-failed'),
            ], 500);
        }
    }
}