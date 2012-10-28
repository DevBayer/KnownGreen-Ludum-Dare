-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-10-2012 a las 15:16:25
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `knowngreen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abuses`
--

CREATE TABLE IF NOT EXISTS `abuses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `STRAIN` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `LVL` int(11) NOT NULL,
  PRIMARY KEY (`iso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`iso`, `name`, `LVL`) VALUES
('AE', 'United Arab Emirates', 0),
('AF', 'Afghanistan', 0),
('AL', 'Albania', 0),
('AM', 'Armenia', 0),
('AO', 'Angola', 0),
('AR', 'Argentina', 0),
('AT', 'Austria', 0),
('AU', 'Australia', 0),
('AZ', 'Azerbaijan', 0),
('BA', 'Bosnia and Herzegovina', 0),
('BD', 'Bangladesh', 0),
('BE', 'Belgium', 0),
('BF', 'Burkina Faso', 0),
('BG', 'Bulgaria', 0),
('BI', 'Burundi', 0),
('BJ', 'Benin', 0),
('BN', 'Brunei', 0),
('BO', 'Bolivia', 0),
('BR', 'Brazil', 0),
('BS', 'The Bahamas', 0),
('BT', 'Bhutan', 0),
('BW', 'Botswana', 0),
('BY', 'Belarus', 0),
('BZ', 'Belize', 0),
('CA', 'Canada', 0),
('CD', 'Democratic Republic of the Congo', 0),
('CF', 'Central African Republic', 0),
('CG', 'Republic of the Congo', 0),
('CH', 'Switzerland', 0),
('CI', 'Ivory Coast', 0),
('CL', 'Chile', 0),
('CM', 'Cameroon', 0),
('CN', 'China', 0),
('CO', 'Colombia', 0),
('CR', 'Costa Rica', 0),
('CU', 'Cuba', 0),
('CY', 'Cyprus', 0),
('CZ', 'Czech Republic', 0),
('DE', 'Germany', 0),
('DJ', 'Djibouti', 0),
('DK', 'Denmark', 0),
('DO', 'Dominican Republic', 0),
('DZ', 'Algeria', 0),
('EC', 'Ecuador', 0),
('EE', 'Estonia', 0),
('EG', 'Egypt', 0),
('ER', 'Eritrea', 0),
('ES', 'Spain', 1),
('ET', 'Ethiopia', 0),
('FI', 'Finland', 0),
('FJ', 'Fiji', 0),
('FK', 'Falkland Islands', 0),
('FR', 'France', 0),
('GA', 'Gabon', 0),
('GB', 'United Kingdom', 0),
('GE', 'Georgia', 0),
('GH', 'Ghana', 0),
('GL', 'Greenland', 0),
('GM', 'Gambia', 0),
('GN', 'Guinea', 0),
('GQ', 'Equatorial Guinea', 0),
('GR', 'Greece', 0),
('GT', 'Guatemala', 0),
('GW', 'Guinea Bissau', 0),
('GY', 'Guyana', 0),
('HN', 'Honduras', 0),
('HR', 'Croatia', 0),
('HT', 'Haiti', 0),
('HU', 'Hungary', 0),
('ID', 'Indonesia', 0),
('IE', 'Ireland', 0),
('IL', 'Israel', 0),
('IN', 'India', 0),
('IQ', 'Iraq', 0),
('IR', 'Iran', 0),
('IS', 'Iceland', 0),
('IT', 'Italy', 0),
('JM', 'Jamaica', 0),
('JO', 'Jordan', 0),
('JP', 'Japan', 0),
('KE', 'Kenya', 0),
('KG', 'Kyrgyzstan', 0),
('KH', 'Cambodia', 0),
('KP', 'North Korea', 0),
('KR', 'South Korea', 0),
('KW', 'Kuwait', 0),
('KZ', 'Kazakhstan', 0),
('LA', 'Laos', 0),
('LB', 'Lebanon', 0),
('LK', 'Sri Lanka', 0),
('LR', 'Liberia', 0),
('LS', 'Lesotho', 0),
('LT', 'Lithuania', 0),
('LU', 'Luxembourg', 0),
('LV', 'Latvia', 0),
('LY', 'Libya', 0),
('MA', 'Morocco', 0),
('MD', 'Moldova', 0),
('ME', 'Montenegro', 0),
('MG', 'Madagascar', 0),
('MK', 'Macedonia', 0),
('ML', 'Mali', 0),
('MM', 'Myanmar', 0),
('MN', 'Mongolia', 0),
('MR', 'Mauritania', 0),
('MW', 'Malawi', 0),
('MX', 'Mexico', 0),
('MY', 'Malaysia', 0),
('MZ', 'Mozambique', 0),
('NA', 'Namibia', 0),
('NC', 'New Caledonia', 0),
('NE', 'Niger', 0),
('NG', 'Nigeria', 0),
('NI', 'Nicaragua', 0),
('NL', 'Netherlands', 0),
('NO', 'Norway', 0),
('NP', 'Nepal', 0),
('NZ', 'New Zealand', 0),
('OM', 'Oman', 0),
('PA', 'Panama', 0),
('PE', 'Peru', 0),
('PG', 'Papua New Guinea', 0),
('PH', 'Philippines', 0),
('PK', 'Pakistan', 0),
('PL', 'Poland', 0),
('PR', 'Puerto Rico', 0),
('PS', 'West Bank', 0),
('PT', 'Portugal', 0),
('PY', 'Paraguay', 0),
('QA', 'Qatar', 0),
('RO', 'Romania', 0),
('RS', 'Republic of Serbia', 0),
('RU', 'Russia', 0),
('RW', 'Rwanda', 0),
('SA', 'Saudi Arabia', 0),
('SB', 'Solomon Islands', 0),
('SD', 'Sudan', 0),
('SE', 'Sweden', 0),
('SI', 'Slovenia', 0),
('SK', 'Slovakia', 0),
('SL', 'Sierra Leone', 0),
('SN', 'Senegal', 0),
('SO', 'Somalia', 0),
('SR', 'Suriname', 0),
('SS', 'South Sudan', 0),
('SV', 'El Salvador', 0),
('SY', 'Syria', 0),
('SZ', 'Swaziland', 0),
('TD', 'Chad', 0),
('TF', 'French Southern and Antarctic Lands', 0),
('TG', 'Togo', 0),
('TH', 'Thailand', 0),
('TJ', 'Tajikistan', 0),
('TL', 'East Timor', 0),
('TM', 'Turkmenistan', 0),
('TN', 'Tunisia', 0),
('TR', 'Turkey', 0),
('TT', 'Trinidad and Tobago', 0),
('TW', 'Taiwan', 0),
('TZ', 'Tanzania', 0),
('UA', 'Ukraine', 0),
('UG', 'Uganda', 0),
('US', 'United States of America', 0),
('UY', 'Uruguay', 0),
('UZ', 'Uzbekistan', 0),
('VE', 'Venezuela', 0),
('VN', 'Vietnam', 0),
('VU', 'Vanuatu', 0),
('YE', 'Yemen', 0),
('ZA', 'South Africa', 0),
('ZM', 'Zambia', 0),
('ZW', 'Zimbabwe', 0),
('_0', 'Northern Cyprus', 0),
('_1', 'Kosovo', 0),
('_2', 'Western Sahara', 0),
('_3', 'Somaliland', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reg`
--

CREATE TABLE IF NOT EXISTS `reg` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Country` varchar(80) NOT NULL,
  `Type` int(11) NOT NULL,
  `Calification` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `IP` varchar(80) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `reg`
--

INSERT INTO `reg` (`ID`, `Country`, `Type`, `Calification`, `Date`, `IP`) VALUES
(1, 'Spain', 20, 10, '2012-10-27 21:35:29', '192.168.0.105');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `strain`
--

CREATE TABLE IF NOT EXISTS `strain` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `strain`
--

INSERT INTO `strain` (`ID`, `Name`, `Description`) VALUES
(1, 'A-Train', 'The A-train is a hybrid between Afghani Mazar I Sharif and the clone-only Arcata e-32 Trainwreck. Trainwreck is an infamous plant. It looks like a train wrecked in your room—all the plants falling ove...'),
(2, 'A.M.S.', '<b>Strong</b> high, with a clearside and a more introspective one. Very particular taste, sweet and complex....'),
(3, 'A1 Haze', 'Mandetory marijuanna for everyones personal stash. This haze is a delightful rendition of how a superior haze should perform. Elongated with 4-5 spears is typical of her growth pattern....'),
(4, 'Acapulco Gold', 'Thanks to recent advances in marijuana genetics Barney''s Farm has pioneered, the quality of their Acapulco Gold goes beyond the often rhapsodized smoke of days past. Just as importantly for them, howe...'),
(5, 'Acid', 'Acid is Paradise Seeds'' very own version of the world famous strain known as Diesel...'),
(6, 'Afghan Haze', 'The combination of a pure Afghan combined to the Haze male can only create something fantastic....'),
(7, 'Afghani', 'Afghanistan is well known for its high quality hashish, but it is also the homeland to some of the world’s more potent types of Cannabis from the original “Afganica” gene pool....'),
(8, 'Afghani #1', 'The plants from the fast, heavy, compact side of the cannabis family tree are named after India, and it’s true that these strains are commonly grown for charas in the mountainous north of the country....'),
(9, 'Afghanica', 'Afghani genes influence this hybrid´s appearance, flavour and stoney high, while the Skunk parent gives a big boost to vigour, yield and potency, making it the cream of the crops!...'),
(10, 'Afrodite', 'One of the most popular genetic cannabis strains among Spanish marijuana growers is Jack Herer. Especially the outdoor results are legendary....'),
(11, 'Afrodite Auto', 'Autoflowering variety that embodies the spirit of Kannabia Seed Bank: quick and reliable....'),
(12, 'Agent Orange', 'Agent Orange is a very good producer with extremely resinous large dense buds. The smell is amazing with hints of Oranges, Lemons and the smell of a Whiskey Sour cocktail....'),
(13, 'AK Passion', 'The popular AK47 strain has been adjusted to a real autoflowering type named “AK Passion”. The auto AK Passion has a lot of resemblances to the original AK47 strain....'),
(14, 'AK-47', 'This easy to grow plant is the most popular strain of Serious Seeds. It is of medium height and produces good yields quite quickly......'),
(15, 'Alaskan Ice', 'Crossing of White Widow with a Haze. The Alaskan Ice is one of the strongest cannabis plants the Green House ever bred....'),
(16, 'Alegria', 'This strain was discovered while on a trip to Spain in 2003. While there Kiwi Seeds had the pleasure to try some truely unique tasting marijuana and to their  delight were able to obtain a few seeds....'),
(17, 'Allkush', 'Allkush reveals its Kush heritage in compact appearance and stouth growth characteristics. but the one-quarter Sativa shines through in the quality of the smoking experience, the high is dynamic and l...'),
(18, 'Amazing Haze', 'Rich flavours in combination with an extremely strong high made the amazing Haze an instant success in the Homegrown Fantasy after her first release during the 2006 High Times Cannabis Cup in Amsterda...'),
(19, 'Amazonia', 'This a special hybrid of Master Widow with Green Thai, which has a sweet creamy aroma reminiscent of the original Thai sticks. Dreamy....'),
(20, 'Amnesia Haze', 'The Amnesia Haze gives off a very strong effect and exhuberant high. It''s cannabis seeds flowers indoors at 12 weeks with an indoor yield of 400 - 450 gr/m2....'),
(21, 'Amnesia Lemon', 'Barney''s Farm Skunk #1 pheno crossed with their award winning Amnesia haze was always going to be a winner. That unmistakable Amnesia flavor combined with the power and resilience of Skunk #1....'),
(22, 'Amsterdam Mist', 'Haze Mist was developed from Original Haze in order to give weight and density to the running floral clusters....'),
(23, 'Angel Heart', 'Crossing of Mango Haze x Afghan Skunk. If there was a plant close to perfect in flavor Mr. Nice would advocate this one. It will leave your mouth watering, and the body wanting more....'),
(24, 'Angel''s Breathe', 'To this day, the most silent but highest achieving plant coming out of the MNS camp since Super Silver Haze is the Mango Haze. This was made with the proven parent line that SSH came from as well as a...'),
(25, 'Angelmatic', 'Angelmatic is an autoflowering strain, this means that is able to flower after just about 3 weeks of growth, without the need to reduce the hours of light in indoor or wait for the end of the summer o...'),
(26, 'Apollo', 'Representing thousands of hours of selective breeding TGA Subcool Seeds proudly offers  their first back cross of Apollo-13....'),
(27, 'Arctic Sun', 'A marriage of old and new world genetics. Mostly Sativa with long, dense and crystal ladened buds. High yielding and extremely potent....'),
(28, 'Arjan''s Haze #1', 'Arjan''s Haze #1 won the 1st prize at the High Times Cannabis Cup 2004. It has an extremely psychoactive high, strong and long lasting. Spicy, minty sativa taste....'),
(29, 'Arjan''s Haze #2', 'An impressive crossing from Neville''s Haze, Super Silver Haze and Laos. It gives a strong, introspective high with a deep effect on the body due to the high CBD level. Very intense taste, nutty and wo...'),
(30, 'Arjan''s Haze #3', 'Medium strength variety with an euphoric high, very social and creative. One of the fruitiest and sweetest between the sativas....'),
(31, 'Arjan''s Strawberry Haze', 'Very mild body effect, strong cerebral high. Very creative and social. Voted best strain at the Green House V.I.S. Smoking Panel 2005....'),
(32, 'Arjan''s Ultra Haze #1', 'A crossing of Neville''s Haze, Cambodian and Laos. Winner of the High Times Cannabis Cup 2006....'),
(33, 'Arjan''s Ultra Haze #2', 'Great psychoactive high, strong and long lasting. Very uplifting and social, it leaves a very relaxing feeling thanks to the high CBD. Fruity and woody sativa taste....'),
(34, 'Armageddon', 'This sativa influenced strain has the body of an Indica with the typical Sativa high effects. Armageddon produces big, heavy flowers with lots of crystals and a high THC percentage....'),
(35, 'ASH', 'This was to be a limited edition seed but due to popular demand from all levels and styles of growers this hybrid is finding a regular place in the MNS Hall of fame....'),
(36, 'Atomical Haze', 'Haze plants are getting ever more popular. But in fact it is one of the oldest and classic strains, dating back to the 70’s. Today it regains popularity but for the last few decades it had not such a ...'),
(37, 'Aurora B.', 'Aurora B. is a cross between a carefully selected Northern Lights with Flying Dutchmen''s sweet Skunk father: a vigorous plant with heavy resinous buds....'),
(38, 'Auto Kaya 47', 'This is the new Autoflowering Kaya 47 strain. This strain can be harvested 70 / 80 days from seed. Auto Kaya - 47 is a medium high plant....'),
(39, 'AutoBlueberry', 'AutoBlueberry was created for different reasons. First of all to bring superior quality in the automatic......'),
(40, 'Automaria', 'A fast flowering stoney plant of Ruderalis/ Indica origin. This plant, spontaneously starts making resinous flowers even in the middle of summer or indoors, no matter how many hours of light....'),
(41, 'Automaria II', 'Paradise Seeds has selected the most resinous plant of their Automaria #1 to use as a father plant, crossed this with a very famous Sativa variety to breed a new generation....'),
(42, 'Automatic', 'Big Buddha’s ‘Automatic’… the next generation of autoflowering strains bred with the intention of more stability and vigor as well as flavour and a taste that the 1st generation of autoflowering strai...'),
(43, 'Automatic AK74', 'This was Lowlife Seeds'' first foray into the autoflowering world and still their favourite. Crossing the very best AK47 they could find with the auto-flowering genes of Lowryder, Lowlife Seeds has pro...'),
(44, 'Automatic Mary', 'This autoflowering variety is a cross between Ruderalis and Santa Maria. Automatic Maria has inherited the mind-blowing potency and sweet flavor of Santa Maria....'),
(45, 'AutoMazar', 'AutoMazar is a remarkably heavy-yielding autoflowering hybrid between Dutch Passion''s legendary Mazar and a Ruderalis/Indica. Mazar is a triple prize winner, a best seller praised for its potency, hig...');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
