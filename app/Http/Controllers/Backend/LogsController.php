<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Validators\LogValidator;
use App\Http\Requests\LogCreateRequest;
use App\Http\Requests\LogUpdateRequest;
use App\Repositories\Contracts\LogRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class LogsController extends Controller
{

    /**
     * @var LogRepository
     */
    protected $repository;

    /**
     * @var LogValidator
     */
    protected $validator;

    public function __construct(LogRepository $repository, LogValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $logs = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $logs,
            ]);
        }

        return view('logs.index', compact('logs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LogCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LogCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $log = $this->repository->create($request->all());

            $response = [
                'message' => 'Log created.',
                'data'    => $log->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $log,
            ]);
        }

        return view('logs.show', compact('log'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $log = $this->repository->find($id);

        return view('logs.edit', compact('log'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  LogUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(LogUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $log = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Log updated.',
                'data'    => $log->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Log deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Log deleted.');
    }
}
