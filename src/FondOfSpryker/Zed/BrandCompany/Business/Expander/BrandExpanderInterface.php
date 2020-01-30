<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\Expander;

use Generated\Shared\Transfer\BrandTransfer;

interface BrandExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function expandBrandTransferWithCompanyRelation(BrandTransfer $brandTransfer): BrandTransfer;
}
