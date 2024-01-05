-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 05, 2024 at 03:31 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona_164333`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `matka` int(11) DEFAULT 0,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `matka`, `nazwa`) VALUES
(1, 0, 'dom'),
(2, 0, 'ogród'),
(3, 0, 'wedkarstwo');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'Wędkarstwo jak zacząć', '<table class=\"container\">\r\n	<tr>\r\n		<td>\r\n			<h1>Jak zacząć wędkować?</h1>\r\n				<img src=\"img/beginner1.jpg\" style=\"float: center;\"/>\r\n			<div class=\"content\">\r\n				<p>Jeśli chcesz wiedzieć, jak zacząć wędkować – zanim zaczniesz kupować sprzęt i szukać miejsca, powinieneś zaznajomić się z podstawą prawną do wędkowania, jaka obowiązuje w granicach naszego kraju.</p>\r\n				<h3>Uprawnienia do wędkowania – jak to wygląda w Polsce?</h3>\r\n				<p>Każda woda ma swojego właściciela i w związku z tym chcąc na niej wędkować, należy uiścić stosowną opłatę. Warto wiedzieć, że najwięcej wód dzierżawi <b>PZW ( Polski Związek Wędkarski)</b>. Inni możliwi dzierżawcy: Gospodarstwa Rybackie,  użytkownicy prywatni.</p>\r\n				<p>Zdarzają się też wody należące do miast – i są tym wyjątkiem, gdzie opłaty nie są potrzebne. Jest jednak jeden punkt łączący tych wszystkich dzierżawców, a mianowicie każdy z nich powinien oczekiwać i wymagać od osoby zainteresowanej wędkowaniem posiadania Karty Wędkarskiej.</p>\r\n				<h3>Skompletowanie zestawu wędkarskiego</h3>\r\n				<img src=\"img/beginner2.jpg\" style=\"float: left; padding: 0px 10px 10px 0px; \"/>\r\n				<p>Po zdobyciu odpowiedniej wiedzy oraz uzyskaniu uprawnień pozostaje już jedynie skompletować niezbędny zestaw wędkarski. Należy jednak zdawać sobie sprawę, że jest to hobby, które wymaga sporych inwestycji finansowych. Na rynku można wprawdzie odnaleźć dosyć tani sprzęt, jednak tego typu akcesoria najczęściej wytrzymują tylko jeden sezon. Pierwsza wędka powinna składać się z wędziska, haczyka i linki. Nie może być zbyt długa (najlepiej do trzech metrów), ani zbyt sztywna, aby dodatkowo nie utrudniać połowów. Ponadto do zestawu należy dołączyć żyłkę, podbierak, kołowrotek, przynętę oraz haczyk. Przy wyborze przynęt trzeba kierować się głównie typem ryb, które mają zostać złowione.\r\nWarto jednak zauważyć, że poszczególne elementy zestawu wędkarskiego będą się od siebie różniły ze względu na wybrany sposób połowu. Inne akcesoria przydadzą się w przypadku spinningu, a jeszcze inne podczas wędkowania muchomowego. Oczywiście trzeba też wziąć pod uwagę własne umiejętności oraz dotychczasowe doświadczenie. Początkujący wędkarze powinni skupić się przede wszystkim na skutecznej nauce samej techniki wędkowania, niż na inwestowaniu w sprzęt z najwyższej półki cenowej. Dopiero z czasem warto zacząć kompletować bardziej nowoczesne i droższe wyposażenie.</p>\r\n			</div>\r\n		</td>\r\n	</tr>\r\n</table>', 1),
(2, 'Spinning', '<table class=\"container\">\r\n    <tr>\r\n        <td>\r\n            <h1>Metoda Spinningowa</h1>\r\n            <img src=\"img/spin.jpeg\" style=\"float: center; width: 50%;\" />\r\n            <div class=\"content\">\r\n                <p>metoda sportowego i amatorskiego połowu ryb przy użyciu wędki, kołowrotka i sztucznej przynęty polegająca na naprzemiennym zarzucaniu jej i ściąganiu za pomocą wędziska i kołowrotka. Wędkarz może wykonywać także wabiące ruchy wędziskiem tak, aby ruch przynęty jak najbardziej przypominał ruch chorej, przestraszonej rybki. Metoda spinningowa służy przede wszystkim do połowu ryb drapieżnych (sandaczy, szczupaków, okoni, sumów itd.). Niektórzy wędkarze wyspecjalizowali się też w łowieniu na spinning ryb białorybu używając ultralekkich zestawów, które zazwyczaj odżywiają się pokarmem roślinnym i bezkręgowcami np. wzdręg, kleni, jazi. <br>\r\n                Oprócz podstawowych rzeczy warto mieć także przy sobie podbierak, wypychacz do odpinania haczyków, szczypce, sprężynkę do rozwierania paszczy szczupaka (służy do utrzymania otwartego pyska ryby podczas wyjmowania przynęty, szczupak ma bardzo ostre zęby skierowane w stronę przełyku).\r\n                </p>\r\n                <h3>Jaki zestaw na początek przygody ze spinningiem</h3>\r\n                <div class=\"img_content\">\r\n                    <img src=\"img/spining.jpg\" style=\"float: left; height: 100%; padding: 0px 10px 10px 0px\"/>\r\n                    <p>Na początek wystarczy Ci wędka o długości od 2,45 do 2,7 m i ciężarze wyrzutu w zakresie od 3 do 25 gram. To dość lekki spinning, który na naukę wydaje się być właściwy. Pozwoli Ci na pewny hol małych i średnich szczupaków, ale umożliwi też naukę łowienia np. okoni\r\n                    </p>\r\n                    <p>W tym miejscu pojawia się pytanie, co nawinąć jako linkę główną – plecionkę czy żyłkę? Obie opcje mają swoich zwolenników. Na pewno jeśli szukasz rozwiązania budżetowego, to żyłka w rozmiarze 0,16–0,18 mm będzie lepszym wyjściem. Ponadto jeśli nabierasz wprawy w zarzucaniu zestawem spinningowym, to także żyłka będzie Twoim podstawowym wyborem. Plecionka również ma wiele zalet. Jest dużo bardziej wytrzymała, a co ważniejsze – lepiej przenosi moment brania aniżeli żyłka. Dlatego bardziej doświadczeni wędkarze cenią sobie właśnie pletkę.\r\n                    </p>\r\n                    <p>Pozostaje Ci jeszcze skompletować pudełko z przynętami. Na początek zainwestuj w kilka gum – twisterów, ripperów, kopyt. Do tego kup kilka główek jigowych. Warto mieć w swoim ekwipunku kilka blach obrotowych i wahadłowych. Taki wachlarz przynęt na pewno powoli pozwoli Ci wejść w świat spinningu.\r\n                    </p>\r\n                </div>\r\n                <h3>Rodzaje przynęt</h3>\r\n                <div class=\"img_content_small\">\r\n                    <img src=\"img/blacha.jpg\" style=\"float: left; height: 80%; padding: 0px 10px 10px 0px\"/>\r\n                    <p>Błystka – obrotówkę zarzucamy do wody czekamy chwilkę aż lekko opadnie, przycinamy i zaczynamy zwijać z taką szybkością żeby szczytówka wędki wyginała się w stronę holowanej przynęty, wtedy dokładnie wyczujemy kiedy błystka obraca się i robi wibracje w wodzie.\r\n                    </p>\r\n                </div>\r\n                <div class=\"img_content_small\">\r\n                    <img src=\"img/wobler.jpg\" style=\"float: left; height: 80%; padding: 0px 10px 10px 0px\"/>\r\n                    <p>Wobler – woblery mamy pływające i tonące, po wrzuceniu do wody nie szarpiemy wędką tylko pomału zaczynamy zwijać i obserwujemy co się dzieje z woblerem, trzeba trochę poćwiczyć żeby złapać rybę na woblera.\r\n                    </p>\r\n                </div>\r\n                <div class=\"img_content\">\r\n                    <img src=\"img/guma.jpg\" style=\"float: left; height: 50%; padding: 0px 10px 10px 0px\"/>\r\n                    <p>Gumowa przynęta – twister lub kopytko ma główkę jigową (hak) ułożoną w górę dzięki temu nie zaczepimy o dno zwijając przynętę. Warto to wykorzystać przy łowieniu w trudniejszych warunkach gdzie jest dużo roślinności w wodzie lub zaczepów. Łowiąc na gumową przynętę, po zarzuceniu możemy odczekać aż spadnie oma na dno. Odczujemy to jak nagle żyłka zrobi się luźna, kiedy poczujemy delikatne tąpnięcie,  to wtedy zaczynamy pomału zwijać przynętę delikatnie szarpiąc wędką, co jakiś czas unosząc ją do góry a potem w dół. To sprawi, że nasza przynęta w wodzie zrobi podobnie, czyli uniesie się nad dnem i opadnie hacząc o dno a nawet robiąc delikatną smugę. Taka sytuacja bardzo interesuje zaciekawione okonie, sandacze lub szczupaki – te ryby uwielbiają gonić swój obiad, polować na niego.\r\n                    </p>\r\n                </div>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n</table>', 1),
(3, 'Grunt', '<table class=\"container\">\r\n    <tr>\r\n        <td>\r\n            <h1>Wędkarstwo gruntowe</h1>\r\n            <img src=\"img/feeder.jpg\" style=\"float: center; width: 50%;\" />\r\n\r\n            <div class=\"content\">\r\n                <p>Wędkarstwo gruntowe to bardzo popularna forma łowienia ryb. Podstawą techniki jest nęcenie przed samym łowieniem oraz donęcanie. Przynętę podaje się na dnie. Musi tam spoczywać również ciężarek oraz przepona z haczykiem. Po zarzuceniu należy napiąć żyłkę, a wędkę umieścić w podpórce. W trakcie łowienia można wygodnie siedzieć nad wodą i czekać, aż ryba złapie przynętę. Wędkowanie gruntowe na feeder jest bardzo uniwersalne, polega na zastosowaniu koszyczka zanętowego i drgającej szczytówki lub bombki, zawieszonej pomiędzy przelotkami. Pozwala na łowienie zarówno małych płotek, leszczy, jak i drapieżnych węgorzy czy szczupaków.\r\n                </p>\r\n                <h3>Jaki zestaw do wędkowania gruntowego?</h3>\r\n                <div class=\"img_content\" style=\"height: 400px;\">\r\n                    <div style=\"height: 170px;\">\r\n                        <img src=\"img/feeder_3.jpg\" style=\"float: left; width: 30%; padding: 0 10px 0px 0\">\r\n                        <p>Standardowe wędki mają długość od 3,5 do 4,5 metra. Można wybierać różne akcje wędziska, np.<b> paraboliczne, półparaboliczne albo szczytowe</b>. Dla początkujących amatorów wędkowania gruntowego polecane są wędki o akcji parabolicznej, które pomogą wyrzucić zestaw odpowiednio daleko. Najbardziej popularnymi wędziskami jest picker oraz feeder, używany do łowienia większych okazów, tj. węgorz, szczupak czy sandacz.\r\n                        </p>\r\n                        <p>\r\n                        W metodzie gruntowej sprawdzą się <b>kołowrotki</b> o rozmiarze od 3000 do 6000, na których zmieści się 200–250 metrów żyłki. Ważna jest praca kołowrotka, która powinna być płynna.\r\n                        </p>\r\n                    </div>\r\n                    <div style=\"height: 80px;\">\r\n                        <p>\r\n                        <img src=\"img/zylka.jpg\" style=\"float: left; width: 8%; padding: 0 10px 0px 0\">\r\n                        <b>Żyłki</b>  przeznaczane do pickera powinny mieć grubość 0,16-0,20 mm, a przeznaczone do feedera grubość 0,22-0,30 mm. Do metody gruntowej zalecane są żyłko mało rozciągliwe.\r\n                        </p>\r\n                    </div>\r\n                    <div style=\"height: 100px;\">\r\n                        <p>\r\n                        <img src=\"img/koszyk.jpg\" style=\"float: left; width: 10%; padding: 0 10px 0px 0\">\r\n                        <b>Rurki antysplątaniowe</b> zapobiegają splątaniu się zestawu.\r\n                        <br><b>Koszyczki zanętowe</b> montuje się w odległości ok. 30-45 cm od haczyka. Są wypełnione zanętą, przeznaczaną do łowienia określonych gatunków ryb. W wodach stojących można zastosować koszyczki otwarte, a w rzekach – zamknięte, kwadratowe lub trójkątne, z dociążeniem do 100 g.\r\n                        </p>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n</table>\r\n', 1),
(4, 'Spławik', '<table class=\"container\">\r\n    <tr>\r\n        <td>\r\n            <h1>Metoda Spławikowa</h1>\r\n            <img src=\"img/splawik.jpg\" style=\"float: center; width: 50%\"/>\r\n            <div class=\"content\">\r\n                <p>\r\n                Łowienie ryb na spławik jest jedną z najstarszych technik wędkarskich.Jeśli jesteś początkującym wędkarzem lub dopiero chciałbyś stawiać swoje pierwsze wędkarskie kroki, to postaw na łowienie na spławik! Takie rozwiązanie będzie niosło za sobą wiele korzyści. Zaczynający przygodę wędkarz nie będzie zmuszony już na starcie inwestować dużych nakładów finansowych w sprzęt.\r\n                </p>\r\n                <p>\r\n                Oczywiście kluczową rolę w zestawie spławikowym odgrywa spławik, którego głównym zadaniem jest sygnalizowanie brania ryby. Może być wykonany z różnego rodzaju materiałów, ale najczęściej spotkasz spławiki wykonane z balsy lub tworzywa sztucznego, dzięki czemu z łatwością unoszą się one na wodzie. Spławiki mogą mieć różny kształt – od smukłych po nieco bardziej owalne. Zbudowane są z korpusu (na którym znajdziesz informacje o ich gramaturze), antenki (części, która zawsze będzie wystawać ponad powierzchnię wody), a także kilu (podłużnej części pod korpusem). Ostatni z wymienionych to swego rodzaju przedłużenie spławika, a jednocześnie jego stabilizator.\r\n                </p>\r\n                <p>\r\n                Spławiki to bardzo szeroki segment rynku wędkarskiego. Dzięki nim będziesz miał możliwość utrzymania przynęty na konkretnej głębokości. Umożliwią podanie przynęty na dnie, w toni lub bliżej powierzchni wody. Można wyróżnić dwie grupy spławików – montowane na żyłce na stałe lub przelotowo. Pamiętaj, że warunki, jakie zastaniesz na łowisku, wymuszają na Tobie stosowanie spławików o różnych kształtach. Do łowienia na wodach stojących wybierzesz zazwyczaj spławik o smukłym kształcie. Jeśli łowisko nie jest głębokie, to wystarczy zamontować go na stałe. Jeśli jednak łowisz w głębszej wodzie, wówczas lepiej postawić na montaż przelotowy. Smukłe spławiki sprawdzą się przy połowach praktycznie każdego gatunku ryby: od płoci po leszcze, karasie, liny, a nawet karpie. Jeśli decydujesz się na łowienie w rzece, to pamiętaj, aby zastosować spławik o nieco większym korpusie. Z kolei w przypadku łowienia w rzekach o dużym uciągu korpus powinien być kulisty.\r\n                </p>\r\n                <div class=\"img_content\" style=\"height: 550px; max-height: 550px;\">\r\n                    <p>\r\n                    <img src=\"img/splawiki.jpg\" style=\"float: right; width: 50%; padding-left: 10px;\"/>\r\n                    A: 1 -mniejsze typy, odpowiednie do połowów w wodach stojących<br>\r\n                    2 – mniejsze typy do połowu w wodach płynących<br>\r\n                    3 – większe typy do połowu w wodach stojących<br>\r\n                    4 – większe typy do połowu w wodach płynących<br>\r\n                    5 – typy spławików odpowiednie do połowów na większe odległości<br>\r\n                    6 – spławik do połowu żywcówką<br>\r\n                    B. Klasyczny spławik szczupakowy bardzo ogranicza ruch żywca, natomiast żywiec założony na zestaw ze smukłym spławikiem „pracuje” na większej\r\n                    </p>\r\n                </div>\r\n                <h3>Jaki sprzęt na spławik?</h3>\r\n                <div class=\"img_content\" style=\"height: 300px\">\r\n                    <img src=\"img/bat.jpg\" style=\"float: left; width: 30%; padding-right: 10px;\"/>\r\n                    <p>\r\n                    Klasyczny zestaw spławikowy składa się z wędziska, kołowrotka z nawiniętą żyłką główną, spławika, obciążenia i przyponu z haczykiem. Zacznij od wyboru wędziska. Są dwa rodzaje wędzisk spławikowych – te, które posiadają przelotki i możliwość zamontowania kołowrotka, oraz modele bez przelotek. W pierwszym przypadku są to klasyczne spławikówki oraz modele do łowienia odległościowego lub metodą bolońską.\r\n                    </p>\r\n                    <p>\r\n                    Wędki spławikowe bez przelotek to baty lub tyczki. Szczególnie te drugie mają imponującą długość, dochodzącą nawet do 16 metrów. Są one stosowane w wędkarstwie spławikowym wyczynowym, głównie w czasie rozgrywania zawodów. Zacznij jednak od wersji klasycznej – kija teleskopowego o długości około 4,5–5 metrów. Wybierając odpowiedni model wędziska, zwróć uwagę na to, aby nie był on zbyt ciężki. Będzie Ci w ten sposób łatwiej opanować naukę zarzucania zestawu, zacinania ryby czy też jej holu.\r\n                    </p>\r\n                </div>\r\n                    <h4>Wędki i zestawy spławikowe</h4>\r\n                    <div class=\"img_content\">\r\n                    <img src=\"img/splawik2.jpg\" style=\"float: right; padding-left: 10px; width: 50%\"/>\r\n                    <p>\r\n                    Jeśli więc w swoim wędkarskim arsenale posiadasz lekkie wędki spławikowe, to kołowrotek również powinien być lżejszy. Stosuj raczej niewielkie kołowrotki z płytką szpulą. Zwróć także uwagę na hamulec. Musi on pracować płynnie. Ustaw go w taki sposób, aby w momencie brania większej ryby, mogła ona swobodnie wysunąć żyłkę ze szpuli. W przeciwnym razie możesz stracić zestaw.\r\n                    </p>\r\n                    <p>\r\n                    Kolejnym elementem zestawu jest żyłka. Na początku Twojej przygody z wędkarstwem możesz postawić na uniwersalny model nawet o nieco większej średnicy. W miarę jak Twoje umiejętności będą rosły, możesz korygować jej grubość. Oczywiście dobór żyłki jest uzależniony od wielu aspektów, m.in. warunków na łowisku czy wielkości ryb, na jakie się nastawiasz.\r\n                    </p>\r\n                    <p>\r\n                    Ważną częścią zestawu jest haczyk. Musi być ostry, aby mógł swobodnie wbić się w pyszczek ryby. Na rynku spotkasz różne modele, różniące się nie tylko wielkością i kształtem ale też kolorem. Możesz wybierać także spośród haczyków dedykowanych konkretnym gatunkom ryb lub przynętom, które będziesz na nie zakładał.\r\n                    </p>\r\n                    <p>\r\n                    Jak widzisz, sprzęt do wędkarstwa spławikowego nie jest zbyt skomplikowany. Oczywiście istotna jest praktyka, dlatego aby skutecznie łowić ryby na spławik, musisz często bywać nad wodą.\r\n                    </p>\r\n                </div>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n</table>\r\n', 1),
(5, 'Kontakt', '<table class=\"container\">\r\n	<tr>\r\n		<td>\r\n			<div class=\"content_form\">\r\n				<h1>Forumlarz kontaktowy</h1>\r\n				<form action=\"mailto:164333@student.uwm.edu.pl\">\r\n					<label for=\"fname\">Imię:</label><br>\r\n					<input type=\"text\" id=\"fname\" name=\"fname\"><br><br>\r\n					<label for=\"lname\">Nazwisko:</label><br>\r\n					<input type=\"text\" id=\"lname\" name=\"lname\"><br><br>\r\n					<label for=\"email\">Adres email:</label><br>\r\n					<input type=\"email\" id=\"email\" name=\"email\"><br><br>\r\n					 <textarea name=\"message\" rows=\"10\" cols=\"30\">\r\n					</textarea><br><br>\r\n					<input type=\"submit\" value=\"Wyślij\">\r\n				</form>\r\n				<br>\r\n				<form>\r\n					<input type=\"button\" value=\"żółty\" onclick=\"changeBackground(\'#FFF000\')\">\r\n					<input type=\"button\" value=\"czarny\" onclick=\"changeBackground(\'#000000\')\">\r\n					<input type=\"button\" value=\"biały\" onclick=\"changeBackground(\'#FFFFFF\')\">\r\n					<input type=\"button\" value=\"zielony\" onclick=\"changeBackground(\'#00FF00\')\">\r\n					<input type=\"button\" value=\"niebieski\" onclick=\"changeBackground(\'#0000FF\')\">\r\n					<input type=\"button\" value=\"pomarańczowy\" onclick=\"changeBackground(\'#FFF800\')\">\r\n					<input type=\"button\" value=\"szary\" onclick=\"changeBackground(\'#c0c0c0\')\">\r\n					<input type=\"button\" value=\"czerowny\" onclick=\"changeBackground(\'#FF0000\')\">\r\n				</form>\r\n			</div>\r\n			<div id=\"zegarek\"></div>\r\n			<div id=\"data\"></div>\r\n		</td>\r\n	</tr>\r\n</table>', 1),
(6, 'Filmy', '<div style = \"text-align: center\">\r\n    <p>Fanatyk wędkarstwa</p>\r\n    <p>\r\n        <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1lpisIT08Oc?si=CzNoDCrDT47pipgB\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>\r\n    </p>\r\n    <p>\r\n        <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/qQEYQd3Pnqg?si=ZmgEUZI1BjAnnmEn\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>\r\n    </p>\r\n    <p>\r\n        <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Lo_V9QADcqM?si=zjpEXDL4rBrsTbph\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>\r\n    </p>\r\n</div>', 1),
(7, 'Strona główna', '<table class=\"container\">\r\n    <tr>\r\n        <td>\r\n            <h1>Witam na stronie o wędkarstwie</h1>\r\n            <p><i>Na tej stronie dowiesz się jak zacząć wędkować, oraz opisze najbardziej popularne techniki łowienia.</i>\r\n            </p>\r\n            <div class=\"content\" style=\"clear: both; height: 930px\">\r\n                <div class=\"img_content\">\r\n                    <img src=\"img/fish.jpg\" style=\"float: center; width: 100% \" />\r\n                </div>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n</table>\r\n<div id=\"animacjaTestowa1\" class=\"test-block\", style=\"clear: both; margin: 10px\">\r\n    kliknij, a się powiększe\r\n</div>\r\n<script>\r\n    $(\"#animacjaTestowa1\").on(\"click\",function(){\r\n        $(this).animate({\r\n            width:\"500px\",\r\n            opacity: 0.4,\r\n            fontSize: \"3em\",\r\n            borderWidth: \"10px\",\r\n        }, 1500);\r\n    });\r\n</script>\r\n<div id=\"animacjaTestowa2\" class=\"test-block\", style=\"clear: both; margin: 10px\">\r\n    Najedż kursorem,a się powiększe\r\n</div>\r\n<script>\r\n    $(\"#animacjaTestowa2\").on({\r\n        \"mouseover\" : function(){\r\n            $(this).animate({\r\n                width: 300\r\n            }, 800);\r\n        },\r\n        \"mouseout\" : function(){\r\n            $(this).animate({\r\n                width: 200\r\n            }, 800);\r\n        }\r\n    });\r\n</script>\r\n<div id=\"animacjaTestowa3\" class=\"test-block\", style=\"clear: both; margin: 10px\">\r\n    Klikaj, abym urósł\r\n</div>\r\n<script>\r\n    $(\"#animacjaTestowa3\").on(\"click\", function(){\r\n        if (!$(this).is(\":animated\")){\r\n            $(this).animate({\r\n                width: \"+=\" + 50,\r\n                height: \"+=\" + 10,\r\n                opacity: \"-=\" + 0.1,\r\n                duration: 3000\r\n            });\r\n        }\r\n    });\r\n</script>', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `opis` text DEFAULT NULL,
  `data_utworzenia` datetime DEFAULT current_timestamp(),
  `data_modyfikacji` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_wygasniecia` date DEFAULT NULL,
  `cena_netto` decimal(10,2) NOT NULL,
  `podatek_vat` decimal(5,2) NOT NULL,
  `ilosc_dostepnych_sztuk` int(11) NOT NULL,
  `status_dostepnosci` enum('Dostępny','Niedostępny') DEFAULT 'Dostępny',
  `kategoria` int(11) DEFAULT NULL,
  `gabaryt_produktu` varchar(50) DEFAULT NULL,
  `zdjecie_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `tytul`, `opis`, `data_utworzenia`, `data_modyfikacji`, `data_wygasniecia`, `cena_netto`, `podatek_vat`, `ilosc_dostepnych_sztuk`, `status_dostepnosci`, `kategoria`, `gabaryt_produktu`, `zdjecie_url`) VALUES
(1, 'Wędka ', 'Wędka savage gear', '2024-01-05 14:48:02', '2024-01-05 15:15:55', '2024-06-27', 600.00, 8.00, 10000, 'Dostępny', 3, 'sredni', 'https://pleciona.pl/userdata/public/gfx/97947/Savage-Gear-SG4-Medium-Game-2%2C21cm-15-45-2cz.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoria` (`kategoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`kategoria`) REFERENCES `kategorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
