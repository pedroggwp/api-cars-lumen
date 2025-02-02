<?php

namespace App\Services;

use App\Models\Cars;
use App\Models\ValidationCars;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CarService
{
    private $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function getAll()
    {
        $cars = $this->carRepository->getAll();

        if ($cars)
            return response()->json($cars, Response::HTTP_OK);

        return response()->json([
            'error' => 'No cars found in database'
        ], Response::HTTP_NOT_FOUND);
    }

    public function get($id)
    {
        $car = $this->carRepository->get($id);

        if ($car)
            return response()->json($car, Response::HTTP_OK);

        return response()->json([
            'error' => 'Car with ID: ' . $id . ' not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ValidationCars::RULE_CAR
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $car = $this->carRepository->store($request);

        return response()->json([
            'id' => $car->id,
            'name' => $car->name,
            'description' => $car->description,
            'model' => $car->model,
            'date' => $car->date,
        ], Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ValidationCars::RULE_CAR
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $car = $this->carRepository->update($id, $request);

        if ($car)
            return response()->json($car, Response::HTTP_NO_CONTENT);

        return response()->json([
            'error' => 'Car with ID: ' . $id . ' not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function destroy($id)
    {
        $destroyed = $this->carRepository->destroy($id);

        if ($destroyed)
            return response()->json(null, Response::HTTP_NO_CONTENT);

        return response()->json([
            'error' => 'Car with ID: ' . $id . ' not found.'
        ], Response::HTTP_NOT_FOUND);
    }
}
