<?php

namespace Webkul\RMA\Repositories;

use Storage;
use Illuminate\Container\Container;
use Webkul\Core\Eloquent\Repository;

class RMAImagesRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Webkul\RMA\Contracts\RMAImages';
    }

    public function __construct(
        Container $container
    ) {
        parent::__construct($container);
    }

    /**
     * upload images
     */
    public function uploadImages($data, $rma)
    {
        $previousImageIds = $rma->images()->pluck('id');

        if (isset($data['images'])) {
            foreach ($data['images'] as $imageId => $image) {
                $file = 'images.' . $imageId;
                $dir = 'rma/' . $rma->id;

                if (str_contains($imageId, 'image_')) {
                    if (request()->hasFile($file)) {

                        $this->create([
                                'path' => request()->file($file)->store($dir),
                                'rma_id' => $rma->id
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
                                'path' => request()->file($file)->store($dir)
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
