<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface CompanyBrandRelationReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function getCompanyBrandRelation(CompanyBrandRelationTransfer $companyBrandRelationTransfer): CompanyBrandRelationTransfer;
}
