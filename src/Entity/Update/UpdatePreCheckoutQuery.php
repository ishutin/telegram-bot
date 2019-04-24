<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\Payment\PreCheckoutQuery;

class UpdatePreCheckoutQuery extends Update
{
    public function getPreCheckoutQuery(): PreCheckoutQuery
    {
        return parent::getPreCheckoutQuery();
    }
}
