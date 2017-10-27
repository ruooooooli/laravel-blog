<?php

namespace App\Repositories\Eloquent;

use App\Models\Log;
use App\Validators\LogValidator;
use App\Repositories\Contracts\LogRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class LogRepositoryEloquent extends BaseRepository implements LogRepository
{
    public function model()
    {
        return Log::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
