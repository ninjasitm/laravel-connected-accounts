<?php

namespace Nitm\ConnectedAccounts\Http\Controllers\API;

use Nitm\ConnectedAccounts\Http\Requests\API\CreateSocialProviderAPIRequest;
use Nitm\ConnectedAccounts\Http\Requests\API\UpdateSocialProviderAPIRequest;
use Nitm\ConnectedAccounts\Models\SocialProvider;
use Nitm\ConnectedAccounts\Repositories\SocialProviderRepository;
use Nitm\ConnectedAccounts\Http\Controllers\API\ApiController;
use Nitm\ConnectedAccounts\Http\Resources\SocialProviderResource;
use Illuminate\Http\Request;
use Response;

/**
 * Class SocialProviderController
 *
 * Used for documentation only!
 *
 * @package App\Http\Controllers\API
 */

class SocialProviderAPIController extends ApiController
{
    /**
     * Get the repository class
     *
     * @return string
     */
    public function repository()
    {
        return SocialProviderRepository::class;
    }

    /**
     * @param  Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/auth/connected-accounts",
     *      summary="Get a listing of the SocialProviders.",
     *      tags={"Auth: SocialProvider"},
     *      description="Get all SocialProviders",
     *      produces={"application/json"},
     *      security={{"Bearer":{}}},
     * @SWG\Response(
     *          response=200,
     *          description="successful operation",
     * @SWG\Schema(
     *              type="object",
     * @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     * @SWG\Property(
     *                  property="data",
     *                  type="array",
     * @SWG\Items(ref="#/definitions/SocialProvider")
     *              ),
     * @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
    }

    /**
     * @param  CreateSocialProviderAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/api/auth/connected-accounts",
     *      summary="Store a newly created SocialProvider in storage",
     *      tags={"Auth: SocialProvider"},
     *      description="Store SocialProvider",
     *      produces={"application/json"},
     *      security={{"Bearer":{}}},
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SocialProvider that should be stored",
     *          required=false,
     * @SWG\Schema(ref="#/definitions/SocialProvider")
     *      ),
     * @SWG\Response(
     *          response=200,
     *          description="successful operation",
     * @SWG\Schema(
     *              type="object",
     * @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     * @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/SocialProvider"
     *              ),
     * @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSocialProviderAPIRequest $request)
    {
    }

    /**
     * @param  int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/auth/connected-accounts/{id}",
     *      summary="Display the specified SocialProvider",
     *      tags={"Auth: SocialProvider"},
     *      description="Get SocialProvider",
     *      produces={"application/json"},
     *      security={{"Bearer":{}}},
     * @SWG\Parameter(
     *          name="id",
     *          description="id of SocialProvider",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     * @SWG\Response(
     *          response=200,
     *          description="successful operation",
     * @SWG\Schema(
     *              type="object",
     * @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     * @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/SocialProvider"
     *              ),
     * @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show(Request $request, $id)
    {
    }

    /**
     * @param  int                            $id
     * @param  UpdateSocialProviderAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/api/auth/connected-accounts/{id}",
     *      summary="Update the specified SocialProvider in storage",
     *      tags={"Auth: SocialProvider"},
     *      description="Update SocialProvider",
     *      produces={"application/json"},
     *      security={{"Bearer":{}}},
     * @SWG\Parameter(
     *          name="id",
     *          description="id of SocialProvider",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SocialProvider that should be updated",
     *          required=false,
     * @SWG\Schema(ref="#/definitions/SocialProvider")
     *      ),
     * @SWG\Response(
     *          response=200,
     *          description="successful operation",
     * @SWG\Schema(
     *              type="object",
     * @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     * @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/SocialProvider"
     *              ),
     * @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update(UpdateSocialProviderAPIRequest $request, $id)
    {
    }

    /**
     * @param  int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/api/auth/connected-accounts/{id}",
     *      summary="Remove the specified SocialProvider from storage",
     *      tags={"Auth: SocialProvider"},
     *      description="Delete SocialProvider",
     *      produces={"application/json"},
     *      security={{"Bearer":{}}},
     * @SWG\Parameter(
     *          name="id",
     *          description="id of SocialProvider",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     * @SWG\Response(
     *          response=200,
     *          description="successful operation",
     * @SWG\Schema(
     *              type="object",
     * @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     * @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     * @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy(Request $request, $id)
    {
    }
}
