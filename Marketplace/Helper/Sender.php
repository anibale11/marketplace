<?php

namespace Magentomaster\Marketplace\Helper;
 
class Sender extends \Magento\Framework\App\Helper\AbstractHelper
{
    const EMAIL_TEMPLATE = 'email_section/sendmail/email_template';
 
    const EMAIL_SERVICE_ENABLE = 'email_section/sendmail/enabled';
 
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
    ) {
        $this->_storeManager = $storeManager;
        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        parent::__construct($context);
    }
 
    /**
     *
     * @return $this
     */
    public function sendTransactionalEmail($data)
    {
        if(!$this->isEnable()) {
            return $this;
        }
        $email = $data['email']; //set receiver mail
        $this->inlineTranslation->suspend();
        $template = $this->scopeConfig->getValue(
            self::EMAIL_TEMPLATE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
        $vars = [
            'name' => $data['name'],
            'phoneno' => $data['phoneno'],
            'store' => $this->getStore()
        ];
        $transport = $this->_transportBuilder->setTemplateIdentifier(
            $template
        )->setTemplateOptions(
            [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $this->getStoreId()
            ]
        )
        ->setTemplateVars($vars)
        ->setFrom(
            $_sender = $this->scopeConfig->getValue(
                'email_section/sendmail/sender',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $this->getStoreId()
            )
        )->addTo(
            $email
        )
        //->addBcc(['receiver1@example.com','receiver2@example.com'])
        ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();
        return $this;
    }
 


    public function sendOrderEmail($data,$email,$message)
    {
        if(!$this->isEnable()) {
            return $this;
        }
        $email = $email; //set receiver mail
        $this->inlineTranslation->suspend();
        $template = $this->scopeConfig->getValue(
            'email_section/order/email_template',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
        $vars = [
            'order' => $data,
            'store' => $this->getStore(),
            'message'=> $message
        ];
        $transport = $this->_transportBuilder->setTemplateIdentifier(
            $template
        )->setTemplateOptions(
            [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $this->getStoreId()
            ]
        )
        ->setTemplateVars($vars)
        ->setFrom(
            $_sender = $this->scopeConfig->getValue(
                'email_section/sendmail/sender',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $this->getStoreId()
            )
        )->addTo(
            $email
        )
        //->addBcc(['receiver1@example.com','receiver2@example.com'])
        ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();
        return $this;
    }

    public function sendGeneralMessage($data,$email,$message)
    {
        if(!$this->isEnable()) {
            return $this;
        }
        $email = $data['email']; //set receiver mail
        $this->inlineTranslation->suspend();
        $template = $this->scopeConfig->getValue(
            'email_section/general/email_template',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
        $vars = [
            'data' => $data,
            'store' => $this->getStore(),
            'message'=> $message
        ];
        $transport = $this->_transportBuilder->setTemplateIdentifier(
            $template
        )->setTemplateOptions(
            [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $this->getStoreId()
            ]
        )
        ->setTemplateVars($vars)
        ->setFrom(
            $_sender = $this->scopeConfig->getValue(
                'email_section/sendmail/sender',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                $this->getStoreId()
            )
        )->addTo(
            $email
        )
        //->addBcc(['receiver1@example.com','receiver2@example.com'])
        ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();
        return $this;
    }


    /**
     * Check Email service is enable or not
     *
     * @return bool
     */
    public function isEnable() {
        return $this->scopeConfig->getValue(self::EMAIL_SERVICE_ENABLE,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE,$this->getStoreId());
    }
 
    /*
     * get Current store id
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }
 
    /*
     * get Current store Info
     */
    public function getStore()
    {
        return $this->_storeManager->getStore();
    }
}