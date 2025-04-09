# Mage-OS Theme Adminhtml Switcher

## Features

This module enables M137 Admin Theme for Mage-OS. This is a companion module to the [mage-os/theme-adminhtml-m137](https://github.com/mage-os-lab/theme-adminhtml-m137)

## Installation

```
composer require mage-os/theme-adminhtml-m137
bin/magento module:enable MageOS_ThemeAdminhtmlSwitcher
bin/magento setup:upgrade
```

## Contribution

Install the module and theme locally

```
git clone git@github.com:mage-os-lab/module-theme-adminhtml-switcher.git ./app/code/MageOS/ThemeAdminhtmlSwitcher/
git clone git@github.com:mage-os-lab/theme-adminhtml-m137.git ./app/design/adminhtml/MageOS/theme-adminhtml-m137/
```

## Configuration

![Configuration Settings Stores Advanced Admin](./docs/stores-configuration-advanced-admin-admin-design-enable-m137-admin-theme.png)

```
Stores > | Settings | Configuration > Advanced > Admin > Admin Design
```

```
Enable M137 Admin Theme: Yes / No
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.