# Magento 2 connector

Magento2-connector is a plugin which allows to add, remove and modify Magento products and categories directly from Pimcore panel. 
**Table of Contents**

- [Magento 2 connector](#magento-2-connector)
	- [Compatibility](#compatibility)
	- [Requirements](#requirements)
	- [Installing/Getting started](#installinggetting-started)
	- [Features](#features)
	- [Configuration](#configuration)
	- [Contributing](#)
	- [Licensing](#)
	- [Standards & Code Quality](#)
	- [About Authors](#)

## Compatibility
This module is compatible with Magento >= 2.0 and Pimcore >= 4.2

## Requirements
This plugin requires following php extensions:
 * php-curl
 * php-mbstring
 
In Magento you need to have attributes set with id: 4.

In Pimcore you need to have classes Product and Category with following attributes:

Product:
 * Sku
 * Name
 * Price
 * Weight
 * Description
 * ShortDescription
 * Categories (array of category Ids)

Category:
 * ParentId
 * Name 
 
## Installing/Getting started
Download this repository as .zip file.
In Pimcore panel select Extensions and Upload Plugin (ZIP) and click Install and Enable.
Follow [Configuration tab](#configuration)

## Features
Each time user creates, changes or deletes Product or Category object, it is mapped and sent to Magento API.  

## Configuration
Fill  ```website/var/plugins/Magento2Connector/Magento2ConnectorConfig.php``` with credentials to Magento API.


## Contributing
If you'd like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.

## Standards & Code Quality
*Which standards and code quality rules this code respects?*

This module respects all Magento2 code quality rules and our own PHPCS and PHPMD rulesets.

## About Authors


![Divante-logo](http://divante.co/wp-content/uploads/2017/07/divante-logo.png "Divante")

Founded in 2008 in Poland, Divante delivers high-quality e-business solutions. They support their clients in creating customized Omnichannel and eCommerce platforms, with expertise in CRM, ERP, PIM, custom web applications, and Big Data solutions. With 180 employees on board, Divante provides software expertise and user-experience design. Their team assists companies in their development and optimization of new sales channels by implementing eCommerce solutions, integrating systems, and designing and launching marketing campaigns.

Visit our website [Divante.co](https://divante.co/ "Divante.co") for more information.
