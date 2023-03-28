# Changelog

<!--

All notable changes to this project will be documented in this file.

The format is based on [Common Changelog](https://common-changelog.org).

TEMPLATE:

## [version] - YYYY-MM-DD

### Changed

### Added

### Removed

### Fixed

-->

## [3.8.0] - 2023-02-08

### Added

- Add scheme transaction id to debit and preauthorize transactions
  ([#31](https://github.com/ixopay/php-ixopay/pull/31), X2980) (by @adamjanovic)

## [3.7.0] - 2023-01-18

### Changed

- Improve stringify for level 2 and level 3 data ([#30](https://github.com/ixopay/php-ixopay/pull/30)) (by @rhoferixo)

## [3.6.0] - 2023-01-18

### Added

- Add `transactionToken` to `Deregister` ([#23](https://github.com/ixopay/php-ixopay/pull/23)) (by @marcod85)

## [3.5.0] - 2022-12-15

### Added

- Add exemption indicator to `ThreeDSecureData` ([#29](https://github.com/ixopay/php-ixopay/pull/29)) (by @SPie)

## [3.4.0] - 2022-10-19

### Changed

- Deprecate `firstSixDigits` getters and setters (by @mkappelixo)

### Added

- Add `binDigits` as a future replacement for `firstSixDigits` (by @mkappelixo)
- Add level 2 and level 3 data to: capture, debit, incremental authorization, payout, preauthorize, refund and register
  transactions ([#25](https://github.com/ixopay/php-ixopay/pull/25)) (by @rhoferixo)

### Removed

- Remove `firstSixDigits` property (by @mkappelixo)

## [3.3.1] - 2022-10-03

### Fixed

- Fix wrong JSON key for mapping surcharge amounts ([#27](https://github.com/ixopay/php-ixopay/pull/27)) (by @SPie)

## [3.3.0] - 2022-09-29

### Added

- Add surcharge amount to debit and preauthorize transaction ([#26](https://github.com/ixopay/php-ixopay/pull/26)) (by @SPie)

## [3.2.0] - 2022-08-23

### Added

- Add DCC data ([#21](https://github.com/ixopay/php-ixopay/pull/21)) (by @SPie)
- Add schedule update API
- Add `callbackUrl` to schedule data
- Add `transactionIndicator` for register transactions

### Fixed

- Fix card-on-file merchant initiated constant ([#20](https://github.com/ixopay/php-ixopay/pull/20)) (by @AidasK)

## [3.1.0] - 2022-05-16

### Changed

- Allow all `psr/log` versions ([#11](https://github.com/ixopay/php-ixopay/pull/11)) (by @AidasK)

### Added

- Add redirect QR-code to transaction result ([#19](https://github.com/ixopay/php-ixopay/pull/19)) (by @rhoferIxo)

## [3.0.6] - 2022-04-12

### Added

- Add `Amountable` trait to `VoidTransaction` for partial void transactions

## [3.0.5] - 2022-03-16

### Added

- Send description for capture transactions

### Fixed

- Fix error parsing of status requests

## [3.0.4] - 2022-01-03

### Changed

- Refactor transaction indicator into trait and interface

## [3.0.3] - 2021-12-28

### Fixed

- Fix `payByLink` dependency for incremental authorization

## [3.0.2] - 2021-12-09

### Changed

- Allow any `psr/log` version as dependency

### Added

- Add send and receive transaction splits

## [3.0.1] - 2021-11-22

### Added

- Add owner first and last name to `WalletData`

### Fixed

- Add missing returns in fluent setter methods

## [3.0.0] - 2021-10-18

_Updates the API integration to use IXOPAY's Transaction V3 JSON based API._

### Changed

- **Breaking:** move `CardData`, `IbanData`, `WalletData`, `ChargebackData` and `ChargebackReversalData` to a new namespace
- Rename attributes from old API to new API
- Deprecate old getter and setter functions

### Added

- Add customer profiles
- Add `payByLink`

## [2.5.4] - 2020-06-25

### Added

- Add `transactionIndicator` to register transactions

## [2.5.3] - 2020-04-20

### Changed

- Send SDK version in request headers

### Added

- Add `scheduleMerchantMetadata` to callback results
- Add `merchantMetaData` to scheduler data and result

## [2.5.2] - 2019-12-03

### Added

- Set custom `curl` request headers and options

## [2.5.1] - 2019-12-03

### Removed

- Remove `FILTER_FLAG_SCHEME_REQUIRED` and `FILTER_FLAG_HOST_REQUIRED` flags if PHP version is newer than 7.3

## [2.5.0] - 2019-08-07

### Changed

- Move the package to the IXOPAY organization

## [2.4.4] - 2019-05-02

### Added

- Add `CARDONFILE_MERCHANT` transaction indicator

## [2.4.3] - 2019-04-09

### Changed

- Support PHP 5.6

## [2.4.2] - 2019-04-08

### Added

- Add wallet data to callbacks

## [2.4.1] - 2018-12-18

### Fixed

- Fix wrong variable usage

## [2.4.0] - 2018-12-06

### Added

- Add customer data
- Add status API

## [2.3.1] - 2018-10-05

### Fixed

- Fix XML parsing

## [2.3.0] - 2018-10-05

### Added

- Add customer data to callbacks and result objects

## [2.2.0] - 2018-06-13

### Added

- Add scheduler API
- Add `merchantMetaData` to transactions and callbacks

## [2.1.13] - 2018-04-04

### Added

- Add reference to previous transactions for payout transactions

## [2.1.12] - 2018-03-26

### Added

- Add `ChargebackReversalData`
- Add callback type `CHARGEBACK-REVERSAL`

## [2.1.11] - 2017-11-24

### Added

- Add `transactionIndicator` to `Debit` for use with recurring credit card or card-on-file transactions

## [2.1.10] - 2017-11-15

### Added

- Add 3D Secure error code

## [2.1.9] - 2017-11-07

### Added

- Add `callbackUrl` for `Refund` requests

## [2.1.8] - 2017-10-31

### Fixed

- Fix callback validation

## [2.1.7] - 2017-10-30

### Added

- Add `callbackUrl` for `Payout` requests

## [2.1.6] - 2017-06-22

_Re-publish to packagist._

## [2.1.5] - 2017-06-22

### Changed

- parse `mandateDate` to DateTime
- parse `ibanData`

## [2.1.4] - 2017-06-20

### Added

- add IBAN information to return data
- add examples for callback & debit

## [2.1.3] - 2017-05-03

### Changed

- Allow to set XML namespace

## [2.1.2] - 2017-03-13

### Changed

- Remove requirement to use XML namespaces

## [2.1.1] - 2017-03-08

_Re-publish to packagist._

## [2.1.0] - 2017-03-03

### Added

- Support payout transactions

## [2.0.2] - 2017-02-10

### Added

- Add fields `mandateId` and `mandateDate` to `Customer`

## [2.0.1] - 2017-02-08

### Added

- Add error codes for IBAN invalid, BIC invalid and customer data invalid

## [2.0.0] - 2017-02-03

### Changed

- Support PHP 7.x
- **Breaking:** Rename `Void` to `VoidTransaction`

## [1.1.3] - 2017-02-10

### Added

- Add fields `mandateId` and `mandateDate` to `Customer`

## [1.1.2] - 2017-02-08

_Re-publish to packagist._

## [1.1.1] - 2017-02-08

_Re-publish to packagist._

## [1.1.0] - 2017-02-08

_Re-publish to packagist._

## [1.0.20] - 2017-02-08

### Fixed

- Renames for PHP 7.x compatibility

## [1.0.19] - 2017-02-08

### Changed

- Allow gateway authorization header

## [1.0.18] - 2016-02-08

### Changed

- Rename service to `Gateway`

### Added

- Add timeout exception
- Add error codes for transaction cancelled

## [1.0.17] - 2016-08-30

### Added

- Add error codes for pickup card, lost card and stolen card

## [1.0.16] - 2016-08-18

### Added

<!-- vale off -->
- Add error codes for transaction cancelled and risk-check block
<!-- vale on -->

## [1.0.15] - 2016-04-11

### Added

- Add missing fluent setter in customer

### Fixed

- Remove private repositories in public library
- Remove prefer source flag

## [1.0.14] - 2016-02-04

### Added

- Add phone data

## [1.0.13] - 2016-01-14

### Changed

- Extend `AbstractTransactionWithReference` in `Preauthorize`

### Added

- Add setter for hashed password

## [1.0.12] - 2015-12-21

### Fixed

- Handle empty redirect type

## [1.0.11] - 2015-12-18

### Added

- Add redirect type

## [1.0.10] - 2015-12-02

### Added

- Add offsite URLs to register call
- Add billing first and last name
- Add purchased id

## [1.0.9] - 2015-10-20

### Added

- Add customer extra data
- Add error codes for chargeback reverted
- Add error codes for payment dispute
- Add `toArray()` to return data

## [1.0.8] - 2015-10-07

### Fixed

- sort order

## [1.0.7] - 2015-10-07

### Changed

- Deprecate test mode
- Customer extends data

### Added

- Add customer gender

## [1.0.6] - 2015-09-25

### Added

- Add `toArray()`to callback and transaction results

## [1.0.5] - 2015-09-25

### Fixed

- Capture requires `Amountable` interface

## [1.0.4] - 2015-09-25

_Re-publish to packagist._

## [1.0.3] - 2015-09-22

### Fixed

- Add dependency `psr/log`

## [1.0.2] - 2015-09-22

### Added

- Add client logging

### Fixed

- Generate pre-authorize without reference node
- Fix amount formatting

## [1.0.1] - 2015-09-15

### Added

- Add email verified flag
- Add license and requirements

## [1.0.0] - 2015-09-09

_Initial release._

[3.8.0]: https://github.com/ixopay/php-ixopay/releases/tag/v3.8.0
[3.7.0]: https://github.com/ixopay/php-ixopay/releases/tag/v3.7.0
[3.6.0]: https://github.com/ixopay/php-ixopay/releases/tag/v3.6.0
[3.5.0]: https://github.com/ixopay/php-ixopay/releases/tag/v3.5.0
[3.4.0]: https://github.com/ixopay/php-ixopay/releases/tag/v3.4.0
[3.3.1]: https://github.com/ixopay/php-ixopay/releases/tag/v3.3.1
[3.3.0]: https://github.com/ixopay/php-ixopay/releases/tag/v3.3.0
[3.2.0]: https://github.com/ixopay/php-ixopay/releases/tag/v3.2.0
[3.1.0]: https://github.com/ixopay/php-ixopay/releases/tag/v3.1.0
[3.0.6]: https://github.com/ixopay/php-ixopay/releases/tag/v3.0.6
[3.0.5]: https://github.com/ixopay/php-ixopay/releases/tag/v3.0.5
[3.0.4]: https://github.com/ixopay/php-ixopay/releases/tag/v3.0.4
[3.0.3]: https://github.com/ixopay/php-ixopay/releases/tag/v3.0.3
[3.0.2]: https://github.com/ixopay/php-ixopay/releases/tag/v3.0.2
[3.0.1]: https://github.com/ixopay/php-ixopay/releases/tag/v3.0.1
[3.0.0]: https://github.com/ixopay/php-ixopay/releases/tag/v3.0.0
[2.5.4]: https://github.com/ixopay/php-ixopay/releases/tag/v2.5.4
[2.5.3]: https://github.com/ixopay/php-ixopay/releases/tag/v2.5.3
[2.5.2]: https://github.com/ixopay/php-ixopay/releases/tag/v2.5.2
[2.5.1]: https://github.com/ixopay/php-ixopay/releases/tag/v2.5.1
[2.5.0]: https://github.com/ixopay/php-ixopay/releases/tag/v2.5
[2.4.4]: https://github.com/ixopay/php-ixopay/releases/tag/v2.4.4
[2.4.3]: https://github.com/ixopay/php-ixopay/releases/tag/v2.4.3
[2.4.2]: https://github.com/ixopay/php-ixopay/releases/tag/v2.4.2
[2.4.1]: https://github.com/ixopay/php-ixopay/releases/tag/v2.4.1
[2.4.0]: https://github.com/ixopay/php-ixopay/releases/tag/v2.4
[2.3.1]: https://github.com/ixopay/php-ixopay/releases/tag/v2.3.1
[2.3.0]: https://github.com/ixopay/php-ixopay/releases/tag/v2.3
[2.2.0]: https://github.com/ixopay/php-ixopay/releases/tag/v2.2
[2.1.13]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.13
[2.1.12]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.12
[2.1.11]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.11
[2.1.10]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.10
[2.1.9]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.9
[2.1.8]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.8
[2.1.7]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.7
[2.1.6]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.6
[2.1.5]: https://github.com/ixopay/php-ixopay/compare/v2.1.4...v2.1.5
[2.1.4]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.4
[2.1.3]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.3
[2.1.2]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.2
[2.1.1]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.1
[2.1.0]: https://github.com/ixopay/php-ixopay/releases/tag/v2.1.0
[2.0.2]: https://github.com/ixopay/php-ixopay/compare/v2.0.1...v2.0.2
[2.0.1]: https://github.com/ixopay/php-ixopay/compare/v2.0.0...v2.0.1
[2.0.0]: https://github.com/ixopay/php-ixopay/releases/tag/v2.0.0
[1.1.3]: https://github.com/ixopay/php-ixopay/compare/v1.1.2...v1.1.3
[1.1.2]: https://github.com/ixopay/php-ixopay/compare/v1.1.1...v1.1.2
[1.1.1]: https://github.com/ixopay/php-ixopay/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/ixopay/php-ixopay/compare/v1.0.20...v1.1.0
[1.0.20]: https://github.com/ixopay/php-ixopay/compare/v1.0.19...v1.0.20
[1.0.19]: https://github.com/ixopay/php-ixopay/compare/v1.0.18...v1.0.19
[1.0.18]: https://github.com/ixopay/php-ixopay/compare/v1.0.17...v1.0.18
[1.0.17]: https://github.com/ixopay/php-ixopay/compare/v1.0.16...v1.0.17
[1.0.16]: https://github.com/ixopay/php-ixopay/compare/v1.0.15...v1.0.16
[1.0.15]: https://github.com/ixopay/php-ixopay/releases/tag/v1.0.15
[1.0.14]: https://github.com/ixopay/php-ixopay/compare/v1.0.13...v1.0.14
[1.0.13]: https://github.com/ixopay/php-ixopay/compare/v1.0.12...v1.0.13
[1.0.12]: https://github.com/ixopay/php-ixopay/compare/v1.0.11...v1.0.12
[1.0.11]: https://github.com/ixopay/php-ixopay/compare/v1.0.10...v1.0.11
[1.0.10]: https://github.com/ixopay/php-ixopay/compare/v1.0.9...v1.0.10
[1.0.9]: https://github.com/ixopay/php-ixopay/compare/v1.0.8...v1.0.9
[1.0.8]: https://github.com/ixopay/php-ixopay/compare/v1.0.7...v1.0.8
[1.0.7]: https://github.com/ixopay/php-ixopay/compare/v1.0.6...v1.0.7
[1.0.6]: https://github.com/ixopay/php-ixopay/compare/v1.0.5...v1.0.6
[1.0.5]: https://github.com/ixopay/php-ixopay/compare/v1.0.4...v1.0.5
[1.0.4]: https://github.com/ixopay/php-ixopay/compare/v1.0.3...v1.0.4
[1.0.3]: https://github.com/ixopay/php-ixopay/compare/v1.0.2...v1.0.3
[1.0.2]: https://github.com/ixopay/php-ixopay/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/ixopay/php-ixopay/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/ixopay/php-ixopay/releases/tag/v1.0.0
