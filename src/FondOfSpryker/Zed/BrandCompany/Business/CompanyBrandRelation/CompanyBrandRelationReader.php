<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation;

use FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyRepositoryInterface;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

class CompanyBrandRelationReader implements CompanyBrandRelationReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyRepositoryInterface
     */
    protected $brandCompanyRepository;

    /**
     * @param \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyRepositoryInterface $brandCompanyRepository
     */
    public function __construct(BrandCompanyRepositoryInterface $brandCompanyRepository)
    {
        $this->brandCompanyRepository = $brandCompanyRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function getCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer {
        $companyBrandRelationTransfer->requireIdCompany();
        $relatedBrands = $this->brandCompanyRepository->getRelatedBrandsByCompanyId(
            $companyBrandRelationTransfer->getIdCompany()
        );

        $idBrands = $this->getIdBrands($relatedBrands);

        $companyBrandRelationTransfer
            ->setBrands($relatedBrands)
            ->setIdBrands($idBrands);

        return $companyBrandRelationTransfer;
    }

    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\BrandTransfer[] $relatedBrands
     *
     * @return int[]
     */
    protected function getIdBrands(array $relatedBrands): array
    {
        return array_map(function (BrandTransfer $brandTransfer) {
            return $brandTransfer->getIdBrand();
        }, $relatedBrands->getArrayCopy());
    }
}
