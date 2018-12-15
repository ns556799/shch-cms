-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 15, 2018 at 02:10 PM
-- Server version: 5.7.23
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `SS_mysite1`
--

-- --------------------------------------------------------

--
-- Table structure for table `ArchiveWidget`
--

CREATE TABLE `ArchiveWidget` (
  `ID` int(11) NOT NULL,
  `DisplayMode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Banner`
--

CREATE TABLE `Banner` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('Banner') DEFAULT 'Banner',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` mediumtext,
  `Description` mediumtext,
  `DraftMode` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `QuoteLayout` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ContentStyle` varchar(20) DEFAULT NULL,
  `SortOrder` int(11) NOT NULL DEFAULT '0',
  `MainImageID` int(11) NOT NULL DEFAULT '0',
  `PageID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Block`
--

CREATE TABLE `Block` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('Block','ContentBlock') DEFAULT 'Block',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `CanViewType` enum('Anyone','LoggedInUsers','OnlyTheseUsers') DEFAULT 'Anyone',
  `ExtraCSSClasses` varchar(50) DEFAULT NULL,
  `Weight` int(11) NOT NULL DEFAULT '0',
  `Area` varchar(50) DEFAULT NULL,
  `Published` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlockSet`
--

CREATE TABLE `BlockSet` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('BlockSet') DEFAULT 'BlockSet',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `IncludePageParent` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `PageTypesValue` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlockSet_Blocks`
--

CREATE TABLE `BlockSet_Blocks` (
  `ID` int(11) NOT NULL,
  `BlockSetID` int(11) NOT NULL DEFAULT '0',
  `BlockID` int(11) NOT NULL DEFAULT '0',
  `Sort` int(11) NOT NULL DEFAULT '0',
  `BlockArea` varchar(50) DEFAULT NULL,
  `AboveOrBelow` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlockSet_PageParents`
--

CREATE TABLE `BlockSet_PageParents` (
  `ID` int(11) NOT NULL,
  `BlockSetID` int(11) NOT NULL DEFAULT '0',
  `SiteTreeID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Block_Live`
--

CREATE TABLE `Block_Live` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('Block','ContentBlock') DEFAULT 'Block',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `CanViewType` enum('Anyone','LoggedInUsers','OnlyTheseUsers') DEFAULT 'Anyone',
  `ExtraCSSClasses` varchar(50) DEFAULT NULL,
  `Weight` int(11) NOT NULL DEFAULT '0',
  `Area` varchar(50) DEFAULT NULL,
  `Published` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Block_versions`
--

CREATE TABLE `Block_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `WasPublished` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `AuthorID` int(11) NOT NULL DEFAULT '0',
  `PublisherID` int(11) NOT NULL DEFAULT '0',
  `ClassName` enum('Block','ContentBlock') DEFAULT 'Block',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `CanViewType` enum('Anyone','LoggedInUsers','OnlyTheseUsers') DEFAULT 'Anyone',
  `ExtraCSSClasses` varchar(50) DEFAULT NULL,
  `Weight` int(11) NOT NULL DEFAULT '0',
  `Area` varchar(50) DEFAULT NULL,
  `Published` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Block_ViewerGroups`
--

CREATE TABLE `Block_ViewerGroups` (
  `ID` int(11) NOT NULL,
  `BlockID` int(11) NOT NULL DEFAULT '0',
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Blog`
--

CREATE TABLE `Blog` (
  `ID` int(11) NOT NULL,
  `PostsPerPage` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogArchiveWidget`
--

CREATE TABLE `BlogArchiveWidget` (
  `ID` int(11) NOT NULL,
  `NumberToDisplay` int(11) NOT NULL DEFAULT '0',
  `ArchiveType` enum('Monthly','Yearly') DEFAULT 'Monthly',
  `BlogID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogCategoriesWidget`
--

CREATE TABLE `BlogCategoriesWidget` (
  `ID` int(11) NOT NULL,
  `Limit` int(11) NOT NULL DEFAULT '0',
  `Order` varchar(50) DEFAULT NULL,
  `Direction` varchar(50) DEFAULT NULL,
  `BlogID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogCategory`
--

CREATE TABLE `BlogCategory` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('BlogCategory') DEFAULT 'BlogCategory',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `URLSegment` varchar(255) DEFAULT NULL,
  `BlogID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogEntry`
--

CREATE TABLE `BlogEntry` (
  `ID` int(11) NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Author` mediumtext,
  `Tags` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogEntry_Live`
--

CREATE TABLE `BlogEntry_Live` (
  `ID` int(11) NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Author` mediumtext,
  `Tags` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogEntry_versions`
--

CREATE TABLE `BlogEntry_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `Date` datetime DEFAULT NULL,
  `Author` mediumtext,
  `Tags` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogHolder`
--

CREATE TABLE `BlogHolder` (
  `ID` int(11) NOT NULL,
  `AllowCustomAuthors` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ShowFullEntry` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `OwnerID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogHolder_Live`
--

CREATE TABLE `BlogHolder_Live` (
  `ID` int(11) NOT NULL,
  `AllowCustomAuthors` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ShowFullEntry` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `OwnerID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogHolder_versions`
--

CREATE TABLE `BlogHolder_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `AllowCustomAuthors` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ShowFullEntry` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `OwnerID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogPost`
--

CREATE TABLE `BlogPost` (
  `ID` int(11) NOT NULL,
  `PublishDate` datetime DEFAULT NULL,
  `AuthorNames` varchar(1024) DEFAULT NULL,
  `Summary` mediumtext,
  `FeaturedImageID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogPost_Authors`
--

CREATE TABLE `BlogPost_Authors` (
  `ID` int(11) NOT NULL,
  `BlogPostID` int(11) NOT NULL DEFAULT '0',
  `MemberID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogPost_Categories`
--

CREATE TABLE `BlogPost_Categories` (
  `ID` int(11) NOT NULL,
  `BlogPostID` int(11) NOT NULL DEFAULT '0',
  `BlogCategoryID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogPost_Live`
--

CREATE TABLE `BlogPost_Live` (
  `ID` int(11) NOT NULL,
  `PublishDate` datetime DEFAULT NULL,
  `AuthorNames` varchar(1024) DEFAULT NULL,
  `Summary` mediumtext,
  `FeaturedImageID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogPost_Tags`
--

CREATE TABLE `BlogPost_Tags` (
  `ID` int(11) NOT NULL,
  `BlogPostID` int(11) NOT NULL DEFAULT '0',
  `BlogTagID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogPost_versions`
--

CREATE TABLE `BlogPost_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `PublishDate` datetime DEFAULT NULL,
  `AuthorNames` varchar(1024) DEFAULT NULL,
  `Summary` mediumtext,
  `FeaturedImageID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogRecentPostsWidget`
--

CREATE TABLE `BlogRecentPostsWidget` (
  `ID` int(11) NOT NULL,
  `NumberOfPosts` int(11) NOT NULL DEFAULT '0',
  `BlogID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogTag`
--

CREATE TABLE `BlogTag` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('BlogTag') DEFAULT 'BlogTag',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `URLSegment` varchar(255) DEFAULT NULL,
  `BlogID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogTagsCloudWidget`
--

CREATE TABLE `BlogTagsCloudWidget` (
  `ID` int(11) NOT NULL,
  `BlogID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogTagsWidget`
--

CREATE TABLE `BlogTagsWidget` (
  `ID` int(11) NOT NULL,
  `Limit` int(11) NOT NULL DEFAULT '0',
  `Order` varchar(50) DEFAULT NULL,
  `Direction` varchar(50) DEFAULT NULL,
  `BlogID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogTree`
--

CREATE TABLE `BlogTree` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `LandingPageFreshness` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogTree_Live`
--

CREATE TABLE `BlogTree_Live` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `LandingPageFreshness` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BlogTree_versions`
--

CREATE TABLE `BlogTree_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(255) DEFAULT NULL,
  `LandingPageFreshness` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Blog_Contributors`
--

CREATE TABLE `Blog_Contributors` (
  `ID` int(11) NOT NULL,
  `BlogID` int(11) NOT NULL DEFAULT '0',
  `MemberID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Blog_Editors`
--

CREATE TABLE `Blog_Editors` (
  `ID` int(11) NOT NULL,
  `BlogID` int(11) NOT NULL DEFAULT '0',
  `MemberID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Blog_Live`
--

CREATE TABLE `Blog_Live` (
  `ID` int(11) NOT NULL,
  `PostsPerPage` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Blog_versions`
--

CREATE TABLE `Blog_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `PostsPerPage` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Blog_Writers`
--

CREATE TABLE `Blog_Writers` (
  `ID` int(11) NOT NULL,
  `BlogID` int(11) NOT NULL DEFAULT '0',
  `MemberID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ContentBlock`
--

CREATE TABLE `ContentBlock` (
  `ID` int(11) NOT NULL,
  `Content` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ContentBlock_Live`
--

CREATE TABLE `ContentBlock_Live` (
  `ID` int(11) NOT NULL,
  `Content` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ContentBlock_versions`
--

CREATE TABLE `ContentBlock_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `Content` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableCheckbox`
--

CREATE TABLE `EditableCheckbox` (
  `ID` int(11) NOT NULL,
  `CheckedDefault` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableCheckbox_Live`
--

CREATE TABLE `EditableCheckbox_Live` (
  `ID` int(11) NOT NULL,
  `CheckedDefault` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableCheckbox_versions`
--

CREATE TABLE `EditableCheckbox_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `CheckedDefault` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableCustomRule`
--

CREATE TABLE `EditableCustomRule` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('EditableCustomRule') DEFAULT 'EditableCustomRule',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Display` enum('Show','Hide') DEFAULT 'Show',
  `ConditionOption` enum('IsBlank','IsNotBlank','HasValue','ValueNot','ValueLessThan','ValueLessThanEqual','ValueGreaterThan','ValueGreaterThanEqual') DEFAULT 'IsBlank',
  `FieldValue` varchar(50) DEFAULT NULL,
  `Version` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `ConditionFieldID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableCustomRule_Live`
--

CREATE TABLE `EditableCustomRule_Live` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('EditableCustomRule') DEFAULT 'EditableCustomRule',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Display` enum('Show','Hide') DEFAULT 'Show',
  `ConditionOption` enum('IsBlank','IsNotBlank','HasValue','ValueNot','ValueLessThan','ValueLessThanEqual','ValueGreaterThan','ValueGreaterThanEqual') DEFAULT 'IsBlank',
  `FieldValue` varchar(50) DEFAULT NULL,
  `Version` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `ConditionFieldID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableCustomRule_versions`
--

CREATE TABLE `EditableCustomRule_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `WasPublished` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `AuthorID` int(11) NOT NULL DEFAULT '0',
  `PublisherID` int(11) NOT NULL DEFAULT '0',
  `ClassName` enum('EditableCustomRule') DEFAULT 'EditableCustomRule',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Display` enum('Show','Hide') DEFAULT 'Show',
  `ConditionOption` enum('IsBlank','IsNotBlank','HasValue','ValueNot','ValueLessThan','ValueLessThanEqual','ValueGreaterThan','ValueGreaterThanEqual') DEFAULT 'IsBlank',
  `FieldValue` varchar(50) DEFAULT NULL,
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `ConditionFieldID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableDateField`
--

CREATE TABLE `EditableDateField` (
  `ID` int(11) NOT NULL,
  `DefaultToToday` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableDateField_Live`
--

CREATE TABLE `EditableDateField_Live` (
  `ID` int(11) NOT NULL,
  `DefaultToToday` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableDateField_versions`
--

CREATE TABLE `EditableDateField_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `DefaultToToday` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableEmailField`
--

CREATE TABLE `EditableEmailField` (
  `ID` int(11) NOT NULL,
  `Placeholder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableEmailField_Live`
--

CREATE TABLE `EditableEmailField_Live` (
  `ID` int(11) NOT NULL,
  `Placeholder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableEmailField_versions`
--

CREATE TABLE `EditableEmailField_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `Placeholder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFieldGroup`
--

CREATE TABLE `EditableFieldGroup` (
  `ID` int(11) NOT NULL,
  `EndID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFieldGroup_Live`
--

CREATE TABLE `EditableFieldGroup_Live` (
  `ID` int(11) NOT NULL,
  `EndID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFieldGroup_versions`
--

CREATE TABLE `EditableFieldGroup_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `EndID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFileField`
--

CREATE TABLE `EditableFileField` (
  `ID` int(11) NOT NULL,
  `FolderID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFileField_Live`
--

CREATE TABLE `EditableFileField_Live` (
  `ID` int(11) NOT NULL,
  `FolderID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFileField_versions`
--

CREATE TABLE `EditableFileField_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `FolderID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFormField`
--

CREATE TABLE `EditableFormField` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('EditableFormField','EditableCheckbox','EditableCountryDropdownField','EditableDateField','EditableEmailField','EditableFieldGroup','EditableFieldGroupEnd','EditableFileField','EditableFormHeading','EditableFormStep','EditableLiteralField','EditableMemberListField','EditableMultipleOptionField','EditableCheckboxGroupField','EditableDropdown','EditableRadioField','EditableNumericField','EditableTextField') DEFAULT 'EditableFormField',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Default` varchar(255) DEFAULT NULL,
  `Sort` int(11) NOT NULL DEFAULT '0',
  `Required` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `CustomErrorMessage` varchar(255) DEFAULT NULL,
  `CustomRules` mediumtext,
  `CustomSettings` mediumtext,
  `Migrated` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ExtraClass` mediumtext,
  `RightTitle` varchar(255) DEFAULT NULL,
  `ShowOnLoad` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `Version` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFormField_Live`
--

CREATE TABLE `EditableFormField_Live` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('EditableFormField','EditableCheckbox','EditableCountryDropdownField','EditableDateField','EditableEmailField','EditableFieldGroup','EditableFieldGroupEnd','EditableFileField','EditableFormHeading','EditableFormStep','EditableLiteralField','EditableMemberListField','EditableMultipleOptionField','EditableCheckboxGroupField','EditableDropdown','EditableRadioField','EditableNumericField','EditableTextField') DEFAULT 'EditableFormField',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Default` varchar(255) DEFAULT NULL,
  `Sort` int(11) NOT NULL DEFAULT '0',
  `Required` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `CustomErrorMessage` varchar(255) DEFAULT NULL,
  `CustomRules` mediumtext,
  `CustomSettings` mediumtext,
  `Migrated` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ExtraClass` mediumtext,
  `RightTitle` varchar(255) DEFAULT NULL,
  `ShowOnLoad` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `Version` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFormField_versions`
--

CREATE TABLE `EditableFormField_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `WasPublished` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `AuthorID` int(11) NOT NULL DEFAULT '0',
  `PublisherID` int(11) NOT NULL DEFAULT '0',
  `ClassName` enum('EditableFormField','EditableCheckbox','EditableCountryDropdownField','EditableDateField','EditableEmailField','EditableFieldGroup','EditableFieldGroupEnd','EditableFileField','EditableFormHeading','EditableFormStep','EditableLiteralField','EditableMemberListField','EditableMultipleOptionField','EditableCheckboxGroupField','EditableDropdown','EditableRadioField','EditableNumericField','EditableTextField') DEFAULT 'EditableFormField',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Default` varchar(255) DEFAULT NULL,
  `Sort` int(11) NOT NULL DEFAULT '0',
  `Required` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `CustomErrorMessage` varchar(255) DEFAULT NULL,
  `CustomRules` mediumtext,
  `CustomSettings` mediumtext,
  `Migrated` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ExtraClass` mediumtext,
  `RightTitle` varchar(255) DEFAULT NULL,
  `ShowOnLoad` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFormHeading`
--

CREATE TABLE `EditableFormHeading` (
  `ID` int(11) NOT NULL,
  `Level` int(11) NOT NULL DEFAULT '3',
  `HideFromReports` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFormHeading_Live`
--

CREATE TABLE `EditableFormHeading_Live` (
  `ID` int(11) NOT NULL,
  `Level` int(11) NOT NULL DEFAULT '3',
  `HideFromReports` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableFormHeading_versions`
--

CREATE TABLE `EditableFormHeading_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `Level` int(11) NOT NULL DEFAULT '3',
  `HideFromReports` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableLiteralField`
--

CREATE TABLE `EditableLiteralField` (
  `ID` int(11) NOT NULL,
  `Content` mediumtext,
  `HideFromReports` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HideLabel` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableLiteralField_Live`
--

CREATE TABLE `EditableLiteralField_Live` (
  `ID` int(11) NOT NULL,
  `Content` mediumtext,
  `HideFromReports` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HideLabel` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableLiteralField_versions`
--

CREATE TABLE `EditableLiteralField_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `Content` mediumtext,
  `HideFromReports` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HideLabel` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableMemberListField`
--

CREATE TABLE `EditableMemberListField` (
  `ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableMemberListField_Live`
--

CREATE TABLE `EditableMemberListField_Live` (
  `ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableMemberListField_versions`
--

CREATE TABLE `EditableMemberListField_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableNumericField`
--

CREATE TABLE `EditableNumericField` (
  `ID` int(11) NOT NULL,
  `MinValue` int(11) NOT NULL DEFAULT '0',
  `MaxValue` int(11) NOT NULL DEFAULT '0',
  `Placeholder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableNumericField_Live`
--

CREATE TABLE `EditableNumericField_Live` (
  `ID` int(11) NOT NULL,
  `MinValue` int(11) NOT NULL DEFAULT '0',
  `MaxValue` int(11) NOT NULL DEFAULT '0',
  `Placeholder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableNumericField_versions`
--

CREATE TABLE `EditableNumericField_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `MinValue` int(11) NOT NULL DEFAULT '0',
  `MaxValue` int(11) NOT NULL DEFAULT '0',
  `Placeholder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableOption`
--

CREATE TABLE `EditableOption` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('EditableOption') DEFAULT 'EditableOption',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Default` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `Sort` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableOption_Live`
--

CREATE TABLE `EditableOption_Live` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('EditableOption') DEFAULT 'EditableOption',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Default` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `Sort` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableOption_versions`
--

CREATE TABLE `EditableOption_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `WasPublished` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `AuthorID` int(11) NOT NULL DEFAULT '0',
  `PublisherID` int(11) NOT NULL DEFAULT '0',
  `ClassName` enum('EditableOption') DEFAULT 'EditableOption',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Default` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `Sort` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableTextField`
--

CREATE TABLE `EditableTextField` (
  `ID` int(11) NOT NULL,
  `MinLength` int(11) NOT NULL DEFAULT '0',
  `MaxLength` int(11) NOT NULL DEFAULT '0',
  `Rows` int(11) NOT NULL DEFAULT '1',
  `Placeholder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableTextField_Live`
--

CREATE TABLE `EditableTextField_Live` (
  `ID` int(11) NOT NULL,
  `MinLength` int(11) NOT NULL DEFAULT '0',
  `MaxLength` int(11) NOT NULL DEFAULT '0',
  `Rows` int(11) NOT NULL DEFAULT '1',
  `Placeholder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `EditableTextField_versions`
--

CREATE TABLE `EditableTextField_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `MinLength` int(11) NOT NULL DEFAULT '0',
  `MaxLength` int(11) NOT NULL DEFAULT '0',
  `Rows` int(11) NOT NULL DEFAULT '1',
  `Placeholder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ErrorPage`
--

CREATE TABLE `ErrorPage` (
  `ID` int(11) NOT NULL,
  `ErrorCode` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ErrorPage`
--

INSERT INTO `ErrorPage` (`ID`, `ErrorCode`) VALUES
(7, 404),
(8, 500);

-- --------------------------------------------------------

--
-- Table structure for table `ErrorPage_Live`
--

CREATE TABLE `ErrorPage_Live` (
  `ID` int(11) NOT NULL,
  `ErrorCode` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ErrorPage_Live`
--

INSERT INTO `ErrorPage_Live` (`ID`, `ErrorCode`) VALUES
(7, 404),
(8, 500);

-- --------------------------------------------------------

--
-- Table structure for table `ErrorPage_versions`
--

CREATE TABLE `ErrorPage_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `ErrorCode` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ErrorPage_versions`
--

INSERT INTO `ErrorPage_versions` (`ID`, `RecordID`, `Version`, `ErrorCode`) VALUES
(1, 7, 1, 404),
(2, 8, 1, 500),
(3, 7, 2, 404),
(4, 8, 2, 500);

-- --------------------------------------------------------

--
-- Table structure for table `File`
--

CREATE TABLE `File` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('File','Folder','Image','Image_Cached') DEFAULT 'File',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Filename` mediumtext,
  `Content` mediumtext,
  `ShowInSearch` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `CanViewType` enum('Anyone','LoggedInUsers','OnlyTheseUsers','Inherit') DEFAULT 'Inherit',
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `OwnerID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `File_ViewerGroups`
--

CREATE TABLE `File_ViewerGroups` (
  `ID` int(11) NOT NULL,
  `FileID` int(11) NOT NULL DEFAULT '0',
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Footer`
--

CREATE TABLE `Footer` (
  `ID` int(11) NOT NULL,
  `CookieMessage` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Footer`
--

INSERT INTO `Footer` (`ID`, `CookieMessage`) VALUES
(3, '<p>By closing this message, you consent to our cookies on this device in accordance with our <a href=\"http://www.google.com\">cookie notice</a>, unless you have disabled them</p>');

-- --------------------------------------------------------

--
-- Table structure for table `Footer_Live`
--

CREATE TABLE `Footer_Live` (
  `ID` int(11) NOT NULL,
  `CookieMessage` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Footer_Live`
--

INSERT INTO `Footer_Live` (`ID`, `CookieMessage`) VALUES
(3, '<p>By closing this message, you consent to our cookies on this device in accordance with our <a href=\"http://www.google.com\">cookie notice</a>, unless you have disabled them</p>');

-- --------------------------------------------------------

--
-- Table structure for table `Footer_versions`
--

CREATE TABLE `Footer_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `CookieMessage` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Footer_versions`
--

INSERT INTO `Footer_versions` (`ID`, `RecordID`, `Version`, `CookieMessage`) VALUES
(1, 3, 2, '<p>By closing this message, you consent to our cookies on this device in accordance with our cookie notice, unless you have disabled them</p>'),
(2, 3, 3, '<p>By closing this message, you consent to our cookies on this device in accordance with our <a href=\"http://www.google.com\">cookie notice</a>, unless you have disabled them</p>');

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

CREATE TABLE `Group` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('Group') DEFAULT 'Group',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` mediumtext,
  `Code` varchar(255) DEFAULT NULL,
  `Locked` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `Sort` int(11) NOT NULL DEFAULT '0',
  `HtmlEditorConfig` mediumtext,
  `GoToAdmin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `LinkedPageID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Group`
--

INSERT INTO `Group` (`ID`, `ClassName`, `LastEdited`, `Created`, `Title`, `Description`, `Code`, `Locked`, `Sort`, `HtmlEditorConfig`, `GoToAdmin`, `ParentID`, `LinkedPageID`) VALUES
(1, 'Group', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'Content Authors', NULL, 'content-authors', 0, 1, NULL, 0, 0, 0),
(2, 'Group', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'Administrators', NULL, 'administrators', 0, 0, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Group_Members`
--

CREATE TABLE `Group_Members` (
  `ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0',
  `MemberID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Group_Members`
--

INSERT INTO `Group_Members` (`ID`, `GroupID`, `MemberID`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Group_Roles`
--

CREATE TABLE `Group_Roles` (
  `ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0',
  `PermissionRoleID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Image`
--

CREATE TABLE `Image` (
  `ID` int(11) NOT NULL,
  `Description` mediumtext,
  `PanelFormat` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `LoginAttempt`
--

CREATE TABLE `LoginAttempt` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('LoginAttempt') DEFAULT 'LoginAttempt',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Status` enum('Success','Failure') DEFAULT 'Success',
  `IP` varchar(255) DEFAULT NULL,
  `MemberID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `LoginAttempt`
--

INSERT INTO `LoginAttempt` (`ID`, `ClassName`, `LastEdited`, `Created`, `Email`, `Status`, `IP`, `MemberID`) VALUES
(1, 'LoginAttempt', '2018-12-15 12:12:08', '2018-12-15 12:12:08', 'webmaster@7dots.co.uk', 'Success', '::1', 1),
(2, 'LoginAttempt', '2018-12-15 12:54:02', '2018-12-15 12:54:02', 'webmaster@7dots.co.uk', 'Success', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Member`
--

CREATE TABLE `Member` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('Member') DEFAULT 'Member',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `Surname` varchar(50) DEFAULT NULL,
  `Email` varchar(254) DEFAULT NULL,
  `TempIDHash` varchar(160) DEFAULT NULL,
  `TempIDExpired` datetime DEFAULT NULL,
  `Password` varchar(160) DEFAULT NULL,
  `RememberLoginToken` varchar(160) DEFAULT NULL,
  `NumVisit` int(11) NOT NULL DEFAULT '0',
  `LastVisited` datetime DEFAULT NULL,
  `AutoLoginHash` varchar(160) DEFAULT NULL,
  `AutoLoginExpired` datetime DEFAULT NULL,
  `PasswordEncryption` varchar(50) DEFAULT NULL,
  `Salt` varchar(50) DEFAULT NULL,
  `PasswordExpiry` date DEFAULT NULL,
  `LockedOutUntil` datetime DEFAULT NULL,
  `Locale` varchar(6) DEFAULT NULL,
  `FailedLoginCount` int(11) NOT NULL DEFAULT '0',
  `DateFormat` varchar(30) DEFAULT NULL,
  `TimeFormat` varchar(30) DEFAULT NULL,
  `Company` varchar(50) DEFAULT NULL,
  `ScreenName` varchar(50) DEFAULT NULL,
  `URLSegment` varchar(255) DEFAULT NULL,
  `BlogProfileSummary` mediumtext,
  `BlogProfileImageID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Member`
--

INSERT INTO `Member` (`ID`, `ClassName`, `LastEdited`, `Created`, `FirstName`, `Surname`, `Email`, `TempIDHash`, `TempIDExpired`, `Password`, `RememberLoginToken`, `NumVisit`, `LastVisited`, `AutoLoginHash`, `AutoLoginExpired`, `PasswordEncryption`, `Salt`, `PasswordExpiry`, `LockedOutUntil`, `Locale`, `FailedLoginCount`, `DateFormat`, `TimeFormat`, `Company`, `ScreenName`, `URLSegment`, `BlogProfileSummary`, `BlogProfileImageID`) VALUES
(1, 'Member', '2018-12-15 12:54:02', '2018-12-15 12:11:09', 'Default Admin', NULL, 'webmaster@7dots.co.uk', 'ef9bf1a9eb84cedc1660f789af6a76f472cfda56', '2018-12-18 12:54:02', NULL, NULL, 2, '2018-12-15 12:28:17', NULL, NULL, NULL, NULL, NULL, NULL, 'en_GB', 0, NULL, NULL, NULL, NULL, 'default-admin', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `MemberPassword`
--

CREATE TABLE `MemberPassword` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('MemberPassword') DEFAULT 'MemberPassword',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Password` varchar(160) DEFAULT NULL,
  `Salt` varchar(50) DEFAULT NULL,
  `PasswordEncryption` varchar(50) DEFAULT NULL,
  `MemberID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `NewsletterSnippet`
--

CREATE TABLE `NewsletterSnippet` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('NewsletterSnippet') DEFAULT 'NewsletterSnippet',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` mediumtext,
  `Snippet` mediumtext,
  `SubsiteID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Page`
--

CREATE TABLE `Page` (
  `ID` int(11) NOT NULL,
  `ShortDescription` mediumtext,
  `Content2` mediumtext,
  `Content3` mediumtext,
  `Content4` mediumtext,
  `MainImageID` int(11) NOT NULL DEFAULT '0',
  `ListImageID` int(11) NOT NULL DEFAULT '0',
  `AttachmentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Page`
--

INSERT INTO `Page` (`ID`, `ShortDescription`, `Content2`, `Content3`, `Content4`, `MainImageID`, `ListImageID`, `AttachmentID`) VALUES
(1, NULL, NULL, NULL, NULL, 0, 0, 0),
(2, NULL, NULL, NULL, NULL, 0, 0, 0),
(3, NULL, NULL, NULL, NULL, 0, 0, 0),
(4, NULL, NULL, NULL, NULL, 0, 0, 0),
(5, NULL, NULL, NULL, NULL, 0, 0, 0),
(6, NULL, NULL, NULL, NULL, 0, 0, 0),
(7, NULL, NULL, NULL, NULL, 0, 0, 0),
(8, NULL, NULL, NULL, NULL, 0, 0, 0),
(9, NULL, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Page_Live`
--

CREATE TABLE `Page_Live` (
  `ID` int(11) NOT NULL,
  `ShortDescription` mediumtext,
  `Content2` mediumtext,
  `Content3` mediumtext,
  `Content4` mediumtext,
  `MainImageID` int(11) NOT NULL DEFAULT '0',
  `ListImageID` int(11) NOT NULL DEFAULT '0',
  `AttachmentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Page_Live`
--

INSERT INTO `Page_Live` (`ID`, `ShortDescription`, `Content2`, `Content3`, `Content4`, `MainImageID`, `ListImageID`, `AttachmentID`) VALUES
(1, NULL, NULL, NULL, NULL, 0, 0, 0),
(2, NULL, NULL, NULL, NULL, 0, 0, 0),
(3, NULL, NULL, NULL, NULL, 0, 0, 0),
(4, NULL, NULL, NULL, NULL, 0, 0, 0),
(5, NULL, NULL, NULL, NULL, 0, 0, 0),
(6, NULL, NULL, NULL, NULL, 0, 0, 0),
(7, NULL, NULL, NULL, NULL, 0, 0, 0),
(8, NULL, NULL, NULL, NULL, 0, 0, 0),
(9, NULL, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Page_OtherImages`
--

CREATE TABLE `Page_OtherImages` (
  `ID` int(11) NOT NULL,
  `PageID` int(11) NOT NULL DEFAULT '0',
  `ImageID` int(11) NOT NULL DEFAULT '0',
  `SortOrder` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Page_versions`
--

CREATE TABLE `Page_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `ShortDescription` mediumtext,
  `Content2` mediumtext,
  `Content3` mediumtext,
  `Content4` mediumtext,
  `MainImageID` int(11) NOT NULL DEFAULT '0',
  `ListImageID` int(11) NOT NULL DEFAULT '0',
  `AttachmentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Page_versions`
--

INSERT INTO `Page_versions` (`ID`, `RecordID`, `Version`, `ShortDescription`, `Content2`, `Content3`, `Content4`, `MainImageID`, `ListImageID`, `AttachmentID`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, 0, 0, 0),
(2, 2, 1, NULL, NULL, NULL, NULL, 0, 0, 0),
(3, 3, 1, NULL, NULL, NULL, NULL, 0, 0, 0),
(4, 4, 1, NULL, NULL, NULL, NULL, 0, 0, 0),
(5, 5, 1, NULL, NULL, NULL, NULL, 0, 0, 0),
(6, 6, 1, NULL, NULL, NULL, NULL, 0, 0, 0),
(7, 7, 1, NULL, NULL, NULL, NULL, 0, 0, 0),
(8, 8, 1, NULL, NULL, NULL, NULL, 0, 0, 0),
(9, 9, 1, NULL, NULL, NULL, NULL, 0, 0, 0),
(10, 7, 2, NULL, NULL, NULL, NULL, 0, 0, 0),
(11, 8, 2, NULL, NULL, NULL, NULL, 0, 0, 0),
(12, 4, 2, NULL, NULL, NULL, NULL, 0, 0, 0),
(13, 5, 2, NULL, NULL, NULL, NULL, 0, 0, 0),
(14, 3, 2, NULL, NULL, NULL, NULL, 0, 0, 0),
(15, 5, 3, NULL, NULL, NULL, NULL, 0, 0, 0),
(16, 3, 3, NULL, NULL, NULL, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Permission`
--

CREATE TABLE `Permission` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('Permission') DEFAULT 'Permission',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Code` varchar(255) DEFAULT NULL,
  `Arg` int(11) NOT NULL DEFAULT '0',
  `Type` int(11) NOT NULL DEFAULT '1',
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Permission`
--

INSERT INTO `Permission` (`ID`, `ClassName`, `LastEdited`, `Created`, `Code`, `Arg`, `Type`, `GroupID`) VALUES
(1, 'Permission', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'CMS_ACCESS_CMSMain', 0, 1, 1),
(2, 'Permission', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'CMS_ACCESS_AssetAdmin', 0, 1, 1),
(3, 'Permission', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'CMS_ACCESS_ReportAdmin', 0, 1, 1),
(4, 'Permission', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'SITETREE_REORGANISE', 0, 1, 1),
(5, 'Permission', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'ADMIN', 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `PermissionRole`
--

CREATE TABLE `PermissionRole` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('PermissionRole') DEFAULT 'PermissionRole',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `OnlyAdminCanApply` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `PermissionRoleCode`
--

CREATE TABLE `PermissionRoleCode` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('PermissionRoleCode') DEFAULT 'PermissionRoleCode',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Code` varchar(50) DEFAULT NULL,
  `RoleID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `RedirectorPage`
--

CREATE TABLE `RedirectorPage` (
  `ID` int(11) NOT NULL,
  `RedirectionType` enum('Internal','External') DEFAULT 'Internal',
  `ExternalURL` varchar(2083) DEFAULT NULL,
  `LinkToID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `RedirectorPage_Live`
--

CREATE TABLE `RedirectorPage_Live` (
  `ID` int(11) NOT NULL,
  `RedirectionType` enum('Internal','External') DEFAULT 'Internal',
  `ExternalURL` varchar(2083) DEFAULT NULL,
  `LinkToID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `RedirectorPage_versions`
--

CREATE TABLE `RedirectorPage_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `RedirectionType` enum('Internal','External') DEFAULT 'Internal',
  `ExternalURL` varchar(2083) DEFAULT NULL,
  `LinkToID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SiteConfig`
--

CREATE TABLE `SiteConfig` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('SiteConfig') DEFAULT 'SiteConfig',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Tagline` varchar(255) DEFAULT NULL,
  `Theme` varchar(255) DEFAULT NULL,
  `CanViewType` enum('Anyone','LoggedInUsers','OnlyTheseUsers') DEFAULT 'Anyone',
  `CanEditType` enum('LoggedInUsers','OnlyTheseUsers') DEFAULT 'LoggedInUsers',
  `CanCreateTopLevelType` enum('LoggedInUsers','OnlyTheseUsers') DEFAULT 'LoggedInUsers',
  `AdminEmail` mediumtext,
  `SocialLinkLinkedIn` mediumtext,
  `SocialLinkFacebook` mediumtext,
  `SocialLinkTwitter` mediumtext,
  `SocialLinkYouTube` mediumtext,
  `SocialLinkPinterest` mediumtext,
  `SocialLinkInstagram` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SiteConfig`
--

INSERT INTO `SiteConfig` (`ID`, `ClassName`, `LastEdited`, `Created`, `Title`, `Tagline`, `Theme`, `CanViewType`, `CanEditType`, `CanCreateTopLevelType`, `AdminEmail`, `SocialLinkLinkedIn`, `SocialLinkFacebook`, `SocialLinkTwitter`, `SocialLinkYouTube`, `SocialLinkPinterest`, `SocialLinkInstagram`) VALUES
(1, 'SiteConfig', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'Your Site Name', 'your tagline here', NULL, 'Anyone', 'LoggedInUsers', 'LoggedInUsers', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `SiteConfig_Blocks`
--

CREATE TABLE `SiteConfig_Blocks` (
  `ID` int(11) NOT NULL,
  `SiteConfigID` int(11) NOT NULL DEFAULT '0',
  `BlockID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SiteConfig_CreateTopLevelGroups`
--

CREATE TABLE `SiteConfig_CreateTopLevelGroups` (
  `ID` int(11) NOT NULL,
  `SiteConfigID` int(11) NOT NULL DEFAULT '0',
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SiteConfig_EditorGroups`
--

CREATE TABLE `SiteConfig_EditorGroups` (
  `ID` int(11) NOT NULL,
  `SiteConfigID` int(11) NOT NULL DEFAULT '0',
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SiteConfig_ViewerGroups`
--

CREATE TABLE `SiteConfig_ViewerGroups` (
  `ID` int(11) NOT NULL,
  `SiteConfigID` int(11) NOT NULL DEFAULT '0',
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SiteTree`
--

CREATE TABLE `SiteTree` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('SiteTree','Page','ContentPage','HomePage','Blog','BlogPost','BlogEntry','ErrorPage','RedirectorPage','VirtualPage','CustomVirtualPage','CmsFolder','Footer','Header','UserDefinedForm','BlogTree','BlogHolder') DEFAULT 'SiteTree',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `URLSegment` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `MenuTitle` varchar(100) DEFAULT NULL,
  `Content` mediumtext,
  `MetaDescription` mediumtext,
  `ExtraMeta` mediumtext,
  `ShowInMenus` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ShowInSearch` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `Sort` int(11) NOT NULL DEFAULT '0',
  `HasBrokenFile` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HasBrokenLink` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ReportClass` varchar(50) DEFAULT NULL,
  `CanViewType` enum('Anyone','LoggedInUsers','OnlyTheseUsers','Inherit') DEFAULT 'Inherit',
  `CanEditType` enum('LoggedInUsers','OnlyTheseUsers','Inherit') DEFAULT 'Inherit',
  `Priority` varchar(5) DEFAULT NULL,
  `InheritBlockSets` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `MetaTitle` varchar(255) DEFAULT NULL,
  `Version` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SiteTree`
--

INSERT INTO `SiteTree` (`ID`, `ClassName`, `LastEdited`, `Created`, `URLSegment`, `Title`, `MenuTitle`, `Content`, `MetaDescription`, `ExtraMeta`, `ShowInMenus`, `ShowInSearch`, `Sort`, `HasBrokenFile`, `HasBrokenLink`, `ReportClass`, `CanViewType`, `CanEditType`, `Priority`, `InheritBlockSets`, `MetaTitle`, `Version`, `ParentID`) VALUES
(1, 'HomePage', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'home', 'Home', NULL, '<p>Welcome to the homepage</p>', NULL, NULL, 1, 1, 1, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 1, 0),
(2, 'ContentPage', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'default-styles', 'Default styles', NULL, '\n<h1>This is a heading 1 with <a href=\"[sitetree_link,id=1]\">a link</a> <em>and emphasis</em></h1>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis sem, sagittis vitae congue id, volutpat at lorem. <a href=\"[sitetree_link,id=1]\">Pellentesque pharetra</a> risus id lorem ullamcorper tristique. Cras nunc felis, euismod non aliquam et, hendrerit ac felis.</p>\n<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Sed felis sem, sagittis vitae congue id, volutpat at lorem. Pellentesque <em>pharetra risus id lorem ullamcorper</em> tristique. <span style=\"text-decoration: underline;\">Cras nunc felis</span>, euismod non aliquam et, hendrerit ac felis.</p>\n<h2>This is a heading 2 with <a href=\"[sitetree_link,id=1]\">a link</a> <em>and emphasis</em></h2>\n<p>Fusce convallis pretium neque, id ultrices arcu pretium vel. Nulla eget tempus erat. Etiam aliquet, neque nec rutrum mattis, risus magna elementum nisi, sed ultrices arcu purus id tortor. Duis nec condimentum orci. Ut a odio eget justo iaculis ornare a vel elit.</p>\n<p>Some bullet points:</p>\n<ul><li>Integer mattis sollicitudin <a href=\"[sitetree_link,id=1]\">this is a link</a> massa, ac imperdiet sapien viverra in.</li>\n<li>Mauris ultricies elit sed nulla pulvinar adipiscing.\n	<ul><li>A sublist item.</li>\n		<li>Integer mattis sollicitudin <a href=\"[sitetree_link,id=1]\">this is a link</a> massa, ac imperdiet sapien viverra in.</li>\n		<li>Mauris ultricies elit sed nulla pulvinar adipiscing.\n	</li></ul></li>\n<li>Mauris viverra, mauris vel commodo semper, sem tellus hendrerit justo, et gravida leo ante auctor ante.</li>\n<li>Nam ac est eget est feugiat dictum et at augue.</li>\n</ul><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus eu lorem a tortor mollis posuere at nec est. Morbi ac laoreet lorem. Sed imperdiet orci quis enim pharetra vel posuere sapien luctus. Sed sit amet leo ut mauris varius fringilla.</p>\n<p>And now for an ordered list:</p>\n<ol><li>Integer mattis sollicitudin <a href=\"[sitetree_link,id=1]\">this is a link</a> massa, ac imperdiet sapien viverra in.</li>\n<li>Mauris ultricies elit sed nulla pulvinar adipiscing.</li>\n<li>Mauris viverra, mauris vel commodo semper, sem tellus hendrerit justo, et gravida leo ante auctor ante.</li>\n<li>Nam ac est eget est feugiat dictum et at augue.</li>\n</ol><p>Nam dignissim fringilla neque vitae feugiat. Sed vel libero lorem, id ornare dui. Aliquam eget erat sed ligula venenatis adipiscing eu at felis.</p>\n<h3>This is a heading 3 with <a href=\"[sitetree_link,id=1]\">a link</a> <em>and emphasis</em></h3>\n<p>Nam dignissim fringilla neque vitae feugiat. Sed vel libero lorem, id ornare dui. Aliquam eget erat sed ligula venenatis adipiscing eu at felis. Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<hr><p> </p>\n<p>Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<p style=\"text-align: center;\">Some centred text</p>\n<p style=\"text-align: center;\">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<p style=\"text-align: left;\">Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<h2>Another heading 2 immediately followed by...</h2>\n<h3>A heading 3</h3>\n<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>\n<p>And now a blockquote:</p>\n<blockquote>\n<p>Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n</blockquote>\n<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>\n<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>\n<p> </p>\n										', NULL, NULL, 1, 1, 2, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 1, 0),
(3, 'Footer', '2018-12-15 12:25:42', '2018-12-15 12:11:09', 'company', 'Company', NULL, NULL, NULL, NULL, 0, 0, 3, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 3, 0),
(4, 'ContentPage', '2018-12-15 12:25:43', '2018-12-15 12:11:09', 'terms-and-conditions', 'Terms and conditions', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 2, 3),
(5, 'ContentPage', '2018-12-15 12:25:43', '2018-12-15 12:11:09', 'privacy-policy', 'Privacy policy', NULL, NULL, NULL, NULL, 1, 1, 2, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 2, 3),
(6, 'Header', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'header', 'Header', NULL, NULL, NULL, NULL, 0, 0, 3, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 1, 0),
(7, 'ErrorPage', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'page-not-found', 'Page not found', NULL, '<p>Sorry, it seems you were trying to access a page that doesn\'t exist.</p><p>Please check the spelling of the URL you were trying to access and try again.</p>', NULL, NULL, 0, 0, 4, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 2, 9),
(8, 'ErrorPage', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'server-error', 'Server error', NULL, '<p>Sorry, there was a problem handling your request.</p>', NULL, NULL, 0, 0, 5, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 2, 9),
(9, 'CmsFolder', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'system', 'System', NULL, NULL, NULL, NULL, 0, 0, 4, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `SiteTree_Blocks`
--

CREATE TABLE `SiteTree_Blocks` (
  `ID` int(11) NOT NULL,
  `SiteTreeID` int(11) NOT NULL DEFAULT '0',
  `BlockID` int(11) NOT NULL DEFAULT '0',
  `Sort` int(11) NOT NULL DEFAULT '0',
  `BlockArea` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SiteTree_DisabledBlocks`
--

CREATE TABLE `SiteTree_DisabledBlocks` (
  `ID` int(11) NOT NULL,
  `SiteTreeID` int(11) NOT NULL DEFAULT '0',
  `BlockID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SiteTree_EditorGroups`
--

CREATE TABLE `SiteTree_EditorGroups` (
  `ID` int(11) NOT NULL,
  `SiteTreeID` int(11) NOT NULL DEFAULT '0',
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SiteTree_ImageTracking`
--

CREATE TABLE `SiteTree_ImageTracking` (
  `ID` int(11) NOT NULL,
  `SiteTreeID` int(11) NOT NULL DEFAULT '0',
  `FileID` int(11) NOT NULL DEFAULT '0',
  `FieldName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SiteTree_LinkTracking`
--

CREATE TABLE `SiteTree_LinkTracking` (
  `ID` int(11) NOT NULL,
  `SiteTreeID` int(11) NOT NULL DEFAULT '0',
  `ChildID` int(11) NOT NULL DEFAULT '0',
  `FieldName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SiteTree_LinkTracking`
--

INSERT INTO `SiteTree_LinkTracking` (`ID`, `SiteTreeID`, `ChildID`, `FieldName`) VALUES
(1, 2, 1, 'Content');

-- --------------------------------------------------------

--
-- Table structure for table `SiteTree_Live`
--

CREATE TABLE `SiteTree_Live` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('SiteTree','Page','ContentPage','HomePage','Blog','BlogPost','BlogEntry','ErrorPage','RedirectorPage','VirtualPage','CustomVirtualPage','CmsFolder','Footer','Header','UserDefinedForm','BlogTree','BlogHolder') DEFAULT 'SiteTree',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `URLSegment` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `MenuTitle` varchar(100) DEFAULT NULL,
  `Content` mediumtext,
  `MetaDescription` mediumtext,
  `ExtraMeta` mediumtext,
  `ShowInMenus` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ShowInSearch` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `Sort` int(11) NOT NULL DEFAULT '0',
  `HasBrokenFile` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HasBrokenLink` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ReportClass` varchar(50) DEFAULT NULL,
  `CanViewType` enum('Anyone','LoggedInUsers','OnlyTheseUsers','Inherit') DEFAULT 'Inherit',
  `CanEditType` enum('LoggedInUsers','OnlyTheseUsers','Inherit') DEFAULT 'Inherit',
  `Priority` varchar(5) DEFAULT NULL,
  `InheritBlockSets` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `MetaTitle` varchar(255) DEFAULT NULL,
  `Version` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SiteTree_Live`
--

INSERT INTO `SiteTree_Live` (`ID`, `ClassName`, `LastEdited`, `Created`, `URLSegment`, `Title`, `MenuTitle`, `Content`, `MetaDescription`, `ExtraMeta`, `ShowInMenus`, `ShowInSearch`, `Sort`, `HasBrokenFile`, `HasBrokenLink`, `ReportClass`, `CanViewType`, `CanEditType`, `Priority`, `InheritBlockSets`, `MetaTitle`, `Version`, `ParentID`) VALUES
(1, 'HomePage', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'home', 'Home', NULL, '<p>Welcome to the homepage</p>', NULL, NULL, 1, 1, 1, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 1, 0),
(2, 'ContentPage', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'default-styles', 'Default styles', NULL, '\n<h1>This is a heading 1 with <a href=\"[sitetree_link,id=1]\">a link</a> <em>and emphasis</em></h1>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis sem, sagittis vitae congue id, volutpat at lorem. <a href=\"[sitetree_link,id=1]\">Pellentesque pharetra</a> risus id lorem ullamcorper tristique. Cras nunc felis, euismod non aliquam et, hendrerit ac felis.</p>\n<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Sed felis sem, sagittis vitae congue id, volutpat at lorem. Pellentesque <em>pharetra risus id lorem ullamcorper</em> tristique. <span style=\"text-decoration: underline;\">Cras nunc felis</span>, euismod non aliquam et, hendrerit ac felis.</p>\n<h2>This is a heading 2 with <a href=\"[sitetree_link,id=1]\">a link</a> <em>and emphasis</em></h2>\n<p>Fusce convallis pretium neque, id ultrices arcu pretium vel. Nulla eget tempus erat. Etiam aliquet, neque nec rutrum mattis, risus magna elementum nisi, sed ultrices arcu purus id tortor. Duis nec condimentum orci. Ut a odio eget justo iaculis ornare a vel elit.</p>\n<p>Some bullet points:</p>\n<ul><li>Integer mattis sollicitudin <a href=\"[sitetree_link,id=1]\">this is a link</a> massa, ac imperdiet sapien viverra in.</li>\n<li>Mauris ultricies elit sed nulla pulvinar adipiscing.\n	<ul><li>A sublist item.</li>\n		<li>Integer mattis sollicitudin <a href=\"[sitetree_link,id=1]\">this is a link</a> massa, ac imperdiet sapien viverra in.</li>\n		<li>Mauris ultricies elit sed nulla pulvinar adipiscing.\n	</li></ul></li>\n<li>Mauris viverra, mauris vel commodo semper, sem tellus hendrerit justo, et gravida leo ante auctor ante.</li>\n<li>Nam ac est eget est feugiat dictum et at augue.</li>\n</ul><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus eu lorem a tortor mollis posuere at nec est. Morbi ac laoreet lorem. Sed imperdiet orci quis enim pharetra vel posuere sapien luctus. Sed sit amet leo ut mauris varius fringilla.</p>\n<p>And now for an ordered list:</p>\n<ol><li>Integer mattis sollicitudin <a href=\"[sitetree_link,id=1]\">this is a link</a> massa, ac imperdiet sapien viverra in.</li>\n<li>Mauris ultricies elit sed nulla pulvinar adipiscing.</li>\n<li>Mauris viverra, mauris vel commodo semper, sem tellus hendrerit justo, et gravida leo ante auctor ante.</li>\n<li>Nam ac est eget est feugiat dictum et at augue.</li>\n</ol><p>Nam dignissim fringilla neque vitae feugiat. Sed vel libero lorem, id ornare dui. Aliquam eget erat sed ligula venenatis adipiscing eu at felis.</p>\n<h3>This is a heading 3 with <a href=\"[sitetree_link,id=1]\">a link</a> <em>and emphasis</em></h3>\n<p>Nam dignissim fringilla neque vitae feugiat. Sed vel libero lorem, id ornare dui. Aliquam eget erat sed ligula venenatis adipiscing eu at felis. Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<hr><p> </p>\n<p>Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<p style=\"text-align: center;\">Some centred text</p>\n<p style=\"text-align: center;\">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<p style=\"text-align: left;\">Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<h2>Another heading 2 immediately followed by...</h2>\n<h3>A heading 3</h3>\n<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>\n<p>And now a blockquote:</p>\n<blockquote>\n<p>Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n</blockquote>\n<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>\n<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>\n<p> </p>\n										', NULL, NULL, 1, 1, 2, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 1, 0),
(3, 'Footer', '2018-12-15 12:25:43', '2018-12-15 12:11:09', 'company', 'Company', NULL, NULL, NULL, NULL, 0, 0, 3, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 3, 0),
(4, 'ContentPage', '2018-12-15 12:25:43', '2018-12-15 12:11:09', 'terms-and-conditions', 'Terms and conditions', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 1, 3),
(5, 'ContentPage', '2018-12-15 12:25:43', '2018-12-15 12:11:09', 'privacy-policy', 'Privacy policy', NULL, NULL, NULL, NULL, 1, 1, 2, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 3, 3),
(6, 'Header', '2018-12-15 12:11:10', '2018-12-15 12:11:09', 'header', 'Header', NULL, NULL, NULL, NULL, 0, 0, 3, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 1, 0),
(7, 'ErrorPage', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'page-not-found', 'Page not found', NULL, '<p>Sorry, it seems you were trying to access a page that doesn\'t exist.</p><p>Please check the spelling of the URL you were trying to access and try again.</p>', NULL, NULL, 0, 0, 4, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 2, 9),
(8, 'ErrorPage', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'server-error', 'Server error', NULL, '<p>Sorry, there was a problem handling your request.</p>', NULL, NULL, 0, 0, 5, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 2, 9),
(9, 'CmsFolder', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'system', 'System', NULL, NULL, NULL, NULL, 0, 0, 4, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `SiteTree_versions`
--

CREATE TABLE `SiteTree_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `WasPublished` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `AuthorID` int(11) NOT NULL DEFAULT '0',
  `PublisherID` int(11) NOT NULL DEFAULT '0',
  `ClassName` enum('SiteTree','Page','ContentPage','HomePage','Blog','BlogPost','BlogEntry','ErrorPage','RedirectorPage','VirtualPage','CustomVirtualPage','CmsFolder','Footer','Header','UserDefinedForm','BlogTree','BlogHolder') DEFAULT 'SiteTree',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `URLSegment` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `MenuTitle` varchar(100) DEFAULT NULL,
  `Content` mediumtext,
  `MetaDescription` mediumtext,
  `ExtraMeta` mediumtext,
  `ShowInMenus` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ShowInSearch` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `Sort` int(11) NOT NULL DEFAULT '0',
  `HasBrokenFile` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HasBrokenLink` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ReportClass` varchar(50) DEFAULT NULL,
  `CanViewType` enum('Anyone','LoggedInUsers','OnlyTheseUsers','Inherit') DEFAULT 'Inherit',
  `CanEditType` enum('LoggedInUsers','OnlyTheseUsers','Inherit') DEFAULT 'Inherit',
  `Priority` varchar(5) DEFAULT NULL,
  `InheritBlockSets` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `MetaTitle` varchar(255) DEFAULT NULL,
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SiteTree_versions`
--

INSERT INTO `SiteTree_versions` (`ID`, `RecordID`, `Version`, `WasPublished`, `AuthorID`, `PublisherID`, `ClassName`, `LastEdited`, `Created`, `URLSegment`, `Title`, `MenuTitle`, `Content`, `MetaDescription`, `ExtraMeta`, `ShowInMenus`, `ShowInSearch`, `Sort`, `HasBrokenFile`, `HasBrokenLink`, `ReportClass`, `CanViewType`, `CanEditType`, `Priority`, `InheritBlockSets`, `MetaTitle`, `ParentID`) VALUES
(1, 1, 1, 1, 0, 0, 'HomePage', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'home', 'Home', NULL, '<p>Welcome to the homepage</p>', NULL, NULL, 1, 1, 1, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 0),
(2, 2, 1, 1, 0, 0, 'ContentPage', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'default-styles', 'Default styles', NULL, '\n<h1>This is a heading 1 with <a href=\"[sitetree_link,id=1]\">a link</a> <em>and emphasis</em></h1>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed felis sem, sagittis vitae congue id, volutpat at lorem. <a href=\"[sitetree_link,id=1]\">Pellentesque pharetra</a> risus id lorem ullamcorper tristique. Cras nunc felis, euismod non aliquam et, hendrerit ac felis.</p>\n<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Sed felis sem, sagittis vitae congue id, volutpat at lorem. Pellentesque <em>pharetra risus id lorem ullamcorper</em> tristique. <span style=\"text-decoration: underline;\">Cras nunc felis</span>, euismod non aliquam et, hendrerit ac felis.</p>\n<h2>This is a heading 2 with <a href=\"[sitetree_link,id=1]\">a link</a> <em>and emphasis</em></h2>\n<p>Fusce convallis pretium neque, id ultrices arcu pretium vel. Nulla eget tempus erat. Etiam aliquet, neque nec rutrum mattis, risus magna elementum nisi, sed ultrices arcu purus id tortor. Duis nec condimentum orci. Ut a odio eget justo iaculis ornare a vel elit.</p>\n<p>Some bullet points:</p>\n<ul><li>Integer mattis sollicitudin <a href=\"[sitetree_link,id=1]\">this is a link</a> massa, ac imperdiet sapien viverra in.</li>\n<li>Mauris ultricies elit sed nulla pulvinar adipiscing.\n	<ul><li>A sublist item.</li>\n		<li>Integer mattis sollicitudin <a href=\"[sitetree_link,id=1]\">this is a link</a> massa, ac imperdiet sapien viverra in.</li>\n		<li>Mauris ultricies elit sed nulla pulvinar adipiscing.\n	</li></ul></li>\n<li>Mauris viverra, mauris vel commodo semper, sem tellus hendrerit justo, et gravida leo ante auctor ante.</li>\n<li>Nam ac est eget est feugiat dictum et at augue.</li>\n</ul><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus eu lorem a tortor mollis posuere at nec est. Morbi ac laoreet lorem. Sed imperdiet orci quis enim pharetra vel posuere sapien luctus. Sed sit amet leo ut mauris varius fringilla.</p>\n<p>And now for an ordered list:</p>\n<ol><li>Integer mattis sollicitudin <a href=\"[sitetree_link,id=1]\">this is a link</a> massa, ac imperdiet sapien viverra in.</li>\n<li>Mauris ultricies elit sed nulla pulvinar adipiscing.</li>\n<li>Mauris viverra, mauris vel commodo semper, sem tellus hendrerit justo, et gravida leo ante auctor ante.</li>\n<li>Nam ac est eget est feugiat dictum et at augue.</li>\n</ol><p>Nam dignissim fringilla neque vitae feugiat. Sed vel libero lorem, id ornare dui. Aliquam eget erat sed ligula venenatis adipiscing eu at felis.</p>\n<h3>This is a heading 3 with <a href=\"[sitetree_link,id=1]\">a link</a> <em>and emphasis</em></h3>\n<p>Nam dignissim fringilla neque vitae feugiat. Sed vel libero lorem, id ornare dui. Aliquam eget erat sed ligula venenatis adipiscing eu at felis. Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<hr><p> </p>\n<p>Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<p style=\"text-align: center;\">Some centred text</p>\n<p style=\"text-align: center;\">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<p style=\"text-align: left;\">Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n<h2>Another heading 2 immediately followed by...</h2>\n<h3>A heading 3</h3>\n<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>\n<p>And now a blockquote:</p>\n<blockquote>\n<p>Mauris ultricies, ligula eget malesuada tincidunt, lorem nibh placerat velit, in tincidunt mi purus sed est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Praesent varius pretium lobortis.</p>\n</blockquote>\n<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>\n<p>Sed adipiscing imperdiet tellus at convallis. Fusce sed nisl et justo aliquam adipiscing sit amet at magna. Pellentesque eget ipsum massa, et tempor lacus. Vivamus rhoncus, nisi id auctor venenatis, risus arcu interdum dolor, non tincidunt libero ligula vel neque. Donec imperdiet massa at sapien sagittis malesuada. Nam varius tincidunt turpis non imperdiet. Sed vestibulum volutpat ipsum, quis ultrices lacus aliquam ac.</p>\n<p> </p>\n										', NULL, NULL, 1, 1, 2, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 0),
(3, 3, 1, 1, 0, 0, 'Footer', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'company', 'Company', NULL, NULL, NULL, NULL, 0, 0, 3, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 0),
(4, 4, 1, 1, 0, 0, 'ContentPage', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'terms-and-conditions', 'Terms and conditions', NULL, NULL, NULL, NULL, 1, 1, 0, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 3),
(5, 5, 1, 1, 0, 0, 'ContentPage', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'privacy-policy', 'Privacy policy', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 3),
(6, 6, 1, 1, 0, 0, 'Header', '2018-12-15 12:11:09', '2018-12-15 12:11:09', 'header', 'Header', NULL, NULL, NULL, NULL, 0, 0, 3, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 0),
(7, 7, 1, 1, 0, 0, 'ErrorPage', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'page-not-found', 'Page not found', NULL, '<p>Sorry, it seems you were trying to access a page that doesn\'t exist.</p><p>Please check the spelling of the URL you were trying to access and try again.</p>', NULL, NULL, 0, 0, 4, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 0),
(8, 8, 1, 1, 0, 0, 'ErrorPage', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'server-error', 'Server error', NULL, '<p>Sorry, there was a problem handling your request.</p>', NULL, NULL, 0, 0, 5, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 0),
(9, 9, 1, 1, 0, 0, 'CmsFolder', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'system', 'System', NULL, NULL, NULL, NULL, 0, 0, 4, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 0),
(10, 7, 2, 1, 0, 0, 'ErrorPage', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'page-not-found', 'Page not found', NULL, '<p>Sorry, it seems you were trying to access a page that doesn\'t exist.</p><p>Please check the spelling of the URL you were trying to access and try again.</p>', NULL, NULL, 0, 0, 4, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 9),
(11, 8, 2, 1, 0, 0, 'ErrorPage', '2018-12-15 12:11:10', '2018-12-15 12:11:10', 'server-error', 'Server error', NULL, '<p>Sorry, there was a problem handling your request.</p>', NULL, NULL, 0, 0, 5, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 9),
(12, 4, 2, 0, 1, 0, 'ContentPage', '2018-12-15 12:25:05', '2018-12-15 12:11:09', 'terms-and-conditions', 'Terms and conditions', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 3),
(13, 5, 2, 0, 1, 0, 'ContentPage', '2018-12-15 12:25:05', '2018-12-15 12:11:09', 'privacy-policy', 'Privacy policy', NULL, NULL, NULL, NULL, 1, 1, 2, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 3),
(14, 3, 2, 1, 1, 1, 'Footer', '2018-12-15 12:25:05', '2018-12-15 12:11:09', 'company', 'Company', NULL, NULL, NULL, NULL, 0, 0, 3, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 0),
(15, 5, 3, 0, 1, 0, 'ContentPage', '2018-12-15 12:25:05', '2018-12-15 12:11:09', 'privacy-policy', 'Privacy policy', NULL, NULL, NULL, NULL, 1, 1, 2, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 3),
(16, 3, 3, 1, 1, 1, 'Footer', '2018-12-15 12:25:39', '2018-12-15 12:11:09', 'company', 'Company', NULL, NULL, NULL, NULL, 0, 0, 3, 0, 0, NULL, 'Inherit', 'Inherit', NULL, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `SiteTree_ViewerGroups`
--

CREATE TABLE `SiteTree_ViewerGroups` (
  `ID` int(11) NOT NULL,
  `SiteTreeID` int(11) NOT NULL DEFAULT '0',
  `GroupID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SubmittedFileField`
--

CREATE TABLE `SubmittedFileField` (
  `ID` int(11) NOT NULL,
  `UploadedFileID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SubmittedForm`
--

CREATE TABLE `SubmittedForm` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('SubmittedForm') DEFAULT 'SubmittedForm',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `SubmittedByID` int(11) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `SubmittedFormField`
--

CREATE TABLE `SubmittedFormField` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('SubmittedFormField','SubmittedFileField') DEFAULT 'SubmittedFormField',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Value` mediumtext,
  `Title` varchar(255) DEFAULT NULL,
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `TagCloudWidget`
--

CREATE TABLE `TagCloudWidget` (
  `ID` int(11) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Limit` int(11) NOT NULL DEFAULT '0',
  `Sortby` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `UserDefinedForm`
--

CREATE TABLE `UserDefinedForm` (
  `ID` int(11) NOT NULL,
  `SubmitButtonText` varchar(50) DEFAULT NULL,
  `ClearButtonText` varchar(50) DEFAULT NULL,
  `OnCompleteMessage` mediumtext,
  `ShowClearButton` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisableSaveSubmissions` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `EnableLiveValidation` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HideFieldLabels` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisplayErrorMessagesAtTop` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisableAuthenicatedFinishAction` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisableCsrfSecurityToken` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `UserDefinedForm_EmailRecipient`
--

CREATE TABLE `UserDefinedForm_EmailRecipient` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('UserDefinedForm_EmailRecipient') DEFAULT 'UserDefinedForm_EmailRecipient',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `EmailAddress` varchar(200) DEFAULT NULL,
  `EmailSubject` varchar(200) DEFAULT NULL,
  `EmailFrom` varchar(200) DEFAULT NULL,
  `EmailReplyTo` varchar(200) DEFAULT NULL,
  `EmailBody` mediumtext,
  `EmailBodyHtml` mediumtext,
  `EmailTemplate` varchar(50) DEFAULT NULL,
  `SendPlain` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HideFormData` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `CustomRulesCondition` enum('And','Or') DEFAULT 'And',
  `FormID` int(11) NOT NULL DEFAULT '0',
  `SendEmailFromFieldID` int(11) NOT NULL DEFAULT '0',
  `SendEmailToFieldID` int(11) NOT NULL DEFAULT '0',
  `SendEmailSubjectFieldID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `UserDefinedForm_EmailRecipientCondition`
--

CREATE TABLE `UserDefinedForm_EmailRecipientCondition` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('UserDefinedForm_EmailRecipientCondition') DEFAULT 'UserDefinedForm_EmailRecipientCondition',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `ConditionOption` enum('IsBlank','IsNotBlank','Equals','NotEquals') DEFAULT 'IsBlank',
  `ConditionValue` varchar(50) DEFAULT NULL,
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `ConditionFieldID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `UserDefinedForm_Live`
--

CREATE TABLE `UserDefinedForm_Live` (
  `ID` int(11) NOT NULL,
  `SubmitButtonText` varchar(50) DEFAULT NULL,
  `ClearButtonText` varchar(50) DEFAULT NULL,
  `OnCompleteMessage` mediumtext,
  `ShowClearButton` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisableSaveSubmissions` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `EnableLiveValidation` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HideFieldLabels` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisplayErrorMessagesAtTop` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisableAuthenicatedFinishAction` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisableCsrfSecurityToken` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `UserDefinedForm_versions`
--

CREATE TABLE `UserDefinedForm_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `SubmitButtonText` varchar(50) DEFAULT NULL,
  `ClearButtonText` varchar(50) DEFAULT NULL,
  `OnCompleteMessage` mediumtext,
  `ShowClearButton` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisableSaveSubmissions` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `EnableLiveValidation` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `HideFieldLabels` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisplayErrorMessagesAtTop` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisableAuthenicatedFinishAction` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `DisableCsrfSecurityToken` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `VirtualPage`
--

CREATE TABLE `VirtualPage` (
  `ID` int(11) NOT NULL,
  `VersionID` int(11) NOT NULL DEFAULT '0',
  `CopyContentFromID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `VirtualPage_Live`
--

CREATE TABLE `VirtualPage_Live` (
  `ID` int(11) NOT NULL,
  `VersionID` int(11) NOT NULL DEFAULT '0',
  `CopyContentFromID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `VirtualPage_versions`
--

CREATE TABLE `VirtualPage_versions` (
  `ID` int(11) NOT NULL,
  `RecordID` int(11) NOT NULL DEFAULT '0',
  `Version` int(11) NOT NULL DEFAULT '0',
  `VersionID` int(11) NOT NULL DEFAULT '0',
  `CopyContentFromID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Widget`
--

CREATE TABLE `Widget` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('Widget','BlogArchiveWidget','ArchiveWidget','BlogCategoriesWidget','BlogRecentPostsWidget','BlogTagsCloudWidget','BlogTagsWidget','TagCloudWidget') DEFAULT 'Widget',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Sort` int(11) NOT NULL DEFAULT '0',
  `Enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `WidgetArea`
--

CREATE TABLE `WidgetArea` (
  `ID` int(11) NOT NULL,
  `ClassName` enum('WidgetArea') DEFAULT 'WidgetArea',
  `LastEdited` datetime DEFAULT NULL,
  `Created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ArchiveWidget`
--
ALTER TABLE `ArchiveWidget`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Banner`
--
ALTER TABLE `Banner`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MainImageID` (`MainImageID`),
  ADD KEY `PageID` (`PageID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `Block`
--
ALTER TABLE `Block`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `BlockSet`
--
ALTER TABLE `BlockSet`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `BlockSet_Blocks`
--
ALTER TABLE `BlockSet_Blocks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlockSetID` (`BlockSetID`),
  ADD KEY `BlockID` (`BlockID`);

--
-- Indexes for table `BlockSet_PageParents`
--
ALTER TABLE `BlockSet_PageParents`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlockSetID` (`BlockSetID`),
  ADD KEY `SiteTreeID` (`SiteTreeID`);

--
-- Indexes for table `Block_Live`
--
ALTER TABLE `Block_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `Block_versions`
--
ALTER TABLE `Block_versions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `PublisherID` (`PublisherID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `Block_ViewerGroups`
--
ALTER TABLE `Block_ViewerGroups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlockID` (`BlockID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `Blog`
--
ALTER TABLE `Blog`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `BlogArchiveWidget`
--
ALTER TABLE `BlogArchiveWidget`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`);

--
-- Indexes for table `BlogCategoriesWidget`
--
ALTER TABLE `BlogCategoriesWidget`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`);

--
-- Indexes for table `BlogCategory`
--
ALTER TABLE `BlogCategory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `BlogEntry`
--
ALTER TABLE `BlogEntry`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `BlogEntry_Live`
--
ALTER TABLE `BlogEntry_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `BlogEntry_versions`
--
ALTER TABLE `BlogEntry_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `BlogHolder`
--
ALTER TABLE `BlogHolder`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `BlogHolder_Live`
--
ALTER TABLE `BlogHolder_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `BlogHolder_versions`
--
ALTER TABLE `BlogHolder_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `BlogPost`
--
ALTER TABLE `BlogPost`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FeaturedImageID` (`FeaturedImageID`);

--
-- Indexes for table `BlogPost_Authors`
--
ALTER TABLE `BlogPost_Authors`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogPostID` (`BlogPostID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `BlogPost_Categories`
--
ALTER TABLE `BlogPost_Categories`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogPostID` (`BlogPostID`),
  ADD KEY `BlogCategoryID` (`BlogCategoryID`);

--
-- Indexes for table `BlogPost_Live`
--
ALTER TABLE `BlogPost_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FeaturedImageID` (`FeaturedImageID`);

--
-- Indexes for table `BlogPost_Tags`
--
ALTER TABLE `BlogPost_Tags`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogPostID` (`BlogPostID`),
  ADD KEY `BlogTagID` (`BlogTagID`);

--
-- Indexes for table `BlogPost_versions`
--
ALTER TABLE `BlogPost_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `FeaturedImageID` (`FeaturedImageID`);

--
-- Indexes for table `BlogRecentPostsWidget`
--
ALTER TABLE `BlogRecentPostsWidget`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`);

--
-- Indexes for table `BlogTag`
--
ALTER TABLE `BlogTag`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `BlogTagsCloudWidget`
--
ALTER TABLE `BlogTagsCloudWidget`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`);

--
-- Indexes for table `BlogTagsWidget`
--
ALTER TABLE `BlogTagsWidget`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`);

--
-- Indexes for table `BlogTree`
--
ALTER TABLE `BlogTree`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `BlogTree_Live`
--
ALTER TABLE `BlogTree_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `BlogTree_versions`
--
ALTER TABLE `BlogTree_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `Blog_Contributors`
--
ALTER TABLE `Blog_Contributors`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `Blog_Editors`
--
ALTER TABLE `Blog_Editors`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `Blog_Live`
--
ALTER TABLE `Blog_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Blog_versions`
--
ALTER TABLE `Blog_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `Blog_Writers`
--
ALTER TABLE `Blog_Writers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogID` (`BlogID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `ContentBlock`
--
ALTER TABLE `ContentBlock`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ContentBlock_Live`
--
ALTER TABLE `ContentBlock_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ContentBlock_versions`
--
ALTER TABLE `ContentBlock_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `EditableCheckbox`
--
ALTER TABLE `EditableCheckbox`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableCheckbox_Live`
--
ALTER TABLE `EditableCheckbox_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableCheckbox_versions`
--
ALTER TABLE `EditableCheckbox_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `EditableCustomRule`
--
ALTER TABLE `EditableCustomRule`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ConditionFieldID` (`ConditionFieldID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `EditableCustomRule_Live`
--
ALTER TABLE `EditableCustomRule_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ConditionFieldID` (`ConditionFieldID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `EditableCustomRule_versions`
--
ALTER TABLE `EditableCustomRule_versions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `PublisherID` (`PublisherID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ConditionFieldID` (`ConditionFieldID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `EditableDateField`
--
ALTER TABLE `EditableDateField`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableDateField_Live`
--
ALTER TABLE `EditableDateField_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableDateField_versions`
--
ALTER TABLE `EditableDateField_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `EditableEmailField`
--
ALTER TABLE `EditableEmailField`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableEmailField_Live`
--
ALTER TABLE `EditableEmailField_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableEmailField_versions`
--
ALTER TABLE `EditableEmailField_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `EditableFieldGroup`
--
ALTER TABLE `EditableFieldGroup`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EndID` (`EndID`);

--
-- Indexes for table `EditableFieldGroup_Live`
--
ALTER TABLE `EditableFieldGroup_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EndID` (`EndID`);

--
-- Indexes for table `EditableFieldGroup_versions`
--
ALTER TABLE `EditableFieldGroup_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `EndID` (`EndID`);

--
-- Indexes for table `EditableFileField`
--
ALTER TABLE `EditableFileField`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FolderID` (`FolderID`);

--
-- Indexes for table `EditableFileField_Live`
--
ALTER TABLE `EditableFileField_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FolderID` (`FolderID`);

--
-- Indexes for table `EditableFileField_versions`
--
ALTER TABLE `EditableFileField_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `FolderID` (`FolderID`);

--
-- Indexes for table `EditableFormField`
--
ALTER TABLE `EditableFormField`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `EditableFormField_Live`
--
ALTER TABLE `EditableFormField_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `EditableFormField_versions`
--
ALTER TABLE `EditableFormField_versions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `PublisherID` (`PublisherID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `EditableFormHeading`
--
ALTER TABLE `EditableFormHeading`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableFormHeading_Live`
--
ALTER TABLE `EditableFormHeading_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableFormHeading_versions`
--
ALTER TABLE `EditableFormHeading_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `EditableLiteralField`
--
ALTER TABLE `EditableLiteralField`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableLiteralField_Live`
--
ALTER TABLE `EditableLiteralField_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableLiteralField_versions`
--
ALTER TABLE `EditableLiteralField_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `EditableMemberListField`
--
ALTER TABLE `EditableMemberListField`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `EditableMemberListField_Live`
--
ALTER TABLE `EditableMemberListField_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `EditableMemberListField_versions`
--
ALTER TABLE `EditableMemberListField_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `EditableNumericField`
--
ALTER TABLE `EditableNumericField`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableNumericField_Live`
--
ALTER TABLE `EditableNumericField_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableNumericField_versions`
--
ALTER TABLE `EditableNumericField_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `EditableOption`
--
ALTER TABLE `EditableOption`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `EditableOption_Live`
--
ALTER TABLE `EditableOption_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `EditableOption_versions`
--
ALTER TABLE `EditableOption_versions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `PublisherID` (`PublisherID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `EditableTextField`
--
ALTER TABLE `EditableTextField`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableTextField_Live`
--
ALTER TABLE `EditableTextField_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `EditableTextField_versions`
--
ALTER TABLE `EditableTextField_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `ErrorPage`
--
ALTER TABLE `ErrorPage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ErrorPage_Live`
--
ALTER TABLE `ErrorPage_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ErrorPage_versions`
--
ALTER TABLE `ErrorPage_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `File`
--
ALTER TABLE `File`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `OwnerID` (`OwnerID`),
  ADD KEY `ClassName` (`ClassName`);
ALTER TABLE `File` ADD FULLTEXT KEY `SearchFields` (`Title`,`Filename`,`Content`);

--
-- Indexes for table `File_ViewerGroups`
--
ALTER TABLE `File_ViewerGroups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FileID` (`FileID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `Footer`
--
ALTER TABLE `Footer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Footer_Live`
--
ALTER TABLE `Footer_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Footer_versions`
--
ALTER TABLE `Footer_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `Group`
--
ALTER TABLE `Group`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `LinkedPageID` (`LinkedPageID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `Group_Members`
--
ALTER TABLE `Group_Members`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `GroupID` (`GroupID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `Group_Roles`
--
ALTER TABLE `Group_Roles`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `GroupID` (`GroupID`),
  ADD KEY `PermissionRoleID` (`PermissionRoleID`);

--
-- Indexes for table `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `LoginAttempt`
--
ALTER TABLE `LoginAttempt`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `Member`
--
ALTER TABLE `Member`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BlogProfileImageID` (`BlogProfileImageID`),
  ADD KEY `Email` (`Email`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `MemberPassword`
--
ALTER TABLE `MemberPassword`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `NewsletterSnippet`
--
ALTER TABLE `NewsletterSnippet`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SubsiteID` (`SubsiteID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `Page`
--
ALTER TABLE `Page`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MainImageID` (`MainImageID`),
  ADD KEY `ListImageID` (`ListImageID`),
  ADD KEY `AttachmentID` (`AttachmentID`);

--
-- Indexes for table `Page_Live`
--
ALTER TABLE `Page_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MainImageID` (`MainImageID`),
  ADD KEY `ListImageID` (`ListImageID`),
  ADD KEY `AttachmentID` (`AttachmentID`);

--
-- Indexes for table `Page_OtherImages`
--
ALTER TABLE `Page_OtherImages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PageID` (`PageID`),
  ADD KEY `ImageID` (`ImageID`);

--
-- Indexes for table `Page_versions`
--
ALTER TABLE `Page_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `MainImageID` (`MainImageID`),
  ADD KEY `ListImageID` (`ListImageID`),
  ADD KEY `AttachmentID` (`AttachmentID`);

--
-- Indexes for table `Permission`
--
ALTER TABLE `Permission`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `GroupID` (`GroupID`),
  ADD KEY `Code` (`Code`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `PermissionRole`
--
ALTER TABLE `PermissionRole`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `PermissionRoleCode`
--
ALTER TABLE `PermissionRoleCode`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RoleID` (`RoleID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `RedirectorPage`
--
ALTER TABLE `RedirectorPage`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LinkToID` (`LinkToID`);

--
-- Indexes for table `RedirectorPage_Live`
--
ALTER TABLE `RedirectorPage_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LinkToID` (`LinkToID`);

--
-- Indexes for table `RedirectorPage_versions`
--
ALTER TABLE `RedirectorPage_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `LinkToID` (`LinkToID`);

--
-- Indexes for table `SiteConfig`
--
ALTER TABLE `SiteConfig`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `SiteConfig_Blocks`
--
ALTER TABLE `SiteConfig_Blocks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteConfigID` (`SiteConfigID`),
  ADD KEY `BlockID` (`BlockID`);

--
-- Indexes for table `SiteConfig_CreateTopLevelGroups`
--
ALTER TABLE `SiteConfig_CreateTopLevelGroups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteConfigID` (`SiteConfigID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `SiteConfig_EditorGroups`
--
ALTER TABLE `SiteConfig_EditorGroups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteConfigID` (`SiteConfigID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `SiteConfig_ViewerGroups`
--
ALTER TABLE `SiteConfig_ViewerGroups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteConfigID` (`SiteConfigID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `SiteTree`
--
ALTER TABLE `SiteTree`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `URLSegment` (`URLSegment`),
  ADD KEY `ClassName` (`ClassName`);
ALTER TABLE `SiteTree` ADD FULLTEXT KEY `SearchFields` (`Title`,`MenuTitle`,`Content`,`MetaDescription`);

--
-- Indexes for table `SiteTree_Blocks`
--
ALTER TABLE `SiteTree_Blocks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteTreeID` (`SiteTreeID`),
  ADD KEY `BlockID` (`BlockID`);

--
-- Indexes for table `SiteTree_DisabledBlocks`
--
ALTER TABLE `SiteTree_DisabledBlocks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteTreeID` (`SiteTreeID`),
  ADD KEY `BlockID` (`BlockID`);

--
-- Indexes for table `SiteTree_EditorGroups`
--
ALTER TABLE `SiteTree_EditorGroups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteTreeID` (`SiteTreeID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `SiteTree_ImageTracking`
--
ALTER TABLE `SiteTree_ImageTracking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteTreeID` (`SiteTreeID`),
  ADD KEY `FileID` (`FileID`);

--
-- Indexes for table `SiteTree_LinkTracking`
--
ALTER TABLE `SiteTree_LinkTracking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteTreeID` (`SiteTreeID`),
  ADD KEY `ChildID` (`ChildID`);

--
-- Indexes for table `SiteTree_Live`
--
ALTER TABLE `SiteTree_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `URLSegment` (`URLSegment`),
  ADD KEY `ClassName` (`ClassName`);
ALTER TABLE `SiteTree_Live` ADD FULLTEXT KEY `SearchFields` (`Title`,`MenuTitle`,`Content`,`MetaDescription`);

--
-- Indexes for table `SiteTree_versions`
--
ALTER TABLE `SiteTree_versions`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `PublisherID` (`PublisherID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `URLSegment` (`URLSegment`),
  ADD KEY `ClassName` (`ClassName`);
ALTER TABLE `SiteTree_versions` ADD FULLTEXT KEY `SearchFields` (`Title`,`MenuTitle`,`Content`,`MetaDescription`);

--
-- Indexes for table `SiteTree_ViewerGroups`
--
ALTER TABLE `SiteTree_ViewerGroups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SiteTreeID` (`SiteTreeID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `SubmittedFileField`
--
ALTER TABLE `SubmittedFileField`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UploadedFileID` (`UploadedFileID`);

--
-- Indexes for table `SubmittedForm`
--
ALTER TABLE `SubmittedForm`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SubmittedByID` (`SubmittedByID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `SubmittedFormField`
--
ALTER TABLE `SubmittedFormField`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `TagCloudWidget`
--
ALTER TABLE `TagCloudWidget`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `UserDefinedForm`
--
ALTER TABLE `UserDefinedForm`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `UserDefinedForm_EmailRecipient`
--
ALTER TABLE `UserDefinedForm_EmailRecipient`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FormID` (`FormID`),
  ADD KEY `SendEmailFromFieldID` (`SendEmailFromFieldID`),
  ADD KEY `SendEmailToFieldID` (`SendEmailToFieldID`),
  ADD KEY `SendEmailSubjectFieldID` (`SendEmailSubjectFieldID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `UserDefinedForm_EmailRecipientCondition`
--
ALTER TABLE `UserDefinedForm_EmailRecipientCondition`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ConditionFieldID` (`ConditionFieldID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `UserDefinedForm_Live`
--
ALTER TABLE `UserDefinedForm_Live`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `UserDefinedForm_versions`
--
ALTER TABLE `UserDefinedForm_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`);

--
-- Indexes for table `VirtualPage`
--
ALTER TABLE `VirtualPage`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CopyContentFromID` (`CopyContentFromID`);

--
-- Indexes for table `VirtualPage_Live`
--
ALTER TABLE `VirtualPage_Live`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CopyContentFromID` (`CopyContentFromID`);

--
-- Indexes for table `VirtualPage_versions`
--
ALTER TABLE `VirtualPage_versions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RecordID_Version` (`RecordID`,`Version`),
  ADD KEY `RecordID` (`RecordID`),
  ADD KEY `Version` (`Version`),
  ADD KEY `CopyContentFromID` (`CopyContentFromID`);

--
-- Indexes for table `Widget`
--
ALTER TABLE `Widget`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ParentID` (`ParentID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- Indexes for table `WidgetArea`
--
ALTER TABLE `WidgetArea`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClassName` (`ClassName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ArchiveWidget`
--
ALTER TABLE `ArchiveWidget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Banner`
--
ALTER TABLE `Banner`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Block`
--
ALTER TABLE `Block`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlockSet`
--
ALTER TABLE `BlockSet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlockSet_Blocks`
--
ALTER TABLE `BlockSet_Blocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlockSet_PageParents`
--
ALTER TABLE `BlockSet_PageParents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Block_Live`
--
ALTER TABLE `Block_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Block_versions`
--
ALTER TABLE `Block_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Block_ViewerGroups`
--
ALTER TABLE `Block_ViewerGroups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Blog`
--
ALTER TABLE `Blog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogArchiveWidget`
--
ALTER TABLE `BlogArchiveWidget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogCategoriesWidget`
--
ALTER TABLE `BlogCategoriesWidget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogCategory`
--
ALTER TABLE `BlogCategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogEntry`
--
ALTER TABLE `BlogEntry`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogEntry_Live`
--
ALTER TABLE `BlogEntry_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogEntry_versions`
--
ALTER TABLE `BlogEntry_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogHolder`
--
ALTER TABLE `BlogHolder`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogHolder_Live`
--
ALTER TABLE `BlogHolder_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogHolder_versions`
--
ALTER TABLE `BlogHolder_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogPost`
--
ALTER TABLE `BlogPost`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogPost_Authors`
--
ALTER TABLE `BlogPost_Authors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogPost_Categories`
--
ALTER TABLE `BlogPost_Categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogPost_Live`
--
ALTER TABLE `BlogPost_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogPost_Tags`
--
ALTER TABLE `BlogPost_Tags`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogPost_versions`
--
ALTER TABLE `BlogPost_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogRecentPostsWidget`
--
ALTER TABLE `BlogRecentPostsWidget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogTag`
--
ALTER TABLE `BlogTag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogTagsCloudWidget`
--
ALTER TABLE `BlogTagsCloudWidget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogTagsWidget`
--
ALTER TABLE `BlogTagsWidget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogTree`
--
ALTER TABLE `BlogTree`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogTree_Live`
--
ALTER TABLE `BlogTree_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `BlogTree_versions`
--
ALTER TABLE `BlogTree_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Blog_Contributors`
--
ALTER TABLE `Blog_Contributors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Blog_Editors`
--
ALTER TABLE `Blog_Editors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Blog_Live`
--
ALTER TABLE `Blog_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Blog_versions`
--
ALTER TABLE `Blog_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Blog_Writers`
--
ALTER TABLE `Blog_Writers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ContentBlock`
--
ALTER TABLE `ContentBlock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ContentBlock_Live`
--
ALTER TABLE `ContentBlock_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ContentBlock_versions`
--
ALTER TABLE `ContentBlock_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableCheckbox`
--
ALTER TABLE `EditableCheckbox`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableCheckbox_Live`
--
ALTER TABLE `EditableCheckbox_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableCheckbox_versions`
--
ALTER TABLE `EditableCheckbox_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableCustomRule`
--
ALTER TABLE `EditableCustomRule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableCustomRule_Live`
--
ALTER TABLE `EditableCustomRule_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableCustomRule_versions`
--
ALTER TABLE `EditableCustomRule_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableDateField`
--
ALTER TABLE `EditableDateField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableDateField_Live`
--
ALTER TABLE `EditableDateField_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableDateField_versions`
--
ALTER TABLE `EditableDateField_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableEmailField`
--
ALTER TABLE `EditableEmailField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableEmailField_Live`
--
ALTER TABLE `EditableEmailField_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableEmailField_versions`
--
ALTER TABLE `EditableEmailField_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFieldGroup`
--
ALTER TABLE `EditableFieldGroup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFieldGroup_Live`
--
ALTER TABLE `EditableFieldGroup_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFieldGroup_versions`
--
ALTER TABLE `EditableFieldGroup_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFileField`
--
ALTER TABLE `EditableFileField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFileField_Live`
--
ALTER TABLE `EditableFileField_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFileField_versions`
--
ALTER TABLE `EditableFileField_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFormField`
--
ALTER TABLE `EditableFormField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFormField_Live`
--
ALTER TABLE `EditableFormField_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFormField_versions`
--
ALTER TABLE `EditableFormField_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFormHeading`
--
ALTER TABLE `EditableFormHeading`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFormHeading_Live`
--
ALTER TABLE `EditableFormHeading_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableFormHeading_versions`
--
ALTER TABLE `EditableFormHeading_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableLiteralField`
--
ALTER TABLE `EditableLiteralField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableLiteralField_Live`
--
ALTER TABLE `EditableLiteralField_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableLiteralField_versions`
--
ALTER TABLE `EditableLiteralField_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableMemberListField`
--
ALTER TABLE `EditableMemberListField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableMemberListField_Live`
--
ALTER TABLE `EditableMemberListField_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableMemberListField_versions`
--
ALTER TABLE `EditableMemberListField_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableNumericField`
--
ALTER TABLE `EditableNumericField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableNumericField_Live`
--
ALTER TABLE `EditableNumericField_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableNumericField_versions`
--
ALTER TABLE `EditableNumericField_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableOption`
--
ALTER TABLE `EditableOption`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableOption_Live`
--
ALTER TABLE `EditableOption_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableOption_versions`
--
ALTER TABLE `EditableOption_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableTextField`
--
ALTER TABLE `EditableTextField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableTextField_Live`
--
ALTER TABLE `EditableTextField_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `EditableTextField_versions`
--
ALTER TABLE `EditableTextField_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ErrorPage`
--
ALTER TABLE `ErrorPage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ErrorPage_Live`
--
ALTER TABLE `ErrorPage_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ErrorPage_versions`
--
ALTER TABLE `ErrorPage_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `File`
--
ALTER TABLE `File`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `File_ViewerGroups`
--
ALTER TABLE `File_ViewerGroups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Footer`
--
ALTER TABLE `Footer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Footer_Live`
--
ALTER TABLE `Footer_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Footer_versions`
--
ALTER TABLE `Footer_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Group`
--
ALTER TABLE `Group`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Group_Members`
--
ALTER TABLE `Group_Members`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Group_Roles`
--
ALTER TABLE `Group_Roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Image`
--
ALTER TABLE `Image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `LoginAttempt`
--
ALTER TABLE `LoginAttempt`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Member`
--
ALTER TABLE `Member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `MemberPassword`
--
ALTER TABLE `MemberPassword`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `NewsletterSnippet`
--
ALTER TABLE `NewsletterSnippet`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Page`
--
ALTER TABLE `Page`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Page_Live`
--
ALTER TABLE `Page_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Page_OtherImages`
--
ALTER TABLE `Page_OtherImages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Page_versions`
--
ALTER TABLE `Page_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Permission`
--
ALTER TABLE `Permission`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `PermissionRole`
--
ALTER TABLE `PermissionRole`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PermissionRoleCode`
--
ALTER TABLE `PermissionRoleCode`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RedirectorPage`
--
ALTER TABLE `RedirectorPage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RedirectorPage_Live`
--
ALTER TABLE `RedirectorPage_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `RedirectorPage_versions`
--
ALTER TABLE `RedirectorPage_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SiteConfig`
--
ALTER TABLE `SiteConfig`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `SiteConfig_Blocks`
--
ALTER TABLE `SiteConfig_Blocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SiteConfig_CreateTopLevelGroups`
--
ALTER TABLE `SiteConfig_CreateTopLevelGroups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SiteConfig_EditorGroups`
--
ALTER TABLE `SiteConfig_EditorGroups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SiteConfig_ViewerGroups`
--
ALTER TABLE `SiteConfig_ViewerGroups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SiteTree`
--
ALTER TABLE `SiteTree`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `SiteTree_Blocks`
--
ALTER TABLE `SiteTree_Blocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SiteTree_DisabledBlocks`
--
ALTER TABLE `SiteTree_DisabledBlocks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SiteTree_EditorGroups`
--
ALTER TABLE `SiteTree_EditorGroups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SiteTree_ImageTracking`
--
ALTER TABLE `SiteTree_ImageTracking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SiteTree_LinkTracking`
--
ALTER TABLE `SiteTree_LinkTracking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `SiteTree_Live`
--
ALTER TABLE `SiteTree_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `SiteTree_versions`
--
ALTER TABLE `SiteTree_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `SiteTree_ViewerGroups`
--
ALTER TABLE `SiteTree_ViewerGroups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SubmittedFileField`
--
ALTER TABLE `SubmittedFileField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SubmittedForm`
--
ALTER TABLE `SubmittedForm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SubmittedFormField`
--
ALTER TABLE `SubmittedFormField`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TagCloudWidget`
--
ALTER TABLE `TagCloudWidget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserDefinedForm`
--
ALTER TABLE `UserDefinedForm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserDefinedForm_EmailRecipient`
--
ALTER TABLE `UserDefinedForm_EmailRecipient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserDefinedForm_EmailRecipientCondition`
--
ALTER TABLE `UserDefinedForm_EmailRecipientCondition`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserDefinedForm_Live`
--
ALTER TABLE `UserDefinedForm_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `UserDefinedForm_versions`
--
ALTER TABLE `UserDefinedForm_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VirtualPage`
--
ALTER TABLE `VirtualPage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VirtualPage_Live`
--
ALTER TABLE `VirtualPage_Live`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VirtualPage_versions`
--
ALTER TABLE `VirtualPage_versions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Widget`
--
ALTER TABLE `Widget`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WidgetArea`
--
ALTER TABLE `WidgetArea`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
