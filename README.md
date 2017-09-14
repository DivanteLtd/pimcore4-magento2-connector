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

## Key Features
CMS - Expand your Magento store with powerful CMS
![CMS](https://user-images.githubusercontent.com/17312052/30380994-7551a0bc-989b-11e7-9721-ca839cb8d176.png)

Landing Pages - Generate landing pages, forms and content pages in a flash
![Landing Pages](https://user-images.githubusercontent.com/17312052/30380996-75541194-989b-11e7-93c4-2cff41080d0c.png)

PIM - Manage product information, translations, photos etc. with the best PIM software on the market
![PIM](https://user-images.githubusercontent.com/17312052/30380995-7551d23a-989b-11e7-9994-da62469a82bb.png)

Tell a Story - Create a Storytelling about your brand and products
![Tell a Story!](https://user-images.githubusercontent.com/17312052/30380998-7556c402-989b-11e7-9a70-f6ce077b4a4c.png)

Transfer All Data - Transfer all data types between systems - products, attributes, categories, customers, orders
![Transfer All Data](https://user-images.githubusercontent.com/17312052/30380997-75562718-989b-11e7-9c2b-dd1c7d86c1ec.png)

Omnichannel - Create a powerful Omnichannel solution
![Omnichannel](https://user-images.githubusercontent.com/17312052/30380999-7556c5a6-989b-11e7-8ba5-68e7669494fd.png)

More about this Magento 2 connector on this website.

## Configuration
Fill ```website/var/plugins/Magento2Connector/Magento2ConnectorConfig.php``` with credentials to Magento API.

## Contributing
If you'd like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.

## Standards & Code Quality
*Which standards and code quality rules this code respects?*

This module respects all Magento2 code quality rules and our own PHPCS and PHPMD rulesets.

## About Authors


![Divante-logo](http://divante.co/wp-content/uploads/2017/07/divante-logo.png "Divante")

Founded in 2008 in Poland, Divante delivers high-quality e-business solutions. They support their clients in creating customized Omnichannel and eCommerce platforms, with expertise in CRM, ERP, PIM, custom web applications, and Big Data solutions. With 180 employees on board, Divante provides software expertise and user-experience design. Their team assists companies in their development and optimization of new sales channels by implementing eCommerce solutions, integrating systems, and designing and launching marketing campaigns.

Visit our website [Divante.co](https://divante.co/ "Divante.co") for more information.
