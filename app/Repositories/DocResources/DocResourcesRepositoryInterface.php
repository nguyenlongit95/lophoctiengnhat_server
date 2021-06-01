<?php

namespace App\Repositories\DocResources;

interface DocResourcesRepositoryInterface
{
    /**
     * @param $docResource
     * @param $eWalletDetail
     * @return mixed
     */
    public function checkPurchase($docResource, $eWalletDetail);
    /**
     * @param $documentationID
     * @return mixed
     */
    public function getDocumentation($documentationID);

    /**
     * @param $request
     * @return mixed
     */
    public function checkFileSource($request);

    /**
     * @param $request
     * @return mixed
     */
    public function updateFileSource($request);
}
