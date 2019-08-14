<?php
/* 
 * @category  Event Manager Module
 * @package   Piyush_Events
 * @author    Piyush Kumar <phpteamlead.mca@gmail.com,er.piyush.kumar@gmail.com>
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      N/A 
 */
class Piyush_Events_Model_Observer
{
    /**
     * Event before show event item on frontend
     * If specified new post was added recently (term is defined in config) we'll see message about this on front-end.
     *
     * @param Varien_Event_Observer $observer
     */
    public function beforeEventsDisplayed(Varien_Event_Observer $observer)
    {
        $eventsItem = $observer->getEvent()->getEventsItem();
        $currentDate = Mage::app()->getLocale()->date();
        $eventsCreatedAt = Mage::app()->getLocale()->date(strtotime($eventsItem->getCreatedAt()));
        $daysDifference = $currentDate->sub($eventsCreatedAt)->getTimestamp() / (60 * 60 * 24);
        /*if ($daysDifference < Mage::helper('piyush_events')->getDaysDifference()) {
            Mage::getSingleton('core/session')->addSuccess(Mage::helper('piyush_events')->__('Recently added'));
        }*/
    }
}
