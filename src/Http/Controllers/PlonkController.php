<?php

namespace Metrique\Plonk\Http\Controllers;

use Illuminate\Http\Request;

use Metrique\Plonk\Http\Controllers\PlonkBaseController;
use Metrique\Plonk\Http\Requests\PlonkStoreRequest;
use Metrique\Plonk\Http\Requests\PlonkUpdateRequest;
use Metrique\Plonk\Repositories\PlonkInterface as Plonk;
use Metrique\Plonk\Repositories\PlonkStoreInterface as PlonkStore;

class PlonkController extends PlonkBaseController
{
    protected $views = [
        'index' => 'laravel-plonk::index',
        'create' => 'laravel-plonk::create',
        'show' => 'laravel-plonk::show',
        'edit' => 'laravel-plonk::edit',
        'destroy' => 'laravel-plonk::destroy',
    ];

    protected $routes = [
        'index' => 'plonk.index',
        'create' => 'plonk.create',
        'store' => 'plonk.store',
        'edit' => 'plonk.edit',
        'update' => 'plonk.update',
        'destroy' => 'plonk.destroy',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Plonk $plonk, Request $request)
    {
        $assets = $plonk
            ->allFiltered()
            ->paginate(config('plonk.paginate.items'))
            ->appends($plonk->filterRequest()->toArray());
        
        $this->mergeViewData([
            'assets' => $assets,
            'routes' => $this->routes,
        ]);
        
        return $this->viewWithData($this->views['index']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(PlonkStore $plonk)
    {
        $this->mergeViewData([
            'ratios' => config('plonk.crop'),
        ]);

        return $this->viewWithData($this->views['create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PlonkStoreRequest $request, PlonkStore $plonk)
    {
        $plonk->store();

        return redirect()->route($this->routes['index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Plonk $plonk)
    {
        $this->mergeViewData([
            'asset' => $plonk->find($id)
        ]);

        return $this->viewWithData($this->views['show']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Plonk $plonk)
    {
        $this->mergeViewData([
            'asset' => $plonk->find($id)
        ]);

        return $this->viewWithData($this->views['edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PlonkUpdateRequest $request, $id, Plonk $plonk)
    {
        $plonk->update($id, [
            'title' => $request->input('title'),
            'alt' => $request->input('alt'),
        ]);

        return redirect()->route($this->routes['index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Plonk $plonk)
    {
        $plonk->unpublish($id);

        return redirect()->route($this->routes['index']);
    }
}
