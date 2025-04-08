<?php

namespace MageOS\ThemeAdminhtmlSwitcher\Plugin;

use Magento\Theme\Model\View\Design;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\State;
use Magento\Framework\Exception\LocalizedException;

class ThemeAdminhtmlSwitcherPlugin
{
    private $scopeConfig;
    private $logger;
    private $appState;

    /**
     * ThemeAdminhtmlSwitcherPlugin constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param LoggerInterface $logger
     * @param State $appState
     */
    public function __construct(ScopeConfigInterface $scopeConfig, LoggerInterface $logger, State $appState)
    {
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
        $this->appState = $appState;
    }

    /**
     * Before method for setting backend area design theme.
     *
     * @param Design $subject
     * @param string|null $themeId
     * @return array
     */
    public function beforeSetDesignTheme(Design $subject, $themeId = null)
    {
        try {
            if (!$this->appState->getAreaCode()) {
                $this->logger->info(__('Setting area code to adminhtml'));
                $this->appState->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
            }
        } catch (LocalizedException $e) {
            $this->logger->info(__('Area code issue: %1', $e->getMessage()));
            $this->appState->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
            $this->logger->info(__('Current area code: %1', $this->appState->getAreaCode()));
        }

        if ($this->appState->getAreaCode() === \Magento\Framework\App\Area::AREA_ADMINHTML) {
            $isEnabled = $this->scopeConfig->isSetFlag(
                'admin/system_admin_design/enable_theme_adminhtml_m137',
                ScopeConfigInterface::SCOPE_TYPE_DEFAULT
            );

            $this->logger->info(__('Theme Adminhtml Switcher plugin triggered: %1', 
                $isEnabled ? __('Enabled') : __('Disabled'))
            );

            if ($isEnabled) {
                $themeId = 'MageOS/m137-admin-theme';
            }
        }

        return [$themeId];
    }
}
