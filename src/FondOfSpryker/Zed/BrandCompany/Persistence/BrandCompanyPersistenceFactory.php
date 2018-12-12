<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class BrandCompanyPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\BrandCompany\Persistence\SpyBrandCompanyQuery
     */
    public function createBrandCompanyQuery(): SpyBrandCompanyQuery
    {
        return SpyBrandCompanyQuery::create();
    }
}
