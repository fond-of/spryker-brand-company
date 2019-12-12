<?php

namespace FondOfSpryker\Zed\BrandCompany\Persistence;

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
     * @throws
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
     * @throws
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
}
