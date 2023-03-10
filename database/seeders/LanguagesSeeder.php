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
            array("name" => "Afrikaans", "code" => "af", "native_name" => "Afrikaans", "top" => false),
            array("name" => "Albanian", "code" => "sq", "native_name" => "shqip", "top" => false),
            array("name" => "Amharic", "code" => "am", "native_name" => "አማርኛ", "top" => false),
            array("name" => "Arabic", "code" => "ar", "native_name" => "العربية", "top" => true),
            array("name" => "Aragonese", "code" => "an", "native_name" => "aragonés", "top" => false),
            array("name" => "Armenian", "code" => "hy", "native_name" => "հայերեն", "top" => false),
            array("name" => "Azerbaijani", "code" => "az", "native_name" => "azərbaycan dili", "top" => false),
            array("name" => "Basque", "code" => "eu", "native_name" => "euskara", "top" => false),
            array("name" => "Belarusian", "code" => "be", "native_name" => "беларуская", "top" => false),
            array("name" => "Bengali", "code" => "bn", "native_name" => "বাংলা", "top" => true),
            array("name" => "Bosnian", "code" => "bs", "native_name" => "bosanski", "top" => false),
            array("name" => "Breton", "code" => "br", "native_name" => "brezhoneg", "top" => false),
            array("name" => "Bulgarian", "code" => "bg", "native_name" => "български", "top" => false),
            array("name" => "Catalan", "code" => "ca", "native_name" => "català", "top" => false),
            array("name" => "Chinese", "code" => "zh", "native_name" => "中文", "top" => true),
            array("name" => "Corsican", "code" => "co", "native_name" => "Corsican", "top" => false),
            array("name" => "Croatian", "code" => "hr", "native_name" => "hrvatski", "top" => false),
            array("name" => "Czech", "code" => "cs", "native_name" => "čeština", "top" => false),
            array("name" => "Danish", "code" => "da", "native_name" => "dansk", "top" => false),
            array("name" => "Dutch", "code" => "nl", "native_name" => "Nederlands", "top" => false),
            array("name" => "English", "code" => "en", "native_name" => "English", "top" => true),
            array("name" => "Esperanto", "code" => "eo", "native_name" => "esperanto", "top" => false),
            array("name" => "Estonian", "code" => "et", "native_name" => "eesti", "top" => false),
            array("name" => "Faroese", "code" => "fo", "native_name" => "føroyskt", "top" => false),
            array("name" => "Finnish", "code" => "fi", "native_name" => "suomi", "top" => false),
            array("name" => "French", "code" => "fr", "native_name" => "français", "top" => false),
            array("name" => "Galician", "code" => "gl", "native_name" => "galego", "top" => false),
            array("name" => "Georgian", "code" => "ka", "native_name" => "ქართული", "top" => false),
            array("name" => "German", "code" => "de", "native_name" => "Deutsch", "top" => false),
            array("name" => "Greek", "code" => "el", "native_name" => "Ελληνικά", "top" => false),
            array("name" => "Guarani", "code" => "gn", "native_name" => "Guarani", "top" => false),
            array("name" => "Gujarati", "code" => "gu", "native_name" => "ગુજરાતી", "top" => false),
            array("name" => "Hausa", "code" => "ha", "native_name" => "Hausa", "top" => false),
            array("name" => "Hebrew", "code" => "he", "native_name" => "עברית", "top" => false),
            array("name" => "Hindi", "code" => "hi", "native_name" => "हिन्दी", "top" => true),
            array("name" => "Hungarian", "code" => "hu", "native_name" => "magyar", "top" => false),
            array("name" => "Icelandic", "code" => "is", "native_name" => "íslenska", "top" => false),
            array("name" => "Indonesian", "code" => "id", "native_name" => "Indonesia", "top" => false),
            array("name" => "Interlingua", "code" => "ia", "native_name" => "Interlingua", "top" => false),
            array("name" => "Irish", "code" => "ga", "native_name" => "Gaeilge", "top" => false),
            array("name" => "Italian", "code" => "it", "native_name" => "italiano", "top" => false),
            array("name" => "Japanese", "code" => "ja", "native_name" => "日本語", "top" => true),
            array("name" => "Kannada", "code" => "kn", "native_name" => "ಕನ್ನಡ", "top" => false),
            array("name" => "Kazakh", "code" => "kk", "native_name" => "қазақ тілі", "top" => false),
            array("name" => "Khmer", "code" => "km", "native_name" => "ខ្មែរ", "top" => false),
            array("name" => "Korean", "code" => "ko", "native_name" => "한국어", "top" => false),
            array("name" => "Kurdish", "code" => "ku", "native_name" => "Kurdî", "top" => false),
            array("name" => "Kyrgyz", "code" => "ky", "native_name" => "кыргызча", "top" => false),
            array("name" => "Lao", "code" => "lo", "native_name" => "ລາວ", "top" => false),
            array("name" => "Latvian", "code" => "lv", "native_name" => "latviešu", "top" => false),
            array("name" => "Lingala", "code" => "ln", "native_name" => "lingála", "top" => false),
            array("name" => "Lithuanian", "code" => "lt", "native_name" => "lietuvių", "top" => false),
            array("name" => "Macedonian", "code" => "mk", "native_name" => "македонски", "top" => false),
            array("name" => "Malay", "code" => "ms", "native_name" => "Bahasa Melayu", "top" => false),
            array("name" => "Malayalam", "code" => "ml", "native_name" => "മലയാളം", "top" => false),
            array("name" => "Maltese", "code" => "mt", "native_name" => "Malti", "top" => false),
            array("name" => "Marathi", "code" => "mr", "native_name" => "मराठी", "top" => false),
            array("name" => "Mongolian", "code" => "mn", "native_name" => "монгол", "top" => false),
            array("name" => "Nepali", "code" => "ne", "native_name" => "नेपाली", "top" => false),
            array("name" => "Norwegian", "code" => "no", "native_name" => "norsk", "top" => false),
            array("name" => "Norwegian Bokmål", "code" => "nb", "native_name" => "norsk bokmål", "top" => false),
            array("name" => "Norwegian Nynorsk", "code" => "nn", "native_name" => "nynorsk", "top" => false),
            array("name" => "Occitan", "code" => "oc", "native_name" => "Occitan", "top" => false),
            array("name" => "Oriya", "code" => "or", "native_name" => "ଓଡ଼ିଆ", "top" => false),
            array("name" => "Oromo", "code" => "om", "native_name" => "Oromoo", "top" => false),
            array("name" => "Pashto", "code" => "ps", "native_name" => "پښتو", "top" => false),
            array("name" => "Persian", "code" => "fa", "native_name" => "فارسی", "top" => false),
            array("name" => "Polish", "code" => "pl", "native_name" => "polski", "top" => false),
            array("name" => "Portuguese", "code" => "pt", "native_name" => "português", "top" => true),
            array("name" => "Punjabi", "code" => "pa", "native_name" => "ਪੰਜਾਬੀ", "top" => true),
            array("name" => "Quechua", "code" => "qu", "native_name" => "Quechua", "top" => false),
            array("name" => "Romanian", "code" => "ro", "native_name" => "română", "top" => false),
            array("name" => "Romansh", "code" => "rm", "native_name" => "rumantsch", "top" => false),
            array("name" => "Russian", "code" => "ru", "native_name" => "русский", "top" => true),
            array("name" => "Scottish Gaelic", "code" => "gd", "native_name" => "Scottish Gaelic", "top" => false),
            array("name" => "Serbian", "code" => "sr", "native_name" => "српски", "top" => false),
            array("name" => "Serbo", "code" => "sh", "native_name" => "Croatian", "top" => false),
            array("name" => "Shona", "code" => "sn", "native_name" => "chiShona", "top" => false),
            array("name" => "Sindhi", "code" => "sd", "native_name" => "Sindhi", "top" => false),
            array("name" => "Sinhala", "code" => "si", "native_name" => "සිංහල", "top" => false),
            array("name" => "Slovak", "code" => "sk", "native_name" => "slovenčina", "top" => false),
            array("name" => "Slovenian", "code" => "sl", "native_name" => "slovenščina", "top" => false),
            array("name" => "Somali", "code" => "so", "native_name" => "Soomaali", "top" => false),
            array("name" => "Southern Sotho", "code" => "st", "native_name" => "Southern Sotho", "top" => false),
            array("name" => "Spanish", "code" => "es", "native_name" => "español", "top" => true),
            array("name" => "Sundanese", "code" => "su", "native_name" => "Sundanese", "top" => false),
            array("name" => "Swahili", "code" => "sw", "native_name" => "Kiswahili", "top" => false),
            array("name" => "Swedish", "code" => "sv", "native_name" => "svenska", "top" => false),
            array("name" => "Tajik", "code" => "tg", "native_name" => "тоҷикӣ", "top" => false),
            array("name" => "Tamil", "code" => "ta", "native_name" => "தமிழ்", "top" => false),
            array("name" => "Tatar", "code" => "tt", "native_name" => "Tatar", "top" => false),
            array("name" => "Telugu", "code" => "te", "native_name" => "తెలుగు", "top" => false),
            array("name" => "Thai", "code" => "th", "native_name" => "ไทย", "top" => false),
            array("name" => "Tigrinya", "code" => "ti", "native_name" => "ትግርኛ", "top" => false),
            array("name" => "Tongan", "code" => "to", "native_name" => "lea fakatonga", "top" => false),
            array("name" => "Turkish", "code" => "tr", "native_name" => "Türkçe", "top" => false),
            array("name" => "Turkmen", "code" => "tk", "native_name" => "Turkmen", "top" => false),
            array("name" => "Twi", "code" => "tw", "native_name" => "Twi", "top" => false),
            array("name" => "Ukrainian", "code" => "uk", "native_name" => "українська", "top" => false),
            array("name" => "Urdu", "code" => "ur", "native_name" => "اردو", "top" => false),
            array("name" => "Uyghur", "code" => "ug", "native_name" => "Uyghur", "top" => false),
            array("name" => "Uzbek", "code" => "uz", "native_name" => "o‘zbek", "top" => false),
            array("name" => "Vietnamese", "code" => "vi", "native_name" => "Tiếng Việt", "top" => false),
            array("name" => "Walloon", "code" => "wa", "native_name" => "wa", "top" => false),
            array("name" => "Welsh", "code" => "cy", "native_name" => "Cymraeg", "top" => false),
            array("name" => "Western Frisian", "code" => "fy", "native_name" => "Western Frisian", "top" => false),
            array("name" => "Xhosa", "code" => "xh", "native_name" => "Xhosa", "top" => false),
            array("name" => "Yiddish", "code" => "yi", "native_name" => "Yiddish", "top" => false),
            array("name" => "Yoruba", "code" => "yo", "native_name" => "Èdè Yorùbá", "top" => false),
            array("name" => "Zulu", "code" => "zu", "native_name" => "isiZulu", "top" => false)
        );

        DB::table('languages')->insert($languages_list);
    }
}
