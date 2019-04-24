<?php

namespace Telegram\Entity\Update;

use Telegram\Entity\Payment\ShippingQuery;

class UpdateShippingQuery extends Update
{
    public function getShippingQuery(): ShippingQuery
    {
        return parent::getShippingQuery();
    }
}
