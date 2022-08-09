<?php

namespace FondOfSpryker\Zed\BrandCompany\Business;

use FondOfSpryker\Zed\BrandCompany\Business\Expander\BrandExpander;
use FondOfSpryker\Zed\BrandCompany\Business\Expander\BrandExpanderInterface;
use FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationReader;
use FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationReaderInterface;
use FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationWriter;
use FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface getEntityManager()()
 */
class BrandCompanyBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationWriterInterface
     */
    public function createBrandCompanyRelationWriter(): BrandCompanyRelationWriterInterface
    {
        return new BrandCompanyRelationWriter(
            $this->createBrandCompanyRelationReader(),
            $this->getEntityManager(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationReaderInterface
     */
    public function createBrandCompanyRelationReader(): BrandCompanyRelationReaderInterface
    {
        return new BrandCompanyRelationReader(
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\BrandCompany\Business\Expander\BrandExpanderInterface
     */
    public function createBrandExpander(): BrandExpanderInterface
    {
        return new BrandExpander($this->createBrandCompanyRelationReader());
    }
}
