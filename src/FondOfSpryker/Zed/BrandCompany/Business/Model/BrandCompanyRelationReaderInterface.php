<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\Model;

use Generated\Shared\Transfer\BrandCompanyRelationTransfer;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface BrandCompanyRelationReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function getCompanyBrandRelation(CompanyBrandRelationTransfer $companyBrandRelationTransfer): CompanyBrandRelationTransfer;

    /**
     * @param \Generated\Shared\Transfer\BrandCompanyRelationTransfer $brandCompanyRelationTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCompanyRelationTransfer
     */
    public function getBrandCompanyRelation(
        BrandCompanyRelationTransfer $brandCompanyRelationTransfer
    ): BrandCompanyRelationTransfer;
}
