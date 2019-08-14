<?php
/* 
 * @category  Event Manager Module
 * @package   Piyush_Events
 * @author    Piyush Kumar <phpteamlead.mca@gmail.com,er.piyush.kumar@gmail.com>
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      N/A 
 */
class Piyush_Events_Model_Events extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('piyush_events/events');
    }

    /**
     * If object is new adds creation date
     *
     * @return Piyush_Events_Model_Events
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        if ($this->isObjectNew()) {
            $this->setData('created_at', Varien_Date::now());
        }
        return $this;
    }
}
