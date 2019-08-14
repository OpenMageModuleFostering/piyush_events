<?php
/* 
 * @category  Event Manager Module
 * @package   Piyush_Events
 * @author    Piyush Kumar <phpteamlead.mca@gmail.com,er.piyush.kumar@gmail.com>
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      N/A 
 */
class Piyush_Events_Model_Resource_Events_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('piyush_events/events');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Piyush_Events_Model_Resource_Events_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('piyush_events')->getEventsPerPage());
        $this->setCurPage($page)->setOrder('published_at', Varien_Data_Collection::SORT_ORDER_DESC);
        return $this;
    }
}
