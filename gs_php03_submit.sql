-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 1 月 03 日 10:25
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_php02_submit`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `approach_table`
--

CREATE TABLE `approach_table` (
  `id` int(11) NOT NULL,
  `approach_date` date NOT NULL,
  `approach_content` text COLLATE utf8_unicode_ci NOT NULL,
  `journalist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `journalist_table`
--

CREATE TABLE `journalist_table` (
  `journalist_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_mobile` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `date_registered` date NOT NULL,
  `date_updated` date DEFAULT NULL,
  `approach_preferred` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media_id` int(32) DEFAULT NULL,
  `media_name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `journalist_table`
--

INSERT INTO `journalist_table` (`journalist_id`, `name`, `department`, `title`, `status`, `priority`, `email`, `facebook`, `tel_mobile`, `date_registered`, `date_updated`, `approach_preferred`, `media_id`, `media_name`) VALUES
(5, '高橋ジュンコ', 'コンテンツメディア事業部', '記者', '面会済', '低', 'dummy@dummy.co.jp', 'dummy@dummy.co.jp', '8039401747', '2022-12-15', '2022-12-15', 'メッセンジャー', NULL, 'テレビ東京'),
(7, '古川園太郎', '編集', 'ディレクター', 'met', 'high', 'dummy@dummy.co.jp', 'dummy@dummy.co.jp', '9012345678', '2022-12-16', '2022-12-16', '携帯電話', NULL, 'テレビ東京'),
(10, '菊地秀世', '編集局経済部', '記者', 'met', 'mid', 'dummy@dummy.co.jp', 'dummy@dummy.co.jp', '9012345678', '2022-12-16', '2022-12-16', 'メール', NULL, '日経MJ');

-- --------------------------------------------------------

--
-- テーブルの構造 `media_table`
--

CREATE TABLE `media_table` (
  `media_id` int(12) NOT NULL,
  `media_category` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `media_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `media_company_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `media_table`
--

INSERT INTO `media_table` (`media_id`, `media_category`, `media_name`, `media_company_name`) VALUES
(3, '新聞(その他)', '繊研新聞', '株式会社繊研新聞社'),
(4, 'TV', 'テレビ東京', '株式会社テレビ東京'),
(5, '新聞(経済紙・産業情報紙)', '日経MJ', '株式会社日本経済新聞社'),
(6, 'TV', 'テレビ東京', '株式会社テレビ東京'),
(7, 'Webメディア', 'DIAMOND SIGNAL', '株式会社ダイヤモンド社'),
(8, '雑誌', '日経トレンディ', '株式会社 日経bp');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `approach_table`
--
ALTER TABLE `approach_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `journalist_table`
--
ALTER TABLE `journalist_table`
  ADD PRIMARY KEY (`journalist_id`);

--
-- テーブルのインデックス `media_table`
--
ALTER TABLE `media_table`
  ADD PRIMARY KEY (`media_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `approach_table`
--
ALTER TABLE `approach_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `journalist_table`
--
ALTER TABLE `journalist_table`
  MODIFY `journalist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `media_table`
--
ALTER TABLE `media_table`
  MODIFY `media_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
