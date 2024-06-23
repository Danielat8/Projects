-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Jun 23, 2024 at 05:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `biography` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `surname`, `biography`, `deleted_at`) VALUES
(1, 'Cottage', 'Door Press', '   Cottage Door Press is an independent publisher of high-quality children’s books. Our books are designed to spark curiosity in the littlest readers and fan the flames of lifelong learning. We understand children deserve our respect. That\'s why we always select artwork and stories that encourage caregivers to \"read up\" to their little ones––exploring interests together, learning together, and giving their young minds room to grow.  We also believe in creating stories that reflect the boundless possibilities of all children. We hope to create books that inspire little ones to connect, encourage them to dream, give them cause to celebrate, and allow them to see themselves beautifully reflected in the stories they read.  To bring these beautiful stories to life, our diverse and talented staff collaborates with authors and illustrators from all backgrounds and nationalities. We have also partnered with multicultural brands and literacy organizations to make sure our books reflect and reach as many little ones as possible.', NULL),
(2, 'Dion', 'Leonard', 'Dion Leonard is an Australian/British ultra runner, motivational speaker and author. Dion started running in 2013 and has already achieved numerous top 10 finishes in ultra races around the world in the most extreme conditions. Dion has not only competed in but completed some of the world’s toughest ultra running races across the most inhospitable landscapes. Across landscapes from inhospitable deserts, high altitude mountains to wild jungles Dion has pushed, tested, broken and rebuilt his mental and physical limits in search of the ultra high, to find himself and to become the best he can be. Dion’s life changed forever when he was running a 155 mile race across the Gobi desert in China when a little stray dog ran 80 miles alongside him. Dion named the dog Gobi and his promise to bring Gobi home went viral, taking the world by storm. Before Dion could bring Gobi home she went missing in China and the story of Finding Gobi began. Dion’s amazing true story and incredible journey of Finding Gobi has since become a New York Times Bestseller, Sunday Times Bestseller and International Bestseller, printed in more than 21 languages which has also resulted in an upcoming movie. Dion has also written a Finding Gobi young readers edition, children’s picture book and a book about his cat Lara Runaway Cat', NULL),
(3, 'Katie', 'Weaver', 'Katie Residing in Colorado with her family, Katie Weaver is a highly acclaimed author, honored with multiple awards. As a mother of five, her vibrant life with young children serves as an endless wellspring of inspiration. Noteworthy works by Katie include: When the Sky Roars, The Trouble with Children According to Dog , both acknowledged with the prestigious Kirkus Star, and Uh-OH! My Dragon s Hungry. She finds joy in both traveling and writing, often engaging in the latter once her children are asleep', NULL),
(4, 'Nancy', 'Tillman', 'Nancy self-published her first book, On the Night You Were Born, in 2005. Her goal with On the Night You Were Born, and subsequent books, has always been to give parents words to say what they feel about their children. Nancy s illustrations are created digitally using dozens of layers of illustrative elements. These layers are eventually merged to form a composite, at which point texture and mixed media are applied.\r\nNancy s books are published by Feiwel and Friends, an imprint of Macmillan. This far five of her books have been New York Times bestsellers.\r\nNancy live’s in Portland, Oregon with her husband, a pug and a Swiss Mountain Dog. She would have a giraffe if she could, but her husband wonnt let her. \r\nBibliography:\r\nOn the Night You Were Born, 2005 New York Times Bestseller.\r\nIt is Time to Sleep, My Love with Eric Metaxas 2008.\r\nThe Spirit of Christmas, 2009.\r\nWherever You Are, My Love will Find You, 2010. New York Times Bestseller.\r\nTumford the Terrible, 2011.\r\nThe Crown on Your Head, 2011 New York Times Bestseller.\r\nTumford’s Rude Noises, 2012.\r\nLet There Be Light (with Desmond Tutu) 2013.\r\nI would Know You Anywhere, My Love, 2013 New York Times Bestseller.\r\nThe Heaven of Animals, 2014.\r\nYou are Here for a Reason, 2015 New York Times Bestseller.\r\nYou and Me and the Wishing Tree, 2016.\r\nYou are All Kinds of Wonderful, 2018.\r\nI Knew You Could Do It!, 2019.Because You re Mine, 2020', NULL),
(5, 'Jana', 'Tropper MS', 'Jana Tropper MS, CCC-SLP, is a speech-language pathologist at a midwestern public elementary school. When she is not writing, she reads, plays video games, and serves as the director of Literacy for Reading with Pictures, a nonprofit organization dedicated to supporting comics in education. She lives with her husband, Josh, and their own two rescue dogs, Ripley and Newt.', NULL),
(6, 'Kate', 'Berube', 'Kate Berube (Bear uh bee) grew up in a cow-filled Connecticut town where she dreamed of being an artist. She earned her BFA from The School of the Art Institute of Chicago and spent a semester studying in Paris. Like many artists, though, her career trajectory wasnt a straight line – along the way she was a nanny, a tax preparer, a scenic painter, a decorative painter, and a bookseller (at Portland’s own Powell’s Books). Portland is where she now makes her home with her family.\r\nKate Berube is the author-illustrator of Mae’s First Day of School and Hannah and Sugar, which won the Marion Vannett Ridgway Award and the Oregon Book Award for Childrens Literature, and was shortlisted for the Klaus Flugge Prize. She is the illustrator of Willow the White House Cat, written by Jill Biden, Johns Turn written by Mac Barnett, which won the Irma Black Silver Medal, and The Summer Nick Taught His Cats to Read written by Curtis Manley, which won a CLEL Bell Award and was a School Library Journal Best Book of the Year.', NULL),
(7, 'Noelle', 'West Ihli', 'Noelle lives in Idaho with her husband, two sons, and two cats. When she’s not plotting her next thriller, she’s scaring herself with true-crime documentaries or going for a trail ride in the foothills with her trusty pepper spray.', NULL),
(8, 'Alex', 'Finlay', 'Alex Finlay is the author of the 2021 breakout novel, EVERY LAST FEAR, the 2022 Goodreads Choice nominee for Best Mystery and Thriller, THE NIGHT SHIFT, and his latest March 2023 release, LibraryReads Hall of Fame recipient, WHAT HAVE WE DONE. Alex’s novels are regularly on \"best of the year\" lists, have been translated into nineteen languages and are sold around the world. All of his novels have been optioned for film and television, and EVERY LAST FEAR is in development for a series on a major streaming service. Alex lives in Washington, DC and Virginia. ', NULL),
(9, 'James', 'Rollins', '\"Fans of James Rollins and Dan Brown take note!\" Author of the internationally best-selling Bone Guard archaeological thrillers! Free short story collection when you join my Tomb Reader newsletter. \r\nBuckle up for action adventure history! Outdoor guide E. Chris Ambrose writes knowledge inspired adventure fiction including the Bone Guard archaeological thrillers. In the process of researching her books, Chris learned how to hunt with a falcon, clear a building of possible assailants, and pull traction on a broken limb.\r\nChris’s adventures have included horseback riding in Mongolia, diving on the Great Barrier Reef, searching for tigers in India, rock climbing in Colorado, and going behind the scenes at the Papal Palace in Avignon. Who knows what could happen next? \r\nPublished works have appeared in Matt Buchman’s Thrill Ride Magazine, Warrior Women, Fireside magazine, YARN online, Clarkesworld, several volumes of New Hampshire Pulp Fiction, and Uncle John’s Bathroom Reader. The author is both a graduate of and an instructor for the Odyssey Writing workshop, and a participant in the Codex on-line writers workshop. Chris also wrote interactive superhero novel, Skystrike: Wings of Justice for Choice of Games\r\nIn addition to writing, E. C. has taught rock climbing and led hiking, kayaking, climbing and mountain biking camps. Past occupations include founding a wholesale sculpture business, selecting stamps for a philatelic company, selling equestrian equipment, and portraying the Easter Bunny on weekends.', NULL),
(10, 'Amy', 'Hempel', 'Amy Hempel is the author of four collections of stories: REASONS TO LIVE, AT THE GATES OF THE ANIMAL KINGDOM, TUMBLE HOME, and THE DOG OF THE MARRIAGE. THE COLLECTED STORIES was published in 2006. She has won many awards, including a Guggenheim Fellowship and an inaugural USA Foundation Fellowship, and the PEN/Malamud Award for the Short Story. She teaches writing at the University of Florida and at Bennington College. ', NULL),
(11, 'Lisa', 'Philliphs', 'Lisa Phillips is a USA Today and top ten Publishers Weekly bestselling author of over 80 books that span Harlequin’s Love Inspired Suspense line, independently published series romantic suspense, and thriller novels. She’s discovered a penchant for high-stakes stories of mayhem and disaster where you can find made-for-each-other love that always ends in happily ever after.\r\nLisa is a British ex-pat who grew up an hour outside of London and attended Calvary Chapel Bible College, where she met her husband. He’s from California, but nobody’s perfect. It wasn’t until her Bible College graduation that she figured out she was a writer (someone told her). Lisa is a worship leader, tea aficionado, and dog lover of two crazy Airedales.', NULL),
(12, 'Patricia', 'Gibney', 'Patricia lives in the midlands of Ireland. She is an avid crime reader so naturally she found herself writing in the crime genre. \r\nA life changing experience in 2009, with the death of her 49 year old husband, meant she had to give up her career, and over the following few years, she rekindled her love of art and writing. \r\nInitially Patricia wrote and illustrated a children’s book, but her real ambition was to write a novel. And she did!\r\nIn January 2016, she joined with Ger Nichol of The Book Bureau Literary Agency. In July 2016, Patricia signed with Bookouture for four DI Lottie Parker crime novels. \r\nThe Missing Ones (Book 1) published in March 2017 and to date has reached a high of number 2 in Amazon UK Kindle charts and number 6 in the US. It also achieved number 1 in all its categories. It is a bestseller in UK, US, Canada and Australia.\r\nBook 2 in the series, The Stolen Girls, published on July 6th, 2017.\r\nBook 3 in the series, The Lost Child, publishes on October 27th 2017.', NULL),
(13, 'Karen', 'Rought', 'K.M. Rought is a writer, editor, and entertainment journalist hailing from Binghamton, New York. She graduated with a degree in Art History from Mansfield University of Pennsylvania, but quickly fell into a career of freelancing, fulfilling her childhood dream of being a published author.\r\nNow residing in Ohio, K.M. spends her days writing, playing video games, and telling her cat that no, it’s not time to eat yet. Her obsessions include foraging for mushrooms, buying neon green kitchenware, and reading every single book by Rick Riordan.', NULL),
(14, 'Andy', 'Maslen', '\r\nAndy writes thrillers across a number of genres: police procedurals, vigilante, psychological, suspense and horror. He spent 30 years in business before turning to writing full time.\r\nReaders praise Andy’s novels for their sense of place, kinetic action sequences, realistic dialogue and detailed depiction of the effects of conflict on minds and bodies. And for his meticulous research into police procedure around the world.\r\nHe is the creator of best-selling series featuring Kat Ballantyne, Gabriel Wolfe, Stella Cole and Inspector Ford, plus standalone novels and short stories.\r\nHe lives in Wiltshire.', NULL),
(15, 'Dan', 'Poblocki', 'Dan Poblocki is an American author of mystery, horror, and adventure novels for young people. He is the co-author with Neil Patrick Harris of the #1 New York Times bestselling series The Magic Misfits (writing under the pen-name Alec Azam). He’s also the author of The Stone Child, The Nightmarys, and the Mysterious Four series and many more. His books, The Ghost of Graylock and The Haunting of Gabriel Ashe, were Junior Library Guild selections and made the American Library Association’s Best Fiction for Young Adults list. His work has been translated into French, Greek, Russian, German, Polish, and Farsi.\r\n\r\nDan was born in Providence, Rhode Island. During his pre-teen years, his family moved to Basking Ridge, New Jersey, where he often looked for adventure with his best friends. Later, he graduated from Syracuse University with a degree in theater. Subsequently, he toured the United States playing ultra-challenging roles such as Ichabod Crane in The Legend of Sleepy Hollow and the Shoemaker in The Shoemaker and the Elves to packed houses filled with literally thousands of screaming children. (He hopes they weren’t screaming in fear.) \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', NULL),
(16, 'Miguel', 'Estrada', 'Miguel Estrada grew up in Caracas, Venezuela with a fascination for the mysterious and the occult as he spent his childhood imagining exciting scenarios that now have translated into stories for him to share. Though he has an inclination for horror, thriller, and suspense, he is no stranger to science fiction. His stories are full of colorful characters who always find themselves involved in murder, mystery, and blood... a lot of it.', NULL),
(17, 'Bram', 'Stoker', 'Abraham (Bram) Stoker was an Irish writer, best known for his Gothic classic Dracula, which continues to influence horror writers and fans more than 100 years after it was first published. Educated at Trinity College, Dublin, in science, mathematics, oratory, history, and composition, Stoker’ s writing was greatly influenced by his father’ s interest in theatre and his mother’ s gruesome stories about her childhood during the cholera epidemic in 1832. Although a published author of the novels Dracula, The Lady of the Shroud, and The Lair of the White Worm, and his work as part of the literary staff of The London Daily Telegraph, Stoker made his living as the personal assistant of actor Henry Irving and the business manager of the Lyceum Theatre in London. Stoker died in 1912, leaving behind one of the most memorable horror characters ever created.', NULL),
(18, 'Sarah', 'Waters', 'Sarah Waters is a British novelist. She is best known for her first novel, Tipping the Velvet, as well the novels that followed, including Affinity, Fingersmith, and The Night Watch.\r\nWaters attended university, earning degrees in English literature. Before writing novels Waters worked as an academic, earning a doctorate and teaching. Waters went directly from her doctoral thesis to her first novel. It was during the process of writing her thesis that she thought she would write a novel; she began as soon as the thesis was complete', NULL),
(19, 'T.J', 'Payne', 'T.J. Payne is the author of:\r\nThe Venue, Intercepts,and In My Father’s Basement.\r\nT.J. Payne writes primarily in the horror and thriller genres. His writing style relies on a light touch, using lean, smooth prose to build and maintain the story’s intensity. Through this style, Payne weaves in deeper themes and questions about human nature, particularly the subtle line between Good and Evil. Traditional Hero and Villain archetypes are often flipped in Payne’s work. His characters may not always be likable, but their faults and sins are profoundly human. Humans are the only species on Earth with the capability to create both great beauty and unspeakable acts of cruelty. The exploration of that duality has always been central to Payne’s work. Despite his gritty, dark work, Payne lives a very happy, non-murderous life. He married his high school sweetheart and together they enjoy exploring National Parks with their dog Frank (on leash and with plenty of poop bags, of course; he’s not a sociopath). ', NULL),
(20, 'David', 'Sodergren', 'David Sodergren lives in Scotland with his wife Heather and his best friend, Boris the Pug.\r\nGrowing up, he was the kind of kid who collected rubber skeletons and lived for horror movies. Not much has changed since then.\r\nSince the publication of his first novel, The Forgotten Island, he has written and published a further eight novels, including the gore-soaked folk-horror Maggie’s Grave and the romantic and disturbing The Haar.Praise for his books - THE FORGOTTEN ISLAND\r\n“A blood-drenched love letter to Lovecraft, handled with impressive authority and confidence.\" James Fahy, author of The Changeling series NIGHT SHOOT\r\n\"Night Shoot is wildly entertaining. If you’re not laughing, you’re scared out of your mind.”Sadie Hartmann, Mother HorrorDEAD GIRL BLUES\r\n“It takes guts to write a book like this and nail it in the way Sodergren does.”\r\nMatt Redmon, Night Worms', NULL),
(21, 'Johanna', 'Van Veen', 'Johanna grew up in the Netherlands together with her two sisters. The three of them are triplets, though her sisters are identical to each other and she’s different, a fact she didn’t discover until she was five years old; at least, unlike most people, she can pinpoint the exact moment she became self-aware.\r\nShe has received an MA in English Literature with a specialisation in early modern literature, as well as an MA Book and Digital Media with a specialisation in early modern book history, both of them at Leiden University. She currently works as an editor for a big company that sends a lot of reports and letters out every day, all of them requiring a lot of love and attention to make sure that every comma is where it should be. This job gives her enough time to write (mostly queer gothic) novels. When she isn’t doing any of those things, she enjoys spending time with her girlfriend, her sisters, and her dog, though not necessarily all at the same time.\r\nHer debut Gothic horror novel, My Darling Dreadful Thing was published by Sourcebooks in May 2024.', NULL),
(22, 'Brad', 'Weismann', 'As a film writer, Brad Weismann has interviewed figures ranging from Roger Ebert to Monty Python’s Terry Jones to Blaxploitation superstar Pam Grier, and legendary director Alex Cox. \"Lost in the Dark: A World History of Horror\" was his first book, and \"Horror Unmasked: A History of Terror from Nosferatu to Nope is his second. Several of his essays appear in the compendium \"100 Years of Soviet Cinema\". He was selected by the Library of Congress to contribute explanatory essays to its list of National Recording Registry entries. As a broadcaster and blogger, he has done everything from participating in the infamous no-budget amateur-film anthology TV series \"Homemovies\" to irritating Oliver Stone in front of a sold-out crowd. \r\nWeismann is an award-winning writer and editor who returned to the place he grew up, in the shadow of the Colorado Rockies, after 15 years of performing standup, improvisational, and sketch comedy on stage, radio, and television. He has worked as a journalist, feature writer, and contributor to publications and websites worldwide such as Senses of Cinema, Film International, Backstage, Muso, Parterre, Movie Habit, 5280, EnCompass, Colorado Daily, and Boulder Magazine.', NULL),
(23, 'Kathryn', 'Hore', 'Acerca del autor Kathryn Hore is an Australian writer of dark, thriller and speculative fiction, with a taste for blending genres in twisting ways. Her short stories have been published in anthologies and magazines such as Aurealis, Midnight Echo and The Crime Factory, and her first novel, The Wildcard, a twisting thriller about card players who take their games a little too far, was released by IFWG in 2021. Her second novel, The Stranger, is due out in September 2022 from Allen & Unwin and is an unflinching, page-turning feminist western.', NULL),
(24, 'Junji', 'Itō', 'Junji Itō (伊藤潤二)\r\nBorn in Gifu Prefecture in 1963, he was inspired from a young age by his older sister’s drawing and Kazuo Umezu’s comics and thus took an interest in drawing horror comics himself. Nevertheless, upon graduation he trained as a dental technician, and until the early 1990s he juggled his dental career with his increasingly successful hobby — even after being selected as the winner of the prestigious Umezu prize for horror manga.\r\nThe most common obsessions are with beauty, long hair, and beautiful girls, especially in his Tomie and Flesh-Colored Horror comic collections. For example: A girl’s hair rebels against being cut off and runs off with her head; Girls deliberately catch a disease that makes them beautiful but then murder each other; a woman treats her skin with lotion so she can take it off and look at her muscles, but the skin dissolves and she tries to steal her sister’s skin, etc.\r\nIto’s universe is also very cruel and capricious , his characters often find themselves victims of malevolent unnatural circumstances for no discernible reason or punished out of proportion for minor infractions against an unknown and incomprehensible natural order.\r\nHis longest work, the three-volume Uzumaki, is about a town’s obsession with spirals: people become variously fascinated with, terrified of, and consumed by the countless occurrences of the spiral in nature. Apart from the ghastly, convincingly-drawn deaths, the book projects an effective atmosphere of creeping fear as the town’s inhabitants become less and less human, and more and more bizarre things begin to happen.\r\nBefore Uzumaki, Ito was best known for Tomie, a comic series about a beautiful, teasing and eternally youthful high school girl who inspires her stricken admirers to murder each other in fits of jealous rage. Eventually, unable to cope with her coy flirtation and their desire to possess Tomie completely, they are inevitably compelled to kill her — only to discover that, regardless of the method they chose to dispose of her body, her body will always regenerate.\r\nIn 1998, during the horror boom that followed the success of Ringu, Tomie was adapted into a movie. Since Tomie, many of his works have been adapted for TV and the cinema.', NULL),
(25, 'Jane', 'Crittenden', 'Jane is a homes and interiors journalist for magazines such as 25 Beautiful Homes, Grand Designs and House Beautiful, and finds that writing about house projects is the perfect excuse to meet people and ask (lots of) questions. She has had stints of living in Canada, Greece, Spain, Ghana and New Zealand. Nowadays, she lives by the coast in Hove with her husband, two children and labradoodle, where she enjoys the beach and reading and writing in local cafés (often giving into the temptation of a homemade brownie).', NULL),
(26, 'Julia', 'Quinn', '#1 New York Times bestselling author Julia Quinn loves to dispel the myth that smart women don’t read (or write) romance, and in 2001 she did so in grand fashion, appearing on the game show The Weakest Link and walking away with the $79,000 jackpot. She displayed a decided lack of knowledge about baseball, country music, and plush toys, but she is proud to say that she aced all things British and literary, answered all of her history and geography questions correctly, and knew that there was a Da Vinci long before there was a code. Ms. Quinn is one of only sixteen members of Romance Writers of America’s Hall of Fame, her books have been translated into 29 languages, and she currently lives with her family in the Pacific Northwest.', NULL),
(27, 'Marceline', ' Addams', 'Marceline Addams is a half-goth, half-Haitian romance fan working in a STEM-related field that she\'d love to quit. Fueled entirely by workplace gossip, she channels her penchant for mischief and genetic predisposition for drama into writing romance novels instead of destroying careers.\r\nShe hates sitting still and when not pacing the room, she can be found booking flights she can’t afford, singing to herself in bathrooms, and daydreaming about getting rich. She enjoys spicy workplace romances, enemies-to-lovers, fake dating, forbidden love, historical, and paranormal romances as well as fantasy and romantasy. Please help her stop herself from accidentally forming a cult by checking out her romcoms!', NULL),
(28, 'Elle ', 'Kennedy', 'Elle Kennedy grew up in the suburbs of Toronto, Ontario, and holds a B.A. in English from York University. From an early age, she knew she wanted to be a writer, and actively began pursuing that dream when she was a teenager.\r\nElle currently writes for various publishers. She is the author of more than 50 titles of contemporary romance and romantic suspense novels, including the global sensation Off-Campus series.', NULL),
(29, 'Meghan', 'Quinn', 'Today Bestselling Author, wife, adoptive mother, and peanut butter lover. Author of romantic comedies and contemporary romance, Meghan Quinn brings readers the perfect combination of heart, humor, and heat in every book. ', NULL),
(30, 'Brittainy', 'Cherry', 'Brittainy Cherry has been in love with words since the day she took her first breath. She graduated from Carroll University with a Bachelors Degree in Theatre Arts and a minor in Creative Writing. She loves to take part in writing screenplays, acting, and dancing--poorly of course. Coffee, chai tea, and wine are three things that she thinks every person should partake in! Brittainy lives in Milwaukee, Wisconsin. When she’s not running a million errands and crafting stories, she’s probably playing with her adorable pets.', NULL),
(31, 'Erin', 'Hawkins', 'Erin Hawkins is the author of steamy romantic comedy novels full of humor and spice. She lives in Colorado with her husband and three young children. She enjoys reading, running, spending time in the mountains, watching reality TV, and brunch that lasts all day.', NULL),
(32, 'Kasey', 'Stockton', 'Kasey Stockton is a staunch lover of all things romantic. She doesn’t discriminate between genres and enjoys a wide variety of happily ever afters. She publishes both contemporary and historical novels, and all of her titles fall under clean romance. She loves reading, chocolate, and period dramas, but nothing tops her very own prince charming, their three children, and their sweet goldendoodle.', NULL),
(33, 'Max', 'Monroe', 'Many moons ago, a dynamic duo of romance authors teamed up under the pseudonym Max Monroe, and, well, the rest is history...Max Monroe is the New York Times and USA Today Bestselling Author of over thirty contemporary romance titles (with Romantic Comedy being their jam), Favorite writing partners and long time friends, Max and Monroe strive to live and write all the fun, sexy swoon so often missing from their Facebook newsfeed. Sarcastic by nature, their two writing souls feel like they’ve found their other half. This is their most favorite adventure thus far. ', NULL),
(34, 'Lucy', 'Score', 'Lucy Score is an instant #1 New York Times bestselling author. She grew up in a literary family who insisted that the dinner table was for reading and earned a degree in journalism. \r\nShe writes full-time from the Pennsylvania home she and Mr. Lucy share with their obnoxious cat, Cleo. When not spending hours crafting heartbreaker heroes and kick-ass heroines, Lucy can be found on the couch, in the kitchen, or at the gym. \r\nShe hopes to someday write from a sailboat, oceanfront condo, or tropical island with reliable Wi-Fi.', NULL),
(35, 'Abby', 'Jimenez', 'Abby Jimenez is a Food Network winner, New York Times best selling author, and recipient of the 2022 Minnesota Book Award for her novel Life’s Too Short. Abby founded Nadia Cakes out of her home kitchen back in 2007. The bakery has since gone on to win numerous Food Network competitions and, like her books, has amassed an international following.', NULL),
(36, 'Brynne', 'Weaver', 'Brynne is a fan of velociraptors, the Alien movies (well, most of them), red wine, and wild adventures. She can relate nearly anything you say to a line from the movie Hot Fuzz. She has been trying unsuccessfully for years to convince her husband that they should acquire a pet mink to add to their menagerie of animals (what could possibly go wrong with that plan?!). Brynne has been everything from an archaeologist to a waitress, a deep-sea core analyst to an advertising account executive. For the last several years, she has been working in the field of neuroscience clinical research. Brynne has been writing since childhood. When not busy at her day job or working on her next book, Brynne can be found with her husband and son on their family farm in NS, Canada, or enjoying her other passions which include riding horses, reading, motorcycling, and spending time with family and friends around a raclette and a bottle of wine.', NULL),
(37, 'David', 'Sedaris', 'David Sedaris lives in Paris. Raised in North Carolina, he has worked as a housecleaner and most famously, as a part-time elf for Macy’s. Several of his plays have been produced, and he is a regular contributor to ESQUIRE and Public Radio International’s This American Life.', NULL),
(38, 'Robert Allan', 'Caro', 'Robert Allan Caro (born October 30, 1935) is an American journalist and author known for his celebrated biographies of United States political figures Robert Moses and Lyndon B. Johnson.\r\nAfter working for many years as a reporter, Caro wrote The Power Broker (1974), a biography of New York urban planner Robert Moses, which was chosen by the Modern Library as one of the hundred greatest nonfiction books of the twentieth century. He has since written four of a planned five volumes of The Years of Lyndon Johnson (1982, 1990, 2002, 2012), a biography of the former president.\r\nFor his biographies, he has won two Pulitzer Prizes in Biography, the National Book Award, the Francis Parkman Prize (awarded by the Society of American Historians to the book that \"best exemplifies the union of the historian and the artist\"), two National Book Critics Circle Awards, the H.L. Mencken Award, the Carr P. Collins Award from the Texas Institute of Letters, the D.B. Hardeman Prize, and a Gold Medal in Biography from the American Academy of Arts and Letters. ', NULL),
(39, 'Tom', 'Wolfe', 'Tom Wolfe (1930-2018) was one of the founders of the New Journalism movement and the author of such contemporary classics as The Electric Kool-Aid Acid Test, The Right Stuff, and Radical Chic & Mau-Mauing the Flak Catchers, as well as the novels The Bonfire of the Vanities, A Man in Full, and I Am Charlotte Simmons. As a reporter, he wrote articles for The Washington Post, the New York Herald Tribune, Esquire, and New York magazine, and is credited with coining the term, “The Me Decade.”\r\nAmong his many honors, Tom was awarded the National Book Award, the John Dos Passos Award, the Washington Irving Medal for Literary Excellence, the National Humanities Medal, and the National Book Foundation Medal for Distinguished Contribution to American Letters.\r\nA native of Richmond, Virginia, he earned his B.A. at Washington and Lee University, graduating cum laude, and a Ph.D. in American studies at Yale. He lived in New York City.', NULL),
(40, 'Ernest', 'Hemingway', ' Ernest Hemingway was born in 1899. His father was a doctor and he was the second of six children. Their home was at Oak Park, a Chicago suburb. \r\nIn 1917, Hemingway joined the Kansas City Star as a cub reporter. The following year, he volunteered as an ambulance driver on the Italian front, where he was badly wounded but decorated for his services. He returned to America in 1919, and married in 1921. In 1922, he reported on the Greco-Turkish war before resigning from journalism to devote himself to fiction. He settled in Paris where he renewed his earlier friendships with such fellow-American expatriates as Ezra Pound and Gertrude Stein. Their encouragement and criticism were to play a valuable part in the formation of his style.\r\nHemingway’s first two published works were Three Stories and Ten Poems and In Our Time but it was the satirical novel, The Torrents of Spring, that established his name more widely. His international reputation was firmly secured by his next three books; Fiesta, Men Without Women and A Farewell to Arms.\r\nHe was passionately involved with bullfighting, big-game hunting and deep-sea fishing and his writing reflected this. He visited Spain during the Civil War and described his experiences in the bestseller, For Whom the Bell Tolls.\r\nHis direct and deceptively simple style of writing spawned generations of imitators but no equals. Recognition of his position in contemporary literature came in 1954 when he was awarded the Nobel Prize for Literature, following the publication of The Old Man and the Sea. He died in 1961.', NULL),
(41, 'Shel', 'Silverstein', '\"And now, children, your Uncle Shelby is going to tell you a story about a very strange lion- in fact, the strangest lion I have ever met.\" So begins Shel Silverstein’s very first children’s book, Lafcadio, the Lion Who Shot Back. It’s funny and sad and has made readers laugh and think since it was published in 1963. It was followed the next year by three more books. The first of them, The Giving Tree, is a moving story about the love of a tree for a boy. Shel returned to humor the same year with A Giraffe and a Half, delighting readers with a most riotous ending. The third book in 1964 was Uncle Shelby’s Zoo Don’t Bump the Glump! and Other Fantasies, Shel’s first poetry collection, and his first and only book illustrated in full color. It combined his unique imagination and bold brand of humor in this collection of silly and scary creatures. Shel’s second collection of poems and drawings, Where the Sidewalk Ends, was published in 1974. His recording of the poems won him a Grammy for best Children’s Album. In this collection, Shel invited children to dream and dare to imagine the impossible, from a hippopotamus sandwich to the longest nose in the world. With his next collection of poems and drawings, A Light in the Attic, published in 1981, Shel asked his readers to turn the light on in their attics, to put something silly in the world, and not to be discouraged by the Whatifs. Instead he urged readers to catch the moon or invite a dinosaur to dinner- to have fun! A Light in the Attic was the first children’s book to break onto the New York Times Bestseller List, where it stayed for a record-breaking 182 weeks. The last book that was published before his death in 1999 was Falling Up (1996). Like his other books, it is filled with unforgettable characters. Shel Silverstein’s legacy continued with the release of a new work,Runny Babbit, the first posthumous publication conceived and completed before his death and released in March 2005. Witty and wondrous, Runny Babbit is a poetry collection of simple spoonerismsH, which twist the tongue and tease the mind. Don’t Bump the Glump! And Other Fantasies was recently reissued in 2008 after being unavailable for over 30 years. Shel was always a believer in letting his work do the talking for him--few authors have ever done it better.', NULL),
(42, 'J.R.R', 'Tolkien', 'J.R.R. Tolkien was born on 3rd January 1892. After serving in the First World War, he became best known for The Hobbit and The Lord of the Rings, selling 150 million copies in more than 40 languages worldwide. Awarded the CBE and an honorary Doctorate of Letters from Oxford University, he died in 1973 at the age of 81.', NULL),
(43, 'Freida', 'McFadden', 'Sunday Times, and Publisher’s Weekly bestselling author Freida McFadden is a practicing physician specializing in brain injury who has penned multiple bestselling psychological thrillers and medical humor novels. Freida’s work has been selected as one of Amazon Editors’ best books of the year, she is the winner of the International Thriller Writers Award for best paperback, and she is a Goodreads Choice Award winner. Her novels have been translated into 40 languages.Freida lives with her family and black cat in a centuries-old three-story home overlooking the ocean.', NULL),
(44, 'Lauren', 'Roberts', ' When Lauren isn’t writing about fantasy worlds and bantering love interests, she can likely be found burrowed in bed reading about them. Lauren has lived in Michigan her whole life, making her very familiar with potholes, snow, and various lake activities. She has the hobbies of both a grandmother and a child, i.e., knitting, laser tag, hammocking, word searches, and coloring. Powerless is her debut novel, and she hopes to have the privilege of writing pretty words for the rest of her life.', NULL),
(45, 'Joshua', 'Giles', 'Joshua Giles is an apostolic and prophetic voice to the nations. Joshua is the lead pastor of Kingdom Embassy Worship Center in Minneapolis, Minnesota. He is a sought-after conference speaker, preacher, teacher, author, and psalmist. He is the founder of The Mantle Network, an apostolic and prophetic ministry that supports five-fold leaders through education, training, and spiritual covering. Joshua is part of the Jabula organization under the leadership of Bishop Tudor Bismark. He also serves faithfully under TSABA International, focusing on family ministry. He has had the privilege to travel to over 35 nations on prophetic assignment and ministering the Gospel. He has frequented Africa, Europe, and the Middle East.', NULL),
(46, 'Christina', 'Lauren', 'Christina Lauren is the combined pen name of long-time writing partners and best friends Christina Hobbs and Lauren Billings. The #1 international bestselling coauthor duo writes both Young Adult and Adult Fiction, and together has produced twenty New York Times bestselling novels. They are published in over 30 languages, have received multiple starred reviews, won both the Seal of Excellence and Book of the Year from RT Magazine, been inducted into the Library Reads Hall of Fame, named Amazon and Audible Romance of the Year, a Lambda Literary Award finalist and been nominated for several Goodreads Choice Awards. They have been featured in publications such as Forbes, The Atlantic, The Washington Post, Time, Entertainment Weekly, People, Today, O Magazine and more. Their third YA novel, Autoboyography was released in 2017 to critical acclaim, followed by Roomies, Love and Other Words, Josh and Hazel’s Guide to Not Dating, The Unhoneymooners, In a Holidaze, and The Soulmate Equation, Something Wilder, The True Love Experiment and The Paradise Problem.', NULL),
(47, 'Test', 'Avtor', 'Asafkjsdfkjhdskhjgsr;gjhrdlsg rhj grjfl ghrdfgj ergljke  ', '2024-06-17 17:56:14'),
(48, '', '', '  ', '2024-06-17 17:57:08'),
(49, 'ivanaaa', 'dorrrr', 'ghfdsfghjmhgfdfbngfdsfgvbngfdsfvbnhgfdsfghjhgedfghjmngfrdfgnmjhgfdfghjmnhgfewdsfgm,.', '2024-06-20 23:48:01'),
(50, 'testEDIT', 'TEST2', 'kjhgfdsfghjhgfdsfghjjhgfdvcdmcvfbgfvbgfv', NULL),
(51, 'ivana', 'Avtor', 'gfdsfgbfdsfgbfdefghjhgfdsfghgfdcsxdfghjHGFDGHFDS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `published_year` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `cover_url` varchar(255) NOT NULL,
  `cover_url2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author_id`, `category_id`, `published_year`, `page`, `cover_url`, `cover_url2`) VALUES
(3, 'A Little Hedgehog', 1, 1, 2019, 10, 'https://m.media-amazon.com/images/I/81opuVMJyrL._SL1500_.jpg', 'https://img.freepik.com/premium-vector/cartoon-little-hedgehog-holding-red-apple_29190-8431.jpg?w=740'),
(4, 'Gobi: A Little Dog with a Big Heart', 2, 1, 2017, 32, 'https://m.media-amazon.com/images/I/91mcmo-C99L._SL1500_.jpg', 'https://img.freepik.com/free-vector/cheerful-puppy-with-big-eyes_1308-162177.jpg?t=st=1717682211~exp=1717685811~hmac=b2e7833f92508fb59adb84a5197dbbb3c3d19259e78af366e108c0ef510f0de8&w=360'),
(5, 'The Trouble with Children', 3, 1, 2024, 40, 'https://m.media-amazon.com/images/I/81SF4lQSlfL._SL1500_.jpg', 'https://img.freepik.com/premium-photo/3d-rendering-boy-with-dog-white-background_1142-31895.jpg?w=740'),
(6, 'The Heaven of Animals', 4, 1, 2014, 32, 'https://m.media-amazon.com/images/I/81uwlFSXacL._SL1500_.jpg', 'https://images.nightcafe.studio/jobs/DZp1ZPyPuN3M9kj1hWnE/DZp1ZPyPuN3M9kj1hWnE--1--ra62q.jpg?tr=w-1600,c-at_max'),
(7, 'Animal Rescue Friends: Finding Home', 5, 1, 2024, 160, 'https://m.media-amazon.com/images/I/819JDDyj2wL._SL1500_.jpg', 'https://img.freepik.com/premium-photo/little-girl-with-dog-3d-rendering-isolated-white-background_1057-15167.jpg?w=740'),
(8, 'Willow the White House Cat', 6, 1, 2024, 48, 'https://m.media-amazon.com/images/I/71OGl5H90DL._SL1500_.jpg', 'https://i.pinimg.com/736x/1f/eb/42/1feb42b880744d49f3bd9b8dcce1224f.jpg'),
(9, 'Run on Red', 7, 2, 2022, 310, 'https://m.media-amazon.com/images/I/61wb548TV5L._SL1500_.jpg', 'https://m.media-amazon.com/images/I/61Q2X+BTtjL.jpg'),
(10, 'The Night Shift', 8, 2, 2022, 312, 'https://m.media-amazon.com/images/I/81W35+Tj7dL._SL1500_.jpg', 'https://images.pexels.com/photos/7322290/pexels-photo-7322290.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(11, 'The Nazi Skull: A Bone Guard Adventure', 9, 2, 2020, 397, 'https://m.media-amazon.com/images/I/71jxMyTDKnL._SL1360_.jpg', 'https://st.depositphotos.com/1042659/4622/i/450/depositphotos_46226107-stock-photo-human-skeleton.jpg'),
(12, 'The Hand That Feeds You', 10, 2, 2016, 288, 'https://m.media-amazon.com/images/I/71Ho7JDbm1L._SL1500_.jpg', 'https://media.istockphoto.com/id/1201027177/photo/badly-damaged-female-mannequin-head-symbolizes-domestic-violence.webp?s=2048x2048&w=is&k=20&c=joxFFR2HugKp69QhbQ6-_DovwWt2FAzX370Vz3B09yk='),
(13, 'Cold Dead Night', 11, 2, 2022, 422, 'https://m.media-amazon.com/images/I/71I6DPHGVxL._SL1500_.jpg', 'https://media.istockphoto.com/id/487971024/photo/halloween.webp?s=2048x2048&w=is&k=20&c=6z1HpwjtR_x_kmd-ODB1sp-poh80HAmynkbgmdyflgc='),
(14, 'Silent Voices', 12, 2, 2021, 438, 'https://m.media-amazon.com/images/I/91mrtLV8nvL._SL1500_.jpg', 'https://st.depositphotos.com/1776223/1928/i/600/depositphotos_19288839-stock-photo-image-of-a-ghoul.jpg'),
(15, 'Under the Surface', 13, 2, 2022, 254, 'https://m.media-amazon.com/images/I/61pyHXxyUsL._SL1500_.jpg', 'https://st3.depositphotos.com/4741801/13561/i/450/depositphotos_135617822-stock-photo-dark-underwater-cavern-and-beams.jpg'),
(16, 'Hit and Run', 14, 2, 2017, 335, 'https://m.media-amazon.com/images/I/81GiZxFSi4L._SL1500_.jpg', 'https://st4.depositphotos.com/36694358/38028/i/600/depositphotos_380288600-stock-illustration-red-human-hand-print-black.jpg'),
(17, 'The Gathering', 15, 3, 2016, 217, 'https://m.media-amazon.com/images/I/5114A4ta8eL.jpg', 'https://media.istockphoto.com/id/1436437969/vector/scary-female-monster.webp?s=2048x2048&w=is&k=20&c=qJSGgBaSnF_xLz3xvbjcG9pMwlO8NVaVYYX_KJzSHYI='),
(18, 'Heaven’s Peak', 16, 3, 2018, 295, 'https://m.media-amazon.com/images/I/91Jfdmz-ubL._SL1500_.jpg', 'https://media.istockphoto.com/id/610018828/photo/zombie.webp?s=2048x2048&w=is&k=20&c=BXnv0E9RG3t002NJC11mL_JBjrtVTXoQ2PlgVGCpFYI='),
(19, 'Classic Tales of Horror', 17, 3, 2024, 842, 'https://m.media-amazon.com/images/I/81SYs5T8ATL._SL1500_.jpg', 'https://st.depositphotos.com/3235295/4984/i/600/depositphotos_49849525-stock-photo-mysterious-hand-on-a-window.jpg'),
(20, 'The Night Watch\r\n\r\n', 18, 3, 2006, 528, 'https://m.media-amazon.com/images/I/61l9hpN3SOL._SL1200_.jpg', 'https://media.istockphoto.com/id/1209209629/photo/creepy-doll-head-in-the-dark.webp?s=2048x2048&w=is&k=20&c=VAWtGA6eSCUoIFwezudCshBZCNgkwUEwOz-oOx3C8pM='),
(21, 'Intercepts', 19, 3, 2020, 326, 'https://m.media-amazon.com/images/I/51fWTY6QWuL._SL1500_.jpg', 'https://media.istockphoto.com/id/1027991186/photo/ghost-bride.webp?s=2048x2048&w=is&k=20&c=7ZGj42SX_I0YUC06jZjwkCj1knz-S5DhBoZxjVS4h28='),
(22, 'The Haar', 20, 3, 2022, 220, 'https://m.media-amazon.com/images/I/61XqeqwMIIL._SL1500_.jpg', 'https://static4.depositphotos.com/1010671/270/i/600/depositphotos_2702943-stock-photo-alien.jpg'),
(23, 'My Darling Dreadful Thing', 21, 3, 2024, 375, 'https://m.media-amazon.com/images/I/81ODQyGdsVL._SL1500_.jpg', 'https://media.istockphoto.com/id/844891550/photo/ghost-woman.webp?s=2048x2048&w=is&k=20&c=DTA-gpqfT1riBqQ9GLnuTkMlmEM3HB4WyJSB7Qitp18='),
(24, 'Horror Unmasked', 22, 3, 2023, 232, 'https://m.media-amazon.com/images/I/81ZmuldAyjL._SL1500_.jpg', 'https://media.istockphoto.com/id/1027991140/photo/nightmare-with-bogeyman.webp?s=2048x2048&w=is&k=20&c=5Q_5QtdtoPhALNTvhDWJrA4qsRTiqXZjD1AWW2ToNFs='),
(25, 'Ho Ho Horror', 23, 3, 2011, 180, 'https://m.media-amazon.com/images/I/81K-Bjg3bYL._SL1500_.jpg', 'https://media.istockphoto.com/id/1253507850/vector/the-face-of-a-demon-with-glowing-eyes.webp?s=2048x2048&w=is&k=20&c=Qe78tdPxkPVDvg0fvqcAAClI8OvB6uIdSLnxzr4yV5I='),
(26, 'Stitches', 24, 3, 2024, 112, 'https://m.media-amazon.com/images/I/81KnQgfXYwL._SL1500_.jpg', 'https://st5.depositphotos.com/36864246/67736/i/600/depositphotos_677362050-stock-photo-scary-halloween-skull-creepy-nightmare.jpg'),
(40, 'Summer Ever After', 25, 4, 2024, 360, 'https://m.media-amazon.com/images/I/71jr5SUB6rL._SL1500_.jpg', 'https://media.istockphoto.com/id/1479201983/vector/young-woman-holding-suitcase-and-tickets-snaps-a-selfie-with-her-phone-she-is-all-set-to.webp?s=2048x2048&w=is&k=20&c=CVCuNZqwRA5-6pcDtpKrie1NbaDgxIXCJYUTIXKQxdg='),
(41, 'Bridgerton', 26, 4, 2015, 464, 'https://m.media-amazon.com/images/I/81ILBJ+K14L._SL1500_.jpg', 'https://bloximages.chicago2.vip.townnews.com/azdailysun.com/content/tncms/assets/v3/editorial/8/88/8888c961-79bc-51a4-8ba4-621cac411736/614e00a1284fa.image.jpg?resize=540%2C960'),
(42, 'You Can\'t Fight Molecular Attraction', 27, 4, 2023, 272, 'https://m.media-amazon.com/images/I/71x8rsyMArL._SL1500_.jpg', 'https://media.istockphoto.com/id/523391099/photo/young-doctor-with-heart.webp?s=2048x2048&w=is&k=20&c=8-XIrTtvbdfjIMx357fTzMUBT2sHG4PZo5gvY-jH9uY='),
(43, 'The Dixon Rule ', 28, 4, 2024, 526, 'https://m.media-amazon.com/images/I/71sP2NWo6DL._SL1500_.jpg', 'https://media.istockphoto.com/id/1448347504/vector/young-woman-painting-a-portrait-in-her-studio.webp?s=2048x2048&w=is&k=20&c=nwAZeka02oKDRyXZBJ8WSYl9iF49li7DCKQJ_cxYOaY='),
(44, 'Bridesmaid for Hire', 29, 4, 2024, 448, 'https://m.media-amazon.com/images/I/71LArspxyBL._SL1500_.jpg', 'https://img.freepik.com/premium-photo/3d-illustration-sweet-arab-female-wearing-petticoat-ai-generated_705708-13564.jpg?w=360'),
(45, 'The Problem with Dating', 30, 4, 2023, 368, 'https://m.media-amazon.com/images/I/71hO-s2L38L._SL1500_.jpg', 'https://m.media-amazon.com/images/I/61YmTf1AkOL.jpg'),
(46, 'Reluctantly Yours', 31, 4, 2022, 340, 'https://m.media-amazon.com/images/I/71O19p+5S6L._SL1500_.jpg', 'https://img.freepik.com/free-photo/colleagues-man-woman-leaning-each-other-smiling_23-2148075662.jpg?t=st=1717695982~exp=1717699582~hmac=e686f7199ce7d57f0402e562fceb004eede3b409d0ee4618c3afd1b97177a635&w=360'),
(47, 'Love on Deck: A Fake Dating Romance', 32, 4, 2023, 316, 'https://m.media-amazon.com/images/I/719oDZC+8pL._SL1500_.jpg', 'https://img.freepik.com/free-photo/broken-heart-concept_23-2151260995.jpg?t=st=1717696196~exp=1717699796~hmac=3af927c296e7c808ae912e387ca0655b874b27a1d63b5b2688b747b255a23f46&w=360'),
(48, 'What I Should’ve Said', 33, 4, 2024, 318, 'https://m.media-amazon.com/images/I/714rmo34YDL._SL1500_.jpg', 'https://img.freepik.com/premium-photo/sunset-water-with-sun-setting-it_221375-2655.jpg?w=360'),
(49, 'Things We Never Got Over', 34, 4, 2022, 570, 'https://m.media-amazon.com/images/I/81WklxcuSZL._SL1500_.jpg', 'https://i3.wp.com/thursd.com/storage/media/7372/flowers-bloom-in-sophia-ahamed-dark-night-photography-series006.jpeg?ssl=1'),
(50, 'Yours Truly', 35, 4, 2023, 416, 'https://m.media-amazon.com/images/I/711oH5fG1YL._SL1500_.jpg', 'https://img.freepik.com/free-vector/hand-drawn-red-thread-illustration_23-2149988109.jpg?t=st=1717696815~exp=1717700415~hmac=d21104db8bcdb3eb1f17bfa6af917564e74a097921fa6fc0a86165419c511b62&w=740'),
(51, 'Butcher & Blackbird', 36, 4, 2023, 368, 'https://m.media-amazon.com/images/I/81WXQHyMczL._SL1500_.jpg', 'https://img.freepik.com/free-vector/hand-drawn-dia-dos-namorados-illustration_23-2149403838.jpg?t=st=1717697061~exp=1717700661~hmac=f9843e0d168f3f0e7dec6af03c2b3ddb680dce483fbc255a9c7c9077a7379299&w=740'),
(52, 'Love and Other Words', 46, 4, 2018, 432, 'https://m.media-amazon.com/images/I/719CLtj6ndL._SL1500_.jpg', 'https://img.freepik.com/premium-photo/comic-speech-bubbles-speech-bubbles-with-dialog_1135385-36180.jpg?w=740'),
(53, 'Me Talk Pretty One Day', 37, 5, 2001, 272, 'https://m.media-amazon.com/images/I/81Mg+BtxUzL._SL1500_.jpg', 'https://media.s-bol.com/mVMYyAgY8579/nKgABD/541x840.jpg'),
(54, 'The Power Broker: Robert Moses and the Fall of New York', 38, 5, 1975, 1344, 'https://m.media-amazon.com/images/I/91hPurtdYTL._SL1500_.jpg', 'https://m.media-amazon.com/images/I/81CoLHS9chL._SL1500_.jpg'),
(55, 'RIGHT STUFF', 39, 5, 2008, 352, 'https://m.media-amazon.com/images/I/71QdCubaXVL._SL1500_.jpg', 'https://pictures.abebooks.com/isbn/9780553275568-us.jpg'),
(56, 'The Sun Also Rises', 40, 5, 2006, 251, 'https://m.media-amazon.com/images/I/71O7XjXaMhL._SL1500_.jpg', 'https://m.media-amazon.com/images/I/816IMJB-IHL._SL1500_.jpg'),
(57, 'Where the Sidewalk Ends', 41, 5, 2000, 176, 'https://i.ebayimg.com/images/g/wQEAAOSwmN5gLZAu/s-l1600.webp', 'https://i.harperapps.com/covers/9780060586751/x600.jpg'),
(58, 'The Lord Of The Rings', 42, 5, 2012, 1216, 'https://m.media-amazon.com/images/I/7125+5E40JL._SL1500_.jpg', 'https://cdna.artstation.com/p/assets/images/images/028/721/422/large/niclas-dreier-gollum-full-render-niclas-dreier-creative.jpg?1595322187'),
(59, 'The Housemaid Is Watching', 43, 6, 2024, 400, 'https://m.media-amazon.com/images/I/91OSM58Y-pL._SL1500_.jpg', 'https://images.pexels.com/photos/5891794/pexels-photo-5891794.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(60, 'Reckless (The Powerless Trilogy).', 44, 6, 2024, 400, 'https://m.media-amazon.com/images/I/81q6ecxcZUL._SL1500_.jpg', 'https://media.istockphoto.com/id/1189189755/photo/athens-academy.webp?s=2048x2048&w=is&k=20&c=hKVPAYXeX0aE3XR9KLkOfwU2V4XtxNsqErENlKZ6Rko='),
(61, 'Prophetic Reset: 40 Days to Aligning with God Plan for Your Life.', 45, 6, 2024, 224, 'https://m.media-amazon.com/images/I/817NmMvU3JL._SL1500_.jpg', 'https://images.pexels.com/photos/7510454/pexels-photo-7510454.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `deleted_at`) VALUES
(1, 'Cartoon', NULL),
(2, 'Thriller', NULL),
(3, 'Horror', NULL),
(4, 'Romance', NULL),
(5, 'Top 6', NULL),
(6, 'Coming soon', NULL),
(7, 'Cottage Door1', '2024-06-17 18:05:24'),
(8, 'jhv', '2024-06-20 23:25:02'),
(9, 'testaboutbook', '2024-06-20 23:57:25'),
(10, 'testcate', '2024-06-22 22:51:36'),
(11, 'test02', '2024-06-23 13:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `book_id`, `user_id`, `comment`, `is_approved`, `created_at`, `status`) VALUES
(18, 5, 25, 'gfds', 1, '2024-06-19 13:22:22', 'approved'),
(22, 7, 24, 'iuygf', 1, '2024-06-19 14:16:33', 'approved'),
(23, 6, 24, 'mnbv', 1, '2024-06-19 14:17:31', 'approved'),
(43, 9, 24, 'm', 0, '2024-06-19 14:54:07', 'approved'),
(66, 3, 24, 'HI', 1, '2024-06-22 14:19:55', 'approved'),
(70, 13, 24, 'cold', 1, '2024-06-23 12:32:58', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `private_notes`
--

CREATE TABLE `private_notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `private_notes`
--

INSERT INTO `private_notes` (`id`, `user_id`, `book_id`, `note`, `created_at`, `updated_at`) VALUES
(13, 24, 8, 'nbk', '2024-06-21 16:12:12', '2024-06-21 16:12:12'),
(21, 24, 5, 'hii', '2024-06-22 10:33:35', '2024-06-22 14:59:45'),
(24, 24, 5, 'lkj', '2024-06-22 11:18:26', '2024-06-22 11:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `surname`, `role`) VALUES
(1, 'ivana', 'ivana@kiol.com', '$2y$10$3Jf2CFfHYKsVGRBEgZInp.4/QtyDVCiR01dXv9GL2ZtCPWfSYA6Fi', 'jovanovska', 'user'),
(3, 'Iva', 'Iva@lvana.com', '$2y$10$ydEEpCQ62tncIj/0sj91KOtRHHwYc2wyPZvW5mP0ZTb/8s979Hnly', 'Ivanova', 'user'),
(4, 'Kate', 'kate@lor.com', '$2y$10$5mW4RcxogE0hGlDKzRpcmefophznAx/EeaQ1xxz7JDdJQ9y27SxLi', 'stojanova', 'admin'),
(22, 'Katerina', 'kate@loren.com', '$2y$10$o0J//CFc1ogafgWMgE24Lu2Tl4JVPYRpuN/oHmsOAwZ/pvVz.oQkK', 'stojanov', 'user'),
(23, 'jana', 'jana@lorova.com', '$2y$10$/yF4az4Lfy7i7z1UpIx8JOW0rEcLd/fOnq9Cyt4rVK53TczbvHYZ2', 'jovanovic', 'user'),
(24, 'Jovana', 'jovana@lor.com', '$2y$10$5xWMgqvbbp7luMi1stgNZunWwXCbW22nEgZGlTjYpZ1pN1XFOhkUq', 'lor', 'user'),
(25, 'Maja', 'maja@ivanov.com', '$2y$10$k3fCH3tQpmx5vSLgVDaaUuML8an6j9bNrZUtORfaofDbOiw603QVO', 'ivanov', 'user'),
(26, 'jovan', 'ivan@jovanov.com', '$2y$10$SHVWlOVopLvZQuMiEtXXYux.w9oYgW2SJvd/02DQZAq./p/XVhomW', 'jovanov', 'user'),
(27, 'Mario', 'mario@mario.com', '$2y$10$F2CmCOxCHnB5n/SbOcEmoe3/1b/qRZYJxlUssHQYz.LMglUBj5wr6', 'Valer', 'user'),
(28, 'Marko', 'Marko@lor.com', '$2y$10$itkg7vILGFATL7VVz5dxLOD4GA0jsQHblry.weW6Ppi2XFKASMzoW', 'Mar', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `private_notes`
--
ALTER TABLE `private_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `private_notes`
--
ALTER TABLE `private_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `private_notes`
--
ALTER TABLE `private_notes`
  ADD CONSTRAINT `private_notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `private_notes_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
