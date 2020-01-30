<?php

namespace FondOfSpryker\Zed\BrandCompany\Business\Model;

use FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManagerInterface;
use Generated\Shared\Transfer\BrandCompanyRelationTransfer;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class BrandCompanyRelationWriter implements BrandCompanyRelationWriterInterface
{
    use TransactionTrait;

    protected const MESSAGE_BRAND_DELETE_SUCCESS = 'Brand has been successfully removed.';

    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationReaderInterface
     */
    protected $brandCompanyRelationReader;

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
        $this->brandCompanyRelationReader = $brandCompanyRelationReader;
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
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function saveBrandCompanyRelation(BrandTransfer $brandTransfer): BrandTransfer
    {
        return $this->getTransactionHandler()->handleTransaction(function () use ($brandTransfer) {
            return $this->executeSaveBrandCompanyRelationTransaction($brandTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    protected function executeSaveBrandCompanyRelationTransaction(BrandTransfer $brandTransfer): BrandTransfer
    {
        $brandTransfer->requireIdBrand();
        $idBrand = $brandTransfer->getIdBrand();
        $brandCompanyRelationTransfer = $brandTransfer->getBrandCompanyRelation();

        if ($brandCompanyRelationTransfer->getIdBrand() == null) {
            $brandCompanyRelationTransfer->setIdBrand($idBrand);
        }

        $requestedCompanyIds = $this->getRequestedCompanyIds($brandCompanyRelationTransfer);
        $currentCompanyIds = $this->getRelatedCompanyIds($brandCompanyRelationTransfer);

        $saveCompanyIds = array_diff($requestedCompanyIds, $currentCompanyIds);
        $deleteCompanyIds = array_diff($currentCompanyIds, $requestedCompanyIds);

        $this->brandCompanyEntityManager->addCompanyRelations($idBrand, $saveCompanyIds);
        $this->brandCompanyEntityManager->removeCompanyRelations($idBrand, $deleteCompanyIds);

        $brandCompanyRelationTransfer->setCompanyIds(
            $this->getRelatedCompanyIds($brandCompanyRelationTransfer)
        );

        return $brandTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function deleteBrandCompanyRelation(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        $brandResponseTransfer = (new BrandResponseTransfer())
            ->setBrand($brandTransfer)
            ->setIsSuccessful(true);

        return $this->getTransactionHandler()->handleTransaction(function () use ($brandTransfer, $brandResponseTransfer) {
            return $this->executeDeleteBrandCompanyRelationTransaction($brandTransfer, $brandResponseTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected function executeDeleteBrandCompanyRelationTransaction(
        BrandTransfer $brandTransfer,
        BrandResponseTransfer $brandResponseTransfer
    ): BrandResponseTransfer {

        $this->brandCompanyEntityManager->deleteBrandCompanyRelation($brandTransfer);

        $brandResponseTransfer->addMessage(
            (new MessageTransfer())->setValue(static::MESSAGE_BRAND_DELETE_SUCCESS)
        );

        return $brandResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandCompanyRelationTransfer $brandCompanyRelationTransfer
     *
     * @return array
     */
    protected function getRelatedCompanyIds(
        BrandCompanyRelationTransfer $brandCompanyRelationTransfer
    ): array {
        $currentBrandCompanyRelationTransfer = $this->brandCompanyRelationReader->getBrandCompanyRelation($brandCompanyRelationTransfer);

        if (!$currentBrandCompanyRelationTransfer->getCompanyIds()) {
            return [];
        }

        return $currentBrandCompanyRelationTransfer->getCompanyIds();
    }

    /**
     * @param \Generated\Shared\Transfer\BrandCompanyRelationTransfer $brandCompanyRelationTransfer
     *
     * @return array
     */
    protected function getRequestedCompanyIds(
        BrandCompanyRelationTransfer $brandCompanyRelationTransfer
    ): array {
        if (!$brandCompanyRelationTransfer->getCompanyIds()) {
            return [];
        }

        return $brandCompanyRelationTransfer->getCompanyIds();
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
        $companyBrandRelations = $this->brandCompanyRelationReader->getCompanyBrandRelation($companyBrandRelationTransfer);

        $idBrands = [];

        foreach ($companyBrandRelations->getBrands() as $brand) {
            $idBrands[] = $brand->getIdBrand();
        }

        return $idBrands;
    }
}
