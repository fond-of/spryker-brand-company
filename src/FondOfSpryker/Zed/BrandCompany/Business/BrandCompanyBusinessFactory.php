<?php

namespace FondOfSpryker\Zed\BrandCompany\Business;

use FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation\CompanyBrandRelationReader;
use FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation\CompanyBrandRelationReaderInterface;
use FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation\CompanyBrandRelationWriter;
use FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation\CompanyBrandRelationWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface getEntityManager()()
 */
class BrandCompanyBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation\CompanyBrandRelationWriterInterface
     */
    public function createCompanyBrandRelationWriter(): CompanyBrandRelationWriterInterface
    {
        return new CompanyBrandRelationWriter(
            $this->createCompanyBrandRelationReader(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation\CompanyBrandRelationReaderInterface
     */
    public function createCompanyBrandRelationReader(): CompanyBrandRelationReaderInterface
    {
        return new CompanyBrandRelationReader(
            $this->getRepository()
        );
    }
}
