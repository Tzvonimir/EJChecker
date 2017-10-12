<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedia;
use App\Repositories\Media\MediaRepository;

class MediaController extends AppController
{

    /**
     * @var MediaRepository
     */
    private $media;

    function __construct(MediaRepository $media)
    {
        $this->media = $media;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $this->allowIf(['media/module', 'media/index']);
        return ['success' => true, 'media' => $this->media->getPaginated()];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['media/module', 'media/show']);
        $media = $this->media->getById($id);
        return ['success' => true, 'media' => $media];
    }

}
