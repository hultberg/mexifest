# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.0] - 2018-06-21
### Added
- BC: WebpackManifestParser can now also parse more extensions, default: 'png', 'jpeg', 'jpg', 'gif', 'svg', 'js', 'css'
- BC: Changed the default parsing format to be an array with array values; index 0->fileName, index 1->filePath, index 2->ext
- Added methods `findByName`, `findByExtension` and `findAll` to `AssetManager`

## Changed:
- BC: Project now requires php 7.1
- Updated all composer dependencies

### Removed
- BC: Removed methods `getJavascripts` and `getStylesheets` from `AssetManager`

## [1.1.1] - 2017-08-11
### Fixed
- Use interface for Filesystem in webpack manifest parser.

## [1.1.0] - 2017-08-11
### Added
- Added `AssetManager::setAssets`.

## 1.0.0 - 2017-08-11
- Initial release of this project.

[Unreleased]: https://github.com/hultberg/mexifest/compare/v2.0.0...HEAD
[2.0.0]: https://github.com/hultberg/mexifest/compare/v1.1.1...v2.0.0
[1.1.1]: https://github.com/hultberg/mexifest/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/hultberg/mexifest/compare/v1.0.0...v1.1.0
