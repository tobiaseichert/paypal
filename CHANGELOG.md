# Change Log for OXID eSales PayPal module

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

### Added

### Changed

### Deprecated

### Removed

### Fixed

## [5.2.2] - 2018-07-17

### Fixed
- Fix PHP 7.1 compatibility of acceptance tests.

### Security

## [5.2.1] - 2018-07-12

### Fixed
- Adapt acceptance tests to latest changes in PayPal GUI.
- Adapt tests to latest PayPal Sandbox

## [5.2.0] - 2018-05-03

### Changed
- Added class \OxidEsales\PayPalModule\Core\IpnConfig.
- Added methods
  * \OxidEsales\PayPalModule\Core\PayPalService::setPayPalIpnConfig()
  * \OxidEsales\PayPalModule\Core\PayPalService::getPayPalIpnConfig()

### Deprecated
- Deprecated the following methods: \OxidEsales\PayPalModule\Core\Config::getIPNResponseUrl()

### Fixed
- Compatibility of tests with MySQL 5.7.
- Fixed 0006122 IPN postback DNS issue. Introduced \OxidEsales\PayPalModule\Core\IpnConfig class to 
  provide the necessary IPN parameters for host and url.  

## [5.1.6] - 2018-03-26

### Changed
- New partnercode Oxid_Cart_ECS_Shortcut is used for BUTTONSOURCE parameter in 
  PayPal's DoExpressCheckoutPayment API Operation (NVP) when PayPal payment was triggered 
  via shortcut button.
- Updated pictures in documentation.  
  
### Removed
- Unused log directory. Log is written into shop's default log directory. 

## [5.1.5] - 2018-01-23

### Added
- Add hidden configuration parameter OEPayPalDisableIPN and method 
  \OxidEsales\PayPalModule\CoreConfig::suppressIPNCallbackUrl() to be able to suppress 
  sending PAYMENTREQUEST_0_NOTIFYURL optional request parameter to paypal. 
  At the moment used for acceptance tests as they do not test IPN.

### Changed
- Log Acceptance test debug information into log/oepaypal_acceptance_log.txt instead of log/EXCEPTION_LOG.txt.

## [5.1.4] - 2017-11-28

### Changed
- Update PayPal button pictures.

## [5.1.3] - 2017-11-13

### Changed
- Change tables encoding to utf8.

## [5.1.2] - 2017-11-02

### Fixed
- Stabilize Acceptance tests by automatically skipping tests if issues with PayPal Sandbox are detected.

## [5.1.1] - 2017-09-07

### Fixed
- Stabilize Acceptance tests by changing locators.

## [5.1.0] - 2017-08-14

### Added
- Additional PayPal express checkout button in user checkout step in case no user is logged in.


[Unreleased]: https://github.com/OXID-eSales/paypal/compare/v5.2.1...HEAD
[v5.2.1]: https://github.com/OXID-eSales/paypal/compare/v5.2.0...v5.2.1
[v5.2.0]: https://github.com/OXID-eSales/paypal/compare/v5.1.6...v5.2.0
[v5.1.6]: https://github.com/OXID-eSales/paypal/compare/v5.1.5...v5.1.6
[v5.1.5]: https://github.com/OXID-eSales/paypal/compare/v5.1.4...v5.1.5
[v5.1.4]: https://github.com/OXID-eSales/paypal/compare/v5.1.3...v5.1.4
[v5.1.3]: https://github.com/OXID-eSales/paypal/compare/v5.1.2...v5.1.3
[v5.1.2]: https://github.com/OXID-eSales/paypal/compare/v5.1.1...v5.1.2
[v5.1.1]: https://github.com/OXID-eSales/paypal/compare/v5.1.0...v5.1.1
[v5.1.0]: https://github.com/OXID-eSales/paypal/compare/v5.0.5...v5.1.0
[v5.0.5]: https://github.com/OXID-eSales/paypal/compare/v5.0.4...v5.0.5
[v5.0.4]: https://github.com/OXID-eSales/paypal/compare/v5.0.3...v5.0.4
[v5.0.3]: https://github.com/OXID-eSales/paypal/compare/v5.0.2...v5.0.3
[v5.0.2]: https://github.com/OXID-eSales/paypal/compare/v5.0.1...v5.0.2
[v5.0.1]: https://github.com/OXID-eSales/paypal/compare/v5.0.0...v5.0.1
[v5.0.0]: https://github.com/OXID-eSales/paypal/compare/v4.0.0...v5.0.0
