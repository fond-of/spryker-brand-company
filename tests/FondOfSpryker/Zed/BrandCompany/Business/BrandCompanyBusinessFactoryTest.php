<?php

namespace FondOfSpryker\Zed\BrandCompany\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\BrandCompany\Business\CompanyBrandRelation\CompanyBrandRelationWriter;
use FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManager;
use FondOfSpryker\Zed\BrandCompany\Persistence\BrandCompanyRepository;
use Spryker\Zed\Kernel\Container;

class BrandCompanyBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyBusinessFactory
     */
    protected $brandCompanyBusinessFactory;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \Spryker\Zed\BrandCompany\Persistence\BrandCompanyEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Spryker\Zed\BrandCompany\Persistence\BrandCompanyRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandCompanyBusinessFactory = new BrandCompanyBusinessFactory();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(BrandCompanyEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(BrandCompanyRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCompanyBusinessFactory->setContainer($this->containerMock);
        $this->brandCompanyBusinessFactory->setEntityManager($this->entityManagerMock);
        $this->brandCompanyBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBrandRelationWriter(): void
    {
        $companyBrandRelationWriter = $this->brandCompanyBusinessFactory->createCompanyBrandRelationWriter();

        $this->assertNotNull($companyBrandRelationWriter);
        $this->assertInstanceOf(CompanyBrandRelationWriter::class, $companyBrandRelationWriter);
    }
}
