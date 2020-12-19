<?php


namespace App\Repository\Position;


use App\Models\Position;
use App\Repository\BaseRepository;
use App\Repository\Position\IPositionRepository;

class PositionRepository extends BaseRepository implements IPositionRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Position::class;
    }
    public function getListPositions()
    {
        // TODO: Implement getListPositions() method.
        $positions = $this->model->all();
        return $positions;
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }
}