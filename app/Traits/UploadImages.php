<?php

namespace App\Traits;

use App\Facade\Tenant;
use Illuminate\Support\Str;

trait UploadImages
{


    private $imageName;

    private $pathName;

    private $ImagefolderName;

    private $imageExt;

    private $disk = 'public';

    public function getRootFolderName()
    {
        return Tenant::getName();
    }


    public function setImageExt()
    {

        return $this->imageExt = '.png';
    }
    public function setImageName($image)
    {

        $this->imageName = now() . "_" . Str::random(10);
    }

    public function uploadImage($image, $ImagefolderName)
    {
        return $image->store($this->getRootFolderName() . '/' . $ImagefolderName, $this->disk);
    }
}
