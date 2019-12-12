<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\Model;

use FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

class BrandCompanyRelationWriter implements BrandCompanyRelationWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationReaderInterface
     */
    protected $companyBrandRelationReader;

    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface
     */
    protected $brandCompanyEntityManager;

    /**
     * @param \FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationReaderInterface $brandCompanyRelationReader
     * @param \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface $brandCompanyEntityManager
     */
    public function __construct(
        BrandCompanyRelationReaderInterface $brandCompanyRelationReader,
        BrandCompanyEntityManagerInterface $brandCompanyEntityManager
    ) {
        $this->companyBrandRelationReader = $brandCompanyRelationReader;
        $this->brandCompanyEntityManager = $brandCompanyEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer|null $companyBrandRelationTransfer
     *
     * @return void
     */
    public function saveCompanyBrandRelation(?CompanyBrandRelationTransfer $companyBrandRelationTransfer = null): void
    {
        if ($companyBrandRelationTransfer === null) {
            return;
        }

        $companyBrandRelationTransfer->requireIdCompany();
        $currentIdBrands = $this->getIdBrandsByIdCompany($companyBrandRelationTransfer->getIdCompany());
        $requestedIdBrands = $this->findCompanyBrandRelationIdBrands($companyBrandRelationTransfer);

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
    protected function findCompanyBrandRelationIdBrands(CompanyBrandRelationTransfer $companyBrandRelationTransfer): array
    {
        return $companyBrandRelationTransfer->getIdBrands();
    }

    /**
     * @param int $idCompany
     *
     * @return int[]
     */
    protected function getIdBrandsByIdCompany(int $idCompany): array
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
