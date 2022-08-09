<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\Model;

use ArrayObject;
use FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyRepositoryInterface;
use Generated\Shared\Transfer\BrandCompanyRelationTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

class BrandCompanyRelationReader implements BrandCompanyRelationReaderInterface
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
        $relatedBrands = $this->brandCompanyRepository->getRelatedBrandsByIdCompany(
            $companyBrandRelationTransfer->getIdCompany(),
        );

        $idBrands = $this->getIdBrands($relatedBrands);

        $companyBrandRelationTransfer
            ->setBrands($relatedBrands)
            ->setIdBrands($idBrands);

        return $companyBrandRelationTransfer;
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\BrandTransfer> $relatedBrands
     *
     * @return array<int>
     */
    protected function getIdBrands(ArrayObject $relatedBrands): array
    {
        return array_map(function (BrandTransfer $brandTransfer) {
            return $brandTransfer->getIdBrand();
        }, $relatedBrands->getArrayCopy());
    }

    /**
     * @param \Generated\Shared\Transfer\BrandCompanyRelationTransfer $brandCompanyRelationTransfer
     *
     * @return \Generated\Shared\Transfer\BrandCompanyRelationTransfer
     */
    public function getBrandCompanyRelation(
        BrandCompanyRelationTransfer $brandCompanyRelationTransfer
    ): BrandCompanyRelationTransfer {
        $brandCompanyRelationTransfer->requireIdBrand();
        $companyIds = $this->brandCompanyRepository->getRelatedCompanyIdsByIdBrand($brandCompanyRelationTransfer->getIdBrand());
        $brandCompanyRelationTransfer->setCompanyIds($companyIds);

        return $brandCompanyRelationTransfer;
    }
}
