-- Adminer 4.8.1 MySQL 5.5.5-10.3.34-MariaDB-0ubuntu0.20.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `obaby`;
CREATE DATABASE `obaby` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `obaby`;

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DADD4A251E27F6BF` (`question_id`),
  KEY `IDX_DADD4A25A76ED395` (`user_id`),
  CONSTRAINT `FK_DADD4A251E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  CONSTRAINT `FK_DADD4A25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `answer`;
INSERT INTO `answer` (`id`, `question_id`, `user_id`, `content`, `created_at`, `status`) VALUES
(1,	2,	11,	'Perso, je dormais sur le côté gauche (j’ai lu quelque part qu’il ne fallait pas dormir du côté droit) et j’avais un doomoo pour dormir. Je dormais mieux avec que sans.',	'2022-08-05',	1),
(3,	2,	14,	'Mon mari me massait les jambes et les pieds tous les soirs et je dormais comme un bébé.',	'2022-08-05',	1),
(4,	3,	14,	'Si vous avez perdu les eaux, si vous ne sentez plus bébé bouger ou si vous avez des contractions régulières et rapprochées pendant une heure.',	'2022-08-05',	1),
(5,	3,	15,	'Il ne faut pas aller à la maternité si vos contractions ne sont pas régulières et si elles passent avec du spasfon. Mais si vous avez un doute, il faut y aller quand même pour être prudente.',	'2022-08-05',	1),
(6,	3,	14,	'Moi, j’ai perdu les eaux, c’était radical lol. Une douche et hop, direction la maternité.',	'2022-08-05',	1),
(7,	2,	10,	'Vous avez essayé de prendre un bain avant de dormir ? Moi ça m’a aidé.',	'2022-08-05',	1),
(8,	3,	16,	'Tu le sauras hahaha. L’instinct maternel comme on dit.',	'2022-08-05',	1),
(9,	4,	16,	'J’ai utilisé l\'huile de massage vergetures Weleda : je recommande !!!',	'2022-08-05',	1),
(10,	4,	17,	'Il existe plein de crèmes différentes : il faut voir laquelle est plus adaptée à votre peau.',	'2022-08-05',	1),
(11,	6,	17,	'Tu devrais tirer ton lait pour que papa puisse donner un biberon de nuit !',	'2022-08-05',	1),
(12,	5,	18,	'Moi, les nausées venaient les matins au réveil donc j’attendais un peu avant de me lever et ça se calmait tout seul.',	'2022-08-05',	1),
(13,	5,	15,	'La durée des nausées et leurs intensités varient pour chaque femme et pour chaque grossesse. Une même femme peut avoir une grossesse sans nausées et une seconde avec. Il n’y a pas de règle malheureusement.\r\nLa fatigue accentue les nausées donc je vous conseille de vous reposer et de prendre des jours de repos si vous travaillez.\r\nPrenez l’air et évitez les fortes chaleurs.\r\nCela n’arrêtera pas totalement les nausées mais permet de les diminuer.',	'2022-08-05',	1),
(14,	6,	15,	'Y’a pas de miracle : il faut dormir quand bébé dort. C’est bête à dire mais tellement vrai. Bon courage pour trouver votre rythme.',	'2022-08-05',	1),
(15,	5,	10,	'Je vous conseille de manger en petite quantité. Même si vous pensez avoir assez faim pour manger une grosse assiette, évitez. Ne mangez pas trop épicé ou sucré non plus.',	'2022-08-05',	1),
(16,	5,	20,	'Perso, je ne me couchais jamais juste après avoir mangé, que ce soit pour la sieste ou pour la nuit. J’attendais un bon deux heures pour bien digérer.',	'2022-08-05',	1),
(17,	10,	20,	'ma fille a commencé les petits pots à 5 mois mais elle ne mangeait qu’une cuillère au début. Je pense qu’elle a eu besoin de s’adapter.',	'2022-08-05',	1),
(18,	7,	7,	'j’ai lu un article plutôt bien expliqué sur le sujet : https://www.leaetleo.com/cauchemar-terreur-nocturne/',	'2022-08-05',	1),
(19,	9,	20,	'Il faut faire attention aux bactéries !!! Pas avant 3 ans.',	'2022-08-05',	1),
(20,	10,	7,	'j’ai varié entre les fruits et les légumes mixés. Le premier weekend, j’ai fait le samedi midi et le dimanche midi des carottes (c’est le légume le plus sucré donc les bébés aiment) j’ai complété avec le biberon de lait habituel. Le weekend suivant j’ai donné un biberon puis de la pomme mixé aussi le samedi midi et le dimanche midi. J’ai lu qu’il fallait éviter de donner des nouveaux aliments le soir au cas où l’enfant serait allergique.',	'2022-08-05',	1),
(21,	11,	20,	'Ma fille ne se passe plus de sa tortue : https://www.aubert.com/p/35210968-1/veilleuse-tranquil-turtle-rose-cloud-b',	'2022-08-05',	1),
(22,	8,	21,	'La diversification alimentaire, c’est entre 4 et 6 mois mais ça dépend de l’enfant. Il ne faut pas forcer surtout ! J’ai commencé avec des petits pots de légumes pour ma fille.',	'2022-08-05',	1),
(23,	4,	21,	'L\'huile de soin préventive bi-oil est très efficace et en plus elle est agréable. Ma peau\r\ntirait moins et elle était toute douce.',	'2022-08-05',	1),
(26,	8,	23,	'Vois avec ta pédiatre, elle te donnera les bons conseils en fonction de ton enfant.',	'2022-08-05',	1),
(27,	12,	23,	'Pareil : je donne comme je peux des substituts : du fromage et des yaourts. c’est pas évident quand ils ne veulent plus leur biberon.',	'2022-08-05',	1),
(28,	10,	24,	'Cela varie entre chaque bébé mais généralement, on commence à donner des légumes mixés vers 4-5 mois (attention, surtout pas de morceau).',	'2022-08-05',	1),
(31,	4,	6,	'Je donne un 8/10 pour le baume onctueux Beautanicae : je n’ai toujours pas de vergetures pour le moment (7mois et demi de grossesse)',	'2022-08-09',	1),
(32,	11,	6,	'Ma fille ne se passe plus de sa tortue : https://www.aubert.com/p/35210968-1/veilleuse-tranquil-turtle-rose-cloud-b',	'2022-08-09',	1),
(33,	14,	6,	'Je vous recommande ce site : https://www.securange.fr/meilleurs-sieges-auto Il est officiel et très complet.',	'2022-08-09',	1),
(34,	15,	10,	'Des seaux, râteaux, arrosoirs… y’a plein de choix possibles.',	'2022-08-09',	1),
(35,	15,	10,	'Je vous recommande la radio Pomme d’Api : https://www.radiopommedapi.com/ Elle propose des histoires, des chansons pour les enfants à partir de 3 ans.',	'2022-08-09',	1),
(36,	17,	28,	'moi, je prépare des questions de cultures générales ou des devinettes : mes enfants adorent.',	'2022-08-09',	1),
(37,	11,	28,	'Moi j’ai une veilleuse ourson en silicone qui est souple et facile à manipuler pour ma fille de 3 ans. En plus, il y a plein de couleurs possibile : https://www.natureetdecouvertes.com/puericulture/chambre-bebe-enfant/veilleuses/veilleuse-big-ours-blanc-91774880',	'2022-08-09',	1),
(38,	4,	20,	'Pour en rajouter une, j’ai utilisé l’huile sèche corps et cheveux oil Lala (https://www.bulledemaman.fr/produit/huile-seche-corps-et-cheveux-oil-lala) elle sent bon et elle est efficace.',	'2022-08-09',	1),
(39,	16,	20,	'Nous, on a notre petit rituel. Mon fils a 2 ans et tous les soirs on change la couche, on lit une histoire sur un petit fauteuil dans sa chambre, on se fait un bisou et un petit calin et hop, je le pose dans son lit et il s’endort tout seul.',	'2022-08-09',	1),
(40,	15,	8,	'Pour votre fille de 5 ans, des raquettes de plage, c’est top pour la dextérité.',	'2022-08-09',	1),
(41,	17,	8,	'Y’a toujours le fameux jeu de compter les voitures rouges pour un enfant et bleu pour un autre',	'2022-08-09',	1),
(42,	19,	8,	'J’ai acheté à Décathlon la bouée Nabaiji pour les bébés de 7 à 15 kg. Elle est très pratique et sécurisée je trouve.',	'2022-08-09',	1),
(43,	16,	9,	'j’utilise un projecteur musical d’étoiles pour endormir ma fille : https://www.aubert.com/p/16181681-181/projecteur-musical-d-etoiles-dans-les-bois-pabobo',	'2022-08-09',	1),
(44,	15,	9,	'Moi, j’emportais toujours une petite brouette pour que mes enfants puissent ramasser les coquillages !',	'2022-08-09',	1),
(47,	18,	29,	'La crème Bepanthen Pommade est parfaite pour les premiers signes d\'érythème fessier de bébé.',	'2022-08-09',	0),
(48,	18,	30,	'Moi j’utilise la crème Weleda Calendula crème de change Bio',	'2022-08-09',	0),
(49,	14,	30,	'Moi je préfère mettre des brassards pour laisser nager bébé. S’ils sont dans une bouée, ils ne peuvent pas faire des mouvements.',	'2022-08-09',	0),
(50,	15,	29,	'Mes enfants aiment bien jouer dans une tente de plage. Et en plus, ça les protège du soleil.',	'2022-08-09',	0),
(51,	15,	30,	'S’il y a un peu de vent, je vous conseille un cerf-volant. Les enfants adorent ça. ça les occupe bien et ils sont fatigués à la fin de la journée (bon, vous serez aussi fatigué de courir avec eux hihi',	'2022-08-09',	1),
(52,	18,	31,	'Rien de tel que le bon vieux talque : recette de grand-mère qui fonctionne toujours de nos jours et qui coûte moins cher que toutes les crèmes que l’on voit.',	'2022-08-09',	0),
(53,	18,	32,	'Pommade change Eryteal 3 en 1 de Klorane : https://www.klorane.com/fr-fr/p/pommade-change-eryteal-3-en-1',	'2022-08-09',	1),
(54,	19,	31,	'J’ai trouvé une bouée avec un “parasol” pour protéger mon fils. Je vous donne le lien : https://www.boueelicorne.com/products/bouee-bateau-bebe-avec-parasol',	'2022-08-09',	0);

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `category`;
INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(1,	'Grossesse',	'grossesse'),
(2,	'Sécurité',	'securite'),
(3,	'Nutrition',	'nutrition'),
(4,	'Santé et soins',	'sante-et-soins'),
(5,	'Loisir',	'loisir'),
(6,	'Sommeil',	'sommeil');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

TRUNCATE `doctrine_migration_versions`;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220803184642',	'2022-08-05 11:22:21',	387),
('DoctrineMigrations\\Version20220803190256',	'2022-08-05 11:22:21',	4);

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `messenger_messages`;

DROP TABLE IF EXISTS `practice`;
CREATE TABLE `practice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7FEC344E12469DE2` (`category_id`),
  KEY `IDX_7FEC344EA76ED395` (`user_id`),
  CONSTRAINT `FK_7FEC344E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_7FEC344EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `practice`;
INSERT INTO `practice` (`id`, `category_id`, `user_id`, `title`, `content`, `created_at`, `updated_at`, `status`, `slug`, `picture`) VALUES
(2,	6,	3,	'Le cododo: Pourquoi? Comment?',	'L\'arrivée d’un enfant est aussi synonyme de nuits raccourcies. Entre les multiples réveils et l’inquiétude des parents sur la santé du bébé durant la nuit, il existe une pratique qui tend à se répandre: le co-dodo.\r\nLe co-dodo, comme son nom évocateur l\'indique, désigne le fait de dormir avec l’enfant. Ainsi celà rassure à la fois les parents et l’enfant.\r\nLes bienfaits du co-dodo sont multiples, la proximité de l’enfant avec les parents lors des nuits crée des liens privilégiés avec les parents et évite par la même occasion le réveil de l’ensemble du foyer. En cas d\'allaitement de l’enfant, cette technique s’avère alors fort utile et moins éprouvante du fait de cette proximité.\r\nConsidéré par ses détracteurs comme un facteur à risque de cas de mort subite du nourrisson, il n’en est pas moins bénéfique pour sa prévention. La présence d’un adulte à côté de celui-ci permet de rassurer l’enfant et d’être à l\'affût des moindres anomalies.\r\nEn pratique? L’enfant peut dormir entre ses parents, il conviendra toutefois de prendre des dispositions nécessaires:\r\n- éviter la profusion de coussins\r\n- avoir une pièce à bonne température (à peu près 19°)\r\n- sécuriser les bords de lits\r\nD’autre part, des solutions de cododo sont aussi commercialisées et peuvent être une bonne alternative.\r\nLe cododo oui, mais jusqu\'à quand?\r\nLa question fait débat mais sachez que le co-dodo peut se pratiquer jusqu’aux 3 ans de l’enfant. Ce sera donc à vous de décider quand stopper cette pratique.',	'2022-08-05',	NULL,	1,	'le-cododo-pourquoi-comment',	'foot-1400.png'),
(3,	1,	6,	'Les valises pour la maternité : maman, bébé et papa',	'Il est conseillé de bien préparer ses valises de maternité dès la fin du troisième trimestre au cas où bébé voudrait venir avant l’heure. Placez-les dans l’entrée pour pouvoir les prendre facilement en cas de départ précipité.\r\n \r\nPour maman : la valise pour la salle d’accouchement :\r\n- Documents importants : carte d’identité, carnet de santé, justificatifs d’assurance, projet de naissance si vous en avez un\r\n- Peignoir : pour se sentir plus à l’aise pendant le séjour à la maternité (et se tenir chaud)\r\n- Chaussons ou tongs\r\n- Chaussettes : pratiques si vous avez froid lors de l’accouchement (oui, oui, ça arrive)\r\n- Brumisateur : à l’inverse, s’il fait chaud, le brumisateur sera votre ami\r\n- Coussin : si vous souhaitez être sur d’être bien à l’aise avec votre propre coussin, n’hésitez pas à emporter le votre\r\n- De quoi vous occuper : l’attente pourra être longue entre la rentrée en salle d’accouchement et l’accouchement en lui-même, il va falloir vous occuper. Un livre, un magazine, de la musique, etc. Prenez ce qu’il vous plaît (pensez à votre chargeur de téléphone)\r\n \r\nPour papa : la valise indispensable :\r\n- De la monnaie : s’il y a un distributeur à disposition\r\n- En-cas et boissons : s’il n’y a pas de distributeur à disposition hihi\r\n- Téléphone, appareil photo, caméscope… et leurs chargeurs\r\n- Vêtements de rechange : on ne sait pas combien de temps va durer le travail, donc penser à prendre un pull s’il faut froid ou un autre tee-shirt s’il faut chaud\r\n- De quoi vous occuper comme maman\r\n \r\nPour bébé : valise pour la salle d’accouchement :\r\n- Bonnet et chaussettes : tous les nouveaux nés ont besoin d’être couverts, même en plein été\r\n- bodies : prenez 1 body de tailles naissance, 1 body de taille 1 mois et pourquoi pas même 1 body de taille 3 mois car vous ne savez pas forcément à l’avance quelle taille ira à votre bébé\r\n \r\nPour maman : la valise après l’accouchement :\r\n- Serviettes hygiéniques très absorbantes : les hôpitaux peuvent en fournir mais pas tous, alors, pensez-y !\r\n- Pyjamas : ne prenez que des vêtements qui ne vous serrent pas le ventre\r\n- Sous-vêtements : idem, prenez des dessous confortables qui ne vous serrent pas pour bien être à l’aise\r\n- Soutien-gorge d’allaitement : si cela vous est nécessaire\r\n- Vêtements : pensez aux vêtements amples, aux pulls ou gilets en hiver et aux robes légères en été\r\n- Produits de toilette : les incontournables brosse à dents, dentifrice, savon, shampoing, brosse à cheveux, chouchou ou pince, mouchoirs, déodorant, crème hydratante, etc. Pensez également à un sac pour votre linge sale\r\n- Coussin d’allaitement : si cela vous est nécessaire\r\n- De quoi vous occuper : même si bébé vous prendra tout votre temps, pensez à prendre de quoi vous évader un peu (livre, magazine, etc.)\r\n- De quoi grignoter : la maternité ne prévoit pas le goûter alors pensez à emmener votre barre chocolatée !\r\n \r\n \r\nPour bébé : la valise de ses premiers jours :\r\n- Bodies et pyjamas : comme pour la valise des premières heures de bébé, prenez des bodies et des pyjamas de plusieurs tailles\r\n- Chaussettes\r\n- Tétines\r\n- Couches : si vous souhaitez une marque bien spécifique pour votre bébé\r\n- Bavoirs\r\n- Tenu pour le retour : un gilet pour le trajet\r\n \r\nA ne pas oublier :\r\n- Installer le siège auto pour le retour à la maison\r\n- Si vous n’allaitez pas, pensez à avoir du lait de naissance et des biberons au retour de la maternité car cela nous vous est pas fourni',	'2022-08-05',	NULL,	1,	'les-valises-pour-la-maternite-maman-bebe-et-papa',	'baby4.png'),
(4,	4,	5,	'Le réflexe de Moro',	'Le réflexe de Moro est un réflexe archaïque de défense du nourrisson, qui survient en réponse à des stimuli sensoriels intenses, comme un flash lumineux, un changement de position soudain, un son... Cette réaction peut paraître impressionnante, le bébé ouvre grand les bras et les jambes de manière symétrique puis les referme comme s’il voulait étreindre quelque chose. Il s’agit d’une réaction tout à fait naturelle, qui finit par s’intégrer et disparaître vers l’âge de 3 mois pour laisser place au réflexe de sursaut, que nous connaissons tous. \r\nC’est un réflexe qui indique la bonne santé du nourrisson et qui témoigne de l’absence de problèmes neurologiques quand les mouvements sont symétriques. Pourtant, chez certains bébés, ce réflexe peut être intense et perturber son sommeil. Le parent doit alors rassurer son enfant, le blottir contre lui pour lui donner un sentiment de sécurité. L’emmaillotage, agissant comme un cocon, peut aussi être une solution occasionnelle pour lui donner un sentiment de sécurité. \r\nCe réflexe ne disparaît pas du jour au lendemain et peut persister jusqu’à l’âge de 6 mois, tout en diminuant progressivement en intensité et en fréquence. s’il persiste tout de même, il peut être le signe d’une problématique neurologique et doit être surveillé. Si le réflexe peine à disparaître, il peut être à l’origine de problèmes posturaux, comportementaux ou troubles de l’apprentissage. Il peut également être la cause d’une forme d’hypersensibilité puisque le corps est en état de vigilance permanent : cela peut être une source de fatigue pour l’enfant.',	'2022-08-05',	NULL,	1,	'le-reflexe-de-moro',	'baby11.png'),
(5,	2,	7,	'La sécurité affective : laisser bébé pleurer ?',	'Une croyance populaire consiste en l’idée de laisser pleurer le bébé afin de ne pas le rendre capricieux. Cette idée est encore malheureusement trop largement répandue et peut avoir des conséquences dramatiques pour l’enfant. Afin d’avoir une conscience claire des impacts de nos actes affectifs auprès de nos enfants, il convient de rappeler que toute la vie d’un individu est bâtie sur les bases de l\'attachement affectif. L’attitude relationnelle des parents au cours des premiers mois de l’enfant est donc cruciale pour le bon développement de ce dernier. \r\nL’attachement est un élan vers l’Autre, et un retour de l’Autre à cet acte. La présence et l\'intensité de ce retour nous attache à l’Autre, en accentuant cet enthousiasme, ou bien le freine. Il s’agit d’un élan, mais aussi d’une forme de tricotage inconscient de la relation qui se produit au quotidien, par des actes, des mots, des attentions. Il ne devient conscient que lorsqu’il vient à manquer, contrairement à d’autres sentiments, et c’est tout ce qui en fait sa particularité. \r\nS’il n’y a pas d’Autre, il ne peut exister de lien d’attachement, cela conduit à une forme de mort psychique. En revanche, si des relations saines sont établies, un sentiment de confort naît, qui invite l’enfant à sortir de lui-même, à explorer le monde. L’enjeu des relations tissées au cours des premiers mois est donc primordial ! L’enfant ne pourra découvrir le monde, parler, avoir du plaisir à apprendre à l’école, que s’il dispose de cet ancrage, de cet attachement sécure auprès d’une figure d’attachement. \r\nRevenons-en aux pleurs de l’enfant. Il a été constaté que lors du premier trimestre de vie des nourrissons, la réponse du parent aux pleurs impactera la façon dont leur enfant développera cet attachement sécure, ou non. Lorsque l’enfant est secouru par la figure d’attachement, il développe progressivement en lui une mémoire de ce soutien, une image de cette personne s’imprègne dans sa mémoire et il gardera en lui cette marque d’une relation protectrice. Même lorsque le parent n’est pas présent physiquement, il persiste en lui cette représentation, un sentiment biologique de sécurité. \r\nPour les enfants que l’on a laissé pleurer, cette acquisition n’a pas lieu, et l’absence physique de la personne signifie son absence absolue, pour l’enfant. L’angoisse est donc dominante lorsqu’il est seul.',	'2022-08-05',	NULL,	1,	'la-securite-affective-laisser-bebe-pleurer',	'baby6.png'),
(6,	3,	9,	'La diversification alimentaire',	'L’établissement de la diversification du régime alimentaire du nourrisson est un sujet pouvant apparaître complexe et sensible pour certains parents. Il s’agit d’une étape transitoire particulièrement importante pour le nourrisson, consistant en l’introduction progressive d’aliments autres que le lait. Elle aura des répercussions sur la manière dont l’enfant s’alimentera dans le futur, il est donc important de prendre conscience des enjeux et des bonnes pratiques qui entourent ce sujet. Il est recommandé d’initier cette démarche à l’âge de 4 à 6 mois. Tous les groupes d’aliments peuvent être introduits, y compris ceux ayant une réputation d’allergène. A l’âge de 6 mois, il est possible de proposer des aliments aux textures nouvelles et il n’est pas rare de devoir avancer le même aliment une dizaine de fois au nourrisson avant que celui-ci ne le trouve à son goût, ne perdez donc pas patience, il est fort probable qu’il finisse par s’y habituer.\r\nContrairement aux idées reçues, les matières grasses ne sont pas à proscrire, bien au contraire. Il est conseillé de rajouter de l’huile d’olive, du beurre ou de la margarine dans les aliments ne contenant pas de matière grasse. En revanche, l’introduction du sucre est à retarder et à limiter, les quantités doivent être raisonnées, préférez donc les aliments sucrés fait-maison afin de conserver un contrôle sur leur composition. \r\nEnfin, restez attentifs aux signes de satiété de votre enfant, celui-ci sait quand il n’a plus faim, ne le forcez pas à manger. Éloignez-le cependant les écrans qui pourraient le distraire des aliments.',	'2022-08-05',	NULL,	1,	'la-diversification-alimentaire',	'boygirl-1400.png');

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date NOT NULL,
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E12469DE2` (`category_id`),
  KEY `IDX_B6F7494EA76ED395` (`user_id`),
  CONSTRAINT `FK_B6F7494E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_B6F7494EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `question`;
INSERT INTO `question` (`id`, `category_id`, `user_id`, `content`, `created_at`, `status`) VALUES
(2,	1,	4,	'Je suis enceinte de 4mois et je dors mal la nuit, des conseils ?',	'2022-08-05',	1),
(3,	1,	9,	'Comment on sait quand on doit aller à la maternité ?',	'2022-08-05',	1),
(4,	1,	7,	'J’ai besoin de conseils sur les vergetures : vous avez utilisé des crèmes ? Si oui, lesquelles ? Merci d’avance',	'2022-08-05',	1),
(5,	1,	12,	'Ça fait 1mois que je suis enceinte et les nausées n’arrêtent pas !!!!! Des conseils ? Ça va durer longtemps ?',	'2022-08-05',	1),
(6,	3,	13,	'J’allaite mon bébé mais je suis fatiguée. Comment faire pour que mon mari m’aide un peu ?',	'2022-08-05',	1),
(7,	6,	17,	'Comment on différencie une terreur nocturne d’un cauchemar ?',	'2022-08-05',	1),
(8,	3,	10,	'Quand je peux donner des petits pots à mon bébé ?',	'2022-08-05',	1),
(9,	3,	15,	'A quel âge je peux donner de la viande crue ?',	'2022-08-05',	1),
(10,	3,	20,	'On passe quand à la diversification alimentaire ?',	'2022-08-05',	1),
(11,	6,	7,	'Quelle veilleuse vous avez pour la chambre de bébé ?',	'2022-08-05',	1),
(12,	3,	12,	'Ma fille de 2ans ne veut plus de son lait, vous faites comment vous ?',	'2022-08-05',	1),
(13,	4,	21,	'Je n’ose pas toucher au cardon ombilical : il tombe tout seul ?',	'2022-08-05',	1),
(14,	2,	21,	'Quel siège auto choisir ? Vous avez une idée ? Merci d’avance',	'2022-08-05',	1),
(15,	5,	23,	'vous emmenez quoi comme jouets à la plage ? J’ai une fille de 5 ans et un fils de 3 ans',	'2022-08-05',	1),
(16,	6,	24,	'Vous utilisez de la musique pour endormir votre bébé ?',	'2022-08-05',	1),
(17,	5,	24,	'Comment vous occupez vos enfants en voiture ? Help !  (2 garçons de 6 et 9 ans)',	'2022-08-05',	1),
(18,	4,	26,	'Les fesses de mon fils sont toutes rouge !!! Vous avez une crème miracle ?',	'2022-08-05',	1),
(19,	2,	26,	'Vous avez un conseil pour des bouées pour un bébé de 1 an ?',	'2022-08-05',	1),
(20,	4,	20,	'Comment on nettoie les oreilles d’un bébé ?',	'2022-08-09',	1);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `slug` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D64986CC499D` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `user`;
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `status`, `slug`, `genre`) VALUES
(1,	'admin@admin.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$D1OpuSSUsGu1EEZdc6K7juPDc4pdQ/1CIb2/15.Wlv6KUzjakovzS',	'admin',	1,	'admin',	'homme'),
(2,	'obaby@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$SQCAsxHo2Pwk9vAnSpMIxuCQvBrAE.ekHEYE5eKL/ChksQASPJ1cS',	'Anonymous',	1,	'anonymous',	'femme'),
(3,	'jeet@live.fr',	'[\"ROLE_USER\"]',	'$2y$13$mOipkn44ir3qaDpAO9a9heRki6mnPaKPr/pnmaJ2jSaASAyqKvG4m',	'Mathieu',	1,	'mathieu',	'homme'),
(4,	'virginie@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$/IO3HNZvKgHZ.NedAjPNCeqqP0EOmcadPZPGbXiKvnrZXjic2qoyK',	'Vivi',	1,	'vivi',	'femme'),
(5,	'machut.lucas@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$TnVKXLHHF418TJOe/v7wG.QZj/Az8h7rPt8mi6EDpacQ5C/scgdV.',	'Lucas',	1,	'lucas',	'homme'),
(6,	'clementine@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$Sohc2rmVR4x9nexbMepTIuEErgbclqzg1PhFvq1wDwUKli13TvHLy',	'Clémentine',	1,	'clementine',	'femme'),
(7,	'marion@gmailcom',	'[\"ROLE_USER\"]',	'$2y$13$tup0GSbsAgiThBHvQgqTRe9fSsBoWpj0KhW1nVMU2A9cXsZ8uzi66',	'Marion',	1,	'gerard',	'homme'),
(8,	'cricri@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$9JGp74v5oL7.knueAeeHeuygQ3WCfG3Ei/O20xVt95GGW2qbNfC6i',	'Cricri d\'amour',	1,	'cricri-d-amour',	'homme'),
(9,	'git@git.com',	'[\"ROLE_USER\"]',	'$2y$13$F6h5yIBmUf0Be/LP0/MsVOvAM2mwdD.8Q/SygFSLm2Kx6E.uqrneu',	'Stéphane',	1,	'git',	'femme'),
(10,	'isaline@isaline.com',	'[\"ROLE_USER\"]',	'$2y$13$JJEvBf6ZmhBWKgnMkiKeN.X5lauyXHCfmXRgN/nnFjQDxprWhiUw.',	'Isaline',	1,	'isaline',	'femme'),
(11,	'claire@claire.com',	'[\"ROLE_USER\"]',	'$2y$13$SYhLoFnSRdJ3yl604R1l5Oshkbs5fUHqkZWl5QvUNJ.2VZrDyB2HC',	'Claire',	1,	'claire',	'femme'),
(12,	'solene@solene.com',	'[\"ROLE_USER\"]',	'$2y$13$.AALT8IAGISftOjq.6AcLOeMQtU.oTk0wWl24Khm/Icphaqhcs5ja',	'Solène',	1,	'solene',	'femme'),
(13,	'clara@clara.com',	'[\"ROLE_USER\"]',	'$2y$13$g9y2t/rcCyzPqtBO6eofY.81K1n1pflgsw7yIlZBdK606zHiyVj4i',	'Clara',	1,	'clara',	'femme'),
(14,	'symfonia@symfonia.com',	'[\"ROLE_USER\"]',	'$2y$13$yOd31RIV8NLob4TJHvBu7.Qdar03DlyviB0X0WAid7fz2GObbEv7e',	'Symfonia',	1,	'symfonia',	'femme'),
(15,	'natalène@natalène.com',	'[\"ROLE_USER\"]',	'$2y$13$efaOGUS0NFGpSeQ47Makxeams50r8hxxvLI5wTqpKqnwtyjGitn9C',	'Natalène',	1,	'dumbledore',	'homme'),
(16,	'aurelie@aurelie.com',	'[\"ROLE_USER\"]',	'$2y$13$b5eLDHxhUdQTUFPNp4V7UOBJx7gZPEofy6B09K7CRYoEd8cIg8vmC',	'Aurélie',	1,	'aurelie',	'femme'),
(17,	'laura@laura.com',	'[\"ROLE_USER\"]',	'$2y$13$bmbDha.5DeaNdxGukTbDq.T8OxY2LsP5Cgx/8II8uORXkza3WET0a',	'Laura',	1,	'laura',	'femme'),
(18,	'camille@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$qHAMSrU.Ftpo0FGFP2MWB.atO939FycqCinAIysD/LGNwu5A3t9Di',	'Camille',	1,	'liliane',	'femme'),
(20,	'chloe@chloe.com',	'[\"ROLE_USER\"]',	'$2y$13$R2M3XsVlm9dgWxf9Bp754uEQDRmZdsuSIhxrhWAO1g.i8VVtH7jl6',	'Chloé',	1,	'chloe',	'femme'),
(21,	'vanessa@vanessa.com',	'[\"ROLE_USER\"]',	'$2y$13$c7Cl0.rcdZ56LPyfLYdoCetohre.mOSVok1u6ij93pPr/TIRY1tA6',	'Vanessa',	1,	'vanessa',	'femme'),
(23,	'virginie@virginie.com',	'[\"ROLE_USER\"]',	'$2y$13$brRkDgYUbKhPMqnIgT0dRemF5.EO/UYGPoRigcMQL9Hl45dQ.Xytu',	'Virginie',	1,	'virginie',	'femme'),
(24,	'antoine@antoine.com',	'[\"ROLE_USER\"]',	'$2y$13$VCEUymJXuLUNAdORA1WoKesBd0MWBxLg/sZLjpAJE8Z4DlNyAEcWa',	'Antoine',	1,	'antoine',	'homme'),
(26,	'yoann@yoann.com',	'[\"ROLE_USER\"]',	'$2y$13$V8PmS8ujLJvTUei6dqcks.QeqntxWR7fNKTd.vIAzPl20GquO.yY.',	'Yoann',	1,	'stephan',	'homme'),
(28,	'adrien@adrien.com',	'[\"ROLE_USER\"]',	'$2y$13$ncLIaVXyhxGtZRQQv6dYpuVYaMfKDbOa3osg6BaG3tlFVjgSNcbvS',	'Adrien',	1,	'adrien',	'homme'),
(29,	'aleth@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$RKRd/p2ygYZZon1grkRSxOjS5hs/yelUjrvKmXtKIXqREtcnwS9GC',	'Aleth',	1,	'aleth',	'femme'),
(30,	'loic@loic.com',	'[\"ROLE_USER\"]',	'$2y$13$CmF25cu13qrKxuRFOPCFnOlrE8ljqA0N2oJtbKIDXdL6V/YoVg.4.',	'Loïc',	1,	'loic',	'homme'),
(31,	'magali@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$VWtGDP.rdVzcV47aXez7IezRUxKUTic6yPZ48e4XRp.aUcGqcOI3S',	'Magali',	1,	'magali',	'femme'),
(32,	'guillaume@guillaume.com',	'[\"ROLE_USER\"]',	'$2y$13$tx1/NKmHkTAMW7TE8XXXEe7TH9krgR2jV5wlK9SU4x05/66agLgnO',	'Guillaume',	1,	'guillaume',	'homme');

-- 2022-08-09 09:25:52