<?php

namespace Webkul\RMA\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Storage;
use Webkul\Core\Eloquent\Repository;
use Webkul\RMA\Contracts\RMAImages;

class RMAImagesRepository extends Repository
{
    /**
     * Specify model class name
     *
     * @return string
     */
    public function model()
    {
        return RMAImages::class;
    }

    /**
     * Upload images
     *
     * @param  array  $requestData
     * @param  object  $rma
     */
    public function uploadImages($requestData, $rma)
    {
        $previousImageIds = $rma->images()->pluck('id');

        if (isset($requestData['images'])) {
            foreach ($requestData['images'] as $imageId => $image) {
                $file = 'images.' . $imageId;
                $dir = 'rma/' . $rma->id;

                if (str_contains($imageId, '')) {
                    if (request()->hasFile($file)) {
                        $this->create([
                            'path'   => request()->file($file)->store($dir),
                            'rma_id' => $rma->id,
                        ]);
                    }
                } else {
                    if (is_numeric($index = $previousImageIds->search($imageId))) {
                        $previousImageIds->forget($index);
                    }

                    if (request()->hasFile($file)) {
                        if ($imageModel = $this->find($imageId)) {
                            Storage::delete($imageModel->path);
                        }

                        $this->update([
                            'path' => request()->file($file)->store($dir),
                        ], $imageId);
                    }
                }
            }
        }

        foreach ($previousImageIds as $imageId) {
            if ($imageModel = $this->find($imageId)) {
                Storage::delete($imageModel->path);

                $this->delete($imageId);
            }
        }
    }
}