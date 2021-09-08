-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 07 sep. 2021 à 05:58
-- Version du serveur :  10.3.29-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `easydata_iea`
--

-- --------------------------------------------------------

--
-- Structure de la table `badwords`
--

CREATE TABLE `badwords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `badwords`
--

INSERT INTO `badwords` (`id`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '<p>@</p>', '2019-01-11 18:27:50', '2019-01-11 18:27:50', NULL),
(2, '<p>gmail.com</p>', '2019-01-11 18:28:29', '2019-01-11 18:28:29', NULL),
(3, '<p>hotmail.com</p>', '2019-01-11 18:29:30', '2019-01-11 18:29:30', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_count` bigint(20) NOT NULL DEFAULT 0,
  `view_order` bigint(20) DEFAULT 0,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pinged',
  `starred` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'blog',
  `image_id` bigint(20) NOT NULL DEFAULT 0,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blogs`
--

INSERT INTO `blogs` (`id`, `slug`, `title`, `content`, `meta_tag`, `meta_description`, `view_count`, `view_order`, `status`, `starred`, `post_type`, `image_id`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'construire-pour-revendre-ce-qu-il-faut-savoir', 'Construire Pour Revendre : Ce Qu’il Faut Savoir', '<p>L&rsquo;immobilier est et sera toujours une valeur s&ucirc;re. Surtout que depuis peu, les cr&eacute;dits immobiliers sont plus accessibles pour tous les m&eacute;nages. Mais pour rentabiliser au maximum son placement, il reste encore &agrave; bien choisir ses investissements. Entre les SCPI, les achats cl&eacute;s en main et l&rsquo;alternative de faire construire son bien : on n&rsquo;a aujourd&rsquo;hui que l&rsquo;embarras du choix. Et il semble que la derni&egrave;re option soit plus avantageuse que les autres. En outre, les possibilit&eacute;s de rentabilisations sont encore plus nombreuses. Les propri&eacute;taires peuvent faire une location, proposer des baux commerciaux, ou simplement revendre leur bien. Depuis quelques ann&eacute;es, le dispositif fiscal en mati&egrave;re d&rsquo;investissement immobilier ne cesse d&rsquo;augmenter. On peut voir que trouver un logement d&eacute;cent sans payer le prix fort est assez difficile. De plus en plus de m&eacute;nages optent d&eacute;sormais pour la construction dans le but d&rsquo;une revente, pour le bonheur des entrepreneurs. Le point. Les frais de construction d&rsquo;une maison reviennent moins chers que d&rsquo;acheter une maison cl&eacute; en main. Certes, acqu&eacute;rir une maison peut &ecirc;tre plus rapide, mais la premi&egrave;re option rev&ecirc;t des avantages plus int&eacute;ressants. Le prix moyen pour un terrain constructible est de 140&euro; le m2, alors que le prix moyen pour une maison est de 1 850&euro; le m2 et 3 300&euro; pour un appartement. Tout d&eacute;pend des r&eacute;gions dans lesquels vous investissez. Dans les villes comme Paris, Nantes, Bordeaux, Lyon et toute la c&ocirc;te m&eacute;diterran&eacute;enne entre Monaco et Montpellier le prix moyen est de 3 700&euro; le m2 pour une maison alors que pour le reste de la France, il sera de 1 800&euro; le m2.</p>', NULL, NULL, 444, 10, 'published', 0, 'blog', 8, 1, '2018-06-28 13:57:38', '2021-09-06 22:09:52', NULL),
(2, 'zoom-sur-le-m-tier-de-promoteur-immobilier', 'Zoom Sur Le Métier De Promoteur Immobilier', '<p>L’immobilier est un secteur très vaste et pris en charge par de nombreuses personnes qui présentent des fonctions différentes à des responsabilités toutes aussi différentes. Avec une influence grandissante sur l’économie à l’échelle mondiale, l’immobilier est un des grands piliers de la mise en marche d’une économie très importante. Bien que de nombreuses personnes travaillent dans l’immobilier, et cela aussi bien en tant que professionnel que particulier, il est nécessaire d’avoir des compétences bien définies. Un des métiers les plus courants dans le domaine est le métier de « promoteur immobilier ». Mais que peut bien faire un promoteur immobilier ? Un promoteur immobilier est celui qui vend des espaces construits ou à construire. Auparavant, on le connaissait comme étant un monteur d’affaire immobilière. En effet des dizaines d’années plus tôt, avec une intense construction de logements, les spéculations immobilières forgèrent petit à petit le personnage du promoteur immobilier jusqu’à lui attribué une fonction officielle. Et dans son acception, le promoteur immobilier est celui qui est à la charge du processus de l’offre sur le marché. C’est-à-dire qu’il prend en compte les demandes, les aspects réglementaires, le foncier et les moyens de financement dans un projet immobilier tout en prenant compte les risques.</p>', NULL, NULL, 180, 11, 'published', 0, 'blog', 9, 1, '2018-06-28 13:57:38', '2021-09-06 22:09:52', NULL),
(3, 'tout-savoir-sur-l-assurance-pour-un-pr-t-immobilier', 'Tout Savoir Sur L’assurance Pour Un Prêt Immobilier', '<p>Lorsque vous prenez un cr&eacute;dit immobilier, votre banquier vous parlera surement de l&rsquo;assurance pr&ecirc;t immobilier. Votre banquier peut vous le r&eacute;clamer pour un pr&ecirc;t &agrave; taux z&eacute;ro, pour un pr&ecirc;t relais ou pour tout autre type de pr&ecirc;t immobilier. Vous pouvez entendre et lire que cette assurance est obligatoire, ce qui n&rsquo;est pas le cas. Nous allons vous apporter dans ce dossier plusieurs informations par rapport &agrave; ce sujet et vous pr&eacute;senter si elle est vraiment indispensable pour votre pr&ecirc;t. Lorsqu&rsquo;on contracte un cr&eacute;dit immobilier et qu&rsquo;on &eacute;voque l&rsquo;assurance pr&ecirc;t immobilier ou l&rsquo;assurance emprunteur correspondante, on se demande si elle est obligatoire. Nous tenons &agrave; souligner que contrairement &agrave; l&rsquo;assurance auto ou l&rsquo;assurance habitation, elle n&rsquo;est pas l&eacute;galement obligatoire, mais certains &eacute;tablissements bancaires et &eacute;tablissements financiers peuvent vous l&rsquo;exiger. Depuis 2010 avec l&rsquo;entr&eacute;e en vigueur de la loi Lagarde, vous n&rsquo;&ecirc;tes pas oblig&eacute; de prendre l&rsquo;offre d&rsquo;assurance propos&eacute;e par votre pr&ecirc;teur, ce qui vous offre un libre choix de l&rsquo;assurance-cr&eacute;dit qui vous convient, et ce, aupr&egrave;s d&rsquo;un autre &eacute;tablissement. Dans certains cas, notamment ceux qui ont un patrimoine important, il est possible de contourner cette obligation de l&rsquo;assurance pr&ecirc;t immobilier en mettant en garantie vos biens A quoi sert-elle ? Si certains &eacute;tablissements bancaires ou institutions financi&egrave;res exigent l&rsquo;assurance cr&eacute;dit immobilier, c&rsquo;est pour se prot&eacute;ger de toute d&eacute;faillance de remboursement de son client. Il faut noter que cette assurance ne prot&egrave;ge pas que l&rsquo;organisme pr&ecirc;teur, car il couvre &eacute;galement le souscripteur de cr&eacute;dit.</p>', NULL, NULL, 53, 12, 'published', 0, 'blog', 10, 1, '2018-06-28 13:57:38', '2021-09-06 22:09:52', NULL),
(4, 'nos-conseils-pour-mettre-en-valeur-sa-maison-pour-mieux-la-vendre', 'Nos Conseils Pour Mettre En Valeur Sa Maison Pour Mieux La Vendre', '<p>Vendre une maison n&rsquo;est pas une mince &agrave; faire, surtout si vous ne souhaitez pas avoir recours aux services d&rsquo;une agence immobili&egrave;re. Il faut assurer le respect de certaines normes de construction. Les inspecteurs sont particuli&egrave;rement exigeants quant &agrave; la performance des immeubles de nos jours. N&eacute;anmoins, pour les particuliers en qu&ecirc;te d&rsquo;un nouvel investissement, l&rsquo;am&eacute;nagement est le meilleur moyen de les convaincre. Les visites sont une partie importante de la transaction. Pour vous, qui pour une raison ou une autre, doit trouver un acheteur rapidement pour votre r&eacute;sidence, voici quelques conseils pour mettre en valeur la maison afin de mieux la vendre : rapidement et &agrave; bon prix. Une maison, par d&eacute;finition, doit &ecirc;tre confort et pratique. On dit souvent que votre d&eacute;coration doit &ecirc;tre &agrave; l&rsquo;image de votre personnalit&eacute;. D&rsquo;ailleurs, sur internet, vous avez plusieurs astuces pour ce faire. Diff&eacute;rents styles sont disponibles, allant du vintage au plus moderne. N&eacute;anmoins, pour une vente, opter pour un am&eacute;nagement neutre est de mise.</p>', NULL, NULL, 1000056, 13, 'published', 0, 'blog', 8, 1, '2018-06-28 13:57:38', '2021-09-06 22:09:52', NULL),
(5, 'quel-est-le-premier-investissement-immobilier-id-al-pour-un-jeune-couple-', 'Quel Est Le Premier Investissement Immobilier Idéal Pour Un Jeune Couple ?', '<p>Que ce soit pour y vivre, ou pour en faire un compl&eacute;ment de revenu, investir dans l&rsquo;immobilier reste une valeur s&ucirc;re. Pour un jeune couple, le premier investissement immobilier id&eacute;al est, incontestablement, l&rsquo;achat de la r&eacute;sidence principale. L&rsquo;acquisition de la premi&egrave;re r&eacute;sidence apportera au couple un sentiment de s&eacute;curit&eacute; et leur est b&eacute;n&eacute;fique sur le plan financier. En effet, la diff&eacute;rence de prix entre la location et l&rsquo;achat immobilier est minime, surtout avec les taux de cr&eacute;dit favorisant les primo-acc&eacute;dants. De plus, opter pour un investissement immobilier c&rsquo;est aussi se construire un patrimoine pour la g&eacute;n&eacute;ration future. N&eacute;anmoins, cet investissement est loin d&rsquo;&ecirc;tre sans risques. Sans pr&eacute;paration, l&rsquo;achat de votre premier appartement peut vite tourner au cauchemar et m&ecirc;me g&acirc;cher vos projets d&rsquo;avenir. Pour vous aider, voici quelques astuces pour effectuer votre premier investissement. Premier investissement immobilier : &ecirc;tre primo-acc&eacute;dant Le terme &laquo; primo-acc&eacute;dant &raquo; est un terme utilis&eacute; dans le domaine de l&rsquo;immobilier pour d&eacute;signer un particulier se lan&ccedil;ant dans son premier achat immobilier. En g&eacute;n&eacute;ral, un primo-acc&eacute;dant n&rsquo;est pas encore propri&eacute;taire d&rsquo;un bien immobilier. Ce sont, en g&eacute;n&eacute;ral, des jeunes couples dont la plupart sont dans une classe d&rsquo;&acirc;ge de 25 &agrave; 34 ans. Plus de 80% des primo-acc&eacute;dants sont des couples &agrave; la recherche de leur premier foyer dont les 58% ont au moins un enfant. Les plus pris&eacute;s par ces jeunes parents sont les maisons de ville ou les pavillons. Plus pr&eacute;cis&eacute;ment, le terme &laquo; primo-acc&eacute;dant &raquo; ne s&rsquo;applique pas forcement &agrave; une personne encore nouvelle dans le monde de l&rsquo;investissement immobilier. En effet, celui-ci peut &ecirc;tre un ancien propri&eacute;taire mais pour une raison ou une autre ne l&rsquo;est plus depuis plus de deux ans avant son prochain achat. Enfin, une personne poss&eacute;dant plusieurs biens immobiliers peut tr&egrave;s bien &ecirc;tre juridiquement un primo-acc&eacute;dant si elle n&rsquo;est pas propri&eacute;taire de sa r&eacute;sidence principale.</p>', NULL, NULL, 97, 14, 'published', 0, 'blog', 9, 1, '2018-06-28 13:57:38', '2021-09-06 22:09:52', NULL),
(12, 'investir-en-australie-investissement-immobilier-residentiel-etranger', 'INVESTIR EN AUSTRALIE : INVESTISSEMENT IMMOBILIER RESIDENTIEL ETRANGER', '<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">La position qui sous-tend la politique du gouvernement australien en mati&egrave;re d&#39;achat par des personnes physiques ou morales &eacute;trang&egrave;res non-r&eacute;sidentes d&#39;immobilier r&eacute;sidentiel est que ces achats doivent b&eacute;n&eacute;ficier &agrave; la communaut&eacute; et &agrave; l&#39;&eacute;conomie nationales en termes d&#39;accroissement de la quantit&eacute; de logements disponibles. Pour s&#39;assurer qu&#39;elles satisfont &agrave; cette condition, ces acquisitions doivent recevoir l&#39;agr&eacute;ment pr&eacute;alable de l&#39;organisme charg&eacute; du contr&ocirc;le des investissements &eacute;trangers, le <strong>Foreign Investment Review Board</strong> (<strong>FIRB</strong>).</span></span></span></p>\r\n\r\n<h1><br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Cette position a plusieurs cons&eacute;quences:</strong></span></span></span></h1>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Sont concern&eacute;es toutes les personnes &eacute;trang&egrave;res physiques ou morales non-r&eacute;sidentes qui souhaitent <strong>investir en Australie</strong>. A contrario, ne sont pas soumises &agrave; cet agr&eacute;ment pr&eacute;alable les personnes physiques &eacute;trang&egrave;res b&eacute;n&eacute;ficiant d&#39;une cat&eacute;gorie de visa de r&eacute;sidence permanente, ou les filiales d&#39;entreprises &eacute;trang&egrave;res ayant leur si&egrave;ge social en Australie.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>\r\n	<h2><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Le principe est que seul est autoris&eacute; l&#39;achat de r&eacute;sidentiel neuf</strong></span></span></span></h2>\r\n	</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">qu&#39;il s&#39;agisse de &quot;vente sur plan&quot;, ou que le bien achet&eacute; n&#39;ait jamais &eacute;t&eacute; occup&eacute; ni vendu.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>\r\n	<h2><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>L&#39;agr&eacute;ment pr&eacute;alable du FIRB doit &ecirc;tre demand&eacute;</strong></span></span></span></h2>\r\n	</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">La d&eacute;cision de cet organisme doit &ecirc;tre rendue dans un d&eacute;lai de 30 jours. Sans r&eacute;ponse du FIRB dans ce d&eacute;lai, l&#39;agr&eacute;ment est r&eacute;put&eacute; donn&eacute;. En cas d&#39;agr&eacute;ment formel ou induit, la proc&eacute;dure d&#39;achat peut &ecirc;tre entam&eacute;e.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">L&#39;agr&eacute;ment est en principe donn&eacute; sans difficult&eacute;s particuli&egrave;res &agrave; des &eacute;trangers qui b&eacute;n&eacute;ficient d&#39;un visa de r&eacute;sidence sup&eacute;rieur &agrave; un an. C&#39;est ainsi le cas pour des &eacute;tudiants suivant une formation dans des institutions d&#39;enseignement sup&eacute;rieur reconnues, dans la limite de A$300,000. C&#39;est aussi le cas pour les retrait&eacute;s et les travailleurs autoris&eacute;s &agrave; r&eacute;sider en Australie pour une longue dur&eacute;e. C&#39;est encore le cas pour les entreprises &eacute;trang&egrave;res op&eacute;rant en Australie lorsqu&#39;il s&#39;agit pour elles d&#39;acqu&eacute;rir des logements de fonction pour leurs hauts dirigeants expatri&eacute;s.<br />\r\n<br />\r\nMais, dans tous les cas ci-dessus o&ugrave; l&#39;agr&eacute;ment est en principe accord&eacute;, le bien immobilier en question doit &ecirc;tre revendu &agrave; partir du moment o&ugrave; leur b&eacute;n&eacute;ficiaire ne vit plus en Australie.<br />\r\n<br />\r\nLes &eacute;trangers titulaires d&#39;un <strong>visa de r&eacute;sidence permanente</strong> sont trait&eacute;s comme les citoyens australiens et ne sont donc pas concern&eacute;s par les mesures de restriction et de contr&ocirc;le ci-dessus.</span></span></span></p>\r\n\r\n<h1><br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Cette position officielle du gouvernement re&ccedil;oit cependant certains assouplissements:</strong></span></span></span></h1>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>\r\n	<h2><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Achat par l&#39;interm&eacute;diaire de promoteurs immobiliers</strong></span></span></span></h2>\r\n	</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">L&#39;achat par des &eacute;trangers non-r&eacute;sidents d&#39;appartements ou de &quot;townhouses&quot; (duplex dans un corps de b&acirc;timent au sein d&#39;un ensemble r&eacute;sidentiel) dans un programme r&eacute;sidentiel en projet, ou en cours de construction mais non encore vendu &agrave; un premier propri&eacute;taire, est facilit&eacute;. En effet, le promoteur peut obtenir du FIRB un agr&eacute;ment pour l&#39;ensemble du programme.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">La vente sur plan peut alors intervenir sans besoin de demander un agr&eacute;ment sp&eacute;cifique pour chaque unit&eacute;. C&#39;est la raison pour laquelle il est plus ais&eacute; pour un &eacute;tranger non-r&eacute;sident d&#39;acheter sur plan dans un ensemble immobilier pr&eacute;alablement agr&eacute;&eacute; que d&#39;acheter un logement neuf isol&eacute;.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">En principe l&#39;agr&eacute;ment ne concerne que la moiti&eacute; des unit&eacute;s &agrave; vendre, l&#39;autre moiti&eacute; ne pouvant &ecirc;tre vendue qu&#39;&agrave; des nationaux australiens ou &agrave; des &eacute;trangers r&eacute;sidents permanents. Cependant il est assez fr&eacute;quent que le promoteur obtienne l&#39;agr&eacute;ment pour la totalit&eacute; du programme. Par ailleurs un m&ecirc;me acqu&eacute;reur ne peut acheter pour plus de 3 millions de dollars australiens dans un m&ecirc;me programme immobilier, sauf autorisation sp&eacute;cifique du FIRB.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>\r\n	<h2><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Achat dans un &quot;<em>Integrated Tourism Resort</em>&quot; (ITR)</strong></span></span></span></h2>\r\n	</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Lorsque le Ministre australien du Tr&eacute;sor accorde &agrave; un projet la qualit&eacute; d&#39;&eacute;tablissement touristique int&eacute;gr&eacute; (&quot;Integrated Tourism Resort&quot;), les terrains et les r&eacute;sidences au sein de ce projet peuvent &ecirc;tre librement achet&eacute;s, m&ecirc;me en seconde main, par des &eacute;trangers non-r&eacute;sidents. Le projet doit couvrir au moins 50 hectares et offrir des am&eacute;nagements r&eacute;cr&eacute;ationnels d&#39;envergure.<br />\r\n<br />\r\nCes enclaves ITR sont au nombre de trois, toutes situ&eacute;es dans la zone d&eacute;pendant de l&#39;administration de la Ville de Gold Coast: Sanctuary Cove et Hope Island Touristic Resort dans la partie Nord de Gold Coast, et Royal Pines Resort &agrave; Benowa, au c&oelig;ur de Gold Coast.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<h1><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Tarifs des demandes d&#39;agr&eacute;ment du FIRB</strong></span></span></span></h1>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Lorsqu&#39;un &eacute;tranger non-r&eacute;sident investit dans un bien r&eacute;sidentiel qui n&#39;a pas re&ccedil;u d&#39;agr&eacute;ment pr&eacute;alable, l&#39;acheteur doit, par l&#39;interm&eacute;diaire de son solicitor, demander l&#39;agr&eacute;ment de son projet d&#39;investissement par le FIRB, en sus des taxes d&#39;enregistrement - &quot;<em>stamp duty</em>&quot; et &quot;<em>additional foreign buyers duty (</em>&quot;</span><strong><a href=\"https://investirenaustralie.com/fr/details_blog/2019/investir-en-australie-les-couts-d-acquisition-immobiliere\"><span style=\"color:#000000\">https://investirenaustralie.com/fr/details_blog/2019/investir-en-australie-les-couts-d-acquisition-immobiliere</span></a></strong><span style=\"color:#000000\">).</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Cette demande d&#39;agr&eacute;ment a un co&ucirc;t.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Le montant de ce droit est fix&eacute; en fonction du montant de l&#39;investissement jusqu&#39;&agrave; $40,000,000. Au-dessus de cette somme le montant du droit &agrave; payrer est plafonn&eacute;. La grille est r&eacute;vis&eacute;e le 1er juillet de chaque ann&eacute;e. Les chiffres suivants sont &agrave; jour &agrave; la date du 19 mai 2021 (&agrave; partir de $1,000,000 le tarif est incr&eacute;ment&eacute; de $12,700, et le plafond est fix&eacute; &agrave; $500 000) :</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<table align=\"center\" style=\"height:844px; width:771px\" summary=\"Montant des droits à payer au FIRB\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"background-color:#ffffcc\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Montant des droits &agrave; payer au FIRB</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>MONTANT DE L&#39;INVESTISSEMENT</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>MONTANT DES DROITS PAYABLES AU FIRB</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Moins de $75,000</span></span></strong></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000; text-align:center\"><strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">$2,000</span></span></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$75,000 - $1,000,000</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$6,350</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$2,000,000 ou moins</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$12,700</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$3,000,000 ou moins</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$25,400</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$4,000,000 ou moins</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$38,100</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$5,000,000 ou moins</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$50,800</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$6,000,000 ou moins</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$63,500</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$7,000,000 ou moins</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$76,200</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$8,000,000 ou moins</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$88,900</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$9,000,000 ou moins</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$101,600</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$10,000,000 ou moins</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>$114,300</strong></span></span></span></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Par tranche de $1,000,000</strong></span></span></span></p>\r\n			</td>\r\n			<td style=\"background-color:#ffffcc; border-color:#990000\">\r\n			<p style=\"text-align:center\"><strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Tarif incr&eacute;ment&eacute; de $12,700</span></span></strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"text-align:justify\"><br />\r\n<span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Le montant du droit de la demande d&#39;agr&eacute;ment FIRB doit &ecirc;tre pay&eacute; au moment du d&eacute;p&ocirc;t de la demande. La demande ne peut &ecirc;tre examin&eacute;e que lorsque le dossier est complet et que l&#39;int&eacute;gralit&eacute; du montant du droit a &eacute;t&eacute; pay&eacute;.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Lorsque ces conditions sont r&eacute;unies, le FIRB dispose d&#39;un d&eacute;lai de 30 jours pour donner sa r&eacute;ponse. Si celle-ci n&#39;a pas &eacute;t&eacute; &eacute;mise dans le d&eacute;lai de 30 jours, l&#39;agr&eacute;ment est r&eacute;put&eacute; accord&eacute;.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">A titre d&#39;information, les investissements en locaux commerciaux inf&eacute;rieurs &agrave; 5 millions de dollars australiens ne sont pas soumis &agrave; autorisation. Seuls les investissements en locaux commerciaux sup&eacute;rieurs &agrave; ce montant sont soumis &agrave; agr&eacute;ment pr&eacute;alable</span><span style=\"display:none\">&nbsp;</span></span>.</span><span style=\"display:none\">&nbsp;</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Le montant du droit de la demande FIRB n&#39;est en principe pas remboursable quelle que soit le sort qui lui sera r&eacute;serv&eacute;.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">*&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Pour nous contacter:</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">&quot;<strong>Investir En Australie</strong>&quot; - <strong>Tel: +61 415 940 412</strong></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>&nbsp;</strong><strong>Mel : admin@investirenaustralie.com</strong></span></span></span></p>', 'Investir en Australie,\r\nForeign Investment Review Board,\r\nFIRB,\r\nVisa de résidence permanente', 'La position qui sous-tend la politique du gouvernement australien en matière d\'achat par des personnes physiques ou morales étrangères non-résidentes d\'immobilier résidentiel est que ces acha', 34, 1, 'published', 0, 'blog', 151, 0, '2021-05-13 00:20:02', '2021-09-06 22:32:44', NULL);
INSERT INTO `blogs` (`id`, `slug`, `title`, `content`, `meta_tag`, `meta_description`, `view_count`, `view_order`, `status`, `starred`, `post_type`, `image_id`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'investir-en-australie-les-couts-d-acquisition-immobiliere', 'INVESTIR EN AUSTRALIE : LES COUTS D\'ACQUISITION IMMOBILIERE', '<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:18px\"><span style=\"color:#000000\">En mati&egrave;re d&#39;immobilier r&eacute;sidentiel, les &eacute;trangers non-r&eacute;sidents qui souhaitent <strong>investir en Australie</strong> ne peuvent y acheter que du neuf, c&#39;est-&agrave;-dire des logements n&#39;ayant jamais &eacute;t&eacute; habit&eacute;s. Aussi, dans la tr&egrave;s grande majorit&eacute; des cas, ces logements sont achet&eacute;s directement au constructeur ou au promoteur.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:18px\"><span style=\"color:#000000\">Cela entra&icirc;ne que, lors de la signature du contrat d&#39;achat, le bien peut &ecirc;tre:</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:18px\"><span style=\"color:#000000\">- soit d&eacute;j&agrave; construit et livrable imm&eacute;diatement, sous r&eacute;serve des d&eacute;lais de proc&eacute;dure de transfert de propri&eacute;t&eacute;;</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:18px\"><span style=\"color:#000000\">- soit en cours de construction et livrable dans le d&eacute;lai d&#39;ach&egrave;vement;</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:18px\"><span style=\"color:#000000\">- soit vendu sur plan, et livrable dans un d&eacute;lai indiqu&eacute; par le vendeur - constructeur ou promoteur, qui comprend un temps suffisant de commercialisation et le d&eacute;lai de construction.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:18px\"><span style=\"color:#000000\">Pour les informations sur le d&eacute;roulement de la proc&eacute;dure d&#39;achat, vous r&eacute;f&eacute;rer &agrave; notre article</span></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#000099\"><strong><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:18px\">INVESTIR EN AUSTRALIE : LES PROCEDURES D&#39;ACQUISITION IMMOBILIERE</span></span></strong></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<h1 style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">LES FRAIS DU CONTRAT</span></span></h1>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<h2 style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">La r&eacute;servation du bien</span></span></h2>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">La proc&eacute;dure de vente commence g&eacute;n&eacute;ralement par une EOI, &quot;<em>Expression Of Interest</em>&quot; (&quot;Manifestation d&#39;Int&eacute;r&ecirc;t&quot;) qui s&#39;accompagne du versement d&#39;une certaine somme, en g&eacute;n&eacute;ral &eacute;gale ou voisine de 1% du prix de vente, s&#39;apparentant &agrave; un d&eacute;p&ocirc;t de r&eacute;servation.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Cette EOI n&#39;a aucune valeur contraignante pour l&#39;acheteur potentiel qui peut &agrave; tout moment se d&eacute;dire et recevoir le remboursement int&eacute;gral de la somme vers&eacute;e. C&#39;est la raison pour laquelle les EOI ont toujours une dur&eacute;e de validit&eacute; contractuellement limit&eacute;e (en g&eacute;n&eacute;ral 7 jours).</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<h2 style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">La signature du contrat de vente</span></span></h2>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Au Queensland, &agrave; partir de la signature du contrat l&#39;acheteur dispose d&#39;un d&eacute;lai de r&eacute;tractation (&quot;cooling-off period&quot;) de 5 jours. L&#39;exercice de cette option de r&eacute;tractation dans le d&eacute;lai de 5 jours est sanctionn&eacute; par une p&eacute;nalit&eacute; de 0.25% du prix de vente. Les modalit&eacute;s de l&#39;exercice de la r&eacute;tractation sont variables selon les Etats.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Le contrat de vente pr&eacute;voit en g&eacute;n&eacute;ral un d&eacute;lai pour r&eacute;pondre &agrave; des conditions suspensives ou r&eacute;solutoires conditionnant la vente. A la lev&eacute;e de ces clauses un paiement est d&ucirc;, dont le montant est subordonn&eacute; &agrave; l&#39;&eacute;tat d&#39;avancement de la construction:</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- Si, &agrave; la signature du contrat, le bien n&#39;est pas en &eacute;tat d&#39;&ecirc;tre livr&eacute; (achat sur plan ou en cours de construction) le montant &agrave; payer est une somme qui, cumul&eacute;e avec le d&eacute;p&ocirc;t de r&eacute;servation initial, ne doit pas d&eacute;passer 10% du prix de vente. Il faut cependant ajouter &agrave; ce montant initial le paiement de droits d&#39;enregistrement (voir ci-dessous &quot;Les frais annexes d&#39;acquisition immobili&egrave;re&quot; - &quot;Les taxes&quot;). Ceux-ci s&#39;&eacute;l&egrave;vent au Queensland &agrave; environ 9,5% &agrave; 10,5% du prix d&#39;achat du bien (pr&eacute;voir 10%).</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Le solde du prix de vente (90% du prix de vente) devra &ecirc;tre pay&eacute; au &quot;<em>settlement</em>&quot;, c&#39;est-&agrave;-dire &agrave; l&#39;enregistrement du bien et &agrave; la remise des cl&eacute;s et des titres de propri&eacute;t&eacute;.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- Si, &agrave; la signature du contrat, le bien est achev&eacute; et en &eacute;tat d&#39;&ecirc;tre livr&eacute;, l&#39;&eacute;tape du paiement des 10% se confond dans la pratique avec celle du paiement du solde du prix total du bien lors de l&#39;enregistrement du bien et la remise des cl&eacute;s et documents de propri&eacute;t&eacute;. Le montant du d&eacute;bours est alors de 110% du prix d&#39;achat du bien, y compris les frais d&#39;enregistrement.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<h1><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">LES FRAIS ANNEXES D&#39;ACQUISITION IMMOBILIERE</span></span></h1>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<h2 style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Les taxes</span></span></h2>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">L&#39;Australie est un Etat f&eacute;d&eacute;ral, officiellement appel&eacute; &quot;<em>Commonwealth of Australia</em>&quot;, compos&eacute; de 8 entit&eacute;s f&eacute;d&eacute;r&eacute;es, dont 6 &quot;<em>Etats</em>&quot; (New South Wales, Queensland, South Australia, Tasmania, Victoria et Western Australia)&nbsp; et 2 &quot;<em>Territoires</em>&quot; (Australian Capital Territory et Northern Territory). Le r&eacute;gime f&eacute;d&eacute;ral australien accorde des comp&eacute;tences tr&egrave;s &eacute;tendues aux entit&eacute;s f&eacute;d&eacute;r&eacute;s, mais ces comp&eacute;tences d&eacute;centralis&eacute;es ne sont pas tout &agrave; fait les m&ecirc;mes entre les 2 cat&eacute;gories Etats et Territoires.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Chaque entit&eacute; f&eacute;d&eacute;r&eacute;e est comp&eacute;tente en mati&egrave;re immobili&egrave;re et d&eacute;termine le montant des taxes pr&eacute;lev&eacute;es &agrave; l&#39;occasion des transactions. Ces taxes sont payables &agrave; la signature du contrat. Nous donnons ci-apr&egrave;s les montants en pourcentage du prix de vente des taxes per&ccedil;ues dans l&#39;Etat du Queensland, o&ugrave; elles atteignent un total d&#39;environ 10%:</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- &quot;<em>Stamp Duty</em>&quot;: c&#39;est la taxe ordinaire d&#39;enregistrement, payable par tous. Elle est d&#39;environ 2,5% &agrave; 3,5% du prix d&#39;achat.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- &quot;<em>Additional Foreign Buyers Duty</em>&quot;. Il s&#39;agit d&#39;une taxe suppl&eacute;mentaire qui concerne uniquement les &eacute;trangers non-r&eacute;sidents. L&#39;AFBD, qui &eacute;tait auparavant de 3%, est pass&eacute;e &agrave; 7% au 1er juillet 2018.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- En g&eacute;n&eacute;ral les programmes immobiliers r&eacute;sidentiels pr&eacute;sent&eacute;s par des promoteurs ont d&eacute;j&agrave; re&ccedil;u une pr&eacute;-approbation par le &quot;<em>Foreign Investment Review Board</em>&quot; - FIRB, qui est l&#39;organisme de contr&ocirc;le des investissements directs &eacute;trangers. La pr&eacute;-approbation du FIRB peut porter sur jusqu&#39;&agrave; 100% du programme. En cas de pr&eacute;-approbation du FIRB, l&#39;acqu&eacute;reur n&#39;aura pas &agrave; faire cette d&eacute;marche qui peut prendre un mois. Il devra cependant supporter le co&ucirc;t non n&eacute;gligeable de la proc&eacute;dure aupr&egrave;s du FIRB. En revanche, si le bien qu&#39;il veut acqu&eacute;rir n&#39;a pas &eacute;t&eacute; pr&eacute;-approuv&eacute;, l&#39;acheteur devra, par l&#39;interm&eacute;diaire de son solicitor, en demander l&#39;approbation et en payer le co&ucirc;t qui n&#39;est pas remboursable par le FIRB quelle que soit l&#39;issue de la proc&eacute;dure.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- En fonction du type de financement de l&#39;acquisition, en cas d&#39;emprunt aupr&egrave;s d&#39;une banque australienne il pourra y avoir des frais d&#39;enregistrement du &quot;<em>mortgage</em>&quot; (hypoth&egrave;que) et des honoraires qui seront factur&eacute;s par le solicitor. De m&ecirc;me, s&#39;il y a proc&eacute;dure d&#39;approbation FIRB, le solicitor facturera des honoraires.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<h1 style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Les autres frais</span></span></h1>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Les frais de solicitor sont en moyenne de $2,200 par transaction, ind&eacute;pendamment des surco&ucirc;ts que peuvent engendrer la proc&eacute;dure d&#39;approbation par le FIRB ou la r&eacute;daction d&#39;annexes concernant le financement de l&#39;acquisition, comme le contrat de pr&ecirc;t, etc&hellip;</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">D&#39;autres frais variables sont envisageables en fonction des &eacute;ventuelles expertises que l&#39;acheteur pourrait commander.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<h1 style=\"text-align:justify\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">LE CAS DES FRAIS D&#39;AGENCE IMMOBILIERE</span></span></h1>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">La r&eacute;glementation immobili&egrave;re australienne est tr&egrave;s stricte et contraignante, en particulier en ce qui concerne l&#39;information de l&#39;acheteur potentiel sur le bien qui lui est propos&eacute;. Le prix affich&eacute; est obligatoirement un prix public et un prix net. Il existe la r&egrave;gle qui interdit le &quot;<em>Two Tier Marketing</em>&quot;, c&#39;est-&agrave;-dire le fait de vendre &agrave; des &eacute;trangers un bien plus cher que le prix pratiqu&eacute; sur le march&eacute; local. Cette r&egrave;gle prot&egrave;ge non seulement les &eacute;trangers non-r&eacute;sidents, mais &eacute;galement la relation inter&eacute;tatique des r&eacute;sidents australiens. Elle a pour but d&#39;emp&ecirc;cher les vendeurs de profiter de l&#39;ignorance de l&#39;acheteur sur la valeur r&eacute;elle d&#39;un bien pour en augmenter artificiellement le prix de vente. Elle a pour cons&eacute;quence que le vendeur ne peut pas &quot;adapter&quot; le prix de vente annonc&eacute; au profil de l&#39;acheteur.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Les frais d&#39;agence immobili&egrave;re sont toujours compris dans le prix de vente. Ces frais sont toujours une charge du vendeur, jamais de l&#39;acheteur. Ces frais sont donc pay&eacute;s par le propri&eacute;taire vendeur (le promoteur) &agrave; l&#39;agence immobili&egrave;re qui a r&eacute;alis&eacute; la vente. En aucun cas il ne peut &ecirc;tre demand&eacute; une contribution &agrave; l&#39;acheteur &agrave; ce propos. Si un interm&eacute;diaire propose &agrave; un acheteur &quot;d&#39;&eacute;conomiser les frais d&#39;agence&quot;, notamment en passant directement par un solicitor et en lui demandant de lui payer ses propres honoraires, il s&#39;agit l&agrave;, probablement, d&#39;une pratique douteuse, et l&#39;achat reviendra beaucoup plus cher que par la voie normale, puisque le prix d&#39;achat, de toutes fa&ccedil;ons, &eacute;tait un prix net et comprenait d&egrave;s l&#39;origine la charge &quot;frais d&#39;agence&quot; imputable au vendeur. Une telle pratique reviendrait &agrave; surajouter les honoraires de l&#39;interm&eacute;diaire au prix qu&#39;en toutes hypoth&egrave;ses l&#39;acheteur aurait de toute fa&ccedil;on pay&eacute;. Il est donc en pratique interdit au vendeur de vendre un bien &agrave; un prix inf&eacute;rieur au prix publiquement annonc&eacute; sous pr&eacute;texte qui&#39;l en aurait retranch&eacute; les frais d&#39;agence. En tout &eacute;tat de cause, parce que tout promoteur a en interne sa propre licence officielle d&#39;agent immobilier, l&#39;&eacute;conomie qu&#39;il r&eacute;aliserait en ne payant pas la prestation d&#39;une agence externe ne serait pas d&eacute;duite du prix de vente, mais serait ipso facto redispatch&eacute;e sur sa propre agence interne.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Il est donc toujours utile - et cela ne co&ucirc;tera rien &agrave; l&#39;acheteur - de passer par une agence immobili&egrave;re australienne qui lui apportera ses conseils et sa bonne connaissance du march&eacute;. Il lui est en revanche fortement d&eacute;conseill&eacute; d&#39;entrer dans des combinaisons qui pourraient, au final, lui co&ucirc;ter tr&egrave;s cher.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Le portail &quot;Investir En Australie&quot; respecte scrupuleusement la r&eacute;glementation australienne en la mati&egrave;re en ne demandant ou en ne pr&eacute;levant absolument aucune contribution additionnelle aupr&egrave;s de ses Membres. Notre r&eacute;mun&eacute;ration ne provient exclusivement que de la r&eacute;tribution de notre intervention par les Agences Francophones Australiennes qui sont charg&eacute;es de conduire les dossiers des transactions, et cette r&eacute;tribution n&#39;est pr&eacute;lev&eacute;e que sur le montant de leur commission d&#39;agence, partie du prix de vente, et pay&eacute;e par le vendeur.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">*&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Pour nous contacter:</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">&quot;Investir En Australie&quot; - Tel: +61 415 940 412</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Mel : admin@investirenaustralie.com</span></span></span></p>', 'aInvestir en Australie,\r\nStamp Duty,\r\nAdditional Foreign Buyers Duty', 'En matière d\'immobilier résidentiel, les étrangers non-résidents qui souhaitent investir en Australie ne peuvent y acheter que du neuf, c\'est-à-dire des logements n\'ayant jamais été habités.', 20, 4, 'published', 0, 'blog', 149, 0, '2021-05-12 23:42:12', '2021-09-04 20:23:33', NULL),
(13, 'investir-en-australie-les-procedures-d-acquisition-immobiliere', 'INVESTIR EN AUSTRALIE : LES PROCEDURES D\'ACQUISITION IMMOBILIERE', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Tout transfert de propri&eacute;t&eacute; immobili&egrave;re r&eacute;sidentielle &agrave; des &eacute;trangers non-r&eacute;sidents doit recevoir l&#39;approbation de l&#39;organisme australien charg&eacute; du contr&ocirc;le des investissements &eacute;trangers, le FIRB (<em>Foreign Investment Review Board</em>). En fait les programmes que les promoteurs entendent ouvrir &agrave; une client&egrave;le &eacute;trang&egrave;re peuvent &ecirc;tre en partie ou en totalit&eacute; pr&eacute;-approuv&eacute;s par le FIRB.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Pour des informations sur les r&egrave;gles g&eacute;n&eacute;rales relatives &agrave; l&#39;investissement r&eacute;sidentiel en Australie, vous r&eacute;f&eacute;rer &agrave; notre article</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong><a href=\"https://investirenaustralie.com/fr/details_blog/2019/investir-en-australie-investissement-immobilier-residentiel-etranger\" style=\"color:#0563c1; text-decoration:underline\" target=\"_blank\"><span style=\"color:#000099\">INVESTIR EN AUSTRALIE : INVESTISSEMENT IMMOBILIER RESIDENTIEL ETRANGER</span></a></strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">En Australie il n&#39;existe pas de notaire, comme en France par exemple. La vente r&eacute;sulte de l&#39;enregistrement du transfert de propri&eacute;t&eacute; aupr&egrave;s de l&#39;Administration. Les diverses proc&eacute;dures associ&eacute;es peuvent parfaitement &ecirc;tre accomplies par un agent immobilier. Cependant, pour s&#39;entourer de toutes les garanties il est fortement recommand&eacute; d&#39;utiliser les services d&#39;un avocat (<em>solicitor</em>) qui v&eacute;rifiera et garantira la r&eacute;gularit&eacute; de tous les aspects de la transaction.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Chaque constructeur ou promoteur a en g&eacute;n&eacute;ral son propre solicitor qui se charge de la pr&eacute;-approbation du programme aupr&egrave;s du FIRB, de la r&eacute;daction des documents et r&egrave;glement de copropri&eacute;t&eacute; et de pr&eacute;&eacute;tablir les contrats de vente. Cependant ce solicitor travaille pour le vendeur et d&eacute;fend les int&eacute;r&ecirc;ts du vendeur. Il est donc recommand&eacute; &agrave; l&#39;acheteur d&#39;avoir son propre solicitor.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>LES DIFFERENTES ETAPES DE LA VENTE</strong></span></span></span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">(Pour les informations sur les co&ucirc;ts d&#39;une acquisition</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">immobili&egrave;re r&eacute;sidentielle, vous r&eacute;f&eacute;rer &agrave; notre article</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong><a href=\"https://investirenaustralie.com/fr/details_blog/2019/investir-en-australie-les-couts-d-acquisition-immobiliere\" style=\"color:#0563c1; text-decoration:underline\" target=\"_blank\"><span style=\"color:#000099\">INVESTIR EN AUSTRALIE : LES COUTS D&#39;ACQUISITION IMMOBILIERE</span></a></strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Une vente immobili&egrave;re suit g&eacute;n&eacute;ralement les &eacute;tapes suivantes:</span></span></span></p>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">&nbsp;</span></span></span></h2>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Agence Immobili&egrave;re</strong></span></span></span></h2>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">&nbsp;L&#39;acheteur potentiel s&#39;adresse d&#39;abord &agrave; une agence immobili&egrave;re australienne dont la profession est extr&ecirc;mement encadr&eacute;e, r&eacute;glement&eacute;e et contr&ocirc;l&eacute;e par le gouvernement. L&#39;Australie &eacute;tant un Etat f&eacute;d&eacute;ral, la mati&egrave;re immobili&egrave;re est une comp&eacute;tence de chaque Etat f&eacute;d&eacute;r&eacute;. Une agence immobili&egrave;re ne peut &ecirc;tre investie d&#39;un dossier que si elle est titulaire d&#39;une licence professionnelle valide de l&#39;Etat dans lequel se situe le bien vendu.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">L&#39;agence immobili&egrave;re est uniquement r&eacute;mun&eacute;r&eacute;e par le vendeur et le recours &agrave; cet interm&eacute;diaire n&#39;entra&icirc;ne aucun surco&ucirc;t pour l&#39;acheteur qui ne paiera que le prix de vente fix&eacute; par le vendeur.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">En revanche l&#39;agence immobili&egrave;re apporte une r&eacute;elle plus-value &agrave; l&#39;acheteur en termes de connaissance du march&eacute;, des prix pour chaque suburb, des tendances, des projets qui peuvent affecter la valeur future des biens, de la r&eacute;putation des constructeurs ou des promoteurs, etc&hellip; L&#39;agence se chargera &eacute;galement de s&#39;assurer que le bien achet&eacute; n&#39;est pas en zone inondable, ou qu&#39;il n&#39;est pas frapp&eacute; de servitudes ou autres obligations qui pourraient affecter la valeur ou la pertinence de l&#39;investissement.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">&quot;<strong>Investir En Australie</strong>&quot; travaille en partenariat avec des <strong>Agences Francophones Australiennes</strong> rigoureusement s&eacute;lectionn&eacute;es auxquelles sont confi&eacute;s pour finalisation les dossiers des investisseurs.</span></span></span></p>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</h2>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Expression Of Interest</strong></span></span></span></h2>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Tr&egrave;s souvent la proc&eacute;dure de vente commence par une EOI, &quot;<strong><em>Expression Of Interest</em></strong>&quot; (&quot;Manifestation d&#39;Int&eacute;r&ecirc;t&quot;) assortie d&#39;un d&eacute;p&ocirc;t de r&eacute;servation permettant au vendeur de prendre en consid&eacute;ration l&#39;intention de l&#39;acheteur potentiel, de r&eacute;server le bien &agrave; son nom et d&#39;ouvrir un dossier de vente.<br />\r\nCette EOI n&#39;a aucune valeur contraignante pour l&#39;acheteur potentiel qui peut &agrave; tout moment se d&eacute;dire. C&#39;est la raison pour laquelle les EOI ont toujours une dur&eacute;e de validit&eacute; contractuellement limit&eacute;e (en g&eacute;n&eacute;ral 7 jours).</span></span></span></p>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</h2>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Signature du contrat</strong></span></span></span></h2>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">L&#39;&eacute;tape suivante, essentielle, est la signature du contrat de vente. C&#39;est &agrave; ce moment-l&agrave; que les services du solicitor personnel de l&#39;acheteur sont particuli&egrave;rement utiles, non seulement pour la v&eacute;rification de la validit&eacute; du contrat, mais &eacute;galement pour la r&eacute;daction de diverses clauses suspensives ou r&eacute;solutoires relatives, par exemple, &agrave; l&#39;inspection pr&eacute;alable du bien achet&eacute;, &agrave; l&#39;engagement financier de l&#39;acheteur, ou encore &agrave; l&#39;aspect r&eacute;glementaire d&#39;une piscine.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Au Queensland, &agrave; partir de la signature du contrat l&#39;acheteur dispose d&#39;un d&eacute;lai de r&eacute;tractation (&quot;<strong><em>cooling-off period</em></strong>&quot;) de 5 jours, l&#39;exercice de cette option &eacute;tant sanctionn&eacute;e par une p&eacute;nalit&eacute; de 0,25% du prix de vente. Les modalit&eacute;s de l&#39;exercice de la r&eacute;tractation sont variables selon les Etats.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">La loi australienne admet parfaitement, pour des acheteurs ne pouvant se rendre en Australie, la signature et la transmission des diff&eacute;rentes pi&egrave;ces de l&#39;acte de vente par la voie des m&eacute;dia modernes tels la t&eacute;l&eacute;copie ou l&#39;envoi par courriel de documents scann&eacute;s au format PDF.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Tout doit &ecirc;tre mentionn&eacute; par &eacute;crit dans le contrat. Les promesses n&#39;ont aucune valeur. En droit immobilier australien, ce qui n&#39;est pas &eacute;crit n&#39;existe pas.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Les clauses suspensives ou r&eacute;solutoires stipul&eacute;es dans le contrat de vente sont limit&eacute;es dans le temps. La principale de ces clauses, qui concerne particuli&egrave;rement l&#39;achat de r&eacute;sidentiel neuf, est celle relative &agrave; la finalisation du financement de l&#39;acquisition.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Le contrat pr&eacute;voit un d&eacute;lai pour parvenir &agrave; la lev&eacute;e de ces conditions. Il ne devient d&eacute;finitif qu&#39;&agrave; partir de la lev&eacute;e de ces conditions. En particulier l&#39;acheteur doit payer un &quot;<em>deposit</em>&quot; qui, en incluant le d&eacute;p&ocirc;t de r&eacute;servation pay&eacute; pr&eacute;c&eacute;demment, ne doit pas &ecirc;tre sup&eacute;rieur &agrave; 10% du prix de vente, et apporter la garantie que le solde sera pay&eacute; au terme de la transaction, par le d&eacute;p&ocirc;t du montant de l&#39;achat entre les mains d&#39;un tiers agr&eacute;&eacute; comme le solicitor, par l&#39;obtention de pr&ecirc;ts bancaires ou d&#39;engagements irr&eacute;vocables d&#39;organismes financiers de payer le montant de l&#39;investissement &agrave; son terme. Ne pas oublier que les droits d&#39;enregistrement sont dus &agrave; ce moment-l&agrave; (environ 9,5% au Queensland).</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Apr&egrave;s le d&eacute;lai de r&eacute;tractation d&#39;une part, et la lev&eacute;e des conditions d&#39;autre part, le contrat devient &quot;<em>unconditional</em>&quot;. Il est alors d&eacute;finitif et le paiement des 10% constitue un acompte sur le montant de l&#39;achat. Si l&#39;acheteur se d&eacute;dit apr&egrave;s les &eacute;tapes ci-dessus, il perd son &quot;<em>deposit</em>&quot;.</span></span></span></p>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</h2>\r\n\r\n<h2 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><strong>Settlement</strong></span></span></span></h2>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Le &quot;<em>settlement</em>&quot; est le terme du contrat de vente, lorsque le bien est achev&eacute; et en &eacute;tat d&#39;&ecirc;tre livr&eacute;, le solde de 90% du prix de vente pay&eacute; par l&#39;acqu&eacute;reur, le bien enregistr&eacute; aupr&egrave;s des services officiels, le titre de propri&eacute;t&eacute; de l&#39;acheteur d&eacute;pos&eacute;, et qu&#39;il est proc&eacute;d&eacute; &agrave; la remise des cl&eacute;s et du titre de propri&eacute;t&eacute;.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">&nbsp;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">*&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">&nbsp;Pour nous contacter:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000066\">&quot;<strong>Investir En Australie</strong>&quot; - <strong>Tel: +61 415 940 412</strong></span></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000066\"><strong>Mel : admin@investirenaustralie.com</strong></span></span></span></p>', 'Investir en Australie,\r\nAgences Francophones Australiennes,\r\nExpression of nterest,\r\nCooling-off period', 'Tout transfert de propriété immobilière résidentielle à des étrangers non-résidents doit recevoir l\'approbation de l\'organisme australien chargé du contrôle des investissements étrangers, le', 5, 2, 'published', 0, 'blog', 174, 0, '2021-05-30 00:10:14', '2021-09-06 22:24:47', NULL),
(14, 'investir-en-australie-faire-construire-votre-maison', 'INVESTIR EN AUSTRALIE : FAIRE CONSTRUIRE VOTRE MAISON', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le projet &quot;<em>Investir En Australie</em>&quot; (IEA), avec l&#39;aide de son r&eacute;seau de partenaires australiens, peut vous assister dans la construction de <strong>votre maison en Australie</strong>. Deux choix sont possibles:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Vous voulez vous affranchir de toutes contraintes</strong></span></span></span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Dans ce cas nous pouvons rechercher pour vous un terrain dans la localisation de votre choix. Il faut cependant &ecirc;tre conscient que, selon l&#39;emplacement, l&#39;offre de terrains pourra &ecirc;tre inexistante ou extr&ecirc;mement limit&eacute;e et tr&egrave;s on&eacute;reuse.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Une fois le terrain achet&eacute;, munis de vos desiderata nous pouvons lancer des consultations d&#39;architectes, de constructeurs et de bureaux techniques pour le contr&ocirc;le des travaux. Nous pouvons proc&eacute;der aux op&eacute;rations d&#39;enregistrement de votre nouvelle propri&eacute;t&eacute; aupr&egrave;s des autorit&eacute;s australiennes.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Notre intervention donnera lieu &agrave; commission n&eacute;goci&eacute;e.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Vous pr&eacute;f&eacute;rez la solution &quot;cl&eacute;s en mains&quot;</strong></span></span></span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Cette solution passe par une organisation reconnue en mati&egrave;re de construction de villas individuelles. C&#39;est la solution la plus rapide et la plus sure.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Investir En Australie</strong> peut vous proposer une solution efficace car nous avons un accord de partenariat avec le groupe Metricon.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le groupe Metricon, fond&eacute; en 1976, est le n&deg;1 australien de la construction individuelle. Au cours de la derni&egrave;re ann&eacute;e il a livr&eacute; pr&egrave;s de 4800 maisons, soit une moyenne de 92 maisons par semaine. Cette position de leader, qui n&#39;est pas le fruit du hasard, tient &agrave; son exp&eacute;rience, son organisation et son professionnalisme sans faille.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Au cours des ann&eacute;es Metricon a d&eacute;velopp&eacute; et mis au point un grand nombre de mod&egrave;les de maisons de plain-pied, &agrave; &eacute;tage ou jumel&eacute;es qui, maintes fois r&eacute;p&eacute;t&eacute;es, sont une garantie d&#39;ex&eacute;cution dans les meilleurs d&eacute;lais, de solidit&eacute; et de long&eacute;vit&eacute;. Selon les derni&egrave;res statistiques, Metricon livre une maison de plain-pied en 23 semaines, une maison &agrave; &eacute;tage en 34 semaines.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Les multiples mod&egrave;les de maisons et leurs diverses variations peuvent &ecirc;tre vus sur le site de Metricon &agrave; l&#39;adresse: </span><a href=\"https://www.metricon.com.au/new-home-designs/qld\" style=\"color:#0563c1; text-decoration:underline\"><span style=\"color:#000000\">https://www.metricon.com.au/new-home-designs/qld</span></a><span style=\"color:#000000\">.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Un d&eacute;tail qui a son importance : les prix minimum et maximum annonc&eacute;s ne sont pas des prix &quot;<em>r&eacute;alistes</em>&quot;. Ils correspondent au co&ucirc;t de la maison &quot;<em>hors-sol</em>&quot;, &quot;<em>brute de d&eacute;coffrage</em>&quot;, et ne tiennent pas compte des divers am&eacute;nagements compl&eacute;mentaires indispensables, tels que les barri&egrave;res, rampe d&#39;acc&egrave;s, boite aux lettres, ou autres sp&eacute;cificit&eacute;s du terrain. Dans une premi&egrave;re approche, avant d&#39;obtenir le devis de Metricon, il est donc recommand&eacute; &agrave; l&#39;investisseur potentiel de rajouter une somme maximum de $50,000 au prix s&eacute;lectionn&eacute;.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le &quot;business model&quot; de Metricon est le suivant: le Groupe travaille en liaison &eacute;troite avec des am&eacute;nageurs-lotisseurs de domaines fonciers de grande taille. Le lotisseur d&eacute;finit la division du domaine, les r&egrave;gles d&#39;urbanisme applicables, la taille des lots et r&eacute;alise leur viabilisation. Metricon construit les maisons pour les acheteurs de lots. L&#39;acheteur d&#39;un lot choisit le mod&egrave;le de maison qu&#39;il veut faire construire sur son terrain. Terrain + maison sont vendus dans un package.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">En Australie les lots individuels sont de taille tr&egrave;s r&eacute;duite et il n&#39;est pas rare que des lots aient une superficie inf&eacute;rieure &agrave; 3 ares.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">La d&eacute;marche &quot;<em>achat du terrain puis construction de la maison</em>&quot; pr&eacute;sente un int&eacute;r&ecirc;t financier important car dans ce cas seul l&#39;achat du foncier est soumis aux droits d&#39;enregistrement (9,5% pour les &eacute;trangers), la construction de la maison &eacute;tant libre de ces droits.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&quot;<em>Investir En Australie</em>&quot; et ses partenaires australiens francophones vous aideront &agrave; formaliser et &agrave; r&eacute;gler le montage terrain + maison avec Metricon et &agrave; mener &agrave; bonne fin votre op&eacute;ration d&#39;investissement.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp; </span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">*&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour nous contacter:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000099\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&quot;<strong>Investir En Australie</strong>&quot; - <strong>Tel: +61 415 940 412</strong></span></span></span></p>\r\n\r\n<p><span style=\"color:#000099\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Mel : admin@investirenaustralie.com</strong></span></span></span></p>', 'Investir en Australie,\r\nVotre maison en Australie', 'Il est rare de pouvoir trouver une maison individuelle neuve à acheter, et cette hypothèse renchérit le prix d\'achat. Il est préférable d\'acquérir le terrain et, soit de s\'affranchir de toute', 2, 3, 'published', 0, 'blog', 175, 0, '2021-05-30 00:45:45', '2021-06-03 20:36:20', NULL);
INSERT INTO `blogs` (`id`, `slug`, `title`, `content`, `meta_tag`, `meta_description`, `view_count`, `view_order`, `status`, `starred`, `post_type`, `image_id`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 'investir-en-australie-echeancier-d-investissement-immobilier', 'INVESTIR EN AUSTRALIE : ECHEANCIER D\'INVESTISSEMENT IMMOBILIER', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Il existe une différence significative dans l\'échéancier de paiement du prix d\'un bien immobilier en vente sur plan lorsque l\'on veut <strong>investir en Australie</strong> par rapport à ce qui se pratique dans la sphère française, comme le montre le tableau suivant concernant une construction type d\'une vingtaine d\'étages:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"> </p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>COMPARATIF DES ECHEANCIERS D\'UN INVESTISSEMENT IMMOBILIER</strong></span></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>EN AUSTRALIE ET DANS LA SPHERE FRANCAISE</strong></span></span></span></p>\r\n\r\n<table align=\"center\" border=\"2\" cellpadding=\"1\" cellspacing=\"1\" style=\"height:998px; width:738px\" summary=\"Echéancier d\'un investissement immobilier en Australie\">\r\n	<caption>\r\n	<p> </p>\r\n	</caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\"><span style=\"color:#000000\"><u><span style=\"font-size:20px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">AUSTRALIE</span></span></u></span></th>\r\n			<th scope=\"col\"><span style=\"color:#000000\"><u><span style=\"font-size:20px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">SPHERE FRANCAISE</span></span></u></span></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- dépôt initial de réservation de 1% du prix de vente (\"<em>Expression Of Interest</em>\")</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- 5 % à la réservation</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- étendu à 10% du prix de vente dans les 14 jours de la signature du contrat</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- 15 % à la signature de l’acte authentique</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Néant</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- 20 % aux fondations</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Néant</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- 20 % à la dalle basse du 3ème étage</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Néant</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- 15 % à la dalle basse du 8ème étage</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Néant</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- 15 % à la dalle basse du 15ème étage </span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Néant</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- 5 % à l’achèvement des travaux</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- solde (90%) 14 jours après réception et remise des clés</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">- 5 % à la livraison</span></span></span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">  Ainsi, dans un <strong>investissement en Australie</strong>, le promoteur prend tous les risques financiers, 90% du prix n\'étant versé par l\'acheteur qu\'à la livraison du bien. Le promoteur est donc contraint de financer 90% du coût de la construction, ce qui est fait la plupart du temps sur emprunt. C\'est une des raisons pour lesquelles les constructions y sont réalisées à un train d\'enfer et que les promoteurs multiplient les canaux de vente pour s\'assurer que les unités trouveront acquéreurs le plus rapidement possible. Il n\'est pas rare de voir une construction d\'une vingtaine d\'étages être achevée dans un délai inférieur à 12 mois. Ceci explique que la livraison n\'a pas besoin d\'être assortie de pénalités de retard. En outre les normes de qualité et la variété des prestations annexes y sont extrêmement élevées.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">En revanche, dans la sphère française, c\'est l\'acquéreur qui finance la construction au travers des appels de fonds successifs, le promoteur ne prenant en général que très peu de risques. C\'est la raison pour laquelle, la construction étant financée par l\'acheteur, le promoteur octroie une exclusivité de vente à une ou à un nombre très limité d\'agences immobilières, mais qu\'en revanche il est généralement lié par un délai de livraison assorti d\'éventuelles pénalités de retard.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Dans ces conditions, en comparaison avec ce qui se pratique dans la sphère française, le client est gagnant en Australie, pour des coûts de construction objectivement inférieurs.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"> </span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">*     *     *     *     *</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"> </span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\">Pour nous contacter:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000099\">\"<strong>Investir En Australie</strong>\" - <strong>Tel: +61 415 940 412</strong></span></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000099\"><strong>Mel : admin@investirenaustralie.com</strong></span></span></span></p>', 'Investir en Australie,\r\nInvestissement en Australie,\r\nÉchéancier d\'un investissement immobilier en Australie', 'Il existe une différence significative dans l\'échéancier de paiement du prix d\'un bien immobilier en vente sur plan lorsque l\'on veut investir en Australie par rapport à ce qui se pratique da', 11, 5, 'published', 0, 'blog', 176, 0, '2021-05-30 01:56:27', '2021-06-01 05:50:52', NULL),
(16, 'investir-en-australie-le-regime-fiscal-applicable-aux-etrangers-non-residents', 'INVESTIR EN AUSTRALIE : LE REGIME FISCAL APPLICABLE AUX ETRANGERS NON-RESIDENTS', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Apr&egrave;s avoir r&eacute;alis&eacute; un <strong>investissement en Australie</strong>, vous souhaiterez sans doute amortir le co&ucirc;t de cet investissement en louant votre bien. Les produits de cette location constitueront un revenu et seront imposables en Australie. Il est donc int&eacute;ressant de conna&icirc;tre le niveau d&#39;imposition brut de ces revenus.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le bar&egrave;me de l&#39;imp&ocirc;t sur le revenu en Australie (&quot;<em>Tax Return</em>&quot;), comme dans &agrave; peu pr&egrave;s toutes les l&eacute;gislations fiscales, est diff&eacute;rent selon que le contribuable est ou non r&eacute;sident fiscal. Les non-r&eacute;sidents fiscaux ne sont imposables que sur leurs revenus de source australienne, &agrave; la diff&eacute;rence des r&eacute;sidents fiscaux qui sont imposables sur l&#39;universalit&eacute; de leurs revenus.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Il faut ici souligner l&#39;importance pour le contribuable de l&#39;existence ou de l&#39;absence de convention fiscale entre les pays o&ugrave; il aurait des revenus. Il existe par exemple une convention fiscale entre la France et l&#39;Australie qui permet d&#39;&eacute;viter les doubles impositions.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>R&eacute;sidents fiscaux en Australie</strong></span></span></span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour les r&eacute;sidents fiscaux en Australie, imposables sur l&#39;universalit&eacute; de leurs revenus, le bar&egrave;me progressif de l&#39;imp&ocirc;t est le suivant depuis le 1er juillet 2014:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\" style=\"height:276px; width:403px\" summary=\"IMPOSITION DES RESIDENTS FISCAUX AUSTRALIENS\">\r\n	<caption>\r\n	<p><span style=\"color:#000000\"><strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">IMPOSITION DES RESIDENTS FISCAUX AUSTRALIENS</span></span></strong></span></p>\r\n	</caption>\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">De 0 - A$18,200</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">0%</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">De A$18,201 &agrave; A$37,000</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">19%</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">De A$37,001 &agrave; A$80,000</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">32.5%</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">De A$80,001 &agrave; A$180,000</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">37%</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Au-del&agrave; de A$180,000</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">45%</span></span></span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Non-r&eacute;sidents fiscaux en Australie</strong></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Les personnes reconnues non-r&eacute;sidentes fiscales en Australie ne sont imposables que sur leurs revenus de source australienne. Ce sera a priori le cas pour la personne qui ne vit pas, ou qui ne vit pas plus de 6 mois en Australie, y ach&egrave;te un bien immobilier, ne l&#39;habite pas, ou ne l&#39;habite pas &agrave; titre permanent, et en tire des revenus locatifs. Bien entendu, un certain nombre de charges sont d&eacute;ductibles des revenus fonciers.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour accomplir les formalit&eacute;s de d&eacute;claration et g&eacute;rer votre dossier fiscal vous devrez en premier lieu vous faire enregistrer aupr&egrave;s de l&#39;administration fiscale australienne (<em>Australian Taxation Office</em>) pour obtenir votre num&eacute;ro TFN de contribuable (<em>Tax File Number</em>). Ce num&eacute;ro vous accompagnera dans toutes vos d&eacute;marches vis-&agrave;-vis du fisc australien.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour ces non-r&eacute;sidents, le bar&egrave;me progressif de l&#39;imp&ocirc;t sur l&#39;ensemble des revenus nets imposables de source uniquement australienne est le suivant depuis le 1er juillet 2014: </span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<table align=\"center\" border=\"2\" cellpadding=\"2\" cellspacing=\"2\" style=\"width:500px\" summary=\"IMPOSITION DES ETRANGERS NON RESIDENTS FICAUX EN AUSTRALIE\">\r\n	<caption>\r\n	<p><strong><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">IMPOSITION DES ETRANGERS NON RESIDENTS FICAUX EN AUSTRALIE</span></span></span></strong></p>\r\n	</caption>\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">De 0 - A$80,000</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">32.5%</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">De A$80,001 &agrave; A$180,000</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">37%</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Au-del&agrave; de A$180,000</span></span></span></td>\r\n			<td style=\"text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">45%</span></span></span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Il ne faut pas perdre de vue qu&#39;au titre de l&#39;imposabilit&eacute; de &quot;<em>l&#39;universalit&eacute; des revenus</em>&quot; une personne non-r&eacute;sidente en Australie et qui y poss&egrave;de un bien immobilier dont elle tire des revenus locatifs, outre qu&#39;elle paiera des imp&ocirc;ts en Australie, devra &eacute;galement, sauf convention fiscale entre les deux pays, d&eacute;clarer les profits locatifs nets r&eacute;alis&eacute;s en Australie au fisc de son pays ou territoire de r&eacute;sidence, lesquels viendront alors s&#39;ajouter &agrave; ses autres revenus imposables &agrave; l&#39;imp&ocirc;t sur le revenu de ce pays ou territoire de r&eacute;sidence.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">La plateforme &quot;<strong>Investir en Australie</strong>&quot; pourra vous proposer les services d&#39;une agence immobili&egrave;re francophone pour la location de votre bien, et d&#39;un cabinet comptable francophone agr&eacute;&eacute; qui pourra se charger de toutes vos d&eacute;clarations fiscales aupr&egrave;s de l&#39;administration australienne.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">*&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour nous contacter:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000099\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&quot;<strong>Investir En Australie</strong>&quot; - <strong>Tel: +61 415 940 412</strong></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000099\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Mel : admin@investirenaustralie.com</strong></span></span></span></p>', 'Investir en Australie,\r\nNon-résidents fiscaux en Australie', 'Le barème de l\'impôt sur le revenu en Australie (\"Tax Return\"), comme dans à peu près toutes les législations fiscales, est différent selon que le contribuable est ou non résident fiscal. Les', 9, 6, 'published', 0, 'blog', 177, 0, '2021-05-30 03:43:08', '2021-09-06 22:26:31', NULL),
(17, 'investir-en-australie-regime-fiscal-de-la-vente-d-un-bien-immobilier', 'INVESTIR EN AUSTRALIE : REGIME FISCAL DE LA VENTE D\'UN BIEN IMMOBILIER', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Vous n&#39;&ecirc;tes ni de nationalit&eacute; australienne, ni r&eacute;sident en Australie, mais vous avez d&eacute;cid&eacute; pr&eacute;c&eacute;demment d&#39;<strong>investir en Australie</strong>, et vous y &ecirc;tes &agrave; pr&eacute;sent propri&eacute;taire d&#39;un bien immobilier que vous souhaitez vendre.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">La premi&egrave;re des choses &agrave; savoir est que vous ne pourrez vendre votre bien qu&#39;&agrave; un acheteur de nationalit&eacute; australienne ou r&eacute;sident australien, sauf si le bien est situ&eacute; dans le p&eacute;rim&egrave;tre de l&#39;un des trois complexes touristiques agr&eacute;&eacute;s par le gouvernement australien. Voir notre article :</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong><a href=\"https://investirenaustralie.com/fr/details_blog/2019/investir-en-australie-investissement-immobilier-residentiel-etranger\" style=\"color:#0563c1; text-decoration:underline\" target=\"_blank\"><span style=\"color:#000099\">INVESTIR EN AUSTRALIE : INVESTISSEMENT IMMOBILIER RESIDENTIEL ETRANGER</span></a></strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Par ailleurs les plus-values immobili&egrave;res sont taxables en Australie et constituent une cat&eacute;gorie de revenus &agrave; int&eacute;grer dans la d&eacute;claration d&#39;imp&ocirc;ts annuelle.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">A partir du moment o&ugrave; il y a une mati&egrave;re fiscale &agrave; d&eacute;clarer, et compte tenu de votre situation (&eacute;tranger non-r&eacute;sident), vous entrez dans la cat&eacute;gorie des contribuables non-r&eacute;sidents. En cons&eacute;quence:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- Vous devrez en premier lieu vous faire enregistrer aupr&egrave;s de l&#39;administration fiscale australienne (<strong><em>Australian Taxation Office</em></strong>) pour obtenir votre num&eacute;ro TFN de contribuable (<em>Tax File Number</em>). Vous avez peut-&ecirc;tre d&eacute;j&agrave; ce TFN si vous louez votre bien, ce qui entra&icirc;ne l&#39;obligation de d&eacute;claration annuelle de revenus fonciers.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- Vous devrez ensuite, lors de votre prochaine d&eacute;claration annuelle de revenus, d&eacute;clarer la plus-value que vous avez r&eacute;alis&eacute;e entre le prix auquel vous aviez initialement achet&eacute; votre bien et le prix auquel vous l&#39;avez vendu, les d&eacute;penses pour am&eacute;nagements (extensions, piscines, &hellip;) que vous auriez pu r&eacute;aliser dans l&#39;intervalle &eacute;tant d&eacute;ductibles.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Les plus-values r&eacute;alis&eacute;es sont alors une cat&eacute;gorie de revenus &agrave; d&eacute;clarer dans l&#39;ensemble de vos revenus de source australienne. Pour conna&icirc;tre les taux d&#39;imposition, parcourez l&#39;article :</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong><a href=\"https://investirenaustralie.com/fr/details_blog/2019/investir-en-australie-le-regime-fiscal-applicable-aux-etrangers-non-residents\" style=\"color:#0563c1; text-decoration:underline\" target=\"_blank\"><span style=\"color:#000099\">INVESTIR EN AUSTRALIE : LE REGIME FISCAL APPLICABLE AUX ETRANGERS NON-RESIDENTS</span></a></strong></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Il vous est fortement recommand&eacute; de recourir aux services d&#39;un agent comptable et fiscal pour toutes ces d&eacute;marches en relation avec le fisc australien.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">La loi australienne impose cependant &agrave; votre acheteur, compte tenu de votre propre situation d&#39;&eacute;tranger non-r&eacute;sident, de pr&eacute;lever sur le prix de vente du bien un montant &eacute;gal &agrave; 12.5% de ce prix de vente et de le verser &agrave; l&#39;administration fiscale. Ce pr&eacute;l&egrave;vement n&#39;a cependant lieu que si le prix de vente est &eacute;gal ou sup&eacute;rieur &agrave; $750,000.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Cela constitue une retenue (<em>Capital Gains Witholding</em>) du gouvernement australien pour s&#39;assurer que vous d&eacute;clarerez effectivement cette plus-value et paierez l&#39;imp&ocirc;t annuel &agrave; la prochaine &eacute;ch&eacute;ance fiscale. Cette retenue constituera alors un cr&eacute;dit d&#39;imp&ocirc;t, et l&#39;&eacute;ventuel surplus pr&eacute;lev&eacute; au-del&agrave; du montant d&#39;imp&ocirc;t dont vous serez redevable vous serait rembours&eacute;.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">*&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour nous contacter:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000099\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&quot;<strong>Investir En Australie</strong>&quot; - <strong>Tel: +61 415 940 412</strong></span></span></span></p>\r\n\r\n<p><span style=\"color:#000099\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Mel : admin@investirenaustralie.com</strong></span></span></span></p>', 'Investir en Australie,\r\nAustralian Taxation Office', 'Les plus-values immobilières sont taxables en Australie et constituent une catégorie de revenus à intégrer dans la déclaration d\'impôts annuelle.', 2, 7, 'published', 0, 'blog', 178, 0, '2021-05-30 04:15:58', '2021-05-30 05:11:42', NULL),
(18, 'investir-en-australie-la-location-d-un-bien-immobilier', 'INVESTIR EN AUSTRALIE : LA LOCATION D\'UN BIEN IMMOBILIER', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Un &eacute;tranger non-r&eacute;sident qui se porte acqu&eacute;reur d&#39;un bien immobilier r&eacute;sidentiel en Australie cherchera vraisemblablement &agrave; en tirer des revenus, en le louant soit &agrave; titre permanent, soit pour des p&eacute;riodes de court s&eacute;jour en utilisant un r&eacute;seau sp&eacute;cialis&eacute; du type Airbnb. Chacune de ces m&eacute;thodes de location a ses avantages et ses inconv&eacute;nients. Nous nous int&eacute;resserons dans cet article &agrave; la location &agrave; titre permanent.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le syst&egrave;me &quot;Investir En Australie&quot;, bien qu&#39;il ait en interne sa propre agence immobili&egrave;re, &quot;<em>L&#39;Immobili&egrave;re Australienne Pty Ltd</em>&quot; (LIA), ne se charge pas de la gestion locative. Les acqu&eacute;reurs qui souhaitent proposer leur bien &agrave; la location pourront &eacute;ventuellement s&#39;adresser &agrave; l&#39;agence qui a conduit la transaction. Mais comme cette option est parfois interdite par le vendeur, IEA pourra, sur demande de l&#39;acheteur, lui proposer une autre agence de gestion immobili&egrave;re.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Les agences immobili&egrave;res</strong></span></span></span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">La gestion de la location du bien sera assur&eacute;e par une agence immobili&egrave;re. La profession d&#39;agent immobilier est extr&ecirc;mement encadr&eacute;e par la r&eacute;glementation australienne. En particulier les agences, parall&egrave;lement &agrave; leurs comptes bancaires d&#39;entreprise doivent avoir un compte sp&eacute;cial, le &quot;<em>Trust Account</em>&quot;, sur lequel sont d&eacute;pos&eacute;s les fonds ne lui appartenant pas comme les d&eacute;p&ocirc;ts de l&#39;acheteur lors de la signature d&#39;un contrat de vente, ou les loyers pay&eacute;s par les locataires. Les trust accounts sont audit&eacute;s 2 fois par an par des cabinets ind&eacute;pendants.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Toutes les &quot;<em>Agences Francophones Australiennes</em>&quot; (AFA) en partenariat avec le syst&egrave;me &quot;<strong>Investir En Australie</strong>&quot; s&#39;inscrivent bien entendu dans cette r&eacute;glementation et sont rigoureusement s&eacute;lectionn&eacute;es pour leur professionnalisme et leur exp&eacute;rience.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour les diff&eacute;rents &eacute;l&eacute;ments ci-apr&egrave;s de la location nous retiendrons les crit&egrave;res utilis&eacute;s par l&#39;AFA partenaire de &quot;Investir En Australie&quot; sur la r&eacute;gion de Gold Coast.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Les baux</strong></span></span></span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Il convient de rappeler qu&#39;en Australie les loyers sont en g&eacute;n&eacute;ral &eacute;tablis sur une base hebdomadaire, mais ils peuvent &eacute;galement &ecirc;tre par quinzaine ou mensuels. La caution de garantie est de 4 semaines de loyer net (sans GST). Un minimum de 2 semaines de loyer d&#39;avance est exig&eacute; &agrave; la signature du bail. Les baux peuvent &ecirc;tre d&#39;une dur&eacute;e nominale de 12 mois (52 semaines), mais les baux de 6 mois (26 semaines) sont &eacute;galement souvent employ&eacute;s. On distingue 2 p&eacute;riodes:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- Pendant toute la dur&eacute;e nominale du bail, propri&eacute;taire et locataire sont dans la p&eacute;riode dite de &quot;<em>Fixed Term Tenancy</em>&quot; (Bail &agrave; Ech&eacute;ance Fixe). L&#39;un comme l&#39;autre sont tenus de respecter les termes du bail. En particulier le loyer est d&ucirc; jusqu&#39;&agrave; son terme, sauf bail avec un nouveau locataire. Si le propri&eacute;taire souhaite le d&eacute;part du locataire au terme du bail, il doit en faire la notification au locataire dans le d&eacute;lai de 2 mois avant le terme pr&eacute;vu au contrat. Si c&#39;est le locataire qui souhaite partir, il doit en avertir le bailleur 2 semaines avant le terme. Si le locataire souhaite quitter le logement avant la fin du bail il doit le paiement du loyer jusqu&#39;&agrave; la fin de son bail en cours ou jusqu&#39;&agrave; ce qu&#39;un nouveau bail soit sign&eacute; par un nouveau locataire, ainsi que le versement &agrave; l&#39;agence d&#39;une p&eacute;nalit&eacute; &eacute;gale &agrave; 1 semaine de loyer pour frais de dossier.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- Au-del&agrave; du terme du bail initial, si aucune des parties ne souhaite mettre un terme &agrave; l&#39;occupation des lieux, un nouveau bail peut &eacute;ventuellement &ecirc;tre sign&eacute;. Dans le cas o&ugrave; le locataire veut formellement renouveler son bail, l&#39;agence immobili&egrave;re lui facturera 1/2 semaine du loyer (GST non incluse). Mais la signature d&#39;un nouveau bail n&#39;est pas n&eacute;cessaire. En effet, sans nouveau bail, c&#39;est l&#39;ancien bail qui se poursuit dans une nouvelle p&eacute;riode appel&eacute;e &quot;<em>Periodic Tenancy</em>&quot; (Bail P&eacute;riodique) de dur&eacute;e ind&eacute;finie. Si, &agrave; un moment quelconque de cette nouvelle p&eacute;riode, le propri&eacute;taire souhaite y mettre un terme, il doit le signifier au locataire avec un pr&eacute;avis de 2 mois. Si c&#39;est le locataire qui veut partir, il doit en avertir le propri&eacute;taire avec un pr&eacute;avis de 2 semaines.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Lorsque le contrat pr&eacute;voit un loyer mensuel, le locataire doit payer son loyer 1 mois en avance. Si le loyer est par quinzaine, il doit toujours payer son loyer une quinzaine en avance. Enfin, si le loyer est hebdomadaire, il doit toujours payer 2 semaines en avance. Tout cela est fait pour prot&eacute;ger le propri&eacute;taire.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Durant la p&eacute;riode du bail, une inspection des lieux est conduite tous les 6 mois afin de v&eacute;rifier que la propri&eacute;t&eacute; est bien entretenue. Pour la gestion de la location, notre AFA partenaire utilise un logiciel informatique approuv&eacute; par le Gouvernement du Queensland et l&#39;administration fiscale australienne (ATO). En fin d&#39;ann&eacute;e fiscale (30 juin), un rapport annuel de la location (revenus et charges) est produit et envoy&eacute; au propri&eacute;taire.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Toute r&eacute;paration en dessous de A$250.00 est automatiquement autoris&eacute;e par l&#39;agence. Au-del&agrave; de cette somme, une autorisation d&#39;engagement de la d&eacute;pense est demand&eacute;e au propri&eacute;taire.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Organismes de r&eacute;gulation et de contr&ocirc;le</strong></span></span></span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le droit australien &eacute;tant formaliste &agrave; l&#39;extr&ecirc;me, il existe pour chaque type d&#39;&eacute;v&egrave;nement de la vie d&#39;un bail des formulaires officiels. La plupart des &eacute;tapes du bail sont du ressort d&#39;un organisme officiel. Au Queensland il s&#39;agit du &quot;<strong><em>Residential Tenancy Authority</em></strong>&quot; (RTA). Par exemple l&#39;agence qui, lors de la signature d&#39;un bail, re&ccedil;oit la caution de garantie (&quot;<em>Bond</em>&quot;) dans son Trust Account, doit la reverser imm&eacute;diatement au RTA, et c&#39;est ce RTA qui est charg&eacute; de sa restitution totale ou partielle au locataire en fonction de l&#39;&eacute;tat des lieux de sortie.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Frais d&#39;agence</strong></span></span></span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><em>(*) Le taux de la GST est de 10%; c&#39;est un taux unique.</em></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Notre Agence Francophone Australienne partenaire du Queensland applique un certain nombre de frais &agrave; la gestion locative, dans les normes des pratiques professionnelles:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- Frais de publicit&eacute; : forfait de $120 pour chaque renouvellement de bail ou pour tout nouveau bail;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- Frais forfaitaire de dossier par bail : 1 semaine &eacute;quivalent loyer + GST;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- Commission de gestion courante des loyers : 6.75% + GST du montant du loyer;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- Frais administratifs : $5 + GST par mois;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Par ailleurs l&#39;AFA prend ponctuellement des frais dans diff&eacute;rentes circonstances particuli&egrave;res, comme la repr&eacute;sentation du propri&eacute;taire devant un tribunal ou autres.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Les imp&ocirc;ts</strong></span></span></span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Qui dit &quot;<em>revenu</em>&quot; dit &quot;<em>imp&ocirc;t</em>&quot;. L&#39;Australie n&#39;&eacute;chappe pas &agrave; cette r&egrave;gle. Les revenus tir&eacute;s de la location d&#39;un bien immobilier entrent dans la cat&eacute;gorie des revenus fonciers qui s&#39;int&egrave;gre &agrave; l&#39;ensemble des revenus cat&eacute;goriels &agrave; d&eacute;clarer annuellement &agrave; l&#39;administration fiscale australienne. L&#39;ann&eacute;e fiscale australienne (&quot;<em>Financial Year</em>&quot;), tant pour les personnes physiques que morales, court du 1<sup>er</sup> juillet au 30 juin de l&#39;ann&eacute;e suivante.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour accomplir les formalit&eacute;s de d&eacute;claration et g&eacute;rer son dossier fiscal le propri&eacute;taire <strong>&eacute;tranger non-r&eacute;sident en Australie</strong> doit en premier lieu se faire enregistrer aupr&egrave;s de l&#39;administration fiscale australienne (<em>Australian Taxation Office</em>) pour obtenir son num&eacute;ro TFN de contribuable (<em>Tax File Number</em>). Ce TFN l&#39;accompagnera dans toutes ses d&eacute;marches vis-&agrave;-vis de l&#39;ATO. Les services d&#39;un agent comptable et fiscal sont vivement recommand&eacute;s. &quot;Investir En Australie&quot; pourra vous proposer des professionnels francophones australiens.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour conna&icirc;tre les taux d&#39;imposition applicables aux non-r&eacute;sidents, merci de vous reporter &agrave; notre article</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><strong><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><a href=\"https://investirenaustralie.com/fr/details_blog/2019/investir-en-australie-le-regime-fiscal-applicable-aux-etrangers-non-residents\" style=\"color:#0563c1; text-decoration:underline\" target=\"_blank\"><span style=\"color:#000099\">INVESTIR EN AUSTRALIE : LE REGIME FISCAL APPLICABLE AUX ETRANGERS NON-RESIDENTS</span></a></span></span></strong></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Doivent donc &ecirc;tre d&eacute;clar&eacute;s les revenus bruts des loyers de la p&eacute;riode de r&eacute;f&eacute;rence et les charges d&eacute;ductibles. Sont d&eacute;ductibles les int&eacute;r&ecirc;ts des emprunts, les frais divers en lien avec la location (publicit&eacute;, nettoyage, jardin, d&eacute;sinsectisation, assurance, frais d&#39;agence) ou essentiels &agrave; la disponibilit&eacute; du bien &agrave; la location (syndic, taxes, fourniture d&#39;eau, r&eacute;parations et entretien),&hellip;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le solde positif revenus/charges (&quot;<em>positive gearing</em>&quot;) est int&eacute;gr&eacute; &agrave; la d&eacute;claration de l&#39;ensemble des revenus. Si au contraire ce solde est n&eacute;gatif, on parle alors de &quot;<strong><em>negative gearing</em></strong>&quot;, la perte venant alors en d&eacute;duction des autres cat&eacute;gories de revenus. </span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">*&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp;&nbsp; *</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour nous contacter:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"color:#000099\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&quot;<strong>Investir En Australie</strong>&quot; - <strong>Tel: +61 415 940 412</strong></span></span></span></p>\r\n\r\n<p><span style=\"color:#000099\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>&nbsp;Mel : admin@investirenaustralie.com</strong></span></span></span></p>', 'Investir en Australie,\r\nAgences Francophones Australiennes,\r\nResidential Tenancy Authority,\r\nétranger non-résident en Australie,\r\nnegative gearing', 'Un étranger non-résident qui se porte acquéreur d\'un bien immobilier résidentiel en Australie cherchera vraisemblablement à en tirer des revenus, en le louant soit à titre permanent, soit pou', 7, 8, 'published', 0, 'blog', 179, 0, '2021-05-30 04:42:21', '2021-07-28 06:17:44', NULL);
INSERT INTO `blogs` (`id`, `slug`, `title`, `content`, `meta_tag`, `meta_description`, `view_count`, `view_order`, `status`, `starred`, `post_type`, `image_id`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 'gold-coast', 'GOLD COAST', '<p><strong>Gold Coast</strong> est l&#39;agglom&eacute;ration australienne poss&eacute;dant le plus fort d&eacute;veloppement. Son potentiel ph&eacute;nom&eacute;nal en font un excellent choix pour <strong>investir en Australie</strong>.</p>\r\n\r\n<p>La fa&ccedil;ade maritime au Sud de <strong>Brisbane</strong> est particuli&egrave;re car, contrairement &agrave; une tr&egrave;s grande partie de la c&ocirc;te Est de l&#39;Australie qui est expos&eacute;e &agrave; la houle du Pacifique, elle est barr&eacute;e, &agrave; quelques encablures du rivage et sur environ 80 kilom&egrave;tres, par deux &icirc;les dans le prolongement l&#39;une de l&#39;autre, North Stradbroke Island et South Stradbroke Island, le Sud de la derni&egrave;re nomm&eacute;e commen&ccedil;ant &agrave; l&#39;embouchure de la Nerang River.</p>\r\n\r\n<p>Cette configuration sur une tr&egrave;s longue distance, compl&eacute;t&eacute;e par un r&eacute;seau hydrographique relativement important, cr&eacute;e une sorte de vaste plan d&#39;eau abrit&eacute; qui a vraisemblablement &eacute;t&eacute; propice &agrave; l&#39;&eacute;tablissement, avant l&#39;arriv&eacute;e des Europ&eacute;ens, de groupes d&#39;aborig&egrave;nes chasseurs/cueilleurs/p&ecirc;cheurs.</p>\r\n\r\n<p>A la fin du XIX&egrave; si&egrave;cle divers points de peuplement europ&eacute;ens comme Nerang, Burleigh Heads ou Southport se cr&eacute;&egrave;rent au Sud de Brisbane, capitale de l&#39;Etat du Queensland. L&#39;existence de tr&egrave;s belles plages face &agrave; l&#39;oc&eacute;an et d&#39;un climat ensoleill&eacute; en ce point de la c&ocirc;te firent de cette r&eacute;gion, et en particulier de Southport, une destination touristique de proximit&eacute; pris&eacute;e des habitants de la capitale d&eacute;pourvue de telles ressources.<br />\r\nInitialement appel&eacute;e &quot;South Coast&quot;, la bande de terre s&#39;&eacute;tendant de Southport au Nord jusqu&#39;&agrave; la fronti&egrave;re avec l&#39;Etat du New South Wales au Sud connut une telle inflation des prix du foncier qu&#39;on commen&ccedil;a &agrave; l&#39;appeler &quot;Gold Coast&quot;, nom qui fut officialis&eacute; en 1958.</p>\r\n\r\n<p>La vocation touristique de la destination, qui b&eacute;n&eacute;ficie d&#39;un ensoleillement de plus de 300 jours &agrave; l&#39;ann&eacute;e, ne s&#39;est jamais d&eacute;mentie. Aujourd&#39;hui Gold Coast est la 6&egrave;me plus importante ville d&#39;Australie, et la premi&egrave;re en dehors de capitales d&#39;Etats. Sa population s&#39;&eacute;levait &agrave; 550 000 r&eacute;sidents en 2015, avec un accroissement annuel de pr&egrave;s de 2% sur les 10 derni&egrave;res ann&eacute;es (1&egrave;re d&#39;Australie). Elle re&ccedil;oit environ 12 millions de visiteurs chaque ann&eacute;e. C&#39;est l&#39;agglom&eacute;ration australienne poss&eacute;dant le plus fort d&eacute;veloppement, et un excellent choix pour les candidats &agrave; un investissement en Australie.</p>\r\n\r\n<p>La conurbation de la ville de Gold Coast s&#39;&eacute;tend du Nord au Sud sur environ 56 kilom&egrave;tres de Beenleigh &agrave; la fronti&egrave;re du New South Wales, et d&#39;Est en Ouest du front de mer au pied de la cha&icirc;ne du &quot;Great Dividing Range&quot;. Elle est constitu&eacute;e de diff&eacute;rentes entit&eacute;s administratives: &quot;suburbs&quot;, &quot;localities&quot;, &quot;towns&quot;, et &quot;rural districts&quot;. On parle indiff&eacute;remment de &quot;La Gold Coast&quot; ou plus simplement de &quot;Gold Coast&quot;. Son centre est distant d&#39;environ 80 km de Brisbane et de son a&eacute;roport international. Gold Coast poss&egrave;de cependant son propre a&eacute;roport international de Coolangatta qui pr&eacute;sente la particularit&eacute; d&#39;&ecirc;tre &agrave; cheval sur les territoires des deux Etats du Queensland et du New South Wales.</p>\r\n\r\n<p>Son climat est subtropical, avec 1 218 mm de pr&eacute;cipitations par an. Les temp&eacute;ratures diurnes moyennes en saison fraiche (juin &agrave; septembre) vont de 11&deg;C &agrave; 21&deg;C, et en saison chaude (novembre &agrave; mars) de 22&deg;C &agrave; 28&deg;C. La temp&eacute;rature de l&#39;oc&eacute;an quant &agrave; elle est de 21&deg;C en saison fraiche et de 27&deg;C en saison chaude. Gold Coast n&#39;&eacute;chappe pas aux spectaculaires et impressionnants orages du Queensland.</p>\r\n\r\n<p>Depuis une quarantaine d&#39;ann&eacute;es l&#39;activit&eacute; s&#39;est d&eacute;velopp&eacute;e &agrave; partir de &quot;Surfers Paradise&quot; o&ugrave; ont &eacute;t&eacute; construits la majorit&eacute; des gratte-ciel &quot;high rises&quot;. En 2006 la tour &quot;Q1&quot; (245 m&egrave;tre de hauteur pour 78 &eacute;tages) &eacute;tait encore la tour r&eacute;sidentielle la plus haute de l&#39;h&eacute;misph&egrave;re Sud.</p>\r\n\r\n<p>Gold Coast est jumel&eacute;e avec la ville fran&ccedil;aise de Noum&eacute;a en Nouvelle Cal&eacute;donie depuis 1992.</p>\r\n\r\n<p>La Gold Coast est une succession de plages magnifiques de longueurs et largeurs exceptionnelles o&ugrave;, &eacute;t&eacute; comme hiver, se pressent un grand nombre de surfeurs venus du monde entier pour chevaucher les vagues venues de la houle du Pacifique.</p>\r\n\r\n<p>La ville est travers&eacute;e par la Nerang River. A l&#39;origine, la zone &eacute;tant tr&egrave;s plate, cela avait cr&eacute;&eacute; de nombreux mar&eacute;cages insalubres. Les d&eacute;veloppeurs de la Gold Coast ont exploit&eacute; cette situation en remblayant les mar&eacute;cages tout en conservant et en cr&eacute;ant une multitude de chenaux, ce qui donne &agrave; une partie importante de la ville une identit&eacute; particuli&egrave;re, une sorte de &quot;Venise des mers du Sud&quot;.<br />\r\nSi le tourisme reste largement pr&eacute;dominant, Gold Coast a cependant vu se d&eacute;velopper d&#39;autres activit&eacute;s, pour l&#39;essentiel dans le secteur tertiaire. C&#39;est en particulier un p&ocirc;le d&#39;&eacute;ducation avec les universit&eacute;s de Griffith University et de Bond University, ainsi que les centres de formation des instituts du TAFE (Technical And Further Education).</p>\r\n\r\n<p>&quot;Investir en Australie&quot; vous propose des programmes immobiliers de premier rang sur la Gold Coast et met &agrave; votre disposition une &eacute;quipe compl&egrave;te de professionnels australiens francophones pouvant r&eacute;pondre &agrave; tous vos besoins dans votre d&eacute;marche d&#39;investissement.</p>', 'Gold Coast\r\nInvestir en Australie\r\nBrisbane', 'Gold Coast est l\'agglomération australienne possédant le plus fort développement. Son potentiel phénoménal en font un excellent choix pour investir en Australie.', 4, 9, 'published', 0, 'blog', 240, 1, '2021-09-06 22:09:25', '2021-09-06 22:38:57', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` int(50) NOT NULL,
  `blog_id` int(50) NOT NULL,
  `translation_id` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `blog_translations`
--

INSERT INTO `blog_translations` (`id`, `blog_id`, `translation_id`, `created_at`, `updated_at`) VALUES
(1, 19, 7, '2021-09-06 22:09:26', '2021-09-06 22:09:26');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_programm` int(10) NOT NULL COMMENT '0 = non, 1 = oui',
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`, `content`, `is_programm`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'residentiel', 'Residentiel', NULL, 1, 1, '2018-06-28 16:57:38', NULL, NULL),
(2, 'foncier', 'Foncier', NULL, 1, 1, '2018-06-28 16:57:38', NULL, NULL),
(3, 'industriel', 'Industriel', NULL, 0, 1, '2018-06-28 16:57:38', NULL, NULL),
(4, 'commercial', 'Commercial', NULL, 0, 1, '2018-06-28 16:57:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pinged',
  `votes` int(11) NOT NULL DEFAULT 0,
  `spam` int(11) NOT NULL DEFAULT 0,
  `reply_id` bigint(20) NOT NULL DEFAULT 0,
  `blog_id` bigint(20) NOT NULL DEFAULT 0,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `status`, `votes`, `spam`, `reply_id`, `blog_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Premier commentaire', 'pinged', 0, 0, 0, 4, 10, '2021-04-15 10:39:41', '2021-04-15 10:39:41', NULL),
(6, 'superbe article', 'pinged', 0, 0, 0, 8, 100, '2021-04-22 12:34:49', '2021-04-22 12:34:49', NULL),
(5, 'test commentaire', 'pinged', 0, 0, 0, 8, 1, '2021-04-22 11:30:48', '2021-04-22 11:30:48', NULL),
(7, 'oui je confirme', 'pinged', 0, 0, 5, 8, 100, '2021-04-22 12:45:33', '2021-04-22 12:45:33', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comment_spam`
--

CREATE TABLE `comment_spam` (
  `comment_id` bigint(20) NOT NULL DEFAULT 0,
  `user_id` bigint(20) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment_user_vote`
--

CREATE TABLE `comment_user_vote` (
  `comment_id` bigint(20) NOT NULL DEFAULT 0,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `vote` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `configs`
--

INSERT INTO `configs` (`id`, `name`, `content`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'site', 'Parametre global du site web', 1, '2018-06-28 13:57:38', NULL),
(2, 'social_network', 'Parametre des reseaux sociaux', 1, '2018-06-28 13:57:38', NULL),
(3, 'payment', 'Parametre du paiement en ligne', 1, '2018-06-28 13:57:38', NULL),
(4, 'style', 'Parametre de style CSS du site web', 1, '2018-06-28 13:57:38', NULL),
(5, 'login', 'Parametre de login', 1, '2018-06-28 13:57:38', NULL),
(6, 'smtp', 'Parametre de mail SMTP', 1, '2018-06-28 13:57:38', NULL),
(7, 'x_line', 'Toutes les \"x\" lignes apparaît une ligne d\'affichage aléatoire d\'un article du blog dans la page programme', 1, NULL, NULL),
(8, 'order_by', 'price', 1, '2021-04-11 18:00:00', '2021-04-11 18:00:00'),
(9, 'lia', 'Parametre LIA', 1, '2021-08-24 18:00:00', '2021-04-11 18:00:00'),
(10, 'iicc', 'Parametre IICC', 1, '2021-08-24 18:00:00', '2021-04-11 18:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `conjunction_agreements`
--

CREATE TABLE `conjunction_agreements` (
  `id` int(11) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `path` varchar(191) NOT NULL,
  `product_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conjunction_agreements`
--

INSERT INTO `conjunction_agreements` (`id`, `file_name`, `path`, `product_id`, `from_id`, `to_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CA-AFA-00000_1628748469.pdf', 'uploads/pdf/ca/CA-AFA-00000_1628748469.pdf', 21, 10, 6, 1, '2021-08-12 12:48:02', '2021-08-12 09:48:02');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `location_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefixPhone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeholder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `countries`
--

INSERT INTO `countries` (`id`, `code`, `content`, `prefixPhone`, `placeholder`, `created_at`, `updated_at`) VALUES
(1, 'AFG', 'Afghanistan', 'Afghanistan', 'afga', '2018-06-28 16:57:38', '2021-01-27 04:59:47'),
(2, 'ABW', 'Aruba', 'Aruba', 'ARUBA', '2018-06-28 16:57:38', '2021-01-27 04:13:32'),
(3, 'AGO', 'Angola', 'Angola', NULL, '2018-06-28 16:57:38', NULL),
(4, 'AIA', 'Anguilla', 'Anguilla', NULL, '2018-06-28 16:57:38', NULL),
(5, 'ALB', 'Albanie', 'Albanie', NULL, '2018-06-28 16:57:38', NULL),
(6, 'AND', 'Andorre', 'Andorre', 'andorre', '2018-06-28 16:57:38', '2021-01-27 04:22:29'),
(7, 'ARE', 'Émirats Arabes Unis', 'Émirats Arabes Unis', NULL, '2018-06-28 16:57:38', NULL),
(8, 'ARG', 'Argentine', 'Argentine', NULL, '2018-06-28 16:57:38', NULL),
(9, 'ARM', 'Arménie', 'Arménie', NULL, '2018-06-28 16:57:38', NULL),
(10, 'ASM', 'Samoa Américaines', 'Samoa Américaines', NULL, '2018-06-28 16:57:38', NULL),
(11, 'ATA', 'Antarctique', 'Antarctique', NULL, '2018-06-28 16:57:38', NULL),
(12, 'AUS', 'Australie', 'Australie', NULL, '2018-06-28 16:57:38', NULL),
(13, 'AUT', 'Autriche', 'Autriche', NULL, '2018-06-28 16:57:38', NULL),
(14, 'AZE', 'Azerbaïdjan', 'Azerbaïdjan', NULL, '2018-06-28 16:57:38', NULL),
(15, 'BDI', 'Burundi', 'Burundi', NULL, '2018-06-28 16:57:38', NULL),
(16, 'BEL', 'Belgique', 'Belgique', NULL, '2018-06-28 16:57:38', NULL),
(17, 'BEN', 'Bénin', 'Bénin', NULL, '2018-06-28 16:57:38', NULL),
(18, 'BFA', 'Burkina Faso', 'Burkina Faso', NULL, '2018-06-28 16:57:38', NULL),
(19, 'BGD', 'Bangladesh', 'Bangladesh', NULL, '2018-06-28 16:57:38', NULL),
(20, 'BGR', 'Bulgarie', 'Bulgarie', NULL, '2018-06-28 16:57:38', NULL),
(21, 'BHR', 'Bahreïn', 'Bahreïn', NULL, '2018-06-28 16:57:38', NULL),
(22, 'BHS', 'Bahamas', 'Bahamas', NULL, '2018-06-28 16:57:38', NULL),
(23, 'BIH', 'Bosnie-Herzégovine', 'Bosnie-Herzégovine', NULL, '2018-06-28 16:57:38', NULL),
(24, 'BLR', 'Bélarus', 'Bélarus', NULL, '2018-06-28 16:57:38', NULL),
(25, 'BLZ', 'Belize', 'Belize', NULL, '2018-06-28 16:57:38', NULL),
(26, 'BMU', 'Bermudes', 'Bermudes', NULL, '2018-06-28 16:57:38', NULL),
(27, 'BOL', 'Bolivie', 'Bolivie', NULL, '2018-06-28 16:57:38', NULL),
(28, 'BRA', 'Brésil', 'Brésil', NULL, '2018-06-28 16:57:38', NULL),
(29, 'BRB', 'Barbade', 'Barbade', NULL, '2018-06-28 16:57:38', NULL),
(30, 'BRN', 'Brunéi Darussalam', 'Brunéi Darussalam', NULL, '2018-06-28 16:57:38', NULL),
(31, 'BTN', 'Bhoutan', 'Bhoutan', NULL, '2018-06-28 16:57:38', NULL),
(32, 'BWA', 'Botswana', 'Botswana', NULL, '2018-06-28 16:57:38', NULL),
(33, 'CAF', 'République Centrafricaine', 'République Centrafricaine', NULL, '2018-06-28 16:57:38', NULL),
(34, 'CAN', 'Canada', 'Canada', NULL, '2018-06-28 16:57:38', NULL),
(35, 'CHE', 'Suisse', 'Suisse', NULL, '2018-06-28 16:57:38', NULL),
(36, 'CHL', 'Chili', 'Chili', NULL, '2018-06-28 16:57:38', NULL),
(37, 'CHN', 'Chine', 'Chine', NULL, '2018-06-28 16:57:38', NULL),
(38, 'CIV', 'Côte d\'Ivoire', 'Côte d\'Ivoire', NULL, '2018-06-28 16:57:38', NULL),
(39, 'CMR', 'Cameroun', 'Cameroun', NULL, '2018-06-28 16:57:38', NULL),
(40, 'COD', 'République Démocratique du Congo', 'République Démocratique du Congo', NULL, '2018-06-28 16:57:38', NULL),
(41, 'COG', 'République du Congo', 'République du Congo', NULL, '2018-06-28 16:57:38', NULL),
(42, 'COK', 'Îles Cook', 'Îles Cook', NULL, '2018-06-28 16:57:38', NULL),
(43, 'COL', 'Colombie', 'Colombie', NULL, '2018-06-28 16:57:38', NULL),
(44, 'COM', 'Comores', 'Comores', NULL, '2018-06-28 16:57:38', NULL),
(45, 'CPV', 'Cap-vert', 'Cap-vert', NULL, '2018-06-28 16:57:38', NULL),
(46, 'CRI', 'Costa Rica', 'Costa Rica', NULL, '2018-06-28 16:57:38', NULL),
(47, 'CUB', 'Cuba', 'Cuba', NULL, '2018-06-28 16:57:38', NULL),
(48, 'CYM', 'Îles Caïmanes', 'Îles Caïmanes', NULL, '2018-06-28 16:57:38', NULL),
(49, 'CYP', 'Chypre', 'Chypre', NULL, '2018-06-28 16:57:38', NULL),
(50, 'CZE', 'République Tchèque', 'République Tchèque', NULL, '2018-06-28 16:57:38', NULL),
(51, 'DEU', 'Allemagne', 'Allemagne', NULL, '2018-06-28 16:57:38', NULL),
(52, 'DJI', 'Djibouti', 'Djibouti', NULL, '2018-06-28 16:57:38', NULL),
(53, 'DMA', 'Dominique', 'Dominique', NULL, '2018-06-28 16:57:38', NULL),
(54, 'DNK', 'Danemark', 'Danemark', NULL, '2018-06-28 16:57:38', NULL),
(55, 'DOM', 'République Dominicaine', 'République Dominicaine', NULL, '2018-06-28 16:57:38', NULL),
(56, 'DZA', 'Algérie', 'Algérie', NULL, '2018-06-28 16:57:38', NULL),
(57, 'ECU', 'Équateur', 'Équateur', NULL, '2018-06-28 16:57:38', NULL),
(58, 'EGY', 'Égypte', 'Égypte', NULL, '2018-06-28 16:57:38', NULL),
(59, 'ERI', 'Érythrée', 'Érythrée', NULL, '2018-06-28 16:57:38', NULL),
(60, 'ESH', 'Sahara Occidental', 'Sahara Occidental', NULL, '2018-06-28 16:57:38', NULL),
(61, 'ESP', 'Espagne', 'Espagne', NULL, '2018-06-28 16:57:38', NULL),
(62, 'EST', 'Estonie', 'Estonie', NULL, '2018-06-28 16:57:38', NULL),
(63, 'ETH', 'Éthiopie', 'Éthiopie', NULL, '2018-06-28 16:57:38', NULL),
(64, 'FIN', 'Finlande', 'Finlande', NULL, '2018-06-28 16:57:38', NULL),
(65, 'FJI', 'Fidji', 'Fidji', NULL, '2018-06-28 16:57:38', NULL),
(66, 'FLK', 'Îles (malvinas) Falkland', 'Îles (malvinas) Falkland', NULL, '2018-06-28 16:57:38', NULL),
(67, 'FRA', 'France', 'France', NULL, '2018-06-28 16:57:38', NULL),
(68, 'FRO', 'Îles Féroé', 'Îles Féroé', NULL, '2018-06-28 16:57:38', NULL),
(69, 'FSM', 'États Fédérés de Micronésie', 'États Fédérés de Micronésie', NULL, '2018-06-28 16:57:38', NULL),
(70, 'GAB', 'Gabon', 'Gabon', NULL, '2018-06-28 16:57:38', NULL),
(71, 'GBR', 'Royaume-Uni', 'Royaume-Uni', NULL, '2018-06-28 16:57:38', NULL),
(72, 'GEO', 'Géorgie', 'Géorgie', NULL, '2018-06-28 16:57:38', NULL),
(73, 'GHA', 'Ghana', 'Ghana', NULL, '2018-06-28 16:57:38', NULL),
(74, 'GIB', 'Gibraltar', 'Gibraltar', NULL, '2018-06-28 16:57:38', NULL),
(75, 'GIN', 'Guinée', 'Guinée', NULL, '2018-06-28 16:57:38', NULL),
(76, 'GLP', 'Guadeloupe', 'Guadeloupe', NULL, '2018-06-28 16:57:38', NULL),
(77, 'GMB', 'Gambie', 'Gambie', NULL, '2018-06-28 16:57:38', NULL),
(78, 'GNB', 'Guinée-Bissau', 'Guinée-Bissau', NULL, '2018-06-28 16:57:38', NULL),
(79, 'GNQ', 'Guinée Équatoriale', 'Guinée Équatoriale', NULL, '2018-06-28 16:57:38', NULL),
(80, 'GRC', 'Grèce', 'Grèce', NULL, '2018-06-28 16:57:38', NULL),
(81, 'GRL', 'Groenland', 'Groenland', NULL, '2018-06-28 16:57:38', NULL),
(82, 'GTM', 'Guatemala', 'Guatemala', NULL, '2018-06-28 16:57:38', NULL),
(83, 'GUM', 'Guam', 'Guam', NULL, '2018-06-28 16:57:38', NULL),
(84, 'GUY', 'Guyana', 'Guyana', NULL, '2018-06-28 16:57:38', NULL),
(85, 'HKG', 'Hong-Kong', 'Hong-Kong', NULL, '2018-06-28 16:57:38', NULL),
(86, 'HND', 'Honduras', 'Honduras', NULL, '2018-06-28 16:57:38', NULL),
(87, 'HRV', 'Croatie', 'Croatie', NULL, '2018-06-28 16:57:38', NULL),
(88, 'HTI', 'Haïti', 'Haïti', NULL, '2018-06-28 16:57:38', NULL),
(89, 'HUN', 'Hongrie', 'Hongrie', NULL, '2018-06-28 16:57:38', NULL),
(90, 'IDN', 'Indonésie', 'Indonésie', NULL, '2018-06-28 16:57:38', NULL),
(91, 'IMN', 'Île de Man', 'Île de Man', NULL, '2018-06-28 16:57:38', NULL),
(92, 'IND', 'Inde', 'Inde', NULL, '2018-06-28 16:57:38', NULL),
(93, 'IRL', 'Irlande', 'Irlande', NULL, '2018-06-28 16:57:38', NULL),
(94, 'IRN', 'République Islamique d\'Iran', 'République Islamique d\'Iran', NULL, '2018-06-28 16:57:38', NULL),
(95, 'IRQ', 'Iraq', 'Iraq', NULL, '2018-06-28 16:57:38', NULL),
(96, 'ISL', 'Islande', 'Islande', NULL, '2018-06-28 16:57:38', NULL),
(97, 'ISR', 'Israël', 'Israël', NULL, '2018-06-28 16:57:38', NULL),
(98, 'ITA', 'Italie', 'Italie', NULL, '2018-06-28 16:57:38', NULL),
(99, 'JAM', 'Jamaïque', 'Jamaïque', NULL, '2018-06-28 16:57:38', NULL),
(100, 'JOR', 'Jordanie', 'Jordanie', NULL, '2018-06-28 16:57:38', NULL),
(101, 'JPN', 'Japon', 'Japon', NULL, '2018-06-28 16:57:38', NULL),
(102, 'KAZ', 'Kazakhstan', 'Kazakhstan', NULL, '2018-06-28 16:57:38', NULL),
(103, 'KEN', 'Kenya', 'Kenya', NULL, '2018-06-28 16:57:38', NULL),
(104, 'KGZ', 'Kirghizistan', 'Kirghizistan', NULL, '2018-06-28 16:57:38', NULL),
(105, 'KHM', 'Cambodge', 'Cambodge', NULL, '2018-06-28 16:57:38', NULL),
(106, 'KIR', 'Kiribati', 'Kiribati', NULL, '2018-06-28 16:57:38', NULL),
(107, 'KNA', 'Saint-Kitts-et-Nevis', 'Saint-Kitts-et-Nevis', NULL, '2018-06-28 16:57:38', NULL),
(108, 'KOR', 'République de Corée', 'République de Corée', NULL, '2018-06-28 16:57:38', NULL),
(109, 'KWT', 'Koweït', 'Koweït', NULL, '2018-06-28 16:57:38', NULL),
(110, 'LAO', 'République Démocratique Populaire Lao', 'République Démocratique Populaire Lao', NULL, '2018-06-28 16:57:38', NULL),
(111, 'LBN', 'Liban', 'Liban', NULL, '2018-06-28 16:57:38', NULL),
(112, 'LBR', 'Libéria', 'Libéria', NULL, '2018-06-28 16:57:38', NULL),
(113, 'LBY', 'Jamahiriya Arabe Libyenne', 'Jamahiriya Arabe Libyenne', NULL, '2018-06-28 16:57:38', NULL),
(114, 'LCA', 'Sainte-Lucie', 'Sainte-Lucie', NULL, '2018-06-28 16:57:38', NULL),
(115, 'LIE', 'Liechtenstein', 'Liechtenstein', NULL, '2018-06-28 16:57:38', NULL),
(116, 'LKA', 'Sri Lanka', 'Sri Lanka', NULL, '2018-06-28 16:57:38', NULL),
(117, 'LSO', 'Lesotho', 'Lesotho', NULL, '2018-06-28 16:57:38', NULL),
(118, 'LTU', 'Lituanie', 'Lituanie', NULL, '2018-06-28 16:57:38', NULL),
(119, 'LUX', 'Luxembourg', 'Luxembourg', NULL, '2018-06-28 16:57:38', NULL),
(120, 'LVA', 'Lettonie', 'Lettonie', NULL, '2018-06-28 16:57:38', NULL),
(121, 'MAC', 'Macao', 'Macao', NULL, '2018-06-28 16:57:38', NULL),
(122, 'MAR', 'Maroc', 'Maroc', NULL, '2018-06-28 16:57:38', NULL),
(123, 'MCO', 'Monaco', 'Monaco', NULL, '2018-06-28 16:57:38', NULL),
(124, 'MDA', 'République de Moldova', 'République de Moldova', NULL, '2018-06-28 16:57:38', NULL),
(125, 'MDG', 'Madagascar', 'Madagascar', NULL, '2018-06-28 16:57:38', NULL),
(126, 'MDV', 'Maldives', 'Maldives', NULL, '2018-06-28 16:57:38', NULL),
(127, 'MEX', 'Mexique', 'Mexique', NULL, '2018-06-28 16:57:38', NULL),
(128, 'MHL', 'Îles Marshall', 'Îles Marshall', NULL, '2018-06-28 16:57:38', NULL),
(129, 'MKD', 'L\'ex-République Yougoslave de Macédoine', 'L\'ex-République Yougoslave de Macédoine', NULL, '2018-06-28 16:57:38', NULL),
(130, 'MLI', 'Mali', 'Mali', NULL, '2018-06-28 16:57:38', NULL),
(131, 'MLT', 'Malte', 'Malte', NULL, '2018-06-28 16:57:38', NULL),
(132, 'MMR', 'Myanmar', 'Myanmar', NULL, '2018-06-28 16:57:38', NULL),
(133, 'MNG', 'Mongolie', 'Mongolie', NULL, '2018-06-28 16:57:38', NULL),
(134, 'MNP', 'Îles Mariannes du Nord', 'Îles Mariannes du Nord', NULL, '2018-06-28 16:57:38', NULL),
(135, 'MOZ', 'Mozambique', 'Mozambique', NULL, '2018-06-28 16:57:38', NULL),
(136, 'MRT', 'Mauritanie', 'Mauritanie', NULL, '2018-06-28 16:57:38', NULL),
(137, 'MSR', 'Montserrat', 'Montserrat', NULL, '2018-06-28 16:57:38', NULL),
(138, 'MUS', 'Maurice', 'Maurice', NULL, '2018-06-28 16:57:38', NULL),
(139, 'MWI', 'Malawi', 'Malawi', NULL, '2018-06-28 16:57:38', NULL),
(140, 'MYS', 'Malaisie', 'Malaisie', NULL, '2018-06-28 16:57:38', NULL),
(141, 'NAM', 'Namibie', 'Namibie', NULL, '2018-06-28 16:57:38', NULL),
(142, 'NCL', 'Nouvelle-Calédonie', 'Nouvelle-Calédonie', NULL, '2018-06-28 16:57:38', NULL),
(143, 'NER', 'Niger', 'Niger', NULL, '2018-06-28 16:57:38', NULL),
(144, 'NFK', 'Île Norfolk', 'Île Norfolk', NULL, '2018-06-28 16:57:38', NULL),
(145, 'NGA', 'Nigéria', 'Nigéria', NULL, '2018-06-28 16:57:38', NULL),
(146, 'NIC', 'Nicaragua', 'Nicaragua', NULL, '2018-06-28 16:57:38', NULL),
(147, 'NIU', 'Niué', 'Niué', NULL, '2018-06-28 16:57:38', NULL),
(148, 'NLD', 'Pays-Bas', 'Pays-Bas', NULL, '2018-06-28 16:57:38', NULL),
(149, 'NOR', 'Norvège', 'Norvège', NULL, '2018-06-28 16:57:38', NULL),
(150, 'NPL', 'Népal', 'Népal', NULL, '2018-06-28 16:57:38', NULL),
(151, 'NRU', 'Nauru', 'Nauru', NULL, '2018-06-28 16:57:38', NULL),
(152, 'NZL', 'Nouvelle-Zélande', 'Nouvelle-Zélande', NULL, '2018-06-28 16:57:38', NULL),
(153, 'OMN', 'Oman', 'Oman', NULL, '2018-06-28 16:57:38', NULL),
(154, 'PAK', 'Pakistan', 'Pakistan', NULL, '2018-06-28 16:57:38', NULL),
(155, 'PAN', 'Panama', 'Panama', NULL, '2018-06-28 16:57:38', NULL),
(156, 'PCN', 'Pitcairn', 'Pitcairn', NULL, '2018-06-28 16:57:38', NULL),
(157, 'PER', 'Pérou', 'Pérou', NULL, '2018-06-28 16:57:38', NULL),
(158, 'PHL', 'Philippines', 'Philippines', NULL, '2018-06-28 16:57:38', NULL),
(159, 'PLW', 'Palaos', 'Palaos', NULL, '2018-06-28 16:57:38', NULL),
(160, 'PNG', 'Papouasie-Nouvelle-Guinée', 'Papouasie-Nouvelle-Guinée', NULL, '2018-06-28 16:57:38', NULL),
(161, 'POL', 'Pologne', 'Pologne', NULL, '2018-06-28 16:57:38', NULL),
(162, 'PRI', 'Porto Rico', 'Porto Rico', NULL, '2018-06-28 16:57:38', NULL),
(163, 'PRK', 'République Populaire Démocratique de Corée', 'République Populaire Démocratique de Corée', NULL, '2018-06-28 16:57:38', NULL),
(164, 'PRT', 'Portugal', 'Portugal', NULL, '2018-06-28 16:57:38', NULL),
(165, 'PRY', 'Paraguay', 'Paraguay', NULL, '2018-06-28 16:57:38', NULL),
(166, 'PYF', 'Polynésie Française', 'Polynésie Française', NULL, '2018-06-28 16:57:38', NULL),
(167, 'QAT', 'Qatar', 'Qatar', NULL, '2018-06-28 16:57:38', NULL),
(168, 'REU', 'Réunion', 'Réunion', NULL, '2018-06-28 16:57:38', NULL),
(169, 'ROU', 'Roumanie', 'Roumanie', NULL, '2018-06-28 16:57:38', NULL),
(170, 'RUS', 'Fédération de Russie', 'Fédération de Russie', NULL, '2018-06-28 16:57:38', NULL),
(171, 'RWA', 'Rwanda', 'Rwanda', NULL, '2018-06-28 16:57:38', NULL),
(172, 'SAU', 'Arabie Saoudite', 'Arabie Saoudite', NULL, '2018-06-28 16:57:38', NULL),
(173, 'SDN', 'Soudan', 'Soudan', NULL, '2018-06-28 16:57:38', NULL),
(174, 'SEN', 'Sénégal', 'Sénégal', NULL, '2018-06-28 16:57:38', NULL),
(175, 'SGP', 'Singapour', 'Singapour', NULL, '2018-06-28 16:57:38', NULL),
(176, 'SHN', 'Sainte-Hélène', 'Sainte-Hélène', NULL, '2018-06-28 16:57:38', NULL),
(177, 'SLB', 'Îles Salomon', 'Îles Salomon', NULL, '2018-06-28 16:57:38', NULL),
(178, 'SLE', 'Sierra Leone', 'Sierra Leone', NULL, '2018-06-28 16:57:38', NULL),
(179, 'SLV', 'El Salvador', 'El Salvador', NULL, '2018-06-28 16:57:38', NULL),
(180, 'SMR', 'Saint-Marin', 'Saint-Marin', NULL, '2018-06-28 16:57:38', NULL),
(181, 'SOM', 'Somalie', 'Somalie', NULL, '2018-06-28 16:57:38', NULL),
(182, 'SPM', 'Saint-Pierre-et-Miquelon', 'Saint-Pierre-et-Miquelon', NULL, '2018-06-28 16:57:38', NULL),
(183, 'STP', 'Sao Tomé-et-Principe', 'Sao Tomé-et-Principe', NULL, '2018-06-28 16:57:38', NULL),
(184, 'SUR', 'Suriname', 'Suriname', NULL, '2018-06-28 16:57:38', NULL),
(185, 'SVK', 'Slovaquie', 'Slovaquie', NULL, '2018-06-28 16:57:38', NULL),
(186, 'SVN', 'Slovénie', 'Slovénie', NULL, '2018-06-28 16:57:38', NULL),
(187, 'SWE', 'Suède', 'Suède', NULL, '2018-06-28 16:57:38', NULL),
(188, 'SWZ', 'Swaziland', 'Swaziland', NULL, '2018-06-28 16:57:38', NULL),
(189, 'SYC', 'Seychelles', 'Seychelles', NULL, '2018-06-28 16:57:39', NULL),
(190, 'SYR', 'République Arabe Syrienne', 'République Arabe Syrienne', NULL, '2018-06-28 16:57:39', NULL),
(191, 'TGO', 'Togo', 'Togo', NULL, '2018-06-28 16:57:39', NULL),
(192, 'THA', 'Thaïlande', 'Thaïlande', NULL, '2018-06-28 16:57:39', NULL),
(193, 'TJK', 'Tadjikistan', 'Tadjikistan', NULL, '2018-06-28 16:57:39', NULL),
(194, 'TKL', 'Tokelau', 'Tokelau', NULL, '2018-06-28 16:57:39', NULL),
(195, 'TKM', 'Turkménistan', 'Turkménistan', NULL, '2018-06-28 16:57:39', NULL),
(196, 'TLS', 'Timor-Leste', 'Timor-Leste', NULL, '2018-06-28 16:57:39', NULL),
(197, 'TTO', 'Trinité-et-Tobago', 'Trinité-et-Tobago', NULL, '2018-06-28 16:57:39', NULL),
(198, 'TUN', 'Tunisie', 'Tunisie', NULL, '2018-06-28 16:57:39', NULL),
(199, 'TUR', 'Turquie', 'Turquie', NULL, '2018-06-28 16:57:39', NULL),
(200, 'TUV', 'Tuvalu', 'Tuvalu', NULL, '2018-06-28 16:57:39', NULL),
(201, 'TWN', 'Taïwan', 'Taïwan', NULL, '2018-06-28 16:57:39', NULL),
(202, 'TZA', 'République-Unie de Tanzanie', 'République-Unie de Tanzanie', NULL, '2018-06-28 16:57:39', NULL),
(203, 'UGA', 'Ouganda', 'Ouganda', NULL, '2018-06-28 16:57:39', NULL),
(204, 'UKR', 'Ukraine', 'Ukraine', NULL, '2018-06-28 16:57:39', NULL),
(205, 'URY', 'Uruguay', 'Uruguay', NULL, '2018-06-28 16:57:39', NULL),
(206, 'USA', 'États-Unis', 'États-Unis', NULL, '2018-06-28 16:57:39', NULL),
(207, 'UZB', 'Ouzbékistan', 'Ouzbékistan', NULL, '2018-06-28 16:57:39', NULL),
(208, 'VAT', 'Saint-Siège (état de la Cité du Vatican)', 'Saint-Siège (état de la Cité du Vatican)', NULL, '2018-06-28 16:57:39', NULL),
(209, 'VCT', 'Saint-Vincent-et-les Grenadines', 'Saint-Vincent-et-les Grenadines', NULL, '2018-06-28 16:57:39', NULL),
(210, 'VEN', 'Venezuela', 'Venezuela', NULL, '2018-06-28 16:57:39', NULL),
(211, 'VGB', 'Îles Vierges Britanniques', 'Îles Vierges Britanniques', NULL, '2018-06-28 16:57:39', NULL),
(212, 'VNM', 'Viet Nam', 'Viet Nam', NULL, '2018-06-28 16:57:39', NULL),
(213, 'VUT', 'Vanuatu', 'Vanuatu', NULL, '2018-06-28 16:57:39', NULL),
(214, 'WSM', 'Samoa', 'Samoa', NULL, '2018-06-28 16:57:39', NULL),
(215, 'YEM', 'Yémen', 'Yémen', NULL, '2018-06-28 16:57:39', NULL),
(216, 'ZAF', 'Afrique du Sud', 'Afrique du Sud', NULL, '2018-06-28 16:57:39', NULL),
(217, 'ZMB', 'Zambie', 'Zambie', NULL, '2018-06-28 16:57:39', NULL),
(218, 'ZWE', 'Zimbabwe', 'Zimbabwe', NULL, '2018-06-28 16:57:39', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `dossier_transactions`
--

CREATE TABLE `dossier_transactions` (
  `id` int(250) NOT NULL,
  `numero` varchar(9) NOT NULL,
  `user_id` int(191) NOT NULL,
  `product_id` int(191) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dossier_transactions`
--

INSERT INTO `dossier_transactions` (`id`, `numero`, `user_id`, `product_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 'RES-00001', 10, 21, 'current', '2021-08-04 09:29:38', '2021-08-04 09:29:38');

-- --------------------------------------------------------

--
-- Structure de la table `firbs`
--

CREATE TABLE `firbs` (
  `id` bigint(20) NOT NULL,
  `label` varchar(100) NOT NULL,
  `codePostal` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `firbs`
--

INSERT INTO `firbs` (`id`, `label`, `codePostal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sanctuary Cove', '4212', '2021-04-26 01:20:06', '2021-04-26 06:25:12', NULL),
(2, 'Hope Island Resort', '4212', '2021-04-26 06:26:40', '2021-05-12 22:52:41', NULL),
(3, 'Royal Pines Resort', '4217', '2021-04-26 06:27:18', '2021-05-12 22:53:17', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filemime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filepath` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `url`, `filename`, `filemime`, `filepath`, `author_id`, `created_at`, `updated_at`) VALUES
(1, '', '1.jpg', 'image/jpg', 'uploads/product/1.jpg', 1, '2018-06-28 13:57:36', NULL),
(2, '', '2.jpg', 'image/jpg', 'uploads/product/2.jpg', 1, '2018-06-28 13:57:36', NULL),
(3, '', '3.jpg', 'image/jpg', 'uploads/product/3.jpg', 1, '2018-06-28 13:57:36', NULL),
(4, '', '4.jpg', 'image/jpg', 'uploads/product/4.jpg', 1, '2018-06-28 13:57:36', NULL),
(5, '', '5.jpg', 'image/jpg', 'uploads/product/5.jpg', 1, '2018-06-28 13:57:36', NULL),
(6, '', '6.jpg', 'image/jpg', 'uploads/product/6.jpg', 1, '2018-06-28 13:57:36', NULL),
(7, '', '7.jpg', 'image/jpg', 'uploads/product/7.jpg', 1, '2018-06-28 13:57:36', NULL),
(8, '', '1.jpg', 'image/jpg', 'uploads/blog/1.jpg', 1, '2018-06-28 13:57:36', NULL),
(9, '', '2.jpg', 'image/jpg', 'uploads/blog/2.jpg', 1, '2018-06-28 13:57:36', NULL),
(10, '', '3.jpg', 'image/jpg', 'uploads/blog/3.jpg', 1, '2018-06-28 13:57:36', NULL),
(11, '', '1.jpg', 'image/jpg', 'carousel/1.jpg', 1, '2018-06-28 13:57:36', NULL),
(12, '', '2.jpg', 'image/jpg', 'carousel/2.jpg', 1, '2018-06-28 13:57:36', NULL),
(13, '', '3.jpg', 'image/jpg', 'carousel/3.jpg', 1, '2018-06-28 13:57:36', NULL),
(14, '', '1.jpg', 'image/jpg', 'uploads/slider/1.jpg', 1, '2018-06-28 13:57:36', NULL),
(15, '', '2.jpg', 'image/jpg', 'uploads/slider/2.jpg', 1, '2018-06-28 13:57:36', NULL),
(16, '', '3.jpg', 'image/jpg', 'uploads/slider/3.jpg', 1, '2018-06-28 13:57:36', NULL),
(17, '', '4.jpg', 'image/jpg', 'uploads/slider/pub/1.jpg', 1, '2018-06-28 13:57:36', NULL),
(18, '', '5.jpg', 'image/jpg', 'uploads/slider/pub/2.jpg', 1, '2018-06-28 13:57:36', NULL),
(19, '', '6.jpg', 'image/jpg', 'uploads/slider/6.jpg', 1, '2018-06-28 13:57:36', NULL),
(20, '', '7.jpg', 'image/jpg', 'uploads/slider/7.jpg', 1, '2018-06-28 13:57:36', NULL),
(21, '', '1.jpg', 'image/jpg', 'uploads/pub/1.jpg', 1, '2018-06-28 13:57:36', NULL),
(22, '', '2.jpg', 'image/jpg', 'uploads/pub/2.jpg', 1, '2018-06-28 13:57:36', NULL),
(23, '', '3.jpg', 'image/jpg', 'uploads/pub/3.jpg', 1, '2018-06-28 13:57:36', NULL),
(24, '', '4.jpg', 'image/jpg', 'uploads/pub/4.jpg', 1, '2018-06-28 13:57:36', NULL),
(25, '', '1.jpg', 'image/jpg', 'uploads/product/1.jpg', 1, '2018-06-28 13:57:36', NULL),
(26, '', '2.jpg', 'image/jpg', 'uploads/product/2.jpg', 1, '2018-06-28 13:57:36', NULL),
(27, '', '3.jpg', 'image/jpg', 'uploads/product/3.jpg', 1, '2018-06-28 13:57:36', NULL),
(28, '', '4.jpg', 'image/jpg', 'uploads/product/4.jpg', 1, '2018-06-28 13:57:36', NULL),
(29, NULL, '1c21fe6c2b6fa43fad7827d10f530a7a.png', 'image/png', 'uploads/app/1c21fe6c2b6fa43fad7827d10f530a7a.png', 0, '2018-07-01 06:41:44', '2021-04-22 05:47:23'),
(30, NULL, 'dd3442263be13155d880c9a03edfe3a7.png', 'image/png', 'uploads/app/dd3442263be13155d880c9a03edfe3a7.png', 0, '2018-07-12 19:08:24', '2021-04-22 05:47:23'),
(31, NULL, 'a4770531040e4e0cd72cd020fa0d19fb.jpg', 'image/jpeg', 'uploads/app/a4770531040e4e0cd72cd020fa0d19fb.jpg', 0, '2018-07-17 10:18:46', '2021-04-22 05:47:23'),
(32, NULL, '7e36c5d16ea913c7ec11ff62179db58a.png', 'image/png', 'uploads/app/7e36c5d16ea913c7ec11ff62179db58a.png', 0, '2019-03-20 08:00:37', '2021-04-22 05:47:23'),
(33, NULL, 'b0f3eef5282cce01d57f138fb21e0baa.jpg', 'image/jpeg', 'uploads/app/b0f3eef5282cce01d57f138fb21e0baa.jpg', 0, '2019-03-20 09:14:11', '2021-04-22 05:47:23'),
(34, NULL, 'd0e61f6cc1f25c3d695f74923e173c0a.jpg', 'image/jpeg', 'uploads/app/d0e61f6cc1f25c3d695f74923e173c0a.jpg', 0, '2020-03-04 01:28:44', '2021-04-22 05:47:23'),
(35, NULL, 'c3b77b335ac2d9e7886dca7c5565fa37.jpg', 'image/jpeg', 'uploads/app/c3b77b335ac2d9e7886dca7c5565fa37.jpg', 0, '2020-09-02 04:38:16', '2021-04-22 05:47:23'),
(36, NULL, 'adee3f8916b037bdd2f568b1671b0e09.png', 'image/png', 'uploads/app/adee3f8916b037bdd2f568b1671b0e09.png', 0, '2020-09-02 06:32:07', '2021-04-22 05:47:23'),
(37, NULL, 'dccd396189f595d46f44970e8dd59341.png', 'image/png', 'uploads/app/dccd396189f595d46f44970e8dd59341.png', 0, '2020-09-14 00:25:49', '2021-04-22 05:47:23'),
(38, NULL, '7ccee154d1b556da3a91ee12f46567c0.png', 'image/png', 'uploads/app/7ccee154d1b556da3a91ee12f46567c0.png', 0, '2020-09-14 01:30:54', '2021-04-22 05:47:23'),
(39, NULL, 'f6bc9f2e252587306e58ccb0ae38e122.png', 'image/png', 'uploads/app/f6bc9f2e252587306e58ccb0ae38e122.png', 0, '2020-09-14 01:42:28', '2021-04-22 05:47:23'),
(40, NULL, '94d2b5ebd15128c7210ae74dc46f2430.jpg', 'image/jpeg', 'uploads/app/94d2b5ebd15128c7210ae74dc46f2430.jpg', 0, '2020-09-30 02:04:19', '2021-04-22 05:47:23'),
(41, NULL, 'e1b830a55af690c6d33620ce439f20f6.jpg', 'image/jpeg', 'uploads/app/e1b830a55af690c6d33620ce439f20f6.jpg', 0, '2021-02-24 02:57:08', '2021-04-22 05:47:23'),
(42, NULL, '1e10388ced34f13e27692f02a79668f7.png', 'image/png', 'uploads/app/1e10388ced34f13e27692f02a79668f7.png', 0, '2021-02-24 02:57:57', '2021-04-22 05:47:23'),
(43, NULL, '957d3808b2c8048838265ac0807bf11f.jpg', 'image/jpeg', 'uploads/app/957d3808b2c8048838265ac0807bf11f.jpg', 0, '2021-02-25 00:41:56', '2021-04-22 05:47:23'),
(44, NULL, 'd92596f3d397e82347be509d5433f380.jpg', 'image/jpeg', 'uploads/app/d92596f3d397e82347be509d5433f380.jpg', 0, '2021-02-25 01:23:36', '2021-04-22 05:47:23'),
(116, NULL, '6.jpg', 'image/png', 'uploads/blog/d1475c142847e593a74f12a7c6a9447a.png', 0, '2021-04-16 03:12:16', '2021-04-16 03:12:16'),
(115, NULL, 'c054159d8ad5a644a0f1f4860e4c83d9.png', 'image/png', 'uploads/uploads/app/c054159d8ad5a644a0f1f4860e4c83d9.png', 0, '2021-04-16 02:34:31', '2021-04-22 05:47:23'),
(114, NULL, '8a3d3c4ecfcda0984b0b3c89b5f562e6.jpg', 'image/jpeg', 'uploads/uploads/app/8a3d3c4ecfcda0984b0b3c89b5f562e6.jpg', 0, '2021-04-16 02:31:11', '2021-04-22 05:47:23'),
(113, NULL, 'step4.png', 'image/png', 'images/page/step4.png', 1, '2021-03-05 05:37:55', '2021-03-05 05:37:55'),
(112, NULL, 'step3.png', 'image/png', 'images/page/step3.png', 1, '2021-03-05 05:37:55', '2021-03-05 05:37:55'),
(111, NULL, 'step2.png', 'image/png', 'images/page/step2.png', 1, '2021-03-05 05:37:55', '2021-03-05 05:37:55'),
(110, NULL, 'step1.png', 'image/png', 'images/page/step1.png', 1, '2021-03-05 05:37:55', '2021-03-05 05:37:55'),
(106, NULL, 'pub-1.png', 'image/png', 'images/pub/pub-1.png', 1, '2021-03-05 05:37:55', '2021-03-05 05:37:55'),
(107, NULL, 'pub-2.png', 'image/png', 'images/pub/pub-2.png', 1, '2021-03-05 05:37:55', '2021-03-05 05:37:55'),
(108, NULL, 'pub-3.png', 'image/png', 'images/pub/pub-3.png', 1, '2021-03-05 05:37:55', '2021-03-05 05:37:55'),
(109, NULL, 'map-of-australia.jpg', 'image/jpg', 'images/page/map-of-australia.jpg', 1, '2021-03-05 05:37:55', '2021-03-05 05:37:55'),
(105, NULL, '35cba3366e0fa9787bfdc0a6b14c7689.jpg', 'image/jpeg', 'uploads/app/35cba3366e0fa9787bfdc0a6b14c7689.jpg', 0, '2021-03-05 05:37:55', '2021-04-22 05:47:23'),
(104, NULL, 'f3b3de1a0ff34e756087532c4eabda48.jpg', 'image/jpeg', 'uploads/app/f3b3de1a0ff34e756087532c4eabda48.jpg', 0, '2021-03-02 23:58:12', '2021-04-22 05:47:23'),
(103, NULL, '0cc8aa78ddf49afbdc4838e43268ddf5.jpg', 'image/jpeg', 'uploads/app/0cc8aa78ddf49afbdc4838e43268ddf5.jpg', 0, '2021-03-02 00:51:12', '2021-04-22 05:47:23'),
(102, NULL, '9a50f887f65036fbcad94c1556599605.jpg', 'image/jpeg', 'uploads/app/9a50f887f65036fbcad94c1556599605.jpg', 0, '2021-03-02 00:22:16', '2021-04-22 05:47:23'),
(101, NULL, '26546e4877bca424f363ed447dd8bf04.jpg', 'image/jpeg', 'uploads/app/26546e4877bca424f363ed447dd8bf04.jpg', 0, '2021-03-02 00:18:27', '2021-04-22 05:47:23'),
(100, NULL, '7e9db59fa43779baffdf4278f08f1770.jpg', 'image/jpeg', 'uploads/app/7e9db59fa43779baffdf4278f08f1770.jpg', 0, '2021-03-02 00:17:10', '2021-04-22 05:47:23'),
(99, NULL, '4b0a709b2a09c10abf906b32208c9b60.jpg', 'image/jpeg', 'uploads/app/4b0a709b2a09c10abf906b32208c9b60.jpg', 0, '2021-03-02 00:13:57', '2021-04-22 05:47:23'),
(98, NULL, '8c2deadd692a35ec399b5f3291f0eedf.jpg', 'image/jpeg', 'uploads/app/8c2deadd692a35ec399b5f3291f0eedf.jpg', 0, '2021-03-02 00:10:32', '2021-04-22 05:47:23'),
(97, NULL, 'd887fd66ef883e8a3e94f3b8954c3091.jpg', 'image/jpeg', 'uploads/app/d887fd66ef883e8a3e94f3b8954c3091.jpg', 0, '2021-03-01 08:27:36', '2021-04-22 05:47:23'),
(96, NULL, '25e6cb446167ce48229ec0ba50a6f665.jpg', 'image/jpeg', 'uploads/app/25e6cb446167ce48229ec0ba50a6f665.jpg', 0, '2021-03-01 01:23:30', '2021-04-22 05:47:23'),
(117, NULL, '25a3719697755d5714f6626ffff71e6b.jpg', 'image/jpeg', 'uploads/uploads/app/25a3719697755d5714f6626ffff71e6b.jpg', 0, '2021-04-16 03:13:54', '2021-04-22 05:47:23'),
(118, '', 'iea.mp4', 'video/mp4', 'uploads/slider/video/iea.mp4', 1, '2018-06-28 13:57:36', NULL),
(119, '', 'iea1.mp4', 'video/mp4', 'uploads/slider/video/iea1.mp4', 1, '2018-06-28 13:57:36', NULL),
(120, NULL, 'da055d3b03311467fa240cd88905fe67.jpg', 'image/jpeg', 'uploads/product/da055d3b03311467fa240cd88905fe67.jpg', 0, '2021-04-22 11:17:13', '2021-04-22 11:17:13'),
(121, NULL, 'da055d3b03311467fa240cd88905fe67.jpg', 'image/jpeg', 'uploads/product/da055d3b03311467fa240cd88905fe67.jpg', 0, '2021-04-22 11:17:13', '2021-04-22 11:17:13'),
(122, NULL, '4a03e896c244dbcbbe65e127301cb703.mp4', 'video/mp4', 'uploads/slider/4a03e896c244dbcbbe65e127301cb703.mp4', 0, '2021-04-22 14:00:49', '2021-04-22 14:00:49'),
(123, NULL, '80b18612d77395aefc91e6f5c4a8f4b1.png', 'image/png', 'uploads/blog/80b18612d77395aefc91e6f5c4a8f4b1.png', 0, '2021-04-23 03:52:41', '2021-04-23 03:52:41'),
(124, NULL, 'f7a6f70c92a49852e76b9dd20646193e.jpg', 'image/jpeg', 'uploads/product/f7a6f70c92a49852e76b9dd20646193e.jpg', 0, '2021-04-23 04:54:21', '2021-04-23 04:54:21'),
(125, NULL, 'd84bd1f40ce982090cac4ef7be78a4ba.jpeg', 'image/jpeg', 'uploads/product/d84bd1f40ce982090cac4ef7be78a4ba.jpeg', 0, '2021-04-23 04:54:21', '2021-04-23 04:54:21'),
(126, NULL, '6ed4cc963b377dae501aa423763daad6.jpg', 'image/jpeg', 'uploads/product/6ed4cc963b377dae501aa423763daad6.jpg', 0, '2021-04-29 17:12:23', '2021-04-29 17:12:23'),
(127, NULL, '3ae6f10693567ba3ec7cb7ee20d1807d.jpg', 'image/jpeg', 'uploads/product/3ae6f10693567ba3ec7cb7ee20d1807d.jpg', 0, '2021-04-29 17:25:57', '2021-04-29 17:25:57'),
(128, NULL, 'bf142293c16ef9ee1a3886d69f6805b4.jpg', 'image/jpeg', 'uploads/product/bf142293c16ef9ee1a3886d69f6805b4.jpg', 0, '2021-04-29 17:25:57', '2021-04-29 17:25:57'),
(129, NULL, 'f41a470507a7d1674001ffbc84e76556.jpg', 'image/jpeg', 'uploads/product/f41a470507a7d1674001ffbc84e76556.jpg', 0, '2021-04-29 17:27:26', '2021-04-29 17:27:26'),
(130, NULL, 'e245247ee65bd21771145120f5c04515.jpg', 'image/jpeg', 'uploads/product/e245247ee65bd21771145120f5c04515.jpg', 0, '2021-04-29 17:27:50', '2021-04-29 17:27:50'),
(131, NULL, '65ba3493f760b2e960bf6616b0c65527.jpg', 'image/jpeg', 'uploads/product/65ba3493f760b2e960bf6616b0c65527.jpg', 0, '2021-04-29 17:27:50', '2021-04-29 17:27:50'),
(132, NULL, '2e11b6f693cdef3954c250151cb0de03.jpg', 'image/jpeg', 'uploads/product/2e11b6f693cdef3954c250151cb0de03.jpg', 0, '2021-04-29 17:28:41', '2021-04-29 17:28:41'),
(133, NULL, '79038d2f4e2cc81d863b3c9c4eeb79e3.jpg', 'image/jpeg', 'uploads/product/79038d2f4e2cc81d863b3c9c4eeb79e3.jpg', 0, '2021-04-29 17:28:41', '2021-04-29 17:28:41'),
(134, NULL, '595d81ac71922bd219bf559cae1af22b.jpg', 'image/jpeg', 'uploads/product/595d81ac71922bd219bf559cae1af22b.jpg', 0, '2021-05-04 12:09:07', '2021-05-04 12:09:07'),
(135, NULL, 'f8db2551dce2bff48b3b145f71aa79c3.jpg', 'image/jpeg', 'uploads/product/f8db2551dce2bff48b3b145f71aa79c3.jpg', 0, '2021-05-04 12:50:31', '2021-05-04 12:50:31'),
(136, NULL, 'd28472e4cbad9a1defb08291c19993ff.jpg', 'image/jpeg', 'uploads/product/d28472e4cbad9a1defb08291c19993ff.jpg', 0, '2021-05-05 05:05:34', '2021-05-05 05:05:34'),
(137, NULL, '182cf9bbbc3ad4ec7d89b536f80cb710.PNG', 'image/png', 'uploads/product/182cf9bbbc3ad4ec7d89b536f80cb710.PNG', 0, '2021-05-05 05:05:34', '2021-05-05 05:05:34'),
(138, NULL, '65a25bc263845fab801a15949ff11f32.jpg', 'image/jpeg', 'uploads/product/65a25bc263845fab801a15949ff11f32.jpg', 0, '2021-05-06 00:11:19', '2021-05-06 00:11:19'),
(139, NULL, '3123219bba602ed4a5d084c1ff4b4ff8.jpg', 'image/jpeg', 'uploads/product/3123219bba602ed4a5d084c1ff4b4ff8.jpg', 0, '2021-05-06 00:22:37', '2021-05-06 00:22:37'),
(140, NULL, 'b958dfe23548a80ec54c766f60d975ed.jpg', 'image/jpeg', 'uploads/product/b958dfe23548a80ec54c766f60d975ed.jpg', 0, '2021-05-06 01:30:58', '2021-05-06 01:30:58'),
(141, NULL, 'cc622ecc19b8cc508a8fa1c079794ef3.pdf', 'application/pdf', 'uploads/product/cc622ecc19b8cc508a8fa1c079794ef3.pdf', 0, '2021-05-07 04:00:42', '2021-05-07 04:00:42'),
(142, NULL, 'b1329ba996e33fb4919effd736a7e9fa.jpg', 'image/jpeg', 'uploads/product/b1329ba996e33fb4919effd736a7e9fa.jpg', 0, '2021-05-07 04:00:42', '2021-05-07 04:00:42'),
(143, NULL, '39cebca28862d29b67b2d7e1891b326d.pdf', 'application/pdf', 'uploads/product/39cebca28862d29b67b2d7e1891b326d.pdf', 0, '2021-05-10 12:57:51', '2021-05-10 12:57:51'),
(144, 'phoho-1620662209.jpg', 'phoho-1620662209.jpg', '', 'uploads/product/phoho-1620662209.jpg', 1, '2021-05-10 12:57:51', '2021-05-10 12:57:51'),
(145, 'photos (1)-1620662210.jpg', 'photos (1)-1620662210.jpg', '', 'uploads/product/photos (1)-1620662210.jpg', 1, '2021-05-10 12:57:51', '2021-05-10 12:57:51'),
(146, 'photo2-1620662211.jpg', 'photo2-1620662211.jpg', '', 'uploads/product/photo2-1620662211.jpg', 1, '2021-05-10 12:57:51', '2021-05-10 12:57:51'),
(147, NULL, 'd06e3bffa8cd6ac4fd45dab3359c0f2d.jpg', 'image/jpeg', 'uploads/product/d06e3bffa8cd6ac4fd45dab3359c0f2d.jpg', 0, '2021-05-10 12:57:51', '2021-05-10 12:57:51'),
(148, NULL, '2f20b2d3ff4c89caa15894dfa7cc4a53.jpg', 'image/jpeg', 'uploads/blog/2f20b2d3ff4c89caa15894dfa7cc4a53.jpg', 0, '2021-05-11 00:08:16', '2021-05-11 00:08:16'),
(149, NULL, '4db9d797636f073e4c9cbcdb97e943e3.jpg', 'image/jpeg', 'uploads/blog/4db9d797636f073e4c9cbcdb97e943e3.jpg', 0, '2021-05-12 23:42:12', '2021-05-12 23:42:12'),
(150, NULL, 'd667881bb10a80da24b1143551800458.jpg', 'image/jpeg', 'uploads/blog/d667881bb10a80da24b1143551800458.jpg', 0, '2021-05-13 00:06:55', '2021-05-13 00:06:55'),
(151, NULL, '691691d55d4ef1eb1f5023a2c813f8ab.jpg', 'image/jpeg', 'uploads/blog/691691d55d4ef1eb1f5023a2c813f8ab.jpg', 0, '2021-05-13 00:20:02', '2021-05-13 00:20:02'),
(152, NULL, '334fb274efd6dbfb0d0a0954563179df.pdf', 'application/pdf', 'uploads/product/334fb274efd6dbfb0d0a0954563179df.pdf', 0, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(153, 'Arbour - Bathroom-1621217620.jpg', 'Arbour - Bathroom-1621217620.jpg', '', 'uploads/product/Arbour - Bathroom-1621217620.jpg', 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(154, 'Arbour - Exterior 01-1621217621.jpg', 'Arbour - Exterior 01-1621217621.jpg', '', 'uploads/product/Arbour - Exterior 01-1621217621.jpg', 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(155, 'Arbour - Exterior 1-1621217623.jpg', 'Arbour - Exterior 1-1621217623.jpg', '', 'uploads/product/Arbour - Exterior 1-1621217623.jpg', 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(156, 'Arbour - Exterior 02-1621217624.jpg', 'Arbour - Exterior 02-1621217624.jpg', '', 'uploads/product/Arbour - Exterior 02-1621217624.jpg', 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(157, 'Arbour - Exterior 2-1621217627.jpg', 'Arbour - Exterior 2-1621217627.jpg', '', 'uploads/product/Arbour - Exterior 2-1621217627.jpg', 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(158, 'Arbour Residences Aerial with Pointers - medium-1621217762.jpg', 'Arbour Residences Aerial with Pointers - medium-1621217762.jpg', '', 'uploads/product/Arbour Residences Aerial with Pointers - medium-1621217762.jpg', 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(159, 'photos (7)-1621369899.jpg', 'photos (7)-1621369899.jpg', '', 'uploads/product/photos (7)-1621369899.jpg', 1, '2021-05-18 17:31:39', '2021-05-18 17:31:39'),
(160, NULL, '91f91476faa08ffb30b7ac9170347ce2.jpg', 'image/jpeg', 'uploads/product/91f91476faa08ffb30b7ac9170347ce2.jpg', 0, '2021-05-18 17:38:54', '2021-05-18 17:38:54'),
(161, 'CAM_GYM_final_02_16b-1621663985.jpg', 'CAM_GYM_final_02_16b-1621663985.jpg', '', 'uploads/product/CAM_GYM_final_02_16b-1621663985.jpg', 1, '2021-05-22 03:13:05', '2021-05-22 03:13:05'),
(162, 'Lanes building corner lookup-1621663986.jpg', 'Lanes building corner lookup-1621663986.jpg', '', 'uploads/product/Lanes building corner lookup-1621663986.jpg', 1, '2021-05-22 03:13:06', '2021-05-22 03:13:06'),
(163, 'Lanes building lookup-1621663986.jpg', 'Lanes building lookup-1621663986.jpg', '', 'uploads/product/Lanes building lookup-1621663986.jpg', 1, '2021-05-22 03:13:06', '2021-05-22 03:13:06'),
(164, 'LOUNGE_DARK_FINAL_16b_v3-1621663987.jpg', 'LOUNGE_DARK_FINAL_16b_v3-1621663987.jpg', '', 'uploads/product/LOUNGE_DARK_FINAL_16b_v3-1621663987.jpg', 1, '2021-05-22 03:13:07', '2021-05-22 03:13:07'),
(165, 'The Green park-1621664058.jpg', 'The Green park-1621664058.jpg', '', 'uploads/product/The Green park-1621664058.jpg', 1, '2021-05-22 03:14:18', '2021-05-22 03:14:18'),
(166, '122016 The Lanes Location Pointers to Aerial Low Res-1621664085.jpg', '122016 The Lanes Location Pointers to Aerial Low Res-1621664085.jpg', '', 'uploads/product/122016 The Lanes Location Pointers to Aerial Low Res-1621664085.jpg', 1, '2021-05-22 03:14:45', '2021-05-22 03:14:45'),
(167, 'Lanes building corner lookup-1621664086.jpg', 'Lanes building corner lookup-1621664086.jpg', '', 'uploads/product/Lanes building corner lookup-1621664086.jpg', 1, '2021-05-22 03:14:46', '2021-05-22 03:14:46'),
(168, 'Village DA-1621664115.jpg', 'Village DA-1621664115.jpg', '', 'uploads/product/Village DA-1621664115.jpg', 1, '2021-05-22 03:15:15', '2021-05-22 03:15:15'),
(169, 'The Lanes Retail Village - Laneway-1621664133.jpg', 'The Lanes Retail Village - Laneway-1621664133.jpg', '', 'uploads/product/The Lanes Retail Village - Laneway-1621664133.jpg', 1, '2021-05-22 03:15:33', '2021-05-22 03:15:33'),
(170, 'LOUNGE_DARK_FINAL_16b_v3-1621664185.jpg', 'LOUNGE_DARK_FINAL_16b_v3-1621664185.jpg', '', 'uploads/product/LOUNGE_DARK_FINAL_16b_v3-1621664185.jpg', 1, '2021-05-22 03:16:25', '2021-05-22 03:16:25'),
(171, 'CAM_GYM_final_02_16b-1621664189.jpg', 'CAM_GYM_final_02_16b-1621664189.jpg', '', 'uploads/product/CAM_GYM_final_02_16b-1621664189.jpg', 1, '2021-05-22 03:16:29', '2021-05-22 03:16:29'),
(172, NULL, '4b617991cb7b5217d9a6adf4edc4ef95.jpeg', 'image/jpeg', 'uploads/app/4b617991cb7b5217d9a6adf4edc4ef95.jpeg', 0, '2021-05-22 03:57:31', '2021-05-22 03:57:31'),
(173, 'photos (5)-1622184987.jpg', 'photos (5)-1622184987.jpg', '', 'uploads/product/photos (5)-1622184987.jpg', 1, '2021-05-28 03:56:27', '2021-05-28 03:56:27'),
(174, NULL, '960c6c5f1118f9776fdf8eba8b2b863c.jpg', 'image/jpeg', 'uploads/blog/960c6c5f1118f9776fdf8eba8b2b863c.jpg', 0, '2021-05-30 00:10:14', '2021-05-30 00:10:14'),
(175, NULL, '623063f61e46274b5e692cb2fac82814.jpg', 'image/jpeg', 'uploads/blog/623063f61e46274b5e692cb2fac82814.jpg', 0, '2021-05-30 00:45:45', '2021-05-30 00:45:45'),
(176, NULL, '1129d44db76eefba90414aef4c0f306c.jpg', 'image/jpeg', 'uploads/blog/1129d44db76eefba90414aef4c0f306c.jpg', 0, '2021-05-30 01:56:27', '2021-05-30 01:56:27'),
(177, NULL, 'f07de3b7115c1d1007fa6740162576fc.jpg', 'image/jpeg', 'uploads/blog/f07de3b7115c1d1007fa6740162576fc.jpg', 0, '2021-05-30 03:43:08', '2021-05-30 03:43:08'),
(178, NULL, '1e6506bc9e7530d8eaf12fc89918d9d8.jpg', 'image/jpeg', 'uploads/blog/1e6506bc9e7530d8eaf12fc89918d9d8.jpg', 0, '2021-05-30 04:15:58', '2021-05-30 04:15:58'),
(179, NULL, '289c5ec455c25b2f8a640d7b9ece6266.jpg', 'image/jpeg', 'uploads/blog/289c5ec455c25b2f8a640d7b9ece6266.jpg', 0, '2021-05-30 04:42:21', '2021-05-30 04:42:21'),
(180, NULL, '8d6309e50c88ce66b8d0bcef1a40cfed.jpg', 'image/jpeg', 'uploads/slider/8d6309e50c88ce66b8d0bcef1a40cfed.jpg', 0, '2021-06-04 03:55:14', '2021-06-04 03:55:14'),
(181, NULL, 'dcb75fb989c755ddb8e2a8ac8a1f261a.pdf', 'application/pdf', 'uploads/product/dcb75fb989c755ddb8e2a8ac8a1f261a.pdf', 0, '2021-06-11 05:06:15', '2021-06-11 05:06:15'),
(182, NULL, 'bc6c3373da38cc27963d76b553a0e83b.pdf', 'application/pdf', 'uploads/product/bc6c3373da38cc27963d76b553a0e83b.pdf', 0, '2021-06-11 05:09:50', '2021-06-11 05:09:50'),
(183, NULL, '274994ae86083b735be717abfbd18609.jpg', 'image/jpeg', 'uploads/product/274994ae86083b735be717abfbd18609.jpg', 0, '2021-06-11 05:21:14', '2021-06-11 05:21:14'),
(184, NULL, '32acd893fe0a00877aded7c50c0446b5.jpg', 'image/jpeg', 'uploads/app/32acd893fe0a00877aded7c50c0446b5.jpg', 0, '2021-06-14 10:24:38', '2021-06-14 10:24:38'),
(185, NULL, '874e8fd11ccaca07503ef75a05cf21f3.png', 'image/png', 'uploads/app/874e8fd11ccaca07503ef75a05cf21f3.png', 0, '2021-06-17 02:24:24', '2021-06-17 02:24:24'),
(186, NULL, 'e85591b3b47db34b192bcbf7ec02c7a7.pdf', 'application/pdf', 'uploads/product/e85591b3b47db34b192bcbf7ec02c7a7.pdf', 0, '2021-06-19 22:44:31', '2021-06-19 22:44:31'),
(187, 'dummy-1624347427.pdf', 'dummy-1624347427.pdf', '', 'uploads/product/dummy-1624347427.pdf', 1, '2021-06-22 04:37:07', '2021-06-22 04:37:07'),
(188, 'sample-1624347427.pdf', 'sample-1624347427.pdf', '', 'uploads/product/sample-1624347427.pdf', 1, '2021-06-22 04:37:07', '2021-06-22 04:37:07'),
(189, 'dummy(1)-1624347879.pdf', 'dummy(1)-1624347879.pdf', '', 'uploads/product/dummy(1)-1624347879.pdf', 1, '2021-06-22 04:44:39', '2021-06-22 04:44:39'),
(190, 'sample-1624347879.pdf', 'sample-1624347879.pdf', '', 'uploads/product/sample-1624347879.pdf', 1, '2021-06-22 04:44:39', '2021-06-22 04:44:39'),
(191, 'dummy-1624347880.pdf', 'dummy-1624347880.pdf', '', 'uploads/product/dummy-1624347880.pdf', 1, '2021-06-22 04:44:40', '2021-06-22 04:44:40'),
(192, 'dummy-1624347898.pdf', 'dummy-1624347898.pdf', '', 'uploads/product/dummy-1624347898.pdf', 1, '2021-06-22 04:44:58', '2021-06-22 04:44:58'),
(193, 'Lighthouse-1624348887.jpg', 'Lighthouse-1624348887.jpg', '', 'uploads/product/Lighthouse-1624348887.jpg', 1, '2021-06-22 05:01:27', '2021-06-22 05:01:27'),
(194, 'Lighthouse-1624458908.jpg', 'Lighthouse-1624458908.jpg', '', 'uploads/product/Lighthouse-1624458908.jpg', 1, '2021-06-23 11:35:08', '2021-06-23 11:35:08'),
(195, 'RETOUR IEA_Formulaire Seller by AFA_210623-1624459097.docx', 'RETOUR IEA_Formulaire Seller by AFA_210623-1624459097.docx', '', 'uploads/product/RETOUR IEA_Formulaire Seller by AFA_210623-1624459097.docx', 1, '2021-06-23 11:38:17', '2021-06-23 11:38:17'),
(196, '102025 The Lanes Res Fact Sheet English_MR-1624506500.pdf', '102025 The Lanes Res Fact Sheet English_MR-1624506500.pdf', '', 'uploads/product/102025 The Lanes Res Fact Sheet English_MR-1624506500.pdf', 1, '2021-06-24 00:48:20', '2021-06-24 00:48:20'),
(197, '102025 The Lanes Res Fact Sheet English_MR-1624506755.pdf', '102025 The Lanes Res Fact Sheet English_MR-1624506755.pdf', '', 'uploads/product/102025 The Lanes Res Fact Sheet English_MR-1624506755.pdf', 1, '2021-06-24 00:52:35', '2021-06-24 00:52:35'),
(198, '102025 The Lanes Res Fact Sheet English_MR-1624506963.pdf', '102025 The Lanes Res Fact Sheet English_MR-1624506963.pdf', '', 'uploads/product/102025 The Lanes Res Fact Sheet English_MR-1624506963.pdf', 1, '2021-06-24 00:56:03', '2021-06-24 00:56:03'),
(199, 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624506970.pdf', 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624506970.pdf', '', 'uploads/product/Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624506970.pdf', 1, '2021-06-24 00:56:10', '2021-06-24 00:56:10'),
(200, 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624507244.pdf', 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624507244.pdf', '', 'uploads/product/Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624507244.pdf', 1, '2021-06-24 01:00:44', '2021-06-24 01:00:44'),
(201, 'Rental Investment Report - The Lanes Tower 3b (B^0W) (1)-1624507257.pdf', 'Rental Investment Report - The Lanes Tower 3b (B^0W) (1)-1624507257.pdf', '', 'uploads/product/Rental Investment Report - The Lanes Tower 3b (B^0W) (1)-1624507257.pdf', 1, '2021-06-24 01:00:57', '2021-06-24 01:00:57'),
(202, 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508159.pdf', 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508159.pdf', '', 'uploads/product/Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508159.pdf', 1, '2021-06-24 01:15:59', '2021-06-24 01:15:59'),
(203, 'The Lanes Residences EOI & CC Authorisation-1624508178.pdf', 'The Lanes Residences EOI & CC Authorisation-1624508178.pdf', '', 'uploads/product/The Lanes Residences EOI & CC Authorisation-1624508178.pdf', 1, '2021-06-24 01:16:18', '2021-06-24 01:16:18'),
(204, 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508370.pdf', 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508370.pdf', '', 'uploads/product/Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508370.pdf', 1, '2021-06-24 01:19:30', '2021-06-24 01:19:30'),
(205, 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508507.pdf', 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508507.pdf', '', 'uploads/product/Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508507.pdf', 1, '2021-06-24 01:21:47', '2021-06-24 01:21:47'),
(206, 'The Lanes Residences EOI & CC Authorisation-1624508510.pdf', 'The Lanes Residences EOI & CC Authorisation-1624508510.pdf', '', 'uploads/product/The Lanes Residences EOI & CC Authorisation-1624508510.pdf', 1, '2021-06-24 01:21:50', '2021-06-24 01:21:50'),
(207, 'Rental Investment Report - The Lanes Tower 3b (B^0W) (1)-1624508511.pdf', 'Rental Investment Report - The Lanes Tower 3b (B^0W) (1)-1624508511.pdf', '', 'uploads/product/Rental Investment Report - The Lanes Tower 3b (B^0W) (1)-1624508511.pdf', 1, '2021-06-24 01:21:51', '2021-06-24 01:21:51'),
(208, 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508997.pdf', 'Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508997.pdf', '', 'uploads/product/Rental Investment Report - The Lanes Tower 3a (B&W) (1)-1624508997.pdf', 1, '2021-06-24 01:29:57', '2021-06-24 01:29:57'),
(209, 'Rental Investment Report - The Lanes Tower 3b (B^0W) (1)-1624509048.pdf', 'Rental Investment Report - The Lanes Tower 3b (B^0W) (1)-1624509048.pdf', '', 'uploads/product/Rental Investment Report - The Lanes Tower 3b (B^0W) (1)-1624509048.pdf', 1, '2021-06-24 01:30:48', '2021-06-24 01:30:48'),
(210, 'The Lanes Residences EOI & CC Authorisation-1624509144.pdf', 'The Lanes Residences EOI & CC Authorisation-1624509144.pdf', '', 'uploads/product/The Lanes Residences EOI & CC Authorisation-1624509144.pdf', 1, '2021-06-24 01:32:24', '2021-06-24 01:32:24'),
(211, '102025 The Lanes Res Fact Sheet English_MR-1624509218.pdf', '102025 The Lanes Res Fact Sheet English_MR-1624509218.pdf', '', 'uploads/product/102025 The Lanes Res Fact Sheet English_MR-1624509218.pdf', 1, '2021-06-24 01:33:38', '2021-06-24 01:33:38'),
(212, 'sample-1624597097.pdf', 'sample-1624597097.pdf', '', 'uploads/product/sample-1624597097.pdf', 1, '2021-06-25 01:58:17', '2021-06-25 01:58:17'),
(213, 'Fond de dossier-1624617477.docx', 'Fond de dossier-1624617477.docx', '', 'uploads/product/Fond de dossier-1624617477.docx', 1, '2021-06-25 07:37:57', '2021-06-25 07:37:57'),
(214, NULL, '135a205c2287f0bc086f02032a01e56c.jpg', 'image/jpeg', 'uploads/product/135a205c2287f0bc086f02032a01e56c.jpg', 0, '2021-06-26 01:03:31', '2021-06-26 01:03:31'),
(215, 'rose 1-1624999571.jpg', 'rose 1-1624999571.jpg', '', 'uploads/product/rose 1-1624999571.jpg', 1, '2021-06-29 17:46:11', '2021-06-29 17:46:11'),
(216, 'PREVISIONS IMMOBILIER CAPITALES 2019-2028-1624999618.png', 'PREVISIONS IMMOBILIER CAPITALES 2019-2028-1624999618.png', '', 'uploads/product/PREVISIONS IMMOBILIER CAPITALES 2019-2028-1624999618.png', 1, '2021-06-29 17:46:58', '2021-06-29 17:46:58'),
(217, 'WATERPOINT V - WATERFRONT-1624999708.jpg', 'WATERPOINT V - WATERFRONT-1624999708.jpg', '', 'uploads/product/WATERPOINT V - WATERFRONT-1624999708.jpg', 1, '2021-06-29 17:48:28', '2021-06-29 17:48:28'),
(218, NULL, '39628a51b52b4eb3f9bfcf3159b98068.jpg', 'image/jpeg', 'uploads/product/39628a51b52b4eb3f9bfcf3159b98068.jpg', 0, '2021-06-29 17:58:14', '2021-06-29 17:58:14'),
(219, NULL, 'fc1c54217d4bc476762822bed380db71.jpg', 'image/jpeg', 'uploads/product/fc1c54217d4bc476762822bed380db71.jpg', 0, '2021-06-29 17:58:17', '2021-06-29 17:58:17'),
(220, NULL, '3473a6aca43b850bfca95ab870eaa2fb.jpg', 'image/jpeg', 'uploads/product/3473a6aca43b850bfca95ab870eaa2fb.jpg', 0, '2021-06-29 18:01:06', '2021-06-29 18:01:06'),
(221, NULL, '272937008e2de822abcca55eb20e4fd9.jpg', 'image/jpeg', 'uploads/product/272937008e2de822abcca55eb20e4fd9.jpg', 0, '2021-07-08 15:47:56', '2021-07-08 15:47:56'),
(222, 'Looking_Up_at_Empire_State_Building-1628827993.jpg', 'Looking_Up_at_Empire_State_Building-1628827993.jpg', '', 'uploads/product/Looking_Up_at_Empire_State_Building-1628827993.jpg', 9, '2021-08-13 01:13:20', '2021-08-13 01:13:20'),
(223, 'melanie-dretvic-urtr9yiler0-unsplash-1628827994.jpg', 'melanie-dretvic-urtr9yiler0-unsplash-1628827994.jpg', '', 'uploads/product/melanie-dretvic-urtr9yiler0-unsplash-1628827994.jpg', 9, '2021-08-13 01:13:20', '2021-08-13 01:13:20'),
(224, 'Arborescence - FRONT OFFICE-1628827930.pdf', 'Arborescence - FRONT OFFICE-1628827930.pdf', '', 'uploads/product/Arborescence - FRONT OFFICE-1628827930.pdf', 9, '2021-08-13 01:13:20', '2021-08-13 01:13:20'),
(225, 'Vierge-1628827923.pdf', 'Vierge-1628827923.pdf', '', 'uploads/product/Vierge-1628827923.pdf', 9, '2021-08-13 01:13:20', '2021-08-13 01:13:20'),
(226, NULL, 'bd10238d700bf0ab1a9768928e0b3b49.jpg', 'image/jpeg', 'uploads/product/bd10238d700bf0ab1a9768928e0b3b49.jpg', 0, '2021-08-13 04:28:09', '2021-08-13 04:28:09'),
(227, NULL, '8a6f948d836ade9dc60067086690c957.jpg', 'image/jpeg', 'uploads/product/8a6f948d836ade9dc60067086690c957.jpg', 0, '2021-08-13 15:09:40', '2021-08-13 15:09:40'),
(228, 'Vierge-1628878121.pdf', 'Vierge-1628878121.pdf', '', 'uploads/product/Vierge-1628878121.pdf', 9, '2021-08-13 15:09:40', '2021-08-13 15:09:40'),
(229, 'MODELE - The Lanes Residences EOI & CC Authorisation-1628987214.pdf', 'MODELE - The Lanes Residences EOI & CC Authorisation-1628987214.pdf', '', 'uploads/product/MODELE - The Lanes Residences EOI & CC Authorisation-1628987214.pdf', 9, '2021-08-14 21:30:37', '2021-08-14 21:30:37'),
(230, 'WATERPOINT V - FACTSHEET-1628987422.pdf', 'WATERPOINT V - FACTSHEET-1628987422.pdf', '', 'uploads/product/WATERPOINT V - FACTSHEET-1628987422.pdf', 9, '2021-08-14 21:30:37', '2021-08-14 21:30:37'),
(231, '12 Apostles 2-1628987501.jpg', '12 Apostles 2-1628987501.jpg', '', 'uploads/product/12 Apostles 2-1628987501.jpg', 9, '2021-08-14 21:31:41', '2021-08-14 21:31:41'),
(232, 'EOI_The Lanes_FERRARI Toni-1628987545.pdf', 'EOI_The Lanes_FERRARI Toni-1628987545.pdf', '', 'uploads/product/EOI_The Lanes_FERRARI Toni-1628987545.pdf', 9, '2021-08-14 21:32:25', '2021-08-14 21:32:25'),
(233, '102025 The Lanes Res Fact Sheet English_MR-1628987594.pdf', '102025 The Lanes Res Fact Sheet English_MR-1628987594.pdf', '', 'uploads/product/102025 The Lanes Res Fact Sheet English_MR-1628987594.pdf', 9, '2021-08-14 21:33:14', '2021-08-14 21:33:14'),
(234, '20170102_153651-1628987797.jpg', '20170102_153651-1628987797.jpg', '', 'uploads/product/20170102_153651-1628987797.jpg', 9, '2021-08-14 21:36:37', '2021-08-14 21:36:37'),
(235, NULL, '9d3c5cf69a8926faf06cd0cd4d7b1184.jpg', 'image/jpeg', 'uploads/app/9d3c5cf69a8926faf06cd0cd4d7b1184.jpg', 0, '2021-08-19 21:17:25', '2021-08-19 21:17:25'),
(236, NULL, 'd04fa4100de9cba0989525d38cacfad8.png', 'image/png', 'uploads/app/d04fa4100de9cba0989525d38cacfad8.png', 0, '2021-08-19 21:25:42', '2021-08-19 21:25:42'),
(237, NULL, '379978fafda434db69706f3a698b67e1.jpg', 'image/jpeg', 'uploads/app/379978fafda434db69706f3a698b67e1.jpg', 0, '2021-08-30 21:17:15', '2021-08-30 21:17:15'),
(238, NULL, 'c8cf47a63defd2a27f4edb9ee344dc64.png', 'image/png', 'uploads/app/c8cf47a63defd2a27f4edb9ee344dc64.png', 0, '2021-08-31 20:07:50', '2021-08-31 20:07:50'),
(239, NULL, 'bd669da21883222b9b687f8430fc7377.jpg', 'image/jpeg', 'uploads/blog/bd669da21883222b9b687f8430fc7377.jpg', 0, '2021-09-06 22:09:25', '2021-09-06 22:09:25'),
(240, NULL, 'bac1d998d7a83bd53a5310ceb18a764c.jpg', 'image/jpeg', 'uploads/blog/bac1d998d7a83bd53a5310ceb18a764c.jpg', 0, '2021-09-06 22:38:35', '2021-09-06 22:38:35');

-- --------------------------------------------------------

--
-- Structure de la table `labels`
--

CREATE TABLE `labels` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'saved',
  `author_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `labels`
--

INSERT INTO `labels` (`id`, `label`, `author_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'starred', 1, 2, '2020-09-03 18:21:49', '2020-09-03 18:21:49'),
(2, 'starred', 10, 1, '2021-02-19 04:37:40', '2021-02-19 04:37:40'),
(3, 'starred', 10, 6, '2021-03-12 04:07:01', '2021-03-12 04:07:01'),
(4, 'starred', 10, 8, '2021-04-09 03:50:00', '2021-04-09 03:50:00'),
(5, 'starred', 10, 5, '2021-04-13 05:11:18', '2021-04-13 05:11:18'),
(10, 'starred', 10, 4, '2021-04-15 14:49:09', '2021-04-15 14:49:09'),
(11, 'starred', 1, 22, '2021-05-06 00:41:35', '2021-05-06 00:41:35');

-- --------------------------------------------------------

--
-- Structure de la table `localizations`
--

CREATE TABLE `localizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `formatted` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_level_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_level_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postalCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `altitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_rooms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_floor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adrphy_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adrpost_postal_box` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adrpost_locality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adrpost_postalCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adrpost_area_level_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adrpost_area_level_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adrpost_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_postal_box` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_locality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_postalCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_area_level_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `localizations`
--

INSERT INTO `localizations` (`id`, `formatted`, `country`, `area_level_1`, `area_level_2`, `locality`, `route`, `postalCode`, `longitude`, `latitude`, `altitude`, `building_name`, `route_number`, `num_rooms`, `num_floor`, `neighborhood`, `adrphy_country`, `adrpost_postal_box`, `adrpost_locality`, `adrpost_postalCode`, `adrpost_area_level_1`, `adrpost_area_level_2`, `adrpost_country`, `bank_postal_box`, `bank_locality`, `bank_postalCode`, `bank_area_level_1`, `bank_country`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'Carlton', 'AUS', 'State', 'Melbourne', 'Carlton', '', '6642', '144.967704', '-37.785368', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-06-28 13:57:38', NULL),
(2, 'Nouméa', 'NCL', 'France', 'Nouvelle Calédonie', 'Nouméa', NULL, '6642', '118.967588', '-25.792074', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-06-28 13:57:38', NULL),
(3, 'Ex Wanna', 'AUS', 'Western Australia', 'Western Australia', 'Ex Wanna', NULL, '6642', '116.810178', '-23.775014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-06-28 13:57:38', NULL),
(4, 'Kumarina', 'AUS', 'Western Australia', 'Meekatharra', 'Kumarina', 'Australie-Occidentale ', '6642', '119.161938', '-24.832582', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-06-28 13:57:38', NULL),
(5, 'Ilfracombe', 'AUS', 'Queensland', 'Région de Longreach', 'Ilfracombe', NULL, '4727', '144.381948', '-25.700026', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-06-28 13:57:38', NULL),
(6, 'Blair Athol State Forest', 'FRA', 'Paris', 'Port Adelaide Enfield', 'Blair Athol State Forest', 'Clermont QLD ', '4721', '147.426737', '-22.697269', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-06-28 13:57:38', NULL),
(160, NULL, '12', NULL, NULL, NULL, NULL, '0872', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 01:18:11', '2021-03-23 01:18:11'),
(13, '42 Edmund St, Moffat Beach QLD 4551, Australie', 'AUS', 'Queensland', 'Sunshine Coast Regional', 'Moffat Beach', '42 Edmund Street', '4551', '153.14172056863262', '-26.798777868456483', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-06-23 01:19:17', '2020-06-23 01:19:17'),
(18, 'Gurindji NT 0852, Australie', 'AUS', 'Northern Territory', 'Shire of Ngaanyatjarraku', 'Gurindji', 'Unnamed Road', '0852', '131.43046517371997', '-18.48585938248738', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-09-04 14:11:10', '2020-09-04 14:11:10'),
(7, 'Kumarina', 'AUS', 'Western Australia', 'Meekatharra', 'Kumarina', 'Australie-Occidentale ', '6642', '117.161938', '-24.732582', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-06-28 13:57:38', NULL),
(168, NULL, 'AUS', NULL, NULL, NULL, NULL, '0872', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 02:18:36', '2021-03-23 02:18:36'),
(167, NULL, 'AUS', NULL, NULL, NULL, NULL, '0872', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 02:06:43', '2021-03-23 02:06:43'),
(166, NULL, 'AUS', NULL, NULL, NULL, NULL, '0872', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 02:04:44', '2021-03-23 02:04:44'),
(165, NULL, 'AUS', NULL, NULL, NULL, NULL, '0872', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 02:04:44', '2021-03-23 02:04:44'),
(164, NULL, 'AUS', NULL, NULL, NULL, NULL, '0872', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 01:39:12', '2021-03-23 01:39:12'),
(163, NULL, 'AUS', NULL, NULL, NULL, NULL, '0872', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 01:36:28', '2021-03-23 01:36:28'),
(162, NULL, 'AUS', 'NT', NULL, 'Petermann', NULL, '0872', '131.044922', '-25.363882', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 01:30:09', '2021-03-23 01:30:09'),
(161, NULL, 'AUS', NULL, NULL, NULL, NULL, '4215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-03-23 01:27:28', '2021-03-23 01:27:28'),
(169, NULL, 'AUS', NULL, NULL, NULL, NULL, '4215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-15 12:05:36', '2021-04-15 12:05:36'),
(170, NULL, 'AUS', NULL, NULL, NULL, NULL, '4215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-16 08:16:11', '2021-04-16 08:16:11'),
(171, NULL, 'AUS', NULL, NULL, NULL, NULL, '4215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-04-22 12:12:49', '2021-04-22 12:12:49'),
(172, NULL, 'AUS', NULL, NULL, 'nomea', NULL, '4212', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-05-04 12:09:07', '2021-05-04 12:09:07'),
(173, NULL, 'AUS', NULL, NULL, 'nomea', NULL, '4212', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-05-04 12:50:31', '2021-05-04 12:50:31'),
(174, NULL, 'AUS', 'southport', NULL, 'gold coast', NULL, '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-05-05 05:05:34', '2021-06-29 17:52:33'),
(175, NULL, 'AUS', 'Mermaid Waters', NULL, 'Gold Coast', NULL, '4218', '153.41924', '-28.03588', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-05-06 00:11:19', '2021-06-29 17:53:36'),
(176, NULL, 'AUS', 'southport', NULL, 'gold coast', NULL, '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-05-07 04:00:42', '2021-06-29 17:58:32'),
(177, NULL, 'AUS', 'southport', NULL, 'gold coast', NULL, '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-05-10 12:57:51', '2021-06-29 18:01:24'),
(178, NULL, 'AUS', 'Southport', NULL, 'Gold Coast', NULL, '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(179, NULL, 'AUS', 'southport', NULL, 'gold coast', NULL, '4212', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-05-18 17:38:54', '2021-05-18 17:38:54'),
(180, NULL, 'AUS', '5', 'Carlton', 'Carlton', 'Carlton', '411', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-06-14 10:24:38', '2021-06-14 10:24:38'),
(181, NULL, 'AUS', NULL, NULL, 'gold coast', 'rue 15', '4215', NULL, NULL, NULL, 'Batiment 01', '01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4215', 'gold coast', '4215', NULL, '12', 0, '2021-06-17 02:24:24', '2021-06-17 02:24:24'),
(182, NULL, 'AUS', 'VIC', 'Ville de Glen Eira', 'Carlton', 'Carlton', '3053', NULL, NULL, NULL, NULL, '86', NULL, NULL, NULL, NULL, '4152', 'Carnegie', '3163', 'VIC', NULL, 'AUS', NULL, NULL, NULL, NULL, NULL, 0, '2021-06-21 08:35:46', '2021-06-21 08:35:46'),
(183, NULL, '12', 'southport', NULL, 'gold coast', NULL, '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-07-08 15:47:56', '2021-07-08 15:47:56'),
(184, NULL, '12', 'gold coast', NULL, 'athena', 'Gold goast 0265', '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-13 01:13:20', '2021-08-13 01:13:20'),
(185, NULL, '12', 'Ivato', NULL, 'Ivato', 'test', '105', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-13 04:28:09', '2021-08-13 04:28:09'),
(186, NULL, '12', 'Western Australia', NULL, 'gold coast', '7/146 marine parade', '4212', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-13 15:09:40', '2021-08-13 15:09:40'),
(187, NULL, '12', 'NORTH BONDI', NULL, 'SYDNEY', '25B Roscoe Street', '2026', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-14 04:24:27', '2021-08-15 01:47:32'),
(188, NULL, '12', 'North Bondi', NULL, 'Sydney', '25 B Roscoe Street', '2026', '150.437099', '-34.4468067', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-14 20:56:22', '2021-08-14 21:05:59'),
(189, NULL, '12', 'North Boundi', NULL, 'Sydney', '25 B Roscoe Street', '2026', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-14 21:00:17', '2021-08-14 21:00:17'),
(190, NULL, '12', 'BELLEVUE HILL', NULL, 'SYDNEY', '80 Bundarra Road', '2023', '151.2640491', '-33.8849827', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-14 21:30:37', '2021-08-15 01:49:11'),
(191, NULL, '12', 'BELLEVUE HILL', NULL, 'SYDNEY', '80 Bundarra Road', '2023', '151.2640491', '-33.8849827', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-14 21:49:41', '2021-08-14 22:02:18'),
(192, NULL, '12', 'Southport', NULL, 'Gold Coast', '12 Flaneghan avenue', '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-15 01:18:36', '2021-08-15 01:18:36'),
(193, NULL, '12', 'Southport', NULL, 'Gold Coast', '12 Flaneghan avenue', '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-15 01:19:52', '2021-08-15 01:19:52'),
(194, NULL, '12', 'North Bondi', NULL, 'Sydney', '25 B Roscoe Street', '2026', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-15 01:48:13', '2021-08-15 01:48:13'),
(195, NULL, '12', 'North Boundi', NULL, 'Sydney', '25 B Roscoe Street', '2026', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-15 01:48:30', '2021-08-15 01:48:30'),
(196, NULL, '12', 'BELLEVUE HILL', NULL, 'SYDNEY', '80 Bundarra Road', '2023', '151.2640491', '-33.8849827', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-15 01:49:33', '2021-08-15 01:49:33'),
(197, NULL, '12', 'Southport', NULL, 'Gold Coast', '12 Flaneghan avenue', '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-15 01:49:51', '2021-08-15 01:49:51'),
(198, NULL, '12', 'jksdhkjdhkjd', NULL, 'lkjlkjd', 'fjkkljd', '4215', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, '2021-08-15 20:35:43', '2021-08-15 20:35:43'),
(199, NULL, 'AUS', 'QLD', 'Gold Coast', 'Southport', 'Marine Parade', '4215', NULL, NULL, NULL, NULL, '138', '7', NULL, NULL, NULL, NULL, 'Southport', '4215', 'QLD', NULL, 'AUS', NULL, NULL, NULL, NULL, NULL, 0, '2021-08-19 21:17:25', '2021-08-19 21:17:25'),
(200, NULL, 'AUS', 'QLD', 'GOL COAST', 'SOUTHPORT', 'Marine Parade', '4215', NULL, NULL, NULL, NULL, '146', '7', NULL, NULL, NULL, NULL, 'SOUTHPORT', '4215', 'QLD', NULL, 'AUS', NULL, NULL, NULL, NULL, NULL, 0, '2021-08-24 01:40:15', '2021-08-24 01:40:15'),
(201, NULL, 'AUS', 'QLD', 'southport', 'gold cost', 'rue 15', '4215', NULL, NULL, NULL, 'Batiment 01', '213', '2', NULL, NULL, NULL, NULL, 'gold cost', '4215', 'QLD', NULL, 'AUS', NULL, NULL, NULL, NULL, NULL, 0, '2021-08-24 09:47:10', '2021-08-24 09:47:10'),
(202, NULL, 'AUS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-24 09:59:32', '2021-08-24 09:59:32'),
(203, NULL, 'AUS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2021-08-24 10:26:18', '2021-08-24 10:26:18'),
(204, NULL, 'AUS', 'QLD', 'Ville de Gold Coast', 'Southport', 'Marine Parade', '4215', NULL, NULL, NULL, NULL, '146', '7', NULL, NULL, NULL, NULL, 'Southport', '4215', 'QLD', NULL, 'AUS', NULL, NULL, NULL, NULL, NULL, 0, '2021-08-30 21:17:15', '2021-08-30 21:17:15');

-- --------------------------------------------------------

--
-- Structure de la table `mails`
--

CREATE TABLE `mails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copied_from` bigint(20) NOT NULL DEFAULT 0,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mails`
--

INSERT INTO `mails` (`id`, `subject`, `content`, `copied_from`, `status`, `sender_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', '<p>vsds</p>', 0, 'send', 10, '2018-07-01 09:27:21', '2021-02-18 04:41:06', NULL),
(2, 'sdmlk', 'mklmkm', 0, 'send', 10, '2018-07-01 09:28:32', '2018-07-01 09:28:32', NULL),
(3, 'sdnkl', 'mklmk', 0, 'send', 10, '2018-07-01 09:30:14', '2018-07-01 09:30:14', NULL),
(4, 'Test', 'ressr', 0, 'send', 10, '2018-07-01 09:31:46', '2018-07-01 09:31:46', NULL),
(5, 'a', 'sfvsd', 0, 'send', 10, '2018-07-01 09:34:35', '2018-07-01 09:34:35', NULL),
(6, 'dsmlkkm', 'kmkmkmk', 0, 'send', 10, '2018-07-01 09:45:22', '2018-07-01 09:45:22', NULL),
(7, 'Teste', 'Manjaa', 0, 'send', 10, '2018-07-02 02:49:21', '2018-07-02 02:49:21', NULL),
(8, 'Confirmation paiement abonnement', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 0, 'model', 1, '2020-09-14 02:21:51', '2020-09-14 02:21:51', NULL),
(9, 'test message vendeur', '<p>Bonjour, ceci est un message test,<br />\r\nne pas prendre en compte svp,<br />\r\n<br />\r\ntr&egrave;s cordialement</p>', 0, 'send', 1, '2020-09-14 02:28:05', '2020-09-14 02:28:05', NULL),
(10, 'test message afa', '<p>test message afa</p>', 0, 'send', 1, '2020-09-14 02:36:41', '2020-09-14 02:36:41', NULL),
(11, 'test message apl', 'test message apl', 0, 'send', 10, '2020-09-14 02:58:56', '2020-09-14 02:58:56', NULL),
(12, 'test message apl', 'bonjour\r\nvoici mon coordonnées\r\ntest@gmail.com', 0, 'send', 10, '2020-09-14 03:01:18', '2020-09-14 03:01:18', NULL),
(13, 'test message admin', 'test message admin', 0, 'send', 10, '2020-09-14 03:01:33', '2020-09-14 03:01:33', NULL),
(14, 'test message admin', '<p>test message admin</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>reponse</p>', 0, 'send', 1, '2020-09-14 03:02:23', '2020-09-14 03:02:23', NULL),
(15, 'test', '<p>mail</p>', 0, 'send', 1, '2021-04-16 01:41:13', '2021-04-16 01:41:13', NULL),
(16, 'Teste', '<p>mail bien re&ccedil;u, merci</p>', 0, 'send', 1, '2021-04-29 17:56:12', '2021-04-29 17:56:12', NULL),
(17, 'mail test', '<p>bonjour member</p>', 0, 'send', 1, '2021-05-07 01:46:49', '2021-05-07 01:46:49', NULL),
(18, 'notification', '<p>mail test seller</p>', 0, 'send', 1, '2021-06-11 02:57:32', '2021-06-11 02:57:32', NULL),
(19, 'test messagerie interne', '<p>message</p>', 0, 'send', 1, '2021-07-08 15:59:47', '2021-07-08 15:59:47', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `mails_template`
--

CREATE TABLE `mails_template` (
  `id` bigint(20) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `sujet_fr` varchar(255) NOT NULL,
  `template_fr` text NOT NULL,
  `sujet_en` varchar(255) NOT NULL,
  `template_en` text NOT NULL,
  `params` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mails_template`
--

INSERT INTO `mails_template` (`id`, `titre`, `sujet_fr`, `template_fr`, `sujet_en`, `template_en`, `params`, `created_at`, `updated_at`) VALUES
(1, 'Activation compte', 'Votre compte', '<p>Votre mot de passe est de</p>\r\n\r\n<p>Merci d&#39;utiliser notre application</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Salutaion</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>IEA</p>', 'Your account', '<p>Votre mot de passe est de</p>\r\n\r\n<p>Merci d&#39;utiliser notre application</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Salutaion</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>IEA</p>', '', '2021-07-05 05:06:11', '2021-07-05 02:15:00'),
(2, 'Mail pour Seller by AFA après création d', '{Nom AFA} – {Nom Programme}', '<p>{Date system} &ndash; {Heure system}</p>\r\n\r\n<p>Salut,</p>\r\n\r\n<p>Vous souhaitez inscrire sur le portail IEA le programme {Nom Programme} situ&eacute; &agrave; {Ville}, {Code Postal}, {Etat}.</p>\r\n\r\n<p>Le syst&egrave;me indique qu&#39;il n&#39;y a pas de programme similaire pr&eacute;c&eacute;demment enregistr&eacute;. Cependant, en ce qui concerne la publication de programmes, comme vous l&#39;avez d&eacute;j&agrave; &eacute;t&eacute; inform&eacute;, le portail applique une politique qui repose sur les trois principes suivants :</p>\r\n\r\n<p>- le propri&eacute;taire a une priorit&eacute; pour publier un programme ;<br />\r\n- un programme ne peut &ecirc;tre publi&eacute; sur le portail que par un seul annonceur ;<br />\r\n- une agence souhaitant publier un programme doit obtenir l&#39;accord pr&eacute;alable du propri&eacute;taire.</p>\r\n\r\n<p>Par cons&eacute;quent, conform&eacute;ment &agrave; la politique ci-dessus, nous allons consulter d&egrave;s maintenant le propri&eacute;taire de cet enregistrement de programme et de son accord pour renoncer &agrave; son droit de priorit&eacute; de publication.</p>\r\n\r\n<p>Le portail de l&#39;IEA s&#39;attend &agrave; recevoir la r&eacute;ponse du propri&eacute;taire dans les sept jours. Le portail de l&#39;IEA consacrera sept jours suppl&eacute;mentaires au traitement du dossier. Sans r&eacute;ponse du vendeur dans le premier d&eacute;lai de 7 jours, et apr&egrave;s le d&eacute;lai de traitement suppl&eacute;mentaire de 7 jours, la demande de publication sera accord&eacute;e &agrave; votre agence et le processus d&#39;inscription se poursuivra.</p>\r\n\r\n<p>Si l&#39;autorisation de publier est refus&eacute;e par le vendeur, le processus d&#39;inscription au programme en cours sera annul&eacute;.</p>\r\n\r\n<p>Proc&eacute;der ainsi garantit que le respect est rendu &agrave; chacun.</p>\r\n\r\n<p>Nous vous rappelons que vous vous &ecirc;tes de toute fa&ccedil;on engag&eacute; &agrave; obtenir l&#39;autorisation du propri&eacute;taire pour publier son programme sur le portail de l&#39;IEA.</p>\r\n\r\n<p>En attendant</p>\r\n\r\n<p>Avec nos meilleures salutations</p>\r\n\r\n<p>Investir en Australie</p>', '{Nom AFA} – {Nom Programme}', '<p>{Date system} &ndash; {Heure system}</p>\r\n\r\n<p>Hi,</p>\r\n\r\n<p>You want to register on IEA portal the program {Nom Programme} located at {Ville}, {Code Postal}, {Etat}.</p>\r\n\r\n<p>The system indicates that there is no similar program previously registered. However, regarding the publishing of programs, as you have already been advised, the portal applies a policy which is based on the following three principles:</p>\r\n\r\n<p>- the owner has a priority to publish a program;<br />\r\n- a program can only be published on the portal by a single advertiser;<br />\r\n- an agency wishing to publish a program must obtain the prior agreement of the owner.</p>\r\n\r\n<p>Therefore, according to the above policy, we are going to consult right now the owner about that program registration and their agreement to waive their priority right to publish.</p>\r\n\r\n<p>IEA portal expects to receive the owner&#39;s answer within seven days from now. IEA portal will spare an additional seven days to process the case. Without an answer from the seller within the first 7 day period, and after the additional 7 day processing period,the request to publish will be granted to your agency and the registration process will continue.</p>\r\n\r\n<p>Ifpermission to publish is denied by the seller, the current program registration process will be cancelled.</p>\r\n\r\n<p>Proceeding this way guarantees that respect is paid to everyone.</p>\r\n\r\n<p>We kindly remind you that anyway you previously committed to obtain the owner&#39;s permission to publish their program on IEA portal.</p>\r\n\r\n<p>In the meantime</p>\r\n\r\n<p>With our best regards</p>\r\n\r\n<p>Investir en Australie</p>', '{Nom AFA}, {Nom Programme}, {Date system}, {Heure system}, {Ville}, {Code Postal}, {Etat}', '2021-08-31 05:52:03', '2021-09-03 07:11:22'),
(3, 'Mail à l\'adresse du propriétaire qu\'a indiqué le Seller by AFA', 'Demande d\'agence pour la publication de votre programme immobilier sur le \"portail INVESTIR EN AUSTRALIE\"', '<p>{Date courante syst&egrave;me} &ndash; {Heure courante syst&egrave;me}</p>\r\n\r\n<p>Bonjour,</p>\r\n\r\n<p>&laquo; Investiren Australie &raquo; - Le syst&egrave;me IEA (Invest in Australia) est mis en place autour du portail https://investirenaustralie.com pour encourager et faciliter la prise de d&eacute;cision des investisseurs internationaux francophones. Le syst&egrave;me IEA travaille avec :<br />\r\n- les vendeurs qui acceptent de publier leurs biens sur le portail, ou de faire publier leurs biens par une agence immobili&egrave;re, gratuitement ;<br />\r\n- Agences Francophones Australiennes exp&eacute;riment&eacute;es - AFA (Agences Francophones Australiennes) &agrave; qui sont confi&eacute;es les op&eacute;rations de vente des propri&eacute;t&eacute;s ;<br />\r\n- un r&eacute;seau international d&#39;Agences Partenaires Locales &ndash; APL (Local Partner Agencies) implant&eacute;es dans les pays et territoires francophones &agrave; travers le monde, qui informent, conseillent et guident les Membres dans leurs d&eacute;cisions d&#39;investir en Australie.</p>\r\n\r\n<p>Le portail IEA valorise trop les Vendeurs, qui sont nos partenaires qui apportent des biens &agrave; vendre sur le portail, pour accepter l&#39;id&eacute;e que la valeur de leurs biens pourrait &ecirc;tre ternie par des publications identiques r&eacute;p&eacute;titives. Nous ne voulons pas que le portail de l&#39;IEA apparaisse comme un &quot;Grand Bazar&quot; o&ugrave; une m&ecirc;me propri&eacute;t&eacute; pourrait &ecirc;tre &eacute;galement publi&eacute;e par plusieurs agences.</p>\r\n\r\n<p>D&#39;autre part, nous souhaitons permettre au public de trouver facilement et rapidement &quot;son bien&quot;, ce qui pourrait &ecirc;tre plus difficile avec trop de fois les m&ecirc;mes biens apparaissant sur le portail.</p>\r\n\r\n<p>Le portail a donc mis en place les 3 principes suivants :<br />\r\n- le propri&eacute;taire a un droit prioritaire de publicit&eacute;, mais peut renoncer &agrave; son droit prioritaire de publication et autoriser une agence immobili&egrave;re &agrave; le faire ;<br />\r\n- un bien ne peut &ecirc;tre publi&eacute; sur le site que par un seul annonceur (propri&eacute;taire ou agence) ;<br />\r\n- une agence souhaitant publier un bien doit obtenir l&#39;accord pr&eacute;alable du propri&eacute;taire. Le portail de l&#39;IEA envoie &agrave; l&#39;adresse e-mail du propri&eacute;taire un message lui demandant de confirmer qu&#39;il renonce &agrave; son droit de priorit&eacute; de publication et qu&#39;il accepte que l&#39;agence effectue elle-m&ecirc;me la publication.</p>\r\n\r\n<p>L&#39;agence immobili&egrave;re {Nom AFA} a demand&eacute; au portail d&#39;enregistrer le programme {Nom Programme} situ&eacute; &agrave; {Ville}, {Code Postal}, {Etat} ils disent qu&#39;il s&#39;agit d&#39;un programme appartenant &agrave; votre entreprise.</p>\r\n\r\n<p>Ce message vous est envoy&eacute; pour vous assurer :<br />\r\n- le programme ci-dessus est le v&ocirc;tre ;<br />\r\n- vous savez que vous disposez d&#39;un droit prioritaire de publication GRATUITE de ce programme sur le portail de l&#39;IEA&nbsp;;<br />\r\n- vous renoncez &agrave; votre droit prioritaire de publier le programme et autorisez l&#39;agence immobili&egrave;re ci-dessus &agrave; le faire.</p>\r\n\r\n<p>Si vous refusez &agrave; l&#39;agence ci-dessus le droit de publier votre programme, nous vous serions reconnaissants d&#39;enregistrer votre entreprise sur le portail de l&#39;IEA et de publier vous-m&ecirc;me ledit programme.</p>\r\n\r\n<p>Le portail de l&#39;IEA attend votre r&eacute;ponse d&#39;ici sept jours. Sans r&eacute;ponse de votre part dans ce d&eacute;lai de sept jours, il sera consid&eacute;r&eacute; que vous avez confirm&eacute; avoir renonc&eacute; &agrave; votre droit prioritaire de publication et que vous avez donn&eacute; &agrave; l&#39;agence l&#39;autorisation de publier. Par cons&eacute;quent, la demande de publication de l&#39;agence immobili&egrave;re ci-dessus sera approuv&eacute;e.</p>\r\n\r\n<p>Nous sommes impatients de recevoir votre r&eacute;ponse dans les sept (7) prochains jours<br />\r\n- &agrave; notre adresse mail : admin@investirenaustralie.com<br />\r\n- par t&eacute;l&eacute;phone au +61 415 940 412.</p>\r\n\r\n<p>En attendant</p>\r\n\r\n<p>Avec nos meilleures salutations</p>\r\n\r\n<p>Investir en Australie</p>\r\n\r\n<p>&nbsp;</p>', 'Agency request for publishing your real estate program on \"INVESTIR EN AUSTRALIE portal\"', '<p>{Date courante syst&egrave;me} &ndash; {Heure courante syst&egrave;me}</p>\r\n\r\n<p>Hi,</p>\r\n\r\n<p>&quot;Investiren Australie&quot;- IEA (Invest in Australia) system is established around the https://investirenaustralie.com portal to encourage and facilitate decision-making by international Francophone investors.IEA system works with :<br />\r\n- sellers who agree to publish their properties on the portal, or to have their properties published by one real estate agency, free of charge;<br />\r\n- Experienced Agences Francophones Australiennes - AFA (Australian Francophone Agencies) to whom are entrusted the properties sales operations;<br />\r\n- an international network of Agences Partenaires Locales &ndash; APL (Local Partner Agencies) established in Francophone countries and territories around the world, who inform, advise and guide Members in their decisions to invest in Australia.</p>\r\n\r\n<p>IEA portal value too much the Sellers, who are our partners who bring properties for sale to the portal, to accept the idea that the value of their properties could be tarnished by repetitive identical publishings. We do not want IEA portal to appear as a &quot;Big Bazaar&quot; where a same property could be equally published by multiple agencies.</p>\r\n\r\n<p>On the other hand we want to make it simple for the public to find easily and quickly &quot;their property&quot;, which could be more difficult with too many times the same properties appearing on the portal.</p>\r\n\r\n<p>Therefore the portal has set up the following 3 principles :<br />\r\n- the owner has a priority right to advertise, but can waive their priority right to publishand give permission to one real estate agency to do so;<br />\r\n- a property can only be published on the site by a single advertiser (owner or agency);<br />\r\n- an agency wishing to publish a property must obtain the prior consent of the owner. IEA portal sends to the owner&#39;s email address a message asking the owner&#39;s confirmation that they waive their priority right to publish and that they agree to the agency doing the publication itself.</p>\r\n\r\n<p>{Nom AFA} real estate agency has asked the portal to register {Nom Programme} program located at {Ville}, {Code Postal}, {Etat} they say is a program belonging to your company.</p>\r\n\r\n<p>This message is sent to you to make sure :<br />\r\n-&nbsp;&nbsp; &nbsp;the above program is yours;<br />\r\n-&nbsp;&nbsp; &nbsp;you are aware that you have a priority right to publish that program on IEA portal, FREE OF CHARGE;<br />\r\n-&nbsp;&nbsp; &nbsp;you waive your priority right to publish the program and give permission to the above real estate agency to do so.</p>\r\n\r\n<p>If you deny the above agency the right to publish your program, we would appreciate you to register your company on IEA portal and to publish yourself the said program.</p>\r\n\r\n<p>IEA portal is expecting your answer within seven days from now. Without an answer from you within that seven day period, It will be considered that you have confirmed that you have waived your priority right to publish and that you have given the agency permission to publish. Therefore the above real estate agency&#39;s request to publish will be approved.</p>\r\n\r\n<p>We are looking forward to receiving your answer within the next seven (7) days<br />\r\n-&nbsp;&nbsp; &nbsp;at our email address : admin@investirenaustralie.com<br />\r\n-&nbsp;&nbsp; &nbsp;over the phone at +61 415 940 412.</p>\r\n\r\n<p>In the meantime</p>\r\n\r\n<p>With our best regards</p>\r\n\r\n<p>Investir en Australie</p>\r\n\r\n<p>&nbsp;</p>', '{Date courante syst&egrave;me}, {Heure courante syst&egrave;me}, {Nom AFA}, {Nom Programme}, {Ville}, {Code Postal}, {Etat}', '2021-09-02 05:44:21', '2021-09-03 07:12:01'),
(4, 'Premier message d\'alerte à l\'Administrateur (àprès 7 jours)', 'Message d\'alerte', '<p>&quot;Un courriel a &eacute;t&eacute; adress&eacute; le {Date du message au Vendeur} &agrave; {Nom Vendeur} concernant son programme {Nom Programme} situ&eacute; &agrave; {Ville}, {Code Postal}, {Etat}, pr&eacute;sent&eacute; par l&#39;AFA {Nom AFA}, pour s&#39;assurer qu&#39;il renonce &agrave; son droit prioritaire de publication et qu&#39;il donne son accord &agrave; l&#39;enregistrement dudit programme par l&#39;AFA.</p>\r\n\r\n<p>Merci de v&eacute;rifier l&#39;arriv&eacute;e de la r&eacute;ponse du Vendeur et de la mettre en application.&quot;</p>', 'Alert message', '<p>&quot;An email was sent on {Date du message au Vendeur} to {Nom Vendeur} regarding his program {Nom Programme} located at {Ville}, {Code Postal}, {Etat}, presented by AFA {Nom AFA}, to ensure that it renounces its priority publication right and that it gives its consent to the recording of the said program by the AFA.</p>\r\n\r\n<p>Please check the arrival of Seller&#39;s response and implement it. &quot;</p>', '', '2021-09-02 09:06:44', '2021-09-02 09:06:44'),
(5, 'Deuxième message d\'alerte de l\'Administrateur (après 14 jours)', 'Deuxième message d\'alerte', '<p>&quot;Un courriel a &eacute;t&eacute; adress&eacute; le {Date du message au Vendeur} &agrave; {Nom Vendeur} concernant son programme {Nom Programme}situ&eacute; &agrave; {Ville}, {Code Postal},{Etat}, pr&eacute;sent&eacute; par l&#39;AFA {Nom AFA}, pour s&#39;assurer qu&#39;il renonce &agrave; son droit prioritaire de publication et qu&#39;il donne son accord &agrave; l&#39;enregistrement dudit programme par l&#39;AFA. Le Vendeur disposait de 7 jours pour r&eacute;pondre.</p>\r\n\r\n<p>Merci de mettre en application la r&eacute;ponse du Vendeur.</p>\r\n\r\n<p>En l&#39;absence de r&eacute;ponse, il est consid&eacute;r&eacute; que le Vendeur a renonc&eacute; &agrave; son droit prioritaire de publication et qu&#39;il a donn&eacute; son autorisation &agrave; l&#39;AFA {Nom AFA} de publier le programme&quot;. Dans ce cas l&#39;Administrateur doit poursuivre sa v&eacute;rification des conditions d&#39;approbation du programme, et si tout est en ordre et conforme, approuver le programme.&quot;</p>', 'Second alert message', '<p>&quot;An email was sent on {Date du message au Vendeur} to {Nom Vendeur} regarding his program {Nom Programme} located at {Ville}, {Code Postal}, {Etat}, presented by AFA {Nom AFA}, to ensure that he waives his priority publication right and that he agrees to the recording of the said program by the AFA The Seller had 7 days to respond.</p>\r\n\r\n<p>Please implement Seller&#39;s response.</p>\r\n\r\n<p>In the absence of a response, it is considered that the Seller has waived his priority right of publication and that he has given his authorization to the AFA {Nom AFA} to publish the program. &quot;In this case the Administrator must continue to verify the conditions of program approval, and if everything is in order and in compliance, approve the program. &quot;</p>', '', '2021-09-02 09:15:11', '2021-09-02 09:15:11'),
(6, 'Alerte à l\'Administrateur signalant qu\'un programme est en attente d\'approbation', 'Programme est en attente d\'approbation', '<p>&quot;Le Vendeur&quot; {Nom du Vendeur} souhaite enregistrer son programme {Nom Programme} situ&eacute; &agrave; {Ville}, {Etat}.</p>\r\n\r\n<p>Cependant il n&#39;y a pas d&#39;AFA enregistr&eacute; dans la zone o&ugrave; est situ&eacute; ce produit.</p>\r\n\r\n<p>Un message a &eacute;t&eacute; adress&eacute; au Vendeur pour lui signaler cette difficult&eacute;.</p>\r\n\r\n<p>Il lui a &eacute;t&eacute; indiqu&eacute; que le portail IEA fera tous les efforts possibles pour&nbsp; trouver au cours des 30 prochains jours une agence r&eacute;pondant aux crit&egrave;res de s&eacute;lection du portail dans la zone consid&eacute;r&eacute;e.</p>\r\n\r\n<p>Il lui a &eacute;t&eacute; &eacute;galement sugg&eacute;r&eacute;, si elle avait connaissance d&#39;une agence aux comp&eacute;tences francophones dans la zone, d&#39;inviter cette agence &agrave; contacter le portail IEA &agrave; l&#39;adresse admin@investirenaustralie.com.&quot;</p>', 'Program is pending approval', '<p>&quot;The Vendor&quot; {Nom du Vendeur} wishes to register his program {Nom Programme} located in {Ville}, {Etat}.</p>\r\n\r\n<p>However, there is no AFA registered in the area where this product is located.</p>\r\n\r\n<p>A message was sent to the Seller to inform him of this difficulty.</p>\r\n\r\n<p>He was told that the IEA portal will make every effort to find an agency within the next 30 days that meets the portal&#39;s selection criteria in the area under consideration.</p>\r\n\r\n<p>It was also suggested to her, if she was aware of an agency with French-speaking skills in the area, to invite this agency to contact the IEA portal at admin@investirenaustral.com. &quot;</p>\r\n\r\n<p>&nbsp;</p>', '', '2021-09-02 10:31:53', '2021-09-02 10:34:54'),
(7, 'Message au Vendeur lui signalant le problème de l\'absence d\'AFA', 'Absence d\'AFA', '<p>{Date syst&egrave;me} - {Heure syst&egrave;me}</p>\r\n\r\n<p>Bonjour,</p>\r\n\r\n<p>Tout bien qu&#39;un Vendeur souhaite publier sur le portail &laquo; Investir en australie &raquo; (IEA) doit passer par une proc&eacute;dure d&#39;approbation par l&#39;Administrateur, notamment pour v&eacute;rifier que le portail dispose d&#39;un partenaire &laquo; Agence Francophone Australienne &raquo; (AFA) dans le domaine immobilier et que la commission de vente propos&eacute;e par le Vendeur est acceptable.</p>\r\n\r\n<p>Maintenant, concernant la propri&eacute;t&eacute; que vous enregistrez actuellement, le portail IEA n&#39;a pas de partenaire AFA dans la r&eacute;gion o&ugrave; se trouve la propri&eacute;t&eacute;. Comme IEA system s&#39;engage &agrave; fournir un service en fran&ccedil;ais tout au long du processus d&#39;achat &agrave; ses membres francophones, il ne nous est pas possible d&#39;enregistrer votre propri&eacute;t&eacute; pour le moment.</p>\r\n\r\n<p>Au cours des 30 prochains jours, nous ferons de notre mieux pour trouver un tel AFA dans la m&ecirc;me zone o&ugrave; se trouve votre propri&eacute;t&eacute;.</p>\r\n\r\n<p>Cependant, si vous connaissiez vous-m&ecirc;me un agent immobilier / courtier d&#39;affaires dans cette r&eacute;gion avec une capacit&eacute; francophone, que vous consid&eacute;rez capable de prendre en charge la vente de votre propri&eacute;t&eacute;, veuillez lui sugg&eacute;rer de contacter le portail IEA &agrave; l&#39;adresse <strong>admin@investenaustralia.com</strong>. Nous serions ravis de discuter avec eux et de voir s&#39;ils peuvent s&#39;inscrire en tant qu&#39;AFA sur le portail de l&#39;IEA. Si vous le faites, veuillez demander &agrave; cette agence d&#39;&eacute;crire dans l&#39;objet de son message en majuscules&nbsp;: <strong>&laquo;&nbsp;AGENCE INT&Eacute;RESS&Eacute;E PAR {NOM PROGRAMME} PROPRI&Eacute;T&Eacute; AUTONOME&nbsp;&raquo;</strong> car nous sommes (probablement&nbsp;!) Trop rapides &agrave; supprimer le nombre croissant de ce que nous voyons comme des messages ind&eacute;sirables et des spams sur Internet.</p>\r\n\r\n<p>Si un nouvel AFA est enregistr&eacute; dans la zone de propri&eacute;t&eacute; dans les 30 prochains jours, le processus d&#39;enregistrement se poursuivra automatiquement et l&#39;administrateur v&eacute;rifiera les autres d&eacute;tails du programme. Mais si, &agrave; l&#39;issue de ce d&eacute;lai de 30 jours, aucune nouvelle agence n&#39;a &eacute;t&eacute; enregistr&eacute;e dans la zone immobili&egrave;re, la proc&eacute;dure d&#39;enregistrement de la propri&eacute;t&eacute; sera totalement annul&eacute;e. Vous seriez avis&eacute; d&#39;une telle annulation.</p>\r\n\r\n<p>Pour votre information, en ce qui concerne le taux de commission de vente, le portail n&#39;accepte en principe pas de taux de commission de vente inf&eacute;rieur &agrave; 5% concernant les biens standards, &agrave; l&#39;exception des biens nettement sup&eacute;rieurs au march&eacute; standard. Le plus souvent, les vendeurs proposent un taux de 6% + TPS lorsqu&#39;il s&#39;agit de ventes internationales, pour tenir compte de leurs co&ucirc;ts de prospection plus &eacute;lev&eacute;s, ce qui est le cas pour la client&egrave;le du portail IEA.</p>\r\n\r\n<p>Les propri&eacute;t&eacute;s offrant un taux de commission de vente sup&eacute;rieur &agrave; 6% + TPS b&eacute;n&eacute;ficient d&#39;un traitement d&#39;affichage sp&eacute;cial &quot;mise en avant&quot;.</p>\r\n\r\n<p>Les tarifs ci-dessus sont susceptibles d&#39;&ecirc;tre modifi&eacute;s par l&#39;Administrateur.</p>\r\n\r\n<p>En attendant,</p>\r\n\r\n<p>Avec nos meilleures salutations</p>\r\n\r\n<p>Investir en Australie</p>', 'Absence of AFA', '<p>{Date syst&egrave;me} - {Heure syst&egrave;me}</p>\r\n\r\n<p>Hi,</p>\r\n\r\n<p>Every property a Seller wants to publish on &quot;Investir en Australie&quot; (IEA) portal must go through an approval procedure by the Administrator, especially for checking that the portal has an &quot;Australian Francophone Agency&quot; (AFA) partner in the property area and that the sales commission the Seller has proposed is acceptable.</p>\r\n\r\n<p>Now, regarding the property you are currently registering, IEA portal does not have an AFA partner in the area where the property is located. As IEA system is committed to deliver a service in French all along the purchasing process to its French speaking Members, it is not possible for us to register your property for the moment.</p>\r\n\r\n<p>In the next 30 days we are going to tryour best to find such an AFA in the same area where your property is located.</p>\r\n\r\n<p>However, if you knew yourself about a real estate agent / business broker in that area with a Francophone capacity, who you consider is capable of taking care of the sale of your property, please do suggest them to contact IEA portal at <strong>admin@investirenaustralie.com</strong>. We would be delighted to talk with them and see if they can register as an AFA on IEA portal. If you do so, please ask that agency to write in their message subject in capital letters : <strong>&quot;AGENCY INTERESTED IN {NOM PROGRAMME} STAND-ALONE PROPERTY&quot;</strong> as we are (probably !) too quick in deleting the increasing number of what we see as junk and spam messages on the internet.</p>\r\n\r\n<p>If a new AFA is registered in the property area within the next 30 days, the registering process will automatically continue and the Administrator will check the other program details. But if, at the end of that 30 day period, no new agency has been registered in the property area, the property registration procedure will be completely cancelled. You would be advised of such a cancellation.</p>\r\n\r\n<p>For your information, as far as sales commission rate is concerned, the portal does not in principle accept sales commission rates under 5% regarding the standard properties, with the exception of properties significantly above the standard market. Most often, sellers offer a 6% + GST rate when it comes to international sales, to take into account their higher prospecting costs, which is the case for IEA portal clientele.</p>\r\n\r\n<p>Properties offering a sales commission rate above 6% + GST get a special &quot;put forward&quot; display treatment.</p>\r\n\r\n<p>The above rates are subjects to modifications by the Administrator.</p>\r\n\r\n<p>In the meantime,</p>\r\n\r\n<p>With our best regards</p>\r\n\r\n<p>Investir en Australie</p>', '', '2021-09-02 10:53:23', '2021-09-02 10:53:23'),
(8, 'Si dans les 30 jours aucune nouvelle AFA ne s\'est enregistrée', 'AFA ne s\'est enregistrée', '<p>{Date syst&egrave;me} &ndash; {Heure syst&egrave;me}</p>\r\n\r\n<p>Bonjour,</p>\r\n\r\n<p>Suite &agrave; notre message pr&eacute;c&eacute;dent concernant l&#39;enregistrement du programme {Nom Programme}, nous avons le regret de vous annoncer que nous n&#39;avons pas pu trouver d&#39;agence immobili&egrave;re/courtier commercial dans la zone du programme qui aurait pu correspondre aux exigences du portail IEA concernant la capacit&eacute; francophone.</p>\r\n\r\n<p><u>L&#39;enregistrement du programme en cours est donc rejet&eacute;.</u></p>\r\n\r\n<p>Avec nos meilleures salutations</p>\r\n\r\n<p>Investir en Australie</p>', 'AFA did not register', '<p>{Date syst&egrave;me} &ndash; {Heure syst&egrave;me}</p>\r\n\r\n<p>Hi,</p>\r\n\r\n<p>Following our previous message regarding the registration of {Nom Programme} program, we regret to announce that we have been unable to find a real estate agency/business broker within the program area who could have matched IEA portal requirements regarding francophone capacity.</p>\r\n\r\n<p><u>The current program registration is therefore rejected.</u></p>\r\n\r\n<p>With our best regards</p>\r\n\r\n<p>Investir en Australie</p>', '', '2021-09-02 10:56:25', '2021-09-02 10:56:25'),
(9, 'Si une agence de la Ville et l\'Etat où est situé le bien à vendre s\'est enregistrée en tant qu\'AFA', 'La nouvelle AFA', '<p>La nouvelle AFA {Nom AFA} s&#39;est enregistr&eacute;e &agrave; {Ville}, {Etat}. Le programme {Nom Programme} en cours d&#39;enregistrement dispose donc maintenant d&#39;une AFA qui peut le prendre en charge.</p>\r\n\r\n<p>L&#39;enregistrement du programme avait &eacute;t&eacute; mis en stand-by dans l&#39;attente de cette nouvelle AFA.</p>\r\n\r\n<p>L&#39;Administrateur peut &agrave; pr&eacute;sent v&eacute;rifier les autres crit&egrave;res d&#39;enregistrement (comme le taux de commission sur vente) et &eacute;ventuellement approuver le programme.</p>', 'The new AFA', '<p>The new AFA {Nom AFA} has registered in {Ville}, {Etat}. The program {Nom Programme} being recorded therefore now has an AFA which can handle it.</p>\r\n\r\n<p>The recording of the program had been put on stand-by pending this new AFA.</p>\r\n\r\n<p>The Administrator can now check the other registration criteria (such as the sales commission rate) and optionally approve the program.</p>', '{Nom AFA},{Ville},{Etat},{Nom Programme}', '2021-09-02 10:59:50', '2021-09-02 10:59:50');

-- --------------------------------------------------------

--
-- Structure de la table `mails_users`
--

CREATE TABLE `mails_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `mail_id` bigint(20) NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_spam` int(11) NOT NULL DEFAULT 0,
  `is_sent` int(11) NOT NULL DEFAULT 0,
  `read` int(11) NOT NULL DEFAULT 0,
  `reader` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mails_users`
--

INSERT INTO `mails_users` (`id`, `user_id`, `mail_id`, `role`, `is_spam`, `is_sent`, `read`, `reader`, `created_at`, `updated_at`) VALUES
(1, 5, 1, NULL, 0, 0, 0, NULL, '2018-07-01 09:27:21', '2018-07-01 09:27:21'),
(2, 5, 2, NULL, 0, 0, 0, NULL, '2018-07-01 09:28:32', '2018-07-01 09:28:32'),
(3, 5, 3, NULL, 0, 0, 0, NULL, '2018-07-01 09:30:14', '2018-07-01 09:30:14'),
(4, 5, 4, NULL, 0, 0, 0, NULL, '2018-07-01 09:31:46', '2018-07-01 09:31:46'),
(5, 5, 5, NULL, 0, 0, 0, NULL, '2018-07-01 09:34:35', '2018-07-01 09:34:35'),
(6, 1, 6, NULL, 0, 0, 1, NULL, '2018-07-01 09:45:22', '2021-08-11 04:40:47'),
(7, 1, 7, NULL, 0, 0, 1, NULL, '2018-07-02 02:49:21', '2021-04-29 17:55:51'),
(8, 9, 9, NULL, 0, 1, 0, NULL, '2020-09-14 02:28:05', '2020-09-14 02:28:05'),
(9, 6, 10, NULL, 0, 1, 0, NULL, '2020-09-14 02:36:41', '2020-09-14 02:36:41'),
(10, 2, 11, NULL, 0, 0, 0, NULL, '2020-09-14 02:58:56', '2020-09-14 02:58:56'),
(11, 2, 12, NULL, 0, 0, 0, NULL, '2020-09-14 03:01:18', '2020-09-14 03:01:18'),
(12, 1, 13, NULL, 0, 0, 0, NULL, '2020-09-14 03:01:33', '2020-09-14 03:01:33'),
(13, 10, 14, NULL, 0, 1, 0, NULL, '2020-09-14 03:02:23', '2020-09-14 03:02:23'),
(14, 11, 14, NULL, 0, 1, 0, NULL, '2020-09-14 03:02:23', '2020-09-14 03:02:23'),
(15, 12, 14, NULL, 0, 1, 0, NULL, '2020-09-14 03:02:23', '2020-09-14 03:02:23'),
(16, 96, 15, NULL, 0, 0, 0, NULL, '2021-04-16 01:41:13', '2021-04-16 01:41:13'),
(17, 7, 16, NULL, 0, 0, 0, NULL, '2021-04-29 17:56:12', '2021-04-29 17:56:12'),
(18, 10, 17, NULL, 0, 0, 0, NULL, '2021-05-07 01:46:49', '2021-05-07 01:46:50'),
(19, 9, 18, NULL, 0, 0, 0, NULL, '2021-06-11 02:57:32', '2021-06-11 02:57:33'),
(20, 78, 18, NULL, 0, 0, 0, NULL, '2021-06-11 02:57:33', '2021-06-11 02:57:33'),
(21, 10, 19, NULL, 0, 0, 0, NULL, '2021-07-08 15:59:47', '2021-07-08 15:59:47');

-- --------------------------------------------------------

--
-- Structure de la table `mandat_recherches`
--

CREATE TABLE `mandat_recherches` (
  `id` int(11) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `path` varchar(191) NOT NULL,
  `product_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `afa_id` int(191) NOT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mandat_recherches`
--

INSERT INTO `mandat_recherches` (`id`, `file_name`, `path`, `product_id`, `from_id`, `to_id`, `afa_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Form6_Queensland_MEM-00000_1629201202.pdf', 'uploads/pdf/form6/Form6_Queensland_MEM-00000_1629201202.pdf', 21, 1, 10, 6, 1, '2021-08-17 08:53:24', '2021-08-18 09:49:23');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `libelle`, `photo`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Immobilier', '1618558808.webp', 0, '2021-02-18 06:12:17', '2021-04-16 04:40:08', NULL),
(2, 'Business', '1613659863.jpg', 0, '2021-02-18 06:25:05', '2021-02-18 11:51:03', NULL),
(3, 'Services', '1613652103.jpg', 0, '2021-02-18 06:41:43', '2021-02-18 06:41:43', NULL),
(4, 'Résidentiel', '1613652175.jpg', 1, '2021-02-18 06:42:56', '2021-02-18 06:42:56', NULL),
(5, 'Blog', '1613653599.jpg', 0, '2021-02-18 07:06:39', '2021-02-18 07:06:39', NULL),
(6, 'Compte', '1613655403.jpg', 0, '2021-02-18 07:36:43', '2021-02-18 07:36:43', NULL),
(7, 'Foncier', '1613656378.jpg', 1, '2021-02-18 07:52:58', '2021-02-18 07:52:58', NULL),
(8, 'Industriel', '1613656420.jpg', 2, '2021-02-18 07:53:40', '2021-02-18 07:53:40', NULL),
(9, 'Commercial', '1613656467.jpg', 2, '2021-02-18 07:54:27', '2021-02-18 07:54:27', NULL),
(10, 'Dashboard', '1613658272.jpg', 6, '2021-02-18 07:55:34', '2021-02-18 08:24:32', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `type`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
(1, 'user', 10, 1, 'Bonjour, \r\nj\'ai une question sur un programme disponible sur votre plateforme', NULL, 1, '2021-04-30 03:33:47', '2021-07-30 08:22:35'),
(2, 'user', 10, 6, 'salut Afa', NULL, 1, '2021-04-30 03:34:28', '2021-07-08 15:33:09'),
(3, 'user', 10, 6, 'salut les', NULL, 1, '2021-05-06 07:12:32', '2021-07-08 15:33:09'),
(4, 'user', 6, 10, 'salu salu', NULL, 1, '2021-05-06 07:13:43', '2021-07-28 02:23:14'),
(5, 'user', 6, 10, 'ça passe ?', NULL, 1, '2021-05-06 07:16:30', '2021-07-28 02:23:14'),
(6, 'user', 10, 6, 'oui ça marche', NULL, 1, '2021-05-06 07:19:50', '2021-07-08 15:33:09'),
(7, 'user', 6, 10, 'Super !', NULL, 1, '2021-05-06 07:20:10', '2021-07-28 02:23:14'),
(8, 'user', 10, 6, 'bien joué', NULL, 1, '2021-05-06 07:20:24', '2021-07-08 15:33:09'),
(9, 'user', 6, 10, 'Merci', NULL, 1, '2021-05-27 08:18:30', '2021-07-28 02:23:14'),
(10, 'user', 6, 10, 'salut member', NULL, 1, '2021-07-08 15:30:13', '2021-07-28 02:23:14'),
(11, 'user', 10, 6, 'Bonjour AFA', NULL, 1, '2021-07-08 15:30:30', '2021-07-08 15:33:09'),
(12, 'user', 10, 1, 'Bonjour', NULL, 1, '2021-07-15 14:37:14', '2021-07-30 08:22:35'),
(13, 'user', 10, 1, 'Bonjour', NULL, 1, '2021-07-16 05:15:18', '2021-07-30 08:22:35'),
(14, 'admin', 1, 10, 'bonjour , commment allez-vous', NULL, 1, '2021-07-16 05:15:44', '2021-08-11 19:07:53'),
(15, 'user', 10, 1, 'Bonjour, message interne test', NULL, 1, '2021-07-16 06:29:55', '2021-07-30 08:22:35'),
(16, 'user', 10, 1, 'test', NULL, 1, '2021-07-16 06:30:59', '2021-07-30 08:22:35'),
(17, 'user', 10, 1, 'un autre message', NULL, 1, '2021-07-16 07:11:16', '2021-07-30 08:22:35'),
(18, 'admin', 1, 10, 'que puis-je faire pour vous?', NULL, 1, '2021-07-16 07:13:46', '2021-08-11 19:07:53'),
(19, 'user', 10, 2, 'Message rélation entre APL et membre', NULL, 1, '2021-07-28 02:02:28', '2021-07-28 02:17:16'),
(20, 'user', 10, 2, 'Message rélation entre APL et membre', NULL, 1, '2021-07-28 02:03:47', '2021-07-28 02:17:16');

-- --------------------------------------------------------

--
-- Structure de la table `meta_datas`
--

CREATE TABLE `meta_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `object_id` int(10) UNSIGNED NOT NULL,
  `object_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `meta_datas`
--

INSERT INTO `meta_datas` (`id`, `object_id`, `object_type`, `key`, `value`) VALUES
(1, 5, 'App\\Models\\Config', 'title', 'a:2:{s:2:\"fr\";s:9:\"Connexion\";s:2:\"en\";s:5:\"Login\";}'),
(2, 5, 'App\\Models\\Config', 'content', 'a:2:{s:2:\"fr\";s:187:\"<p>Sed perspiciatis unde natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.</p>\";s:2:\"en\";s:187:\"<p>Sed perspiciatis unde natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.</p>\";}'),
(3, 5, 'App\\Models\\Config', 'contact', 'a:2:{s:2:\"fr\";s:130:\"<ul>\r\n	<li>T&eacute;l&eacute;phone: (123) 45678910</li>\r\n	<li>Mail: company@domain.com</li>\r\n	<li>Fax: +84 962 216 601</li>\r\n</ul>\";s:2:\"en\";s:112:\"<ul>\r\n	<li>Phone: (123) 45678910</li>\r\n	<li>Mail: company@domain.com</li>\r\n	<li>Fax: +84 962 216 601</li>\r\n</ul>\";}'),
(4, 5, 'App\\Models\\Config', 'address', 'a:2:{s:2:\"fr\";s:76:\"<p>95 Amphitheatre Parkway<br />\r\nMountain View CA,<br />\r\nUnited States</p>\";s:2:\"en\";s:76:\"<p>95 Amphitheatre Parkway<br />\r\nMountain View CA,<br />\r\nUnited States</p>\";}'),
(5, 3, 'App\\Models\\Config', 'percent_reservation', '0.09'),
(6, 3, 'App\\Models\\Config', 'percent_presentation_afa', '0.12'),
(7, 3, 'App\\Models\\Config', 'percent_presentation_apl', '0.09'),
(8, 3, 'App\\Models\\Config', 'disable_payed_inscription', '1'),
(9, 3, 'App\\Models\\Config', 'trial_delay', '10'),
(10, 11, 'App\\Models\\User', 'first_name', 'Liantsoa'),
(11, 11, 'App\\Models\\User', 'last_name', 'Rakoto'),
(12, 11, 'App\\Models\\User', 'newsletter', 'on'),
(13, 12, 'App\\Models\\User', 'first_name', 'NY'),
(14, 12, 'App\\Models\\User', 'last_name', 'Tahiry'),
(15, 12, 'App\\Models\\User', 'newsletter', 'on'),
(16, 13, 'App\\Models\\User', 'first_name', 'sam'),
(17, 13, 'App\\Models\\User', 'last_name', 'heary'),
(18, 13, 'App\\Models\\User', 'newsletter', 'on'),
(19, 14, 'App\\Models\\User', 'first_name', 'sami'),
(20, 14, 'App\\Models\\User', 'last_name', 'heary'),
(21, 14, 'App\\Models\\User', 'newsletter', 'on'),
(22, 15, 'App\\Models\\User', 'orga_name', 'eays'),
(23, 15, 'App\\Models\\User', 'orga_presentation', 'mybusinel'),
(24, 15, 'App\\Models\\User', 'orga_email', 'dev2@geasy.com'),
(25, 15, 'App\\Models\\User', 'orga_phone', '03356548'),
(26, 15, 'App\\Models\\User', 'orga_website', 'http://monlien.com'),
(27, 15, 'App\\Models\\User', 'contact_name', 'mon nom'),
(28, 15, 'App\\Models\\User', 'contact_email', 'mon@gmail.com'),
(29, 15, 'App\\Models\\User', 'contact_phone', '1554878'),
(30, 15, 'App\\Models\\User', 'crm_name', 'mcom'),
(31, 15, 'App\\Models\\User', 'crm_email', 'moci'),
(32, 16, 'App\\Models\\User', 'orga_name', 'eays'),
(33, 16, 'App\\Models\\User', 'orga_presentation', 'ds'),
(34, 16, 'App\\Models\\User', 'orga_email', 'dev@geasy.com'),
(35, 16, 'App\\Models\\User', 'orga_phone', '03356548'),
(36, 16, 'App\\Models\\User', 'orga_website', 'http://monlien.com'),
(37, 16, 'App\\Models\\User', 'orga_operation_state', '4'),
(38, 16, 'App\\Models\\User', 'orga_operation_range', '10'),
(39, 16, 'App\\Models\\User', 'contact_name', 'mon nom'),
(40, 16, 'App\\Models\\User', 'contact_email', 'mon@gmail.com'),
(41, 16, 'App\\Models\\User', 'contact_phone', '1554878'),
(42, 16, 'App\\Models\\User', 'crm_name', 'mcom'),
(43, 16, 'App\\Models\\User', 'crm_email', 'moci'),
(44, 2, 'App\\Models\\Config', 'facebook', 'https://www.facebook.com/investirenaustralie'),
(45, 1, 'App\\Models\\Config', 'latitude', '275742'),
(46, 1, 'App\\Models\\Config', 'longitude', '1532425'),
(47, 1, 'App\\Models\\Config', 'admin', '1'),
(48, 1, 'App\\Models\\Config', 'admin_email', 'admin@investirenaustralie.com'),
(49, 1, 'App\\Models\\Config', 'admin_phone', '+687840030'),
(50, 1, 'App\\Models\\Config', 'admin_name', 'Philippe Buteri de Préville'),
(51, 1, 'App\\Models\\Config', 'meta_title', 'INVESTIR EN AUSTRALIE'),
(52, 1, 'App\\Models\\Config', 'meta_desc', 'Soutien et facilitation de l\'investissement immobilier résidentiel, foncier, industriel ou commercial en Australie'),
(53, 1, 'App\\Models\\Config', 'meta_keywords', 'investir en Australie\r\ninvestissement en Australie\r\nimmobilier australien\r\nacheter en Australie\r\nInvestissement immobilier en Australie'),
(54, 17, 'App\\Models\\User', 'first_name', 'francois'),
(55, 17, 'App\\Models\\User', 'last_name', 'dubos'),
(56, 17, 'App\\Models\\User', 'newsletter', 'on'),
(57, 17, 'App\\Models\\User', 'allow_sharing', 'on'),
(58, 18, 'App\\Models\\User', 'first_name', 'francois'),
(59, 18, 'App\\Models\\User', 'last_name', 'dubros'),
(60, 18, 'App\\Models\\User', 'newsletter', 'on'),
(61, 19, 'App\\Models\\User', 'first_name', 'francois'),
(62, 19, 'App\\Models\\User', 'last_name', 'dubois'),
(63, 19, 'App\\Models\\User', 'newsletter', 'on'),
(64, 20, 'App\\Models\\User', 'first_name', 'Tadio'),
(65, 20, 'App\\Models\\User', 'last_name', 'kaze'),
(66, 20, 'App\\Models\\User', 'newsletter', 'on'),
(67, 20, 'App\\Models\\User', 'allow_sharing', 'on'),
(68, 21, 'App\\Models\\User', 'orga_name', 'business name'),
(69, 21, 'App\\Models\\User', 'orga_presentation', 'presentation'),
(70, 21, 'App\\Models\\User', 'orga_email', 'business@email.com'),
(71, 21, 'App\\Models\\User', 'orga_phone', '3324646132166'),
(72, 21, 'App\\Models\\User', 'orga_website', 'http://www.google.com/'),
(73, 21, 'App\\Models\\User', 'orga_operation_range', '10'),
(74, 21, 'App\\Models\\User', 'contact_name', 'contact name'),
(75, 21, 'App\\Models\\User', 'contact_email', 'contact@gmail.com'),
(76, 21, 'App\\Models\\User', 'contact_phone', '33641561321616'),
(77, 21, 'App\\Models\\User', 'bank_iban', '1951316'),
(78, 21, 'App\\Models\\User', 'bank_bic', '61'),
(79, 22, 'App\\Models\\User', 'orga_name', 'business name'),
(80, 22, 'App\\Models\\User', 'orga_presentation', 'presentatio'),
(81, 22, 'App\\Models\\User', 'orga_email', 'business@email.com'),
(82, 22, 'App\\Models\\User', 'orga_phone', '3324646132166'),
(83, 22, 'App\\Models\\User', 'orga_website', 'http://www.google.com/'),
(84, 22, 'App\\Models\\User', 'contact_name', 'contact name'),
(85, 22, 'App\\Models\\User', 'contact_email', 'contact@gmail.com'),
(86, 22, 'App\\Models\\User', 'contact_phone', '33641561321616'),
(87, 22, 'App\\Models\\User', 'crm_name', 'dsfsddf'),
(88, 22, 'App\\Models\\User', 'crm_email', 'sdfsfs'),
(89, 1, 'App\\Models\\User', 'first_name', 'admin'),
(90, 1, 'App\\Models\\User', 'last_name', 'prenom'),
(91, 1, 'App\\Models\\Config', 'admin_address', '4 rue Jules Courtot\r\nVal Plaisance\r\nBP 8611\r\n98807 NOUMEA CEDEX\r\nNouvelle Calédonie'),
(93, 9, 'App\\Models\\Config', 'lia_name', 'L\'Immobilière Australienne Pty Ltd'),
(92, 1, 'App\\Models\\Config', 'admin_fax', '+84 962 216 601'),
(94, 9, 'App\\Models\\Config', 'lia_abn', '12345678911'),
(95, 9, 'App\\Models\\Config', 'lia_license', '123456789'),
(96, 9, 'App\\Models\\Config', 'lia_license_expire_date', '12/12/2030'),
(97, 9, 'App\\Models\\Config', 'lia_address', '7/146 Marine Parade\r\nSOUTHPORT\r\n4215 QLD\r\nAustralia'),
(98, 9, 'App\\Models\\Config', 'lia_mobile', '123456789'),
(99, 9, 'App\\Models\\Config', 'lia_dir_license', '123456789'),
(100, 9, 'App\\Models\\Config', 'lia_dir_license_expire_date', '12/12/2030'),
(101, 9, 'App\\Models\\Config', 'lia_dir', 'Philippe BUTERI DE PREVILLE'),
(102, 9, 'App\\Models\\Config', 'lia_email', 'limmobiliereaustralienne@gmail.com'),
(103, 10, 'App\\Models\\Config', 'iicc_name', 'International Internet Commerce & Consulting Sarl'),
(104, 10, 'App\\Models\\Config', 'iicc_address', '4 rue Jules Courtot\r\nVal Plaisance\r\nBP 8611\r\n98807 NOUMEA CEDEX\r\nNouvelle Calédonie'),
(105, 10, 'App\\Models\\Config', 'iicc_mobile', '123456789'),
(106, 10, 'App\\Models\\Config', 'iicc_email', 'iicc@iea.com');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(132, '2014_10_12_000000_create_users_table', 1),
(133, '2014_10_12_100000_create_password_resets_table', 1),
(134, '2016_07_27_095822_create_meta_datas_table', 1),
(135, '2018_04_12_132331_create_localisations_table', 1),
(136, '2018_04_12_132646_create_blogs_table', 1),
(137, '2018_04_12_133116_create_comments_table', 1),
(138, '2018_04_12_134658_create_pubs_table', 1),
(139, '2018_04_12_195552_create_configs_table', 1),
(140, '2018_04_13_083500_create_pages_table', 1),
(141, '2018_04_13_083535_create_images_table', 1),
(142, '2018_04_13_090907_create_sessions_table', 1),
(143, '2018_04_14_111214_create_objects_categories_table', 1),
(144, '2018_04_14_111846_create_products_table', 1),
(145, '2018_04_14_112525_create_labels_table', 1),
(146, '2018_04_19_183445_create_pubs_pages_table', 1),
(147, '2018_04_20_132646_create_categories_table', 1),
(148, '2018_04_20_184604_create_sales_table', 1),
(149, '2018_04_21_083837_create_subscriptions_table', 1),
(150, '2018_04_28_203010_create_observations_table', 1),
(151, '2018_04_28_214426_create_notifications_table', 1),
(152, '2018_05_02_184355_create_plans_table', 1),
(153, '2018_05_07_194635_create_threads_table', 1),
(154, '2018_05_08_192631_create_messages_table', 1),
(155, '2018_05_11_203245_create_types_table', 1),
(156, '2018_05_11_204505_create_products_images_table', 1),
(157, '2018_05_11_210932_create_contacts_table', 1),
(158, '2018_05_18_190357_create_mails_table', 1),
(159, '2018_05_23_203603_create_badwords_table', 1),
(160, '2018_05_23_210727_create_mails_users_table', 1),
(161, '2018_05_23_211325_create_states_table', 1),
(162, '2018_05_23_211841_create_postalcodes_table', 1),
(163, '2018_05_24_191123_create_countries_table', 1),
(164, '2018_06_03_184350_create_searches_table', 1),
(165, '2021_02_25_081921_create_userinfos_table', 2),
(166, '2021_06_08_141017_add_softdelete_to_firb', 3),
(167, '2021_06_09_120945_add_softdelete_to_badwords', 4),
(168, '2021_06_09_122911_add_softdelete_to_sales', 4);

-- --------------------------------------------------------

--
-- Structure de la table `model_messages`
--

CREATE TABLE `model_messages` (
  `id` bigint(20) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `model_messages`
--

INSERT INTO `model_messages` (`id`, `titre`, `message`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Message APL venant du membre', '<p>Voici la message d&#39;APL lors du relation avec un <strong>membre</strong> test</p>', '2021-07-19 12:59:01', '2021-07-19 13:22:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) NOT NULL,
  `email_adresse` varchar(255) NOT NULL,
  `statuts` varchar(20) NOT NULL COMMENT 'Actif, Inactif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email_adresse`, `statuts`, `created_at`, `updated_at`) VALUES
(2, 'manohisoa.dev@gmail.com', 'Actif', '2021-07-28 15:07:45', '2021-07-28 15:07:45'),
(3, 'apliea@yopmail.com', 'Actif', '2021-08-06 05:03:10', '2021-08-06 05:03:10');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter_templates`
--

CREATE TABLE `newsletter_templates` (
  `id` bigint(20) NOT NULL,
  `newsletter_title` varchar(255) NOT NULL,
  `newsletter_template` text NOT NULL,
  `statuts` varchar(20) NOT NULL COMMENT 'Actif, Inactif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newsletter_templates`
--

INSERT INTO `newsletter_templates` (`id`, `newsletter_title`, `newsletter_template`, `statuts`, `created_at`, `updated_at`) VALUES
(1, 'motivation', '<p><strong>MOTIVATION</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'Actif', '2021-07-28 01:46:10', '2021-07-30 07:37:29'),
(2, 'news', '<p>NEWS</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'Actif', '2021-07-30 07:36:47', '2021-07-30 07:37:14'),
(3, 'promotion IEA', '<p>Lorem i<strong><em>psum dolor sit ame</em></strong>t, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est <strong>laborum </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>', 'Actif', '2021-08-06 04:44:26', '2021-08-06 04:44:26');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_id`, `notifiable_type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('a80398e7-2062-4954-be43-6f7c031239a8', 'App\\Notifications\\NewMail', 5, 'App\\Models\\User', '{\"id\":\"a80398e7-2062-4954-be43-6f7c031239a8\",\"read_at\":null,\"data\":{\"mail_id\":1,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', NULL, '2018-07-01 09:27:22', '2018-07-01 09:27:22'),
('aaf95756-b0de-407b-af10-c6543bfa08c4', 'App\\Notifications\\NewMail', 5, 'App\\Models\\User', '{\"id\":\"aaf95756-b0de-407b-af10-c6543bfa08c4\",\"read_at\":null,\"data\":{\"mail_id\":2,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', NULL, '2018-07-01 09:28:33', '2018-07-01 09:28:33'),
('4fcecec1-dca0-44af-a3c1-621dd34e87ed', 'App\\Notifications\\NewMail', 5, 'App\\Models\\User', '{\"id\":\"4fcecec1-dca0-44af-a3c1-621dd34e87ed\",\"read_at\":null,\"data\":{\"mail_id\":3,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', '2020-07-24 00:06:14', '2018-07-01 09:30:14', '2020-07-24 00:06:14'),
('9195ccc0-b5c1-4a4f-80fd-7fab369ddece', 'App\\Notifications\\NewMail', 5, 'App\\Models\\User', '{\"id\":\"9195ccc0-b5c1-4a4f-80fd-7fab369ddece\",\"read_at\":null,\"data\":{\"mail_id\":4,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', NULL, '2018-07-01 09:31:47', '2018-07-01 09:31:47'),
('a3398047-ae76-4aca-a994-bba91637219c', 'App\\Notifications\\NewMail', 5, 'App\\Models\\User', '{\"id\":\"a3398047-ae76-4aca-a994-bba91637219c\",\"read_at\":null,\"data\":{\"mail_id\":5,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', '2020-07-24 00:06:05', '2018-07-01 09:34:35', '2020-07-24 00:06:05'),
('3771e2dc-7479-4a41-960a-6e7a9d30fc58', 'App\\Notifications\\NewMail', 1, 'App\\Models\\User', '{\"id\":\"3771e2dc-7479-4a41-960a-6e7a9d30fc58\",\"read_at\":null,\"data\":{\"mail_id\":6,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', '2019-03-13 07:18:00', '2018-07-01 09:45:23', '2019-03-13 07:18:00'),
('a74f054c-457a-40f3-af6c-8ae82b649558', 'App\\Notifications\\NewMail', 1, 'App\\Models\\User', '{\"id\":\"a74f054c-457a-40f3-af6c-8ae82b649558\",\"read_at\":null,\"data\":{\"mail_id\":7,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', '2019-03-13 07:17:37', '2018-07-02 02:49:23', '2019-03-13 07:17:37'),
('7522b20e-1047-4375-881f-510af01971fa', 'App\\Notifications\\NewMail', 2, 'App\\Models\\User', '{\"id\":\"7522b20e-1047-4375-881f-510af01971fa\",\"read_at\":null,\"data\":{\"mail_id\":11,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', '2020-09-14 03:31:52', '2020-09-14 02:58:56', '2020-09-14 03:31:52'),
('0fca5950-3206-4d99-881b-ef7cf042ac55', 'App\\Notifications\\NewMail', 2, 'App\\Models\\User', '{\"id\":\"0fca5950-3206-4d99-881b-ef7cf042ac55\",\"read_at\":null,\"data\":{\"mail_id\":12,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', '2020-09-14 03:31:17', '2020-09-14 03:01:18', '2020-09-14 03:31:17'),
('c5b54875-a48b-45d2-8d26-78d6104eba1a', 'App\\Notifications\\NewMail', 1, 'App\\Models\\User', '{\"id\":\"c5b54875-a48b-45d2-8d26-78d6104eba1a\",\"read_at\":null,\"data\":{\"mail_id\":13,\"sender_id\":10,\"sender_name\":\"member\",\"message\":\"member vous a envoy\\u00e9 un mail\"}}', '2020-09-14 03:01:49', '2020-09-14 03:01:33', '2020-09-14 03:01:49'),
('f2c2eda8-e0c3-4cd5-8ca9-1e4fba5cd4e0', 'App\\Notifications\\AfaCourriel', 10, 'App\\Models\\User', '{\"id\":\"f2c2eda8-e0c3-4cd5-8ca9-1e4fba5cd4e0\",\"read_at\":null,\"data\":{\"is_afa\":\"afa\",\"user_id\":10,\"user_name\":\"member\",\"message\":\"member vous a selectionn\\u00e9 comme AFA.\"}}', NULL, '2021-07-24 22:27:48', '2021-07-24 22:27:48');

-- --------------------------------------------------------

--
-- Structure de la table `objects_categories`
--

CREATE TABLE `objects_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL DEFAULT 0,
  `object_id` bigint(20) NOT NULL DEFAULT 0,
  `object_type` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objects_categories`
--

INSERT INTO `objects_categories` (`id`, `category_id`, `object_id`, `object_type`, `author_id`, `created_at`, `updated_at`) VALUES
(2, 1, 6, 'App\\Models\\Blog', 1, '2020-03-04 04:33:14', '2020-03-04 04:33:14'),
(4, 2, 7, 'App\\Models\\Blog', 1, '2021-04-15 11:58:06', '2021-04-15 11:58:06'),
(8, 5, 8, 'App\\Models\\Blog', 1, '2021-04-23 03:52:41', '2021-04-23 03:52:41'),
(7, 4, 8, 'App\\Models\\Blog', 1, '2021-04-23 03:52:41', '2021-04-23 03:52:41'),
(11, 1, 9, 'App\\Models\\Blog', 1, '2021-05-11 00:13:51', '2021-05-11 00:13:51'),
(88, 1, 10, 'App\\Models\\Blog', 1, '2021-09-04 20:23:02', '2021-09-04 20:23:02'),
(17, 1, 11, 'App\\Models\\Blog', 1, '2021-05-13 00:10:17', '2021-05-13 00:10:17'),
(101, 1, 12, 'App\\Models\\Blog', 1, '2021-09-06 22:32:30', '2021-09-06 22:32:30'),
(80, 1, 13, 'App\\Models\\Blog', 1, '2021-05-30 05:10:24', '2021-05-30 05:10:24'),
(85, 1, 14, 'App\\Models\\Blog', 1, '2021-05-30 05:17:44', '2021-05-30 05:17:44'),
(86, 1, 15, 'App\\Models\\Blog', 1, '2021-06-01 05:50:52', '2021-06-01 05:50:52'),
(83, 1, 16, 'App\\Models\\Blog', 1, '2021-05-30 05:16:48', '2021-05-30 05:16:48'),
(81, 1, 17, 'App\\Models\\Blog', 1, '2021-05-30 05:11:42', '2021-05-30 05:11:42'),
(87, 1, 18, 'App\\Models\\Blog', 1, '2021-06-09 02:04:27', '2021-06-09 02:04:27'),
(105, 4, 19, 'App\\Models\\Blog', 1, '2021-09-06 22:38:37', '2021-09-06 22:38:37'),
(104, 3, 19, 'App\\Models\\Blog', 1, '2021-09-06 22:38:37', '2021-09-06 22:38:37'),
(103, 2, 19, 'App\\Models\\Blog', 1, '2021-09-06 22:38:37', '2021-09-06 22:38:37'),
(102, 1, 19, 'App\\Models\\Blog', 1, '2021-09-06 22:38:37', '2021-09-06 22:38:37');

-- --------------------------------------------------------

--
-- Structure de la table `observations`
--

CREATE TABLE `observations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `observations`
--

INSERT INTO `observations` (`id`, `content`, `user_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'L\'Administrateur ne connaît pas cette agence.', 9, 1, '2020-08-06 22:27:52', '2020-08-06 22:27:52'),
(2, 'l\'Administrateur ne connaît pas ce vendeur', 9, 1, '2020-08-06 22:29:31', '2020-08-06 22:29:31'),
(3, 'sdfs', 9, 1, '2020-09-14 02:32:52', '2020-09-14 02:32:52'),
(4, 'observation', 7, 1, '2020-09-14 02:38:34', '2020-09-14 02:38:34');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_order` int(11) DEFAULT NULL,
  `is_pub` int(11) NOT NULL DEFAULT 0,
  `language` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fr',
  `parent_id` bigint(20) NOT NULL DEFAULT 0,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `path`, `page_order`, `is_pub`, `language`, `parent_id`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Page d\'accueil', NULL, '/', NULL, 0, 'fr', 0, 0, '2018-06-28 13:57:38', NULL, NULL),
(3, 'Nos services', NULL, '/services', NULL, 0, 'fr', 0, 0, '2018-06-28 13:57:38', NULL, NULL),
(5, 'Publicites', NULL, '/pubs', NULL, 0, 'fr', 0, 0, '2018-06-28 13:57:38', NULL, NULL),
(6, 'Termes et Conditions', '<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Le site &quot;Investir en Australie&quot;, dont l&#39;adresse URL est <a href=\"www.investirenaustralie.com\" style=\"color:#0563c1; text-decoration:underline\">www.investirenaustralie.com</a>, ci-dessous d&eacute;nomm&eacute; &quot;IEA&quot;, est un portail &quot;e-marketplace&quot; consacr&eacute; aux transactions sur produits immobiliers, fonciers, industriels, commerciaux et aux services financiers, et o&ugrave; se rencontrent vendeurs australiens et acheteurs potentiels francophones du monde.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Outre les produits ci-dessus le site pourra commercialiser des espaces publicitaires ouverts &agrave; tous sous r&eacute;serve de l&#39;acceptation par l&#39;Administration qui dispose en la mati&egrave;re de la plus grande libert&eacute; d&#39;appr&eacute;ciation.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les pr&eacute;sents &quot;Termes et Conditions&quot; sont accept&eacute;s sans r&eacute;serve d&egrave;s l&#39;inscription par le fait que le formulaire d&#39;inscription, quelle que soit la cat&eacute;gorie du candidat, contient la formule suivante accompagn&eacute;e d&#39;une case &agrave; cocher imp&eacute;rativement:</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&quot;Je certifie avoir lu les Termes et Conditions d&#39;utilisation du site et les accepter sans aucune r&eacute;serve&quot;.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Ces &quot;Termes et Conditions&quot; constituent l&#39;essentiel du contrat d&#39;inscription et d&#39;utilisation du site IEA que les diverses Parties Prenantes ci-dessous ont souscrit. Ils sont compl&eacute;t&eacute;s en tant que de besoin par des contrats cat&eacute;goriels pour les Vendeurs, les Agences Francophones Australiennes, les Agences Partenaires Locales et les annonceurs.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">1 - Gestion du site IEA</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Le site est sous la gestion de la soci&eacute;t&eacute; &quot;International Internet Commerce &amp; Consulting Sarl&quot;, &agrave; l&#39;enseigne &quot;IICC Sarl&quot;, ci-apr&egrave;s d&eacute;nomm&eacute;e &quot;IICC&quot;, et dont l&#39;adresse postale est:</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">IICC sarl - BP 8611 - 98807 NOUMEA CEDEX - Nouvelle Cal&eacute;donie</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">2 - D&eacute;finitions</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Dans les pr&eacute;sents &quot;Termes et Conditions&quot;, et plus g&eacute;n&eacute;ralement dans les relations du site IEA et de la soci&eacute;t&eacute; IICC sarl avec les Usagers du site, sauf indications expresse contraire, les termes ci-dessous re&ccedil;oivent les d&eacute;finitions suivantes:</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">IEA: le portail &quot;Investir en Australie&quot;, dont l&#39;adresse URL est <a href=\"www.investirenaustralie.com\" style=\"color:#0563c1; text-decoration:underline\">www.investirenaustralie.com</a>. </span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">IICC: soci&eacute;t&eacute; &quot;International Internet Commerce &amp; Consulting Sarl&quot;, composante du syst&egrave;me &quot;Investir en Australie&quot;, en charge de la gestion du portail IEA, enregistr&eacute;e au Registre du Commerce et des Soci&eacute;t&eacute;s de Nouvelle Cal&eacute;donie sous le num&eacute;ro R.C.S NOUMEA 2014 B 1 236 165 (2014 B 572) - RIDET: 1 236 165.001 - Code APE: 82.99Z.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">LIA: agence immobili&egrave;re de droit australien &quot;L&#39;Immobili&egrave;re Australienne Pty Ltd&quot;, composante du syst&egrave;me &quot;Investir en Australie&quot;, responsable de l&#39;acc&egrave;s aux produits australiens, interface entre le portail IEA et les Vendeurs australiens, ACN 632 675 113, ABN 34 632 675 113, &nbsp;titulaire de la licence d&#39;agence immobili&egrave;re du Queensland LN 4301828.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Administrateur: l&#39;Administrateur du portail IEA est la soci&eacute;t&eacute; gestionnaire IICC sarl.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">E-marketplace (sur internet): espace virtuel o&ugrave; des vendeurs proposent &agrave; la vente, &agrave; la location ou &agrave; l&#39;&eacute;change des produits (biens et services) &agrave; des internautes potentiellement int&eacute;ress&eacute;s par l&#39;acquisition, la location ou l&#39;&eacute;change de ces produits.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;e-marketplace cr&eacute;&eacute; par le portail IEA est l&#39;espace virtuel o&ugrave; des vendeurs australiens proposent aux internautes francophones des produits immobiliers, fonciers, industriels ou commerciaux. La fonction du site IEA se limite &agrave; la fourniture de cet espace virtuel et &agrave; l&#39;octroi de l&#39;acc&egrave;s au site par ses usagers.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Visiteur: tout internaute qui acc&egrave;de au portail IEA sans s&#39;y &ecirc;tre encore inscrit.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Partie Prenante: toute personne physique ou morale ayant accomplie avec succ&egrave;s son inscription sur le portail IEA. Les diff&eacute;rentes cat&eacute;gories de Parties Prenantes sont:</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">\r\n	<ul style=\"list-style-type:circle\">\r\n		<li><span style=\"font-size:11pt\">Vendeurs: vendeur australien, personne physique ou morale, inscrit sur le portail IEA, et qui y pr&eacute;sente des produits immobiliers, fonciers, industriels ou&nbsp; commerciaux dont il est propri&eacute;taire ou pour la vente desquels il a un mandat de repr&eacute;sentation des propri&eacute;taires l&eacute;gaux.</span></li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">\r\n	<ul style=\"list-style-type:circle\">\r\n		<li><span style=\"font-size:11pt\">Membre: internaute, personne physique ou morale, en principe francophone, inscrit sur le portail IEA en cette qualit&eacute;, int&eacute;ress&eacute; par l&#39;acquisition &eacute;ventuelle de biens immobiliers, fonciers, industriels ou commerciaux.</span></li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">\r\n	<ul style=\"list-style-type:circle\">\r\n		<li><span style=\"font-size:11pt\">Agence Francophone Australienne (AFA): agence immobili&egrave;re ou d&#39;affaires de droit australien qui a un contrat de partenariat avec le portail IEA aux termes duquel elle prend en charge et conduit effectivement les op&eacute;rations mat&eacute;rielles, techniques, juridiques et financi&egrave;res des transactions concernant les achats des Membres apport&eacute;s par le portail IEA.</span></li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;AFA per&ccedil;oit la commission sur vente du Vendeur et en r&eacute;troc&egrave;de une partie &agrave; IICC Sarl, gestionnaire du portail IEA, en r&eacute;mun&eacute;ration de l&#39;apport de client&egrave;le r&eacute;alis&eacute;.</span></p>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li style=\"list-style-type:none\">\r\n	<ul style=\"list-style-type:circle\">\r\n		<li><span style=\"font-size:11pt\">Agence Partenaire Locale (APL): agence immobili&egrave;re ou d&#39;affaires, par principe francophone, &eacute;tablie en dehors de l&#39;Australie dans un pays ou un territoire francophone, qui a un contrat de partenariat avec le portail IEA aux termes duquel elle repr&eacute;sente le portail IEA au sein de sa communaut&eacute; et re&ccedil;oit, conseille, guide et accompagne les Membres dans leur d&eacute;cision d&#39;acheter. Elles n&#39;ont qu&#39;un droit de pr&eacute;sentation des produits affich&eacute;s sur le portail IEA.</span></li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Utilisateur: personne physique ou morale, inscrite ou non en qualit&eacute; de Partie Prenante, qui acc&egrave;de au portail IEA.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Partenaire: personne physique ou morale australienne ayant un accord de coop&eacute;ration avec le portail IEA, g&eacute;n&eacute;ralement francophone, qui apporte ses comp&eacute;tences professionnelles, juridiques ou financi&egrave;res au service des Membres acheteurs afin de rendre leur exp&eacute;rience et leurs transactions plus compr&eacute;hensibles, plus sures, plus ais&eacute;es et plus rapides.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Annonceurs: personnes physiques ou morales qui souhaitent b&eacute;n&eacute;ficier de la notori&eacute;t&eacute; du portail IEA pour promouvoir leur entreprise, leur organisation ou leur activit&eacute;.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Commission de Pr&eacute;sentation de Client&egrave;le (CPC): commission que l&#39;AFA reverse au gestionnaire du portail IEA en cas de transaction effective.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Droit de publicit&eacute;: droit per&ccedil;u par le gestionnaire du portail IEA aupr&egrave;s des Annonceurs en contrepartie de leurs publicit&eacute;s.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Compte: espace au sein du portail IEA attribu&eacute; &agrave; Partie Prenante. Le compte contient tous les &eacute;l&eacute;ments recueillis lors de l&#39;inscription, qui peuvent &ecirc;tre modifi&eacute;s par son titulaire, y compris le mot de passe, ainsi que tout ce qui fait l&#39;activit&eacute; de la Partie Prenante sur le portail IEA.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Niveau 1: acc&egrave;s au portail IEA ouvert aux Visiteurs.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Niveau 2: niveau d&#39;acc&egrave;s accord&eacute; aux Parties Prenantes inscrites sur le portail IEA.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Adresse &eacute;lectronique: les expressions &quot;adresse mel&quot;, &quot;adresse courriel&quot;, &quot;adresse e-mail&quot; sont indiff&eacute;remment utilis&eacute;es pour d&eacute;signer les adresses &eacute;lectroniques.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Message &eacute;lectronique: les expressions &quot;courriels&quot;, &quot;e-mail&quot;, &quot;courrier &eacute;lectronique&quot;, &quot;mel&quot; sont indiff&eacute;remment utilis&eacute;es pour d&eacute;signer les messages &eacute;lectroniques.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Produit: un produit est un bien &agrave; vendre sur le site IEA. Il peut s&#39;agir d&#39;un bien immobilier r&eacute;sidentiel, d&#39;un bien de nature fonci&egrave;re, d&#39;un local industriel ou commercial nu, d&#39;une affaire industrielle ou d&#39;une affaire commerciale.</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:36pt; margin-right:0cm\"><span style=\"font-size:11pt\">Lorsqu&#39;il s&#39;agit d&#39;un ensemble composite de types de produits individuels propos&eacute;s &agrave; la vente, tel qu&#39;un immeuble d&#39;appartements r&eacute;sidentiels, une r&eacute;sidence, un lotissement, un centre commercial, etc&hellip;, on distingue le &quot;Programme&quot; lui-m&ecirc;me de ses diff&eacute;rentes composantes appel&eacute;es &quot;Produits individuels&quot;</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">3 &ndash; Les Vendeurs</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">En s&#39;inscrivant, les Vendeurs s&#39;engagent, sous leur enti&egrave;re responsabilit&eacute;, &agrave; n&#39;afficher sur le site que des produits sur lesquels ils ont un droit de propri&eacute;t&eacute; qui leur permet d&#39;en disposer int&eacute;gralement et sans r&eacute;serve, ou pour lesquels ils disposent d&#39;un mandat express de vente du propri&eacute;taire l&eacute;gal int&eacute;gral. L&#39;inscription vaut certification de cette capacit&eacute; l&eacute;gale. Il n&#39;appartient pas au portail de contr&ocirc;ler la capacit&eacute; l&eacute;gale de l&#39;Utilisateur de vendre le produit affich&eacute; sur le site.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Le r&eacute;gime suivant est applicable aux Utilisateurs.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">3.1 - Inscription</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Lors de son inscription, gratuite, le candidat est invit&eacute; &agrave; remplir un formulaire d&#39;inscription, dont les champs sont adapt&eacute;s en fonction de la candidature. Les renseignements demand&eacute;s restent confidentiels et servent &agrave; l&#39;administration et aux statistiques du portail, ainsi qu&#39;aux contacts avec le Vendeur. En soumettant son inscription le candidat accepte sans r&eacute;serve les Termes et Conditions d&#39;utilisation du portail IEA.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;acceptation de l&#39;inscription par l&#39;Administrateur g&eacute;n&egrave;re la cr&eacute;ation du compte du Vendeur auquel il acc&egrave;de ensuite par identifiant et mot de passe. L&#39;activation de son compte permet au Vendeur d&#39;enregistrer ses produits.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">3.3 &ndash; D&eacute;p&ocirc;t de produits</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;Utilisateur, &agrave; partir de son compte, peut d&eacute;poser lui-m&ecirc;me ses produits dans un formulaire en ligne.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">En application de la loi australienne les &eacute;trangers non-r&eacute;sidents ne peuvent acqu&eacute;rir que de l&#39;immobilier r&eacute;sidentiel neuf. Aussi l&#39;Utilisateur ne peut d&eacute;poser sur le site IEA que des biens r&eacute;sidentiels conforme &agrave; cette r&egrave;gle. Lors de son d&eacute;p&ocirc;t l&#39;Utilisateur certifie que le bien concern&eacute; est conforme &agrave; cette r&eacute;glementation par la formule :</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&quot;<em>Je/nous certifions la conformit&eacute; de ce programme/produit aux dispositions de la loi australienne sur les investissements directs &eacute;trangers appliqu&eacute;e par le Foreign Investment Review Board relative aux biens r&eacute;sidentiels, fonciers, industriels ou commerciaux</em>&quot;.</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">La responsabilit&eacute; du site IEA, de son titulaire, ou de IICC sarl gestionnaire ne saura en aucun cas &ecirc;tre recherch&eacute;e tant par les Autorit&eacute;s australiennes que par le Membre acqu&eacute;reur d&#39;un bien immobilier r&eacute;sidentiel en cas de d&eacute;claration frauduleuse de l&#39;Utilisateur.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;affichage du produit comprend la r&eacute;f&eacute;rence du bien, sa d&eacute;finition, sa description, sa repr&eacute;sentation photographique, sa situation g&eacute;ographique sur une carte, et un lien permettant aux Membres int&eacute;ress&eacute;s d&#39;entrer en contact avec le l&#39;Utilisateur par l&#39;interm&eacute;diaire de la messagerie interne du site et d&#39;initier un dialogue entre eux.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>3.4 &ndash; R&eacute;mun&eacute;ration de IICC sarl par les Utilisateurs</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>IICC sarl per&ccedil;oit des Utilisateurs trois types de r&eacute;mun&eacute;rations dont les montants sont indiqu&eacute;s dans les proc&eacute;dures correspondantes:</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3.4.1 &ndash; Droit d&#39;affichage</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>Les Utilisateurs d&eacute;posent leurs produits moyennant un &quot;droit d&#39;affichage&quot; payable en ligne &agrave; IICC sarl. Ce droit d&#39;affichage est variable en fonction:</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; du type de d&eacute;p&ocirc;t: d&eacute;p&ocirc;t &agrave; l&#39;unit&eacute; ou permanent. Le contrat de d&eacute;p&ocirc;t permanent a une dur&eacute;e de validit&eacute; de 12 mois et permet le d&eacute;p&ocirc;t d&#39;un nombre illimit&eacute; de produits.</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; de la nature du bien: produit simple ou programme.</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; de la dur&eacute;e d&#39;affichage choisie: 3 mois, 6 mois, 12 mois</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>L&#39;Utilisateur est constamment inform&eacute; de la dur&eacute;e de validit&eacute; du droit d&#39;affichage de chacun de ses produits. A l&#39;approche de la fin de la validit&eacute; de chaque droit d&#39;affichage l&#39;Utilisateur re&ccedil;oit une alerte l&#39;informant de l&#39;imminence de la fin de cette validit&eacute;.</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3.4.2 &ndash; Droit d&#39;affichage prioritaire</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>Les produits &quot;mis en avant&quot;, qui b&eacute;n&eacute;ficie ainsi d&#39;une plus grande visibilit&eacute;, acquittent un &quot;droit d&#39;affichage prioritaire&quot;.</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\"><s>L&#39;Utilisateur est constamment inform&eacute; de la dur&eacute;e de validit&eacute; du droit d&#39;affichage prioritaire de chacun de ses produits. A l&#39;approche de la fin de la validit&eacute; de chaque droit d&#39;affichage prioritaire l&#39;Utilisateur re&ccedil;oit une alerte l&#39;informant de l&#39;imminence de la fin de cette validit&eacute;.</s></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3.4.3 &ndash; Droit de pr&eacute;sentation de client&egrave;le</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Lorsqu&#39;un produit affich&eacute; est vendu, l&#39;op&eacute;ration donne lieu &agrave; paiement en ligne au profit de IICC sarl par l&#39;agence australienne charg&eacute;e de l&#39;op&eacute;ration d&#39;un &quot;droit de pr&eacute;sentation de client&egrave;le&quot; dont le montant est indiqu&eacute; &agrave; l&#39;Utilisateur et &agrave; ladite agence.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Dans le cadre de la vente d&#39;un produit, l&#39;Utilisateur a les obligations imp&eacute;ratives suivantes:</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; il doit informer l&#39;Administrateur qu&#39;un accord de vente est intervenu entre lui et un Membre acheteur, et indiquer le montant d&eacute;finitif de la transaction;</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; il doit convenir avec l&#39;Administrateur du nom de l&#39;agence immobili&egrave;re australienne qui sera charg&eacute;e de mener la transaction et &agrave; laquelle incombera le paiement du droit de pr&eacute;sentation de client&egrave;le d&ucirc; &agrave; IICC sarl;</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; il doit enfin faire en sorte qu&#39;aucune agence immobili&egrave;re australienne, autre que celle convenue ci-dessus, n&#39;ait un droit quelconque &agrave; la commission d&#39;agence sur laquelle sera pr&eacute;lev&eacute; le droit de pr&eacute;sentation de client&egrave;le, en faisant parvenir &agrave; l&#39;Administrateur du site IEA, avant d&#39;entamer la proc&eacute;dure l&eacute;gale de vente, au minimum une copie scann&eacute;e du document original officiel d&eacute;signant l&#39;agence immobili&egrave;re convenue.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">4 - Membres</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les Membres du site IEA sont les personnes physiques ou morales inscrites sur le site en qualit&eacute; d&#39;acheteurs potentiels. Le r&eacute;gime suivant leur est applicable.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">4.1 - Inscription</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Lors de l&#39;inscription, gratuite, le candidat est invit&eacute; &agrave; remplir un formulaire d&#39;inscription, dont les champs sont adapt&eacute;s en fonction de la candidature: entreprise ou personne physique.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les renseignements demand&eacute;s restent confidentiels et servent &agrave; l&#39;administration et aux statistiques du site, ainsi qu&#39;aux contacts avec le Membre.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">En soumettant son inscription le candidat accepte sans r&eacute;serve les Termes et Conditions d&#39;utilisation du site IEA.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">La soumission du formulaire g&eacute;n&egrave;re la cr&eacute;ation du compte du Membre auquel il acc&egrave;de ensuite par nom d&#39;usage et mot de passe.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Une fen&ecirc;tre indique au nouveau Membre qu&#39;un courriel lui a &eacute;t&eacute; adress&eacute; &agrave; l&#39;adresse mel fournie contenant son nom d&#39;usage, son mot de passe et un lien de confirmation de son identit&eacute; et d&#39;activation de son compte.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">4.2 &ndash; Confirmation de l&#39;identit&eacute; du nouveau Membre et activation de son compte</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Le nouveau Membre re&ccedil;oit par courriel &agrave; l&#39;adresse mel fournie un message contenant son nom d&#39;usage, qui est son adresse mel, et un mot de passe g&eacute;n&eacute;r&eacute; automatiquement par le syst&egrave;me. L&#39;authenticit&eacute; de l&#39;identit&eacute; du candidat est v&eacute;rifi&eacute;e par la m&eacute;thode dite du &quot;double opt-in&quot;.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;activation de son compte permet au Membre d&#39;acc&eacute;der &agrave; l&#39;ensemble des fonctionnalit&eacute;s du site et au d&eacute;tail des produits d&eacute;pos&eacute;s par les vendeurs. Elle lui permet &eacute;galement de communiquer avec les Utilisateurs par le biais de la messagerie interne du site.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">4.3 &ndash; Acc&egrave;s aux produits</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Le Membre a directement acc&egrave;s &agrave; l&#39;int&eacute;gralit&eacute; du site IEA et aux d&eacute;tails des offres propos&eacute;es. Il peut &eacute;galement lancer une recherche cibl&eacute;e en utilisant un formulaire de recherche o&ugrave; diff&eacute;rents filtres relatifs au positionnement g&eacute;ographique, &agrave; la nature du bien, &agrave; sa composition, permettent de s&eacute;lectionner les produits correspondant &agrave; la demande.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">La messagerie interne du site leur permet de communiquer avec l&#39;Administration du site, ainsi qu&#39;avec les Utilisateurs aupr&egrave;s desquels ils peuvent obtenir les compl&eacute;ments d&#39;information qu&#39;ils souhaitent et avec lesquels ils peuvent engager une &eacute;ventuelle proc&eacute;dure d&#39;achat.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">5 - Partenaires</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les Partenaires sont des personnes physiques ou morales inscrites sur le site et qui contribuent par leur professionnalisme &agrave; rendre le service fourni par IEA plus attractif et plus performant, ou qui constituent des guides ou des prescripteurs aupr&egrave;s de la client&egrave;le potentielle.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Appartiennent &agrave; ce titre &agrave; la cat&eacute;gorie des Partenaires, sans que la liste ci-apr&egrave;s soit exhaustive:</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp; les professionnels francophones australiens qui accompagnent et conseillent les Membres;</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp; les agents immobiliers et les agents d&#39;affaires op&eacute;rant dans les march&eacute;s sources et qui servent d&#39;interm&eacute;diaires aupr&egrave;s de la client&egrave;le potentielle;</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp; les &quot;Annonceurs&quot;, agences de conseil en communication promotionnelle et publicitaire qui canalisent la client&egrave;le vers la r&eacute;gie publicitaire de IEA.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Des conventions sp&eacute;cifiques organisent la relation d&#39;affaires entre ces partenaires et IICC sarl.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">6 - Annonceurs</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les annonceurs sont des agences de communication publicitaires et promotionnelles qui r&eacute;servent et ach&egrave;tent des espaces publicitaires que le site IEA met &agrave; leur disposition.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les tarifs des espaces publicitaires sont communiqu&eacute;s aux Annonceurs lors de l&#39;initiation de leur proc&eacute;dure de souscription d&#39;espaces publicitaires. Ils sont fonction:</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp; &nbsp;&nbsp;de la notori&eacute;t&eacute; et de la visibilit&eacute; de la page o&ugrave; l&#39;espace se situe, attest&eacute;es par les statistiques de fr&eacute;quentation du site;</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp; de l&#39;emplacement de l&#39;espace au sein de la page;</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp; des dimensions de l&#39;espace.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">7 &ndash; Communication entre Utilisateurs et Membres</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les crit&egrave;res de communication entre Utilisateurs et Membres sont instaur&eacute;s pour prot&eacute;ger les Membres, garantir le respect par les parties des crit&egrave;res de r&eacute;mun&eacute;ration des services fournis par le site et emp&ecirc;cher &agrave; l&#39;une quelconque des parties d&#39;&eacute;chapper &agrave; ses obligations contractuelles.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Pour leur permettre de communiquer entre eux, IEA met &agrave; la disposition des Utilisateurs et des Membres un module de messagerie interne au site.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;Administration du site IEA est destinataire en copie de tous les messages &eacute;chang&eacute;s par l&#39;interm&eacute;diaire du module de messagerie interne entre Utilisateurs et Membres.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">C&#39;est une condition essentielle de l&#39;inscription des Utilisateurs et des Membres et de leur utilisation des services du site IEA de ne communiquer entre eux qu&#39;au travers de la messagerie du site. En cons&eacute;quence l&#39;inscription sur le site et l&#39;utilisation des services fournis par IEA emportent interdiction absolue pour les Utilisateurs ou les Membres de proposer, d&#39;indiquer et de fournir &agrave; l&#39;autre partie, et d&#39;utiliser effectivement, ou de tenter d&#39;utiliser des moyens de communication autres que celui fourni par IEA au travers de son module interne de communication.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">7.1 &ndash; Limitations des informations contenues dans la pr&eacute;sentation des produits</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Afin de garantir le respect de l&#39;interdiction ci-dessus, l&#39;Utilisateur s&#39;engage &agrave; n&#39;ins&eacute;rer dans la pr&eacute;sentation de ses produits aucun &eacute;l&eacute;ment permettant aux Membres de le contacter directement sans passer par le module de messagerie interne du site, tels que adresse postale, num&eacute;ro de t&eacute;l&eacute;phone ou de t&eacute;l&eacute;copie, adresse URL de site internet ou adresse mel.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Afin de se prot&eacute;ger contre des violations de ces interdictions le site IEA d&eacute;ploiera tous moyens &agrave; sa convenance de d&eacute;tection et de rep&eacute;rage de la pr&eacute;sence de tels &eacute;l&eacute;ments dans les produits post&eacute;s.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les produits qui contreviendront aux dispositions pr&eacute;c&eacute;dentes seront rejet&eacute;s ou retir&eacute;s par l&#39;Administrateur du site.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">7.2 &ndash; Limitations des moyens de communication entre Utilisateurs et Membres</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;interdiction de communication directe entre Utilisateurs et Membres hors module de messagerie interne s&#39;applique &eacute;galement aux communications dans le cadre des &eacute;changes sur les produits post&eacute;s. En cons&eacute;quence:</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp; Une partie qui recevrait de l&#39;autre partie une proposition de communiquer par un moyen &eacute;tranger &agrave; IEA devra d&eacute;cliner l&#39;offre ou s&#39;abstenir d&#39;y r&eacute;pondre. La violation par l&#39;une des parties de cette interdiction de proposer &agrave; l&#39;autre partie de communiquer par un moyen &eacute;tranger &agrave; IEA constitue une violation du contrat d&#39;utilisation instaur&eacute; par les pr&eacute;sents &quot;Termes et Conditions&quot; et pourra &ecirc;tre sanctionn&eacute;e, au gr&eacute; de IICC sarl, par une exclusion temporaire ou d&eacute;finitive du site. Les sommes vers&eacute;es &agrave; la date de la constatation de l&#39;infraction ne seront pas rembours&eacute;es et resteront acquises &agrave; IICC &agrave; titre de p&eacute;nalit&eacute;, sans pr&eacute;judice de tout recours judiciaire en violation des conventions commerciales du site, et sans pouvoir s&#39;imputer sur le paiement de montants dus ult&eacute;rieurement.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp; L&#39;utilisation effective par les parties d&#39;un moyen de communication &eacute;tranger &agrave; IEA constitue une violation caract&eacute;ris&eacute;e du contrat d&#39;utilisation instaur&eacute; par les pr&eacute;sents &quot;Termes et Conditions&quot;. Cette violation pourra &ecirc;tre sanctionn&eacute;e, au gr&eacute; de IICC sarl, par des p&eacute;nalit&eacute;s qui sont d&#39;ores et d&eacute;j&agrave; &eacute;tablies au minimum &agrave;:</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; En cas d&#39;infraction constat&eacute;e avant que la transaction entre Utilisateur et Membre n&#39;ait &eacute;t&eacute; d&eacute;finitivement r&eacute;gl&eacute;e, 25% du montant des sommes dues &agrave; IICC, en sus du montant des sommes normalement dues par application du contrat;</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; En cas d&#39;infraction constat&eacute;e apr&egrave;s que la transaction entre Utilisateur et Membre a &eacute;t&eacute; d&eacute;finitivement r&eacute;gl&eacute;e, 100% du montant des sommes dues &agrave; IICC, en sus du montant des sommes normalement dues par application du contrat.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Pour l&#39;application des pr&eacute;sentes dispositions, en cas de refus de paiement des sommes dues au titre de l&#39;application normale du contrat et des p&eacute;nalit&eacute;s, les parties conviennent que IICC sera fond&eacute;e &agrave; poursuivre son cocontractant fautif devant la juridiction australienne comp&eacute;tente.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;interdiction de communiquer autrement que par messagerie interne au site ne pourra &ecirc;tre lev&eacute;e par l&#39;Administration du site qu&#39;en cas de vente, pour permettre le bon d&eacute;roulement des op&eacute;rations, et qu&#39;apr&egrave;s que l&#39;Utilisateur ait satisfait aux trois obligations imp&eacute;ratives stipul&eacute;es au 3.4.3 &ndash; &quot;Droit de pr&eacute;sentation de client&egrave;le&quot; ci-dessus.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">8 &ndash; Politique de confidentialit&eacute;</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Devant le d&eacute;veloppement des nouveaux outils de communication, le site IEA, son propri&eacute;taire, et la soci&eacute;t&eacute; gestionnaire IICC portent la plus grande attention &agrave; la protection de la vie priv&eacute;e et s&#39;engagent &agrave; respecter la confidentialit&eacute; des renseignements personnels collect&eacute;s.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les mesures destin&eacute;es &agrave; garantir ce respect de la confidentialit&eacute; des informations collect&eacute;es sont sp&eacute;cifiquement expos&eacute;es dans la partie du site &quot;Politique de Confidentialit&eacute;&quot;.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">9 - Nature juridique de la relation avec Utilisateurs et Membre</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;inscription d&eacute;finitive d&#39;un Utilisateur vaut passation de convention commerciale dont les pr&eacute;sents &quot;Termes et Conditions&quot; et les &eacute;l&eacute;ments, notamment tarifaires, qui y sont li&eacute;s constituent le contenu.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Cette convention commerciale cesse apr&egrave;s que l&#39;Utilisateur a mis fin &agrave; son inscription sur le site.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">La relation qui unit IEA et Membres est une relation de prestation de service de IEA qui permet au Membre d&#39;acc&eacute;der &agrave; l&#39;ensemble des produits affich&eacute;s sur le site et propos&eacute; &agrave; la vente par leurs propri&eacute;taires ou leurs repr&eacute;sentants.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>', '/terms', 0, 0, 'fr', 0, 0, '2018-06-28 13:57:38', '2020-08-14 23:43:42', NULL);
INSERT INTO `pages` (`id`, `title`, `content`, `path`, `page_order`, `is_pub`, `language`, `parent_id`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Politique de Confidentialité', '<p><span style=\"font-size:11pt\">Devant le d&eacute;veloppement des nouveaux outils de communication, il est n&eacute;cessaire de porter une attention particuli&egrave;re &agrave; la protection de la vie priv&eacute;e. C&#39;est pourquoi, nous nous engageons &agrave; respecter la confidentialit&eacute; des renseignements personnels que nous collectons.</span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">1 - Collecte des renseignements personnels</span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Nous collectons les renseignements suivants:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Nom</span></li>\r\n	<li><span style=\"font-size:11pt\">Pr&eacute;nom</span></li>\r\n	<li><span style=\"font-size:11pt\">Adresse postale</span></li>\r\n	<li><span style=\"font-size:11pt\">Code postal</span></li>\r\n	<li><span style=\"font-size:11pt\">Adresse &eacute;lectronique</span></li>\r\n	<li><span style=\"font-size:11pt\">Num&eacute;ro de t&eacute;l&eacute;phone / t&eacute;l&eacute;copieur</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les renseignements personnels que nous collectons sont recueillis au travers de formulaires et gr&acirc;ce &agrave; l&#39;interactivit&eacute; &eacute;tablie entre vous et notre site Web. Nous utilisons &eacute;galement, comme indiqu&eacute; dans la section suivante, des fichiers t&eacute;moins et/ou journaux pour r&eacute;unir des informations vous concernant.</span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">2 - Formulaires&nbsp; et interactivit&eacute;:</span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Vos renseignements personnels sont collect&eacute;s par le biais de formulaires, &agrave; savoir:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Formulaires d&#39;inscription au site Web</span></li>\r\n	<li><span style=\"font-size:11pt\">Formulaires de commande</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Nous utilisons les renseignements ainsi collect&eacute;s pour les finalit&eacute;s suivantes:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Suivi des commandes</span></li>\r\n	<li><span style=\"font-size:11pt\">Informations / Offres promotionnelles</span></li>\r\n	<li><span style=\"font-size:11pt\">Statistiques</span></li>\r\n	<li><span style=\"font-size:11pt\">Contact</span></li>\r\n	<li><span style=\"font-size:11pt\">Gestion du site Web (pr&eacute;sentation, organisation)</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Vos renseignements sont &eacute;galement collect&eacute;s par le biais de l&#39;interactivit&eacute; pouvant s&#39;&eacute;tablir entre vous et notre site Web et ce, de la fa&ccedil;on suivante:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Statistiques</span></li>\r\n	<li><span style=\"font-size:11pt\">Contacts</span></li>\r\n	<li><span style=\"font-size:11pt\">Gestion du site Web (pr&eacute;sentation, organisation)</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Nous utilisons les renseignements ainsi collect&eacute;s pour les finalit&eacute;s suivantes:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Commentaires</span></li>\r\n	<li><span style=\"font-size:11pt\">Correspondance</span></li>\r\n	<li><span style=\"font-size:11pt\">Informations ou pour des offres promotionnelles</span></li>\r\n</ul>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">3 - Fichiers journaux et t&eacute;moins</span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Nous recueillons certaines informations par le biais de fichiers journaux (log file) et de fichiers t&eacute;moins (cookies). Il s&#39;agit principalement des informations suivantes:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Adresse IP</span></li>\r\n	<li><span style=\"font-size:11pt\">Pages visit&eacute;es et requ&ecirc;tes</span></li>\r\n	<li><span style=\"font-size:11pt\">Heure et jour de connexion</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Le recours &agrave; de tels fichiers nous permet:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">L&#39;am&eacute;lioration du service et accueil personnalis&eacute;</span></li>\r\n	<li><span style=\"font-size:11pt\">L&#39;obtention de profils personnalis&eacute;s de consommation</span></li>\r\n	<li><span style=\"font-size:11pt\">Le suivi des commandes</span></li>\r\n	<li><span style=\"font-size:11pt\">La g&eacute;n&eacute;ration de statistiques</span></li>\r\n</ul>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">4 - Droit d&#39;opposition et de retrait</span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Nous nous engageons &agrave; vous offrir un droit d&#39;opposition et de retrait quant &agrave; vos renseignements personnels.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Le droit d&#39;opposition s&#39;entend comme &eacute;tant la possibilit&eacute; offerte aux internautes de refuser que leurs renseignements personnels soient utilis&eacute;s &agrave; certaines fins mentionn&eacute;es lors de la collecte.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Le droit de retrait s&#39;entend comme &eacute;tant la possibilit&eacute; offerte aux internautes de demander &agrave; ce que leurs renseignements personnels ne figurent plus, par exemple, dans une liste de diffusion.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Pour pouvoir exercer ces droits, vous pouvez utiliser:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Courriel : <u><a href=\"mailto:admin@investirenaustralie.com\" style=\"color:#0563c1; text-decoration:underline\"><span style=\"color:#0000cc\">admin@investirenaustralie.com</span></a></u></span></li>\r\n	<li><span style=\"font-size:11pt\">Section du site web : <span style=\"color:#0000cc\">http//:www.investirenaustralie.com/</span></span></li>\r\n</ul>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">5 - Droit d&#39;acc&egrave;s</span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Nous nous engageons &agrave; reconna&icirc;tre un droit d&#39;acc&egrave;s et de rectification aux personnes concern&eacute;es d&eacute;sireuses de consulter, modifier, voire radier les informations les concernant.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">L&#39;exercice de ce droit se fera par:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Courriel : <u><a href=\"mailto:admin@investirenaustralie.com\" style=\"color:#0563c1; text-decoration:underline\"><span style=\"color:#0000cc\">admin@investirenaustralie.com</span></a></u></span></li>\r\n	<li><span style=\"font-size:11pt\">Section du site web : <span style=\"color:#0000cc\">http//:www.investirenaustralie.com/</span></span></li>\r\n	<li><span style=\"font-size:11pt\">Par acc&egrave;s au compte personnel</span></li>\r\n</ul>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">6 &ndash; S&eacute;curit&eacute;</span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Les renseignements personnels que nous collectons sont conserv&eacute;s dans un environnement s&eacute;curis&eacute;. Les personnes travaillant pour nous sont tenues de respecter la confidentialit&eacute; de vos informations.</span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Pour assurer la s&eacute;curit&eacute; de vos renseignements personnels, nous avons recours aux mesures suivantes:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">Protocole SSL (Secure Sockets Layer)</span></li>\r\n	<li><span style=\"font-size:11pt\">Protocole SET (Secure Electronic Transaction)</span></li>\r\n	<li><span style=\"font-size:11pt\">Gestion des acc&egrave;s des personnes autoris&eacute;es</span></li>\r\n	<li><span style=\"font-size:11pt\">Gestion des acc&egrave;s des personnes concern&eacute;es</span></li>\r\n	<li><span style=\"font-size:11pt\">Sauvegarde informatique</span></li>\r\n	<li><span style=\"font-size:11pt\">Identifiant / mot de passe</span></li>\r\n	<li><span style=\"font-size:11pt\">Parefeu (Firewalls)</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Nous nous engageons &agrave; maintenir un haut degr&eacute; de confidentialit&eacute; en int&eacute;grant les derni&egrave;res innovations technologiques permettant d&#39;assurer la confidentialit&eacute; de vos transactions. Toutefois, comme aucun m&eacute;canisme n&#39;offre une s&eacute;curit&eacute; maximale, une part de risque est toujours pr&eacute;sente lorsque l&#39;on utilise Internet pour transmettre des renseignements personnels.</span></p>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">7 &ndash; Label</span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Nos engagements en mati&egrave;re de protection des renseignements personnels r&eacute;pondent aux exigences du programme suivant:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">VeriSign&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></li>\r\n</ul>\r\n\r\n<h1 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">8 &ndash; L&eacute;gislation</span></h1>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:11pt\">Nous nous engageons &agrave; respecter les dispositions l&eacute;gislatives &eacute;nonc&eacute;es dans:</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\">R&eacute;glementation fran&ccedil;aise</span></li>\r\n</ul>', '/confidentialites', 0, 0, 'fr', 0, 0, '2018-06-28 13:57:38', '2019-05-10 19:51:19', NULL),
(8, 'Guide de l\'investisseur', '<h1>LES IMPOTS EN AUSTRALIE</h1>\r\n\r\n<p>Apr&egrave;s avoir r&eacute;alis&eacute; un investissement en Australie, vous souhaiterez sans doute amortir le co&ucirc;t de cet investissement en louant votre bien. Les produits de cette location constitueront un revenu et seront imposables en Australie. Il est donc int&eacute;ressant de conna&icirc;tre le niveau d&#39;imposition brut de ces revenus.</p>\r\n\r\n<p>Le bar&egrave;me de l&#39;imp&ocirc;t sur le revenu en Australie (&quot;Tax Return&quot;), comme dans &agrave; peu pr&egrave;s toutes les l&eacute;gislations fiscales, est diff&eacute;rent selon que le contribuable est ou non r&eacute;sident fiscal. Les non r&eacute;sidents fiscaux ne sont imposables que sur leurs revenus de source australienne, &agrave; la diff&eacute;rence des r&eacute;sidents fiscaux qui sont imposables sur l&#39;universalit&eacute; de leurs revenus.</p>\r\n\r\n<div class=\"text_exposed_show\">\r\n<p>Il faut ici souligner l&#39;importance pour le contribuable de l&#39;existence ou de l&#39;absence de convention fiscale entre les pays o&ugrave; il aurait des revenus. Il existe par exemple une convention fiscale entre la France et l&#39;Australie qui permet d&#39;&eacute;viter les doubles impositions. En revanche il n&#39;existe aucun accord de ce type entre l&#39;Australie et la Nouvelle Cal&eacute;donie, qui fait pourtant partie de l&#39;ensemble fran&ccedil;ais mais qui a un r&eacute;gime fiscal autonome.</p>\r\n\r\n<h2><span style=\"font-size:16px\">Les r&eacute;sidents fiscaux en Australie</span></h2>\r\n\r\n<p>Pour les r&eacute;sidents fiscaux en Australie, imposables sur l&#39;universalit&eacute; de leurs revenus, le bar&egrave;me progressif de l&#39;imp&ocirc;t est le suivant depuis le 1er juillet 2014:</p>\r\n\r\n<p>De 0 - A$18,200 = 0%<br />\r\nDe A$18,201 &agrave; A$37,000 = 19%<br />\r\nDe A$37,001 &agrave; A$80,000 = 32.5%<br />\r\nDe A$80,001 &agrave; A$180,000 = 37%<br />\r\nAu-del&agrave; de A$180,000 = 45%</p>\r\n\r\n<p>Les personnes reconnues non r&eacute;sidentes fiscales en Australie ne sont imposables que sur leurs revenus de source australienne. Ce sera a priori le cas pour la personne qui ne vit pas plus de 6 mois en Australie, y ach&egrave;te un bien immobilier, ne l&#39;habite pas &agrave; titre permanent et en tire des revenus locatifs. Bien entendu, un certain nombre de charges sont d&eacute;ductibles des revenus fonciers.</p>\r\n\r\n<h2><span style=\"font-size:16px\">Les non r&eacute;sidents fiscaux en Australie</span></h2>\r\n\r\n<p>Pour ces non-r&eacute;sidents, le bar&egrave;me progressif de l&#39;imp&ocirc;t sur l&#39;ensemble des revenus imposables de source uniquement australienne est le suivant pour l&#39;ann&eacute;e 2013-2014:</p>\r\n\r\n<p>De 0 - A$80,000 = 32.5%<br />\r\nDe A$80,001 &agrave; A$180,000 = 37%<br />\r\nAu-del&agrave; de A$180,000 = 45%</p>\r\n\r\n<p>La plateforme &quot;Investir en Australie&quot; pourra vous proposer les services d&#39;une agence immobili&egrave;re francophone pour la location de votre bien, et d&#39;un cabinet comptable francophone agr&eacute;&eacute; qui pourra se charger de toutes vos d&eacute;clarations fiscales aupr&egrave;s de l&#39;administration australienne.</p>\r\n</div>', '/help', 0, 0, 'fr', 0, 0, '2018-06-28 13:57:38', '2019-05-10 02:01:15', NULL),
(9, 'MESSAGE A LA COMMUNAUTE FRANCOPHONE', '<p><span style=\"color:#000000\"><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Vous envisagez ou vous souhaitez acqu&eacute;rir un bien immobilier, une propri&eacute;t&eacute; fonci&egrave;re, ou encore une affaire industrielle ou commerciale en Australie. Cette intention peut correspondre &agrave; une d&eacute;marche d&#39;investissement financier, ou &ecirc;tre motiv&eacute;e par des raisons affectives, une envie d&#39;une autre vie, pour pr&eacute;parer votre future retraite, ou par une infinit&eacute; d&#39;autres bonnes raisons !</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le site &quot;<strong>Investir en Australie</strong>&quot; est un &ldquo;portail internet&rdquo; o&ugrave; vous pouvez parcourir les offres en mati&egrave;re de r&eacute;sidentiel neuf, de foncier ou d&rsquo;affaires commerciales ou industrielles en Australie, d&eacute;pos&eacute;es par des Australiens et, en vous inscrivant comme &quot;<em>Membre</em>&quot;, entamer une proc&eacute;dure d&#39;acquisition en b&eacute;n&eacute;ficiant de l&rsquo;assistance juridique, financi&egrave;re et technique de nos partenaires professionnels francophones australiens.</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:16px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">L&#39;inscription en qualit&eacute; de Membre est totalement gratuite et ne vous impose aucun engagement financier. Les transactions d&#39;acquisition au travers du site n&#39;entra&icirc;nent aucun surco&ucirc;t pour les Membres acqu&eacute;reurs.</span></span></span></p>', '/1', 1, 0, 'fr', 1, 1, '2018-06-28 13:57:38', '2021-05-19 23:28:58', NULL),
(10, 'ESPACES PUBLICITES', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam.lorem</p>\r\n\r\n<p>&nbsp;</p>', '/2', 2, 1, 'fr', 1, 1, '2018-06-28 13:57:38', '2020-09-03 09:47:46', NULL),
(11, 'COMMENT FONCTIONNE LE PORTAIL INVESTIR EN AUSTRALIE', '<div class=\"row\">\r\n<div class=\"col-md-3 col-xs-6 sec-three\">\r\n<div class=\"clearfix feature text-center\">\r\n<div class=\"home-step\">\r\n<h1>Parmi&nbsp;tous&nbsp;les&nbsp;produits&nbsp;affich&eacute;s&nbsp;sur&nbsp;le portail.&nbsp;s&eacute;l&eacute;ctionnez&nbsp;celui&nbsp;ou&nbsp;ceux&nbsp;qui&nbsp;vous&nbsp;interessent</h1>\r\n\r\n<p>Sans&nbsp;n&eacute;cessit&eacute;&nbsp;d&lsquo;&ecirc;tre&nbsp;inscrit&nbsp;comme&nbsp;Membre,&nbsp;vous&nbsp;pouvez&nbsp;parcourir&nbsp;l&lsquo;ensemble&nbsp;des&nbsp;produits&nbsp;affich&eacute;s&nbsp;sur&nbsp;le portail.&nbsp;Pour&nbsp;vous&nbsp;aider&nbsp;&agrave;&nbsp;rechercher&nbsp;les&nbsp;biens&nbsp;qui&nbsp;correspondent&nbsp;&agrave;&nbsp;vos&nbsp;attentes:&nbsp;vous&nbsp;s&eacute;lectionnez&nbsp;dans&nbsp;la&nbsp;barre&nbsp;de&nbsp;menus&nbsp;l&lsquo;objet&nbsp;de&nbsp;votre&nbsp;choix&nbsp;:&nbsp;immobilier (r&eacute;sidentiel ou foncier) ou&nbsp;business (industriel ou commercial);&nbsp;en&nbsp;fonction&nbsp;de&nbsp;votre&nbsp;choix&nbsp;pr&eacute;c&eacute;dent&nbsp;vous&nbsp;disposez&nbsp;d&lsquo;un&nbsp;panneau&nbsp;qui&nbsp;vous&nbsp;propose&nbsp;diff&eacute;rents&nbsp;crit&egrave;res&nbsp;de&nbsp;recherche. Le portail affiche&nbsp;alors&nbsp;le&nbsp;r&eacute;sultat&nbsp;de&nbsp;la&nbsp;recherche&nbsp;correspondant&nbsp;&agrave;&nbsp;vos&nbsp;crit&egrave;res&nbsp;dans&nbsp;la&nbsp;situation&nbsp;g&eacute;ographique&nbsp;s&eacute;lectionn&eacute;e.&nbsp;L&#39;inscription&nbsp;en&nbsp;qualit&eacute;&nbsp;de&nbsp;Membre&nbsp;n&#39;est&nbsp;n&eacute;cessaire&nbsp;que&nbsp;si&nbsp;vous&nbsp;souhaitez&nbsp;enregistrer&nbsp;vos&nbsp;crit&egrave;res&nbsp;de&nbsp;recherche,&nbsp;un&nbsp;produit&nbsp;particulier&nbsp;dans&nbsp;vos&nbsp;&ldquo;Favoris, partager&nbsp;un&nbsp;produit&nbsp;avec&nbsp;des&nbsp;amis,&nbsp;contacter&nbsp;une&nbsp;&ldquo;Agence&nbsp;Partenaire&nbsp;Locale&rdquo; (APL) ou&nbsp;une&nbsp;&ldquo;Agence&nbsp;Francophone&nbsp;Australienne&rdquo; (AFA),&nbsp;ou&nbsp;enfin&nbsp;lancer&nbsp;une&nbsp;proc&eacute;dure&nbsp;d&lsquo;achat.</p>\r\n\r\n<hr />\r\n<h1>Obtenez&nbsp;de&nbsp;l&#39;agence&nbsp;les&nbsp;informations&nbsp;que&nbsp;vous&nbsp;souhaitez&nbsp;sur&nbsp;le&nbsp;ou&nbsp;les&nbsp;biens&nbsp;s&eacute;l&eacute;ctionn&eacute;s</h1>\r\n\r\n<p>Apr&egrave;s&nbsp;vous&nbsp;&ecirc;tre&nbsp;inscrit&nbsp;comme&nbsp;Membre&nbsp;du portail, lorsqu&#39;un&nbsp;bien&nbsp;vous&nbsp;int&eacute;resse vous pouvez: en&nbsp;cliquant&nbsp;&ldquo;Liste&nbsp;des&nbsp;Agences&nbsp;Partenaires&nbsp;Locales&rdquo;&nbsp;,&nbsp;vous&nbsp;rapprocher&nbsp;de&nbsp;l&lsquo;APL&nbsp;pr&egrave;s&nbsp;de&nbsp;chez&nbsp;vous&nbsp;qui&nbsp;pourra&nbsp;vous&nbsp;informer&nbsp;et&nbsp;vous&nbsp;conseiller; et en&nbsp;cliquant&nbsp;&ldquo;Contacter&nbsp;l&lsquo;Agence&nbsp;Francophone&nbsp;Australienne&rdquo;,&nbsp;interroger&nbsp;l&lsquo;AFA&nbsp;&agrave;&nbsp;proximit&eacute;&nbsp;du&nbsp;bien&nbsp;sur&nbsp;lequel&nbsp;vous&nbsp;souhaitez&nbsp;obtenir&nbsp;des&nbsp;renseignements.</p>\r\n\r\n<hr />\r\n<h1>Apr&egrave;s&nbsp;avoir&nbsp;fait&nbsp;votre&nbsp;choix,&nbsp;faites&nbsp;connaitre&nbsp;votre&nbsp;d&eacute;cision&nbsp;d&#39;achat&nbsp;au&nbsp;site&nbsp;&quot;Investir&nbsp;En&nbsp;Australie&quot;</h1>\r\n\r\n<p>Une&nbsp;fois&nbsp;que&nbsp;vous&nbsp;aurez&nbsp;obtenu&nbsp;les&nbsp;informations&nbsp;sur&nbsp;un&nbsp;produit&nbsp;particulier,&nbsp;si&nbsp;vous&nbsp;faites&nbsp;le&nbsp;choix&nbsp;d&lsquo;acqu&eacute;rir&nbsp;ce&nbsp;bien&nbsp;il&nbsp;vous&nbsp;sera&nbsp;demand&eacute;&nbsp;de&nbsp;cliquer&nbsp;sur&nbsp;le&nbsp;bouton &quot;Je voudrais acheter ce produit&quot;. Cela d&eacute;clenche la proc&eacute;dure d&#39;achat.</p>\r\n\r\n<hr />\r\n<h1>&nbsp;L&#39;agence&nbsp;francophone&nbsp;se&nbsp;charge&nbsp;des&nbsp;formalit&eacute;s&nbsp;juridiques&nbsp;de&nbsp;transfert&nbsp;de&nbsp;propri&eacute;t&eacute;</h1>\r\n\r\n<p>Apr&egrave;s confirmation de la disponibilit&eacute; du bien, de son retrait du march&eacute; et de sa r&eacute;servation &agrave; votre nom, le dossier est transf&eacute;r&eacute; &agrave; l&#39;AFA que vous aurez sp&eacute;cialement s&eacute;lectionn&eacute;e et qui se chargera de l&#39;accomplissement des formalit&eacute;s de transfert de propri&eacute;t&eacute;. Les d&eacute;lais de remise des cl&eacute;s d&eacute;pendront selon que le bien est d&eacute;j&agrave; construit et disponible, en cours de construction ou achet&eacute; sur plans.<br />&quot;Investrir En Australie&quot; vous suit et vous aide tout au long de la proc&eacute;dure en vous mettant en contact avec des professionnels francophones australiens en tant que de besoin.</p>\r\n\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '/3', 3, 0, 'fr', 1, 1, '2018-06-28 13:57:38', '2021-08-29 22:20:39', NULL),
(36, 'MESSAGE TO THE FRANCOPHONE COMMUNITY', '<p><span>You plan or wish to acquire real estate, a property; land, or an industrial or commercial business in Australia. This intention may correspond to a financial investment process, or be motivated by emotional reasons, a desire for another life, to prepare for your future retirement, or by an infinite number of other good reasons!</span></p>\r\n\r\n<p><span>The &quot;<strong>Investir en Australie</strong>&quot; site is an &ldquo;internet portal&rdquo; where; you can browse the offers in matters of new residential, real estate or commercial or industrial affairs in Australia, filed by Australians and, by registering as a &quot;<em>Member&quot;</em>, initiate an acquisition procedure while benefiting from legal assistance , financial and technical from our French-speaking Australian professional partners.</span></p>\r\n\r\n<p><span>Registration as a Member is completely free and does not impose any financial commitment on you. Acquisition transactions through the site do not entail any additional costs for the purchasing Members.</span></p>', '/1', 1, 0, 'en', 1, 1, '2021-01-20 00:22:37', '2021-01-20 01:04:22', NULL),
(37, 'ADVERTISING SPACES', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam.lorem</p>', '/2', 2, 1, 'en', 1, 1, '2021-01-20 03:08:31', '2021-01-20 03:09:19', NULL),
(38, 'HOW DOES THE SITE IEA WORK', '<div class=\"row\">\r\n<div class=\"col-md-3 col-xs-6 sec-three\">\r\n<div class=\"clearfix feature text-center\">\r\n<h1>Among&nbsp;all&nbsp;the&nbsp;products&nbsp;displayed&nbsp;on&nbsp;the&nbsp;site.&nbsp;select&nbsp;the&nbsp;one&nbsp;or&nbsp;those&nbsp;that&nbsp;interest&nbsp;you</h1>\r\n\r\n<p>Without&nbsp;having&nbsp;to&nbsp;be&nbsp;registered&nbsp;as&nbsp;a&nbsp;Member,&nbsp;you&nbsp;can&nbsp;browse&nbsp;all&nbsp;the&nbsp;products&nbsp;displayed&nbsp;on&nbsp;the&nbsp;site.&nbsp;To&nbsp;help&nbsp;you&nbsp;search&nbsp;for&nbsp;properties&nbsp;that&nbsp;meet&nbsp;your&nbsp;expectations:&nbsp;you&nbsp;select&nbsp;the&nbsp;object&nbsp;of&nbsp;your&nbsp;choice&nbsp;in&nbsp;the&nbsp;menu&nbsp;bar:&nbsp;real&nbsp;estate&nbsp;or&nbsp;business;&nbsp;depending&nbsp;on&nbsp;your&nbsp;previous&nbsp;choice,&nbsp;you&nbsp;have&nbsp;a&nbsp;panel&nbsp;that&nbsp;offers&nbsp;you&nbsp;different&nbsp;search&nbsp;criteria.&nbsp;The&nbsp;site&nbsp;then&nbsp;displays&nbsp;the&nbsp;search&nbsp;result&nbsp;corresponding&nbsp;to&nbsp;your&nbsp;criteria&nbsp;in&nbsp;the&nbsp;selected&nbsp;geographical&nbsp;location. Registration&nbsp;as&nbsp;a&nbsp;Member&nbsp;is&nbsp;only&nbsp;necessary&nbsp;if&nbsp;you&nbsp;wish&nbsp;to&nbsp;save&nbsp;your&nbsp;search&nbsp;criteria,&nbsp;a&nbsp;particular&nbsp;product&nbsp;in&nbsp;your&nbsp;&quot;Favorites&quot;;&nbsp;share&nbsp;a&nbsp;product&nbsp;with&nbsp;friends,&nbsp;contact&nbsp;a&nbsp;&quot;Local&nbsp;Partner&nbsp;Agency&quot;&nbsp;near&nbsp;at&nbsp;your&nbsp;home&nbsp;or&nbsp;a&nbsp;&quot;Francophone&nbsp;Australian&nbsp;Agency&quot;&nbsp;in&nbsp;the&nbsp;area&nbsp;of&nbsp;​​the&nbsp;property&nbsp;sought,&nbsp;or&nbsp;finally&nbsp;launch&nbsp;a&nbsp;purchase&nbsp;procedure.</p>\r\n\r\n<hr />\r\n<h1>Obtain&nbsp;from&nbsp;the&nbsp;agency&nbsp;the&nbsp;information&nbsp;you&nbsp;want&nbsp;on&nbsp;the&nbsp;selected&nbsp;property&nbsp;(s)</h1>\r\n\r\n<p>When&nbsp;a&nbsp;property&nbsp;interests&nbsp;you,&nbsp;you&nbsp;can,&nbsp;after&nbsp;registering&nbsp;as&nbsp;a&nbsp;Member&nbsp;of&nbsp;the&nbsp;site:&nbsp;by&nbsp;clicking&nbsp;&quot;List&nbsp;of&nbsp;Local&nbsp;Partner&nbsp;Agencies&quot;,&nbsp;get&nbsp;in&nbsp;touch&nbsp;with&nbsp;the&nbsp;APL&nbsp;near&nbsp;you&nbsp;who&nbsp;can&nbsp;inform&nbsp;and&nbsp;advise&nbsp;you;&nbsp;by&nbsp;clicking&nbsp;&quot;Contact&nbsp;the&nbsp;Agence&nbsp;Francophone&nbsp;Australienne&quot;,&nbsp;ask&nbsp;the&nbsp;AFA&nbsp;near&nbsp;the&nbsp;property&nbsp;on&nbsp;which&nbsp;you&nbsp;wish&nbsp;to&nbsp;obtain&nbsp;information.</p>\r\n\r\n<hr />\r\n<h1>Once&nbsp;you&nbsp;have&nbsp;obtained&nbsp;the&nbsp;information&nbsp;on&nbsp;a&nbsp;particular&nbsp;product,&nbsp;if&nbsp;you&nbsp;choose&nbsp;to&nbsp;purchase&nbsp;this&nbsp;property,&nbsp;you&nbsp;will&nbsp;be&nbsp;asked&nbsp;to&nbsp;click&nbsp;on&nbsp;the&nbsp;&quot;I&nbsp;would&nbsp;like&nbsp;to&nbsp;buy&nbsp;this&nbsp;product&quot;&nbsp;button.&nbsp;This&nbsp;triggers&nbsp;the&nbsp;purchase&nbsp;process.</h1>\r\n\r\n<p>After&nbsp;confirmation&nbsp;of&nbsp;the&nbsp;availability&nbsp;of&nbsp;the&nbsp;property,&nbsp;its&nbsp;withdrawal&nbsp;from&nbsp;the&nbsp;market&nbsp;and&nbsp;its&nbsp;reservation&nbsp;in&nbsp;your&nbsp;name,&nbsp;the&nbsp;file&nbsp;is&nbsp;transferred&nbsp;to&nbsp;the&nbsp;AFA&nbsp;which&nbsp;will&nbsp;take&nbsp;care&nbsp;of&nbsp;the&nbsp;completion&nbsp;of&nbsp;the&nbsp;formalities&nbsp;of&nbsp;transfer&nbsp;of&nbsp;ownership.&nbsp;depending&nbsp;on&nbsp;whether&nbsp;the&nbsp;property&nbsp;is&nbsp;already&nbsp;built&nbsp;and&nbsp;available,&nbsp;under&nbsp;construction&nbsp;or&nbsp;purchased&nbsp;on&nbsp;plans.&nbsp;&quot;Investir&nbsp;En&nbsp;Australie&quot;&nbsp;follows&nbsp;you&nbsp;and&nbsp;helps&nbsp;you&nbsp;throughout&nbsp;the&nbsp;procedure&nbsp;by&nbsp;putting&nbsp;you&nbsp;in&nbsp;contact&nbsp;with&nbsp;French-speaking&nbsp;Australian&nbsp;professionals&nbsp;as&nbsp;a&nbsp;of&nbsp;need.</p>\r\n\r\n<hr />\r\n<h1>Among&nbsp;all&nbsp;the&nbsp;products&nbsp;displayed&nbsp;on&nbsp;the&nbsp;site.&nbsp;select&nbsp;the&nbsp;one&nbsp;or&nbsp;those&nbsp;that&nbsp;interest&nbsp;you</h1>\r\n\r\n<p>After&nbsp;confirmation&nbsp;of&nbsp;the&nbsp;availability&nbsp;of&nbsp;the&nbsp;property,&nbsp;its&nbsp;withdrawal&nbsp;from&nbsp;the&nbsp;market&nbsp;and&nbsp;its&nbsp;reservation&nbsp;in&nbsp;your&nbsp;name,&nbsp;the&nbsp;file&nbsp;is&nbsp;transferred&nbsp;to&nbsp;the&nbsp;AFA&nbsp;which&nbsp;will&nbsp;take&nbsp;care&nbsp;of&nbsp;the&nbsp;completion&nbsp;of&nbsp;the&nbsp;formalities&nbsp;of&nbsp;transfer&nbsp;of&nbsp;ownership.&nbsp;depending&nbsp;on&nbsp;whether&nbsp;the&nbsp;property&nbsp;is&nbsp;already&nbsp;built&nbsp;and&nbsp;available,&nbsp;under&nbsp;construction&nbsp;or&nbsp;purchased&nbsp;on&nbsp;plans.&nbsp;&quot;Investir&nbsp;En&nbsp;Australie&quot;&nbsp;follows&nbsp;you&nbsp;and&nbsp;helps&nbsp;you&nbsp;throughout&nbsp;the&nbsp;procedure&nbsp;by&nbsp;putting&nbsp;you&nbsp;in&nbsp;contact&nbsp;with&nbsp;French-speaking&nbsp;Australian&nbsp;professionals&nbsp;as&nbsp;a&nbsp;of&nbsp;need.</p>\r\n</div>\r\n</div>\r\n</div>', '/3', 3, 0, 'en', 1, 1, '2021-01-20 03:12:20', '2021-01-20 03:31:06', NULL),
(39, 'MISSION / VISION', '<div class=\"col-sm-12 row sec-three-mission\">\r\n<div class=\"col-sm-12 row sec-three-mission-1\">\r\n<div class=\"bloc-1 col-sm-6\">\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">The &quot;Investir en Australie&quot; project has set itself the following mission:</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- To help develop relations between the international French-speaking community (more than 250 million French speakers around the world) and Australia by promoting investment in the island-continent through an exchange platform abundant, varied, reliable and user-friendly;</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- To facilitate and secure investment transactions by offering French-speaking investors legal, financial and technical assistance from French-speaking Australian professionals.</span></span></span></p>\r\n</div>\r\n\r\n<div class=\"bloc-2 col-sm-6\">\r\n<h4><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Our Mission</span></span></span></h4>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-sm-12 row sec-three-mission-2\">\r\n<div class=\"bloc-1 col-sm-6\">\r\n<h4><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Our Vision</span></span></span></h4>\r\n</div>\r\n\r\n<div class=\"bloc-2 col-sm-6\">\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">In carrying out its mission, the &quot;Invest in Australia&quot; project sets itself the following objectives:</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- Provided customer service that was its best competitive advantage;</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- To ultimately be, for the entire French-speaking community, the benchmark site for investment in Australia.</span></span></span></p>\r\n</div>\r\n</div>\r\n</div>', '/5', 5, 0, 'en', 1, 1, '2021-01-20 03:40:50', '2021-05-19 23:25:59', NULL),
(12, 'MISSION / VISION', '<div class=\"col-sm-12 row sec-three-mission\">\r\n<div class=\"col-sm-12 row sec-three-mission-1\">\r\n<div class=\"bloc-1 col-sm-6\">\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le projet &quot;Investir en Australie&quot; s&#39;est fix&eacute; pour mission:</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- D&#39;aider au d&eacute;veloppement des relations entre la communaut&eacute; francophone internationale (plus de 250 millions de locuteurs fran&ccedil;ais &agrave; travers le monde) et l&#39;Australie en favorisant l&#39;investissement dans l&#39;&icirc;le-continent par le biais d&#39;une plateforme d&#39;&eacute;change abondante, vari&eacute;e, fiable et conviviale;</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- De faciliter et s&eacute;curiser les transactions d&#39;investissement en offrant aux investisseurs francophones l&#39;assistance juridique, financi&egrave;re et technique de professionnels australiens francophones.</span></span></span></p>\r\n</div>\r\n\r\n<div class=\"bloc-2 col-sm-6\">\r\n<h4><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Notre Mission</span></span></span></h4>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-sm-12 row sec-three-mission-2\">\r\n<div class=\"bloc-1 col-sm-6\">\r\n<h4><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Notre Vision</span></span></span></h4>\r\n</div>\r\n\r\n<div class=\"bloc-2 col-sm-6\">\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Dans l&#39;accomplissement de sa mission le projet &quot;Investir en Australie&quot; se fixe pour objectifs:</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- D&#39;offrir un service &agrave; la client&egrave;le qui soit son meilleur avantage concurrentiel;</span></span></span></p>\r\n\r\n<p><span style=\"color:#000000\"><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">- D&#39;&ecirc;tre &agrave; terme, pour l&#39;ensemble de la communaut&eacute; francophone, le site de r&eacute;f&eacute;rence en mati&egrave;re d&#39;investissement en Australie.</span></span></span></p>\r\n</div>\r\n</div>\r\n</div>', '/5', 5, 0, 'fr', 1, 1, '2018-06-28 13:57:38', '2021-05-30 21:34:40', NULL),
(13, 'CONSEIL JURIDIQUE', '<p>Pour assister et repr&eacute;senter ses Membres qui proc&egrave;dent &agrave; des investissements, et pour prendre en charge le dossier juridique de leurs transactions, le syst&egrave;me &quot;<strong>Investir En Australie</strong>&quot; est &agrave; la recherche de partenariats avec des solicitors francophones australiens au Queensland et dans d&#39;autres Etats australiens. Merci de nous contacter sur notre page Facebook &quot;<em>Investir En Australie</em>&quot;</p>', '/services', 1, 0, 'fr', 3, 1, '2018-06-28 13:57:38', '2021-04-17 03:17:43', NULL),
(43, 'ADVERTISING SPACES', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam.lorem</p>\r\n\r\n<p>&nbsp;</p>', '/4', 4, 1, 'en', 1, 1, '2018-06-28 13:57:38', '2020-09-03 09:47:46', NULL),
(44, 'ADVERTISING SPACES', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam.lorem</p>\r\n\r\n<p>&nbsp;</p>', '/6', 6, 1, 'en', 1, 1, '2018-06-28 13:57:38', '2020-09-03 09:47:46', NULL),
(14, 'IMMIGRATION', '<p>Lorsque la d&eacute;marche d&#39;<strong>investissement en Australie</strong> fait partie d&#39;un projet d&#39;installation personnelle qu&#39;elle soit &agrave; moyen ou long terme, ou d&eacute;finitive, le candidat &agrave; l&#39;immigration se voit confront&eacute; &agrave; une proc&eacute;dure relativement complexe parfois difficile &agrave; cerner par les personnes non averties. C&#39;est d&#39;ailleurs cette complexit&eacute; qui a amen&eacute; le gouvernement australien &agrave; d&eacute;livrer des qualifications de &quot;<em>migration agents</em>&quot; &agrave; certains juristes sp&eacute;cialis&eacute;s. Entamer une proc&eacute;dure selon une approche qui ne correspond pas, aux yeux de la loi australienne, &agrave; la situation du candidat, peut faire perdre beaucoup d&#39;&eacute;nergie, de temps et d&#39;argent. Aussi, il est fortement conseill&eacute; aux personnes d&eacute;sirant venir en Australie pour une dur&eacute;e plus longue que le simple visa de tourisme de trois mois de s&#39;adresser &agrave; un homme de droit comp&eacute;tent. &quot;<strong>Investir en Australie</strong>&quot; vous propose les services d&#39;un agent d&#39;immigration francophone, ce qui vous simplifiera grandement la d&eacute;marche. Nous contacter.</p>', '/services/1', 2, 0, 'fr', 3, 1, '2018-06-28 13:57:38', '2021-04-17 02:32:41', NULL),
(40, 'ESPACES PUBLICITES', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam.lorem</p>\r\n\r\n<p>&nbsp;</p>', '/4', 4, 1, 'fr', 1, 1, '2018-06-28 13:57:38', '2020-09-03 09:47:46', NULL),
(41, 'ESPACES PUBLICITES', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam.lorem</p>\r\n\r\n<p>&nbsp;</p>', '/6', 6, 1, 'fr', 1, 1, '2018-06-28 13:57:38', '2020-09-03 09:47:46', NULL),
(15, 'Espaces Publicitaires', '<p class=\"wow slideInRight\" style=\"visibility: hidden; animation-name: none;\">\n                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut <br>\n                        labore et dolore magna aliquan ut enim ad minim veniam.</p>\n                <a class=\"btn\" href=\"#\">\n                    <img src=\"/images/iso-btn.png\" alt=\"ISO Button\">\n                </a>\n                <a class=\"btn\" href=\"#\">\n                    <img src=\"/images/playstore-btn.png\" alt=\"Play Store Button\">\n                </a>', '/services/2', 3, 1, 'fr', 3, 1, '2018-06-28 13:57:38', NULL, NULL),
(16, 'CONSEIL FINANCIER ET BANCAIRE', '<p>Le gouvernement australien a pris en 2018 des mesures r&eacute;glementaires qui interdisent en pratique aux banques australiennes de pr&ecirc;ter &agrave; des &eacute;trangers non-r&eacute;sidents pour des investissements r&eacute;sidentiels. Cela a mis un coup d&#39;arr&ecirc;t brutal aux flux d&#39;investissements immobiliers en provenance de l&#39;&eacute;tranger. Il est cependant improbable qu&#39;une telle situation se perp&eacute;tue ind&eacute;finiment, et nous pensons que t&ocirc;t ou tard cette situation se d&eacute;bloquera et que nos Membres pourront recourir &agrave; des conseillers financiers et bancaires pour parfaire le plan de financement de leurs investissements.</p>\r\n\r\n<p>&quot;<strong>Investir En Australie</strong>&quot; est donc &agrave; la recherche de partenariats avec des conseillers et courtiers bancaires francophones australiens</p>', '/services/3', 4, 0, 'fr', 3, 1, '2018-06-28 13:57:38', '2021-04-17 03:36:18', NULL),
(17, 'CONSEIL COMPTABLE ET FISCAL', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat.', '/services/4', 5, 0, 'fr', 3, 1, '2018-06-28 13:57:38', NULL, NULL),
(18, 'Espaces Publicitaires', '<p class=\"wow slideInRight\" style=\"visibility: hidden; animation-name: none;\">\n                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut <br>\n                        labore et dolore magna aliquan ut enim ad minim veniam.</p>\n                <a class=\"btn\" href=\"#\">\n                    <img src=\"/images/iso-btn.png\" alt=\"ISO Button\">\n                </a>\n                <a class=\"btn\" href=\"#\">\n                    <img src=\"/images/playstore-btn.png\" alt=\"Play Store Button\">\n                </a>', '/services/5', 6, 1, 'fr', 3, 1, '2018-06-28 13:57:38', NULL, NULL),
(19, 'AGENCE DE TRADUCTION ET INTERPRÉTARIAT', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat.', '/services/6', 7, 0, 'fr', 3, 1, '2018-06-28 13:57:38', NULL, NULL),
(20, 'AGENCES PARTENAIRES LOCALES', '<p>Le syst&egrave;me &quot;<strong>Investir En Australie</strong>&quot; - IEA souhaite se rapproche le plus possible de ses &quot;Membres&quot;. Chez IEA nous comprenons que ce n&#39;est pas une mince affaire que de conduire une d&eacute;marche d&#39;investissement au long cours, &agrave; l&#39;&eacute;tranger, en anglais, sous un r&eacute;gime juridique inconnu, et qu&#39;il est toujours utile de se sentir &eacute;paul&eacute; et r&eacute;confort&eacute;. Aussi, au-del&agrave; de l&#39;organisation que nous avons mise en place sur le sol australien pour accueillir nos Membres et les aider &agrave; r&eacute;aliser leur projet, nous avons pens&eacute; qu&#39;il serait hautement profitable pour eux d&#39;avoir un conseiller pr&egrave;s de chez eux, dans leur pays d&#39;origine. C&#39;est pourquoi, &agrave; IEA, nous avons d&eacute;velopp&eacute; dans les pays de la francophonie des partenariats avec des &quot;<em>Agences Partenaires Locales</em>&quot; - APL qui sont nos correspondants et qui se tiennent &agrave; votre disposition pour vous &eacute;clairer et vous guider dans vos choix. Pour joindre une de ces agences, cliquer APL.</p>', '/services/7', 8, 0, 'fr', 3, 1, '2018-06-28 13:57:38', '2021-04-17 03:03:33', NULL),
(21, 'CONSEIL EN ÉVALUATION D’AFFAIRES INDUSTRIELLES ET COMMERCIALES', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat.', '/services/8', 9, 0, 'fr', 3, 1, '2018-06-28 13:57:38', NULL, NULL),
(22, 'Connexion', 'Sed perspiciatis unde natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.', '/login', 0, 0, 'fr', 0, 1, '2018-06-28 13:57:38', NULL, NULL),
(23, 'Login', '\n                        <div class=\"row\">\n                            <div class=\"col-md-6\">\n                                <i class=\"fa fa-map-marker\"></i>\n                                <div class=\"contents\">\n                                    <h6 class=\"title\">Mailing Address</h6>\n                                    <address>\n                                        95 Amphitheatre Parkway\n                                        Mountain View CA,\n                                        United States\n                                    </address>\n                                </div>\n                            </div>\n                            <div class=\"col-md-6\">\n                                <i class=\"fa fa-phone\"></i>\n                                <div class=\"contents\">\n                                    <h5 class=\"title\">Contact Info</h5>\n                                    <ul>\n                                        <li>Phone: (123) 45678910</li>\n                                        <li>Mail: company@domain.com</li>\n                                        <li>Fax: +84 962 216 601</li>\n                                    </ul>\n                                </div>\n                            </div>\n                        </div>\n', '/login/1', 0, 0, 'fr', 22, 1, '2018-06-28 13:57:38', NULL, NULL),
(24, 'Login', 'Sed perspiciatis unde natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.', '/login', 0, 0, 'en', 0, 1, '2018-06-28 13:57:38', NULL, NULL),
(25, 'Login', '\n                        <div class=\"row\">\n                            <div class=\"col-md-6\">\n                                <i class=\"fa fa-map-marker\"></i>\n                                <div class=\"contents\">\n                                    <h6 class=\"title\">Mailing Address</h6>\n                                    <address>\n                                        95 Amphitheatre Parkway\n                                        Mountain View CA,\n                                        United States\n                                    </address>\n                                </div>\n                            </div>\n                            <div class=\"col-md-6\">\n                                <i class=\"fa fa-phone\"></i>\n                                <div class=\"contents\">\n                                    <h5 class=\"title\">Contact Info</h5>\n                                    <ul>\n                                        <li>Phone: (123) 45678910</li>\n                                        <li>Mail: company@domain.com</li>\n                                        <li>Fax: +84 962 216 601</li>\n                                    </ul>\n                                </div>\n                            </div>\n                        </div>\n', '/login/1', 0, 0, 'en', 22, 1, '2018-06-28 13:57:38', NULL, NULL),
(26, 'Message d\'information', 'Merci de votre intention de vous inscrire en qualité de Membre sur le site \"Investir en Australie\". En plus de pouvoir, comme tout Visiteur, voir dans le détail les produits et opérer des sélections multicritères, votre inscription vous permettra d\'enregistrer vos recherches multicritères, d\'enregistrer les produits qui vous intéressent dans vos \"favoris\", de partager des produits avec vos amis par emails et sur les réseaux sociaux, d\'échanger avec une Agence Francophone Australienne située à proximité du bien qui vous intéresse. Lorsque vous aurez pris la décision d\'acheter vous pourrez lancer la procédure d\'acquisition en ligne. Au cours de cette procédure il vous sera proposé les services de certains de nos partenaires australiens francophones auxquels vous pourriez faire appel si vous en aviez besoin.', '/register/member', 0, 0, 'fr', 0, 1, '2018-06-28 13:57:38', NULL, NULL),
(27, 'Message d\'information', 'Merci de votre intention de vous inscrire en qualité de Membre sur le site \"Investir en Australie\". En plus de pouvoir, comme tout Visiteur, voir dans le détail les produits et opérer des sélections multicritères, votre inscription vous permettra d\'enregistrer vos recherches multicritères, d\'enregistrer les produits qui vous intéressent dans vos \"favoris\", de partager des produits avec vos amis par emails et sur les réseaux sociaux, d\'échanger avec une Agence Francophone Australienne située à proximité du bien qui vous intéresse. Lorsque vous aurez pris la décision d\'acheter vous pourrez lancer la procédure d\'acquisition en ligne. Au cours de cette procédure il vous sera proposé les services de certains de nos partenaires australiens francophones auxquels vous pourriez faire appel si vous en aviez besoin.', '/register/member', 0, 0, 'en', 0, 1, '2018-06-28 13:57:38', NULL, NULL),
(28, 'Explanation message', 'The Seller must accept The Terms and Conditions of Use of \"Investir en Australie\" website and make the commitment to display only products that can be sold to non-resident foreigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).', '/register/seller', 0, 0, 'en', 0, 1, '2018-06-28 13:57:38', NULL, NULL),
(29, 'Explanation message', 'The Seller must accept The Terms and Conditions of Use of \"Investir en Australie\" website and make the commitment to display only products that can be sold to non-resident foreigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).', '/register/seller', 0, 0, 'fr', 0, 1, '2018-06-28 13:57:38', NULL, NULL),
(30, 'Explanation message', 'The Australian Francophone Agents are Australian agents who are partners with \"Investir en Australie\" website. They are the essential link in the material realization of the sale of the products posted on the site, but they can also sell their own products.The Australian Francophone Agent must make the commitment to provide prospective or actual purchasers with a service in French during preliminary sales and during sales transactions. They must also accept that a clientele introductory fee (\"Commission de Présentation de Clientèle\" - CPC) will be due to the company managing IEA website in case of actual sale of products, accept and respect the Terms and Conditions of Use of the site, and make the commitment to verify and guarantee that the products for the sale of which they are the operating agent are effectively residential, land, industrial or commercial properties which may be sold to non-resident foreigners in accordance with the Australian law and the rules applicable to foreign investment by the Foreign Investment Review Board (FIRB).', '/register/afa', 0, 0, 'en', 0, 1, '2018-06-28 13:57:38', NULL, NULL);
INSERT INTO `pages` (`id`, `title`, `content`, `path`, `page_order`, `is_pub`, `language`, `parent_id`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(31, 'Explanation message', 'The Australian Francophone Agents are Australian agents who are partners with \"Investir en Australie\" website. They are the essential link in the material realization of the sale of the products posted on the site, but they can also sell their own products.The Australian Francophone Agent must make the commitment to provide prospective or actual purchasers with a service in French during preliminary sales and during sales transactions. They must also accept that a clientele introductory fee (\"Commission de Présentation de Clientèle\" - CPC) will be due to the company managing IEA website in case of actual sale of products, accept and respect the Terms and Conditions of Use of the site, and make the commitment to verify and guarantee that the products for the sale of which they are the operating agent are effectively residential, land, industrial or commercial properties which may be sold to non-resident foreigners in accordance with the Australian law and the rules applicable to foreign investment by the Foreign Investment Review Board (FIRB).', '/register/afa', 0, 0, 'fr', 0, 1, '2018-06-28 13:57:38', NULL, NULL),
(32, 'Message d\'information', 'Les Agences Partenaires Locales (APL) sont des agences immobilières et d\'affaires opérant dans des pays et territoires francophones qui souhaitent participer au courant d\'investissement que développe le projet \"Investir en Australie\" (IEA). Dans ce cadre, l\'APL est chargée d\'une Mission d\'Information, d\'Orientation et de Promotion (MIOP) en direction des Membres du site IEA. Les Membres qui souhaitent une assistance locale pour leur démarche d\'investissement en Australie souscrivent une relation exclusive de 180 jours avec une APL près de chez eux. En cas d\'achat par le Membre inscrit auprès d\'une APL, celle-ci perçoit une \"Commission de Contribution aux Ventes (CCV) égale à un pourcentage du prix de vente du bien. Le montant de cette CCV peut être doublé si l\'APL a été à l\'origine d\'un certain montant de chiffre d\'affaires au cours de l\'année précédente.', '/register/apl', 0, 0, 'fr', 0, 1, '2018-06-28 13:57:38', NULL, NULL),
(33, 'Message d\'information', 'Les Agences Partenaires Locales (APL) sont des agences immobilières et d\'affaires opérant dans des pays et territoires francophones qui souhaitent participer au courant d\'investissement que développe le projet \"Investir en Australie\" (IEA). Dans ce cadre, l\'APL est chargée d\'une Mission d\'Information, d\'Orientation et de Promotion (MIOP) en direction des Membres du site IEA. Les Membres qui souhaitent une assistance locale pour leur démarche d\'investissement en Australie souscrivent une relation exclusive de 180 jours avec une APL près de chez eux. En cas d\'achat par le Membre inscrit auprès d\'une APL, celle-ci perçoit une \"Commission de Contribution aux Ventes (CCV) égale à un pourcentage du prix de vente du bien. Le montant de cette CCV peut être doublé si l\'APL a été à l\'origine d\'un certain montant de chiffre d\'affaires au cours de l\'année précédente.', '/register/apl', 0, 0, 'en', 0, 1, '2018-06-28 13:57:38', NULL, NULL),
(34, 'CERTIFICATION DE DOCUMENTS ET SIGNATURES', 'Il est souvent demand&eacute; aux investisseurs en Australie de faire certifier des documents ou des signatures. D&#39;assez nombreuses professions sont autoris&eacute;es &agrave; accomplir cette mission. Mais c&#39;est la pricipale mission des personnes asserment&eacute;es en qualit&eacute; de &quot;<em>Justice Of The Peace</em>&quot;. Cette fonction est gratuite pour le demandeur.\r\n\r\nL&#39;un de nos partenaires, francophone, est titulaire de cette fonction, et se fera un plaisir de vous assister dans vos d&eacute;marches dans ce domaine.', '/services/2', 3, 0, 'fr', 3, 1, '2020-07-26 01:57:36', '2020-08-14 21:17:42', NULL),
(45, 'Qui nous sommes', '<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le syst&egrave;me &quot;<em>Investir En Australie</em>&quot; (IEA) pr&eacute;sente des opportunit&eacute;s d&#39;<strong>investissement en Australie</strong> dans les secteurs de l&#39;immobilier (r&eacute;sidentiel - foncier) et des affaires (commercial - industriel) que recherche la communaut&eacute; francophone du monde entier (275 millions de locuteurs de la langue fran&ccedil;aise &agrave; travers le monde). Le site internet est g&eacute;r&eacute; et maintenu par la soci&eacute;t&eacute; IICC Sarl &eacute;tablie en Nouvelle Cal&eacute;donie.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Sur le portail internet (e-marketplace) &quot;Investir en Australie&quot; les acheteurs (&quot;<em>Membres</em>&quot;) peuvent, sous couvert de l&#39;anonymat, &eacute;changer avec les agences francophones charg&eacute;es des op&eacute;rations des transactions. L&#39;anonymat n&#39;est lev&eacute; qu&#39;&agrave; partir du moment o&ugrave; la transaction est engag&eacute;e.</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Passer par le site &quot;<strong>Investir en Australie</strong>&quot; pr&eacute;sente l&#39;avantage pour le <em>Membre</em> de pouvoir b&eacute;n&eacute;ficier des prestations de tous les intervenants n&eacute;cessaires dans une proc&eacute;dure d&#39;achat, <u>dans un environnement francophone</u> dans toute la mesure du possible, et cela d&egrave;s votre pays ou territoire d&#39;origine:</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">►&nbsp;&quot;Agences Partenaires Locales&quot; (APL) correspondantes du syst&egrave;me IEA dans votre pays ou territoire de r&eacute;sidence;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">►<span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;&quot;Agences Francophones Australiennes&quot; (AFA), charg&eacute;es des transactions sur le sol australien;</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">►<span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;a<span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">vocat (solicitor) sp&eacute;cialis&eacute; en droit immobilier qui se charge du contr&ocirc;le l&eacute;gal du contrat de vente;</span></span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">►<span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span></span></span></span></span><span style=\"font-family:Arial,Helvetica,sans-serif\">c</span><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">onseiller financier et bancaire; <span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">juriste (solicitor) agr&eacute;&eacute; en mati&egrave;re de visas d&#39;immigration;</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">►<span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;</span></span>agent agr&eacute;&eacute; &quot;Justice of the Peace&quot; pour la certification de documents;</span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">►<span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;agence de traduction et d&#39;interpr&eacute;tariat <u>fran&ccedil;ais-anglais</u> accr&eacute;dit&eacute;e NAATI&nbsp;(National Accreditation Authority for Translators and Interpreters) par le gouvernement australien;</span></span></span></span></span></p>\r\n\r\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">►<span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&nbsp;agence comptable et fiscale.</span></span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Le recours aux services IEA n&#39;a aucune influence sur le co&ucirc;t final de l&#39;investissement envisag&eacute;. L&#39;inscription en qualit&eacute; de <em>Membre</em> est gratuite. En cas de transaction effective la r&eacute;mun&eacute;ration de IEA est assur&eacute;e, de convention expresse, par la commission sur vente pay&eacute;e &agrave; l&#39;agence immobili&egrave;re (AFA) par le vendeur, sans augmentation de prix pour l&#39;acheteur.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:16px\"><span style=\"color:#000000\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Pour une plus large information nous vous recommandons de parcourir les articles sp&eacute;cialis&eacute;s de notre blog.</span></span></span></p>', '/about', 1, 0, 'fr', 45, 1, '2021-06-04 06:54:39', '2021-07-08 23:02:20', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `page_images`
--

CREATE TABLE `page_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` bigint(20) NOT NULL DEFAULT 0,
  `image_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `page_images`
--

INSERT INTO `page_images` (`id`, `page_id`, `image_id`, `created_at`, `updated_at`) VALUES
(1, 9, 109, NULL, NULL),
(2, 11, 110, NULL, NULL),
(8, 36, 109, NULL, NULL),
(3, 11, 111, NULL, NULL),
(4, 11, 112, NULL, NULL),
(5, 11, 113, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `parameters`
--

CREATE TABLE `parameters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `parameters`
--

INSERT INTO `parameters` (`id`, `name`, `value`, `content`, `created_at`, `updated_at`) VALUES
(1, 'x_line', '2', 'Toutes les \"x\" lignes apparaît une ligne d\'affichage aléatoire d\'un article du blog dans la page programme', '2021-04-06 18:00:00', '2021-05-27 05:32:03'),
(2, 'nb_day_new_prod', '30', 'Durée (en jours) pendant laquelle un programme ou un produit est considéré comme \"nouveau\" ou \"récent\"', '2021-05-17 21:00:00', '2021-05-27 05:32:03'),
(3, 'nb_day_end_apl', '180', 'Durée (en jours) de fin de relation exclusive entre apl et membre', '2021-07-26 21:00:00', '2021-07-26 21:00:00'),
(4, 'nb_day_end_afa', '90', 'Durée (en jours) de fin de relation exclusive entre afa et membre', '2021-07-26 21:00:00', '2021-07-26 21:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `parameters_emails`
--

CREATE TABLE `parameters_emails` (
  `id` bigint(20) NOT NULL,
  `libelle` text NOT NULL,
  `nom_variable` varchar(100) NOT NULL,
  `model_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parameters_emails`
--

INSERT INTO `parameters_emails` (`id`, `libelle`, `nom_variable`, `model_name`, `created_at`, `updated_at`) VALUES
(1, 'Nom de l\'utilisateur par email to', '[USER_NAME]', '\\App\\Models\\User::where(\'id\',1)->get()', '2021-07-06 08:34:28', '2021-07-06 06:05:52'),
(2, 'Afficher le mot de passe de l\'utilisateur', '[MOT_DE_PASSE_USER]', NULL, '2021-07-06 06:13:03', '2021-07-06 06:13:03');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('tadiokaze@gmail.com', '$2y$10$wVdST0IIWeH7NyKsaOdkK.E0JfV7ZFx3uaCqzJIoqwURH/ZMGZub2', '2020-09-02 10:22:15'),
('rakotolita@yopmail.com', '$2y$10$JwpQOehy1a4jV9dtB1iSxeBpafZI.N9dyjrBPzrj2Q8wFfBAe5DAu', '2021-03-04 04:41:20');

-- --------------------------------------------------------

--
-- Structure de la table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` double(8,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plans`
--

INSERT INTO `plans` (`id`, `slug`, `name`, `cost`, `description`, `type`, `role`, `created_at`, `updated_at`) VALUES
(1, 'member-daily', 'Member Daily', 10.00, 'description', 'daily', 'member', '2018-06-28 16:57:39', '2021-01-28 05:27:42'),
(2, 'member-weekly', 'Member Weekly', 13.00, NULL, 'weekly', 'member', '2018-06-28 16:57:39', NULL),
(3, 'member-bi-monthly', 'Member Bi-monthly', 16.00, NULL, 'bi-monthly', 'member', '2018-06-28 16:57:39', NULL),
(4, 'member-monthly', 'Member Monthly', 19.00, NULL, 'monthly', 'member', '2018-06-28 16:57:39', NULL),
(5, 'member-bi-yearly', 'Member Bi-yearly', 22.00, NULL, 'bi-yearly', 'member', '2018-06-28 16:57:39', NULL),
(6, 'member-tri-yearly', 'Member Tri-yearly', 25.00, NULL, 'tri-yearly', 'member', '2018-06-28 16:57:39', NULL),
(7, 'member-yearly', 'Member Yearly', 28.00, NULL, 'yearly', 'member', '2018-06-28 16:57:39', NULL),
(8, 'seller-daily', 'Seller Daily', 31.00, NULL, 'daily', 'seller', '2018-06-28 16:57:39', NULL),
(9, 'seller-weekly', 'Seller Weekly', 34.00, NULL, 'weekly', 'seller', '2018-06-28 16:57:39', NULL),
(10, 'seller-bi-monthly', 'Seller Bi-monthly', 37.00, NULL, 'bi-monthly', 'seller', '2018-06-28 16:57:39', NULL),
(11, 'seller-monthly', 'Seller Monthly', 40.00, NULL, 'monthly', 'seller', '2018-06-28 16:57:39', NULL),
(12, 'seller-bi-yearly', 'Seller Bi-yearly', 43.00, NULL, 'bi-yearly', 'seller', '2018-06-28 16:57:39', NULL),
(13, 'seller-tri-yearly', 'Seller Tri-yearly', 46.00, NULL, 'tri-yearly', 'seller', '2018-06-28 16:57:39', NULL),
(14, 'seller-yearly', 'Seller Yearly', 49.00, NULL, 'yearly', 'seller', '2018-06-28 16:57:39', NULL),
(15, 'afa-daily', 'Afa Daily', 52.00, NULL, 'daily', 'afa', '2018-06-28 16:57:39', NULL),
(16, 'afa-weekly', 'Afa Weekly', 55.00, NULL, 'weekly', 'afa', '2018-06-28 16:57:39', NULL),
(17, 'afa-bi-monthly', 'Afa Bi-monthly', 58.00, NULL, 'bi-monthly', 'afa', '2018-06-28 16:57:39', NULL),
(18, 'afa-monthly', 'Afa Monthly', 61.00, NULL, 'monthly', 'afa', '2018-06-28 16:57:39', NULL),
(19, 'afa-bi-yearly', 'Afa Bi-yearly', 64.00, NULL, 'bi-yearly', 'afa', '2018-06-28 16:57:39', NULL),
(20, 'afa-tri-yearly', 'Afa Tri-yearly', 67.00, NULL, 'tri-yearly', 'afa', '2018-06-28 16:57:39', NULL),
(21, 'afa-yearly', 'Afa Yearly', 70.00, NULL, 'yearly', 'afa', '2018-06-28 16:57:39', NULL),
(22, 'apl-daily', 'Apl Daily', 73.00, NULL, 'daily', 'apl', '2018-06-28 16:57:39', NULL),
(23, 'apl-weekly', 'Apl Weekly', 76.00, NULL, 'weekly', 'apl', '2018-06-28 16:57:39', NULL),
(24, 'apl-bi-monthly', 'Apl Bi-monthly', 79.00, NULL, 'bi-monthly', 'apl', '2018-06-28 16:57:39', NULL),
(25, 'apl-monthly', 'Apl Monthly', 82.00, NULL, 'monthly', 'apl', '2018-06-28 16:57:39', NULL),
(26, 'apl-bi-yearly', 'Apl Bi-yearly', 85.00, NULL, 'bi-yearly', 'apl', '2018-06-28 16:57:39', NULL),
(27, 'apl-tri-yearly', 'Apl Tri-yearly', 88.00, NULL, 'tri-yearly', 'apl', '2018-06-28 16:57:39', NULL),
(28, 'apl-yearly', 'Apl Yearly', 91.00, NULL, 'yearly', 'apl', '2018-06-28 16:57:39', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `postalcodes`
--

CREATE TABLE `postalcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `postalcodes`
--

INSERT INTO `postalcodes` (`id`, `content`, `created_at`, `updated_at`) VALUES
(1, '4215', '2020-07-22 03:57:27', '2020-07-22 03:57:27'),
(2, '4217', '2020-07-22 03:57:38', '2020-07-22 03:57:38'),
(3, '4216', '2020-07-22 03:57:54', '2020-07-22 03:57:54');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ancienneteBien` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(Neuf, Ancien)',
  `natureBien` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(Programme immobilier, Produit individuel)',
  `reference` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT 1,
  `is_new` int(11) NOT NULL DEFAULT 0,
  `view_count` bigint(20) NOT NULL DEFAULT 0,
  `area` double(20,2) DEFAULT NULL,
  `unite_area` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carport_spaces` int(11) NOT NULL DEFAULT 0,
  `garage_spaces` int(11) NOT NULL DEFAULT 0,
  `off_street_spaces` int(11) NOT NULL DEFAULT 0,
  `bathrooms` int(11) NOT NULL DEFAULT 0,
  `bedrooms` int(11) NOT NULL DEFAULT 0,
  `ensuite` int(11) NOT NULL DEFAULT 0,
  `land_area` int(11) NOT NULL DEFAULT 0,
  `floor_area` int(11) NOT NULL DEFAULT 0,
  `number_of_floors` int(11) NOT NULL DEFAULT 0,
  `new_construction` tinyint(1) NOT NULL DEFAULT 0,
  `year_built` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(20,2) DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tma` double(8,2) DEFAULT NULL,
  `commission_type` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commision` double(8,2) DEFAULT NULL,
  `commision_edited` int(11) NOT NULL DEFAULT 0,
  `avoir_bonus` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'yes, no',
  `amount_bonus` decimal(10,0) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `type_id` bigint(20) NOT NULL DEFAULT 0,
  `location_type_id` bigint(20) NOT NULL DEFAULT 0,
  `category_id` bigint(20) DEFAULT 0,
  `buyer_id` bigint(20) NOT NULL DEFAULT 0,
  `seller_id` bigint(20) NOT NULL DEFAULT 0,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `postalCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` bigint(20) NOT NULL DEFAULT 0,
  `location_id` bigint(20) NOT NULL DEFAULT 0,
  `image_id` bigint(20) NOT NULL DEFAULT 0,
  `parent_id` bigint(20) NOT NULL,
  `min_price` double(10,2) NOT NULL,
  `max_price` double(10,2) NOT NULL,
  `interior_area` int(11) DEFAULT 0,
  `exterior_area` int(11) DEFAULT 0,
  `total_area` int(11) DEFAULT 0,
  `superficie_jardin` decimal(10,2) DEFAULT NULL,
  `avoir_parking_voie_public` int(10) DEFAULT NULL COMMENT '0 = non, 1 = oui',
  `nb_parking_spots` int(10) DEFAULT NULL,
  `avoir_piscine` int(10) DEFAULT NULL COMMENT '0 = non, 1 = oui',
  `image_fond_dossier_id` bigint(20) DEFAULT NULL,
  `dt_db_travaux` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_prevu_livraison` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_area` int(10) DEFAULT NULL,
  `max_area` int(10) DEFAULT NULL,
  `validated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `ancienneteBien`, `natureBien`, `reference`, `slug`, `title`, `content`, `quantity`, `is_new`, `view_count`, `area`, `unite_area`, `carport_spaces`, `garage_spaces`, `off_street_spaces`, `bathrooms`, `bedrooms`, `ensuite`, `land_area`, `floor_area`, `number_of_floors`, `new_construction`, `year_built`, `display_address`, `price`, `currency`, `tma`, `commission_type`, `commision`, `commision_edited`, `avoir_bonus`, `amount_bonus`, `status`, `type_id`, `location_type_id`, `category_id`, `buyer_id`, `seller_id`, `author_id`, `postalCode`, `state_id`, `location_id`, `image_id`, `parent_id`, `min_price`, `max_price`, `interior_area`, `exterior_area`, `total_area`, `superficie_jardin`, `avoir_parking_voie_public`, `nb_parking_spots`, `avoir_piscine`, `image_fond_dossier_id`, `dt_db_travaux`, `dt_prevu_livraison`, `property_detail`, `min_area`, `max_area`, `validated_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '', '', 'ref-p000002', 'melbourne-appartement', 'Ilfracombe Appartement', 'C\'est un superbe appartement de 2 chambres situé à Melbourne en Australie. L\'appartement pourrait être utilisé comme une maison de vacances ou comme une résidence permanente. Il y a une salle de réception incluse avec la propriété. En outre, la propriété est également entièrement meublée. Avec la propriété il y a une piscine communale incluse. Avec la piscine communale il y a aussi un jardin privé. La taille de la parcelle est mesurée à 75 mètres carrés. avec la surface couverte étant 75m2. Parking disponible inclus avec la propriété serait hors stationnement dans la rue.', 1, 0, 387, NULL, NULL, 0, 0, 0, 0, 2, 0, 400, 0, 0, 0, NULL, NULL, 7800000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 2, 8, 1, 0, 9, 2, NULL, 5, 7, 2, 0, 0.00, 0.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-28 13:57:38', '2018-06-28 13:57:38', '2021-08-23 21:56:56', NULL),
(3, '', '', 'ref-p000003', 'newport-bureau', 'Newport Bureau', 'C\'est une opportunité à ne pas manquer. Travaillez au bord de la mer ... Cette suite bureau au bord de l\'eau donnant sur les magnifiques voies navigables de Pittwater est située dans la banlieue très prisée de Newport. Situé dans un lotissement résidentiel sécurisé, la suite bénéficie d\'une excellente lumière naturelle tout au long de la journée depuis les grandes baies vitrées qui donnent sur une vue dont vous ne serez jamais fatigué! Caractéristiques de la propriété: - Bureau de 41m² + Cour extérieure exclusive de 21m² - Bureau au bord de l\'eau - Suite magnifiquement présentable donnant sur Pittwater - Planchers de bois à l\'entrée - Système de climatisation indépendant - Développement sécurisé avec accès par ascenseur - Système d\'intercom et câblé - Parking unique sécurisé - & kitchen En plus, il y a une opportunité d\'acquérir 9 Moorings pour une entreprise marine si nécessaire - 7 x situé à Winji Jimmi Bay, 1 x situé à Northern End of Scotland Island, 1 x situé à America\'s Bay', 1, 0, 100, NULL, NULL, 0, 0, 0, 0, 0, 0, 800, 0, 0, 0, NULL, NULL, 3600000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 3, 9, 2, 0, 9, 2, NULL, 0, 3, 3, 0, 0.00, 0.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-28 13:57:38', '2018-06-28 13:57:38', '2021-08-23 21:57:07', NULL),
(4, '', '', 'ref-p000004', 'bangholme-bureau', 'Bangholme Bureau', 'Une chance rare de posséder cette usine / entrepôt, il conviendra à une variété d\'occupants / affaires. Situation centrale accès facile à toutes les principales artères et autoroutes, un grand parking à l\'arrière et large route excellente pour l\'accès des gros camions. Caractéristiques du bâtiment comprennent: -3 bureaux-cuisine / salle à manger, toilettes -Hauteur volet roulant -Grande puissance -Parking à l\'arrière -Area de 484m2 env.', 1, 0, 115, NULL, NULL, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, NULL, NULL, 9500000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 4, 7, 2, 10, 9, 1, NULL, 5, 13, 4, 0, 0.00, 0.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 10:41:21', '2018-06-28 13:57:38', '2021-08-31 20:35:16', NULL),
(5, '', '', 'ref-p000005', 'bridgewater-terrain', 'Bridgewater Terrain', 'Ce bloc de construction serait l\'un des meilleurs blocs à gauche dans la région. Prendre des vues sensationnelles du pont Bridgewater et au-delà dans une direction et des vues du mont Wellington et au-delà dans l\'autre sens. Avec une superficie approximative de 762 m2, ce terrain est assez grand pour construire la maison de vos rêves ou construire plusieurs unités (STCA). Il y a une réserve du Conseil à la droite de la propriété et elle aura des vues qui ne seront jamais perdues. Les bus ne sont qu\'à quelques pas. Il y a des écoles et de nombreux magasins, y compris les grands supermarchés à seulement quelques minutes. Si vous cherchez un bloc avec des vues incroyables, alors c\'est ici', 1, 0, 70, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1000000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 5, 8, 3, 0, 9, 2, NULL, 0, 5, 5, 0, 0.00, 0.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-28 13:57:38', '2018-06-28 13:57:38', '2021-08-23 21:57:42', NULL),
(6, '', '', 'ref-p000006', 'tugun-terrain', 'Tugun Terrain', 'Offert à la vente, un terrain de 20 acres situé à proximité de tout le Tweed a à offrir. Pittoresque avec la façade de l\'eau à Piggabeen Creek, la propriété a un potentiel incroyable pour le développement futur. * 20 acres * Emplacement idéal et endroit où vivre * Derrière / Ouest de l\'aéroport de Coolangatta (pas sous aucune trajectoire de vol) * 10-15 minutes de l\'aéroport de Coolangatta et des plages. * 400 mètres de front de mer de marée \'Piggabeen Creek\' Utilisation du terrain: * Tourisme écologique, cheval, terrain de golf, etc .. * Développement futur \'Potentiel incroyable\'', 1, 0, 51, NULL, NULL, 0, 0, 0, 0, 5, 0, 0, 0, 0, 0, NULL, NULL, 500000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 6, 9, 3, 0, 9, 1, NULL, 8, 6, 6, 3, 0.00, 0.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-27 10:39:10', '2018-06-28 13:57:38', '2021-08-27 05:07:16', NULL),
(7, '', '', 'ref-p000007', 'mount-barker-terrain', 'Mount Barker Terrain', 'C\'est une offre unique de terrains vacants. Idéalement situé dans une magnifique rue bordée d\'arbres, ce lotissement de près de 350 m² est situé à quelques pas des magasins, cabinets médicaux, banques, écoles et transports. Actuellement zoné «Résidentiel». Le conseil envisagera une utilisation à la maison ou au bureau. Il est presque impossible d\'obtenir une allocation centrale comme celle-ci au Mont Barker aujourd\'hui, alors ne tardez pas!', 1, 0, 34, NULL, NULL, 0, 0, 0, 0, 0, 0, 200, 0, 0, 0, NULL, NULL, 10000000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'ordered', 1, 7, 4, 0, 9, 1, NULL, 0, 5, 7, 0, 0.00, 0.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-28 13:57:38', '2018-06-28 13:57:38', '2020-10-27 03:26:57', NULL),
(8, '', '', 'ref-p000006', 'redland-bay-terrain', 'Redland Bay Terrain', 'Ce bloc résidentiel de 658 m2 est merveilleusement positionné, pratique pour le club de golf, les boutiques locales et la jetée de Macleay Island et le centre d\'affaires principal. Le bloc est complètement dégagé, pentes doucement de la route pavée, n\'a pas de problèmes de drainage, est clôturé sur 2 côtés et a actuellement des vues sur le terrain de golf à l\'arrière. Macleay Island offre un style de vie unique, avec une atmosphère de village convivial, un environnement de parc marin pittoresque et avec les magasins, clubs et services essentiels ici sur l\'île prêt pour que vous appréciiez', 1, 0, 47, NULL, NULL, 0, 0, 0, 0, 0, 0, 600, 0, 0, 0, NULL, NULL, 2590000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 1, 7, 4, 10, 9, 1, NULL, 1, 4, 25, 4, 0.00, 0.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2018-06-28 13:57:38', '2018-06-28 13:57:38', '2021-08-31 20:35:09', NULL),
(10, '', '', '', 'hlm-programme', 'HLM programme', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt<strong> mollit anim id est laborum</strong>.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, 0, 4, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '0', 'published', 0, 0, 1, 0, 0, 1, NULL, 0, 0, 120, 0, 2000.00, 80000.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-22 11:17:13', '2021-04-22 11:17:13', '2021-07-24 22:03:30', NULL),
(12, '', '', '', 'lot-apprtement', 'Lot Apprtement', '<p>description</p>', 1, 0, 11, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '0', 'published', 0, 0, 2, 0, 0, 1, NULL, 0, 0, 124, 0, 10000.00, 120000.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-23 04:54:21', '2021-04-23 04:54:21', '2021-07-28 02:28:13', NULL),
(17, '', '', '', 'appartement-vendre', 'Appartement à vendre', '<p>description appartement</p>', 1, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '0', 'published', 0, 0, 3, 0, 0, 1, NULL, 0, 0, 132, 0, 50000.00, 10000.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-29 17:28:41', '2021-04-29 17:28:41', '2021-04-29 17:28:41', NULL),
(19, 'Ancien', '', 'ref-p0000018', 'ancien-programme-test', 'ancien programme test', '<p><br />\r\ndescription,</p>', 1, 1, 0, 0.00, NULL, 0, 2, 0, 3, 10, 5, 0, 0, 0, 1, '2021', 'Nomea adress', 50000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4212', 1, 173, 135, -1, 0.00, 0.00, 400, 200, 600, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-04 12:50:31', '2021-05-04 12:50:31', '2021-05-04 12:50:31', NULL),
(20, 'Neuf', 'Programme immobilier', '', 'aria', 'Aria', '<p>description ....</p>', 1, 0, 8, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '7/146 marine parade', NULL, NULL, NULL, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4215', 5, 174, 136, 0, 50000.00, 100000.00, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-05 05:05:34', '2021-05-05 05:05:34', '2021-09-01 06:16:42', NULL),
(21, 'Neuf', 'Programme immobilier', 'ref-p0000021', 'aria---b12', 'Aria - B12', '<p>b12 description</p>', 1, 1, 10, 0.00, NULL, 0, 1, 0, 1, 2, 2, 0, 0, 0, 1, '2021', '7/146 marine parade', 450000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4215', 5, 174, 137, 20, 0.00, 0.00, 90, 12, 102, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-05 05:05:34', '2021-05-05 05:05:34', '2021-08-06 04:11:07', NULL),
(22, 'Neuf', 'Programme immobilier', '', 'the-lanes-residences---east-village', 'The Lanes Residences - East Village', '<p>Sunland Group is proud to present The Lanes Residences &ndash; four boutique lakefront apartment buildings in the heart of Mermaid Waters, where pioneering architecture, retail and lifestyle amenity come together to create the ultimate lifestyle destination.</p>\r\n\r\n<p>LOCATION The Lanes Residences is located within the visionary master plan of The Lakes in Mermaid Waters. From its central position, The Lakes is only five minutes from the retail and dining precincts of Broadbeach, home to Pacific Fair and The Star Hotel and Casino, and 20 minutes to Gold Coast Airport. The spectacular surf beaches of Surfers Paradise and Burleigh, and seven excellent primary and secondary schools, are also close by. Direct access to the M1 freeway puts Brisbane only 60 minutes away.</p>\r\n\r\n<p>ARCHITECTURE The four mid-rise buildings at The Lanes Residences embrace the natural contour of Lake Unity, allowing the sculptural forms to emerge from the ground with the same organic rhythm as a plant or flower as it rises towards the sun. Sophisticated comfort and design are brought together in each luxurious apartment and penthouse, perfectly oriented to take advantage of stunning views whether they be lake, park or the majestic Surfers Paradise skyline. Each building will link to the future retail village at The Lanes and feature ground-level retail and commercial spaces, and resident amenities including a pool and terrace area, lounge, sauna and gym. Residents will also enjoy an abundance of landscaped areas including a public outdoor Green.</p>\r\n\r\n<p>INTERNAL FEATURES - Ducted air&ndash;conditioning - Stone kitchen bench tops, high gloss cabinetry, and mirror splashback - Stainless steel European appliances including dishwasher, oven and induction cooktop - High quality large format tiles and quality carpet throughout - Custom designed stone vanities in ensuite &amp; bathroom - Premium fittings and fixtures.</p>\r\n\r\n<p>THE LAKES MASTER PLAN Against the backdrop of a glittering Gold Coast skyline, The Lakes is a rare jewel where ocean, land and lake converge in a mosaic of green and blue. Like all great landmarks, this prestigious 42-hectare master planned precinct will evolve sensitively and sustainably over time &ndash; residential housing, apartments and landscaped leisure spaces, intimately connected to their unique waterfront setting through thoughtful urban design.</p>\r\n\r\n<p>THE LANES RETAIL VILLAGE At the heart of this lakefront community is The Lanes retail village, connected to the broader community and waterfront promenade the retail village will feature lively retail lanes, caf&eacute; culture, leading food and beverage, wellness services and entertainment experiences. Presenting an inspired interpretation of village retail, where intricate design and cascading greenery flows out through the retail lanes and open spaces to embrace the Gold Coast&rsquo;s wonderful climate.</p>\r\n\r\n<p>OUTGOINGS The body corporate levies at The Lanes Residences will start from approximately $105 per week excluding gst. Council rates and water usage are anticipated to be approximately $2,400 per annum</p>\r\n\r\n<p>TERMS OF PURCHASE Initial deposit of $5,000 to secure your home. Balance of 10% of deposit payable within 14 days from date of contract. Settlement is 14 days from registration or 30 days from date of contract. Cash/ Cheque deposits and bank guarantees from approved financial institutions are acceptable forms of deposit</p>', 1, 0, 95, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'Hooker Boulevard', NULL, NULL, NULL, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4218', 5, 175, 138, 0, 490000.00, 1775000.00, 0, 0, 0, NULL, NULL, NULL, NULL, 186, NULL, NULL, NULL, NULL, NULL, '2021-05-06 00:11:19', '2021-05-06 00:11:19', '2021-09-06 19:06:24', NULL),
(23, 'Neuf', 'Programme immobilier', 'ref-p0000023', 'the-lanes-residences---east-village---a9-type-unit', 'The Lanes Residences - East Village - A9 type unit', '<p>Appartement 3 chambres + study.</p>', 1, 1, 35, 0.00, NULL, 0, 2, 0, 1, 3, 2, 0, 0, 0, 1, '2021', 'Off Hooker Boulevard', 1725000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4218', 5, 0, 214, 22, 0.00, 0.00, 218, 25, 243, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-06 00:22:37', '2021-05-06 00:22:37', '2021-09-06 19:09:48', NULL),
(24, 'Neuf', 'Programme immobilier', 'ref-p0000024', 'the-lanes-residences---east-village---a6-1-type-unit', 'The Lanes Residences - East Village - A6.1 type unit', '<p>1 bedroom (North City views)</p>\r\n\r\n<p>1 parking slot in basement</p>\r\n\r\n<p>INTERNAL FEATURES</p>\r\n\r\n<p>- Ducted air&ndash;conditioning</p>\r\n\r\n<p>- Stone kitchen bench tops, high gloss cabinetry, and mirror splashback</p>\r\n\r\n<p>- Stainless steel European appliances including dishwasher, oven and induction cooktop</p>\r\n\r\n<p>- High quality large format tiles and quality carpet throughout</p>\r\n\r\n<p>- Custom designed stone vanities in ensuite &amp; bathroom</p>\r\n\r\n<p>- Premium fittings and fixtures.</p>', 1, 1, 28, 0.00, NULL, 0, 1, 0, 1, 1, 0, 0, 0, 0, 1, '2021', 'Off Hooker Boulevard', 490000.00, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4218', 5, 0, 140, 22, 0.00, 0.00, 60, 7, 67, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-06 01:30:58', '2021-05-06 01:30:58', '2021-08-25 03:54:44', NULL),
(25, 'Neuf', 'Programme immobilier', '', 'b25', 'B25', '<p><br />\r\ndescription</p>', 1, 0, 6, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '7/146 marine parade', NULL, NULL, NULL, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4215', 5, 176, 0, 0, 10000.00, 25000.00, 0, 0, 0, NULL, NULL, NULL, NULL, 141, NULL, NULL, NULL, NULL, NULL, '2021-05-07 04:00:42', '2021-05-07 04:00:42', '2021-09-06 19:10:31', NULL),
(26, 'Neuf', 'Programme immobilier', 'ref-p0000026', 'b25-appart--', 'B25 - Type A4', '<p><br />\r\ndescription</p>', 12, 1, 2, 0.00, NULL, 0, 1, 0, 1, 2, 1, 0, 0, 0, 1, '2021', '7/146 marine parade', NULL, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4215', 5, 176, 219, 25, 15000.00, 25000.00, 60, 40, 100, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-07 04:00:42', '2021-05-07 04:00:42', '2021-07-24 22:18:01', NULL),
(27, 'Neuf', 'Programme immobilier', '', 'programme-tset-modif', 'programme tset modif', '<p><br />\r\ndescription modificatoin</p>', 1, 0, 2, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '7/146 marine parade', NULL, NULL, NULL, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4215', 5, 177, 0, 0, 10000.00, 20000.00, 0, 0, 0, NULL, NULL, NULL, NULL, 143, NULL, NULL, NULL, NULL, NULL, '2021-05-10 12:57:51', '2021-05-10 12:57:51', '2021-09-06 19:10:48', NULL),
(28, 'Neuf', 'Programme immobilier', 'ref-p0000028', 'programme-tset-produit-1', 'programme tset-produit 1', '<p><br />\r\ndescription produit 1</p>', 1, 1, 1, 0.00, NULL, 2, 1, 0, 2, 3, 1, 0, 0, 0, 1, '2021', '7/146 marine parade', NULL, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4215', 5, 177, 220, 27, 15000.00, 18000.00, 40, 20, 60, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-10 12:57:51', '2021-05-10 12:57:51', '2021-08-31 20:58:59', NULL),
(30, 'Neuf', 'Programme immobilier', 'ref-p0000029', 'programme-tset-modif-product-2-tes', 'programme tset modif-product  2  tes', '<p>description produit 2</p>', 1, 1, 1, 0.00, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, '2021', '7/146 marine parade', NULL, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4212', 5, 179, 160, 27, 20000.00, 30000.00, 600, 100, 700, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-18 17:38:54', '2021-05-18 17:38:54', '2021-06-07 03:31:19', NULL),
(31, 'Neuf', 'Produit isolé', 'ref-p0000031', 'produit-isol-test', 'produit isolé test', '<p>produit isol&eacute; test description</p>', 1, 1, 2, 0.00, NULL, 0, 1, 0, 2, 10, 20, 0, 0, 0, 1, '2021', '7/146 marine parade', NULL, 'AUD', 0.20, NULL, NULL, 0, '', '0', 'published', 1, 0, 1, 0, 0, 1, '4215', 5, 183, 221, -1, 500000.00, 1000000.00, 400, 1, 401, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-08 15:47:56', '2021-07-08 15:47:56', '2021-08-15 01:37:58', NULL),
(32, 'Neuf', 'Real estate program', '', 'a-c', 'A&C', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'Gold goast 0265', NULL, NULL, NULL, 'Sales commission rate (%)', 20.00, 0, '', '0', 'waiting', 1, 0, 1, 0, 0, 9, '4215', 5, 184, 0, 0, 100000.00, 500000.00, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 01:13:20', '2021-08-13 01:13:20', '2021-08-13 01:13:20', NULL),
(33, 'Neuf', 'Real estate program', 'ref-p0000033', 'a-c-maison-1', 'A&C-Maison 1', '<p>test</p>', 1, 1, 0, 0.00, NULL, 0, 0, 0, 2, 3, 0, 0, 0, 0, 1, '2021', 'test', NULL, 'AUD', 0.20, 'Sales commission rate (%)', 22.00, 0, '', '0', 'waiting', 2, 0, 1, 0, 0, 9, '105', 1, 185, 226, 32, 55000.00, 75000.00, 145, 250, 395, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-13 04:28:09', '2021-08-13 04:28:09', '2021-08-13 04:28:09', NULL),
(34, 'Neuf', 'Produit isolé', 'ref-p0000034', 'a-c-produit-isol-', 'A&C produit isolé', '<p>lorem ipsum</p>', 1, 1, 0, 0.00, NULL, 0, 0, 0, 20, 120, 20, 0, 0, 0, 1, '2021', '7/146 marine parade', 50000.00, 'AUD', 0.20, 'Sales commission rate (%)', 20.00, 0, '', '0', 'waiting', 1, 0, 1, 0, 0, 9, '4212', 5, 186, 227, -1, 0.00, 0.00, 500, 300, 800, '200.00', 1, NULL, 1, NULL, 'August 2021', '2022-08-11', NULL, NULL, NULL, '2021-08-13 15:09:40', '2021-08-13 15:09:40', '2021-08-13 15:09:40', NULL),
(35, 'Neuf', 'Real estate program', '', 'lake-residences', 'Lake Residences', '<p>Pleasure to look at the lake every morning when you wake up.</p>', 1, 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '25B Roscoe Street', NULL, NULL, NULL, 'Sales commission rate (%)', 5.00, 0, '', '0', 'published', 1, 0, 1, 0, 0, 9, '2026', 2, 187, 0, 0, 450000.00, 850000.00, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-19 22:02:54', '2021-08-14 04:24:27', '2021-08-30 20:31:06', NULL),
(36, 'Neuf', 'Real estate program', 'ref-p0000036', 'lake-residences-a-type-unit', 'Lake Residences-A Type unit', '<p>Nice unit</p>', 1, 1, 3, 0.00, NULL, 0, 1, 0, 1, 2, 1, 0, 0, 0, 1, '0', '25 B Roscoe Street', 0.00, 'AUD', 0.20, 'Sales commission rate (%)', 5.00, 0, '', '0', 'published', 1, 0, 1, 0, 0, 9, '2026', 2, 194, 0, 35, 450000.00, 490000.00, 90, 12, 102, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 20:56:22', '2021-08-14 20:56:22', '2021-08-27 05:06:49', NULL),
(37, 'Neuf', 'Real estate program', 'ref-p0000037', 'lake-residences-b-type-unit', 'Lake Residences-B Type Unit', '<p>Beautiful 2 bedrooms + study unit</p>', 1, 1, 1, 0.00, NULL, 0, 1, 0, 1, 2, 1, 0, 0, 0, 1, '2021', '25 B Roscoe Street', 0.00, 'AUD', 0.20, 'Sales commission rate (%)', 5.00, 0, '', '0', 'published', 1, 0, 1, 0, 0, 9, '2026', 2, 195, 0, 35, 520000.00, 560000.00, 100, 12, 112, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 21:00:17', '2021-08-14 21:00:17', '2021-08-15 01:52:47', NULL),
(38, 'Neuf', 'Real estate program', '', 'les-hauts-de-hurlevent', 'Les Hauts de Hurlevent', '<p>Ca souffle en temp&ecirc;te et les portes claquent</p>', 1, 0, 5, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '80 Bundarra Road', NULL, NULL, NULL, 'Sales commission rate (%)', 6.00, 0, '', '0', 'published', 12, 0, 2, 0, 0, 9, '2023', 2, 190, 0, 0, 250000.00, 450000.00, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-19 22:03:14', '2021-08-14 21:30:37', '2021-08-30 20:30:49', NULL),
(39, 'Neuf', 'Real estate program', 'ref-p0000039', 'les-hauts-de-hurlevent-lots-x1', 'Les Hauts de Hurlevent-Lots X1', '<p>Lots 30m x 12 m (360 m&sup2;)</p>', 1, 1, 2, 0.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '0', '80 Bundarra Road', 0.00, 'AUD', 0.20, 'Sales commission rate (%)', 6.00, 0, '', '0', 'published', 12, 0, 2, 0, 0, 9, '2023', 2, 196, 0, 38, 350000.00, 390000.00, 0, 0, 0, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-14 21:49:41', '2021-08-14 21:49:41', '2021-08-27 04:10:18', NULL),
(40, 'Neuf', 'Produit isolé', 'ref-p0000040', 'crusty-pizzeria', 'Crusty Pizzeria', '<p>Crusty crusty</p>', 1, 1, 2, 0.00, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2021', '12 Flaneghan avenue', 220000.00, 'AUD', 0.20, 'Sales commission rate (%)', 10.00, 0, '', '0', 'published', 43, 0, 4, 0, 0, 9, '4215', 5, 197, 0, -1, 0.00, 0.00, 100, 20, 120, '0.00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 01:18:36', '2021-08-15 01:18:36', '2021-08-30 20:18:06', NULL),
(41, 'Neuf', 'Real estate program', '', 'sss', 'sss', '<p>sss</p>', 1, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'fjkkljd', NULL, NULL, NULL, 'Sales commission rate (%)', 5.00, 0, '', '0', 'waiting', 1, 0, 1, 0, 0, 9, '4215', 1, 198, 0, 0, 500.00, 1000.00, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-15 20:35:43', '2021-08-15 20:35:43', '2021-08-15 20:35:43', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `products_fond_dossier`
--

CREATE TABLE `products_fond_dossier` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `image_id` bigint(20) NOT NULL,
  `author_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products_fond_dossier`
--

INSERT INTO `products_fond_dossier` (`id`, `product_id`, `image_id`, `author_id`, `created_at`, `updated_at`) VALUES
(22, 22, 208, 1, '2021-06-24 01:29:57', '2021-06-24 01:29:57'),
(23, 22, 209, 1, '2021-06-24 01:30:48', '2021-06-24 01:30:48'),
(24, 22, 210, 1, '2021-06-24 01:32:24', '2021-06-24 01:32:24'),
(25, 22, 211, 1, '2021-06-24 01:33:38', '2021-06-24 01:33:38'),
(27, 22, 213, 1, '2021-06-25 07:37:57', '2021-06-25 07:37:57'),
(28, 32, 225, 9, '2021-08-13 01:13:20', '2021-08-13 01:13:20'),
(29, 38, 230, 9, '2021-08-14 21:30:37', '2021-08-14 21:30:37'),
(30, 35, 233, 9, '2021-08-14 21:33:14', '2021-08-14 21:33:14');

-- --------------------------------------------------------

--
-- Structure de la table `products_images`
--

CREATE TABLE `products_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` bigint(20) NOT NULL DEFAULT 0,
  `image_id` bigint(20) NOT NULL DEFAULT 0,
  `is_principal` int(10) NOT NULL,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image_id`, `is_principal`, `author_id`, `created_at`, `updated_at`) VALUES
(4, 1, 2, 0, 1, '2021-04-11 18:00:00', '2021-04-11 18:00:00'),
(3, 1, 1, 0, 1, '2021-04-11 18:00:00', '2021-04-11 18:00:00'),
(5, 27, 144, 0, 1, '2021-05-10 12:57:51', '2021-05-18 17:32:01'),
(6, 27, 145, 0, 1, '2021-05-10 12:57:51', '2021-05-18 17:32:01'),
(27, 20, 215, 1, 1, '2021-06-29 17:46:11', '2021-06-29 17:48:44'),
(8, 29, 153, 0, 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(9, 29, 154, 0, 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(10, 29, 155, 0, 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(11, 29, 156, 0, 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(12, 29, 157, 0, 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(13, 29, 158, 1, 1, '2021-05-16 23:16:24', '2021-05-16 23:16:24'),
(14, 27, 159, 1, 1, '2021-05-18 17:31:39', '2021-05-18 17:32:01'),
(19, 22, 165, 1, 1, '2021-05-22 03:14:18', '2021-05-22 03:16:38'),
(20, 22, 166, 0, 1, '2021-05-22 03:14:45', '2021-05-22 03:16:38'),
(21, 22, 167, 0, 1, '2021-05-22 03:14:46', '2021-05-22 03:16:38'),
(22, 22, 168, 0, 1, '2021-05-22 03:15:15', '2021-05-22 03:16:38'),
(23, 22, 169, 0, 1, '2021-05-22 03:15:33', '2021-05-22 03:16:38'),
(24, 22, 170, 0, 1, '2021-05-22 03:16:25', '2021-05-22 03:16:38'),
(25, 22, 171, 0, 1, '2021-05-22 03:16:29', '2021-05-22 03:16:38'),
(26, 25, 173, 0, 1, '2021-05-28 03:56:27', '2021-05-28 03:56:27'),
(28, 20, 216, 0, 1, '2021-06-29 17:46:58', '2021-06-29 17:48:44'),
(29, 20, 217, 0, 1, '2021-06-29 17:48:28', '2021-06-29 17:48:44'),
(30, 32, 222, 0, 9, '2021-08-13 01:13:20', '2021-08-13 01:13:20'),
(31, 32, 223, 1, 9, '2021-08-13 01:13:20', '2021-08-13 01:13:20'),
(32, 35, 231, 1, 9, '2021-08-14 21:31:41', '2021-08-14 21:37:24'),
(33, 38, 234, 1, 9, '2021-08-14 21:36:37', '2021-08-14 21:36:54');

-- --------------------------------------------------------

--
-- Structure de la table `product_eoi`
--

CREATE TABLE `product_eoi` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `image_id` bigint(20) NOT NULL,
  `author_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product_eoi`
--

INSERT INTO `product_eoi` (`id`, `product_id`, `image_id`, `author_id`, `created_at`, `updated_at`) VALUES
(11, 32, 224, 9, '2021-08-13 01:13:20', '2021-08-13 01:13:20'),
(12, 34, 228, 9, '2021-08-13 15:09:40', '2021-08-13 15:09:40'),
(13, 38, 229, 9, '2021-08-14 21:30:37', '2021-08-14 21:30:37'),
(14, 35, 232, 9, '2021-08-14 21:32:25', '2021-08-14 21:32:25');

-- --------------------------------------------------------

--
-- Structure de la table `product_lia`
--

CREATE TABLE `product_lia` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `image_id` bigint(20) NOT NULL,
  `author_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `product_status`
--

CREATE TABLE `product_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_status`
--

INSERT INTO `product_status` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'published', NULL, NULL),
(2, 'ordered', NULL, NULL),
(3, 'waiting', '2021-05-18 13:43:11', '2021-05-18 13:43:11');

-- --------------------------------------------------------

--
-- Structure de la table `programme_translations`
--

CREATE TABLE `programme_translations` (
  `id` int(50) NOT NULL,
  `programme_id` int(50) NOT NULL,
  `translation_id` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `programme_translations`
--

INSERT INTO `programme_translations` (`id`, `programme_id`, `translation_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2021-07-07 21:00:00', '2021-07-07 21:00:00'),
(3, 2, 3, '2021-07-08 05:37:12', '2021-07-08 05:37:12'),
(5, 2, 5, '2021-07-08 05:50:26', '2021-07-08 05:50:26'),
(6, 2, 6, '2021-07-08 06:19:22', '2021-07-08 06:19:22');

-- --------------------------------------------------------

--
-- Structure de la table `pubs`
--

CREATE TABLE `pubs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `links` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `image_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pubs`
--

INSERT INTO `pubs` (`id`, `title`, `content`, `links`, `author_id`, `image_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CocaCola', 'Pub du cocacola', NULL, 1, 21, '2018-06-28 13:57:38', '2019-12-14 01:46:09', NULL),
(2, 'THB', 'Pub du THB', 'https://www.facebook.com', 1, 22, '2018-06-28 13:57:38', NULL, NULL),
(3, 'Peugeot', 'Pub du Peugeot', 'https://www.peugeot.com', 1, 23, '2018-06-28 13:57:38', NULL, NULL),
(4, 'iNet', 'Pub du iNEt', 'https://www.adidas.com', 1, 24, '2018-06-28 13:57:38', NULL, NULL),
(5, 'Publicité test 1', 'Publicité test 1', 'http://investirenaustralie.loc', 1, 106, '2020-09-14 01:42:28', '2020-09-14 01:42:28', NULL),
(6, 'Publicité test 2', 'Publicité test 2', 'http://investirenaustralie.loc', 1, 107, '2020-09-14 01:42:28', '2020-09-14 01:42:28', NULL),
(7, 'Publicité test 3', 'Publicité test 3', 'http://investirenaustralie.loc', 1, 108, '2020-09-14 01:42:28', '2020-09-14 01:42:28', NULL),
(8, 'Publicité video test', 'Publicité video test', 'http://investirenaustralie.loc', 1, 118, '2021-04-20 01:42:28', '2021-04-20 01:42:28', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pubs_pages`
--

CREATE TABLE `pubs_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `page_id` bigint(20) NOT NULL DEFAULT 0,
  `pub_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pubs_pages`
--

INSERT INTO `pubs_pages` (`id`, `author_id`, `page_id`, `pub_id`, `created_at`, `updated_at`) VALUES
(34, 1, 1, 5, '2020-09-14 01:42:28', '2020-09-14 01:42:28'),
(33, 1, 6, 1, '2019-12-14 01:48:17', '2019-12-14 01:48:17'),
(32, 1, 5, 1, '2019-12-14 01:48:17', '2019-12-14 01:48:17'),
(31, 1, 3, 1, '2019-12-14 01:48:17', '2019-12-14 01:48:17'),
(30, 1, 1, 1, '2019-12-14 01:48:17', '2019-12-14 01:48:17'),
(7, 1, 1, 2, '2018-06-28 13:57:38', NULL),
(8, 1, 2, 2, '2018-06-28 13:57:38', NULL),
(9, 1, 3, 2, '2018-06-28 13:57:38', NULL),
(10, 1, 4, 2, '2018-06-28 13:57:38', NULL),
(11, 1, 5, 2, '2018-06-28 13:57:38', NULL),
(12, 1, 6, 2, '2018-06-28 13:57:38', NULL),
(13, 1, 7, 2, '2018-06-28 13:57:38', NULL),
(14, 1, 1, 3, '2018-06-28 13:57:38', NULL),
(15, 1, 2, 3, '2018-06-28 13:57:38', NULL),
(16, 1, 3, 3, '2018-06-28 13:57:38', NULL),
(17, 1, 4, 3, '2018-06-28 13:57:38', NULL),
(18, 1, 5, 3, '2018-06-28 13:57:38', NULL),
(19, 1, 6, 3, '2018-06-28 13:57:38', NULL),
(20, 1, 7, 3, '2018-06-28 13:57:38', NULL),
(21, 1, 1, 4, '2018-06-28 13:57:38', NULL),
(35, 1, 10, 5, '2020-09-14 01:42:28', '2020-09-14 01:42:28'),
(36, 1, 40, 6, '2020-09-14 01:42:28', '2020-09-14 01:42:28'),
(37, 1, 41, 7, '2020-09-14 01:42:28', '2020-09-14 01:42:28'),
(38, 1, 37, 5, '2020-09-14 01:42:28', '2020-09-14 01:42:28'),
(39, 1, 43, 6, '2020-09-14 01:42:28', '2020-09-14 01:42:28'),
(40, 1, 44, 7, '2020-09-14 01:42:28', '2020-09-14 01:42:28');

-- --------------------------------------------------------

--
-- Structure de la table `relation_membre_apl`
--

CREATE TABLE `relation_membre_apl` (
  `id` bigint(20) NOT NULL,
  `membre_id` bigint(20) NOT NULL,
  `apl_id` bigint(20) NOT NULL,
  `dt_debut_relation` datetime NOT NULL,
  `dt_end_relation` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relation_membre_apl`
--

INSERT INTO `relation_membre_apl` (`id`, `membre_id`, `apl_id`, `dt_debut_relation`, `dt_end_relation`, `created_at`, `updated_at`) VALUES
(1, 10, 80, '2021-07-15 17:34:57', '2022-01-11 17:34:57', '2021-07-15 14:34:57', '2021-07-15 14:34:57'),
(2, 10, 2, '2021-07-28 05:02:28', '2022-01-24 05:02:28', '2021-07-28 02:02:28', '2021-07-28 02:02:28'),
(3, 10, 2, '2021-07-28 05:03:47', '2022-01-24 05:03:47', '2021-07-28 02:03:47', '2021-07-28 02:03:47');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_initial` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_initial`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', 'admin', '2021-05-28 05:00:23', '0000-00-00 00:00:00'),
(2, 'Vendeur', 'seller', '2021-05-28 05:00:23', '0000-00-00 00:00:00'),
(3, 'Agence Francophone Australienne', 'afa', '2021-05-28 05:00:23', '0000-00-00 00:00:00'),
(4, 'Agence Partenaire Locale', 'apl', '2021-05-28 05:00:23', '0000-00-00 00:00:00'),
(5, 'Membre', 'member', '2021-05-28 05:00:23', '0000-00-00 00:00:00'),
(6, 'Collaborateur', 'collaborator', '2021-05-28 12:05:40', '2021-05-28 02:00:28');

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pinged',
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `tma` double(10,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apl_id` bigint(20) NOT NULL DEFAULT 0,
  `apl_paid_at` datetime DEFAULT NULL,
  `apl_amount` double(10,2) NOT NULL DEFAULT 0.00,
  `apl_transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apl_payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `afa_id` bigint(20) NOT NULL DEFAULT 0,
  `afa_paid_at` datetime DEFAULT NULL,
  `afa_amount` double(10,2) NOT NULL DEFAULT 0.00,
  `afa_transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `afa_payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_by` bigint(20) NOT NULL DEFAULT 0,
  `cancelled_at` datetime DEFAULT NULL,
  `cancelled_by_role` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) NOT NULL DEFAULT 0,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sales`
--

INSERT INTO `sales` (`id`, `status`, `price`, `tma`, `currency`, `apl_id`, `apl_paid_at`, `apl_amount`, `apl_transaction_id`, `apl_payment_type`, `afa_id`, `afa_paid_at`, `afa_amount`, `afa_transaction_id`, `afa_payment_type`, `cancelled_by`, `cancelled_at`, `cancelled_by_role`, `cancelled_desc`, `product_id`, `author_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'ordered', 9500000.00, 1900000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 6, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 4, 10, '2018-06-29 15:21:51', '2018-06-29 15:30:02', NULL),
(3, 'ordered', 4859000.00, 971800.00, 'eur', 5, NULL, 0.00, NULL, NULL, 8, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 1, 10, '2018-06-29 15:31:45', '2018-06-29 15:34:02', NULL),
(4, 'ordered', 2590000.00, 518000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 6, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 8, 10, '2018-06-30 04:03:59', '2018-06-30 09:41:10', NULL),
(6, 'pinged', 500000.00, 100000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 7, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 6, 10, '2019-03-13 03:42:55', '2019-03-13 03:42:55', NULL),
(7, 'pinged', 9500000.00, 1900000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 6, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 4, 10, '2020-06-23 03:54:54', '2020-06-23 03:54:54', NULL),
(8, 'pinged', 3600000.00, 720000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 8, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 3, 10, '2020-06-23 03:55:35', '2020-06-23 03:55:35', NULL),
(9, 'pinged', 500000.00, 100000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 7, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 6, 10, '2020-06-23 03:56:11', '2020-06-23 03:56:11', NULL),
(10, 'pinged', 10000000.00, 2000000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 7, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 7, 10, '2020-06-23 04:24:46', '2020-06-23 04:24:46', NULL),
(11, 'pinged', 9500000.00, 1900000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 6, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 4, 10, '2020-07-24 23:53:07', '2020-07-24 23:53:07', NULL),
(12, 'pinged', 9500000.00, 1900000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 6, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 4, 10, '2020-08-14 21:09:41', '2020-08-14 21:09:41', NULL),
(13, 'pinged', 3600000.00, 720000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 8, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 3, 10, '2020-08-14 21:10:03', '2020-08-14 21:10:03', NULL),
(14, 'pinged', 1000000.00, 200000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 7, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 5, 10, '2020-08-14 21:10:25', '2020-08-14 21:10:25', NULL),
(15, 'pinged', 500000.00, 100000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 7, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 6, 10, '2020-08-14 21:10:44', '2020-08-14 21:10:44', NULL),
(16, 'pinged', 10000000.00, 2000000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 7, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 7, 10, '2020-08-14 21:11:19', '2020-08-14 21:11:19', NULL),
(17, 'pinged', 9500000.00, 1900000.00, 'eur', 5, NULL, 0.00, NULL, NULL, 6, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 4, 10, '2020-08-14 21:11:35', '2020-08-14 21:11:35', NULL),
(18, 'pinged', 1000000.00, 200000.00, 'eur', 2, NULL, 0.00, NULL, NULL, 7, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 5, 10, '2020-09-03 18:56:14', '2020-09-03 18:56:14', NULL),
(19, 'pinged', 9500000.00, 1900000.00, 'eur', 2, NULL, 0.00, NULL, NULL, 6, NULL, 0.00, NULL, NULL, 0, NULL, NULL, NULL, 4, 10, '2020-09-14 04:22:38', '2020-09-14 04:22:38', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `searches`
--

CREATE TABLE `searches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `searches`
--

INSERT INTO `searches` (`id`, `title`, `keyword`, `content`, `author_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'a:10:{s:6:\"_token\";s:40:\"s3f6EM2mvcwj6FUyMvb0Qq6TXBiejOjknXG9EKAI\";s:5:\"state\";s:1:\"2\";s:4:\"type\";s:1:\"1\";s:13:\"location_type\";s:1:\"7\";s:5:\"price\";s:1:\"1\";s:4:\"area\";s:1:\"1\";s:9:\"bathrooms\";s:1:\"2\";s:8:\"bedrooms\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 10, '2018-06-28 17:56:17', '2018-06-28 17:56:17'),
(2, NULL, NULL, 'a:10:{s:6:\"_token\";s:40:\"s3f6EM2mvcwj6FUyMvb0Qq6TXBiejOjknXG9EKAI\";s:5:\"state\";s:1:\"5\";s:4:\"type\";s:1:\"1\";s:13:\"location_type\";N;s:5:\"price\";s:1:\"1\";s:4:\"area\";s:1:\"1\";s:9:\"bathrooms\";s:1:\"2\";s:8:\"bedrooms\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 10, '2018-06-28 17:56:43', '2018-06-28 17:56:43'),
(3, NULL, NULL, 'a:10:{s:6:\"_token\";s:40:\"s3f6EM2mvcwj6FUyMvb0Qq6TXBiejOjknXG9EKAI\";s:5:\"state\";N;s:4:\"type\";s:1:\"1\";s:13:\"location_type\";N;s:5:\"price\";s:1:\"1\";s:4:\"area\";s:1:\"1\";s:9:\"bathrooms\";s:1:\"2\";s:8:\"bedrooms\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 10, '2018-06-28 17:57:00', '2018-06-28 17:57:00'),
(11, NULL, 'tests', NULL, 0, '2018-06-30 08:43:51', '2018-06-30 08:43:51'),
(130, 'VIC-Mitchell-Hilldene | Tous', 'VIC,Mitchell,Hilldene', 'a:6:{s:5:\"state\";s:3:\"VIC\";s:4:\"city\";s:8:\"Mitchell\";s:6:\"suburb\";s:8:\"Hilldene\";s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:4:\"Tous\";s:3:\"url\";s:95:\"http://iea.easydata.mg/shop/search?state=VIC&city=Mitchell&suburb=Hilldene&sub_env=on&prod=Tous\";}', 10, '2021-05-27 10:25:29', '2021-05-27 10:25:29'),
(9, NULL, 'tests', NULL, 0, '2018-06-30 08:39:20', '2018-06-30 08:39:20'),
(10, NULL, 'tests', NULL, 0, '2018-06-30 08:43:02', '2018-06-30 08:43:02'),
(8, NULL, 'tese', NULL, 0, '2018-06-30 08:30:14', '2018-06-30 08:30:14'),
(12, NULL, 'tests', NULL, 0, '2018-06-30 08:45:31', '2018-06-30 08:45:31'),
(13, NULL, 'tests', NULL, 0, '2018-06-30 08:49:34', '2018-06-30 08:49:34'),
(14, NULL, 'tests', NULL, 0, '2018-06-30 08:51:35', '2018-06-30 08:51:35'),
(15, NULL, 'tests', NULL, 0, '2018-06-30 08:52:30', '2018-06-30 08:52:30'),
(16, NULL, 'tests', NULL, 0, '2018-06-30 08:53:02', '2018-06-30 08:53:02'),
(17, NULL, 'tests', NULL, 0, '2018-06-30 08:54:37', '2018-06-30 08:54:37'),
(18, NULL, 'tests', NULL, 0, '2018-06-30 08:55:45', '2018-06-30 08:55:45'),
(19, NULL, 'tests', NULL, 0, '2018-06-30 08:55:53', '2018-06-30 08:55:53'),
(20, NULL, 'tests', NULL, 0, '2018-06-30 08:56:16', '2018-06-30 08:56:16'),
(21, NULL, 'tests', NULL, 0, '2018-06-30 08:58:46', '2018-06-30 08:58:46'),
(22, NULL, 'tests', NULL, 0, '2018-06-30 08:59:37', '2018-06-30 08:59:37'),
(23, NULL, 'tests', NULL, 0, '2018-06-30 09:04:18', '2018-06-30 09:04:18'),
(24, NULL, 'tests', NULL, 0, '2018-06-30 09:04:31', '2018-06-30 09:04:31'),
(25, NULL, 'tests', NULL, 0, '2018-06-30 09:06:48', '2018-06-30 09:06:48'),
(26, NULL, 'tests', NULL, 0, '2018-06-30 09:06:58', '2018-06-30 09:06:58'),
(27, NULL, 'tests', NULL, 0, '2018-06-30 09:08:25', '2018-06-30 09:08:25'),
(28, NULL, 'tests', NULL, 0, '2018-06-30 09:08:38', '2018-06-30 09:08:38'),
(29, NULL, 'tests', NULL, 0, '2018-06-30 09:08:38', '2018-06-30 09:08:38'),
(30, NULL, 'tests', NULL, 0, '2018-06-30 09:08:48', '2018-06-30 09:08:48'),
(31, NULL, 'svd', NULL, 0, '2018-06-30 09:10:41', '2018-06-30 09:10:41'),
(32, NULL, 'svd', NULL, 0, '2018-06-30 09:11:02', '2018-06-30 09:11:02'),
(33, NULL, 'svd', NULL, 0, '2018-06-30 09:12:27', '2018-06-30 09:12:27'),
(34, NULL, 'svd', NULL, 0, '2018-06-30 09:13:06', '2018-06-30 09:13:06'),
(36, NULL, 'svd', NULL, 0, '2018-06-30 09:14:22', '2018-06-30 09:14:22'),
(38, NULL, 'testes', NULL, 0, '2018-06-30 09:16:02', '2018-06-30 09:16:02'),
(124, NULL, NULL, 'a:9:{s:5:\"state\";s:3:\"QLD\";s:4:\"city\";s:19:\"Ville de Gold Coast\";s:6:\"suburb\";s:9:\"Southport\";s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:11:\"residentiel\";s:21:\"residentiel_price_min\";s:5:\"50000\";s:21:\"residentiel_price_max\";s:7:\"7800000\";s:24:\"residentiel_bedrooms_min\";s:1:\"0\";s:24:\"residentiel_bedrooms_max\";s:2:\"10\";}', 0, '2021-05-18 04:41:42', '2021-05-18 04:41:42'),
(40, NULL, 'testes', NULL, 0, '2018-06-30 09:16:41', '2018-06-30 09:16:41'),
(41, 'teste', 'terrain', NULL, 5, '2018-06-30 17:14:22', '2018-06-30 17:14:36'),
(42, NULL, 'terrain', NULL, 0, '2018-06-30 17:14:44', '2018-06-30 17:14:44'),
(43, NULL, 'sfl', NULL, 0, '2018-07-01 19:50:08', '2018-07-01 19:50:08'),
(44, NULL, 'sfl', NULL, 0, '2018-07-01 19:50:12', '2018-07-01 19:50:12'),
(45, NULL, 'sfl', NULL, 0, '2018-07-01 19:50:36', '2018-07-01 19:50:36'),
(46, NULL, 'sfl', NULL, 0, '2018-07-01 19:50:37', '2018-07-01 19:50:37'),
(48, NULL, 'terrain', NULL, 0, '2018-07-01 19:52:16', '2018-07-01 19:52:16'),
(49, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"91zQdSOXoiyw0XmHXDBKDoRu98LmZS052GXA9cJz\";s:5:\"state\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 07:21:00', '2019-03-12 07:21:00'),
(50, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 07:33:39', '2019-03-12 07:33:39'),
(51, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 07:45:15', '2019-03-12 07:45:15'),
(52, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 07:47:07', '2019-03-12 07:47:07'),
(53, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 07:59:56', '2019-03-12 07:59:56'),
(54, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";N;s:4:\"type\";s:1:\"1\";s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 08:08:59', '2019-03-12 08:08:59'),
(55, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";N;s:4:\"type\";s:1:\"1\";s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 08:09:12', '2019-03-12 08:09:12'),
(56, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 08:09:52', '2019-03-12 08:09:52'),
(57, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 08:11:01', '2019-03-12 08:11:01'),
(58, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 08:11:35', '2019-03-12 08:11:35'),
(59, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"gB5TpKrBdk7YsPexXRYulQ5BUYnP9XcUafNBI5Ar\";s:5:\"state\";s:1:\"1\";s:6:\"state2\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 08:14:22', '2019-03-12 08:14:22'),
(60, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"SPcd5cwkCylu9mbMuJ6wXRsBbqOXmfkpv4x5208r\";s:5:\"state\";s:1:\"1\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 11:21:49', '2019-03-12 11:21:49'),
(61, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"SPcd5cwkCylu9mbMuJ6wXRsBbqOXmfkpv4x5208r\";s:5:\"state\";s:1:\"1\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-12 11:23:03', '2019-03-12 11:23:03'),
(62, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"Cwm61oH38EubzN7QWHQkUfSixBDzXyrM3K7J1Vnd\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";s:1:\"1\";s:13:\"location_type\";s:1:\"7\";s:5:\"price\";s:14:\"400000,4500000\";s:4:\"area\";s:7:\"150,250\";s:9:\"bathrooms\";s:3:\"1,3\";s:8:\"bedrooms\";s:1:\"3\";s:7:\"toillet\";s:1:\"3\";s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-13 03:56:30', '2019-03-13 03:56:30'),
(63, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"5vaKUKU0q43qDDEH1YX6gSfsNZPDfj6XTsyFMEOQ\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-16 05:05:51', '2019-03-16 05:05:51'),
(64, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"5vaKUKU0q43qDDEH1YX6gSfsNZPDfj6XTsyFMEOQ\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-03-16 05:06:32', '2019-03-16 05:06:32'),
(65, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"t2WaDjTzqE9UD8sI5pb6T6tpKWzQ45SRfSdur88G\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-05-20 10:54:12', '2019-05-20 10:54:12'),
(66, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"9fypiUC8ppbFz5yo1IFDhVIBPNzjK4KDmyY1no3A\";s:5:\"state\";s:1:\"2\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";s:1:\"2\";s:13:\"location_type\";s:1:\"9\";s:5:\"price\";s:15:\"3100000,6600000\";s:4:\"area\";s:7:\"200,500\";s:9:\"bathrooms\";s:3:\"3,5\";s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";s:14:\"500000,9950000\";s:10:\"superficie\";s:6:\"50,300\";}', 0, '2019-08-31 01:14:43', '2019-08-31 01:14:43'),
(67, NULL, 'immobilier', NULL, 0, '2019-12-13 04:07:40', '2019-12-13 04:07:40'),
(68, NULL, 'immobilier', NULL, 0, '2019-12-13 04:07:43', '2019-12-13 04:07:43'),
(69, NULL, 'conseil juridique', NULL, 0, '2019-12-13 04:08:29', '2019-12-13 04:08:29'),
(70, NULL, 'conseil juridique', NULL, 0, '2019-12-13 04:08:31', '2019-12-13 04:08:31'),
(71, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"LY9KqnNytHZIknGO5C18uRGWlvKXes4z6YAxgOzs\";s:5:\"state\";s:1:\"1\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2019-12-30 09:57:13', '2019-12-30 09:57:13'),
(72, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"GD9Mr8RMTHiO5HlEIdy7wz4Z4qMzCpndvJrhXEej\";s:5:\"state\";s:1:\"2\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-02-26 08:34:27', '2020-02-26 08:34:27'),
(73, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"lG0sSjkChTrsekmW0w8v3i44i8GEFhexhuTGn0ER\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-03-31 02:57:37', '2020-03-31 02:57:37'),
(74, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"lG0sSjkChTrsekmW0w8v3i44i8GEFhexhuTGn0ER\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-03-31 02:58:21', '2020-03-31 02:58:21'),
(75, NULL, 'mission', NULL, 0, '2020-06-13 04:19:31', '2020-06-13 04:19:31'),
(76, NULL, 'mission', NULL, 0, '2020-06-13 04:19:35', '2020-06-13 04:19:35'),
(77, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"aNceBaWaAzjuNFxbEUoXBLParzt5oj92UVHj8lvZ\";s:5:\"state\";s:1:\"2\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";s:1:\"1\";s:13:\"location_type\";s:1:\"7\";s:5:\"price\";s:15:\"2000000,5100000\";s:4:\"area\";s:7:\"300,600\";s:9:\"bathrooms\";s:3:\"2,4\";s:8:\"bedrooms\";s:1:\"2\";s:7:\"toillet\";s:1:\"4\";s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-07-11 01:24:07', '2020-07-11 01:24:07'),
(78, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"Nzvo0m4PBcaVqoPqXDuzVil0P9cfOkBnJAFJduxz\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-07-26 21:52:02', '2020-07-26 21:52:02'),
(79, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"el4ZaXUVnpjsSmo7GEK0jRkSZ7l3lYinUhs19qFp\";s:5:\"state\";s:1:\"2\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";s:1:\"1\";s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-08-14 21:08:14', '2020-08-14 21:08:14'),
(80, NULL, 'service', NULL, 0, '2020-09-02 10:23:54', '2020-09-02 10:23:54'),
(81, NULL, 'service', NULL, 0, '2020-09-02 10:23:58', '2020-09-02 10:23:58'),
(82, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"t0iY14SVk6EE4lHH8YwlOlOua8avSKouhjKocnQR\";s:5:\"state\";s:1:\"1\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-09-03 09:31:50', '2020-09-03 09:31:50'),
(83, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"t0iY14SVk6EE4lHH8YwlOlOua8avSKouhjKocnQR\";s:5:\"state\";s:1:\"2\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-09-03 11:17:00', '2020-09-03 11:17:00'),
(84, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"t0iY14SVk6EE4lHH8YwlOlOua8avSKouhjKocnQR\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";s:1:\"1\";s:13:\"location_type\";s:1:\"7\";s:5:\"price\";s:14:\"500000,6300000\";s:4:\"area\";s:6:\"50,550\";s:9:\"bathrooms\";s:3:\"4,8\";s:8:\"bedrooms\";s:1:\"1\";s:7:\"toillet\";s:1:\"1\";s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-09-03 11:23:04', '2020-09-03 11:23:04'),
(85, NULL, 'face', NULL, 0, '2020-09-03 17:41:06', '2020-09-03 17:41:06'),
(86, NULL, 'face', NULL, 0, '2020-09-03 17:41:11', '2020-09-03 17:41:11'),
(87, NULL, 'melbourne', NULL, 0, '2020-09-03 17:41:21', '2020-09-03 17:41:21'),
(88, NULL, 'melbourne', NULL, 0, '2020-09-03 17:41:24', '2020-09-03 17:41:24'),
(89, NULL, 'tugun', NULL, 0, '2020-09-03 17:41:36', '2020-09-03 17:41:36'),
(90, NULL, 'tugun', NULL, 0, '2020-09-03 17:41:37', '2020-09-03 17:41:37'),
(91, NULL, 'tugun', NULL, 0, '2020-09-03 17:47:11', '2020-09-03 17:47:11'),
(92, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"TvOSyp73O8VHj1lhpf12ODQLGQCk3JQsemdcwnX7\";s:5:\"state\";s:1:\"1\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-10-27 07:37:19', '2020-10-27 07:37:19'),
(93, NULL, 'pont', NULL, 0, '2020-12-07 10:05:07', '2020-12-07 10:05:07'),
(94, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"biKf9YMu1rqsMeCrvPWc3nty7OqaN5ZkeSpV4MC2\";s:5:\"state\";s:1:\"1\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-12-07 10:05:23', '2020-12-07 10:05:23'),
(95, NULL, 'pont', NULL, 0, '2020-12-07 10:05:33', '2020-12-07 10:05:33'),
(96, NULL, 'pont', NULL, 0, '2020-12-07 10:05:38', '2020-12-07 10:05:38'),
(97, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"biKf9YMu1rqsMeCrvPWc3nty7OqaN5ZkeSpV4MC2\";s:5:\"state\";s:1:\"6\";s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-12-07 12:23:05', '2020-12-07 12:23:05'),
(98, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"mlNYWn2u4tpc7Hr9wCgufhtoAcJ0ASxwymVzGNTR\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";s:1:\"1\";s:13:\"location_type\";N;s:5:\"price\";s:14:\"500000,4000000\";s:4:\"area\";N;s:9:\"bathrooms\";s:3:\"4,7\";s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";s:15:\"1150000,7250000\";s:10:\"superficie\";N;}', 0, '2020-12-08 11:35:29', '2020-12-08 11:35:29'),
(99, NULL, NULL, 'a:13:{s:6:\"_token\";s:40:\"mlNYWn2u4tpc7Hr9wCgufhtoAcJ0ASxwymVzGNTR\";s:5:\"state\";N;s:4:\"city\";N;s:6:\"state3\";N;s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";N;s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";N;s:10:\"superficie\";N;}', 0, '2020-12-08 11:37:02', '2020-12-08 11:37:02'),
(100, NULL, NULL, 'a:11:{s:6:\"_token\";s:40:\"ndQeBSgAH4YXE6HQ8iPYIKAVKfTOX76D7XVfCAE9\";s:5:\"state\";s:1:\"1\";s:4:\"type\";N;s:13:\"location_type\";N;s:5:\"price\";s:14:\"500000,5700000\";s:4:\"area\";N;s:9:\"bathrooms\";N;s:8:\"bedrooms\";N;s:7:\"toillet\";N;s:4:\"prix\";s:14:\"500000,5500000\";s:10:\"superficie\";N;}', 0, '2021-02-03 04:49:03', '2021-02-03 04:49:03'),
(101, NULL, 'dfsd', NULL, 0, '2021-03-05 06:43:40', '2021-03-05 06:43:40'),
(102, NULL, 'mount', NULL, 0, '2021-03-05 06:44:02', '2021-03-05 06:44:02'),
(103, NULL, NULL, 'a:4:{s:4:\"city\";N;s:6:\"suburb\";N;s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:4:\"tous\";}', 0, '2021-03-19 06:40:13', '2021-03-19 06:40:13'),
(104, NULL, NULL, 'a:5:{s:5:\"state\";s:3:\"VIC\";s:4:\"city\";s:9:\"Melbourne\";s:6:\"suburb\";s:7:\"Carlton\";s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:4:\"Tous\";}', 0, '2021-04-09 10:30:44', '2021-04-09 10:30:44'),
(105, NULL, NULL, 'a:11:{s:4:\"city\";N;s:6:\"suburb\";N;s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:11:\"residentiel\";s:7:\"typeRes\";s:1:\"1\";s:10:\"anciennete\";s:2:\"11\";s:12:\"localisation\";s:1:\"6\";s:21:\"residentiel_price_min\";s:7:\"4859000\";s:21:\"residentiel_price_max\";s:7:\"7800000\";s:24:\"residentiel_bedrooms_min\";s:1:\"2\";s:24:\"residentiel_bedrooms_max\";s:1:\"5\";}', 0, '2021-04-09 10:31:14', '2021-04-09 10:31:14'),
(106, NULL, NULL, 'a:5:{s:5:\"state\";s:3:\"VIC\";s:4:\"city\";s:9:\"Melbourne\";s:6:\"suburb\";s:7:\"Carlton\";s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:4:\"Tous\";}', 0, '2021-04-12 02:47:27', '2021-04-12 02:47:27'),
(107, NULL, 'FIRB', NULL, 0, '2021-04-14 03:47:52', '2021-04-14 03:47:52'),
(108, NULL, 'FIRB', NULL, 0, '2021-04-14 03:48:16', '2021-04-14 03:48:16'),
(109, NULL, NULL, 'a:8:{s:4:\"city\";N;s:6:\"suburb\";N;s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:11:\"residentiel\";s:21:\"residentiel_price_min\";s:7:\"4859000\";s:21:\"residentiel_price_max\";s:7:\"7800000\";s:24:\"residentiel_bedrooms_min\";s:1:\"2\";s:24:\"residentiel_bedrooms_max\";s:1:\"5\";}', 0, '2021-04-17 02:56:05', '2021-04-17 02:56:05'),
(110, NULL, 'hlm', NULL, 0, '2021-04-22 13:05:35', '2021-04-22 13:05:35'),
(111, NULL, 'hlm', NULL, 0, '2021-04-22 13:07:08', '2021-04-22 13:07:08'),
(112, NULL, 'hlm', NULL, 0, '2021-04-22 13:08:07', '2021-04-22 13:08:07'),
(113, NULL, 'hlm', NULL, 0, '2021-04-22 13:08:28', '2021-04-22 13:08:28'),
(114, NULL, 'hlm', NULL, 0, '2021-04-22 13:08:55', '2021-04-22 13:08:55'),
(115, NULL, 'hlm', NULL, 0, '2021-04-23 03:07:26', '2021-04-23 03:07:26'),
(116, NULL, 'test', NULL, 0, '2021-04-23 03:09:27', '2021-04-23 03:09:27'),
(117, NULL, NULL, 'a:5:{s:5:\"state\";s:3:\"QLD\";s:4:\"city\";N;s:6:\"suburb\";N;s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:4:\"Tous\";}', 0, '2021-05-14 06:57:08', '2021-05-14 06:57:08'),
(118, NULL, NULL, 'a:5:{s:5:\"state\";s:3:\"QLD\";s:4:\"city\";N;s:6:\"suburb\";N;s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:4:\"Tous\";}', 0, '2021-05-14 06:57:33', '2021-05-14 06:57:33'),
(119, NULL, NULL, 'a:12:{s:5:\"state\";s:3:\"NSW\";s:4:\"city\";N;s:6:\"suburb\";N;s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:11:\"residentiel\";s:7:\"typeRes\";s:1:\"1\";s:10:\"anciennete\";s:2:\"10\";s:12:\"localisation\";s:1:\"6\";s:21:\"residentiel_price_min\";s:5:\"50000\";s:21:\"residentiel_price_max\";s:7:\"7800000\";s:24:\"residentiel_bedrooms_min\";s:1:\"0\";s:24:\"residentiel_bedrooms_max\";s:2:\"10\";}', 0, '2021-05-14 06:58:44', '2021-05-14 06:58:44'),
(120, NULL, NULL, 'a:10:{s:5:\"state\";s:3:\"QLD\";s:4:\"city\";N;s:6:\"suburb\";N;s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:11:\"residentiel\";s:7:\"typeRes\";s:1:\"1\";s:21:\"residentiel_price_min\";s:5:\"50000\";s:21:\"residentiel_price_max\";s:7:\"7800000\";s:24:\"residentiel_bedrooms_min\";s:1:\"0\";s:24:\"residentiel_bedrooms_max\";s:2:\"10\";}', 0, '2021-05-14 06:59:08', '2021-05-14 06:59:08'),
(121, NULL, NULL, 'a:12:{s:5:\"state\";s:3:\"QLD\";s:4:\"city\";s:19:\"Ville de Gold Coast\";s:6:\"suburb\";s:9:\"Southport\";s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:11:\"residentiel\";s:7:\"typeRes\";s:1:\"1\";s:10:\"anciennete\";s:2:\"10\";s:12:\"localisation\";s:1:\"6\";s:21:\"residentiel_price_min\";s:5:\"50000\";s:21:\"residentiel_price_max\";s:7:\"7800000\";s:24:\"residentiel_bedrooms_min\";s:1:\"0\";s:24:\"residentiel_bedrooms_max\";s:2:\"10\";}', 0, '2021-05-15 22:29:01', '2021-05-15 22:29:01'),
(122, NULL, NULL, 'a:12:{s:5:\"state\";s:3:\"QLD\";s:4:\"city\";s:19:\"Ville de Gold Coast\";s:6:\"suburb\";s:9:\"Southport\";s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:11:\"residentiel\";s:7:\"typeRes\";s:1:\"1\";s:10:\"anciennete\";s:2:\"10\";s:12:\"localisation\";s:1:\"6\";s:21:\"residentiel_price_min\";s:5:\"50000\";s:21:\"residentiel_price_max\";s:7:\"7800000\";s:24:\"residentiel_bedrooms_min\";s:1:\"0\";s:24:\"residentiel_bedrooms_max\";s:2:\"10\";}', 0, '2021-05-16 00:04:18', '2021-05-16 00:04:18'),
(123, NULL, 'appartement', NULL, 0, '2021-05-18 04:38:38', '2021-05-18 04:38:38'),
(125, NULL, 'appartement', NULL, 0, '2021-05-19 04:30:25', '2021-05-19 04:30:25'),
(126, NULL, NULL, 'a:12:{s:5:\"state\";s:3:\"QLD\";s:4:\"city\";N;s:6:\"suburb\";N;s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:11:\"residentiel\";s:7:\"typeRes\";s:1:\"1\";s:10:\"anciennete\";s:2:\"10\";s:12:\"localisation\";s:1:\"6\";s:21:\"residentiel_price_min\";s:5:\"50000\";s:21:\"residentiel_price_max\";s:7:\"7800000\";s:24:\"residentiel_bedrooms_min\";s:1:\"0\";s:24:\"residentiel_bedrooms_max\";s:2:\"10\";}', 0, '2021-05-21 02:20:30', '2021-05-21 02:20:30'),
(127, NULL, NULL, 'a:6:{s:4:\"city\";N;s:6:\"suburb\";N;s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";N;s:7:\"typeRes\";s:1:\"1\";s:10:\"anciennete\";s:2:\"10\";}', 0, '2021-05-21 07:29:25', '2021-05-21 07:29:25'),
(129, 'VIC-Melbourne-Carlton | Tous', 'VIC,Melbourne,Carlton', 'a:6:{s:5:\"state\";s:3:\"VIC\";s:4:\"city\";s:9:\"Melbourne\";s:6:\"suburb\";s:7:\"Carlton\";s:7:\"sub_env\";s:2:\"on\";s:4:\"prod\";s:4:\"Tous\";s:3:\"url\";s:95:\"http://iea.easydata.mg/shop/search?state=VIC&city=Melbourne&suburb=Carlton&sub_env=on&prod=Tous\";}', 10, '2021-05-27 08:19:31', '2021-05-27 08:19:31');

-- --------------------------------------------------------

--
-- Structure de la table `seller_business`
--

CREATE TABLE `seller_business` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `business_name` varchar(191) NOT NULL,
  `street_adr` varchar(191) NOT NULL,
  `suburb` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `post_code` varchar(191) NOT NULL,
  `state` varchar(191) NOT NULL,
  `country` varchar(191) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email_adr` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `seller_individual`
--

CREATE TABLE `seller_individual` (
  `id` int(250) NOT NULL,
  `user_id` int(250) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(191) DEFAULT NULL,
  `nationality` varchar(191) DEFAULT NULL,
  `street_adr` varchar(191) NOT NULL,
  `suburb` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `post_code` varchar(191) NOT NULL,
  `state` varchar(191) NOT NULL,
  `country` varchar(191) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email_adr` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('TMxtYRVobd3FzZu0wRCzSkXU9FD9vv51GlAbiEs1', 1, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiN1RId0puTGN1OE1hQWlRWkRSbnZzS05xV2UyV2pQRHNXNTFwdU9kSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9pZWEuZWFzeWRhdGEubWcvYmxvZy9nb2xkLWNvYXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjExOiJwYWdlX2xvY2FsZSI7czoyOiJmciI7czo2OiJsb2NhbGUiO3M6MjoiZnIiO3M6ODoibm90aWZpZXIiO2E6MDp7fXM6NzoiY29tbWVudCI7czoxMzoibG9naW5fY29tbWVudCI7fQ==', 1630983605);

-- --------------------------------------------------------

--
-- Structure de la table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `image_id` bigint(20) NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sliders`
--

INSERT INTO `sliders` (`id`, `content`, `type`, `status`, `image_id`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Slider 1', 'image', 1, 14, 0, NULL, '2021-05-21 01:48:01', NULL),
(2, 'Slider 2', 'image', 1, 15, 0, NULL, '2021-05-21 01:48:31', NULL),
(4, 'melbourne-appartement', 'pub', 0, 17, 2, NULL, '2021-05-21 01:48:35', NULL),
(5, 'newport-bureau', 'pub', 0, 18, 3, NULL, '2021-05-21 01:48:35', NULL),
(6, 'iea-pub-video', 'video', 0, 118, 0, NULL, '2021-05-21 01:48:35', NULL),
(7, 'iea-pub-video', 'video', 0, 119, 0, NULL, '2021-06-10 14:33:36', '2021-06-10 14:33:36'),
(9, NULL, 'image', 1, 180, 0, '2021-06-04 03:55:14', '2021-06-10 14:33:43', '2021-06-10 14:33:43');

-- --------------------------------------------------------

--
-- Structure de la table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aus',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `states`
--

INSERT INTO `states` (`id`, `content`, `country`, `created_at`, `updated_at`) VALUES
(1, 'ACT', 'aus', '2018-06-28 13:57:39', NULL),
(2, 'NSW', 'aus', '2018-06-28 13:57:39', NULL),
(4, 'NT', 'aus', '2018-06-28 13:57:39', NULL),
(5, 'QLD', 'aus', '2018-06-28 13:57:39', NULL),
(6, 'SA', 'aus', '2018-06-28 13:57:39', NULL),
(7, 'TAS', 'aus', '2018-06-28 13:57:39', NULL),
(8, 'VIC', 'aus', '2018-06-28 13:57:39', NULL),
(9, 'WA', 'aus', '2018-06-28 13:57:39', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `braintree_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `braintree_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `temoignages`
--

CREATE TABLE `temoignages` (
  `id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `user_create` bigint(20) NOT NULL,
  `pays` varchar(100) NOT NULL,
  `statut` varchar(60) NOT NULL COMMENT 'Actif/Bloqué',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `temoignages`
--

INSERT INTO `temoignages` (`id`, `contenu`, `user_create`, `pays`, `statut`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, '<p>superbe plateforme</p>', 10, 'AUS', 'Actif', '2021-07-16 00:05:53', '2021-07-16 00:06:37', NULL),
(5, '<p>Lorsque nous avons d&eacute;cid&eacute; d&#39;acheter un bien r&eacute;sidentiel en Australie nous &eacute;tions un peu perdus et nous redoutions donc de nous engager dans une telle op&eacute;ration.</p>\r\n\r\n<p>Et puis nous avons d&eacute;couvert le portail &quot;Investir en Australie&quot;. Nous avons explor&eacute; les offres de programmes immobiliers publi&eacute;s et nous avons tr&egrave;s rapidement trouv&eacute; l&#39;appartement qui nous convenait. La communication avec l&#39;agence a &eacute;t&eacute; grandement facilit&eacute; du fait que nos interlocuteurs parlaient fran&ccedil;ais. Pour nous soutenir dans notre d&eacute;marche nous avons &eacute;galement s&eacute;lectionn&eacute; une agence locale pr&egrave;s de chez nous. Gr&acirc;ce au portail nous avons pu contacter un avocat qui s&#39;est charg&eacute; du contr&ocirc;le juridique de notre contrat. Nous sommes &agrave; pr&eacute;sent propri&eacute;taire en Australie sans que cela ne nous ait co&ucirc;t&eacute; un centime suppl&eacute;mentaire.</p>\r\n\r\n<p>Sans l&#39;assistance du portail et de ses nombreux partenaires nous aurions certainement renonc&eacute; &agrave; notre acquisition. Aussi nous recommandons fortement le portail immobilier &quot;Investir en Australie&quot;.</p>\r\n\r\n<p>Jean et Sarah</p>', 1, 'AUS', 'Actif', '2021-07-19 02:30:46', '2021-07-19 02:30:46', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `threads`
--

CREATE TABLE `threads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_one` bigint(20) UNSIGNED NOT NULL,
  `user_two` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `translations`
--

CREATE TABLE `translations` (
  `id` int(11) NOT NULL,
  `trans_key` varchar(191) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `translations`
--

INSERT INTO `translations` (`id`, `trans_key`, `lang`, `content`, `created_at`, `updated_at`) VALUES
(3, '', 'en', 'This is a stunning 2 bedroom apartment located in Melbourne Australia. The apartment could be used as a vacation home or as a permanent residence. There is a reception hall included with the property. In addition, the property is also fully furnished. Along with the property there is a communal swimming pool included. Along with the communal pool there is also a private garden. The size of the plot is measured at 75 square meters. with the covered area being 75m2. Available parking included with the property would be off street parking.', '2021-07-08 05:37:12', '2021-07-08 05:37:12'),
(1, '', 'fr', 'C\'est un superbe appartement de 2 chambres situé à Melbourne en Australie. L\'appartement pourrait être utilisé comme une maison de vacances ou comme une résidence permanente. Il y a une salle de réception incluse avec la propriété. En outre, la propriété est également entièrement meublée. Avec la propriété il y a une piscine communale incluse. Avec la piscine communale il y a aussi un jardin privé. La taille de la parcelle est mesurée à 75 mètres carrés. avec la surface couverte étant 75m2. Parking disponible inclus avec la propriété serait hors stationnement dans la rue.', '2021-07-07 21:00:00', '2021-07-07 21:00:00'),
(5, '', 'mg', 'Trano fandraisam-bahiny 2 mahavariana ity any Melbourne Australia. Ny trano dia azo ampiasaina ho trano fialan-tsasatra na hipetrahana maharitra. Misy efitrano fandraisana iray miaraka amin&#39;ny trano. Ho fanampin&#39;izay, ny trano dia feno fitaovana ihany koa. Miaraka amin&#39;ny trano dia misy dobo filomanosana miaraka. Miaraka amin&#39;ny dobo iraisana dia misy zaridaina tsy miankina ihany koa. Ny haben&#39;ny plot dia refesina amin&#39;ny 75 metatra toradroa. miaraka amin&#39;ny velarana 75m2. Ny fijanonana misy fiara miaraka amin&#39;ny trano dia ny fijanonana eny an-dalambe.', '2021-07-08 05:50:26', '2021-07-08 05:50:26'),
(6, '', 'es', 'Este es un impresionante apartamento de 2 dormitorios ubicado en Melbourne, Australia. El apartamento se puede utilizar como casa de vacaciones o como residencia permanente. Hay una sala de recepción incluida con la propiedad. Además, la propiedad también está completamente amueblada. Junto con la propiedad hay una piscina comunitaria incluida. Junto con la piscina comunitaria también hay un jardín privado. El tamaño de la parcela se mide en 75 metros cuadrados. con una superficie cubierta de 75m2. El estacionamiento disponible incluido con la propiedad sería estacionamiento fuera de la calle.', '2021-07-08 06:19:22', '2021-07-08 06:19:22'),
(7, '', 'fr', '<p><strong>Gold Coast</strong> est l&#39;agglom&eacute;ration australienne poss&eacute;dant le plus fort d&eacute;veloppement. Son potentiel ph&eacute;nom&eacute;nal en font un excellent choix pour <strong>investir en Australie</strong>.</p>\r\n\r\n<p>La fa&ccedil;ade maritime au Sud de <strong>Brisbane</strong> est particuli&egrave;re car, contrairement &agrave; une tr&egrave;s grande partie de la c&ocirc;te Est de l&#39;Australie qui est expos&eacute;e &agrave; la houle du Pacifique, elle est barr&eacute;e, &agrave; quelques encablures du rivage et sur environ 80 kilom&egrave;tres, par deux &icirc;les dans le prolongement l&#39;une de l&#39;autre, North Stradbroke Island et South Stradbroke Island, le Sud de la derni&egrave;re nomm&eacute;e commen&ccedil;ant &agrave; l&#39;embouchure de la Nerang River.</p>\r\n\r\n<p>Cette configuration sur une tr&egrave;s longue distance, compl&eacute;t&eacute;e par un r&eacute;seau hydrographique relativement important, cr&eacute;e une sorte de vaste plan ', '2021-09-06 22:09:26', '2021-09-06 22:38:37');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'type',
  `categories_id` int(11) NOT NULL DEFAULT 0,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `slug`, `title`, `content`, `object_type`, `categories_id`, `author_id`, `created_at`, `updated_at`) VALUES
(1, 'appartement', 'Appartement', NULL, 'type', 1, 1, '2018-06-28 10:57:38', NULL),
(2, 'maison', 'Maison', NULL, 'type', 1, 1, '2018-06-28 10:57:38', NULL),
(3, 'town-house', 'Maison Accolée', NULL, 'type', 1, 1, '2018-06-28 10:57:38', NULL),
(4, 'chalet', 'Chalet', NULL, 'type', 1, 1, '2018-06-28 10:57:38', NULL),
(5, 'fermette', 'Fermette', NULL, 'type', 1, 1, '2018-06-28 10:57:38', NULL),
(6, 'centre-urbain', 'Centre Urbain', NULL, 'location', 0, 1, '2018-06-28 10:57:38', NULL),
(7, 'peripherie-urbaine', 'Périphérie Urbaine', NULL, 'location', 0, 1, '2018-06-28 10:57:38', NULL),
(8, 'hors-agglomeration', 'Hors Agglomération', NULL, 'location', 0, 1, '2018-06-28 10:57:38', NULL),
(9, 'campagne', 'Campagne', NULL, 'location', 0, 1, '2018-06-28 10:57:38', NULL),
(10, 'neuf', 'Neuf', NULL, 'anciennete', 0, 1, NULL, NULL),
(11, 'existant', 'Existant', NULL, 'anciennete', 0, 1, NULL, NULL),
(12, 'lot-de-ville', 'Lot de ville', NULL, 'type', 2, 1, NULL, NULL),
(13, 'terrain-de-peripherie', 'Terrain de périphérie', NULL, 'type', 2, 1, NULL, NULL),
(14, 'terrain-de-campagne', 'Terrain de Campagne', NULL, 'type', 2, 1, NULL, NULL),
(15, 'fermette-d-agrement', 'Fermette d\'agrément', NULL, 'type', 2, 1, NULL, NULL),
(16, 'exploitation-agricole', 'Exploitation agricole', NULL, 'type', 2, 1, NULL, NULL),
(17, 'agriculture-extensive', 'Agriculture extensive', NULL, 'agricole', 2, 1, NULL, NULL),
(18, 'maraichage', 'Maraîchage', NULL, 'agricole', 2, 1, NULL, NULL),
(19, 'elevage-bovin', 'Elevage bovin', NULL, 'agricole', 2, 1, NULL, NULL),
(20, 'elevage-ovin', 'Elevage ovin', NULL, 'agricole', 2, 1, NULL, NULL),
(21, 'elevage-caprin', 'Elevage caprin', NULL, 'agricole', 2, 1, NULL, NULL),
(22, 'exploiation-forestiere', 'Exploitation forestière', NULL, 'agricole', 2, 1, NULL, NULL),
(23, 'atelier', 'Atelier', NULL, 'type', 3, 1, NULL, NULL),
(24, 'usine', 'Usine', NULL, 'type', 3, 1, NULL, NULL),
(25, 'centre-detudes', 'Centre d\'études', NULL, 'type', 3, 1, NULL, NULL),
(26, 'metallurgie', 'Métallurgie', NULL, 'industriel', 3, 1, NULL, NULL),
(27, 'mecanique-automobile', 'Mécanique automobile', NULL, 'industriel', 3, 1, NULL, NULL),
(28, 'industrie-de_la_chimie', 'Industrie de la chimie', NULL, 'industriel', 3, 1, NULL, NULL),
(29, 'industrie-du-plastique', 'Industrie du plastique', NULL, 'industriel', 3, 1, NULL, NULL),
(30, 'construction', 'Construction', NULL, 'industriel', 3, 1, NULL, NULL),
(31, 'genie-civil', 'Génie civil', NULL, 'industriel', 3, 1, NULL, NULL),
(32, 'transformation', 'Transformation', NULL, 'industriel', 3, 1, NULL, NULL),
(33, 'informatique', 'Informatique', NULL, 'industriel', 3, 1, NULL, NULL),
(34, 'industrie-du-papier', 'Industrie du papier', NULL, 'industriel', 3, 1, NULL, NULL),
(35, 'maritime', 'Maritime', NULL, 'industriel', 0, 3, '0000-00-00 00:00:00', NULL),
(36, 'peche', 'Pêche', NULL, 'industriel', 3, 1, NULL, NULL),
(37, 'ateliers', 'Atelier', NULL, 'type', 4, 1, NULL, NULL),
(38, 'magasin', 'Magasin', NULL, 'type', 4, 1, NULL, NULL),
(39, 'station', 'Station', NULL, 'type', 4, 1, NULL, NULL),
(40, 'alimentation', 'Alimentation', NULL, 'commercial', 4, 1, NULL, NULL),
(41, 'epicerie', 'Epicerie', NULL, 'commercial', 4, 1, NULL, NULL),
(42, 'primeur', 'Primeurs', NULL, 'commercial', 4, 1, NULL, NULL),
(43, 'restauration', 'Restauration', NULL, 'commercial', 4, 1, NULL, NULL),
(44, 'papeterie', 'Papeterie', NULL, 'commercial', 4, 1, NULL, NULL),
(45, 'materiel-de-bureau', 'Matériel de bureau', NULL, 'commercial', 4, 1, NULL, NULL),
(46, 'station-service', 'Station-service', NULL, 'commercial', 4, 1, NULL, NULL),
(47, 'reprographie', 'Reprographie', NULL, 'commercial', 4, 1, NULL, NULL),
(52, 'peche-nautisme-nature', 'Pêche/nautisme/nature', NULL, 'commercial', 4, 1, NULL, NULL),
(51, 'quincaillerie', 'Quincaillerie', NULL, 'commercial', 4, 1, NULL, NULL),
(50, 'bricolage', 'Bricolage', NULL, 'commercial', 4, 1, NULL, NULL),
(49, 'agrement', 'Agrément', NULL, 'commercial', 4, 1, NULL, NULL),
(48, 'informatiques', 'Informatique', NULL, 'commercial', 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_users`
--

CREATE TABLE `type_users` (
  `id` bigint(20) NOT NULL,
  `type_user_name` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_users`
--

INSERT INTO `type_users` (`id`, `type_user_name`) VALUES
(1, 'Organization'),
(2, 'Person'),
(3, 'Builder'),
(4, 'Developer'),
(5, 'Admin blog'),
(6, 'Admin delegate'),
(7, 'Super Admin'),
(8, 'Individual'),
(9, 'Business'),
(10, 'Real Estate Agency'),
(11, 'Business Broker');

-- --------------------------------------------------------

--
-- Structure de la table `userinfos`
--

CREATE TABLE `userinfos` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civility` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newsletter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_parent_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_presentation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_operation_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_operation_range` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_type` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_registration_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_rep_official_registration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_license_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_trading_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_abn` int(11) DEFAULT NULL,
  `orga_acn` int(9) DEFAULT NULL,
  `orga_fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_mobile_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_skype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orga_fb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` bigint(20) DEFAULT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crm_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crm_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_agency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_iban` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_bic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_sharing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `userinfos`
--

INSERT INTO `userinfos` (`id`, `first_name`, `last_name`, `date_of_birth`, `place_of_birth`, `nationality`, `sexe`, `civility`, `newsletter`, `orga_name`, `orga_parent_name`, `orga_presentation`, `orga_email`, `orga_phone`, `orga_website`, `orga_operation_state`, `orga_operation_range`, `orga_type`, `orga_form`, `orga_registration_number`, `orga_rep_official_registration`, `orga_license_number`, `orga_trading_name`, `orga_abn`, `orga_acn`, `orga_fax`, `orga_mobile_phone`, `orga_skype`, `orga_fb`, `level`, `contact_name`, `contact_email`, `contact_phone`, `crm_name`, `crm_email`, `bank_name`, `bank_agency`, `bank_iban`, `bank_bic`, `allow_sharing`, `user_id`, `created_at`, `updated_at`) VALUES
(50, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'APL 1', NULL, 'Présentation de mon APL 1', 'aplme@yopmail.com', '0323222222', 'http://www.apl.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'APL contact', 'aplme@yopmail.com', '0320000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2021-03-05 07:15:25', '2021-03-05 07:15:45'),
(49, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'AFA ME', NULL, 'Présentation de AFA Me', 'afame@yopmail.com', '0323222222', 'http://www.afa.com', 'QLD', 'Gamme d\'opérations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AFA contact', 'afame@yopmail.com', '0320000000', 'Crm afa name', 'afame@yopmail.com', NULL, NULL, NULL, NULL, NULL, 6, '2021-03-05 07:12:14', '2021-03-05 07:12:47'),
(48, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Seller Me', NULL, 'Présentation de mon Entreprise', 'sellerme@yopmail.com', '0323222222', 'http://www.seller.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Seller contact', 'sellerme@yopmail.com', '0320000000', 'Crm seller name', 'sellerme@yopmail.com', NULL, NULL, NULL, NULL, NULL, 9, '2021-03-05 07:03:53', '2021-08-11 03:51:37'),
(47, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Business Me', NULL, 'Présentation de mon entreprise', 'businessme@yopmail.com', '0323222222', 'http://www.businessme.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'CRM Member', 'membercrm@iea.com', NULL, NULL, NULL, NULL, NULL, 10, '2021-03-05 06:18:30', '2021-04-15 14:07:43'),
(46, 'DUPON', 'Pierre', NULL, NULL, NULL, NULL, NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 84, '2021-03-05 04:54:37', '2021-03-05 04:54:37'),
(45, 'MEMBER', 'Member', NULL, NULL, NULL, NULL, NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 83, '2021-03-05 01:21:17', '2021-03-05 01:21:17'),
(44, 'MEMBER', 'Member', NULL, NULL, NULL, NULL, NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 82, '2021-03-05 01:14:11', '2021-03-05 01:14:11'),
(43, '', '', NULL, NULL, NULL, NULL, NULL, 'on', 'Organisation', NULL, 'Présentation de mon organisation', 'organisationiea@yopmail.com', '0323222222', 'http://www.organisation.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Seller contact', 'betaxe@yopmail.com', '0320000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, '2021-03-02 23:58:13', '2021-03-02 23:58:13'),
(42, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'APL Me', NULL, 'Présentation de l\'APL Me', 'apliea@yopmail.com', '0323222222', 'http://www.apl.com', NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Apl contact', 'apliea@yopmail.com', '0320000000', NULL, NULL, NULL, NULL, '12313131', '15654654', NULL, 80, '2021-03-02 00:51:12', '2021-03-02 00:51:12'),
(41, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'APL', NULL, 'Présentation APL', 'afaiea@yopmail.com', '0323222222', 'http://www.afa.com', '5', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AFA contact', 'afaiea@yopmail.com', '0320000000', 'Crm afa name update', 'afaiea@yopmail.com', NULL, NULL, NULL, NULL, NULL, 2, '2021-03-02 00:22:17', '2021-03-12 01:40:06'),
(40, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Business Me', NULL, 'This is a presention of my business company', 'betaxe1@yopmail.com', '0323222222', 'http://www.seller.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Seller contact', 'betaxe1@yopmail.com', '0320000000', 'Crm seller name', 'betaxe1@yopmail.com', NULL, NULL, NULL, NULL, NULL, 78, '2021-03-01 08:27:36', '2021-03-01 08:27:36'),
(39, 'DUPON', 'Pierre', NULL, NULL, NULL, NULL, NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77, '2021-03-01 06:04:18', '2021-03-01 06:04:18'),
(51, 'PARTICULIER', 'Me', NULL, NULL, NULL, NULL, NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, '2021-03-05 07:30:31', '2021-03-05 07:30:31'),
(52, 'PARTICULIER', 'Me', NULL, NULL, NULL, NULL, NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, '2021-03-05 07:41:57', '2021-03-05 07:41:57'),
(53, 'PARTICULIER', 'Me', NULL, NULL, NULL, 'F', NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, '2021-03-05 07:43:10', '2021-03-05 07:43:10'),
(61, 'PARTICULIER', 'ME SSS', NULL, NULL, NULL, 'F', NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 95, '2021-03-23 02:18:36', '2021-03-23 02:18:36'),
(62, 'Rakoto', 'Manou', NULL, NULL, NULL, 'M', NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'on', 96, '2021-04-15 12:05:36', '2021-04-15 12:05:36'),
(63, 'MEMBER', 'Me', NULL, NULL, NULL, 'M', NULL, 'on', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 98, '2021-04-16 08:16:11', '2021-04-16 08:16:11'),
(64, 'Rakoto', 'Manou', NULL, NULL, NULL, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, '2021-04-22 12:12:49', '2021-04-22 12:12:49'),
(65, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'APL T', NULL, 'This is a presentation of apl T', 'alt.gm-0s4esnx@yopmail.com', '0320000000', 'http://www.aplt.com', NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'APL T Contact', 'alt.gm-0s4esnx@yopmail.com', '0320000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 125, '2021-06-14 10:24:39', '2021-06-14 10:24:39'),
(66, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'APL AGENCE', NULL, NULL, NULL, NULL, NULL, NULL, '10', 'society', 'sarl', 'RCS PARIS B 517 403 572', NULL, '000000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'contact test', 'apltest@contact.com', '061213212', NULL, NULL, 'BFV', 'BFV', 'FR7612548029989876543210917', 'CRLYFRPP', NULL, 126, '2021-06-17 02:24:24', '2021-06-17 02:24:24'),
(67, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'AFA T', NULL, NULL, 'alt.gm-0s4esnx@yopmail.com', '12345678', 'http://www.AFA.com', 'a:2:{i:0;s:2:\"NT\";i:1;s:3:\"TAS\";}', '10', NULL, NULL, NULL, NULL, 'RCSPARIS444777111', 'AFA T TD', 2147483647, NULL, NULL, '12345678', NULL, NULL, NULL, 'AFA T Contact', 'alt.gm-0s4esnx@yopmail.com', '12345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, '2021-06-21 08:35:46', '2021-06-21 08:35:46'),
(68, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'L\'Immobilière Australienne Pty Ltd', NULL, 'This is IEA portal internal real estate agency.', 'pebedepe@gmail.com', '415940412', 'https://investirenaustralie.com', 'a:1:{i:0;s:3:\"QLD\";}', '10', NULL, NULL, NULL, NULL, '4301828', 'LIA', 2147483647, 632675113, NULL, '415940412', NULL, NULL, 2, 'Philippe Buteri de Préville', 'philippe@buteridepreville.fr', '41594041', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 128, '2021-08-19 21:17:25', '2021-08-19 21:25:42'),
(69, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'L\'Immobiliere Australienne Pty Ltd', NULL, 'beau soleil', 'kanakcaledonien@gmail.com', '415940412', 'https://investirenaustralie.com', 'a:1:{i:0;s:3:\"QLD\";}', '50', NULL, NULL, NULL, NULL, '4301828', 'LIA', 2147483647, 632675113, NULL, '415940412', NULL, NULL, 2, 'Philippe Buteri de Préville', 'philippe@buteridepreville.fr', '41594041', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 129, '2021-08-24 01:40:15', '2021-08-24 01:40:15'),
(70, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'AFA business', NULL, NULL, 'batpro@iea.com', '216161616', 'http://www.seller.com', 'a:1:{i:0;s:3:\"QLD\";}', '10', NULL, NULL, NULL, NULL, '43165161616', 'Trad name', 2147483647, 616162161, '65616161984', '316513161', NULL, NULL, 2, 'contact test', 'selerbyafacontact@contact.com', '51631616', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 130, '2021-08-24 09:47:10', '2021-08-24 09:47:10'),
(71, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'L\'Immobiliere Australienne Pty Ltd', NULL, '\"L\'Immobilière Australienne Pty Ltd\" is the in-house agency of \"Investir en Australie\" (IEA) system.\r\n\r\nIt is responsible for identifying programs and properties for sale, negotiating sales c', 'kanakcaledonien@gmail.com', '415940412', 'https://www.buteridepreville.fr/', 'a:2:{i:0;s:3:\"NSW\";i:1;s:3:\"QLD\";}', '250', NULL, NULL, NULL, NULL, '4301828', 'LIA', 2147483647, 632675113, NULL, '415940412', NULL, NULL, 2, 'Philippe Buteri de Préville', 'philippe@buteridepreville.fr', '415940413', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 133, '2021-08-30 21:17:16', '2021-08-30 21:17:16');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `immat` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` bigint(20) NOT NULL,
  `type_users_id` bigint(20) NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fr',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` double(8,2) DEFAULT NULL,
  `enabled_at` datetime DEFAULT NULL,
  `disabled_at` datetime DEFAULT NULL,
  `use_default_password` int(11) NOT NULL DEFAULT 0,
  `is_complete` int(1) NOT NULL DEFAULT 0,
  `is_seller` int(11) NOT NULL DEFAULT 0,
  `is_move` bigint(20) NOT NULL,
  `apl_id` bigint(20) NOT NULL DEFAULT 0,
  `apl_ends_at` datetime DEFAULT NULL,
  `afa_id` bigint(20) NOT NULL,
  `afa_ends_at` datetime DEFAULT NULL,
  `image_id` bigint(20) NOT NULL DEFAULT 0,
  `author_id` bigint(20) NOT NULL DEFAULT 0,
  `location_id` bigint(20) NOT NULL DEFAULT 0,
  `country_id` bigint(20) NOT NULL DEFAULT 0,
  `operation_range` bigint(20) NOT NULL DEFAULT 0,
  `state_id` bigint(20) NOT NULL DEFAULT 0,
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `braintree_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `subscription_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `immat`, `email`, `password`, `role`, `type_users_id`, `language`, `status`, `percent`, `enabled_at`, `disabled_at`, `use_default_password`, `is_complete`, `is_seller`, `is_move`, `apl_id`, `apl_ends_at`, `afa_id`, `afa_ends_at`, `image_id`, `author_id`, `location_id`, `country_id`, `operation_range`, `state_id`, `activation_code`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `braintree_id`, `paypal_email`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`, `subscription_ends_at`) VALUES
(1, 'admin', '', 'admin@iea.com', '$2y$10$CbEB6ExASZj4c.4yAjPHpeakHObJdFmV.eKktDxZRNHJ5VIQtPGq2', 1, 7, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 172, 0, 18, 0, 0, 0, NULL, 'FTlOnzzOU9TVZKNT1g1YEq7I7nUMAUxsCa0yzk6BI6lL1DwQeIrXeRtMvcmo', '2018-06-28 13:57:36', '2021-05-22 03:57:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'apl', '', 'apl@iea.com', '$2y$10$XsD3J8G3YG.wx0lmm/WcCO.a13wSrkIZQ0BSAJRACC71.W2ja8XFO', 4, 1, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 6, 2, 0, 2, NULL, 'uKJkXyXur7sYVT0CLD2W79HqfAYzb5nfNBnQbYXLHOTQDU9n0fzGfprOAANJ', '2018-06-28 13:57:37', '2021-03-12 01:40:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'apl1', '', 'apl1@iea.com', '$2y$10$CpBv3U7yw2U0EXe0ZyEMMe/rYD/Dz5vizZ19Bb8ul7xj690rHQtPC', 4, 1, 'fr', 'disabled', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 1, 0, 0, 0, NULL, 'hCxWHOdOHtOag0Tuf8DcYxrP244Cmnh9ZbD9nYWtYlPCnbtp2ouYOG6K3esM', '2018-06-28 13:57:37', '2021-04-22 14:32:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'apl2', '', 'apl2@iea.com', '$2y$10$0.dpclXHl.yTaumZrkicEu3NZkdkZ83iJST03b0Jhgc6BXWGYrNli', 4, 1, 'fr', 'disabled', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 7, 0, 0, 0, NULL, 'TwngjrsE40exfCcyCUyheYOmyq7k0KxlImN1XaST1z8GK8ETOUJQERw2MEOO', '2018-06-28 13:57:37', '2021-04-22 14:25:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'apl3', '', 'apl3@iea.com', '$2y$10$EOXFR0.BnAAhjok0egDwBO..TTnc3/kHB14oKP9tWIo/.mpKrcldy', 4, 1, 'fr', 'disabled', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 3, 0, 0, 0, NULL, 'TbtGIRMVvBaE50bNoMBa6weBoftb9gHlsMyXef5VjU75hh9qfX0EGwRSmDKe', '2018-06-28 13:57:37', '2021-04-22 14:20:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'afa', 'AFA-00000', 'afa@iea.com', '$2y$10$hE3T23z/qaE0LaXKieXUP.GfB2N5K0Q9bvyMdB0KPi.qpDMYuQsvu', 3, 1, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 4, 0, 0, 0, '95f464b24e4429bd3627c3821de32ba9', '1TIBIowExIsWI8Swx0iE9oxCKjec0XxCMU78lIVHWlvF9dPEPA3eBZ0c3wiU', '2018-06-28 13:57:37', '2021-04-30 03:35:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'afa3', '', 'afa3@iea.com', '$2y$10$ZLJd5oZb7aT/a7R/A0AyJ.FzTZmNLRenVQtjilmqotgxFqGM6IEci', 3, 1, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 5, 0, 0, 0, NULL, NULL, '2018-06-28 13:57:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'seller', '', 'seller@iea.com', '$2y$10$6AbL5Qy.AiRjcZTbMTbRoeXxljw8Ec4PJ96up.rRArSMBSVwHwrJW', 2, 1, 'en', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, NULL, 'S25drO3NhdqpA6waRaixhmutiE1cXYndOZALfomHHepueS1LMCwUWIeeK4px', '2018-06-28 13:57:38', '2021-08-11 03:51:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'member', 'MEM-00000', 'member@iea.com', '$2y$10$rqFRwMOAPM7gpM2ARJSAOOAKjYEaJr/fHLarJ/T6.G42o19mhq2T6', 5, 1, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 1, 2, '2022-01-24 05:03:47', 0, NULL, 105, 0, 13, 0, 0, 0, NULL, 'UeXgyRB1GQylTO4Su3PdqDXUbgrM9zjAAtpuZ2lWOn40YRuwhcfe7wIt8Ox6', '2018-06-28 13:57:38', '2021-07-28 02:03:47', NULL, NULL, NULL, 'cus_D90QEUbr8YyBEp', 'Visa', '4242', NULL, NULL),
(11, 'tsorakoto', '', 'tsorakoto@gmail.com', '$2y$10$JF67aZ.4v7TM9kRKbIWLMuebX7PaijjsloGYlHbXJl.AO0.NXwYX.', 5, 2, 'fr', 'active', NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 7, 0, 0, 0, NULL, NULL, '2018-07-02 18:13:06', '2018-07-02 19:00:35', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-12 19:00:35', NULL),
(12, 'NTH', '', 'hnytahiry@gmail.com', '$2y$10$W3pM1i9KUg9rORja26bsqeBwQmfvir59eFEr/rDXO0tU8W/exSmgm', 5, 2, 'fr', 'active', NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, NULL, 30, 0, 8, 0, 0, 0, NULL, NULL, '2018-07-12 19:08:24', '2018-07-12 21:02:18', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-22 21:02:18', NULL),
(13, 'sam', '', 'teste@gmail.com', '$2y$10$x9t4wNjo1Loq9sSkE2mYgeWizZwn4m6w3bx6i/E4xbl7QlfJgfO/y', 5, 2, 'fr', 'pinged', NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 9, 0, 0, 0, 'cd21d42d3a786f0e8a53995cb315697f', NULL, '2019-03-19 03:45:15', '2019-03-19 03:45:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 'afame', '', 'afaiea@yopmail.com', '$2y$10$NUNmxUSYwVmqWeTKf/hJ2e2wlazotIn.CfD4E6LLbJsh6qLzZs3A6', 3, 1, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 102, 0, 13, 0, 0, 0, NULL, 'hjEn2OFxHAZu21sAJgit4cX88tVX7T0ChyitkyeOPbazTlewGGwzukxNsmxo', '2021-03-02 00:22:17', '2021-03-02 00:23:24', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-12 00:22:58', NULL),
(80, 'aplme', '', 'apliea@yopmail.com', '$2y$10$rlrnRu3ItG0PSGRMaxPLvOVfnHR/IOHh2Bxf7fTqUTjRPq8vqc6mG', 4, 1, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 103, 0, 2, 0, 0, 0, NULL, 'iJbFeXrQoT1F1usBw5yqO8sajQR17r82gksDs3Ah2HqmZdWCaSVaTKgdScaN', '2021-03-02 00:51:12', '2021-03-02 01:02:38', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-12 00:57:36', NULL),
(81, 'organisation', '', 'organisationiea@yopmail.com', '$2y$10$je9XPtoDkhvmY6b8V.gHxOqxWQN8ptEFhz9ORk1/Huck6l5oNylsi', 5, 1, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 104, 0, 152, 0, 0, 0, NULL, '9RjE8oHgLVFeFfIeNPApo9oxgwCFB1cQTdO52Rd185fX3Tksvnzx1nolARps', '2021-03-02 23:58:13', '2021-03-05 01:12:26', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-12 23:59:18', NULL),
(77, 'TEST', '', 'betaxe@yopmail.com', '$2y$10$8w5CUv1bc8OYb4dxFY5x.e854pmRZ/eeebxU.AaQBGXkV.84UXyJG', 5, 1, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 144, 0, 0, 0, NULL, 'NvckIOVr9u3MqN9tee9odYESbAheJmUjaATnNGpy3PzLLLBoGAEe37NsAztT', '2021-03-01 06:04:18', '2021-03-01 08:16:55', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-11 06:06:40', NULL),
(78, 'sellerv2', '', 'betaxe1@yopmail.com', '$2y$10$q.sc.t/b6zbX12psaoyrQ.1Oh3iV4R56iXn4J5kcY2zp8Qdgummm2', 2, 3, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 97, 0, 145, 0, 0, 0, NULL, 'ngWQiNjMgAKw6pbwNTTKFfRyWmS1GGfpHStejVGi0fdb3rLEfNV0XoED4kbP', '2021-03-01 08:27:36', '2021-03-01 08:31:10', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-11 08:30:29', NULL),
(87, 'particulierme', '', 'particulierme@yopmail.com', '$2y$10$qZ3r/.zCwNAA6qNbGd4/V.bngAxzfTUKdotQt8G.PcmXVnDj0Ew/q', 5, 2, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 159, 0, 0, 0, NULL, 'EtO4q9UTvhcjfv9lu5TzClW9vJeyL0hoNIybG6Oc6lXdAkKiblZwpMbjrGeg', '2021-03-05 07:43:10', '2021-03-23 01:41:36', NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-15 07:43:56', NULL),
(95, 'partsex', '', 'particuliermesex@yopmail.com', '$2y$10$vPK2IiWHJmbKXcpCo.E3Tu64IUVppgEw16Pw8gNzQxK5oF6iOmhVe', 5, 2, 'fr', 'active', NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 168, 0, 0, 0, '32c2353fc2e00d46f9bf75a2ab5101c3', NULL, '2021-03-23 02:18:36', '2021-03-23 02:26:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'memberme', '', 'memberme@yopmail.com', '$2y$10$rqFRwMOAPM7gpM2ARJSAOOAKjYEaJr/fHLarJ/T6.G42o19mhq2T6', 5, 2, 'fr', 'disabled', NULL, NULL, NULL, 0, 0, 0, 1, 0, NULL, 6, NULL, 105, 0, 171, 0, 0, 0, '751a4cd4775e0dfa367af2c9b267ce80', 'ENVyj5yA6Z3KEumsOVvBoz63CixrJ7X35o1N09GMUnR2gRD4Guu64j4igejv', '2021-04-16 01:12:55', '2021-05-27 10:46:02', NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-29 01:59:21', NULL),
(99, 'memberme2', '', 'memberme2@yopmail.com', '$2y$10$eVKLWTUB7xobU3XyIFRrluZ68VyH2.xsG3lSHmg8jG92RPZ4rxlUC', 5, 2, 'fr', '', NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 172, 0, 0, 0, '1a0bcd2940b1d2fa58ab25700e32cdaa', NULL, '2021-04-21 01:46:03', '2021-04-21 01:46:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'manohisoa.dev', '', 'manohisoa.dev@gmail.com', '$2y$10$TjgwaX.VXVKtA7xZMNZ.AOAIE10WdcxC9Pf8hyjanJIjBKxRfOgW2', 5, 2, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 171, 0, 0, 0, NULL, 'Fn0gP7k7cHfXhEQ6VQn8EzBc1nmqVGRYkQ4HXcdUe99HHUhCzEcZtClhM0ek', '2021-04-22 12:12:49', '2021-04-22 12:14:10', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-02 12:13:42', NULL),
(124, 'Collaborateur', '', 'collaborateuriea@yopmail.com', '$2y$10$0WeNtBzDr2UNwmkxSObN4OhDlDRRtSYEszTdDebyhlGsULvtk5Gp2', 6, 5, 'fr', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, NULL, 'CqroAGQRs02JM2URF7UFiGYkfYqM5yOvH8Tp3Q4lrZdHsShOGMQmTO0cGyz3', '2021-06-04 10:04:53', '2021-06-04 10:04:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 'apltiana', '', 'alt.gm-0s4esnx@yopmail.com', '$2y$10$6z.2G5o4rlVnUysfHczTbeYy3/lBlQMicKLHdMxOl0MFOsbK.JqJy', 4, 1, 'fr', '', NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, NULL, 184, 0, 180, 0, 0, 0, '4ae159f7621e1af7e0aff5ca1a70d8c6', NULL, '2021-06-14 10:24:39', '2021-06-14 10:24:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 'apltest', '', 'apltest@yopmail.com', '$2y$10$vqpHu5rVeRoxKZVQOprh0Oe42oj3ARIpOcouMJmBrasfk.h1.agrO', 4, 1, 'fr', '', NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, NULL, 185, 0, 181, 0, 0, 0, '588872684f2b82adf118a76ce765850d', NULL, '2021-06-17 02:24:24', '2021-06-17 02:24:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 'AFA Tiana', '', 'apltiana@yopmail.com', '$2y$10$YCW5LYnCRbCubty44pRChOmOMxZoLhZdqLop7oTylcWxqUyuozytC', 3, 4, 'en', '', NULL, NULL, NULL, 1, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 182, 0, 0, 0, '18b02c44cdee7654936014fd37b8f0a4', NULL, '2021-06-21 08:35:46', '2021-06-21 08:35:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 'Nakamal', 'AFA-00001', 'pebedepe@gmail.com', '$2y$10$mFd8RoZvy/Dx5dUwW9ep6ezButj9IV/qDnbipOPu0t3il9fvUB58q', 3, 4, 'en', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 235, 0, 199, 0, 0, 0, NULL, 'sPQL5CS1gCJftgXO4SxhEJlOLGI3qsYVOJsi3Jb1vGwhTAyTxw1RzMVSxyBQ', '2021-08-19 21:17:25', '2021-08-24 19:00:22', '2021-08-24 19:00:22', NULL, NULL, NULL, NULL, NULL, '2021-08-29 21:19:27', NULL),
(129, 'Nakamal2327', 'AFA-00002', 'kanakcaledonien@gmail.com', '$2y$10$IWpGBk9yusvPRjj3MFnT.eBEhWqGvHo1n2fseABHx10jeMvhnKT8q', 3, 3, 'en', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 200, 0, 0, 0, NULL, 'uL9H2fMRNas15eIpQ0nL3HuqBaqGOUBhVXYFb0kSLy2NKXPlCKfegJy8AUW8', '2021-08-24 01:40:15', '2021-08-24 19:00:08', '2021-08-24 19:00:08', NULL, NULL, NULL, NULL, NULL, '2021-09-03 01:44:42', NULL),
(130, 'afauser', 'AFA-00003', 'afauser@yopmail.com', '$2y$10$5UCUioctllWumv3iafhzWeRsBdxp4DM9jZYx5LNA.lr/f6vyDRcka', 3, 3, 'en', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, 0, 201, 0, 0, 0, NULL, '5JQJRrovJkBywWX4A2KewyJf0d6ZTjsi3hu1401oCUOzCKlaOGK4KjR6gzHm', '2021-08-24 09:47:10', '2021-08-24 09:53:41', NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-03 09:52:19', NULL),
(133, 'LIA', 'AFA-00004', 'limmobiliereaustralienne@gmail.com', '$2y$10$Lf3dINFrXbfGANIeMkUZ8.udxKfoVOJbvg/KUwHt8b.dq9XCJaCmy', 3, 10, 'en', 'active', NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 238, 0, 204, 0, 0, 0, NULL, '7THMWgyqkk6VKGiQxdKApbYjVtmALvBzBtYsb7qbzkDYMMVY7XfiMm7aCdBu', '2021-08-30 21:17:16', '2021-08-31 20:07:50', NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-09 21:19:57', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `badwords`
--
ALTER TABLE `badwords`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`),
  ADD KEY `blogs_status_index` (`status`),
  ADD KEY `blogs_starred_index` (`starred`),
  ADD KEY `blogs_post_type_index` (`post_type`),
  ADD KEY `blogs_image_id_index` (`image_id`),
  ADD KEY `blogs_author_id_index` (`author_id`);

--
-- Index pour la table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_title_index` (`title`),
  ADD KEY `categories_author_id_index` (`author_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_status_index` (`status`),
  ADD KEY `comments_reply_id_index` (`reply_id`),
  ADD KEY `comments_blog_id_index` (`blog_id`),
  ADD KEY `comments_user_id_index` (`user_id`);

--
-- Index pour la table `comment_spam`
--
ALTER TABLE `comment_spam`
  ADD KEY `comment_spam_comment_id_index` (`comment_id`),
  ADD KEY `comment_spam_user_id_index` (`user_id`);

--
-- Index pour la table `comment_user_vote`
--
ALTER TABLE `comment_user_vote`
  ADD KEY `comment_user_vote_comment_id_index` (`comment_id`),
  ADD KEY `comment_user_vote_user_id_index` (`user_id`);

--
-- Index pour la table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `configs_name_index` (`name`);

--
-- Index pour la table `conjunction_agreements`
--
ALTER TABLE `conjunction_agreements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_author_id_index` (`author_id`),
  ADD KEY `contacts_location_id_index` (`location_id`);

--
-- Index pour la table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_code_index` (`code`),
  ADD KEY `countries_content_index` (`content`),
  ADD KEY `countries_prefixphone_index` (`prefixPhone`);

--
-- Index pour la table `dossier_transactions`
--
ALTER TABLE `dossier_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `firbs`
--
ALTER TABLE `firbs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `labels_label_index` (`label`),
  ADD KEY `labels_author_id_index` (`author_id`),
  ADD KEY `labels_product_id_index` (`product_id`);

--
-- Index pour la table `localizations`
--
ALTER TABLE `localizations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mails_template`
--
ALTER TABLE `mails_template`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mails_users`
--
ALTER TABLE `mails_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mandat_recherches`
--
ALTER TABLE `mandat_recherches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `meta_datas`
--
ALTER TABLE `meta_datas`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_messages`
--
ALTER TABLE `model_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletter_templates`
--
ALTER TABLE `newsletter_templates`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Index pour la table `objects_categories`
--
ALTER TABLE `objects_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `observations`
--
ALTER TABLE `observations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `observations_user_id_index` (`user_id`),
  ADD KEY `observations_author_id_index` (`author_id`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_title_index` (`title`);

--
-- Index pour la table `page_images`
--
ALTER TABLE `page_images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parameters_emails`
--
ALTER TABLE `parameters_emails`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plans_slug_unique` (`slug`),
  ADD KEY `plans_type_index` (`type`),
  ADD KEY `plans_role_index` (`role`);

--
-- Index pour la table `postalcodes`
--
ALTER TABLE `postalcodes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_reference_index` (`reference`),
  ADD KEY `products_status_index` (`status`),
  ADD KEY `products_type_id_index` (`type_id`),
  ADD KEY `products_location_type_id_index` (`location_type_id`),
  ADD KEY `products_category_id_index` (`category_id`),
  ADD KEY `products_buyer_id_index` (`buyer_id`),
  ADD KEY `products_seller_id_index` (`seller_id`),
  ADD KEY `products_author_id_index` (`author_id`),
  ADD KEY `products_state_id_index` (`state_id`),
  ADD KEY `products_location_id_index` (`location_id`),
  ADD KEY `products_image_id_index` (`image_id`);

--
-- Index pour la table `products_fond_dossier`
--
ALTER TABLE `products_fond_dossier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_eoi`
--
ALTER TABLE `product_eoi`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_lia`
--
ALTER TABLE `product_lia`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `programme_translations`
--
ALTER TABLE `programme_translations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pubs`
--
ALTER TABLE `pubs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pubs_author_id_index` (`author_id`),
  ADD KEY `pubs_image_id_index` (`image_id`);

--
-- Index pour la table `pubs_pages`
--
ALTER TABLE `pubs_pages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `relation_membre_apl`
--
ALTER TABLE `relation_membre_apl`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_status_index` (`status`),
  ADD KEY `sales_apl_id_index` (`apl_id`),
  ADD KEY `sales_afa_id_index` (`afa_id`),
  ADD KEY `sales_cancelled_by_index` (`cancelled_by`),
  ADD KEY `sales_product_id_index` (`product_id`),
  ADD KEY `sales_author_id_index` (`author_id`);

--
-- Index pour la table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `searches_author_id_index` (`author_id`);

--
-- Index pour la table `seller_business`
--
ALTER TABLE `seller_business`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `seller_individual`
--
ALTER TABLE `seller_individual`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Index pour la table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_content_index` (`content`),
  ADD KEY `states_country_index` (`country`);

--
-- Index pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `temoignages`
--
ALTER TABLE `temoignages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `types_slug_unique` (`slug`),
  ADD KEY `types_title_index` (`title`),
  ADD KEY `types_object_type_index` (`object_type`),
  ADD KEY `types_author_id_index` (`author_id`);

--
-- Index pour la table `type_users`
--
ALTER TABLE `type_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `userinfos`
--
ALTER TABLE `userinfos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_is_seller_index` (`is_seller`),
  ADD KEY `users_apl_id_index` (`apl_id`),
  ADD KEY `users_apl_ends_at_index` (`apl_ends_at`),
  ADD KEY `users_image_id_index` (`image_id`),
  ADD KEY `users_author_id_index` (`author_id`),
  ADD KEY `users_location_id_index` (`location_id`),
  ADD KEY `users_country_id_index` (`country_id`),
  ADD KEY `users_operation_range_index` (`operation_range`),
  ADD KEY `users_state_id_index` (`state_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `badwords`
--
ALTER TABLE `badwords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `conjunction_agreements`
--
ALTER TABLE `conjunction_agreements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT pour la table `dossier_transactions`
--
ALTER TABLE `dossier_transactions`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `firbs`
--
ALTER TABLE `firbs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT pour la table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `localizations`
--
ALTER TABLE `localizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT pour la table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `mails_template`
--
ALTER TABLE `mails_template`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `mails_users`
--
ALTER TABLE `mails_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `mandat_recherches`
--
ALTER TABLE `mandat_recherches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `meta_datas`
--
ALTER TABLE `meta_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT pour la table `model_messages`
--
ALTER TABLE `model_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `newsletter_templates`
--
ALTER TABLE `newsletter_templates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `objects_categories`
--
ALTER TABLE `objects_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT pour la table `observations`
--
ALTER TABLE `observations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `page_images`
--
ALTER TABLE `page_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `parameters_emails`
--
ALTER TABLE `parameters_emails`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `postalcodes`
--
ALTER TABLE `postalcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `products_fond_dossier`
--
ALTER TABLE `products_fond_dossier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `product_eoi`
--
ALTER TABLE `product_eoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `product_lia`
--
ALTER TABLE `product_lia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `programme_translations`
--
ALTER TABLE `programme_translations`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `pubs`
--
ALTER TABLE `pubs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pubs_pages`
--
ALTER TABLE `pubs_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `relation_membre_apl`
--
ALTER TABLE `relation_membre_apl`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `searches`
--
ALTER TABLE `searches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT pour la table `seller_business`
--
ALTER TABLE `seller_business`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `seller_individual`
--
ALTER TABLE `seller_individual`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `temoignages`
--
ALTER TABLE `temoignages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `type_users`
--
ALTER TABLE `type_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `userinfos`
--
ALTER TABLE `userinfos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
