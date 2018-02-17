<?php
/**
 * Created by PhpStorm.
 * User: ishutin
 * Date: 2/17/18
 * Time: 9:43 PM
 */

namespace Telegram\Entity\Traits;


trait FileTrait
{
    /**
     * @var string
     */
    protected $fileId;

    public function getFileId(): string
    {
        return $this->fileId;
    }
}