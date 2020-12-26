<?php


namespace App\Repository\Skill;


use App\Models\Skill;
use App\Repository\BaseRepository;

class SkillRepository extends BaseRepository implements ISkillRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        // TODO: Implement model() method.
        return Skill::class;
    }

    public function getAll(array $columns = ['*'])
    {
        // TODO: Implement getAll() method.
    }

    public function getListSkills()
    {
        // TODO: Implement getListSkills() method.
        return $this->model->all();
    }
}