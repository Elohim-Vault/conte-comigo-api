<?php


namespace App\Repositories;

use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class GoalRepository
{
    private $model;

    public function __construct(Goal $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return Auth::user()->goals;
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::id();
        return $this->model->create($data);
    }



    public function update_currente_value($goal)
    {
        return $this->model->where('user_id', '=', Auth::id())
        ->where("id", $goal->id)
        ->increment('current_value', $value);
    }

    public function paginate(int $quantity)
    {
        return $this->model->where('user_id', '=', Auth::id())->orderBy('deadline', 'ASC')->simplePaginate($quantity);
    }
}
