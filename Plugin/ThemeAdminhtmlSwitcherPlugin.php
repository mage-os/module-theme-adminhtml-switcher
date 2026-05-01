<?php declare(strict_types=1);

namespace MageOS\ThemeAdminhtmlSwitcher\Plugin;

use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Theme\Model\View\Design;

class ThemeAdminhtmlSwitcherPlugin
{
    protected const XML_PATH_ACTIVE_THEME = 'admin/system_admin_design/active_theme';

    protected ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param Design $subject
     * @param mixed $themeId
     * @param string|null $area
     * @return array
     */
    public function beforeSetDesignTheme(Design $subject, mixed $themeId = null, ?string $area = null): array
    {
        if ($area !== null && $area !== Area::AREA_ADMINHTML) {
            return [$themeId, $area];
        }

        if ($subject->getArea() !== Area::AREA_ADMINHTML) {
            return [$themeId, $area];
        }

        $activeTheme = $this->scopeConfig->getValue(
            self::XML_PATH_ACTIVE_THEME,
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );

        return [$activeTheme ?? $themeId, $area];
    }
}
