<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use Orm\Zed\BrandCompany\Persistence\FosBrandCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class BrandCompanyPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\BrandCompany\Persistence\FosBrandCompanyQuery
     */
    public function createBrandCompanyQuery(): FosBrandCompanyQuery
    {
        return FosBrandCompanyQuery::create();
    }
}
