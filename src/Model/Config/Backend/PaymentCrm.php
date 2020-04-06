<?php

namespace Retailcrm\Retailcrm\Model\Config\Backend;

class PaymentCrm extends \Magento\Framework\View\Element\Html\Select
{
    /**
     * @var \Retailcrm\Retailcrm\Helper\Proxy
     */
    private $client;
    /**
     * Activation constructor.
     *
     * @param \Magento\Framework\View\Element\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \Retailcrm\Retailcrm\Helper\Proxy $client,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->client = $client;
    }

    /**
     * @param string $value
     * @return Magently\Tutorial\Block\Adminhtml\Form\Field\Activation
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Parse to html.
     *
     * @return mixed
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {

            $response = $this->client->paymentTypesList();

            if ($response->isSuccessful()) {
                $paymentsTypes = $response['paymentTypes'];
            }

            $this->addOption( 'null',  " ");
            foreach ($paymentsTypes as $paymentsType) {
                $this->addOption($paymentsType['code'], $paymentsType['name']);
            }
        }

        return parent::_toHtml();
    }
}