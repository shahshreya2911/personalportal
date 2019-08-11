<?php

namespace Vanguard\Repositories\Questions;

use App\Models\Questions;
use Carbon\Carbon;
use DB;
use Illuminate\Database\SQLiteConnection;

class EloquentQuestions implements QuestionsRepository
{

    public function __construct()
    {
        
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Questions::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        return Questions::create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Questions::query();

        if ($status) {
            $query->where('active', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('sentence', "like", "%{$search}%");
                $q->orWhere('level', 'like', "%{$search}%");
            });
        }

        $result = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        if ($status) {
            $result->appends(['status' => $status]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        if (isset($data['country_id']) && $data['country_id'] == 0) {
            $data['country_id'] = null;
        }

        $user = $this->find($id);

        $user->update($data);

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $user = $this->find($id);

        return $user->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return Questions::count();
    }

    /**
     * {@inheritdoc}
     */
    public function latest($count = 20)
    {
        return Questions::orderBy('created_at', 'DESC')
            ->limit($count)
            ->get();
    }

}
