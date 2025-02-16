<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\DoctrineORMAdminBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Sonata\DoctrineORMAdminBundle\DependencyInjection\SonataDoctrineORMAdminExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SonataDoctrineORMAdminExtensionTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    protected $configuration;

    protected function tearDown(): void
    {
        unset($this->configuration);
    }

    public function testEntityManagerSetFactory(): void
    {
        $this->configuration = new ContainerBuilder();
        $this->configuration->setParameter('kernel.bundles', ['SimpleThingsEntityAuditBundle' => true]);
        $loader = new SonataDoctrineORMAdminExtension();
        $loader->load([], $this->configuration);

        $definition = $this->configuration->getDefinition('sonata.admin.entity_manager');

        static::assertNotNull($definition->getFactory());
        static::assertNotFalse($this->configuration->getParameter('sonata_doctrine_orm_admin.audit.force'));
    }
}
