<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\Model;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface BrandCompanyRelationWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer|null $companyBrandRelationTransfer
     *
     * @return void
     */
    public function saveCompanyBrandRelation(?CompanyBrandRelationTransfer $companyBrandRelationTransfer = null): void;
}
