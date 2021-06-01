<?php

namespace App\Repositories\CourseLevelSources;

interface CourseLevelSourcesRepositoryInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function checkFileSound($request);

    /**
     * @param $course
     * @return mixed
     */
    public function getSource($course);

    /**
     * @param $sources
     * @return mixed
     */
    public function parseDataSource($sources);

    /**
     * @param $request
     * @param $type
     * @return mixed
     */
    public function updateFileSound($request, $type);

    /**
     * @param $src
     * @return mixed
     */
    public function deleteFileSound($src);
}
