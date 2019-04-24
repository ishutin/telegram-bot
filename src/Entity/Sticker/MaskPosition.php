<?php

namespace Telegram\Entity\Sticker;

class MaskPosition
{
    /**
     * @var string
     */
    private $point;

    /**
     * @var float
     */
    private $xShift;

    /**
     * @var float
     */
    private $yShift;

    /**
     * @var float
     */
    private $scale;

    public function __construct(string $point, float $xShift, float $yShift, float $scale)
    {
        $this->point = $point;
        $this->xShift = $xShift;
        $this->yShift = $yShift;
        $this->scale = $scale;
    }

    /**
     * @return string
     */
    public function getPoint(): string
    {
        return $this->point;
    }

    /**
     * @return float
     */
    public function getXShift(): float
    {
        return $this->xShift;
    }

    /**
     * @return float
     */
    public function getYShift(): float
    {
        return $this->yShift;
    }

    /**
     * @return float
     */
    public function getScale(): float
    {
        return $this->scale;
    }


}
