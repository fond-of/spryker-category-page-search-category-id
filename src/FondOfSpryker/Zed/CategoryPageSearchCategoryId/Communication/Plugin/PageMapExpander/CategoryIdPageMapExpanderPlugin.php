<?php

namespace FondOfSpryker\Zed\CategoryPageSearchCategoryId\Communication\Plugin\PageMapExpander;

use FondOfSpryker\Zed\CategoryPageSearchPlugable\Dependency\Plugin\CategoryPageMapExpanderInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

class CategoryIdPageMapExpanderPlugin extends AbstractPlugin implements CategoryPageMapExpanderInterface
{
    public const FK_CATEGORY = 'fk_category';

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function expandCategoryPageMap(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData, LocaleTransfer $localeTransfer): PageMapTransfer
    {
        if (!array_key_exists(static::FK_CATEGORY, $categoryData)) {
            return $pageMapTransfer;
        }

        $this->addCategoryIdToPageMapTransfer($pageMapTransfer, $categoryData);
        $this->addCategoryIdToSearchResult($pageMapTransfer, $pageMapBuilder, $categoryData);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param array $categoryData
     *
     * @return void
     */
    protected function addCategoryIdToPageMapTransfer(PageMapTransfer $pageMapTransfer, array $categoryData): void
    {
        if (!method_exists($pageMapTransfer, 'setCategoryId')) {
            return;
        }

        $pageMapTransfer->setCategoryId($categoryData[self::FK_CATEGORY]);
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     *
     * @return void
     */
    protected function addCategoryIdToSearchResult(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData): void
    {
        $pageMapBuilder->addSearchResultData($pageMapTransfer, static::FK_CATEGORY, $categoryData[self::FK_CATEGORY]);
    }
}
