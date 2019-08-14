<?php
/* 
 * @category  Event Manager Module
 * @package   Piyush_Events
 * @author    Piyush Kumar <phpteamlead.mca@gmail.com,er.piyush.kumar@gmail.com>
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      N/A 
 */
class Piyush_Events_Helper_Data extends Mage_Core_Helper_Data
{
    /**
     * Path to store config if front-end output is enabled
     *
     * @var string
     */
    const XML_PATH_ENABLED            = 'events/view/enabled';

    /**
     * Path to store config where count of events posts per page is stored
     *
     * @var string
     */
    const XML_PATH_ITEMS_PER_PAGE     = 'events/view/items_per_page';

    /**
     * Path to store config where count of days while events is still recently added is stored
     *
     * @var string
     */
    const XML_PATH_DAYS_DIFFERENCE    = 'events/view/days_difference';

    /**
     * Events Item instance for lazy loading
     *
     * @var Piyush_Events_Model_Events
     */
    protected $_eventsItemInstance;

    /**
     * Checks whether events can be displayed in the frontend
     *
     * @param integer|string|Mage_Core_Model_Store $store
     * @return boolean
     */
    public function isEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $store);
    }

    /**
     * Return the number of items per page
     *
     * @param integer|string|Mage_Core_Model_Store $store
     * @return int
     */
    public function getEventsPerPage($store = null)
    {
        return abs((int)Mage::getStoreConfig(self::XML_PATH_ITEMS_PER_PAGE, $store));
    }

    /**
     * Return difference in days while events is recently added
     *
     * @param integer|string|Mage_Core_Model_Store $store
     * @return int
     */
    public function getDaysDifference($store = null)
    {
        return abs((int)Mage::getStoreConfig(self::XML_PATH_DAYS_DIFFERENCE, $store));
    }

    /**
     * Return current events item instance from the Registry
     *
     * @return Piyush_Events_Model_Events
     */
    public function getEventsItemInstance()
    {
        if (!$this->_eventsItemInstance) {
            $this->_eventsItemInstance = Mage::registry('events_item');

            if (!$this->_eventsItemInstance) {
                Mage::throwException($this->__('Events item instance does not exist in Registry'));
            }
        }

        return $this->_eventsItemInstance;
    }
}
