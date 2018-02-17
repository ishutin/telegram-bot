<?php
/**
 * Created by PhpStorm.
 * User: ishutin
 * Date: 2/17/18
 * Time: 9:44 PM
 */

namespace Telegram\Entity\Traits;


trait FileWidthAndHeightTrait
{
    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}