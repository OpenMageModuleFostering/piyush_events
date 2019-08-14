 <?php
/* 
 * @category  Event Manager Module
 * @package   Piyush_Events
 * @author    Piyush Kumar <phpteamlead.mca@gmail.com,er.piyush.kumar@gmail.com>
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      N/A 
 */
class Piyush_Events_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Pre dispatch action that allows to redirect to no route page in case of disabled extension through admin panel
     */
    public function preDispatch()
    {
        parent::preDispatch();
        
        if (!Mage::helper('piyush_events')->isEnabled()) {
            $this->setFlag('', 'no-dispatch', true);
            $this->_redirect('noRoute');
        }        
    }
    
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->loadLayout();

        $listBlock = $this->getLayout()->getBlock('events.list');

        if ($listBlock) {
            $currentPage = abs(intval($this->getRequest()->getParam('p')));
            if ($currentPage < 1) {
                $currentPage = 1;
            }
            $listBlock->setCurrentPage($currentPage);
        }

        $this->renderLayout();
    }

    /**
     * Events view action
     */
    public function viewAction()
    {
        $eventsId = $this->getRequest()->getParam('id');
        if (!$eventsId) {
            return $this->_forward('noRoute');
        }

        /** @var $model Piyush_Events_Model_Events */
        $model = Mage::getModel('piyush_events/events');
        $model->load($eventsId);

        if (!$model->getId()) {
            return $this->_forward('noRoute');
        }

        Mage::register('events_item', $model);
        
        Mage::dispatchEvent('before_events_item_display', array('events_item' => $model));

        $this->loadLayout();
        $itemBlock = $this->getLayout()->getBlock('events.item');
        if ($itemBlock) {
            $listBlock = $this->getLayout()->getBlock('events.list');
            if ($listBlock) {
                $page = (int)$listBlock->getCurrentPage() ? (int)$listBlock->getCurrentPage() : 1;
            } else {
                $page = 1;
            }
            $itemBlock->setPage($page);
        }
        $this->renderLayout();
    }
}
