<?php
/* 
 * @category  Event Manager Module
 * @package   Piyush_Events
 * @author    Piyush Kumar <phpteamlead.mca@gmail.com,er.piyush.kumar@gmail.com>
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      N/A 
 */
class Piyush_Events_Block_Adminhtml_Events_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init Grid default properties
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('events_list_grid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Prepare collection for Grid
     *
     * @return Piyush_Events_Block_Adminhtml_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('piyush_events/events')->getResourceCollection();
		//echo "<pre>";var_dump($collection);echo "</pre>";

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare Grid columns
     *
     * @return Mage_Adminhtml_Block_Catalog_Search_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('events_id', array(
            'header'    => Mage::helper('piyush_events')->__('ID #'),
            'width'     => '50px',
            'index'     => 'events_id',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('piyush_events')->__('Title'),
            'index'     => 'title',
        ));
		
		/*$this->addColumn('details', array(
            'header'    => Mage::helper('piyush_events')->__('Details'),
            'index'     => 'details',
        ));*/
		$this->addColumn('entry_fee', array(
            'header'    => Mage::helper('piyush_events')->__('Entry Fee'),
            'index'     => 'entry_fee',
        ));

        $this->addColumn('venue', array(
            'header'    => Mage::helper('piyush_events')->__('Venue'),
            'index'     => 'venue',
        ));

        $this->addColumn('published_at', array(
            'header'   => Mage::helper('piyush_events')->__('Published On'),
            'sortable' => true,
            'width'    => '170px',
            'index'    => 'published_at',
            'type'     => 'date',
        ));

        $this->addColumn('created_at', array(
            'header'   => Mage::helper('piyush_events')->__('Created'),
            'sortable' => true,
            'width'    => '170px',
            'index'    => 'created_at',
            'type'     => 'datetime',
        ));

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('piyush_events')->__('Action'),
                'width'     => '100px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(array(
                    'caption' => Mage::helper('piyush_events')->__('Edit'),
                    'url'     => array('base' => '*/*/edit'),
                    'field'   => 'id'
                )),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'news',
        ));

        return parent::_prepareColumns();
    }

    /**
     * Return row URL for js event handlers
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Grid url getter
     *
     * @return string current grid url
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}
