<?php declare(strict_types=1);

namespace MageOS\ThemeAdminhtmlSwitcher\Model\Config\Source;

use Magento\Framework\App\Area;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Design\Theme\ThemeList;

class AdminThemeList implements OptionSourceInterface
{
    protected const DEFAULT_ADMIN_THEME_PATH = 'Magento/backend';

    protected ThemeList $themeList;

    /**
     * @param ThemeList $themeList
     */
    public function __construct(ThemeList $themeList)
    {
        $this->themeList = $themeList;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        $themes = [];
        $this->themeList->addConstraint(ThemeList::CONSTRAINT_AREA, Area::AREA_ADMINHTML);

        foreach ($this->themeList->getItems() as $theme) {
            $path = $theme->getData('theme_path');
            $title = $path === self::DEFAULT_ADMIN_THEME_PATH
                ? (string)__('Magento Default')
                : $theme->getData('theme_title');

            $themes[$title] = [
                'label' => $title . ' (' . $path . ')',
                'value' => $path,
            ];
        }

        ksort($themes);

        return $themes;
    }
}
