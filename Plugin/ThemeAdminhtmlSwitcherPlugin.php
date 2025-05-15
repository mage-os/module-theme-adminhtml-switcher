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
     * @param string|null $area
     * @return array
     */
    public function beforeSetDesignTheme(Design $subject, $themeId = null, $area = null)
    {
        if ($area !== null && $area !== Area::AREA_ADMINHTML) {
            return [$themeId, $area];
        }

        if ($subject->getArea() !== Area::AREA_ADMINHTML) {
            return [$themeId, $area];
        }

        $activeTheme = $this->scopeConfig->getValue(
            'admin/system_admin_design/active_theme',
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );
        
        return [$activeTheme ?? $themeId, $area];
    }
}
