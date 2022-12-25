<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages_list = array(
            array("name" => "Afrikaans", "code" => "af"),
            array("name" => "Albanian - shqip", "code" => "sq"),
            array("name" => "Arabic - العربية", "code" => "ar"),
            array("name" => "Armenian - հայերեն", "code" => "am"),
            array("name" => "Azerbaijani - azərbaycan dili", "code" => "az"),
            array("name" => "Belarusian - беларуская", "code" => "be"),
            array("name" => "Bosnian - bosanski", "code" => "bs"),
            array("name" => "Bulgarian - български", "code" => "bg"),
            array("name" => "Chinese - 中文", "code" => "zh"),
            array("name" => "Croatian - hrvatski", "code" => "hr"),
            array("name" => "Czech - čeština", "code" => "cs"),
            array("name" => "Danish - dansk", "code" => "da"),
            array("name" => "English", "code" => "en"),
            array("name" => "Estonian - eesti", "code" => "et"),
            array("name" => "Filipino", "code" => "fil"),
            array("name" => "Finnish - suomi", "code" => "fi"),
            array("name" => "French - français", "code" => "fr"),
            array("name" => "German - Deutsch", "code" => "de"),
            array("name" => "Greek - Ελληνικά", "code" => "el"),
            array("name" => "Hebrew - עברית", "code" => "he"),
            array("name" => "Hindi - हिन्दी", "code" => "hi"),
            array("name" => "Hungarian - magyar", "code" => "hu"),
            array("name" => "Icelandic - íslenska", "code" => "is"),
            array("name" => "Irish - Gaeilge", "code" => "ga"),
            array("name" => "Italian - italiano", "code" => "it"),
            array("name" => "Japanese - 日本語", "code" => "ja"),
            array("name" => "Kazakh - қазақ тілі", "code" => "kk"),
            array("name" => "Korean - 한국어", "code" => "ko"),
            array("name" => "Lao - ລາວ", "code" => "lo"),
            array("name" => "Latvian - latviešu", "code" => "lv"),
            array("name" => "Lithuanian - lietuvių", "code" => "lt"),
            array("name" => "Macedonian - македонски", "code" => "mk"),
            array("name" => "Malay - Bahasa Melayu", "code" => "ms"),
            array("name" => "Maltese - Malti", "code" => "mt"),
            array("name" => "Mongolian - монгол", "code" => "mn"),
            array("name" => "Nepali - नेपाली", "code" => "ne"),
            array("name" => "Norwegian Bokmål - norsk bokmål", "code" => "nb"),
            array("name" => "Polish - polski", "code" => "pl"),
            array("name" => "Portuguese - português", "code" => "pt"),
            array("name" => "Romanian - română", "code" => "ro"),
            array("name" => "Russian - русский", "code" => "ru"),
            array("name" => "Serbian - српски", "code" => "sr"),
            array("name" => "Slovak - slovenčina", "code" => "sk"),
            array("name" => "Slovenian - slovenščina", "code" => "sl"),
            array("name" => "Spanish - español", "code" => "es"),
            array("name" => "Swahili - Kiswahili", "code" => "sw"),
            array("name" => "Swedish - svenska", "code" => "sv"),
            array("name" => "Tajik - тоҷикӣ", "code" => "tg"),
            array("name" => "Thai - ไทย", "code" => "th"),
            array("name" => "Turkish - Türkçe", "code" => "tr"),
            array("name" => "Turkmen", "code" => "tk"),
            array("name" => "Ukrainian - українська", "code" => "uk"),
            array("name" => "Urdu - اردو", "code" => "ur"),
            array("name" => "Uzbek - o‘zbek", "code" => "uz"),
            array("name" => "Vietnamese - Tiếng Việt", "code" => "vi"),
            array("name" => "Yoruba - Èdè Yorùbá", "code" => "yo"),
        );

        foreach ($languages_list as $lang) {
            DB::table('languages')->insert([
                'name' => $lang['name'],
                'code' => $lang['code'],
            ]);
        }
    }
}
