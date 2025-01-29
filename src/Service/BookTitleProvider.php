<?php

namespace App\Service;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Faker\Provider\Base;

class BookTitleProvider extends Base
{
    protected static $bookPrefixes = [
        'en_US' => ['The', 'A', 'My', 'Our', 'Their', 'Beyond', 'Inside', 'Through', 'Upon', 'Before', 'After', 'Without', 'Behind', 'Beneath'],
        'fr_FR' => ['Le', 'La', 'Les', 'Un', 'Une', 'Mon', 'Notre', 'Votre', 'Dans', 'Au-delà', 'Après', 'Avant', 'Sans', 'Sous'],
        'de_DE' => ['Der', 'Die', 'Das', 'Ein', 'Eine', 'Mein', 'Unser', 'Ihre', 'Durch', 'Über', 'Nach', 'Vor', 'Ohne', 'Unter'],
        'es_ES' => ['El', 'La', 'Los', 'Las', 'Un', 'Una', 'Mi', 'Nuestro', 'Su', 'Entre', 'Después', 'Antes', 'Sin', 'Bajo']
    ];

    protected static $bookPatterns = [
        'en_US' => [
            '{prefix} {noun} of {noun}',
            '{prefix} {adjective} {noun}',
            '{noun} and {noun}',
            'How to {verb} a {noun}',
            'When {noun}s {verb}',
            '{prefix} {adjective} {noun} of {place}',
            '{number} {noun}s to {verb}',
            '{verb}ing {prefix} {noun}',
            '{prefix} {profession}\'s {noun}',
            '{prefix} {time} of {noun}',
            '{prefix} Last {noun}',
            'Between {noun} and {noun}',
            '{noun}s of {place}',
            '{prefix} {noun} {preposition} {time}',
            'Where {noun}s {verb}'
        ],
        'fr_FR' => [
            '{prefix} {noun} de {noun}',
            '{prefix} {noun} {adjective}',
            '{prefix} {adjective} {noun}',
            '{noun} et {noun}',
            'Comment {verb} un {noun}',
            '{prefix} {noun} du {place}',
            '{number} {noun}s pour {verb}',
            '{prefix} {time} des {noun}s',
            '{prefix} {profession} de {place}',
            'Entre {noun} et {noun}',
            '{prefix} Dernier {noun}',
            'Où les {noun}s {verb}ent'
        ],
        'de_DE' => [
            '{prefix} {noun} der {noun}',
            '{prefix} {adjective} {noun}',
            '{noun} und {noun}',
            'Wie man {noun} {verb}',
            '{prefix} {noun} von {place}',
            '{number} {noun} zum {verb}',
            '{prefix} {time} des {noun}s',
            '{prefix} {profession} aus {place}',
            'Zwischen {noun} und {noun}',
            '{prefix} letzte {noun}',
            'Wo {noun}en {verb}en'
        ]
    ];

    protected static $prepositions = [
        'en_US' => ['in', 'during', 'before', 'after', 'beyond', 'within', 'without'],
        'fr_FR' => ['dans', 'pendant', 'avant', 'après', 'au-delà', 'avec', 'sans'],
        'de_DE' => ['in', 'während', 'vor', 'nach', 'jenseits', 'mit', 'ohne']
    ];


    protected static $nouns = [
        'en_US' => ['Heart', 'Mountain', 'Sea', 'Dream', 'Shadow', 'Garden', 'Storm', 'Secret', 'Dragon', 'Star', 'Moon', 'Tree', 'River', 'Bird', 'Sword'],
        'fr_FR' => ['Coeur', 'Montagne', 'Mer', 'Rêve', 'Ombre', 'Jardin', 'Tempête', 'Secret', 'Dragon', 'Étoile', 'Lune', 'Arbre', 'Rivière', 'Oiseau', 'Épée'],
        'de_DE' => ['Herz', 'Berg', 'Meer', 'Traum', 'Schatten', 'Garten', 'Sturm', 'Geheimnis', 'Drache', 'Stern', 'Mond', 'Baum', 'Fluss', 'Vogel', 'Schwert']
    ];

    protected static $verbs = [
        'en_US' => ['Dance', 'Sing', 'Dream', 'Fight', 'Love', 'Remember', 'Discover', 'Create', 'Explore', 'Find', 'Save', 'Learn', 'Grow', 'Build', 'Chase'],
        'fr_FR' => ['Danser', 'Chanter', 'Rêver', 'Combattre', 'Aimer', 'Se souvenir', 'Découvrir', 'Créer', 'Explorer', 'Trouver', 'Sauver', 'Apprendre', 'Grandir', 'Construire', 'Poursuivre'],
        'de_DE' => ['Tanzen', 'Singen', 'Träumen', 'Kämpfen', 'Lieben', 'Erinnern', 'Entdecken', 'Erschaffen', 'Erkunden', 'Finden', 'Retten', 'Lernen', 'Wachsen', 'Bauen', 'Jagen']
    ];

    protected static $adjectives = [
        'en_US' => ['Lost', 'Hidden', 'Silent', 'Ancient', 'Eternal', 'Wild', 'Broken', 'Sacred', 'Dark', 'Bright', 'Golden', 'Secret', 'Mysterious', 'Forgotten', 'Endless'],
        'fr_FR' => ['Perdu', 'Caché', 'Silencieux', 'Ancien', 'Éternel', 'Sauvage', 'Brisé', 'Sacré', 'Sombre', 'Lumineux', 'Doré', 'Secret', 'Mystérieux', 'Oublié', 'Infini'],
        'de_DE' => ['Verloren', 'Verborgen', 'Still', 'Alt', 'Ewig', 'Wild', 'Gebrochen', 'Heilig', 'Dunkel', 'Hell', 'Golden', 'Geheim', 'Geheimnisvoll', 'Vergessen', 'Endlos']
    ];

    protected static $places = [
        'en_US' => ['Avalon', 'Atlantis', 'Eden', 'Olympus', 'Babylon', 'Venice', 'Paris', 'London', 'Rome', 'Alexandria', 'Tokyo', 'Cairo', 'Athens', 'Dublin', 'Madrid'],
        'fr_FR' => ['Avalon', 'Atlantide', 'Éden', 'Olympe', 'Babylone', 'Venise', 'Paris', 'Londres', 'Rome', 'Alexandrie', 'Tokyo', 'Le Caire', 'Athènes', 'Dublin', 'Madrid'],
        'de_DE' => ['Avalon', 'Atlantis', 'Eden', 'Olymp', 'Babylon', 'Venedig', 'Paris', 'London', 'Rom', 'Alexandria', 'Tokio', 'Kairo', 'Athen', 'Dublin', 'Madrid']
    ];

    protected static $professions = [
        'en_US' => ['Wizard', 'Knight', 'Warrior', 'Scholar', 'King', 'Queen', 'Monk', 'Witch', 'Healer', 'Hunter', 'Explorer', 'Poet', 'Artist', 'Sailor', 'Merchant'],
        'fr_FR' => ['Sorcier', 'Chevalier', 'Guerrier', 'Érudit', 'Roi', 'Reine', 'Moine', 'Sorcière', 'Guérisseur', 'Chasseur', 'Explorateur', 'Poète', 'Artiste', 'Marin', 'Marchand'],
        'de_DE' => ['Zauberer', 'Ritter', 'Krieger', 'Gelehrter', 'König', 'Königin', 'Mönch', 'Hexe', 'Heiler', 'Jäger', 'Entdecker', 'Dichter', 'Künstler', 'Seemann', 'Händler']
    ];

    protected static $times = [
        'en_US' => ['Dawn', 'Dusk', 'Night', 'Day', 'Winter', 'Summer', 'Spring', 'Autumn', 'Century', 'Year', 'Month', 'Season', 'Moment', 'Hour', 'Age'],
        'fr_FR' => ['Aube', 'Crépuscule', 'Nuit', 'Jour', 'Hiver', 'Été', 'Printemps', 'Automne', 'Siècle', 'Année', 'Mois', 'Saison', 'Moment', 'Heure', 'Âge'],
        'de_DE' => ['Morgendämmerung', 'Abenddämmerung', 'Nacht', 'Tag', 'Winter', 'Sommer', 'Frühling', 'Herbst', 'Jahrhundert', 'Jahr', 'Monat', 'Jahreszeit', 'Moment', 'Stunde', 'Zeitalter']
    ];

    protected static $numbers = [
        'en_US' => ['Seven', 'Three', 'Thousand', 'Million', 'Hundred', 'Five', 'Nine', 'Ten', 'Twenty', 'Twelve', 'Fifty', 'Four', 'Six', 'Eight', 'One'],
        'fr_FR' => ['Sept', 'Trois', 'Mille', 'Million', 'Cent', 'Cinq', 'Neuf', 'Dix', 'Vingt', 'Douze', 'Cinquante', 'Quatre', 'Six', 'Huit', 'Un'],
        'de_DE' => ['Sieben', 'Drei', 'Tausend', 'Million', 'Hundert', 'Fünf', 'Neun', 'Zehn', 'Zwanzig', 'Zwölf', 'Fünfzig', 'Vier', 'Sechs', 'Acht', 'Eins']
    ];
    protected static $genres = [
        'en_US' => ['Fantasy', 'Mystery', 'Romance', 'Science Fiction', 'Historical Fiction', 'Horror', 'Adventure', 'Literary Fiction'],
        'fr_FR' => ['Fantaisie', 'Mystère', 'Romance', 'Science-Fiction', 'Fiction Historique', 'Horreur', 'Aventure', 'Fiction Littéraire'],
        'de_DE' => ['Fantasie', 'Krimi', 'Liebesroman', 'Science-Fiction', 'Historischer Roman', 'Horror', 'Abenteuer', 'Literarische Fiktion']
    ];

    public function __construct(FakerGenerator $faker)
    {
        parent::__construct($faker);
        $this->defaultLocale = $faker->locale ?? 'en_US';
    }

    public function bookTitle(?string $locale = null): string
    {
        $locale = $locale ?? $this->defaultLocale;
        if (!isset(static::$bookPatterns[$locale])) {
            $locale = 'en_US';
        }

        $pattern = $this->randomElement(static::$bookPatterns[$locale]);

        return preg_replace_callback('/{(\w+)}/', function($matches) use ($locale) {
            $type = $matches[1];

            $arrays = [
                'prefix' => 'bookPrefixes',
                'noun' => 'nouns',
                'verb' => 'verbs',
                'adjective' => 'adjectives',
                'place' => 'places',
                'profession' => 'professions',
                'time' => 'times',
                'number' => 'numbers',
                'preposition' => 'prepositions',
                'genre' => 'genres'
            ];

            if (isset($arrays[$type])) {
                $arrayName = $arrays[$type];
                return $this->randomElement(static::${$arrayName}[$locale] ?? static::${$arrayName}['en_US']);
            }

            return $matches[0];
        }, $pattern);
    }

    public function bookTitleWithGenre(?string $locale = null): array
    {
        $locale = $locale ?? $this->defaultLocale;
        return [
            'title' => $this->bookTitle($locale),
            'genre' => $this->randomElement(static::$genres[$locale] ?? static::$genres['en_US'])
        ];
    }
}