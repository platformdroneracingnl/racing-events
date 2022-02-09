<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        $countries = [
            [
                'id' => 1,
                'code' => 'US',
                'name' => 'United States',
            ],
            [
                'id' => 2,
                'code' => 'CA',
                'name' => 'Canada',
            ],
            [
                'id' => 3,
                'code' => 'AF',
                'name' => 'Afghanistan',
            ],
            [
                'id' => 4,
                'code' => 'AL',
                'name' => 'Albania',
            ],
            [
                'id' => 5,
                'code' => 'DZ',
                'name' => 'Algeria',
            ],
            [
                'id' => 6,
                'code' => 'DS',
                'name' => 'American Samoa',
            ],
            [
                'id' => 7,
                'code' => 'AD',
                'name' => 'Andorra',
            ],
            [
                'id' => 8,
                'code' => 'AO',
                'name' => 'Angola',
            ],
            [
                'id' => 9,
                'code' => 'AI',
                'name' => 'Anguilla',
            ],
            [
                'id' => 10,
                'code' => 'AQ',
                'name' => 'Antarctica',
            ],
            [
                'id' => 11,
                'code' => 'AG',
                'name' => 'Antigua and/or Barbuda',
            ],
            [
                'id' => 12,
                'code' => 'AR',
                'name' => 'Argentina',
            ],
            [
                'id' => 13,
                'code' => 'AM',
                'name' => 'Armenia',
            ],
            [
                'id' => 14,
                'code' => 'AW',
                'name' => 'Aruba',
            ],
            [
                'id' => 15,
                'code' => 'AU',
                'name' => 'Australia',
            ],
            [
                'id' => 16,
                'code' => 'AT',
                'name' => 'Austria',
            ],
            [
                'id' => 17,
                'code' => 'AZ',
                'name' => 'Azerbaijan',
            ],
            [
                'id' => 18,
                'code' => 'BS',
                'name' => 'Bahamas',
            ],
            [
                'id' => 19,
                'code' => 'BH',
                'name' => 'Bahrain',
            ],
            [
                'id' => 20,
                'code' => 'BD',
                'name' => 'Bangladesh',
            ],
            [
                'id' => 21,
                'code' => 'BB',
                'name' => 'Barbados',
            ],
            [
                'id' => 22,
                'code' => 'BY',
                'name' => 'Belarus',
            ],
            [
                'id' => 23,
                'code' => 'BE',
                'name' => 'Belgium',
            ],
            [
                'id' => 24,
                'code' => 'BZ',
                'name' => 'Belize',
            ],
            [
                'id' => 25,
                'code' => 'BJ',
                'name' => 'Benin',
            ],
            [
                'id' => 26,
                'code' => 'BM',
                'name' => 'Bermuda',
            ],
            [
                'id' => 27,
                'code' => 'BT',
                'name' => 'Bhutan',
            ],
            [
                'id' => 28,
                'code' => 'BO',
                'name' => 'Bolivia',
            ],
            [
                'id' => 29,
                'code' => 'BA',
                'name' => 'Bosnia and Herzegovina',
            ],
            [
                'id' => 30,
                'code' => 'BW',
                'name' => 'Botswana',
            ],
            [
                'id' => 31,
                'code' => 'BV',
                'name' => 'Bouvet Island',
            ],
            [
                'id' => 32,
                'code' => 'BR',
                'name' => 'Brazil',
            ],
            [
                'id' => 33,
                'code' => 'IO',
                'name' => 'British lndian Ocean Territory',
            ],
            [
                'id' => 34,
                'code' => 'BN',
                'name' => 'Brunei Darussalam',
            ],
            [
                'id' => 35,
                'code' => 'BG',
                'name' => 'Bulgaria',
            ],
            [
                'id' => 36,
                'code' => 'BF',
                'name' => 'Burkina Faso',
            ],
            [
                'id' => 37,
                'code' => 'BI',
                'name' => 'Burundi',
            ],
            [
                'id' => 38,
                'code' => 'KH',
                'name' => 'Cambodia',
            ],
            [
                'id' => 39,
                'code' => 'CM',
                'name' => 'Cameroon',
            ],
            [
                'id' => 40,
                'code' => 'CV',
                'name' => 'Cape Verde',
            ],
            [
                'id' => 41,
                'code' => 'KY',
                'name' => 'Cayman Islands',
            ],
            [
                'id' => 42,
                'code' => 'CF',
                'name' => 'Central African Republic',
            ],
            [
                'id' => 43,
                'code' => 'TD',
                'name' => 'Chad',
            ],
            [
                'id' => 44,
                'code' => 'CL',
                'name' => 'Chile',
            ],
            [
                'id' => 45,
                'code' => 'CN',
                'name' => 'China',
            ],
            [
                'id' => 46,
                'code' => 'CX',
                'name' => 'Christmas Island',
            ],
            [
                'id' => 47,
                'code' => 'CC',
                'name' => 'Cocos (Keeling) Islands',
            ],
            [
                'id' => 48,
                'code' => 'CO',
                'name' => 'Colombia',
            ],
            [
                'id' => 49,
                'code' => 'KM',
                'name' => 'Comoros',
            ],
            [
                'id' => 50,
                'code' => 'CG',
                'name' => 'Congo',
            ],
            [
                'id' => 51,
                'code' => 'CK',
                'name' => 'Cook Islands',
            ],
            [
                'id' => 52,
                'code' => 'CR',
                'name' => 'Costa Rica',
            ],
            [
                'id' => 53,
                'code' => 'HR',
                'name' => 'Croatia (Hrvatska)',
            ],
            [
                'id' => 54,
                'code' => 'CU',
                'name' => 'Cuba',
            ],
            [
                'id' => 55,
                'code' => 'CY',
                'name' => 'Cyprus',
            ],
            [
                'id' => 56,
                'code' => 'CZ',
                'name' => 'Czech Republic',
            ],
            [
                'id' => 57,
                'code' => 'DK',
                'name' => 'Denmark',
            ],
            [
                'id' => 58,
                'code' => 'DJ',
                'name' => 'Djibouti',
            ],
            [
                'id' => 59,
                'code' => 'DM',
                'name' => 'Dominica',
            ],
            [
                'id' => 60,
                'code' => 'DO',
                'name' => 'Dominican Republic',
            ],
            [
                'id' => 61,
                'code' => 'TP',
                'name' => 'East Timor',
            ],
            [
                'id' => 62,
                'code' => 'EC',
                'name' => 'Ecudaor',
            ],
            [
                'id' => 63,
                'code' => 'EG',
                'name' => 'Egypt',
            ],
            [
                'id' => 64,
                'code' => 'SV',
                'name' => 'El Salvador',
            ],
            [
                'id' => 65,
                'code' => 'GQ',
                'name' => 'Equatorial Guinea',
            ],
            [
                'id' => 66,
                'code' => 'ER',
                'name' => 'Eritrea',
            ],
            [
                'id' => 67,
                'code' => 'EE',
                'name' => 'Estonia',
            ],
            [
                'id' => 68,
                'code' => 'ET',
                'name' => 'Ethiopia',
            ],
            [
                'id' => 69,
                'code' => 'FK',
                'name' => 'Falkland Islands (Malvinas)',
            ],
            [
                'id' => 70,
                'code' => 'FO',
                'name' => 'Faroe Islands',
            ],
            [
                'id' => 71,
                'code' => 'FJ',
                'name' => 'Fiji',
            ],
            [
                'id' => 72,
                'code' => 'FI',
                'name' => 'Finland',
            ],
            [
                'id' => 73,
                'code' => 'FR',
                'name' => 'France',
            ],
            [
                'id' => 74,
                'code' => 'FX',
                'name' => 'France, Metropolitan',
            ],
            [
                'id' => 75,
                'code' => 'GF',
                'name' => 'French Guiana',
            ],
            [
                'id' => 76,
                'code' => 'PF',
                'name' => 'French Polynesia',
            ],
            [
                'id' => 77,
                'code' => 'TF',
                'name' => 'French Southern Territories',
            ],
            [
                'id' => 78,
                'code' => 'GA',
                'name' => 'Gabon',
            ],
            [
                'id' => 79,
                'code' => 'GM',
                'name' => 'Gambia',
            ],
            [
                'id' => 80,
                'code' => 'GE',
                'name' => 'Georgia',
            ],
            [
                'id' => 81,
                'code' => 'DE',
                'name' => 'Germany',
            ],
            [
                'id' => 82,
                'code' => 'GH',
                'name' => 'Ghana',
            ],
            [
                'id' => 83,
                'code' => 'GI',
                'name' => 'Gibraltar',
            ],
            [
                'id' => 84,
                'code' => 'GR',
                'name' => 'Greece',
            ],
            [
                'id' => 85,
                'code' => 'GL',
                'name' => 'Greenland',
            ],
            [
                'id' => 86,
                'code' => 'GD',
                'name' => 'Grenada',
            ],
            [
                'id' => 87,
                'code' => 'GP',
                'name' => 'Guadeloupe',
            ],
            [
                'id' => 88,
                'code' => 'GU',
                'name' => 'Guam',
            ],
            [
                'id' => 89,
                'code' => 'GT',
                'name' => 'Guatemala',
            ],
            [
                'id' => 90,
                'code' => 'GN',
                'name' => 'Guinea',
            ],
            [
                'id' => 91,
                'code' => 'GW',
                'name' => 'Guinea-Bissau',
            ],
            [
                'id' => 92,
                'code' => 'GY',
                'name' => 'Guyana',
            ],
            [
                'id' => 93,
                'code' => 'HT',
                'name' => 'Haiti',
            ],
            [
                'id' => 94,
                'code' => 'HM',
                'name' => 'Heard and Mc Donald Islands',
            ],
            [
                'id' => 95,
                'code' => 'HN',
                'name' => 'Honduras',
            ],
            [
                'id' => 96,
                'code' => 'HK',
                'name' => 'Hong Kong',
            ],
            [
                'id' => 97,
                'code' => 'HU',
                'name' => 'Hungary',
            ],
            [
                'id' => 98,
                'code' => 'IS',
                'name' => 'Iceland',
            ],
            [
                'id' => 99,
                'code' => 'IN',
                'name' => 'India',
            ],
            [
                'id' => 100,
                'code' => 'ID',
                'name' => 'Indonesia',
            ],
            [
                'id' => 101,
                'code' => 'IR',
                'name' => 'Iran (Islamic Republic of)',
            ],
            [
                'id' => 102,
                'code' => 'IQ',
                'name' => 'Iraq',
            ],
            [
                'id' => 103,
                'code' => 'IE',
                'name' => 'Ireland',
            ],
            [
                'id' => 104,
                'code' => 'IL',
                'name' => 'Israel',
            ],
            [
                'id' => 105,
                'code' => 'IT',
                'name' => 'Italy',
            ],
            [
                'id' => 106,
                'code' => 'CI',
                'name' => 'Ivory Coast',
            ],
            [
                'id' => 107,
                'code' => 'JM',
                'name' => 'Jamaica',
            ],
            [
                'id' => 108,
                'code' => 'JP',
                'name' => 'Japan',
            ],
            [
                'id' => 109,
                'code' => 'JO',
                'name' => 'Jordan',
            ],
            [
                'id' => 110,
                'code' => 'KZ',
                'name' => 'Kazakhstan',
            ],
            [
                'id' => 111,
                'code' => 'KE',
                'name' => 'Kenya',
            ],
            [
                'id' => 112,
                'code' => 'KI',
                'name' => 'Kiribati',
            ],
            [
                'id' => 113,
                'code' => 'KP',
                'name' => 'Korea, Democratic People\'s Republic of',
            ],
            [
                'id' => 114,
                'code' => 'KR',
                'name' => 'Korea, Republic of',
            ],
            [
                'id' => 115,
                'code' => 'KW',
                'name' => 'Kuwait',
            ],
            [
                'id' => 116,
                'code' => 'KG',
                'name' => 'Kyrgyzstan',
            ],
            [
                'id' => 117,
                'code' => 'LA',
                'name' => 'Lao People\'s Democratic Republic',
            ],
            [
                'id' => 118,
                'code' => 'LV',
                'name' => 'Latvia',
            ],
            [
                'id' => 119,
                'code' => 'LB',
                'name' => 'Lebanon',
            ],
            [
                'id' => 120,
                'code' => 'LS',
                'name' => 'Lesotho',
            ],
            [
                'id' => 121,
                'code' => 'LR',
                'name' => 'Liberia',
            ],
            [
                'id' => 122,
                'code' => 'LY',
                'name' => 'Libyan Arab Jamahiriya',
            ],
            [
                'id' => 123,
                'code' => 'LI',
                'name' => 'Liechtenstein',
            ],
            [
                'id' => 124,
                'code' => 'LT',
                'name' => 'Lithuania',
            ],
            [
                'id' => 125,
                'code' => 'LU',
                'name' => 'Luxembourg',
            ],
            [
                'id' => 126,
                'code' => 'MO',
                'name' => 'Macau',
            ],
            [
                'id' => 127,
                'code' => 'MK',
                'name' => 'Macedonia',
            ],
            [
                'id' => 128,
                'code' => 'MG',
                'name' => 'Madagascar',
            ],
            [
                'id' => 129,
                'code' => 'MW',
                'name' => 'Malawi',
            ],
            [
                'id' => 130,
                'code' => 'MY',
                'name' => 'Malaysia',
            ],
            [
                'id' => 131,
                'code' => 'MV',
                'name' => 'Maldives',
            ],
            [
                'id' => 132,
                'code' => 'ML',
                'name' => 'Mali',
            ],
            [
                'id' => 133,
                'code' => 'MT',
                'name' => 'Malta',
            ],
            [
                'id' => 134,
                'code' => 'MH',
                'name' => 'Marshall Islands',
            ],
            [
                'id' => 135,
                'code' => 'MQ',
                'name' => 'Martinique',
            ],
            [
                'id' => 136,
                'code' => 'MR',
                'name' => 'Mauritania',
            ],
            [
                'id' => 137,
                'code' => 'MU',
                'name' => 'Mauritius',
            ],
            [
                'id' => 138,
                'code' => 'TY',
                'name' => 'Mayotte',
            ],
            [
                'id' => 139,
                'code' => 'MX',
                'name' => 'Mexico',
            ],
            [
                'id' => 140,
                'code' => 'FM',
                'name' => 'Micronesia, Federated States of',
            ],
            [
                'id' => 141,
                'code' => 'MD',
                'name' => 'Moldova, Republic of',
            ],
            [
                'id' => 142,
                'code' => 'MC',
                'name' => 'Monaco',
            ],
            [
                'id' => 143,
                'code' => 'MN',
                'name' => 'Mongolia',
            ],
            [
                'id' => 144,
                'code' => 'MS',
                'name' => 'Montserrat',
            ],
            [
                'id' => 145,
                'code' => 'MA',
                'name' => 'Morocco',
            ],
            [
                'id' => 146,
                'code' => 'MZ',
                'name' => 'Mozambique',
            ],
            [
                'id' => 147,
                'code' => 'MM',
                'name' => 'Myanmar',
            ],
            [
                'id' => 148,
                'code' => 'NA',
                'name' => 'Namibia',
            ],
            [
                'id' => 149,
                'code' => 'NR',
                'name' => 'Nauru',
            ],
            [
                'id' => 150,
                'code' => 'NP',
                'name' => 'Nepal',
            ],
            [
                'id' => 151,
                'code' => 'NL',
                'name' => 'Netherlands',
            ],
            [
                'id' => 152,
                'code' => 'AN',
                'name' => 'Netherlands Antilles',
            ],
            [
                'id' => 153,
                'code' => 'NC',
                'name' => 'New Caledonia',
            ],
            [
                'id' => 154,
                'code' => 'NZ',
                'name' => 'New Zealand',
            ],
            [
                'id' => 155,
                'code' => 'NI',
                'name' => 'Nicaragua',
            ],
            [
                'id' => 156,
                'code' => 'NE',
                'name' => 'Niger',
            ],
            [
                'id' => 157,
                'code' => 'NG',
                'name' => 'Nigeria',
            ],
            [
                'id' => 158,
                'code' => 'NU',
                'name' => 'Niue',
            ],
            [
                'id' => 159,
                'code' => 'NF',
                'name' => 'Norfork Island',
            ],
            [
                'id' => 160,
                'code' => 'MP',
                'name' => 'Northern Mariana Islands',
            ],
            [
                'id' => 161,
                'code' => 'NO',
                'name' => 'Norway',
            ],
            [
                'id' => 162,
                'code' => 'OM',
                'name' => 'Oman',
            ],
            [
                'id' => 163,
                'code' => 'PK',
                'name' => 'Pakistan',
            ],
            [
                'id' => 164,
                'code' => 'PW',
                'name' => 'Palau',
            ],
            [
                'id' => 165,
                'code' => 'PA',
                'name' => 'Panama',
            ],
            [
                'id' => 166,
                'code' => 'PG',
                'name' => 'Papua New Guinea',
            ],
            [
                'id' => 167,
                'code' => 'PY',
                'name' => 'Paraguay',
            ],
            [
                'id' => 168,
                'code' => 'PE',
                'name' => 'Peru',
            ],
            [
                'id' => 169,
                'code' => 'PH',
                'name' => 'Philippines',
            ],
            [
                'id' => 170,
                'code' => 'PN',
                'name' => 'Pitcairn',
            ],
            [
                'id' => 171,
                'code' => 'PL',
                'name' => 'Poland',
            ],
            [
                'id' => 172,
                'code' => 'PT',
                'name' => 'Portugal',
            ],
            [
                'id' => 173,
                'code' => 'PR',
                'name' => 'Puerto Rico',
            ],
            [
                'id' => 174,
                'code' => 'QA',
                'name' => 'Qatar',
            ],
            [
                'id' => 175,
                'code' => 'RE',
                'name' => 'Reunion',
            ],
            [
                'id' => 176,
                'code' => 'RO',
                'name' => 'Romania',
            ],
            [
                'id' => 177,
                'code' => 'RU',
                'name' => 'Russian Federation',
            ],
            [
                'id' => 178,
                'code' => 'RW',
                'name' => 'Rwanda',
            ],
            [
                'id' => 179,
                'code' => 'KN',
                'name' => 'Saint Kitts and Nevis',
            ],
            [
                'id' => 180,
                'code' => 'LC',
                'name' => 'Saint Lucia',
            ],
            [
                'id' => 181,
                'code' => 'VC',
                'name' => 'Saint Vincent and the Grenadines',
            ],
            [
                'id' => 182,
                'code' => 'WS',
                'name' => 'Samoa',
            ],
            [
                'id' => 183,
                'code' => 'SM',
                'name' => 'San Marino',
            ],
            [
                'id' => 184,
                'code' => 'ST',
                'name' => 'Sao Tome and Principe',
            ],
            [
                'id' => 185,
                'code' => 'SA',
                'name' => 'Saudi Arabia',
            ],
            [
                'id' => 186,
                'code' => 'SN',
                'name' => 'Senegal',
            ],
            [
                'id' => 187,
                'code' => 'SC',
                'name' => 'Seychelles',
            ],
            [
                'id' => 188,
                'code' => 'SL',
                'name' => 'Sierra Leone',
            ],
            [
                'id' => 189,
                'code' => 'SG',
                'name' => 'Singapore',
            ],
            [
                'id' => 190,
                'code' => 'SK',
                'name' => 'Slovakia',
            ],
            [
                'id' => 191,
                'code' => 'SI',
                'name' => 'Slovenia',
            ],
            [
                'id' => 192,
                'code' => 'SB',
                'name' => 'Solomon Islands',
            ],
            [
                'id' => 193,
                'code' => 'SO',
                'name' => 'Somalia',
            ],
            [
                'id' => 194,
                'code' => 'ZA',
                'name' => 'South Africa',
            ],
            [
                'id' => 195,
                'code' => 'GS',
                'name' => 'South Georgia South Sandwich Islands',
            ],
            [
                'id' => 196,
                'code' => 'ES',
                'name' => 'Spain',
            ],
            [
                'id' => 197,
                'code' => 'LK',
                'name' => 'Sri Lanka',
            ],
            [
                'id' => 198,
                'code' => 'SH',
                'name' => 'St. Helena',
            ],
            [
                'id' => 199,
                'code' => 'PM',
                'name' => 'St. Pierre and Miquelon',
            ],
            [
                'id' => 200,
                'code' => 'SD',
                'name' => 'Sudan',
            ],
            [
                'id' => 201,
                'code' => 'SR',
                'name' => 'Suriname',
            ],
            [
                'id' => 202,
                'code' => 'SJ',
                'name' => 'Svalbarn and Jan Mayen Islands',
            ],
            [
                'id' => 203,
                'code' => 'SZ',
                'name' => 'Swaziland',
            ],
            [
                'id' => 204,
                'code' => 'SE',
                'name' => 'Sweden',
            ],
            [
                'id' => 205,
                'code' => 'CH',
                'name' => 'Switzerland',
            ],
            [
                'id' => 206,
                'code' => 'SY',
                'name' => 'Syrian Arab Republic',
            ],
            [
                'id' => 207,
                'code' => 'TW',
                'name' => 'Taiwan',
            ],
            [
                'id' => 208,
                'code' => 'TJ',
                'name' => 'Tajikistan',
            ],
            [
                'id' => 209,
                'code' => 'TZ',
                'name' => 'Tanzania, United Republic of',
            ],
            [
                'id' => 210,
                'code' => 'TH',
                'name' => 'Thailand',
            ],
            [
                'id' => 211,
                'code' => 'TG',
                'name' => 'Togo',
            ],
            [
                'id' => 212,
                'code' => 'TK',
                'name' => 'Tokelau',
            ],
            [
                'id' => 213,
                'code' => 'TO',
                'name' => 'Tonga',
            ],
            [
                'id' => 214,
                'code' => 'TT',
                'name' => 'Trinidad and Tobago',
            ],
            [
                'id' => 215,
                'code' => 'TN',
                'name' => 'Tunisia',
            ],
            [
                'id' => 216,
                'code' => 'TR',
                'name' => 'Turkey',
            ],
            [
                'id' => 217,
                'code' => 'TM',
                'name' => 'Turkmenistan',
            ],
            [
                'id' => 218,
                'code' => 'TC',
                'name' => 'Turks and Caicos Islands',
            ],
            [
                'id' => 219,
                'code' => 'TV',
                'name' => 'Tuvalu',
            ],
            [
                'id' => 220,
                'code' => 'UG',
                'name' => 'Uganda',
            ],
            [
                'id' => 221,
                'code' => 'UA',
                'name' => 'Ukraine',
            ],
            [
                'id' => 222,
                'code' => 'AE',
                'name' => 'United Arab Emirates',
            ],
            [
                'id' => 223,
                'code' => 'GB',
                'name' => 'United Kingdom',
            ],
            [
                'id' => 224,
                'code' => 'UM',
                'name' => 'United States minor outlying islands',
            ],
            [
                'id' => 225,
                'code' => 'UY',
                'name' => 'Uruguay',
            ],
            [
                'id' => 226,
                'code' => 'UZ',
                'name' => 'Uzbekistan',
            ],
            [
                'id' => 227,
                'code' => 'VU',
                'name' => 'Vanuatu',
            ],
            [
                'id' => 228,
                'code' => 'VA',
                'name' => 'Vatican City State',
            ],
            [
                'id' => 229,
                'code' => 'VE',
                'name' => 'Venezuela',
            ],
            [
                'id' => 230,
                'code' => 'VN',
                'name' => 'Vietnam',
            ],
            [
                'id' => 231,
                'code' => 'VG',
                'name' => 'Virigan Islands (British)',
            ],
            [
                'id' => 232,
                'code' => 'VI',
                'name' => 'Virgin Islands (U.S.)',
            ],
            [
                'id' => 233,
                'code' => 'WF',
                'name' => 'Wallis and Futuna Islands',
            ],
            [
                'id' => 234,
                'code' => 'EH',
                'name' => 'Western Sahara',
            ],
            [
                'id' => 235,
                'code' => 'YE',
                'name' => 'Yemen',
            ],
            [
                'id' => 236,
                'code' => 'YU',
                'name' => 'Yugoslavia',
            ],
            [
                'id' => 237,
                'code' => 'ZR',
                'name' => 'Zaire',
            ],
            [
                'id' => 238,
                'code' => 'ZM',
                'name' => 'Zambia',
            ],
            [
                'id' => 239,
                'code' => 'ZW',
                'name' => 'Zimbabwe',
            ],
        ];

        DB::table('countries')->insert($countries);
    }
}
