<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation;

use FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

class CompanyBrandRelationWriter implements CompanyBrandRelationWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation\CompanyBrandRelationReaderInterface
     */
    protected $companyBrandRelationReader;

    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface
     */
    protected $brandCompanyEntityManager;

    /**
     * @param \FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation\CompanyBrandRelationReaderInterface $companyBrandRelationReader
     * @param \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface $brandCompanyEntityManager
     */
    public function __construct(
        CompanyBrandRelationReaderInterface $companyBrandRelationReader,
        BrandCompanyEntityManagerInterface $brandCompanyEntityManager
    ) {
        $this->companyBrandRelationReader = $companyBrandRelationReader;
        $this->brandCompanyEntityManager = $brandCompanyEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer|null $companyBrandRelationTransfer
     *
     * @return void
     */
    public function saveCompanyBrandRelation(CompanyBrandRelationTransfer $companyBrandRelationTransfer = null): void
    {
        if ($companyBrandRelationTransfer === null) {
            return;
        }

        $companyBrandRelationTransfer->requireIdCompany();
        $currentIdBrands = $this->getIdBrandsByIdCompany($companyBrandRelationTransfer->getIdCompany());
        $requestedIdBrands = $this->findBrandRelationIdBrands($companyBrandRelationTransfer);

        if (count($requestedIdBrands) === 0) {
            return;
        }

        $saveIdBrands = array_diff($requestedIdBrands, $currentIdBrands);
        $deleteIdBrands = array_diff($currentIdBrands, $requestedIdBrands);

        $this->brandCompanyEntityManager->addBrands($saveIdBrands, $companyBrandRelationTransfer->getIdCompany());
        $this->brandCompanyEntityManager->removeBrands($deleteIdBrands, $companyBrandRelationTransfer->getIdCompany());
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return int[]
     */
    protected function findStoreRelationIdStores(CompanyBrandRelationTransfer $companyBrandRelationTransfer): array
    {
        if ($companyBrandRelationTransfer->getIdBrands() === null) {
            return [];
        }

        return $companyBrandRelationTransfer->getIdBrands();
    }

    /**
     * @param int $idCompany
     *
     * @return array
     */
    protected function getIdBrandsByIdCompany($idCompany): array
    {
        $companyBrandRelationTransfer = new CompanyBrandRelationTransfer();
        $companyBrandRelationTransfer->setIdCompany($idCompany);
        $companyBrandRelations = $this->companyBrandRelationReader->getCompanyBrandRelation($companyBrandRelationTransfer);

        $idBrands = [];

        foreach ($companyBrandRelations->getBrands() as $brand) {
            $idBrands[] = $brand->getIdBrand();
        }

        return $idBrands;
    }
}
