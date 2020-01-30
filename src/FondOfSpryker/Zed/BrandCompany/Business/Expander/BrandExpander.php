<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\Expander;

use FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationReaderInterface;
use Generated\Shared\Transfer\BrandCompanyRelationTransfer;
use Generated\Shared\Transfer\BrandTransfer;

class BrandExpander implements BrandExpanderInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationReaderInterface
     */
    protected $brandCompanyRelationReader;

    public function __construct(BrandCompanyRelationReaderInterface $brandCompanyRelationReader)
    {
        $this->brandCompanyRelationReader = $brandCompanyRelationReader;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function expandBrandTransferWithCompanyRelation(BrandTransfer $brandTransfer): BrandTransfer
    {
        $brandCompanyRelationTransfer = (new BrandCompanyRelationTransfer())->setIdBrand($brandTransfer->getIdBrand());
        $brandTransfer->setBrandCompanyRelation($brandCompanyRelationTransfer);

        $brandCompanyRelationTransfer = $this->brandCompanyRelationReader
            ->getBrandCompanyRelation($brandTransfer->getBrandCompanyRelation());

        $this->addBrandsToCompanyTransfer($brandTransfer, $brandCompanyRelationTransfer);

        return $brandTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Generated\Shared\Transfer\BrandCustomerRelationTransfer $brandCustomerRelationTransfer
     *
     * @return void
     */
    protected function addBrandsToCompanyTransfer(
        BrandTransfer $brandTransfer,
        BrandCompanyRelationTransfer $brandCompanyRelationTransfer
    ): void {
        $brandTransfer->setBrandCompanyRelation($brandCompanyRelationTransfer);
    }
}
