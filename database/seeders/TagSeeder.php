<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $mainLang = Language::where('main', true)->firstOrFail();
        $pl = Language::where('code', 'pl')->firstOrFail();
        $de = Language::where('code', 'de')->firstOrFail();
        $fr = Language::where('code', 'fr')->firstOrFail();
        $en = Language::where('code', 'en')->firstOrFail();
        $tags = [
            // Twoje pierwotne tagi
            '18+' => ['en' => '18+', 'pl' => '18+', 'de' => '18+', 'fr' => '18+'],
            'games' => ['en' => 'games', 'pl' => 'gry', 'de' => 'Spiele', 'fr' => 'jeux'],
            'anime' => ['en' => 'anime', 'pl' => 'anime', 'de' => 'Anime', 'fr' => 'anime'],
            'filter' => ['en' => 'filter', 'pl' => 'filtr', 'de' => 'Filter', 'fr' => 'filtre'],
            'fwb' => ['en' => 'fwb', 'pl' => 'fwb', 'de' => 'FWB', 'fr' => 'sex friend'],
            'music' => ['en' => 'music', 'pl' => 'muzyka', 'de' => 'Musik', 'fr' => 'musique'],
            'memes' => ['en' => 'memes', 'pl' => 'memes', 'de' => 'Memes', 'fr' => 'mèmes'],
            'movies' => ['en' => 'movies', 'pl' => 'filmy', 'de' => 'Filme', 'fr' => 'films'],
            'sport' => ['en' => 'sport', 'pl' => 'sport', 'de' => 'Sport', 'fr' => 'sport'],
            'travel' => ['en' => 'travel', 'pl' => 'podróże', 'de' => 'Reisen', 'fr' => 'voyages'],
            'food' => ['en' => 'food', 'pl' => 'jedzenie', 'de' => 'Essen', 'fr' => 'nourriture'],
            'books' => ['en' => 'books', 'pl' => 'książki', 'de' => 'Bücher', 'fr' => 'livres'],

            // Dodane tagi (Zestaw 1)
            'art' => ['en' => 'art', 'pl' => 'sztuka', 'de' => 'Kunst', 'fr' => 'art'],
            'tech' => ['en' => 'technology', 'pl' => 'technologia', 'de' => 'Technologie', 'fr' => 'technologie'],
            'science' => ['en' => 'science', 'pl' => 'nauka', 'de' => 'Wissenschaft', 'fr' => 'science'],
            'fashion' => ['en' => 'fashion', 'pl' => 'moda', 'de' => 'Mode', 'fr' => 'mode'],
            'nature' => ['en' => 'nature', 'pl' => 'natura', 'de' => 'Natur', 'fr' => 'nature'],
            'politics' => ['en' => 'politics', 'pl' => 'polityka', 'de' => 'Politik', 'fr' => 'politique'],
            'diy' => ['en' => 'DIY/crafts', 'pl' => 'majsterkowanie', 'de' => 'Basteln/Heimwerken', 'fr' => 'bricolage'],
            'fitness' => ['en' => 'fitness', 'pl' => 'fitness/siłka', 'de' => 'Fitness', 'fr' => 'fitness'],
            'pets' => ['en' => 'pets', 'pl' => 'zwierzęta', 'de' => 'Haustiere', 'fr' => 'animaux'],
            'philosophy' => ['en' => 'philosophy', 'pl' => 'filozofia', 'de' => 'Philosophie', 'fr' => 'philosophie'],
            'finance' => ['en' => 'finance/investing', 'pl' => 'finanse/inwestycje', 'de' => 'Finanzen/Investieren', 'fr' => 'finance/investissement'],
            'coding' => ['en' => 'coding/programming', 'pl' => 'programowanie', 'de' => 'Codierung/Programmierung', 'fr' => 'programmation'],
            'photography' => ['en' => 'photography', 'pl' => 'fotografia', 'de' => 'Fotografie', 'fr' => 'photographie'],
            'cars' => ['en' => 'cars/motorcycles', 'pl' => 'auta/motocykle', 'de' => 'Autos/Motorräder', 'fr' => 'voitures/motos'],
            'writing' => ['en' => 'writing', 'pl' => 'pisanie/poezja', 'de' => 'Schreiben/Poesie', 'fr' => 'écriture/poésie'],

            // Dodane tagi (Zestaw 2)
            'gossip' => ['en' => 'gossip', 'pl' => 'plotki', 'de' => 'Gerüchte', 'fr' => 'potins'],
            'business' => ['en' => 'business/startup', 'pl' => 'biznes/startup', 'de' => 'Geschäft/Startup', 'fr' => 'affaires/startup'],
            'wellness' => ['en' => 'mental wellness', 'pl' => 'zdrowie psychiczne', 'de' => 'Mentale Gesundheit', 'fr' => 'bien-être mental'],
            'comics' => ['en' => 'comics/manga', 'pl' => 'komiksy/manga', 'de' => 'Comics/Manga', 'fr' => 'bande dessinée/manga'],
            'history' => ['en' => 'history', 'pl' => 'historia', 'de' => 'Geschichte', 'fr' => 'histoire'],
            'cryptos' => ['en' => 'cryptos/blockchain', 'pl' => 'krypto/blockchain', 'de' => 'Kryptos/Blockchain', 'fr' => 'cryptos/blockchain'],
            'language' => ['en' => 'language learning', 'pl' => 'nauka języków', 'de' => 'Sprachen lernen', 'fr' => 'apprentissage des langues'],
            'cooking' => ['en' => 'cooking/baking', 'pl' => 'gotowanie/pieczenie', 'de' => 'Kochen/Backen', 'fr' => 'cuisine/pâtisserie'],
            'horror' => ['en' => 'horror/thriller', 'pl' => 'horror/thriller', 'de' => 'Horror/Thriller', 'fr' => 'horreur/thriller'],
            'home' => ['en' => 'home design/DIY', 'pl' => 'projektowanie wnętrz/DIY', 'de' => 'Wohndesign/DIY', 'fr' => 'décoration/bricolage'],
        ];

        foreach ($tags as $translations) {
            $mainTag = null;

            foreach ($translations as $language => $tag) {
                if ($mainLang->code == $language) {
                    try {
                        $mainTag = Tag::create([
                            'name' => $tag,
                            'language_id' => $mainLang->id,
                            'source_uuid' => null
                        ]);
                        $mainTag->source_uuid = $mainTag->uuid;
                        $mainTag->save();
                    }catch (\Throwable $th) {
                        dd($th);
                    }

                }
                if ($mainLang->code == $language) {
                    continue;
                }
                $lang_id= Language::where('code', $language)->firstOrFail();
                $tag = Tag::create([
                    'name' => $tag,
                    'language_id' => $lang_id->id,
                    'source_uuid' => $mainTag->uuid,
                ]);

            }

        }
    }
}
