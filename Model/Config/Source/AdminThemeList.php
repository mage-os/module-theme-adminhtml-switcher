<?php declare(strict_types=1);

namespace MageOS\ThemeAdminhtmlSwitcher\Model\Config\Source;

use Magento\Framework\App\Area;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Design\Theme\ThemeList;

class AdminThemeList implements OptionSourceInterface
{
    private ThemeList $themeList;

    /**
     * AdminThemeList constructor.
     *
     * @param ThemeList $themeList
     */
    public function __construct(ThemeList $themeList)
    {
        $this->themeList = $themeList;
    }

    /**
     * Get a list of all installed adminhtml themes.
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        $themes = [];
        $this->themeList->addConstraint(ThemeList::CONSTRAINT_AREA, Area::AREA_ADMINHTML);

        foreach ($this->themeList->getItems() as $theme) {
            $path = $theme->getData('theme_path');

            // Replace default admin theme title as 'Magento 2 backend' is not user friendly
            $title = $theme->getData('theme_title');
            if ($path === 'Magento/backend') {
                $title = (string)__('Magento Default');
            }

            $themes[$title] = [
                'label' => $title . ' (' . $path . ')',
                'value' => $path
            ];
        }

        ksort($themes); // Sort themes alphabetically

        return $themes;
    }
}
