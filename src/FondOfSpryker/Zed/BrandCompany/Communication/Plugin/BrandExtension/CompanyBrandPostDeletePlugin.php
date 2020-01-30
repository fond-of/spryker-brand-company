<?php

namespace FondOfSpryker\Zed\BrandCompany\Communication\Plugin\BrandExtension;

use FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\BrandPostDeletePluginInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\BrandCompany\BrandCompanyConfig getConfig()
 */
class CompanyBrandPostDeletePlugin extends AbstractPlugin implements BrandPostDeletePluginInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function execute(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        return $this->getFacade()->deleteBrandCompanyRelation($brandTransfer);
    }
}
