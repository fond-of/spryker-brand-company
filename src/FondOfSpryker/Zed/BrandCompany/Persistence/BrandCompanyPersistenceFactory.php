<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use Orm\Zed\BrandCompany\Persistence\FosBrandCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyRepositoryInterface getRepository()
 */
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
