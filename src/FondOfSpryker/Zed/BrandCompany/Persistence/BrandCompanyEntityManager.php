<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

use Generated\Shared\Transfer\BrandTransfer;
use Orm\Zed\BrandCompany\Persistence\FosBrandCompany;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyPersistenceFactory getFactory()
 */
class BrandCompanyEntityManager extends AbstractEntityManager implements BrandCompanyEntityManagerInterface
{
    /**
     * {@inheritDoc}
     *
     * @param array $idBrands
     * @param int $idCompany
     *
     * @return void
     */
    public function addBrands(array $idBrands, $idCompany): void
    {
        foreach ($idBrands as $idBrand) {
            $companyBrandEntity = new FosBrandCompany();
            $companyBrandEntity->setFkCompany($idCompany)
                ->setFkBrand($idBrand)
                ->save();
        }
    }

    /**
     * {@inheritDoc}
     *
     * @param array $idBrands
     * @param int $idCompany
     *
     * @return void
     */
    public function removeBrands(array $idBrands, $idCompany): void
    {
        if (count($idBrands) === 0) {
            return;
        }

        $this->getFactory()
            ->createBrandCompanyQuery()
            ->filterByFkCompany($idCompany)
            ->filterByFkBrand_In($idBrands)
            ->delete();
    }

    /**
     * @param int $idBrand
     * @param int[] $companyIds
     *
     * @return void
     */
    public function addCompanyRelations(int $idBrand, array $companyIds): void
    {
        foreach ($companyIds as $idCompany) {
            $brandCompanyEntity = new FosBrandCompany();
            $brandCompanyEntity->setFkBrand($idBrand)
                ->setFkCompany($idCompany)
                ->save();
        }
    }

    /**
     * @param int $idBrand
     * @param int[] $companyIds
     *
     * @return void
     */
    public function removeCompanyRelations(int $idBrand, array $companyIds): void
    {
        if (!$companyIds) {
            return;
        }

        $brandCompanyEntities = $this->getFactory()
            ->createBrandCompanyQuery()
            ->filterByFkBrand($idBrand)
            ->filterByFkCompany_In($companyIds)
            ->find();

        foreach ($brandCompanyEntities as $brandCompanyEntity) {
            $brandCompanyEntity->delete();
        }
    }

    /**
     * @return void
     */
    public function deleteBrandCompanyRelation(BrandTransfer $brandTransfer): void
    {
        $brandCompanyEntities = $this->getFactory()
            ->createBrandCompanyQuery()
            ->filterByFkBrand($brandTransfer->getIdBrand())
            ->find();

        foreach ($brandCompanyEntities as $brandCompanyEntity) {
            $brandCompanyEntity->delete();
        }
    }
}
