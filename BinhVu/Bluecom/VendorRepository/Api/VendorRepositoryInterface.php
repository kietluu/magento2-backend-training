<?php
namespace Bluecom\VendorRepository\Api;

interface VendorRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return \Bluecom\Vendor\Api\Data\VendorInterface
     */
    public function load($id) ;

    /**
     * @param \Bluecom\Vendor\Api\Data\VendorInterface $vendor
     *
     * @return \Bluecom\Vendor\Api\Data\VendorInterface
     */
    public function save(\Bluecom\Vendor\Api\Data\VendorInterface $vendor);

    /**
     * @param \Magento\Framework\Api\SortOrder $searchCriteria
     *
     * @return \Bluecom\Vendor\Api\Data\VendorSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SortOrder $searchCriteria);

    /**
     * @param int $id
     *
     * @return int[]
     */
    public function getAssociatedProductIds($id) ;
}