<?php

namespace App\Repositories;

use App\Models\Cars;
use Illuminate\Http\Request;

class CarRepositoryEloquent implements CarRepositoryInterface
{
    private $model;

    public function __construct(Cars $cars)
    {
        $this->model = $cars;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($id)
    {
       return $this->model->find($id);
    }

    public function store(Request $request)
    {
        return $this->model->create($request->all());
    }

    public function update($id, Request $request)
    {
        $car = $this->model->find($id);

        if ($car)
            return $car->update($request->all());

        return null;
    }

    public function destroy($id)
    {
        $car = $this->model->find($id);

        if ($car)
            return $car->delete();

        return null;
    }
}
