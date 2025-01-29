<?php

namespace App\Service;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Faker\Provider\Base;

class ReviewProvider extends Base
{

    /**
     * @var FakerGenerator
     */
    protected $faker;

    protected static $reviewTemplates = [
        'en_US' => [
            "{initial_thought} {detail}. {emotion}. {recommendation}",
            "From {reading_perspective}, {sentiment}. {specific_point}. {conclusion}",
            "{strength} {detail}. {impact}. {final_verdict}",
            "{time_marker} {reading_experience}. {highlight}. {closing_thought}",
            "{rating_intro} {rating}/5. {explanation}. {would_recommend}",
            "As a {reader_type}, {opinion}. {critique}. {summary}"
        ],
        'fr_FR' => [
            "{initial_thought} {detail}. {emotion}. {recommendation}",
            "D'un point de vue {reading_perspective}, {sentiment}. {specific_point}. {conclusion}",
            "{strength} {detail}. {impact}. {final_verdict}",
            "{time_marker} {reading_experience}. {highlight}. {closing_thought}",
            "{rating_intro} {rating}/5. {explanation}. {would_recommend}",
            "En tant que {reader_type}, {opinion}. {critique}. {summary}"
        ],
        'de_DE' => [
            "{initial_thought} {detail}. {emotion}. {recommendation}",
            "Aus {reading_perspective} {sentiment}. {specific_point}. {conclusion}",
            "{strength} {detail}. {impact}. {final_verdict}",
            "{time_marker} {reading_experience}. {highlight}. {closing_thought}",
            "{rating_intro} {rating}/5. {explanation}. {would_recommend}",
            "Als {reader_type} {opinion}. {critique}. {summary}"
        ]
    ];

    protected static $initial_thoughts = [
        'en_US' => [
            'This book is a masterpiece',
            'An incredible journey',
            'A fascinating read',
            'What a discovery',
            'A groundbreaking work',
            'An absolute gem',
            'A powerful narrative',
            'A unique perspective'
        ],
        'fr_FR' => [
            'Ce livre est un chef-d\'œuvre',
            'Un voyage incroyable',
            'Une lecture fascinante',
            'Quelle découverte',
            'Une œuvre révolutionnaire',
            'Une véritable perle',
            'Un récit puissant',
            'Une perspective unique'
        ],
        'de_DE' => [
            'Dieses Buch ist ein Meisterwerk',
            'Eine unglaubliche Reise',
            'Eine faszinierende Lektüre',
            'Was für eine Entdeckung',
            'Ein bahnbrechendes Werk',
            'Ein absolutes Juwel',
            'Eine kraftvolle Erzählung',
            'Eine einzigartige Perspektive'
        ]
    ];

    protected static $details = [
        'en_US' => [
            'The writing style is impeccable',
            'The characters are well-developed',
            'The plot is intricate and engaging',
            'The pacing is perfect',
            'The world-building is exceptional'
        ],
        'fr_FR' => [
            'Le style d\'écriture est impeccable',
            'Les personnages sont bien développés',
            'L\'intrigue est complexe et captivante',
            'Le rythme est parfait',
            'La construction du monde est exceptionnelle'
        ],
        'de_DE' => [
            'Der Schreibstil ist tadellos',
            'Die Charaktere sind gut entwickelt',
            'Die Handlung ist komplex und fesselnd',
            'Das Tempo ist perfekt',
            'Der Weltaufbau ist außergewöhnlich'
        ]
    ];

    protected static $emotions = [
        'en_US' => [
            'It moved me deeply',
            'I was completely absorbed',
            'I couldn\'t put it down',
            'It left me speechless',
            'I was thoroughly impressed'
        ],
        'fr_FR' => [
            'Cela m\'a profondément ému',
            'J\'étais complètement absorbé',
            'Impossible de le poser',
            'J\'en suis resté sans voix',
            'J\'ai été complètement impressionné'
        ],
        'de_DE' => [
            'Es hat mich tief bewegt',
            'Ich war völlig gefesselt',
            'Ich konnte es nicht weglegen',
            'Es hat mich sprachlos gemacht',
            'Ich war durchweg beeindruckt'
        ]
    ];

    protected static $recommendations = [
        'en_US' => [
            'Highly recommended for all readers',
            'A must-read for fans of the genre',
            'I would recommend this to everyone',
            'Don\'t miss this one'
        ],
        'fr_FR' => [
            'Fortement recommandé pour tous les lecteurs',
            'À lire absolument pour les fans du genre',
            'Je le recommande à tout le monde',
            'Ne manquez pas celui-ci'
        ],
        'de_DE' => [
            'Sehr empfehlenswert für alle Leser',
            'Ein Muss für Fans des Genres',
            'Ich würde es jedem empfehlen',
            'Verpassen Sie dieses Buch nicht'
        ]
    ];

    protected static $ratings = [
        'en_US' => ['Giving this', 'I rate this', 'This deserves', 'My rating'],
        'fr_FR' => ['Je donne', 'Je note', 'Cela mérite', 'Ma note'],
        'de_DE' => ['Ich gebe', 'Ich bewerte dies mit', 'Dies verdient', 'Meine Bewertung']
    ];

    protected static $strengths = [
        'en_US' => [
            'The storytelling is remarkable',
            'The author\'s vision shines through',
            'The narrative structure is brilliant',
            'The attention to detail is impressive',
            'The creative approach stands out'
        ],
        'fr_FR' => [
            'La narration est remarquable',
            'La vision de l\'auteur brille',
            'La structure narrative est brillante',
            'L\'attention aux détails est impressionnante',
            'L\'approche créative se démarque'
        ],
        'de_DE' => [
            'Das Storytelling ist bemerkenswert',
            'Die Vision des Autors strahlt durch',
            'Die Erzählstruktur ist brillant',
            'Die Liebe zum Detail ist beeindruckend',
            'Der kreative Ansatz sticht hervor'
        ]
    ];

    protected static $impacts = [
        'en_US' => [
            'It will stay with readers long after finishing',
            'The story resonates on multiple levels',
            'It challenges conventional thinking',
            'The impact is profound and lasting',
            'It creates a lasting impression'
        ],
        'fr_FR' => [
            'Il restera avec les lecteurs longtemps après la fin',
            'L\'histoire résonne à plusieurs niveaux',
            'Il remet en question la pensée conventionnelle',
            'L\'impact est profond et durable',
            'Il crée une impression durable'
        ],
        'de_DE' => [
            'Es wird die Leser noch lange nach dem Lesen begleiten',
            'Die Geschichte wirkt auf mehreren Ebenen',
            'Es fordert konventionelles Denken heraus',
            'Die Wirkung ist tiefgreifend und nachhaltig',
            'Es hinterlässt einen bleibenden Eindruck'
        ]
    ];

    protected static $final_verdicts = [
        'en_US' => [
            'A triumph in every sense',
            'An outstanding achievement',
            'A remarkable addition to the genre',
            'A truly memorable experience',
            'An exemplary work of literature'
        ],
        'fr_FR' => [
            'Un triomphe à tous points de vue',
            'Une réalisation exceptionnelle',
            'Un ajout remarquable au genre',
            'Une expérience vraiment mémorable',
            'Une œuvre littéraire exemplaire'
        ],
        'de_DE' => [
            'Ein Triumph in jeder Hinsicht',
            'Eine herausragende Leistung',
            'Eine bemerkenswerte Ergänzung des Genres',
            'Eine wirklich unvergessliche Erfahrung',
            'Ein beispielhaftes literarisches Werk'
        ]
    ];

    protected static $time_markers = [
        'en_US' => [
            'After finishing this book',
            'Having spent time with this story',
            'Upon completing this journey',
            'After immersing myself in this work',
            'Following this reading experience'
        ],
        'fr_FR' => [
            'Après avoir terminé ce livre',
            'Après avoir passé du temps avec cette histoire',
            'En terminant ce voyage',
            'Après m\'être immergé dans cette œuvre',
            'Suite à cette expérience de lecture'
        ],
        'de_DE' => [
            'Nach dem Lesen dieses Buches',
            'Nach der Zeit mit dieser Geschichte',
            'Nach Abschluss dieser Reise',
            'Nach dem Eintauchen in dieses Werk',
            'Nach dieser Leseerfahrung'
        ]
    ];

    protected static $reading_experiences = [
        'en_US' => [
            'I found myself completely engrossed',
            'I was transported to another world',
            'I experienced a range of emotions',
            'I discovered something truly special',
            'I was captivated from start to finish'
        ],
        'fr_FR' => [
            'Je me suis retrouvé complètement absorbé',
            'J\'ai été transporté dans un autre monde',
            'J\'ai vécu toute une gamme d\'émotions',
            'J\'ai découvert quelque chose de vraiment spécial',
            'J\'ai été captivé du début à la fin'
        ],
        'de_DE' => [
            'Ich war völlig versunken',
            'Ich wurde in eine andere Welt versetzt',
            'Ich erlebte eine Palette von Emotionen',
            'Ich entdeckte etwas wirklich Besonderes',
            'Ich war von Anfang bis Ende gefesselt'
        ]
    ];

    protected static $highlights = [
        'en_US' => [
            'The character development stands out',
            'The plot twists are masterfully crafted',
            'The themes are expertly woven throughout',
            'The dialogue is particularly memorable',
            'The atmosphere is perfectly captured'
        ],
        'fr_FR' => [
            'Le développement des personnages se démarque',
            'Les rebondissements sont magistralement construits',
            'Les thèmes sont habilement tissés',
            'Les dialogues sont particulièrement mémorables',
            'L\'atmosphère est parfaitement captée'
        ],
        'de_DE' => [
            'Die Charakterentwicklung sticht hervor',
            'Die Wendungen sind meisterhaft gestaltet',
            'Die Themen sind gekonnt verwoben',
            'Die Dialoge sind besonders einprägsam',
            'Die Atmosphäre ist perfekt eingefangen'
        ]
    ];

    protected static $closing_thoughts = [
        'en_US' => [
            'I can\'t wait to read it again',
            'It\'s a story that will stay with me',
            'I\'m already recommending it to friends',
            'It exceeded all my expectations',
            'It\'s a true literary achievement'
        ],
        'fr_FR' => [
            'J\'ai hâte de le relire',
            'C\'est une histoire qui restera avec moi',
            'Je le recommande déjà à mes amis',
            'Il a dépassé toutes mes attentes',
            'C\'est une véritable réussite littéraire'
        ],
        'de_DE' => [
            'Ich kann es kaum erwarten, es wieder zu lesen',
            'Es ist eine Geschichte, die bleiben wird',
            'Ich empfehle es bereits Freunden',
            'Es hat alle meine Erwartungen übertroffen',
            'Es ist eine wahre literarische Leistung'
        ]
    ];

    protected static $reading_perspectives = [
        'en_US' => [
            'a literary enthusiast',
            'an avid reader',
            'someone who loves this genre',
            'a careful observer',
            'a passionate bookworm'
        ],
        'fr_FR' => [
            'un passionné de littérature',
            'un lecteur assidu',
            'quelqu\'un qui aime ce genre',
            'un observateur attentif',
            'un passionné de lecture'
        ],
        'de_DE' => [
            'eines Literaturliebhabers',
            'eines begeisterten Lesers',
            'eines Genre-Enthusiasten',
            'eines aufmerksamen Beobachters',
            'eines leidenschaftlichen Bücherwurms'
        ]
    ];

    protected static $sentiments = [
        'en_US' => [
            'this book truly delivers',
            'the story exceeds expectations',
            'the narrative is compelling',
            'the writing is exceptional',
            'the execution is masterful'
        ],
        'fr_FR' => [
            'ce livre tient vraiment ses promesses',
            'l\'histoire dépasse les attentes',
            'le récit est captivant',
            'l\'écriture est exceptionnelle',
            'l\'exécution est magistrale'
        ],
        'de_DE' => [
            'dieses Buch überzeugt wirklich',
            'die Geschichte übertrifft die Erwartungen',
            'die Erzählung ist fesselnd',
            'die Schreibweise ist außergewöhnlich',
            'die Umsetzung ist meisterhaft'
        ]
    ];

    protected static $specific_points = [
        'en_US' => [
            'The character arcs are particularly strong',
            'The pacing keeps you engaged',
            'The themes are thoughtfully explored',
            'The writing style is distinctive',
            'The story structure is innovative'
        ],
        'fr_FR' => [
            'Les arcs des personnages sont particulièrement forts',
            'Le rythme vous maintient engagé',
            'Les thèmes sont explorés avec réflexion',
            'Le style d\'écriture est distinctif',
            'La structure de l\'histoire est innovante'
        ],
        'de_DE' => [
            'Die Charakterbögen sind besonders stark',
            'Das Tempo hält Sie bei der Stange',
            'Die Themen werden durchdacht erkundet',
            'Der Schreibstil ist unverwechselbar',
            'Die Geschichtenstruktur ist innovativ'
        ]
    ];

    protected static $conclusions = [
        'en_US' => [
            'It\'s a remarkable achievement',
            'The book leaves a lasting impression',
            'It\'s a standout in its category',
            'The experience is unforgettable',
            'It\'s truly worth your time'
        ],
        'fr_FR' => [
            'C\'est une réalisation remarquable',
            'Le livre laisse une impression durable',
            'Il se démarque dans sa catégorie',
            'L\'expérience est inoubliable',
            'Ça vaut vraiment le coup'
        ],
        'de_DE' => [
            'Es ist eine bemerkenswerte Leistung',
            'Das Buch hinterlässt einen bleibenden Eindruck',
            'Es sticht in seiner Kategorie hervor',
            'Die Erfahrung ist unvergesslich',
            'Es ist wirklich die Zeit wert'
        ]
    ];

    public function __construct(FakerGenerator $faker)
    {
        $this->faker = $faker;
        parent::__construct($faker);
        $this->defaultLocale = $faker->locale ?? 'en_US';
    }

    public function bookReview(?string $locale = null): string
    {
        $locale = $locale ?? $this->defaultLocale;
        if (!isset(static::$reviewTemplates[$locale])) {
            $locale = 'en_US';
        }

        $template = $this->randomElement(static::$reviewTemplates[$locale]);
        $rating = $this->faker->numberBetween(1, 5);

        return preg_replace_callback('/{(\w+)}/', function($matches) use ($locale, $rating) {
            $type = $matches[1];

            if ($type === 'rating') {
                return $rating;
            }

            $arrays = [
                'initial_thought' => 'initial_thoughts',
                'detail' => 'details',
                'emotion' => 'emotions',
                'recommendation' => 'recommendations',
                'rating_intro' => 'ratings',
                'strength' => 'strengths',
                'impact' => 'impacts',
                'final_verdict' => 'final_verdicts',
                'time_marker' => 'time_markers',
                'reading_experience' => 'reading_experiences',
                'highlight' => 'highlights',
                'closing_thought' => 'closing_thoughts',
                'reading_perspective' => 'reading_perspectives',
                'sentiment' => 'sentiments',
                'specific_point' => 'specific_points',
                'conclusion' => 'conclusions',
                'explanation' => 'details',
                'would_recommend' => 'recommendations',
                'reader_type' => 'reading_perspectives',
                'opinion' => 'sentiments',
                'critique' => 'specific_points',
                'summary' => 'conclusions'
            ];

            if (isset($arrays[$type])) {
                $arrayName = $arrays[$type];
                return $this->randomElement(static::${$arrayName}[$locale] ?? static::${$arrayName}['en_US']);
            }

            return $matches[0];
        }, $template);
    }

    public function bookReviewWithRating(?string $locale = null): array
    {
        $locale = $locale ?? $this->defaultLocale;
        $rating = $this->faker->numberBetween(1, 5);
        return [
            'review' => $this->bookReview($locale),
            'rating' => $rating,
            'verified_purchase' => $this->faker->boolean(70)
        ];
    }
}