-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: 35.200.60.175    Database: adsearch.tokyo
-- ------------------------------------------------------
-- Server version	5.7.14-google-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `adsearch.tokyo`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `adsearch.tokyo` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `adsearch.tokyo`;

--
-- Table structure for table `artist`
--

DROP TABLE IF EXISTS `artist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_manager_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_manager_id_idxfk_1` (`created_manager_id`),
  KEY `updated_manager_id_idxfk_1` (`updated_manager_id`),
  CONSTRAINT `artist_ibfk_1` FOREIGN KEY (`created_manager_id`) REFERENCES `manager` (`id`),
  CONSTRAINT `artist_ibfk_2` FOREIGN KEY (`updated_manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artist`
--

LOCK TABLES `artist` WRITE;
/*!40000 ALTER TABLE `artist` DISABLE KEYS */;
/*!40000 ALTER TABLE `artist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_manager_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_manager_id_idxfk_2` (`created_manager_id`),
  KEY `updated_manager_id_idxfk_2` (`updated_manager_id`),
  CONSTRAINT `category_ibfk_1` FOREIGN KEY (`created_manager_id`) REFERENCES `manager` (`id`),
  CONSTRAINT `category_ibfk_2` FOREIGN KEY (`updated_manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'art',0,'2018-08-01 12:59:07',1,NULL,NULL),(2,'design',0,'2018-08-01 12:59:20',1,NULL,NULL),(3,'advertisement',0,'2018-08-04 02:01:38',1,NULL,NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL DEFAULT '',
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `business_time` varchar(255) DEFAULT NULL,
  `closing_days` varchar(255) DEFAULT NULL,
  `entry_fee` varchar(255) DEFAULT NULL,
  `place_id` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `comment` text,
  `new` tinyint(1) NOT NULL DEFAULT '0',
  `popular` tinyint(1) NOT NULL DEFAULT '0',
  `pickup` tinyint(1) NOT NULL DEFAULT '0',
  `main_image_path` varchar(255) DEFAULT NULL,
  `main_image_info` json DEFAULT NULL,
  `list_image_path` varchar(255) DEFAULT NULL,
  `list_image_info` json DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_manager_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `place_id_idxfk` (`place_id`),
  KEY `created_manager_id_idxfk_5` (`created_manager_id`),
  KEY `updated_manager_id_idxfk_5` (`updated_manager_id`),
  CONSTRAINT `event_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`),
  CONSTRAINT `event_ibfk_2` FOREIGN KEY (`created_manager_id`) REFERENCES `manager` (`id`),
  CONSTRAINT `event_ibfk_3` FOREIGN KEY (`updated_manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'ルーヴル美術館展 肖像芸術 - 人は人をどう表現してきたか ','2018-05-30 00:00:00','2018-09-03 00:00:00','10:00-18:00 ※毎週金・土曜日は、6月は20:00まで、7・8・9月は21:00まで開館 ※入場は閉館の30分前まで ','毎週火曜日 ※ただし8/14（火）は開館 ','当日：1,600円（一般）、1,200円（大学生）、800円（高校生）、前売／団体：1,400円（一般）、1,000円（大学生）、600円（高校生）',2,'http://www.nact.jp/exhibition_special/2018/louvre2018/','人の似姿を描出する肖像は、古代以来の長い歴史をもつ芸術ジャンルです。\r\n本展は、ルーヴル美術館の全8部門から選りすぐられた約110点の作品を通して、肖像の社会的役割や表現上の様々な特質を浮き彫りにします。27年ぶりに来日するヴェネツィアの巨匠ヴェロネーゼの傑作《女性の肖像》、通称《美しきナーニ》から、古代エジプトの棺を飾ったマスク、ローマ皇帝やナポレオンなどの君主像、そして華麗な女性や愛らしい子どもたちの肖像まで、数々の肖像の名品が一堂に会します。 ',0,0,0,'/web/uploads/201808021916135301ルーブル.png',NULL,'/web/uploads/201808021916134075ルーブル.png',NULL,0,'2018-08-01 13:06:43',1,'2018-08-02 19:16:13',1),(2,'荒木飛呂彦原画展 - JOJO 冒険の波紋 ','2018-08-24 00:00:00','2018-10-01 00:00:00','10:00-18:00 ※毎週金・土曜日は21:00まで。','毎週火曜日','本展覧会は完全日時指定制となります。展覧会ホームページ( http://jojoex-2018.com/ticket/ )の注意事項をご確認の上、チケットをご購入ください。',2,'http://www.nact.jp/exhibition_special/2018/jojoex-2018/','',0,0,0,'/web/uploads/201809041920478744荒木飛呂彦原画展.png',NULL,'/web/uploads/201809041920471773荒木飛呂彦原画展.png',NULL,0,'2018-08-02 19:27:58',1,'2018-09-04 19:20:47',1),(3,'オルセー美術館特別企画 ピエール・ボナール展','2018-09-26 00:00:00','2018-12-17 00:00:00','10:00-18:00 ※毎週金・土曜日は20:00まで。ただし9月28日（金）、29日（土）は21:00まで　※入場は閉館の30分前まで','毎週火曜日','【当日】1,600円（一般） 1,200円（大学生） 800円（高校生） 【前売／団体】1,400円（一般）、1,000円（大学生）、600円（高校生）',2,'http://bonnard2018.exhn.jp','',0,0,0,'/web/uploads/201809041922511619ピエール.png',NULL,'/web/uploads/201809041922511521ピエール.png',NULL,0,'2018-08-02 19:41:38',1,'2018-09-04 19:22:51',1),(4,'生誕110年 東山魁夷展 ','2018-10-24 00:00:00','2018-12-03 00:00:00','10:00-18:00 ※毎週金・土曜日は 20：00まで  ※入場は閉館の30分前まで ','毎週火曜日','【当日】1,600円（一般）、1,200円（大学生）、800円（高校生） 【前売／団体】1,400円（一般）、1,000円（大学生）、600円（高校生）',2,'http://kaii2018.exhn.jp/','',0,0,0,'/web/uploads/201809041924072413東山魁夷.png',NULL,'/web/uploads/201809041924077700東山魁夷.png',NULL,0,'2018-08-02 19:49:17',1,'2018-09-04 19:24:07',1),(5,'六本木ヒルズ・森美術館15周年記念展 建築の日本展：その遺伝子のもたらすもの','2018-04-25 00:00:00','2018-09-17 00:00:00','10:00～22:00（最終入館 21:30） ※火曜日のみ17:00まで（最終入館 16:30）','なし','一般：1,800円　学生（高校・大学生）：1,200円　子供（4歳～中学生）：600円　シニア（65歳以上）：1,500円',3,'https://www.mori.art.museum/jp/exhibitions/japaninarchitecture/index.html','いま、世界が日本の建築に注目しています。丹下健三、谷口吉生、安藤忠雄、妹島和世など多くの日本人建築家たちが国際的に高い評価を得ているのは、古代からの豊かな伝統を礎とした日本の現代建築が、他に類を見ない独創的な発想と表現を内包しているからだとはいえないでしょうか。\r\n\r\n日本は、明治維新からの150年間、大いなる建築の実験場でした。幾多の実践のなかで、日本の成熟した木造文化はいかに進化したのでしょうか。西洋は日本の建築にどのような魅力を見いだし、日本建築はそれにどう向き合ったのでしょうか。日々の暮らしや自然観といった目に見えないものの変遷も日本の建築を捉える上で重要な要素となるはずです。\r\n\r\n本展は、いま、日本の建築を読み解く鍵と考えられる9つの特質で章を編成し、機能主義の近代建築では見過ごされながらも、古代から現代までその底流に脈々と潜む遺伝子を考察します。貴重な建築資料や模型から体験型インスタレーションまで100プロジェクト、400点を超える多彩な展示によって、日本建築の過去、現在だけでなく、未来像が照らしだされることでしょう。',0,0,0,'/web/uploads/201809041905146515六本木ヒルズ・森美術館15周年記念展 建築の日本展：その遺伝子のもたらすもの.png',NULL,'/web/uploads/201809041905145580六本木ヒルズ・森美術館15周年記念展 建築の日本展：その遺伝子のもたらすもの.png',NULL,0,'2018-08-02 20:26:06',1,'2018-09-04 19:05:14',1),(6,'六本木ヒルズ・森美術館15周年記念展 カタストロフと美術のちから展','2018-10-06 00:00:00','2019-01-20 00:00:00','10:00～22:00（最終入館 21:30） ※火曜日のみ17:00まで（最終入館 16:30）','なし','一般：1,800円　学生（高校・大学生）：1,200円　子供（4歳～中学生）：600円　シニア（65歳以上）：1,500円',3,'https://www.mori.art.museum/jp/exhibitions/catastrophe/index.html','東日本大震災やアメリカ同時多発テロ、リーマンショックなど世界各地で絶えず発生するカタストロフ。多くのアーティストがこのような悲劇的な災禍を主題に、惨事を世に知らしめ、後世に語り継ごうと作品を制作しています。その私的な視点による記録は、マスメディアの客観性を重んじる記録とは異なり、多勢の世論の影に隠れて見えにくくなったもう１つの事実を私たちに提示します。そこにはまた、社会の矛盾や隠蔽された問題の可視化を意図するものや、個人的な喪失や悼みを表現するものもあります。\r\n\r\nカタストロフは私たちを絶望に追い込みますが、そこから再起しようとする力は想像力を刺激し、創造の契機となることもまた、事実なのではないでしょうか。東日本大震災以降、国内外の数多くのアーティストが復興・再生への願いを込めて理想や希望を描き、より良い社会のために新しいヴィジョンを提示しようと試みています。\r\n\r\n戦争やテロ、難民問題や環境破壊など、危機的な問題が山積する今日において、美術が社会を襲う大惨事や個人的な悲劇とどのように向き合い、私たちが再生を遂げるためにどのような役割を果たすことができるのか。本展は、負を正に転ずる力学としての「美術のちから」について注目し、その可能性を問いかけます。',0,0,0,'/web/uploads/201809212056222662yokoono.jpg',NULL,'/web/uploads/201809212056222609yokoono.jpg',NULL,0,'2018-08-02 20:34:59',1,'2018-09-21 20:56:22',1),(7,'TCC広告賞展2018','2018-07-21 00:00:00','2018-08-22 00:00:00','火-土曜 11:00-18:00','日・月曜','無料',4,'http://www.admt.jp/exhibition/program/','2018年度のTCCグランプリに選ばれたのは、UHA味覚糖のさけるグミ「ちーちゃんは長いのが好きなんだね。」 LONG LONG MAN～（井村光明氏／博報堂）。また、TCC最高新人賞はリクルートホールディングスのゼクシィ「結婚しなくても幸せになれるこの時代に私は、あなたと結婚したいのです。」などで坂本美慧氏（博報堂）が受賞。\r\n本展では、TCCグランプリ1作品、TCC賞14作品、審査委員長賞3作品と最高新人賞1名・新人賞25名の受賞作品を紹介します。',0,0,0,'/web/uploads/201808040207035395tcc_exhibition_20180707-115607.jpg',NULL,'/web/uploads/201808040207038631tcc_exhibition_20180707-115607.jpg',NULL,0,'2018-08-04 02:07:03',1,NULL,NULL),(8,'デザインあ展 in TOKYO','2018-07-19 00:00:00','2018-10-18 00:00:00','10:00-17:00 ※入場は閉館時間の30分前まで。ただし、土曜日、祝前日（9/16、9/23、10/7）、8/10～18は20:00まで開館、 常設展は17:00に終了','9月4日（火）、11日（火）、18日（火）、25日（火）、10月2日（火）、9日（火）、16日（火）','【当日（前売）】大人（19歳以上）：1,600円（1,400円）、中人（小学生〜18歳以下）：1,000円（800円）、小人（3歳〜小学生未満）：500円（400円）',5,'http://www.design-ah-exhibition.jp/tokyo/','こどもたちのデザインマインドを育む番組 NHK Eテレ「デザインあ」。本展は「デザインあ」のコンセプトを、体験の場に発展させた展覧会です。優れたデザインには、人と人、人とモノをよりよくつなぐ工夫があります。番組では、身のまわりに意識を向け（みる）、どのような問題があるかを探り出し（考える）、よりよい状況をうみだす（つくる）という一連の思考力と感性を「デザインマインド」ととらえ、多彩な映像表現をもちいて伝えてきました。デザインあ展は、この「デザインマインド」を､見て、体験できる展覧会です。2013年に開催された前回展（22万人動員）から作品を新たにし、身のまわりにあるモノ・コトから概念までテーマをほりさげます。未来を担うこどもたちに、「見る」「考える」「つくる」ことの豊かさを体感してもらいたいと願っています。',0,0,0,'/web/uploads/201809041918101182デザインあ展.png',NULL,'/web/uploads/201809041918107865デザインあ展.png',NULL,0,'2018-08-04 02:24:24',1,'2018-09-04 19:18:10',1),(9,'AUDIO ARCHITECTURE：音のアーキテクチャ展','2018-06-29 00:00:00','2018-10-14 00:00:00','     10:00 - 19:00（入場は18:30まで）','     火曜日','一般 1,100円、大学生 800円、高校生 500円、中学生以下無料',6,'http://www.2121designsight.jp/program/audio_architecture/','21_21 DESIGN SIGHTでは2018年6月29日より、企画展「AUDIO ARCHITECTURE：音のアーキテクチャ展」を開催します。展覧会ディレクターには、独自の表現により、ウェブ、インターフェース、映像の分野で高く評価されている中村勇吾を迎えます。\r\n\r\n私たちが普段なにげなく親しんでいる音楽は、音色や音域、音量、リズムといった様々な要素によって緻密にデザインされた構造物（アーキテクチャ）であると言えます。しかし、日常の中でその成り立ちや構造について特別に意識する機会は少ないのではないでしょうか。\r\n\r\n本展では、ミュージシャンの小山田圭吾（Cornelius）が展覧会のために書き下ろした新曲『AUDIO ARCHITECTURE』を、気鋭の作家たちがそれぞれの視点から解釈し、映像作品を制作します。参加作家は、映像、アニメーション、ダンス、グラフィック、広告、イラストレーション、プログラミング、メディアデザインなどの領域を横断しながら、多彩な感性をもって新しい表現に取り組む9組です。展覧会のグラフィックデザインは、北山雅和（Help!）が手掛けました。\r\n\r\nWonderwall 片山正通が会場構成を担当したダイナミックな空間に、ひとつの楽曲と複数の映像作品を繰り返し再生することで、「音楽建築空間」の構築を試みます。\r\n音楽、映像、空間が一体となった会場で、音楽への新鮮な視点を発見してください。',0,0,0,'/web/uploads/201809041917176315audio_architecture.png',NULL,'/web/uploads/201809041917176433audio_architecture.png',NULL,0,'2018-08-09 21:13:08',1,'2018-09-04 19:17:17',1),(10,'ヒロシマ・アピールズ展','2018-08-04 00:00:00','2018-09-02 00:00:00','10:00 - 19:00','無し','無料',6,'http://www.2121designsight.jp/gallery3/hiroshima_appeals/','原爆の記憶を絶やすことなく、平和を希求する想いを広く伝えようと、日本グラフィックデザイナー協会（JAGDA）とヒロシマ平和創造基金、広島国際文化財団が行っている「ヒロシマ･アピールズ」。純粋に中立な立場から「ヒロシマの心」を訴える「ヒロシマ･アピールズ」ポスターを毎年一名のグラフィックデザイナーが制作し、国内外に頒布する活動を続けています。\r\n本展ではその第1回となる1983年に制作された亀倉雄策（1915-1997）の『燃え落ちる蝶』より今年度の服部一成（1964-）『疑問符、2018』まで、全21作品を紹介。さらに、13歳のときに被爆し、平和への願いを込めた100枚のポスター制作に挑んだ広島出身のデザイナー、片岡 脩（しう）（1932-1997）の作品も特別展示します。「生きて、子どもたちへ、さらに世代へと伝えたいことがある」と記していた片岡は、65歳で他界するまで、72点のポスターを制作しました。\r\nデザインによって伝えられる鮮明なメッセージ。ヒロシマの記憶と未来への願いについて、多くの方々と考える機会となれば幸いです。 ',0,0,0,'/web/uploads/201808092125275144Screen Shot 2018-08-09 at 21.19.51-fullpage.png',NULL,'/web/uploads/201808092125278165Screen Shot 2018-08-09 at 21.19.51-fullpage.png',NULL,0,'2018-08-09 21:25:27',1,NULL,NULL),(11,'オープン・スペース2018 イン・トランジション','2018-06-02 00:00:00','2019-03-10 00:00:00','午前11時&amp;mdash;午後6時','月曜日（月曜が，祝日もしくは振替休日の場合翌日．ただし2/11［月］は休館，2/12［火］は開館），保守点検日（8/5，2/10），年末年始（12/28&amp;ndash;1/4）','無料',7,'http://www.ntticc.or.jp/ja/exhibitions/2018/open-space-2018-in-transition/','\r\n「オープン・スペース」展は，メディア・アート作品をはじめ，現代のメディア環境における多様な表現をとりあげ，幅広い観客層に向けて紹介する展覧会です．メディア・アートにおける代表的な作品，先端技術を取り入れた作品，批評的な観点を持つ作品，さらに研究機関で進行中のプロジェクトなどを，作品の理解を助ける解説とともに展示し，作品を楽しむだけでなく，その背景にある現代の多様化したメディアやコミュニケーションの在り方，現代社会における問題，未来への展望や，さらに新しい感性や美意識について考えるきっかけとなることをめざしています．\r\n\r\n13回目となる今年度は，「オープン・スペース 2018　イン・トランジション」と題し，つねに変化していく現在のテクノロジー状況を移行期（in transition）ととらえ，その移り変わりの中に私たちの未来のヴィジョンを見出すアート作品を紹介します．\r\n\r\n会期中には，アーティストや有識者を招いたトーク，レクチャー，シンポジウム，ワークショップ，作品解説ツアーを開催するなど，さまざまなプログラムを用意しています． そのほか，文化機関やNTTの研究所との連携などを通じて，国内外のさまざまなゲストを招いた催しを行なう予定です．\r\n\r\nオープン・スペースとは，2006年より開始された，ギャラリーでの年度ごとに展示内容を変える展覧会，ミニ・シアター，映像アーカイヴ「HIVE」などを，入場無料で公開するものです．ICCの活動理念にもとづき，より多くの方々に先進的な技術を用いた芸術表現とコミュニケーション文化の可能性を提示する開かれた場として機能することをめざしています．',0,0,0,'/web/uploads/201809041913439520オープンスペース2018イントランジション.png',NULL,'/web/uploads/201809041913435191オープンスペース2018イントランジション.png',NULL,0,'2018-08-10 21:29:55',1,'2018-09-04 19:13:43',1),(12,'戦争と花','2018-07-20 00:00:00','2018-08-15 00:00:00','火曜日・水曜日 12:00 &ndash; 19:00','木-日曜日','無料',8,'http://themass.jp/gallery1/','本展覧会は「戦争と花」をテーマとし、7～8年ほど前から東 信らによって折に触れて集められた「戦争」と「花」をめぐるイメージを基礎として、国際的な写真家集団マグナム・フォト、報道写真の厖大な蓄積を持つ朝日新聞フォトアーカイブ、共同通信イメージズらの協力も得て蒐集された、戦争を題材とした様々な切り口の写真で構成される展示内容となっております。\r\n \r\n人は生まれてから死ぬまでの間、祝いの花から励ましの花、弔いの花や祈りの花など、人生の様々な場面で花と寄り添って生きてきました。美しく咲き誇る花の姿に、そして儚く短い花の命に、人は言葉に出来ない感情や願い、慈しみを託して花を捧げてきました。それは戦争という人類の最も醜悪な歴史の一幕においても垣間見れる行為です。世界はここ数世紀の間に飛躍的な科学技術の発展を遂げるとともに争いをも多様化させてきたといえます。今回、この「戦争」と「花」という一見相反する要素を一つのレンズの中で繋ぎ合わせた数々の写真作品を通じて、戦争という人類の負の史実と向き合い、ひとりでも多くの人々、とりわけ若い世代の人々にも平和への思いを深く思慮する機会として欲しいと考え、開催いたします。',0,0,0,'/web/uploads/201808102213501173戦争と花.png',NULL,'/web/uploads/201808102213505697戦争と花.png',NULL,0,'2018-08-10 22:13:50',1,NULL,NULL),(13,'PORTRAIT','2018-08-25 00:00:00','2018-09-23 00:00:00','火曜日・水曜日 12:00 &amp;ndash; 19:00','木-月曜日','500円 ※学生無料',8,'http://themass.jp/gallery1/','The Massでは、S.U.C.C.* との企画による『PORTRAIT』展を開催いたします。\r\n \r\n本展覧会では、&amp;rsquo;PORTRAIT&amp;rsquo; をテーマとし、多様なアーティストの作品を一同にご覧頂ける機会となっております。\r\n \r\n* S.U.C.C.\r\n京都精華大学ポピュラーカルチャー学部客員教授を務める藤原ヒロシ氏のもとに集まったクリエイションやPRを学ぶ学生の集団。',0,0,0,'/web/uploads/201809041921287259PORTRAIT.png',NULL,'/web/uploads/201809041921284235PORTRAIT.png',NULL,0,'2018-08-10 22:20:28',1,'2018-09-04 19:21:28',1),(14,'第71回広告電通賞展','2018-08-28 00:00:00','2018-09-22 00:00:00','火ー土	11:00 - 18:00','毎週日、月曜日','無料',4,'http://www.admt.jp/exhibition/program/','2018年8月28日（火）～9月22日（土）まで「第71回広告電通賞展」を開催いたします。\r\n2018年、広告活動において特に優秀な成果をあげた広告主として「総合広告電通賞」に株式会社 NTTドコモが選ばれました。本展では、入賞作品の中から41作品を展示します。\r\n日本の広告クリエーティブの歴史と称される広告電通賞。その優れた企画力、表現力が発揮された広告作品を是非ご覧ください。\r\n\r\n＜広告電通賞とは＞\r\n広告電通賞は、1947年12月に創設された日本で最も歴史ある総合広告賞です。\r\n優れた広告コミュニケーションを実践した広告主を顕彰することにより広告主の課題解決の道を広げ、日本の産業・経済・文化の発展に貢献することを目指しています。\r\n公的機関である「広告電通賞審議会」によって運営されており、取り扱い広告会社・制作会社にかかわらず、すべての広告主に応募資格があります。\r\n選考は、広告主・媒体社・クリエーター・有識者ら約500名から構成される広告電通賞審議会の選考委員によって行われ、毎年5月の最終選考委員総会で各賞が決定し、7月に贈賞式が行われます。\r\n日本をはじめ世界各国には数多くの広告賞がありますが、これほど多くの選考委員を組織し、幅広い領域を網羅している賞は少なく、日本の広告界を代表する広告賞として高く評価されています。\r\n広告界の変化を反映して毎年種目・部門の見直しが行われており、第71回では「クリエーティブ種目」として6種目22部門「プランニング種目」として2種目4部門が設けられています。',0,0,0,'/web/uploads/201809212102231756広告電通賞展.png',NULL,'/web/uploads/201809212102235319広告電通賞展.png',NULL,0,'2018-09-21 21:02:23',1,NULL,NULL),(15,'GOOD Ideas for GOOD ミニシアター','2018-09-27 00:00:00','2018-10-13 00:00:00','火ー土	11:00 - 18:00','毎週日、月曜日','無料',4,'http://www.admt.jp/exhibition/program/','-',0,0,0,'/web/uploads/201809212125071725NoImage.png',NULL,'/web/uploads/201809212125076961NoImage.png',NULL,0,'2018-09-21 21:18:10',1,'2018-09-21 21:25:07',1),(16,'世界のクリエイティブアワード展 -D&amp;AD Awards 2018-','2018-10-20 00:00:00','2018-12-01 00:00:00','火ー土　11:00 - 18:00','毎週日、月曜日','無料',4,'http://www.admt.jp/exhibition/program/','-',0,0,0,'/web/uploads/201810270853104939 creativeaward.png',NULL,'/web/uploads/201810270853106259 creativeaward.png',NULL,0,'2018-09-21 21:26:59',1,'2018-10-27 08:53:10',1),(17,'世界のクリエイティブアワード展 -Cannes Lions International Festival of Creativity 2018-','2018-12-07 00:00:00','2019-01-26 00:00:00','火ー土	11:00 - 18:00','毎週日、月曜日','無料',4,'http://www.admt.jp/exhibition/program/','-',0,0,0,'/web/uploads/201810270854031617 creativeaward.png',NULL,'/web/uploads/201810270854036060 creativeaward.png',NULL,0,'2018-09-21 21:28:48',1,'2018-10-27 08:54:03',1),(18,'世界のクリエイティブアワード展 -ONE SHOW 2018-','2019-02-01 00:00:00','2019-03-16 00:00:00','火ー土	11:00 - 18:00','毎週日、月曜日','無料',4,'http://www.admt.jp/exhibition/program/','-',0,0,0,'/web/uploads/201810270854263699 creativeaward.png',NULL,'/web/uploads/201810270854267139 creativeaward.png',NULL,0,'2018-09-21 21:30:20',1,'2018-10-27 08:54:26',1),(19,'日本のアートディレクション展 2018（一般作品）','2018-10-29 00:00:00','2018-11-22 00:00:00','11:00a.m.-7:00p.m.　','日曜・祝日','入場無料',9,'http://rcc.recruit.co.jp/g8/exhibition/201810-3/201810-3.html','日本のアートディレクション展 2018は、昨年までADC展として開催されていた、当ギャラリー恒例の企画で、広告・デザイン界で注目されているイベントのひとつです。今年より名称がかわり、日本のアートディレクション展 2018となりました。\r\nADC（正式名称：東京アートディレクターズクラブ）は1952年に結成、日本を代表するアートディレクター80名により構成されています。\r\nこの全会員が審査員となって行われる年次公募展が日本のアートディレクション展 2018で、ここで選出されるADC賞は、日本の広告やグラフィックデザインの先端の動向を反映する賞として、国内外の注目を集めています。\r\n今年度も、2017年5月から2018年4月までの一年間に発表、使用、掲載された約8,000点の応募があり、ADC会員の3日間にわたる厳正な審査により、受賞作品と年鑑収録作品が選出されました。\r\nここで選び抜かれた受賞作品、優秀作品を、『Art Direction Japan / 日本のアートディレクション』刊行に先駆け、クリエイションギャラリーG8［一般（非会員）作品］とギンザ・グラフィック・ギャラリー［会員作品］の両会場でご紹介いたします。',0,0,0,'/web/uploads/201810270848125368 artdirection-in-japan.png',NULL,'/web/uploads/201810270848128022 artdirection-in-japan.png',NULL,0,'2018-10-27 08:34:07',1,'2018-10-27 08:48:12',1),(20,'大堀相馬焼167のちいさな豆皿','2018-11-27 00:00:00','2018-12-22 00:00:00','11:00 &ndash; 19:00','日曜','入場無料',9,'http://rcc.recruit.co.jp/creationproject/','\r\n\r\n167人のクリエイターがデザインした、167種類の大堀相馬焼の豆皿を展示、販売します。\r\n\r\n大堀相馬焼は、江戸時代元禄期から続く福島県浪江町の伝統工芸品です。東日本大震災の影響を受けて浪江町での製作はできなくなりましたが、窯元たちは福島県内の別の地域に拠点を移し、窯を新調し、愛知県瀬戸市の瀬戸土を使い製作を再開しました。拠点が離ればなれになった今も、協同での陶器づくりが窯元同士を繋いでいます。今では地域おこし協力隊の若い職人も県外から参加し、様々な人のつながりによって浪江町の伝統は福島にあり続けています。\r\n\r\n今回は、大堀相馬焼の3つの窯元と協力し、167人のクリエイターがデザインした豆皿をつくります。手のひらサイズのちいさな豆皿は、ろくろ職人が一つ一つ手作業で成形しています。豆皿の種類によってみられる細かなひびは、大堀相馬焼の特徴の一つ。熱い窯を開けて豆皿を冷ます際に、釉薬が収縮することでひび割れが起こり、キラキラと風鈴のような貫入音が鳴ります。\r\n\r\n今年７年ぶりに町内で開校した福島県浪江町立なみえ創成小・中学校で、地元の伝統工芸品に親しみながら、豆皿のデザインに挑戦するワークショップを行いました。子どもたちの考えた豆皿は実際に焼き上げ、クリエイターの豆皿と一緒に展示します。\r\n\r\n豆皿の販売収益金は、未来を担う子どもたちの支援のために、セーブ・ザ・チルドレンに寄付をします。ぜひこの機会に、多くの方にチャリティーにご参加いただけることを願っています。',0,0,0,'/web/uploads/201810270838016781 soumayaki.png',NULL,'/web/uploads/201810270838014219 soumayaki.png',NULL,0,'2018-10-27 08:38:01',1,NULL,NULL),(21,'秋山花展「THE WISDOM OF YOU」','2018-10-23 00:00:00','2018-11-16 00:00:00','11:00a.m.-7:00p.m.','日曜・祝日','入場無料',10,'http://rcc.recruit.co.jp/gg/exhibition/the-wisdom-of-you/the-wisdom-of-you.html','ガーディアン・ガーデンでは「The Second Stage at GG」シリーズの49回目として、秋山花展「THE WISDOM OF YOU」を開催します。本シリーズは、ガーディアン・ガーデンで開催する公募展の入選者たちの、その後の活躍を紹介する展覧会です。\r\n\r\n秋山花は、手描きの絵をコラージュして独自の物語性を持たせたポスター作品で、第25 回グラフィックアート『ひとつぼ展』ファイナリストに選出されました。その後もアワードや展覧会で高い評価を得て注目を集め、書籍、雑誌、CD、広告などを中心にイラストレーターとして活躍しています。2014年にはニューヨークADC賞銀賞を受賞。現在、雑誌『暮しの手帖』や『tocotoco』などで挿絵を連載しています。\r\n\r\n現在、2歳男児の母として、育児をしながら制作活動を行っている秋山花。本展では、自身の育児経験から着想を得て、日常の中での問い、気づき、不安や喜びなどをテーマに描いたイラストレーションの作品を展示します。本展のために描き下ろした、少年を描いたシリーズ「reading」では、人が本と出会い、物語の世界に引き込まれる姿が描かれています。誰に教わるでもなく、自ら考え理解しようとする男の子のイラストレーションは、温かみのあるやさしいタッチでありながらも、どこか幻想的で、ときに残酷さをも感じさせる、子ども独特の創造性を力強く伝えます。次々と体の色を変化させながらさまざまな場所を飛んでいくカラスの姿を手描きで制作したアニメーション作品も展示。このほか、無印良品やID&Eacute;E、雑誌『暮しの手帖』などのクライアントワークも展示します。多彩な作品が一堂に会する展示をぜひご覧ください。',0,0,0,'/web/uploads/201810270840504556akiyama.png',NULL,'/web/uploads/201810270840504915akiyama.png',NULL,0,'2018-10-27 08:40:50',1,NULL,NULL),(22,'日本のアートディレクション展 2018（会員作品）','2018-10-29 00:00:00','2018-11-22 00:00:00','11:00ａ.ｍ.－7:00ｐ.ｍ.','日曜・祝日','入場無料',11,'http://www.dnp.co.jp/CGI/gallery/schedule/detail.cgi?l=1&amp;t=1&amp;seq=00000729','日本のアートディレクション展 2018は、昨年までADC展として開催されていた、当ギャラリー恒例の企画で、広告・デザイン界で注目されているイベントのひとつです。今年より名称がかわり、日本のアートディレクション展 2018となりました。ADC（正式名称：東京アートディレクターズクラブ）は1952年に設立、日本を代表するアートディレクター80名により構成されています。\r\nこの全会員が審査員となって行われる年次公募展が日本のアートディレクション展 2018で、ここで選出されるADC賞は、日本の広告やグラフィックデザインの先端の動向を反映する賞として、国内外の注目を集めています。\r\n今年度も、2017年5月から2018年4月までの一年間に発表、使用、掲載された約8,000点の作品の応募があり、ADC会員の3日間にわたる厳正な審査により、受賞作品と年鑑収録作品が選出されました。\r\nここで選び抜かれた受賞作品、優秀作品を、『Art Direction Japan/ 日本のアートディレクション 2018』刊行に先駆け、ggg[会員作品]とG8[一般作品]の２つの会場でご紹介いたします。',0,0,0,'/web/uploads/201810270849565021 artdirection-in-japan.png',NULL,'/web/uploads/201810270849562886 artdirection-in-japan.png',NULL,0,'2018-10-27 08:49:56',1,NULL,NULL),(23,'JAGDA新人賞展2019 赤沼夏希・岡崎智弘・小林一毅','2019-05-28 00:00:00','2019-06-29 00:00:00','11:00-19:00','日曜日','無料',9,'http://rcc.recruit.co.jp/g8/exhibition/201905/201905.html','\r\n\r\n1978年に発足した公益社団法人日本グラフィックデザイナー協会(略称JAGDA)は、現在、会員数約3,000名を誇るアジア最大規模のデザイン団体として、年鑑『Graphic Design in Japan』の発行や展覧会・セミナーの開催、デザイン教育、公共デザインや地域振興への取り組み、国際交流など、デザインによるコミュニケーション環境の向上のために様々な活動をおこなっています。\r\n\r\nまた、毎年、『Graphic Design in Japan』出品者の中から、今後の活躍が期待される有望なグラフィックデザイナー(39歳以下)に「JAGDA新人賞」を贈っています。この賞は1983年来、デザイナーの登竜門として、いまや第 一線で活躍する110名のデザイナーを輩出し、デザイン・広告関係者の注目を集めています。37回目となる今回は、新人賞対象者152名の中から厳正な選考の結果、赤沼夏希・岡崎智弘・小林一毅の3名が選ばれました。\r\n\r\n本展では、3名の受賞作品および近作を、ポスターやプロダクト、映像などを中心に展示します。博報堂に所属し、様々なジャンルの企業ロゴ、ポスター、イラストレーターの個展グッズなどを手がける赤沼夏希。グラフィックデザインを起点に、印刷物に留まらず映像制作や展覧会の空間構成も行う岡崎智弘。資生堂で商品広告やパッケージデザインを手がけながら、個人でも活動を行い2019年5月に独立した小林一毅。3名によるデザインと取り組みをご紹介します。',0,0,0,'/web/uploads/201906031938487563jagda_new_banner_ex_190425-970x970.png',NULL,'/web/uploads/201906031938489881jagda_new_banner_ex_190425-970x970.png',NULL,0,'2019-06-03 19:38:48',1,NULL,NULL),(24,'日本・オーストリア外交樹立150周年記念 ウィーン・モダン　クリムト、シーレ 世紀末への道','2019-04-24 00:00:00','2019-08-05 00:00:00','10:00〜18:00 ※毎週金・土曜日は、4・5・6月は20:00、7・8月は21:00まで。4月28日（日）〜5月2日（木）と5月5日（日）は20:00まで開館。5月25日（土）は「六本木アートナイト2019」開催に伴い22:00まで開館。※入場は閉館の30分前まで。','毎週火曜日 ※ただし4月30日は開館','https://artexhibition.jp/wienmodern2019/tickets/',2,'https://artexhibition.jp/wienmodern2019/','19世紀末から20世紀初頭にかけて、ウィーンでは、絵画や建築、工芸、デザイン、ファッションなど、それぞれの領域を超えて、新しい芸術を求める動きが盛んになり、ウィーン独自の装飾的で煌びやかな文化が開花しました。今日では「世紀末芸術」と呼ばれるこの時代に、画家グスタフ・クリムト（1862-1918）やエゴン・シーレ（1890-1918）、建築家オットー・ヴァーグナー（1841-1918）、ヨーゼフ・ホフマン（1876-1958）、アドルフ・ロース（1870-1933）など各界を代表する芸術家たちが登場し、ウィーンの文化は黄金期を迎えます。それは美術の分野のみならず、音楽や精神医学など多岐にわたるものでした。\r\n本展は、ウィーンの世紀末文化を「近代化への過程」という視点から紐解く新しい試みの展覧会です。18世紀の女帝マリア・テレジアの時代の啓蒙思想がビーダーマイアー時代に発展し、ウィーンのモダニズム文化の萌芽となって19世紀末の豪華絢爛な芸術運動へとつながっていった軌跡をたどる本展は、ウィーンの豊穣な文化を知る展覧会の決定版と言えます。',0,0,0,'/web/uploads/201906031947046997   .png',NULL,'/web/uploads/201906031947045681   .png',NULL,0,'2019-06-03 19:47:04',1,NULL,NULL),(25,'クリスチャン・ボルタンスキー &ndash; Lifetime','2019-06-12 00:00:00','2019-09-02 00:00:00','10：00～18：00 ※毎週金・土曜日は、6月は20：00まで、7・8月は21：00まで ※入場は閉館の30分前まで','毎週火曜日','https://boltanski2019.exhibit.jp/outline/index.html',2,'https://boltanski2019.exhibit.jp/index.html','現代のフランスを代表する作家、クリスチャン・ボルタンスキー（1944年-）の活動の全貌を紹介する、日本では過去最大規模の回顧展です。作家は1960年代後半から短編フィルムを発表、1970年代には写真を積極的に用いて、自己や他者の記憶にまつわる作品を制作し、注目されます。1980年代に入ると、光を用いたインスタレーションで宗教的なテーマに取り組み、国際的な評価を獲得。その後も歴史や記憶、人間の存在の痕跡といったものをテーマに据え、世界中で作品を発表しています。\r\n本展では、50年にわたるボルタンスキーの様々な試みを振り返ると同時に、「空間のアーティスト」と自負する作家自身が、展覧会場に合わせたインスタレーションを手がけます。',0,0,0,'/web/uploads/201906031958502998lifetime.png',NULL,'/web/uploads/201906031958509374lifetime.png',NULL,0,'2019-06-03 19:58:50',1,NULL,NULL),(26,'話しているのは誰？ 現代美術に潜む文学','2019-08-28 00:00:00','2019-11-11 00:00:00','10：00～18：00 ※毎週金・土曜日は、8・9月は21:00まで、10・11月は20:00まで ※入場は閉館の30分前まで','毎週火曜日 ※ただし、10月22日（火・祝）は開館、10月23日（水）は休館','当日：1,000円（一般）、500円（大学生）、前売／団体：800円（一般）、300円（大学生）',2,'http://www.nact.jp/exhibition_special/2019/gendai2019/','国内外で活躍する日本の現代美術家6名によるグループ展を開催いたします。本展に参加する6名の作家は1950年代から1980年代生まれまでと幅広く、表現方法も映像や写真を用いたインスタレーションをはじめとして多岐にわたります。これら作家に共通するのは、作品のうちに文学の要素が色濃く反映されていることです。\r\n古代ローマの詩人ホラティウスが『詩論』で記した「詩は絵のごとく」という一節は、詩と絵画という芸術ジャンルに密接な関係を認める拠り所として頻繁に援用されてきました。以来、詩や文学のような言語芸術と、絵画や彫刻のような視覚芸術との類縁関係を巡る議論は、さまざまな時代と場所で繰り広げられてきました。\r\n展覧会タイトルが示唆するように、本展では文学をテーマに掲げています。ですが、ここでの文学は、一般に芸術ジャンル上で分類される文学、つまり書物の形態をとる文学作品だけを示すわけではありません。現代美術において、文学はこうした芸術ジャンルに基づく区別とは違ったかたちで表れているように思われます。日本の現代美術における文学のさまざまな表れ方を経験していただければ幸いです。',0,0,0,'/web/uploads/201906032004556829gendai.png',NULL,'/web/uploads/201906032004553808gendai.png',NULL,0,'2019-06-03 20:04:55',1,NULL,NULL),(27,'カルティエ、時の結晶 ','2019-10-02 00:00:00','2019-12-16 00:00:00','未定','未定','未定',2,'','カルティエの作品は1995年、2004年、2009年の展覧会を通して日本で紹介されてきました。1989年以降、日本だけでなく世界各国の主要美術館においてそのコレクションが展示紹介されてきたことは、数あるメゾンの中でも特筆されることです。\r\n過去におけるこうした展示は、いわゆる「カルティエ コレクション」の歴史的な作品を対象としてきましたが、本展は1970 年代以降の現代作品に光を当て、その創作活動における革新性、現代性、独自性を、メゾンが築き上げてきた創作の歴史を背景に表現する世界でも初めての試みです。\r\n\r\n本展のテーマは「時の結晶」。「時間」を軸に、「色と素材」「フォルムとデザイン」「ユニヴァーサルな好奇心」という3つの章で、カルティエのイノヴェーションに満ちたデザインの世界を探求します。壮大な時間を経て生成され奇跡的に見出された宝石と、世界各地の文化や自然物など万物から着想を得たデザインが、卓越した職人技術によって結実したカルティエの宝飾。それは世界の縮図であり、地球や文明との時空を超えた対話であるといえるでしょう。\r\n時間を自由に往来し、素材に秘められた可能性を探求することによって、色彩や線、フォルムなど、伝統を継承しつつも、常に宝飾界に新しい風を吹き込み続けるカルティエの想像力に満ちた美の秘密を紹介します。\r\n\r\nそして、会場構成を手がけるのは新素材研究所（杉本博司＋榊田倫之）。\r\n「旧素材こそ最も新しい」という理念のもと、伝統的な職人の技術と最新技術とを融合させ現代的なディテールで仕上げる彼らのデザインが、「時」を意識し回遊する展示空間を創出し、新たな鑑賞体験を提示します。',0,0,0,'/web/uploads/201906032008091488cartier.png',NULL,'/web/uploads/201906032008096634cartier.png',NULL,0,'2019-06-03 20:08:09',1,NULL,NULL);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_artists`
--

DROP TABLE IF EXISTS `event_artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_manager_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id_idxfk_1` (`event_id`),
  KEY `artist_id_idxfk` (`artist_id`),
  KEY `created_manager_id_idxfk_4` (`created_manager_id`),
  KEY `updated_manager_id_idxfk_4` (`updated_manager_id`),
  CONSTRAINT `event_artists_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `event_artists_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`),
  CONSTRAINT `event_artists_ibfk_3` FOREIGN KEY (`created_manager_id`) REFERENCES `manager` (`id`),
  CONSTRAINT `event_artists_ibfk_4` FOREIGN KEY (`updated_manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_artists`
--

LOCK TABLES `event_artists` WRITE;
/*!40000 ALTER TABLE `event_artists` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_categories`
--

DROP TABLE IF EXISTS `event_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_manager_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id_idxfk` (`event_id`),
  KEY `category_id_idxfk` (`category_id`),
  KEY `created_manager_id_idxfk_3` (`created_manager_id`),
  KEY `updated_manager_id_idxfk_3` (`updated_manager_id`),
  CONSTRAINT `event_categories_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  CONSTRAINT `event_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `event_categories_ibfk_3` FOREIGN KEY (`created_manager_id`) REFERENCES `manager` (`id`),
  CONSTRAINT `event_categories_ibfk_4` FOREIGN KEY (`updated_manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_categories`
--

LOCK TABLES `event_categories` WRITE;
/*!40000 ALTER TABLE `event_categories` DISABLE KEYS */;
INSERT INTO `event_categories` VALUES (1,1,1,1,'2018-08-01 13:06:43',1,'2018-08-02 10:16:13',1),(2,1,1,1,'2018-08-01 13:07:48',1,'2018-08-02 10:16:13',1),(3,1,1,0,'2018-08-02 19:16:13',1,NULL,NULL),(4,2,1,1,'2018-08-02 19:27:58',1,'2018-09-04 10:20:47',1),(5,2,1,1,'2018-08-02 19:28:35',1,'2018-09-04 10:20:47',1),(6,3,1,1,'2018-08-02 19:41:38',1,'2018-09-04 10:22:51',1),(7,4,1,1,'2018-08-02 19:49:17',1,'2018-09-04 10:24:07',1),(8,5,1,1,'2018-08-02 20:26:06',1,'2018-09-04 10:05:14',1),(9,6,1,1,'2018-08-02 20:34:59',1,'2018-09-21 11:56:22',1),(10,7,3,0,'2018-08-04 02:07:03',1,NULL,NULL),(11,8,2,1,'2018-08-04 02:24:24',1,'2018-09-04 10:18:10',1),(12,9,1,1,'2018-08-09 21:13:08',1,'2018-09-04 10:17:17',1),(13,9,2,1,'2018-08-09 21:13:08',1,'2018-09-04 10:17:17',1),(14,9,2,1,'2018-08-09 21:14:21',1,'2018-09-04 10:17:17',1),(15,10,2,0,'2018-08-09 21:25:27',1,NULL,NULL),(16,11,1,1,'2018-08-10 21:29:55',1,'2018-09-04 10:13:43',1),(17,12,1,0,'2018-08-10 22:13:50',1,NULL,NULL),(18,13,1,1,'2018-08-10 22:20:28',1,'2018-09-04 10:21:28',1),(19,5,1,1,'2018-09-04 18:59:14',1,'2018-09-04 10:05:14',1),(20,5,1,1,'2018-09-04 19:03:16',1,'2018-09-04 10:05:14',1),(21,5,1,0,'2018-09-04 19:05:14',1,NULL,NULL),(22,11,1,0,'2018-09-04 19:13:43',1,NULL,NULL),(23,9,2,0,'2018-09-04 19:17:17',1,NULL,NULL),(24,8,2,0,'2018-09-04 19:18:10',1,NULL,NULL),(25,2,1,0,'2018-09-04 19:20:47',1,NULL,NULL),(26,13,1,0,'2018-09-04 19:21:28',1,NULL,NULL),(27,3,1,0,'2018-09-04 19:22:51',1,NULL,NULL),(28,6,1,1,'2018-09-04 19:23:19',1,'2018-09-21 11:56:22',1),(29,4,1,0,'2018-09-04 19:24:07',1,NULL,NULL),(30,6,1,0,'2018-09-21 20:56:22',1,NULL,NULL),(31,14,3,0,'2018-09-21 21:02:23',1,NULL,NULL),(32,15,3,1,'2018-09-21 21:18:10',1,'2018-09-21 12:25:07',1),(33,15,3,1,'2018-09-21 21:19:14',1,'2018-09-21 12:25:07',1),(34,15,3,0,'2018-09-21 21:25:07',1,NULL,NULL),(35,16,3,1,'2018-09-21 21:26:59',1,'2018-10-26 23:53:10',1),(36,17,3,1,'2018-09-21 21:28:48',1,'2018-10-26 23:54:03',1),(37,18,3,1,'2018-09-21 21:30:20',1,'2018-10-26 23:54:26',1),(38,19,2,1,'2018-10-27 08:34:07',1,'2018-10-26 23:48:12',1),(39,20,2,0,'2018-10-27 08:38:01',1,NULL,NULL),(40,21,1,0,'2018-10-27 08:40:50',1,NULL,NULL),(41,19,2,0,'2018-10-27 08:48:12',1,NULL,NULL),(42,22,2,0,'2018-10-27 08:49:56',1,NULL,NULL),(43,16,3,0,'2018-10-27 08:53:10',1,NULL,NULL),(44,17,3,0,'2018-10-27 08:54:03',1,NULL,NULL),(45,18,3,0,'2018-10-27 08:54:26',1,NULL,NULL),(46,23,2,0,'2019-06-03 19:38:48',1,NULL,NULL),(47,23,3,0,'2019-06-03 19:38:48',1,NULL,NULL),(48,24,1,0,'2019-06-03 19:47:04',1,NULL,NULL),(49,25,1,0,'2019-06-03 19:58:50',1,NULL,NULL),(50,26,1,0,'2019-06-03 20:04:55',1,NULL,NULL),(51,27,1,0,'2019-06-03 20:08:09',1,NULL,NULL),(52,27,2,0,'2019-06-03 20:08:09',1,NULL,NULL);
/*!40000 ALTER TABLE `event_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite_events`
--

DROP TABLE IF EXISTS `favorite_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorite_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idxfk` (`user_id`),
  KEY `event_id_idxfk_2` (`event_id`),
  CONSTRAINT `favorite_events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `favorite_events_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite_events`
--

LOCK TABLES `favorite_events` WRITE;
/*!40000 ALTER TABLE `favorite_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorite_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_updated_at` datetime DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `authentication_failure_count` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (1,'kkkk','$2y$10$949a/1qaQkNIQKANGT7euOFJjeZuqTQlgLf6OVW2pbN9eeZplDHCC',NULL,'亀梨','匡','',1,0,NULL,'2018-08-01 08:39:22',NULL,NULL);
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zip_code1` int(3) DEFAULT NULL,
  `zip_code2` int(4) DEFAULT NULL,
  `prefecture` varchar(255) NOT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `address4` varchar(255) DEFAULT NULL,
  `access_information` text,
  `phone` varchar(255) DEFAULT NULL,
  `business_days` varchar(255) DEFAULT NULL,
  `closing_days` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `main_image_path` varchar(255) DEFAULT NULL,
  `main_image_info` json DEFAULT NULL,
  `sub_image_path` varchar(255) DEFAULT NULL,
  `sub_image_info` json DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_manager_id` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_manager_id_idxfk` (`created_manager_id`),
  KEY `updated_manager_id_idxfk` (`updated_manager_id`),
  CONSTRAINT `place_ibfk_1` FOREIGN KEY (`created_manager_id`) REFERENCES `manager` (`id`),
  CONSTRAINT `place_ibfk_2` FOREIGN KEY (`updated_manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
INSERT INTO `place` VALUES (2,'国立新美術館',106,8558,'東京都','港区','六本木','7-22-2','','[電車]\r\n・東京メトロ千代田線乃木坂駅\r\n　青山霊園方面改札6出口（美術館直結）\r\n・都営大江戸線六本木駅7出口から徒歩約4分\r\n・東京メトロ日比谷線六本木駅4a出口から 徒歩約5分\r\n\r\n[バス]\r\n・都営バス\r\n　六本木駅前下車徒歩約7分\r\n　青山斎場下車徒歩約5分\r\n・港区コミュニティバス「ちぃばす」赤坂\r\n　循環ルート六本木七丁目下車徒歩約4分\r\n　※運行系統、バス乗場については各事業者にお問い合わせください。\r\n\r\n','03-5777-8600','10:00-18:00（会によって観覧時間が異なる場合があります）','毎週火曜日（祝日又は振替休日に当たる場合は開館し、翌平日休館。ただし2018年5月1日（火）及び8月14日（火）は開館） 、年末年始','http://www.nact.jp/','/web/uploads/201808021915344184nact.jpg','{\"name\": \"nact.jpg\", \"size\": \"9125\", \"type\": \"image/jpeg\", \"error\": \"0\", \"tmp_name\": \"/tmp/phpNofzDD\"}',NULL,NULL,'',0,'2018-08-01 12:48:27',1,'2018-08-02 19:15:34',1),(3,'森美術館',106,6150,'東京都','港区','六本木','6-10-1','六本木ヒルズ森タワー53階','東京メトロ日比谷線\r\n　「六本木駅」1C出口　徒歩0分（コンコースにて直結）\r\n都営地下鉄大江戸線\r\n　「六本木駅」3出口　徒歩4分\r\n都営地下鉄大江戸線\r\n　「麻布十番駅」7出口　徒歩5分\r\n東京メトロ南北線\r\n　「麻布十番駅」4出口　徒歩8分\r\n東京メトロ千代田線\r\n　「乃木坂駅」5出口　徒歩10分\r\n','03-5777-8600','月・水～日10:00～22:00（最終入館 21:30）、火10:00～17:00（最終入館 16:30）','なし','https://www.mori.art.museum','/web/uploads/201808022018217909森美術館.png','{\"name\": \"森美術館.png\", \"size\": 813795, \"type\": \"image/png\", \"error\": 0, \"tmp_name\": \"/tmp/phpex5eHz\"}','/web/uploads/201808022018214087森美術館.png','{\"name\": \"森美術館.png\", \"size\": 813795, \"type\": \"image/png\", \"error\": 0, \"tmp_name\": \"/tmp/phpXnhUza\"}','',0,'2018-08-02 20:18:21',1,NULL,NULL),(4,'アドミュージアム東京',105,7090,'東京都','港区','東新橋','1-8-2','カレッタ汐留','JR新橋駅から徒歩5分、カレッタ汐留内','03-6218-2500','火-土曜 11:00-18:00','日・月曜日','http://www.admt.jp/','/web/uploads/201808040159239444アド・ミュージアム東京.jpg','{\"name\": \"アド・ミュージアム東京.jpg\", \"size\": 223351, \"type\": \"image/jpeg\", \"error\": 0, \"tmp_name\": \"/tmp/phpCcszXe\"}',NULL,NULL,'',0,'2018-08-04 01:59:23',1,NULL,NULL),(5,'日本科学未来館',135,64,'東京都','江東区','青海','2-3-6','','[電車]\r\n新交通ゆりかもめ　「船の科学館駅」下車、徒歩約5分／「テレコムセンター駅」下車、徒歩約4分\r\n東京臨海高速鉄道りんかい線　「東京テレポート駅」下車、徒歩約15分','03-3570-9151','月曜、水-日曜 10:00-17:00 ※入館券の購入は閉館30分前まで','火曜日(火曜日が祝日の場合は開館)、年末年始(12月28日～1月1日)','https://www.miraikan.jst.go.jp/','/web/uploads/201808040214366319日本科学未来館.jpg','{\"name\": \"日本科学未来館.jpg\", \"size\": 23899, \"type\": \"image/jpeg\", \"error\": 0, \"tmp_name\": \"/tmp/phpDMD5JC\"}',NULL,NULL,'',0,'2018-08-04 02:14:36',1,NULL,NULL),(6,'21_21 DESIGN SIGHT',107,6290,'東京都','港区','赤坂','9-7-6','東京ミッドタウン ミッドタウン・ガーデン内','都営大江戸線「六本木」駅、東京メトロ日比谷線「六本木」駅、\r\n千代田線「乃木坂」駅より徒歩5分','03-3475-2121','10:00 - 19:00（入館時間は18:30まで）','     火曜日、年末年始、展示替え期間','http://www.2121designsight.jp/','/web/uploads/20180809210353312221_21DESIGN-SIGHT.jpg','{\"name\": \"21_21DESIGN-SIGHT.jpg\", \"size\": 57764, \"type\": \"image/jpeg\", \"error\": 0, \"tmp_name\": \"/tmp/phpHUtiDE\"}',NULL,NULL,'',0,'2018-08-09 21:03:53',1,NULL,NULL),(7,'NTTインターコミュニケーション・センター [ICC]',163,1404,'東京都','新宿区','西新宿','3-20-2','東京オペラシティタワー4階','京王新線「初台駅」東口から徒歩2分\r\n(都営地下鉄新宿線乗り入れ，新宿から2分) ','0120-144199','午前11時─午後6時','月曜日（月曜が祝日の場合翌日）、年末年始、保守点検日（8月第一日曜日，2月第二日曜日）、展示替え期間','http://www.ntticc.or.jp/ja/','/web/uploads/201808102123502108NTTICC.jpg','{\"name\": \"NTTICC.jpg\", \"size\": 165106, \"type\": \"image/jpeg\", \"error\": 0, \"tmp_name\": \"/tmp/phpEMc84i\"}',NULL,NULL,'',0,'2018-08-10 21:23:50',1,NULL,NULL),(8,'The Mass',150,1,'東京都','渋谷区','神宮前','5-11-1','','','03-3406-0188','木曜日から月曜日まで','火、水曜日','http://themass.jp/','/web/uploads/201808102206371814themass.jpg','{\"name\": \"themass.jpg\", \"size\": 266129, \"type\": \"image/jpeg\", \"error\": 0, \"tmp_name\": \"/tmp/phpdC7qjJ\"}',NULL,NULL,'',0,'2018-08-10 22:06:37',1,NULL,NULL),(9,'クリエイションギャラリー G8',104,8001,'東京都','中央区','銀座','8-4-17','GINZA8ビル1F','JR・東京メトロ新橋駅より 徒歩 3 分\r\n    JR 新橋駅銀座口、東京メトロ銀座線新橋駅 5 番口を出て、外堀通りを有楽町方面へ向かい、高速道路の高架をくぐった先、土橋の交差点右側にあるガラス張りのリクルートGINZA8ビル1Fです。 ','03-6835-2260','月-土曜日 11:00 a.m.-7:00 p.m.','日曜・祝日休館 ※展覧会によって開館時間や休館日が 変更になる場合があります。','http://rcc.recruit.co.jp/g8/','/web/uploads/201810270814593760 g8.png','{\"name\": \" g8.png\", \"size\": 364472, \"type\": \"image/png\", \"error\": 0, \"tmp_name\": \"/tmp/phpYMpIKp\"}',NULL,NULL,'',0,'2018-10-27 08:14:59',1,NULL,NULL),(10,'ガーディアン・ガーデン',104,8227,'東京都','中央区','銀座','7-3-5','ヒューリック銀座7丁目ビルB1F','\r\n東京メトロ銀座駅より 徒歩 5 分\r\n    銀座駅 C2 出口を出て、数寄屋橋交差点から外堀通りを新橋方面へ向かい、右手に見える洋菓子舗「ウエスト」の手前の階段を降りてくだ さい。\r\nJR・東京メトロ新橋駅より 徒歩 5 分\r\n    JR 新橋駅銀座口、東京メトロ銀座線新橋駅 5 番口を出て、外堀通りを有楽町方面へ向かい、左手に見える洋菓子舗「ウエスト」のとなりの階段を降りてくだ さい。 ','03-5568-8818','月-土曜 11:00 a.m.-7:00 p.m.','日曜・祝日 ※展覧会によって開館時間や休館日が 変更になる場合があります。','http://rcc.recruit.co.jp/gg/','/web/uploads/201810270824499389 gg.png','{\"name\": \" gg.png\", \"size\": 547974, \"type\": \"image/png\", \"error\": 0, \"tmp_name\": \"/tmp/phpmNFgdi\"}',NULL,NULL,'',0,'2018-10-27 08:24:49',1,NULL,NULL),(11,'ギンザ・グラフィック・ギャラリー',104,61,'東京都','中央区','銀座','7-7-2','DNP銀座ビル1F','■ 地下鉄／銀座線、日比谷線、丸ノ内線「銀座」駅から　徒歩5分\r\n■ JR／「有楽町」「新橋」駅から徒歩10分 ','03-3571-5206','月-土曜 11:00am-7:00pm','日曜・祝日','http://www.dnp.co.jp/gallery/ggg/','/web/uploads/201810270846075787 ggg.png','{\"name\": \" ggg.png\", \"size\": 637953, \"type\": \"image/png\", \"error\": 0, \"tmp_name\": \"/tmp/php4lTz0M\"}',NULL,NULL,'',0,'2018-10-27 08:46:07',1,NULL,NULL);
/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `enter_at` datetime DEFAULT NULL,
  `leave_at` datetime DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_manager_id` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_manager_id_idxfk_6` (`created_manager_id`),
  KEY `updated_manager_id_idxfk_6` (`updated_manager_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`created_manager_id`) REFERENCES `manager` (`id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`updated_manager_id`) REFERENCES `manager` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-05 21:12:20
