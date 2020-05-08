<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserSession\StoreUserSessionRequest;
use App\Http\Requests\UserSession\BulkUserSessionRequest;
use App\Http\Requests\UserSession\BulkDeleteUserSessionRequest;
use App\Http\Requests\UserSession\UpdateUserSessionRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use Storage;
use ApiResponse;
use Carbon\Carbon;
use App\Transformers\UserSessionTransformer;
use App\Repositories\UserSession\IUserSessionRepo;

/**
 * @resource UserSession
 */
class UserSessionController extends ResourceController
{
    public function __construct(
        IUserSessionRepo $repo,
        UserSessionTransformer $transformer
    ) {
        parent::__construct($repo, $transformer);

        $this->middleware(
            'owns.usersession',
            ['only' => ['update', 'destroy']]
        );
    }
    
    /**
     * Create item
     *
     * Store a newly created item in storage.
     *
     * @param  App\Http\Requests\StoreUserSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserSessionRequest $request)
    {
        $data = $request->only(array_intersect(array_keys($request->rules()), $this->repo->getModel()->getFillable()));

        $data["user_id"] = JWTAuth::parseToken()->toUser()->id;
    
        return $this->storeItem($data);
    }

    /**
     * Update item
     *
     * Update the specified item in storage.
     *
     * @param  App\Http\Requests\UpdateUserSessionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserSessionRequest $request, $id)
    {
        $data = $request->only(array_intersect(array_keys($request->rules()), $this->repo->getModel()->getFillable()));

        $data["user_id"] = JWTAuth::parseToken()->toUser()->id;
    
        return $this->updateItem($data, $id);
    }

    /**
     * Remove item
     *
     * Remove the specified item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($item = $this->repo->find($id)) {
                $item->delete($id);
                return ApiResponse::ItemDeleted($this->repo->getModel());
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
        
        return ApiResponse::ItemNotFound($this->repo->getModel());
    }

    /**
     * Bulk Insert
     *
     * Bulk insert multiple resources
     *
     * @param  App\Http\Requests\BulkUserSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkInsert(BulkUserSessionRequest $request)
    {
        try {
            $input = $request->data;
            $data = [];
            $fillable = array_flip(array_map('value', $this->repo->getModel()->getFillable()));

            foreach ($input as $item) {
                //removing keys which are not fillable!
                $row = array_intersect_key($item, $fillable);
                $row['created_at'] = $row['updated_at'] = Carbon::now();

                $data[] = $row;
            }

            $this->repo->bulk($data);

            return ApiResponse::SuccessMessage(trans('dinkoapi.response_message.succesfully_created'));
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }

    /**
     * Bulk Delete
     *
     * Bulk delete multiple resources
     *
     * @param  App\Http\Requests\BulkUserSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(BulkDeleteUserSessionRequest $request)
    {
        try {
            $input = $request->data;
            foreach ($input as $item) {
                $id = $item['id'];
                if ($this->repo->find($id)) {
                    $this->repo->delete($id);
                }
            }

            return ApiResponse::SuccessMessage(trans('dinkoapi.response_message.succesfully_deleted'));
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
    }
}
