<?php declare(strict_types=1);

namespace MageOS\ThemeAdminhtmlSwitcher\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Theme\Model\View\Design;
use Magento\Framework\App\Area;

class ThemeAdminhtmlSwitcherPlugin
{
    private $scopeConfig;

    /**
     * ThemeAdminhtmlSwitcherPlugin constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
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
        if ($subject->getArea() !== Area::AREA_ADMINHTML) {
            return [$themeId];
        }
        
        $isEnabled = $this->scopeConfig->isSetFlag(
            'admin/system_admin_design/enable_theme_adminhtml_m137',
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );

        if ($isEnabled) {
            $themeId = 'MageOS/m137-admin-theme';
        }

        return [$themeId];
    }
}
