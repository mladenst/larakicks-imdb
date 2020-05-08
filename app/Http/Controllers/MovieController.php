<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\BulkMovieRequest;
use App\Http\Requests\Movie\BulkDeleteMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dinkara\DinkoApi\Http\Controllers\ResourceController;
use Storage;
use ApiResponse;
use Carbon\Carbon;
use App\Transformers\MovieTransformer;
use App\Transformers\ActorTransformer;
use App\Transformers\DirectorTransformer;
use App\Transformers\UserTransformer;
use App\Http\Requests\Movie\MovieAttachActorRequest;
use App\Http\Requests\Movie\MovieAttachDirectorRequest;
use App\Repositories\Movie\IMovieRepo;
use App\Repositories\Actor\IActorRepo;
use App\Repositories\Director\IDirectorRepo;

/**
 * @resource Movie
 */
class MovieController extends ResourceController
{
    public function __construct(
        IMovieRepo $repo,
        MovieTransformer $transformer,
        IActorRepo $actorRepo,
        IDirectorRepo $directorRepo
    ) {
        parent::__construct($repo, $transformer);
        $this->actorRepo = $actorRepo;
        $this->directorRepo = $directorRepo;

        $this->middleware(
            'exists.movie',
            ['only' => ['attachActor', 'detachActor']]
        );
        $this->middleware(
            'exists.actor:actor_id,true',
            ['only' => ['attachActor', 'detachActor']]
        );
        $this->middleware(
            'exists.movie',
            ['only' => ['attachDirector', 'detachDirector']]
        );
        $this->middleware(
            'exists.director:director_id,true',
            ['only' => ['attachDirector', 'detachDirector']]
        );
    }
    
    /**
     * Create item
     *
     * Store a newly created item in storage.
     *
     * @param  App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        $data = $request->only(array_intersect(array_keys($request->rules()), $this->repo->getModel()->getFillable()));

        return $this->storeItem($data);
    }

    /**
     * Update item
     *
     * Update the specified item in storage.
     *
     * @param  App\Http\Requests\UpdateMovieRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, $id)
    {
        $data = $request->only(array_intersect(array_keys($request->rules()), $this->repo->getModel()->getFillable()));

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
     * @param  App\Http\Requests\BulkMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkInsert(BulkMovieRequest $request)
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
     * @param  App\Http\Requests\BulkMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(BulkDeleteMovieRequest $request)
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

    /**
     * Search Actors for Movie with given $id
     *
     * Actors from existing resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function searchActors(Request $request, $id)
    {
        try {
            if ($item = $this->repo->find($id)) {
                return ApiResponse::Pagination(
                    $this->actorRepo->restSearch($request, $item->actors(null)),
                    new ActorTransformer
                );
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
        return ApiResponse::ItemNotFound($this->repo->getModel());
    }
    /**
     * Search Directors for Movie with given $id
     *
     * Directors from existing resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function searchDirectors(Request $request, $id)
    {
        try {
            if ($item = $this->repo->find($id)) {
                return ApiResponse::Pagination(
                    $this->directorRepo->restSearch($request, $item->directors(null)),
                    new DirectorTransformer
                );
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
        return ApiResponse::ItemNotFound($this->repo->getModel());
    }
    /**
     * Search FavoritedUsers for Movie with given $id
     *
     * FavoritedUsers from existing resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function searchFavoritedUsers(Request $request, $id)
    {
        try {
            if ($item = $this->repo->find($id)) {
                return ApiResponse::Pagination(
                    $this->userRepo->restSearch($request, $item->favoritedUsers(null)),
                    new UserTransformer
                );
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
        return ApiResponse::ItemNotFound($this->repo->getModel());
    }
    /**
     * Search WishlistedUsers for Movie with given $id
     *
     * WishlistedUsers from existing resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return Dinkara\DinkoApi\Support\ApiResponse
     */
    public function searchWishlistedUsers(Request $request, $id)
    {
        try {
            if ($item = $this->repo->find($id)) {
                return ApiResponse::Pagination(
                    $this->userRepo->restSearch($request, $item->wishlistedUsers(null)),
                    new UserTransformer
                );
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }
        return ApiResponse::ItemNotFound($this->repo->getModel());
    }

    /**
     * Attach Actor
     *
     * Attach the Actor to existing resource.
     *
     * @param  MovieAttachActorRequest  $request
     * @param  int  $id
     * @param  int  $actor_id
     * @return \Illuminate\Http\Response
     */
    public function attachActor(MovieAttachActorRequest $request, $id, $actor_id)
    {
        try {
            if ($item = $this->actorRepo->find($actor_id)) {
                $data = $request->only(array_keys($request->rules()));

                $model = $item->getModel();

                return ApiResponse::ItemAttached(
                    $this->repo->find($id)->attachActor($model, $data)->getModel(),
                    $this->transformer
                );
            } else {
                return ApiResponse::ItemNotFound($this->actorRepo->getModel());
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }

        return ApiResponse::ItemNotFound($this->repo->getModel());
    }

    /**
     * Attach Director
     *
     * Attach the Director to existing resource.
     *
     * @param  MovieAttachDirectorRequest  $request
     * @param  int  $id
     * @param  int  $director_id
     * @return \Illuminate\Http\Response
     */
    public function attachDirector(MovieAttachDirectorRequest $request, $id, $director_id)
    {
        try {
            if ($item = $this->directorRepo->find($director_id)) {
                $data = $request->only(array_keys($request->rules()));

                $model = $item->getModel();

                return ApiResponse::ItemAttached(
                    $this->repo->find($id)->attachDirector($model, $data)->getModel(),
                    $this->transformer
                );
            } else {
                return ApiResponse::ItemNotFound($this->directorRepo->getModel());
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }

        return ApiResponse::ItemNotFound($this->repo->getModel());
    }

    /**
     * Detach Actor
     *
     * Detach the Actor from existing resource.
     *
     * @param  int  $id
     * @param  int  $actor_id
     * @return \Illuminate\Http\Response
     */
    public function detachActor($id, $actor_id)
    {
        try {
            if ($item = $this->actorRepo->find($actor_id)) {
                $model = $item->getModel();

                return ApiResponse::ItemDetached($this->repo->find($id)->detachActor($model)->getModel());
            } else {
                return ApiResponse::ItemNotFound($this->actorRepo->getModel());
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }

        return ApiResponse::ItemNotFound($this->repo->getModel());
    }
    /**
     * Detach Director
     *
     * Detach the Director from existing resource.
     *
     * @param  int  $id
     * @param  int  $director_id
     * @return \Illuminate\Http\Response
     */
    public function detachDirector($id, $director_id)
    {
        try {
            if ($item = $this->directorRepo->find($director_id)) {
                $model = $item->getModel();

                return ApiResponse::ItemDetached($this->repo->find($id)->detachDirector($model)->getModel());
            } else {
                return ApiResponse::ItemNotFound($this->directorRepo->getModel());
            }
        } catch (QueryException $e) {
            return ApiResponse::InternalError($e->getMessage());
        }

        return ApiResponse::ItemNotFound($this->repo->getModel());
    }
}
