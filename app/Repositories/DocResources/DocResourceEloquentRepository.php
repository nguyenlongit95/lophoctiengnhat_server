<?php

namespace App\Repositories\DocResources;

use App\Models\DocResource;
use App\Repositories\Eloquent\EloquentRepository;
use mysql_xdevapi\Collection;

class DocResourceEloquentRepository extends EloquentRepository implements DocResourcesRepositoryInterface
{

    const SOURCE_PATH_SOURCE = '/source/documentation/';
    /**
     * @return mixed
     */
    public function getModel()
    {
        return DocResource::class;
    }

    /**
     * Function check purchase doc_resource
     *
     * @param object $docResource
     * @param object $eWalletDetail
     * @return array
     */
    public function checkPurchase($docResource, $eWalletDetail)
    {
        if (empty($eWalletDetail)) {
            return null;
        }
        $countDocPurchase = [];
        foreach ($eWalletDetail as $detail) {
            if ($detail->code_charge === $docResource->code) {
                array_push($countDocPurchase, $docResource->code);
            }
        }

        return $countDocPurchase;
    }

    /**
     * @param $documentationID
     * @return mixed
     */
    public function getDocumentation($documentationID) {
        $docResource = $this->_model->where('doc_id', $documentationID->id)->orderBy('id', 'ASC')->get();
        return $docResource;
    }

    /**
     * @param $request
     * @return array|\Illuminate\Config\Repository|mixed
     */
    public function checkFileSource($request)
    {
        // Check file source
        if ($request->file('url_source')->getClientOriginalExtension() == 'pdf' ||
            $request->file('url_source')->getClientOriginalExtension() == 'docx' ||
            $request->file('url_source')->getClientOriginalExtension() == 'doc'
        ) {
            $arrSourcePath = self::SOURCE_PATH_SOURCE.$request->file('url_source')->getClientOriginalName();
            $request->file('url_source')->move(public_path(self::SOURCE_PATH_SOURCE),
                $request->file('url_source')->getClientOriginalName());
        } else {
            return config('langVN.err_Extension');
        }

        return $arrSourcePath;
    }

    /**
     * @param $request
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function updateFileSource($request)
    {
        if ($request->file('url_source')->getClientOriginalExtension() == 'pdf' ||
            $request->file('url_source')->getClientOriginalExtension() == 'docx' ||
            $request->file('url_source')->getClientOriginalExtension() == 'doc') {
            $arrSourcePath = self::SOURCE_PATH_SOURCE.$request->file('url_source')->getClientOriginalName();
            $request->file('url_source')->move(public_path(self::SOURCE_PATH_SOURCE),
                $request->file('url_source')->getClientOriginalName());
        } else {
            return config('langVN.err_Extension');
        }

        return $arrSourcePath;
    }

    /**
     * Function delete file sound after destroy an source
     *
     * @param $src
     * @return mixed|void
     */
    public function deleteFileSound($src)
    {
        if ($src == null) {
            return false;
        }

        if (!file_exists(asset($src))) {
            return false;
        }

        return true;
    }
}
