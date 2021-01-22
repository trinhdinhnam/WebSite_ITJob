<?php


namespace App\Repository\City;


use App\Models\City;
use App\Repository\BaseRepository;

class CityRepository extends BaseRepository implements ICityRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
        return City::class;
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function getListCities()
    {
        // TODO: Implement getListCities() method.
        $cities =  $this->model->all();
        return $cities;
    }
}