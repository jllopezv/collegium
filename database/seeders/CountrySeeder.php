<?php

namespace Database\Seeders;

use App\Models\Aux\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $countries = array(
            array('id' => '1','iso' => 'AF','country' => 'AFGHANISTAN','nicename' => 'Afghanistan','iso3' => 'AFG','numcode' => '4','phonecode' => '93','language' => 'en'),
            array('id' => '2','iso' => 'AL','country' => 'ALBANIA','nicename' => 'Albania','iso3' => 'ALB','numcode' => '8','phonecode' => '355','language' => 'en'),
            array('id' => '3','iso' => 'DZ','country' => 'ALGERIA','nicename' => 'Algeria','iso3' => 'DZA','numcode' => '12','phonecode' => '213','language' => 'en'),
            array('id' => '4','iso' => 'AS','country' => 'AMERICAN SAMOA','nicename' => 'American Samoa','iso3' => 'ASM','numcode' => '16','phonecode' => '1684','language' => 'en'),
            array('id' => '5','iso' => 'AD','country' => 'ANDORRA','nicename' => 'Andorra','iso3' => 'AND','numcode' => '20','phonecode' => '376','language' => 'en'),
            array('id' => '6','iso' => 'AO','country' => 'ANGOLA','nicename' => 'Angola','iso3' => 'AGO','numcode' => '24','phonecode' => '244','language' => 'en'),
            array('id' => '7','iso' => 'AI','country' => 'ANGUILLA','nicename' => 'Anguilla','iso3' => 'AIA','numcode' => '660','phonecode' => '1264','language' => 'en'),
            array('id' => '8','iso' => 'AQ','country' => 'ANTARCTICA','nicename' => 'Antarctica','iso3' => NULL,'numcode' => NULL,'phonecode' => '0','language' => 'en'),
            array('id' => '9','iso' => 'AG','country' => 'ANTIGUA AND BARBUDA','nicename' => 'Antigua and Barbuda','iso3' => 'ATG','numcode' => '28','phonecode' => '1268','language' => 'en'),
            array('id' => '10','iso' => 'AR','country' => 'ARGENTINA','nicename' => 'Argentina','iso3' => 'ARG','numcode' => '32','phonecode' => '54','language' => 'en'),
            array('id' => '11','iso' => 'AM','country' => 'ARMENIA','nicename' => 'Armenia','iso3' => 'ARM','numcode' => '51','phonecode' => '374','language' => 'en'),
            array('id' => '12','iso' => 'AW','country' => 'ARUBA','nicename' => 'Aruba','iso3' => 'ABW','numcode' => '533','phonecode' => '297','language' => 'en'),
            array('id' => '13','iso' => 'AU','country' => 'AUSTRALIA','nicename' => 'Australia','iso3' => 'AUS','numcode' => '36','phonecode' => '61','language' => 'en'),
            array('id' => '14','iso' => 'AT','country' => 'AUSTRIA','nicename' => 'Austria','iso3' => 'AUT','numcode' => '40','phonecode' => '43','language' => 'en'),
            array('id' => '15','iso' => 'AZ','country' => 'AZERBAIJAN','nicename' => 'Azerbaijan','iso3' => 'AZE','numcode' => '31','phonecode' => '994','language' => 'en'),
            array('id' => '16','iso' => 'BS','country' => 'BAHAMAS','nicename' => 'Bahamas','iso3' => 'BHS','numcode' => '44','phonecode' => '1242','language' => 'en'),
            array('id' => '17','iso' => 'BH','country' => 'BAHRAIN','nicename' => 'Bahrain','iso3' => 'BHR','numcode' => '48','phonecode' => '973','language' => 'en'),
            array('id' => '18','iso' => 'BD','country' => 'BANGLADESH','nicename' => 'Bangladesh','iso3' => 'BGD','numcode' => '50','phonecode' => '880','language' => 'en'),
            array('id' => '19','iso' => 'BB','country' => 'BARBADOS','nicename' => 'Barbados','iso3' => 'BRB','numcode' => '52','phonecode' => '1246','language' => 'en'),
            array('id' => '20','iso' => 'BY','country' => 'BELARUS','nicename' => 'Belarus','iso3' => 'BLR','numcode' => '112','phonecode' => '375','language' => 'en'),
            array('id' => '21','iso' => 'BE','country' => 'BELGIUM','nicename' => 'Belgium','iso3' => 'BEL','numcode' => '56','phonecode' => '32','language' => 'en'),
            array('id' => '22','iso' => 'BZ','country' => 'BELIZE','nicename' => 'Belize','iso3' => 'BLZ','numcode' => '84','phonecode' => '501','language' => 'en'),
            array('id' => '23','iso' => 'BJ','country' => 'BENIN','nicename' => 'Benin','iso3' => 'BEN','numcode' => '204','phonecode' => '229','language' => 'en'),
            array('id' => '24','iso' => 'BM','country' => 'BERMUDA','nicename' => 'Bermuda','iso3' => 'BMU','numcode' => '60','phonecode' => '1441','language' => 'en'),
            array('id' => '25','iso' => 'BT','country' => 'BHUTAN','nicename' => 'Bhutan','iso3' => 'BTN','numcode' => '64','phonecode' => '975','language' => 'en'),
            array('id' => '26','iso' => 'BO','country' => 'BOLIVIA','nicename' => 'Bolivia','iso3' => 'BOL','numcode' => '68','phonecode' => '591','language' => 'en'),
            array('id' => '27','iso' => 'BA','country' => 'BOSNIA AND HERZEGOVINA','nicename' => 'Bosnia and Herzegovina','iso3' => 'BIH','numcode' => '70','phonecode' => '387','language' => 'en'),
            array('id' => '28','iso' => 'BW','country' => 'BOTSWANA','nicename' => 'Botswana','iso3' => 'BWA','numcode' => '72','phonecode' => '267','language' => 'en'),
            array('id' => '29','iso' => 'BV','country' => 'BOUVET ISLAND','nicename' => 'Bouvet Island','iso3' => NULL,'numcode' => NULL,'phonecode' => '0','language' => 'en'),
            array('id' => '30','iso' => 'BR','country' => 'BRAZIL','nicename' => 'Brazil','iso3' => 'BRA','numcode' => '76','phonecode' => '55','language' => 'en'),
            array('id' => '31','iso' => 'IO','country' => 'BRITISH INDIAN OCEAN TERRITORY','nicename' => 'British Indian Ocean Territory','iso3' => NULL,'numcode' => NULL,'phonecode' => '246','language' => 'en'),
            array('id' => '32','iso' => 'BN','country' => 'BRUNEI DARUSSALAM','nicename' => 'Brunei Darussalam','iso3' => 'BRN','numcode' => '96','phonecode' => '673','language' => 'en'),
            array('id' => '33','iso' => 'BG','country' => 'BULGARIA','nicename' => 'Bulgaria','iso3' => 'BGR','numcode' => '100','phonecode' => '359','language' => 'en'),
            array('id' => '34','iso' => 'BF','country' => 'BURKINA FASO','nicename' => 'Burkina Faso','iso3' => 'BFA','numcode' => '854','phonecode' => '226','language' => 'en'),
            array('id' => '35','iso' => 'BI','country' => 'BURUNDI','nicename' => 'Burundi','iso3' => 'BDI','numcode' => '108','phonecode' => '257','language' => 'en'),
            array('id' => '36','iso' => 'KH','country' => 'CAMBODIA','nicename' => 'Cambodia','iso3' => 'KHM','numcode' => '116','phonecode' => '855','language' => 'en'),
            array('id' => '37','iso' => 'CM','country' => 'CAMEROON','nicename' => 'Cameroon','iso3' => 'CMR','numcode' => '120','phonecode' => '237','language' => 'en'),
            array('id' => '38','iso' => 'CA','country' => 'CANADA','nicename' => 'Canada','iso3' => 'CAN','numcode' => '124','phonecode' => '1','language' => 'en'),
            array('id' => '39','iso' => 'CV','country' => 'CAPE VERDE','nicename' => 'Cape Verde','iso3' => 'CPV','numcode' => '132','phonecode' => '238','language' => 'en'),
            array('id' => '40','iso' => 'KY','country' => 'CAYMAN ISLANDS','nicename' => 'Cayman Islands','iso3' => 'CYM','numcode' => '136','phonecode' => '1345','language' => 'en'),
            array('id' => '41','iso' => 'CF','country' => 'CENTRAL AFRICAN REPUBLIC','nicename' => 'Central African Republic','iso3' => 'CAF','numcode' => '140','phonecode' => '236','language' => 'en'),
            array('id' => '42','iso' => 'TD','country' => 'CHAD','nicename' => 'Chad','iso3' => 'TCD','numcode' => '148','phonecode' => '235','language' => 'en'),
            array('id' => '43','iso' => 'CL','country' => 'CHILE','nicename' => 'Chile','iso3' => 'CHL','numcode' => '152','phonecode' => '56','language' => 'en'),
            array('id' => '44','iso' => 'CN','country' => 'CHINA','nicename' => 'China','iso3' => 'CHN','numcode' => '156','phonecode' => '86','language' => 'en'),
            array('id' => '45','iso' => 'CX','country' => 'CHRISTMAS ISLAND','nicename' => 'Christmas Island','iso3' => NULL,'numcode' => NULL,'phonecode' => '61','language' => 'en'),
            array('id' => '46','iso' => 'CC','country' => 'COCOS (KEELING) ISLANDS','nicename' => 'Cocos (Keeling) Islands','iso3' => NULL,'numcode' => NULL,'phonecode' => '672','language' => 'en'),
            array('id' => '47','iso' => 'CO','country' => 'COLOMBIA','nicename' => 'Colombia','iso3' => 'COL','numcode' => '170','phonecode' => '57','language' => 'en'),
            array('id' => '48','iso' => 'KM','country' => 'COMOROS','nicename' => 'Comoros','iso3' => 'COM','numcode' => '174','phonecode' => '269','language' => 'en'),
            array('id' => '49','iso' => 'CG','country' => 'CONGO','nicename' => 'Congo','iso3' => 'COG','numcode' => '178','phonecode' => '242','language' => 'en'),
            array('id' => '50','iso' => 'CD','country' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE','nicename' => 'Congo, the Democratic Republic of the','iso3' => 'COD','numcode' => '180','phonecode' => '242','language' => 'en'),
            array('id' => '51','iso' => 'CK','country' => 'COOK ISLANDS','nicename' => 'Cook Islands','iso3' => 'COK','numcode' => '184','phonecode' => '682','language' => 'en'),
            array('id' => '52','iso' => 'CR','country' => 'COSTA RICA','nicename' => 'Costa Rica','iso3' => 'CRI','numcode' => '188','phonecode' => '506','language' => 'en'),
            array('id' => '53','iso' => 'CI','country' => 'COTE D\'IVOIRE','nicename' => 'Cote D\'Ivoire','iso3' => 'CIV','numcode' => '384','phonecode' => '225','language' => 'en'),
            array('id' => '54','iso' => 'HR','country' => 'CROATIA','nicename' => 'Croatia','iso3' => 'HRV','numcode' => '191','phonecode' => '385','language' => 'en'),
            array('id' => '55','iso' => 'CU','country' => 'CUBA','nicename' => 'Cuba','iso3' => 'CUB','numcode' => '192','phonecode' => '53','language' => 'en'),
            array('id' => '56','iso' => 'CY','country' => 'CYPRUS','nicename' => 'Cyprus','iso3' => 'CYP','numcode' => '196','phonecode' => '357','language' => 'en'),
            array('id' => '57','iso' => 'CZ','country' => 'CZECH REPUBLIC','nicename' => 'Czech Republic','iso3' => 'CZE','numcode' => '203','phonecode' => '420','language' => 'en'),
            array('id' => '58','iso' => 'DK','country' => 'DENMARK','nicename' => 'Denmark','iso3' => 'DNK','numcode' => '208','phonecode' => '45','language' => 'en'),
            array('id' => '59','iso' => 'DJ','country' => 'DJIBOUTI','nicename' => 'Djibouti','iso3' => 'DJI','numcode' => '262','phonecode' => '253','language' => 'en'),
            array('id' => '60','iso' => 'DM','country' => 'DOMINICA','nicename' => 'Dominica','iso3' => 'DMA','numcode' => '212','phonecode' => '1767','language' => 'en'),
            array('id' => '61','iso' => 'DO','country' => 'DOMINICAN REPUBLIC','nicename' => 'Dominican Republic','iso3' => 'DOM','numcode' => '214','phonecode' => '1809','language' => 'es'),
            array('id' => '62','iso' => 'EC','country' => 'ECUADOR','nicename' => 'Ecuador','iso3' => 'ECU','numcode' => '218','phonecode' => '593','language' => 'es'),
            array('id' => '63','iso' => 'EG','country' => 'EGYPT','nicename' => 'Egypt','iso3' => 'EGY','numcode' => '818','phonecode' => '20','language' => 'es'),
            array('id' => '64','iso' => 'SV','country' => 'EL SALVADOR','nicename' => 'El Salvador','iso3' => 'SLV','numcode' => '222','phonecode' => '503','language' => 'en'),
            array('id' => '65','iso' => 'GQ','country' => 'EQUATORIAL GUINEA','nicename' => 'Equatorial Guinea','iso3' => 'GNQ','numcode' => '226','phonecode' => '240','language' => 'en'),
            array('id' => '66','iso' => 'ER','country' => 'ERITREA','nicename' => 'Eritrea','iso3' => 'ERI','numcode' => '232','phonecode' => '291','language' => 'en'),
            array('id' => '67','iso' => 'EE','country' => 'ESTONIA','nicename' => 'Estonia','iso3' => 'EST','numcode' => '233','phonecode' => '372','language' => 'en'),
            array('id' => '68','iso' => 'ET','country' => 'ETHIOPIA','nicename' => 'Ethiopia','iso3' => 'ETH','numcode' => '231','phonecode' => '251','language' => 'en'),
            array('id' => '69','iso' => 'FK','country' => 'FALKLAND ISLANDS (MALVINAS)','nicename' => 'Falkland Islands (Malvinas)','iso3' => 'FLK','numcode' => '238','phonecode' => '500','language' => 'en'),
            array('id' => '70','iso' => 'FO','country' => 'FAROE ISLANDS','nicename' => 'Faroe Islands','iso3' => 'FRO','numcode' => '234','phonecode' => '298','language' => 'en'),
            array('id' => '71','iso' => 'FJ','country' => 'FIJI','nicename' => 'Fiji','iso3' => 'FJI','numcode' => '242','phonecode' => '679','language' => 'en'),
            array('id' => '72','iso' => 'FI','country' => 'FINLAND','nicename' => 'Finland','iso3' => 'FIN','numcode' => '246','phonecode' => '358','language' => 'en'),
            array('id' => '73','iso' => 'FR','country' => 'FRANCE','nicename' => 'France','iso3' => 'FRA','numcode' => '250','phonecode' => '33','language' => 'fr'),
            array('id' => '74','iso' => 'GF','country' => 'FRENCH GUIANA','nicename' => 'French Guiana','iso3' => 'GUF','numcode' => '254','phonecode' => '594','language' => 'en'),
            array('id' => '75','iso' => 'PF','country' => 'FRENCH POLYNESIA','nicename' => 'French Polynesia','iso3' => 'PYF','numcode' => '258','phonecode' => '689','language' => 'en'),
            array('id' => '76','iso' => 'TF','country' => 'FRENCH SOUTHERN TERRITORIES','nicename' => 'French Southern Territories','iso3' => NULL,'numcode' => NULL,'phonecode' => '0','language' => 'en'),
            array('id' => '77','iso' => 'GA','country' => 'GABON','nicename' => 'Gabon','iso3' => 'GAB','numcode' => '266','phonecode' => '241','language' => 'en'),
            array('id' => '78','iso' => 'GM','country' => 'GAMBIA','nicename' => 'Gambia','iso3' => 'GMB','numcode' => '270','phonecode' => '220','language' => 'en'),
            array('id' => '79','iso' => 'GE','country' => 'GEORGIA','nicename' => 'Georgia','iso3' => 'GEO','numcode' => '268','phonecode' => '995','language' => 'en'),
            array('id' => '80','iso' => 'DE','country' => 'GERMANY','nicename' => 'Germany','iso3' => 'DEU','numcode' => '276','phonecode' => '49','language' => 'en'),
            array('id' => '81','iso' => 'GH','country' => 'GHANA','nicename' => 'Ghana','iso3' => 'GHA','numcode' => '288','phonecode' => '233','language' => 'en'),
            array('id' => '82','iso' => 'GI','country' => 'GIBRALTAR','nicename' => 'Gibraltar','iso3' => 'GIB','numcode' => '292','phonecode' => '350','language' => 'en'),
            array('id' => '83','iso' => 'GR','country' => 'GREECE','nicename' => 'Greece','iso3' => 'GRC','numcode' => '300','phonecode' => '30','language' => 'en'),
            array('id' => '84','iso' => 'GL','country' => 'GREENLAND','nicename' => 'Greenland','iso3' => 'GRL','numcode' => '304','phonecode' => '299','language' => 'en'),
            array('id' => '85','iso' => 'GD','country' => 'GRENADA','nicename' => 'Grenada','iso3' => 'GRD','numcode' => '308','phonecode' => '1473','language' => 'en'),
            array('id' => '86','iso' => 'GP','country' => 'GUADELOUPE','nicename' => 'Guadeloupe','iso3' => 'GLP','numcode' => '312','phonecode' => '590','language' => 'en'),
            array('id' => '87','iso' => 'GU','country' => 'GUAM','nicename' => 'Guam','iso3' => 'GUM','numcode' => '316','phonecode' => '1671','language' => 'en'),
            array('id' => '88','iso' => 'GT','country' => 'GUATEMALA','nicename' => 'Guatemala','iso3' => 'GTM','numcode' => '320','phonecode' => '502','language' => 'en'),
            array('id' => '89','iso' => 'GN','country' => 'GUINEA','nicename' => 'Guinea','iso3' => 'GIN','numcode' => '324','phonecode' => '224','language' => 'en'),
            array('id' => '90','iso' => 'GW','country' => 'GUINEA-BISSAU','nicename' => 'Guinea-Bissau','iso3' => 'GNB','numcode' => '624','phonecode' => '245','language' => 'en'),
            array('id' => '91','iso' => 'GY','country' => 'GUYANA','nicename' => 'Guyana','iso3' => 'GUY','numcode' => '328','phonecode' => '592','language' => 'en'),
            array('id' => '92','iso' => 'HT','country' => 'HAITI','nicename' => 'Haiti','iso3' => 'HTI','numcode' => '332','phonecode' => '509','language' => 'en'),
            array('id' => '93','iso' => 'HM','country' => 'HEARD ISLAND AND MCDONALD ISLANDS','nicename' => 'Heard Island and Mcdonald Islands','iso3' => NULL,'numcode' => NULL,'phonecode' => '0','language' => 'en'),
            array('id' => '94','iso' => 'VA','country' => 'HOLY SEE (VATICAN CITY STATE)','nicename' => 'Holy See (Vatican City State)','iso3' => 'VAT','numcode' => '336','phonecode' => '39','language' => 'en'),
            array('id' => '95','iso' => 'HN','country' => 'HONDURAS','nicename' => 'Honduras','iso3' => 'HND','numcode' => '340','phonecode' => '504','language' => 'es'),
            array('id' => '96','iso' => 'HK','country' => 'HONG KONG','nicename' => 'Hong Kong','iso3' => 'HKG','numcode' => '344','phonecode' => '852','language' => 'en'),
            array('id' => '97','iso' => 'HU','country' => 'HUNGARY','nicename' => 'Hungary','iso3' => 'HUN','numcode' => '348','phonecode' => '36','language' => 'en'),
            array('id' => '98','iso' => 'IS','country' => 'ICELAND','nicename' => 'Iceland','iso3' => 'ISL','numcode' => '352','phonecode' => '354','language' => 'en'),
            array('id' => '99','iso' => 'IN','country' => 'INDIA','nicename' => 'India','iso3' => 'IND','numcode' => '356','phonecode' => '91','language' => 'en'),
            array('id' => '100','iso' => 'ID','country' => 'INDONESIA','nicename' => 'Indonesia','iso3' => 'IDN','numcode' => '360','phonecode' => '62','language' => 'en'),
            array('id' => '101','iso' => 'IR','country' => 'IRAN, ISLAMIC REPUBLIC OF','nicename' => 'Iran, Islamic Republic of','iso3' => 'IRN','numcode' => '364','phonecode' => '98','language' => 'en'),
            array('id' => '102','iso' => 'IQ','country' => 'IRAQ','nicename' => 'Iraq','iso3' => 'IRQ','numcode' => '368','phonecode' => '964','language' => 'en'),
            array('id' => '103','iso' => 'IE','country' => 'IRELAND','nicename' => 'Ireland','iso3' => 'IRL','numcode' => '372','phonecode' => '353','language' => 'en'),
            array('id' => '104','iso' => 'IL','country' => 'ISRAEL','nicename' => 'Israel','iso3' => 'ISR','numcode' => '376','phonecode' => '972','language' => 'en'),
            array('id' => '105','iso' => 'IT','country' => 'ITALY','nicename' => 'Italy','iso3' => 'ITA','numcode' => '380','phonecode' => '39','language' => 'en'),
            array('id' => '106','iso' => 'JM','country' => 'JAMAICA','nicename' => 'Jamaica','iso3' => 'JAM','numcode' => '388','phonecode' => '1876','language' => 'en'),
            array('id' => '107','iso' => 'JP','country' => 'JAPAN','nicename' => 'Japan','iso3' => 'JPN','numcode' => '392','phonecode' => '81','language' => 'en'),
            array('id' => '108','iso' => 'JO','country' => 'JORDAN','nicename' => 'Jordan','iso3' => 'JOR','numcode' => '400','phonecode' => '962','language' => 'en'),
            array('id' => '109','iso' => 'KZ','country' => 'KAZAKHSTAN','nicename' => 'Kazakhstan','iso3' => 'KAZ','numcode' => '398','phonecode' => '7','language' => 'en'),
            array('id' => '110','iso' => 'KE','country' => 'KENYA','nicename' => 'Kenya','iso3' => 'KEN','numcode' => '404','phonecode' => '254','language' => 'en'),
            array('id' => '111','iso' => 'KI','country' => 'KIRIBATI','nicename' => 'Kiribati','iso3' => 'KIR','numcode' => '296','phonecode' => '686','language' => 'en'),
            array('id' => '112','iso' => 'KP','country' => 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','nicename' => 'Korea, Democratic People\'s Republic of','iso3' => 'PRK','numcode' => '408','phonecode' => '850','language' => 'en'),
            array('id' => '113','iso' => 'KR','country' => 'KOREA, REPUBLIC OF','nicename' => 'Korea, Republic of','iso3' => 'KOR','numcode' => '410','phonecode' => '82','language' => 'en'),
            array('id' => '114','iso' => 'KW','country' => 'KUWAIT','nicename' => 'Kuwait','iso3' => 'KWT','numcode' => '414','phonecode' => '965','language' => 'en'),
            array('id' => '115','iso' => 'KG','country' => 'KYRGYZSTAN','nicename' => 'Kyrgyzstan','iso3' => 'KGZ','numcode' => '417','phonecode' => '996','language' => 'en'),
            array('id' => '116','iso' => 'LA','country' => 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC','nicename' => 'Lao People\'s Democratic Republic','iso3' => 'LAO','numcode' => '418','phonecode' => '856','language' => 'en'),
            array('id' => '117','iso' => 'LV','country' => 'LATVIA','nicename' => 'Latvia','iso3' => 'LVA','numcode' => '428','phonecode' => '371','language' => 'en'),
            array('id' => '118','iso' => 'LB','country' => 'LEBANON','nicename' => 'Lebanon','iso3' => 'LBN','numcode' => '422','phonecode' => '961','language' => 'en'),
            array('id' => '119','iso' => 'LS','country' => 'LESOTHO','nicename' => 'Lesotho','iso3' => 'LSO','numcode' => '426','phonecode' => '266','language' => 'en'),
            array('id' => '120','iso' => 'LR','country' => 'LIBERIA','nicename' => 'Liberia','iso3' => 'LBR','numcode' => '430','phonecode' => '231','language' => 'en'),
            array('id' => '121','iso' => 'LY','country' => 'LIBYAN ARAB JAMAHIRIYA','nicename' => 'Libyan Arab Jamahiriya','iso3' => 'LBY','numcode' => '434','phonecode' => '218','language' => 'en'),
            array('id' => '122','iso' => 'LI','country' => 'LIECHTENSTEIN','nicename' => 'Liechtenstein','iso3' => 'LIE','numcode' => '438','phonecode' => '423','language' => 'en'),
            array('id' => '123','iso' => 'LT','country' => 'LITHUANIA','nicename' => 'Lithuania','iso3' => 'LTU','numcode' => '440','phonecode' => '370','language' => 'en'),
            array('id' => '124','iso' => 'LU','country' => 'LUXEMBOURG','nicename' => 'Luxembourg','iso3' => 'LUX','numcode' => '442','phonecode' => '352','language' => 'en'),
            array('id' => '125','iso' => 'MO','country' => 'MACAO','nicename' => 'Macao','iso3' => 'MAC','numcode' => '446','phonecode' => '853','language' => 'en'),
            array('id' => '126','iso' => 'MK','country' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','nicename' => 'Macedonia, the Former Yugoslav Republic of','iso3' => 'MKD','numcode' => '807','phonecode' => '389','language' => 'en'),
            array('id' => '127','iso' => 'MG','country' => 'MADAGASCAR','nicename' => 'Madagascar','iso3' => 'MDG','numcode' => '450','phonecode' => '261','language' => 'en'),
            array('id' => '128','iso' => 'MW','country' => 'MALAWI','nicename' => 'Malawi','iso3' => 'MWI','numcode' => '454','phonecode' => '265','language' => 'en'),
            array('id' => '129','iso' => 'MY','country' => 'MALAYSIA','nicename' => 'Malaysia','iso3' => 'MYS','numcode' => '458','phonecode' => '60','language' => 'en'),
            array('id' => '130','iso' => 'MV','country' => 'MALDIVES','nicename' => 'Maldives','iso3' => 'MDV','numcode' => '462','phonecode' => '960','language' => 'en'),
            array('id' => '131','iso' => 'ML','country' => 'MALI','nicename' => 'Mali','iso3' => 'MLI','numcode' => '466','phonecode' => '223','language' => 'en'),
            array('id' => '132','iso' => 'MT','country' => 'MALTA','nicename' => 'Malta','iso3' => 'MLT','numcode' => '470','phonecode' => '356','language' => 'en'),
            array('id' => '133','iso' => 'MH','country' => 'MARSHALL ISLANDS','nicename' => 'Marshall Islands','iso3' => 'MHL','numcode' => '584','phonecode' => '692','language' => 'en'),
            array('id' => '134','iso' => 'MQ','country' => 'MARTINIQUE','nicename' => 'Martinique','iso3' => 'MTQ','numcode' => '474','phonecode' => '596','language' => 'en'),
            array('id' => '135','iso' => 'MR','country' => 'MAURITANIA','nicename' => 'Mauritania','iso3' => 'MRT','numcode' => '478','phonecode' => '222','language' => 'en'),
            array('id' => '136','iso' => 'MU','country' => 'MAURITIUS','nicename' => 'Mauritius','iso3' => 'MUS','numcode' => '480','phonecode' => '230','language' => 'en'),
            array('id' => '137','iso' => 'YT','country' => 'MAYOTTE','nicename' => 'Mayotte','iso3' => NULL,'numcode' => NULL,'phonecode' => '269','language' => 'en'),
            array('id' => '138','iso' => 'MX','country' => 'MEXICO','nicename' => 'Mexico','iso3' => 'MEX','numcode' => '484','phonecode' => '52','language' => 'en'),
            array('id' => '139','iso' => 'FM','country' => 'MICRONESIA, FEDERATED STATES OF','nicename' => 'Micronesia, Federated States of','iso3' => 'FSM','numcode' => '583','phonecode' => '691','language' => 'en'),
            array('id' => '140','iso' => 'MD','country' => 'MOLDOVA, REPUBLIC OF','nicename' => 'Moldova, Republic of','iso3' => 'MDA','numcode' => '498','phonecode' => '373','language' => 'en'),
            array('id' => '141','iso' => 'MC','country' => 'MONACO','nicename' => 'Monaco','iso3' => 'MCO','numcode' => '492','phonecode' => '377','language' => 'en'),
            array('id' => '142','iso' => 'MN','country' => 'MONGOLIA','nicename' => 'Mongolia','iso3' => 'MNG','numcode' => '496','phonecode' => '976','language' => 'en'),
            array('id' => '143','iso' => 'MS','country' => 'MONTSERRAT','nicename' => 'Montserrat','iso3' => 'MSR','numcode' => '500','phonecode' => '1664','language' => 'en'),
            array('id' => '144','iso' => 'MA','country' => 'MOROCCO','nicename' => 'Morocco','iso3' => 'MAR','numcode' => '504','phonecode' => '212','language' => 'en'),
            array('id' => '145','iso' => 'MZ','country' => 'MOZAMBIQUE','nicename' => 'Mozambique','iso3' => 'MOZ','numcode' => '508','phonecode' => '258','language' => 'en'),
            array('id' => '146','iso' => 'MM','country' => 'MYANMAR','nicename' => 'Myanmar','iso3' => 'MMR','numcode' => '104','phonecode' => '95','language' => 'en'),
            array('id' => '147','iso' => 'NA','country' => 'NAMIBIA','nicename' => 'Namibia','iso3' => 'NAM','numcode' => '516','phonecode' => '264','language' => 'en'),
            array('id' => '148','iso' => 'NR','country' => 'NAURU','nicename' => 'Nauru','iso3' => 'NRU','numcode' => '520','phonecode' => '674','language' => 'en'),
            array('id' => '149','iso' => 'NP','country' => 'NEPAL','nicename' => 'Nepal','iso3' => 'NPL','numcode' => '524','phonecode' => '977','language' => 'en'),
            array('id' => '150','iso' => 'NL','country' => 'NETHERLANDS','nicename' => 'Netherlands','iso3' => 'NLD','numcode' => '528','phonecode' => '31','language' => 'en'),
            array('id' => '151','iso' => 'AN','country' => 'NETHERLANDS ANTILLES','nicename' => 'Netherlands Antilles','iso3' => 'ANT','numcode' => '530','phonecode' => '599','language' => 'en'),
            array('id' => '152','iso' => 'NC','country' => 'NEW CALEDONIA','nicename' => 'New Caledonia','iso3' => 'NCL','numcode' => '540','phonecode' => '687','language' => 'en'),
            array('id' => '153','iso' => 'NZ','country' => 'NEW ZEALAND','nicename' => 'New Zealand','iso3' => 'NZL','numcode' => '554','phonecode' => '64','language' => 'en'),
            array('id' => '154','iso' => 'NI','country' => 'NICARAGUA','nicename' => 'Nicaragua','iso3' => 'NIC','numcode' => '558','phonecode' => '505','language' => 'en'),
            array('id' => '155','iso' => 'NE','country' => 'NIGER','nicename' => 'Niger','iso3' => 'NER','numcode' => '562','phonecode' => '227','language' => 'en'),
            array('id' => '156','iso' => 'NG','country' => 'NIGERIA','nicename' => 'Nigeria','iso3' => 'NGA','numcode' => '566','phonecode' => '234','language' => 'en'),
            array('id' => '157','iso' => 'NU','country' => 'NIUE','nicename' => 'Niue','iso3' => 'NIU','numcode' => '570','phonecode' => '683','language' => 'en'),
            array('id' => '158','iso' => 'NF','country' => 'NORFOLK ISLAND','nicename' => 'Norfolk Island','iso3' => 'NFK','numcode' => '574','phonecode' => '672','language' => 'en'),
            array('id' => '159','iso' => 'MP','country' => 'NORTHERN MARIANA ISLANDS','nicename' => 'Northern Mariana Islands','iso3' => 'MNP','numcode' => '580','phonecode' => '1670','language' => 'en'),
            array('id' => '160','iso' => 'NO','country' => 'NORWAY','nicename' => 'Norway','iso3' => 'NOR','numcode' => '578','phonecode' => '47','language' => 'en'),
            array('id' => '161','iso' => 'OM','country' => 'OMAN','nicename' => 'Oman','iso3' => 'OMN','numcode' => '512','phonecode' => '968','language' => 'en','language' => 'en'),
            array('id' => '162','iso' => 'PK','country' => 'PAKISTAN','nicename' => 'Pakistan','iso3' => 'PAK','numcode' => '586','phonecode' => '92','language' => 'en'),
            array('id' => '163','iso' => 'PW','country' => 'PALAU','nicename' => 'Palau','iso3' => 'PLW','numcode' => '585','phonecode' => '680','language' => 'en'),
            array('id' => '164','iso' => 'PS','country' => 'PALESTINIAN TERRITORY, OCCUPIED','nicename' => 'Palestinian Territory, Occupied','iso3' => NULL,'numcode' => NULL,'phonecode' => '970','language' => 'en'),
            array('id' => '165','iso' => 'PA','country' => 'PANAMA','nicename' => 'Panama','iso3' => 'PAN','numcode' => '591','phonecode' => '507','language' => 'en'),
            array('id' => '166','iso' => 'PG','country' => 'PAPUA NEW GUINEA','nicename' => 'Papua New Guinea','iso3' => 'PNG','numcode' => '598','phonecode' => '675','language' => 'en'),
            array('id' => '167','iso' => 'PY','country' => 'PARAGUAY','nicename' => 'Paraguay','iso3' => 'PRY','numcode' => '600','phonecode' => '595','language' => 'en'),
            array('id' => '168','iso' => 'PE','country' => 'PERU','nicename' => 'Peru','iso3' => 'PER','numcode' => '604','phonecode' => '51','language' => 'en'),
            array('id' => '169','iso' => 'PH','country' => 'PHILIPPINES','nicename' => 'Philippines','iso3' => 'PHL','numcode' => '608','phonecode' => '63','language' => 'en'),
            array('id' => '170','iso' => 'PN','country' => 'PITCAIRN','nicename' => 'Pitcairn','iso3' => 'PCN','numcode' => '612','phonecode' => '0','language' => 'en'),
            array('id' => '171','iso' => 'PL','country' => 'POLAND','nicename' => 'Poland','iso3' => 'POL','numcode' => '616','phonecode' => '48','language' => 'en'),
            array('id' => '172','iso' => 'PT','country' => 'PORTUGAL','nicename' => 'Portugal','iso3' => 'PRT','numcode' => '620','phonecode' => '351','language' => 'en'),
            array('id' => '173','iso' => 'PR','country' => 'PUERTO RICO','nicename' => 'Puerto Rico','iso3' => 'PRI','numcode' => '630','phonecode' => '1787','language' => 'en'),
            array('id' => '174','iso' => 'QA','country' => 'QATAR','nicename' => 'Qatar','iso3' => 'QAT','numcode' => '634','phonecode' => '974','language' => 'en'),
            array('id' => '175','iso' => 'RE','country' => 'REUNION','nicename' => 'Reunion','iso3' => 'REU','numcode' => '638','phonecode' => '262','language' => 'en'),
            array('id' => '176','iso' => 'RO','country' => 'ROMANIA','nicename' => 'Romania','iso3' => 'ROM','numcode' => '642','phonecode' => '40','language' => 'en'),
            array('id' => '177','iso' => 'RU','country' => 'RUSSIAN FEDERATION','nicename' => 'Russian Federation','iso3' => 'RUS','numcode' => '643','phonecode' => '70','language' => 'en'),
            array('id' => '178','iso' => 'RW','country' => 'RWANDA','nicename' => 'Rwanda','iso3' => 'RWA','numcode' => '646','phonecode' => '250','language' => 'en'),
            array('id' => '179','iso' => 'SH','country' => 'SAINT HELENA','nicename' => 'Saint Helena','iso3' => 'SHN','numcode' => '654','phonecode' => '290','language' => 'en'),
            array('id' => '180','iso' => 'KN','country' => 'SAINT KITTS AND NEVIS','nicename' => 'Saint Kitts and Nevis','iso3' => 'KNA','numcode' => '659','phonecode' => '1869','language' => 'en'),
            array('id' => '181','iso' => 'LC','country' => 'SAINT LUCIA','nicename' => 'Saint Lucia','iso3' => 'LCA','numcode' => '662','phonecode' => '1758','language' => 'en'),
            array('id' => '182','iso' => 'PM','country' => 'SAINT PIERRE AND MIQUELON','nicename' => 'Saint Pierre and Miquelon','iso3' => 'SPM','numcode' => '666','phonecode' => '508','language' => 'en'),
            array('id' => '183','iso' => 'VC','country' => 'SAINT VINCENT AND THE GRENADINES','nicename' => 'Saint Vincent and the Grenadines','iso3' => 'VCT','numcode' => '670','phonecode' => '1784','language' => 'en'),
            array('id' => '184','iso' => 'WS','country' => 'SAMOA','nicename' => 'Samoa','iso3' => 'WSM','numcode' => '882','phonecode' => '684','language' => 'en'),
            array('id' => '185','iso' => 'SM','country' => 'SAN MARINO','nicename' => 'San Marino','iso3' => 'SMR','numcode' => '674','phonecode' => '378','language' => 'en'),
            array('id' => '186','iso' => 'ST','country' => 'SAO TOME AND PRINCIPE','nicename' => 'Sao Tome and Principe','iso3' => 'STP','numcode' => '678','phonecode' => '239','language' => 'en'),
            array('id' => '187','iso' => 'SA','country' => 'SAUDI ARABIA','nicename' => 'Saudi Arabia','iso3' => 'SAU','numcode' => '682','phonecode' => '966','language' => 'en'),
            array('id' => '188','iso' => 'SN','country' => 'SENEGAL','nicename' => 'Senegal','iso3' => 'SEN','numcode' => '686','phonecode' => '221','language' => 'en'),
            array('id' => '189','iso' => 'CS','country' => 'SERBIA AND MONTENEGRO','nicename' => 'Serbia and Montenegro','iso3' => NULL,'numcode' => NULL,'phonecode' => '381','language' => 'en'),
            array('id' => '190','iso' => 'SC','country' => 'SEYCHELLES','nicename' => 'Seychelles','iso3' => 'SYC','numcode' => '690','phonecode' => '248','language' => 'en'),
            array('id' => '191','iso' => 'SL','country' => 'SIERRA LEONE','nicename' => 'Sierra Leone','iso3' => 'SLE','numcode' => '694','phonecode' => '232','language' => 'en'),
            array('id' => '192','iso' => 'SG','country' => 'SINGAPORE','nicename' => 'Singapore','iso3' => 'SGP','numcode' => '702','phonecode' => '65','language' => 'en'),
            array('id' => '193','iso' => 'SK','country' => 'SLOVAKIA','nicename' => 'Slovakia','iso3' => 'SVK','numcode' => '703','phonecode' => '421','language' => 'en'),
            array('id' => '194','iso' => 'SI','country' => 'SLOVENIA','nicename' => 'Slovenia','iso3' => 'SVN','numcode' => '705','phonecode' => '386','language' => 'en'),
            array('id' => '195','iso' => 'SB','country' => 'SOLOMON ISLANDS','nicename' => 'Solomon Islands','iso3' => 'SLB','numcode' => '90','phonecode' => '677','language' => 'en'),
            array('id' => '196','iso' => 'SO','country' => 'SOMALIA','nicename' => 'Somalia','iso3' => 'SOM','numcode' => '706','phonecode' => '252','language' => 'en'),
            array('id' => '197','iso' => 'ZA','country' => 'SOUTH AFRICA','nicename' => 'South Africa','iso3' => 'ZAF','numcode' => '710','phonecode' => '27','language' => 'en'),
            array('id' => '198','iso' => 'GS','country' => 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','nicename' => 'South Georgia and the South Sandwich Islands','iso3' => NULL,'numcode' => NULL,'phonecode' => '0','language' => 'en'),
            array('id' => '199','iso' => 'ES','country' => 'SPAIN','nicename' => 'Spain','iso3' => 'ESP','numcode' => '724','phonecode' => '34','language' => 'es'),
            array('id' => '200','iso' => 'LK','country' => 'SRI LANKA','nicename' => 'Sri Lanka','iso3' => 'LKA','numcode' => '144','phonecode' => '94','language' => 'en'),
            array('id' => '201','iso' => 'SD','country' => 'SUDAN','nicename' => 'Sudan','iso3' => 'SDN','numcode' => '736','phonecode' => '249','language' => 'en'),
            array('id' => '202','iso' => 'SR','country' => 'SURINAME','nicename' => 'Suriname','iso3' => 'SUR','numcode' => '740','phonecode' => '597','language' => 'en'),
            array('id' => '203','iso' => 'SJ','country' => 'SVALBARD AND JAN MAYEN','nicename' => 'Svalbard and Jan Mayen','iso3' => 'SJM','numcode' => '744','phonecode' => '47','language' => 'en'),
            array('id' => '204','iso' => 'SZ','country' => 'SWAZILAND','nicename' => 'Swaziland','iso3' => 'SWZ','numcode' => '748','phonecode' => '268','language' => 'en'),
            array('id' => '205','iso' => 'SE','country' => 'SWEDEN','nicename' => 'Sweden','iso3' => 'SWE','numcode' => '752','phonecode' => '46','language' => 'en'),
            array('id' => '206','iso' => 'CH','country' => 'SWITZERLAND','nicename' => 'Switzerland','iso3' => 'CHE','numcode' => '756','phonecode' => '41','language' => 'en'),
            array('id' => '207','iso' => 'SY','country' => 'SYRIAN ARAB REPUBLIC','nicename' => 'Syrian Arab Republic','iso3' => 'SYR','numcode' => '760','phonecode' => '963','language' => 'en'),
            array('id' => '208','iso' => 'TW','country' => 'TAIWAN, PROVINCE OF CHINA','nicename' => 'Taiwan, Province of China','iso3' => 'TWN','numcode' => '158','phonecode' => '886','language' => 'en'),
            array('id' => '209','iso' => 'TJ','country' => 'TAJIKISTAN','nicename' => 'Tajikistan','iso3' => 'TJK','numcode' => '762','phonecode' => '992','language' => 'en'),
            array('id' => '210','iso' => 'TZ','country' => 'TANZANIA, UNITED REPUBLIC OF','nicename' => 'Tanzania, United Republic of','iso3' => 'TZA','numcode' => '834','phonecode' => '255','language' => 'en'),
            array('id' => '211','iso' => 'TH','country' => 'THAILAND','nicename' => 'Thailand','iso3' => 'THA','numcode' => '764','phonecode' => '66','language' => 'en'),
            array('id' => '212','iso' => 'TL','country' => 'TIMOR-LESTE','nicename' => 'Timor-Leste','iso3' => NULL,'numcode' => NULL,'phonecode' => '670','language' => 'en'),
            array('id' => '213','iso' => 'TG','country' => 'TOGO','nicename' => 'Togo','iso3' => 'TGO','numcode' => '768','phonecode' => '228','language' => 'en'),
            array('id' => '214','iso' => 'TK','country' => 'TOKELAU','nicename' => 'Tokelau','iso3' => 'TKL','numcode' => '772','phonecode' => '690','language' => 'en'),
            array('id' => '215','iso' => 'TO','country' => 'TONGA','nicename' => 'Tonga','iso3' => 'TON','numcode' => '776','phonecode' => '676','language' => 'en'),
            array('id' => '216','iso' => 'TT','country' => 'TRINIDAD AND TOBAGO','nicename' => 'Trinidad and Tobago','iso3' => 'TTO','numcode' => '780','phonecode' => '1868','language' => 'en'),
            array('id' => '217','iso' => 'TN','country' => 'TUNISIA','nicename' => 'Tunisia','iso3' => 'TUN','numcode' => '788','phonecode' => '216','language' => 'en'),
            array('id' => '218','iso' => 'TR','country' => 'TURKEY','nicename' => 'Turkey','iso3' => 'TUR','numcode' => '792','phonecode' => '90','language' => 'en'),
            array('id' => '219','iso' => 'TM','country' => 'TURKMENISTAN','nicename' => 'Turkmenistan','iso3' => 'TKM','numcode' => '795','phonecode' => '7370','language' => 'en'),
            array('id' => '220','iso' => 'TC','country' => 'TURKS AND CAICOS ISLANDS','nicename' => 'Turks and Caicos Islands','iso3' => 'TCA','numcode' => '796','phonecode' => '1649','language' => 'en'),
            array('id' => '221','iso' => 'TV','country' => 'TUVALU','nicename' => 'Tuvalu','iso3' => 'TUV','numcode' => '798','phonecode' => '688','language' => 'en'),
            array('id' => '222','iso' => 'UG','country' => 'UGANDA','nicename' => 'Uganda','iso3' => 'UGA','numcode' => '800','phonecode' => '256','language' => 'en'),
            array('id' => '223','iso' => 'UA','country' => 'UKRAINE','nicename' => 'Ukraine','iso3' => 'UKR','numcode' => '804','phonecode' => '380','language' => 'en'),
            array('id' => '224','iso' => 'AE','country' => 'UNITED ARAB EMIRATES','nicename' => 'United Arab Emirates','iso3' => 'ARE','numcode' => '784','phonecode' => '971','language' => 'en'),
            array('id' => '225','iso' => 'GB','country' => 'UNITED KINGDOM','nicename' => 'United Kingdom','iso3' => 'GBR','numcode' => '826','phonecode' => '44','language' => 'en'),
            array('id' => '226','iso' => 'US','country' => 'UNITED STATES','nicename' => 'United States','iso3' => 'USA','numcode' => '840','phonecode' => '1','language' => 'en'),
            array('id' => '227','iso' => 'UM','country' => 'UNITED STATES MINOR OUTLYING ISLANDS','nicename' => 'United States Minor Outlying Islands','iso3' => NULL,'numcode' => NULL,'phonecode' => '1','language' => 'en'),
            array('id' => '228','iso' => 'UY','country' => 'URUGUAY','nicename' => 'Uruguay','iso3' => 'URY','numcode' => '858','phonecode' => '598','language' => 'en'),
            array('id' => '229','iso' => 'UZ','country' => 'UZBEKISTAN','nicename' => 'Uzbekistan','iso3' => 'UZB','numcode' => '860','phonecode' => '998','language' => 'en'),
            array('id' => '230','iso' => 'VU','country' => 'VANUATU','nicename' => 'Vanuatu','iso3' => 'VUT','numcode' => '548','phonecode' => '678','language' => 'en'),
            array('id' => '231','iso' => 'VE','country' => 'VENEZUELA','nicename' => 'Venezuela','iso3' => 'VEN','numcode' => '862','phonecode' => '58','language' => 'en'),
            array('id' => '232','iso' => 'VN','country' => 'VIET NAM','nicename' => 'Viet Nam','iso3' => 'VNM','numcode' => '704','phonecode' => '84','language' => 'en'),
            array('id' => '233','iso' => 'VG','country' => 'VIRGIN ISLANDS, BRITISH','nicename' => 'Virgin Islands, British','iso3' => 'VGB','numcode' => '92','phonecode' => '1284','language' => 'en'),
            array('id' => '234','iso' => 'VI','country' => 'VIRGIN ISLANDS, U.S.','nicename' => 'Virgin Islands, U.s.','iso3' => 'VIR','numcode' => '850','phonecode' => '1340','language' => 'en'),
            array('id' => '235','iso' => 'WF','country' => 'WALLIS AND FUTUNA','nicename' => 'Wallis and Futuna','iso3' => 'WLF','numcode' => '876','phonecode' => '681','language' => 'en'),
            array('id' => '236','iso' => 'EH','country' => 'WESTERN SAHARA','nicename' => 'Western Sahara','iso3' => 'ESH','numcode' => '732','phonecode' => '212','language' => 'en'),
            array('id' => '237','iso' => 'YE','country' => 'YEMEN','nicename' => 'Yemen','iso3' => 'YEM','numcode' => '887','phonecode' => '967','language' => 'en'),
            array('id' => '238','iso' => 'ZM','country' => 'ZAMBIA','nicename' => 'Zambia','iso3' => 'ZMB','numcode' => '894','phonecode' => '260','language' => 'en'),
            array('id' => '239','iso' => 'ZW','country' => 'ZIMBABWE','nicename' => 'Zimbabwe','iso3' => 'ZWE','numcode' => '716','phonecode' => '263','language' => 'en'),
            array('id' => '240','iso' => 'RS','country' => 'SERBIA','nicename' => 'Serbia','iso3' => 'SRB','numcode' => '688','phonecode' => '381','language' => 'en'),
            array('id' => '241','iso' => 'AP','country' => 'ASIA PACIFIC REGION','nicename' => 'Asia / Pacific Region','iso3' => '0','numcode' => '0','phonecode' => '0','language' => 'en'),
            array('id' => '242','iso' => 'ME','country' => 'MONTENEGRO','nicename' => 'Montenegro','iso3' => 'MNE','numcode' => '499','phonecode' => '382','language' => 'en'),
            array('id' => '243','iso' => 'AX','country' => 'ALAND ISLANDS','nicename' => 'Aland Islands','iso3' => 'ALA','numcode' => '248','phonecode' => '358','language' => 'en'),
            array('id' => '244','iso' => 'BQ','country' => 'BONAIRE, SINT EUSTATIUS AND SABA','nicename' => 'Bonaire, Sint Eustatius and Saba','iso3' => 'BES','numcode' => '535','phonecode' => '599','language' => 'en'),
            array('id' => '245','iso' => 'CW','country' => 'CURACAO','nicename' => 'Curacao','iso3' => 'CUW','numcode' => '531','phonecode' => '599','language' => 'en'),
            array('id' => '246','iso' => 'GG','country' => 'GUERNSEY','nicename' => 'Guernsey','iso3' => 'GGY','numcode' => '831','phonecode' => '44','language' => 'en'),
            array('id' => '247','iso' => 'IM','country' => 'ISLE OF MAN','nicename' => 'Isle of Man','iso3' => 'IMN','numcode' => '833','phonecode' => '44','language' => 'en'),
            array('id' => '248','iso' => 'JE','country' => 'JERSEY','nicename' => 'Jersey','iso3' => 'JEY','numcode' => '832','phonecode' => '44','language' => 'en'),
            array('id' => '249','iso' => 'XK','country' => 'KOSOVO','nicename' => 'Kosovo','iso3' => '---','numcode' => '0','phonecode' => '381','language' => 'en'),
            array('id' => '250','iso' => 'BL','country' => 'SAINT BARTHELEMY','nicename' => 'Saint Barthelemy','iso3' => 'BLM','numcode' => '652','phonecode' => '590','language' => 'en'),
            array('id' => '251','iso' => 'MF','country' => 'SAINT MARTIN','nicename' => 'Saint Martin','iso3' => 'MAF','numcode' => '663','phonecode' => '590','language' => 'en'),
            array('id' => '252','iso' => 'SX','country' => 'SINT MAARTEN','nicename' => 'Sint Maarten','iso3' => 'SXM','numcode' => '534','phonecode' => '1','language' => 'en'),
            array('id' => '253','iso' => 'SS','country' => 'SOUTH SUDAN','nicename' => 'South Sudan','iso3' => 'SSD','numcode' => '728','phonecode' => '211','language' => 'en')
        );

        DB::table('countries')->insert($countries);


        foreach(Country::all() as $country)
        {
            $country->allowedActions()->create([  'allowShow'     => false,
                            'allowEdit'     => false,
                            'allowDelete'   => false,
                            'allowLock'     => false
                        ]);
        }




        // $this->AddCountry('Algeria', 'DZ');
        // $this->AddCountry('Angola', 'AO');
        // $this->AddCountry('Benin', 'BJ');
        // $this->AddCountry('Botswana','BW');
        // $this->AddCountry('Burkina Faso','BF');
        // $this->AddCountry('Burundi', 'BI');
        // $this->AddCountry('Cameroon', 'CM');
        // $this->AddCountry('Cape Verde', 'CV');
        // $this->AddCountry('Central African Republic','CF');
        // $this->AddCountry('Chad', 'TD');
        // $this->AddCountry('Democratic Republic of the Congo','CD');
        // $this->AddCountry('Djibouti','DJ');
        // $this->AddCountry('Egypt', 'EG');
        // $this->AddCountry('Equatorial Guinea','GQ');
        // $this->AddCountry('Eritrea','ER');
        // $this->AddCountry('Ethiopia','ET');
        // $this->AddCountry('Gabon','GA');
        // $this->AddCountry('Gambia','GM');
        // $this->AddCountry('Ghana','GH');
        // $this->AddCountry('Guinea','GN');
        // $this->AddCountry('Guinea-Bissau','GW');
        // $this->AddCountry('Ivory Coast','CI');
        // $this->AddCountry('Kenya','KE');
        // $this->AddCountry('Lesotho','LS');
        // $this->AddCountry('Liberia','LR');
        // $this->AddCountry('Libya','LY');
        // $this->AddCountry('Madagascar','MG');
        // $this->AddCountry('Malawi','MW');
        // $this->AddCountry('Mali','ML');
        // $this->AddCountry('Mauritania','MR');
        // $this->AddCountry('Mauritius','MU');
        // $this->AddCountry('Mayotte','YT');
        // $this->AddCountry('Morocco','MA');
        // $this->AddCountry('Mozambique','MZ');
        // $this->AddCountry('Namibia','NA');
        // $this->AddCountry('Niger','NE');
        // $this->AddCountry('Nigeria','NG');
        // $this->AddCountry('Republic of the Congo','CG');
        // $this->AddCountry('Reunion','RE');
        // $this->AddCountry('Rwanda','RW');
        // $this->AddCountry('Saint Helena','SH');
        // $this->AddCountry('Säo Tomé and Príncipe','ST');
        // $this->AddCountry('Senegal','SN');
        // $this->AddCountry('Seychelles','SC');
        // $this->AddCountry('Sierra Leone','SL');
        // $this->AddCountry('Somalia','SO');
        // $this->AddCountry('South Africa','ZA');
        // $this->AddCountry('South Sudan','SS');
        // $this->AddCountry('Sudan','SD');
        // $this->AddCountry('Suriname','SR');
        // $this->AddCountry('Swaziland','SZ');
        // $this->AddCountry('Togo','TG');
        // $this->AddCountry('Tunisia','TN');
        // $this->AddCountry('Uganda','UG');
        // $this->AddCountry('United Republic of Tanzania','TZ');
        // $this->AddCountry('Western Sahara','EH');
        // $this->AddCountry('Yemen','YE');
        // $this->AddCountry('Zambia','ZM');
        // $this->AddCountry('Zimbabwe','ZW');
        // $this->AddCountry('Anguilla','AI');
        // $this->AddCountry('Antigua and Barbuda','AG');
        // $this->AddCountry('Argentina','AR');
        // $this->AddCountry('Aruba','AW');
        // $this->AddCountry('Bahamas','BS');
        // $this->AddCountry('Barbados','BB');
        // $this->AddCountry('Bonaire, Sint Eustatius and Saba','BQ');
        // $this->AddCountry('Belize','BZ');
        // $this->AddCountry('Bermuda','BM');
        // $this->AddCountry('Bolivia','BO');
        // $this->AddCountry('Virgin Islands, British','VG');
        // $this->AddCountry('Brazil','BR');
        // $this->AddCountry('Canada','CA');
        // $this->AddCountry('Kyrgyztan','KY');
        // $this->AddCountry('Chile','CL');
        // $this->AddCountry('Colombia','CO');
        // $this->AddCountry('Comoras','KM');
        // $this->AddCountry('Costa Rica','CR');
        // $this->AddCountry('Cuba','CU');
        // $this->AddCountry('Curacao','CW');
        // $this->AddCountry('Dominica','DM');
        // $this->AddCountry('Dominican Republic','DO');
        // $this->AddCountry('Ecuador','EC');
        // $this->AddCountry('El Salvador','SV');
        // $this->AddCountry('Falkland Islands','FK');
        // $this->AddCountry('French Guiana','GF');
        // $this->AddCountry('Greenland','GL');
        // $this->AddCountry('Grenada','GD');
        // $this->AddCountry('Guadeloupe','GP');
        // $this->AddCountry('Guatemala','GT');
        // $this->AddCountry('Guyana','GY');
        // $this->AddCountry('Haiti','HT');
        // $this->AddCountry('Honduras','HN');
        // $this->AddCountry('Jamaica','JM');
        // $this->AddCountry('Martinique','MQ');
        // $this->AddCountry('Mexico','MX');
        // $this->AddCountry('Montserrat','MS');
        // $this->AddCountry('Nicaragua','NI');
        // $this->AddCountry('Panama','PA');
        // $this->AddCountry('Paraguay','PY');
        // $this->AddCountry('Peru','PE');
        // $this->AddCountry('Puerto Rico','PR');
        // $this->AddCountry('Saint Barthélemy','BL');
        // $this->AddCountry('Saint Kitts and Nevis','KN');
        // $this->AddCountry('Saint Lucia','LC');
        // $this->AddCountry('Saint Pierre and Miquelon','PM');
        // $this->AddCountry('Saint Vicent and the Grenadines','VC');
        // $this->AddCountry('Saint Maarten','SX');
        // $this->AddCountry('Trinidad and Tobago','TT');
        // $this->AddCountry('Turks and Caicos Islands','TC');
        // $this->AddCountry('United States','US');
        // $this->AddCountry('United States Virgin Islands','VI');
        // $this->AddCountry('Uruguay','UY');
        // $this->AddCountry('Venezuela','VE');
        // $this->AddCountry('Afganistan','AF');
        // $this->AddCountry('Azerbaijan','AZ');
        // $this->AddCountry('Bangladesh','BD');
        // $this->AddCountry('Bhutan','BT');
        // $this->AddCountry('Brunei Darussalam','BN');
        // $this->AddCountry('Cambodia','KH');
        // $this->AddCountry('Mainland China','CN');
        // $this->AddCountry('Georgia','GE');
        // $this->AddCountry('Hong Kong SAR','HK');
        // $this->AddCountry('India','IN');
        // $this->AddCountry('Indonesia','ID');
        // $this->AddCountry('Japan','JP');
        // $this->AddCountry('Kazakhstan','KZ');
        // $this->AddCountry('Laos','LA');
        // $this->AddCountry('Macao SAR','MO');
        // $this->AddCountry('Malaysia','MY');
        // $this->AddCountry('Maldives','MV');
        // $this->AddCountry('Mongolia','MN');
        // $this->AddCountry('Myanmar','MM');
        // $this->AddCountry('Nepal','NP');
        // $this->AddCountry('North Korea','KP');
        // $this->AddCountry('Northern Mariana Islands','MP');
        // $this->AddCountry('Palau','PW');
        // $this->AddCountry('Papua New Guinea','PG');
        // $this->AddCountry('Phillipeans','PH');
        // $this->AddCountry('Singapore','SG');
        // $this->AddCountry('Korea','KR');
        // $this->AddCountry('Sri Lanka','LK');
        // $this->AddCountry('Taiwan region','TW');
        // $this->AddCountry('Tajikistan','TJ');
        // $this->AddCountry('Thailand','TH');
        // $this->AddCountry('Timor-Leste','TL');
        // $this->AddCountry('Turkmenistan','TM');
        // $this->AddCountry('Vietnam','VN');
        // $this->AddCountry('Albania','AL');
        // $this->AddCountry('Andorra','AD');
        // $this->AddCountry('Armenia','AM');
        // $this->AddCountry('Austria','AT');
        // $this->AddCountry('Belarus','BY');
        // $this->AddCountry('Belgum','BE');
        // $this->AddCountry('Bosnia And Herzegovina','BA');
        // $this->AddCountry('Bulgaria','BG');
        // $this->AddCountry('Croatia','HR');
        // $this->AddCountry('Cyprus','CY');
        // $this->AddCountry('Czech Republic','CZ');
        // $this->AddCountry('Denmark','DK');
        // $this->AddCountry('Estonia','EE');
        // $this->AddCountry('Faroe Islands','FO');
        // $this->AddCountry('Finland','FI');
        // $this->AddCountry('France','FR');
        // $this->AddCountry('Germany','DE');
        // $this->AddCountry('Gibraltar','GI');
        // $this->AddCountry('Greece','GR');
        // $this->AddCountry('Hungary','HU');
        // $this->AddCountry('Iceland','IS');
        // $this->AddCountry('Ireland','IE');
        // $this->AddCountry('Isle of Man','IM');
        // $this->AddCountry('Italy','IT');
        // $this->AddCountry('Jersey','JE');
        // $this->AddCountry('Kosovo','XK');
        // $this->AddCountry('Latvia','LV');
        // $this->AddCountry('Liechtenstein','LI');
        // $this->AddCountry('Lithuania','LT');
        // $this->AddCountry('Luxembourg','LU');
        // $this->AddCountry('Malta','MT');
        // $this->AddCountry('Moldova','MD');
        // $this->AddCountry('Monaco','MC');
        // $this->AddCountry('Montenegro','ME');
        // $this->AddCountry('Netherland','NL');
        // $this->AddCountry('North Macedonia','MK');
        // $this->AddCountry('Norway','NO');
        // $this->AddCountry('Poland','PL');
        // $this->AddCountry('Portugal','PT');
        // $this->AddCountry('Romania','RO');
        // $this->AddCountry('Russian Federation','RU');
        // $this->AddCountry('San Marino','SM');
        // $this->AddCountry('Serbia','RS');
        // $this->AddCountry('Slovakia','SK');
        // $this->AddCountry('Slovenia','SI');
        // $this->AddCountry('Spain','ES');
        // $this->AddCountry('Sweden','SE');
        // $this->AddCountry('Switzerland','CH');
        // $this->AddCountry('Turkey','TR');
        // $this->AddCountry('Ukraine','UA');
        // $this->AddCountry('Great Britain','GB');
        // $this->AddCountry('Vatican City','VA');
        // $this->AddCountry('Bahrain','BH');
        // $this->AddCountry('Iran','IR');
        // $this->AddCountry('Iraq','IQ');
        // $this->AddCountry('Israel','IL');
        // $this->AddCountry('Kuwait','KW');
        // $this->AddCountry('Jordan','JO');
        // $this->AddCountry('Kyrgyzstan','KG');
        // $this->AddCountry('Lebanon','LB');
        // $this->AddCountry('Pakistan','PK');
        // $this->AddCountry('Palestinian Territories','PS');
        // $this->AddCountry('Qatar','QA');
        // $this->AddCountry('Saudi Arabia','SA');
        // $this->AddCountry('Syria','SY');
        // $this->AddCountry('United Arab Emirates','AE');
        // $this->AddCountry('Uzbekistan','UZ');
        // $this->AddCountry('American Samoa','AS');
        // $this->AddCountry('Australia','AU');
        // $this->AddCountry('Christmas Island','CX');
        // $this->AddCountry('Cocos (Keeling) Islands','CC');
        // $this->AddCountry('Cook Islands','CK');
        // $this->AddCountry('Fiji','FJ');
        // $this->AddCountry('French Polynesia','PF');
        // $this->AddCountry('Guam','GU');
        // $this->AddCountry('Kiribati','KI');
        // $this->AddCountry('Marshall Islands','MH');
        // $this->AddCountry('Federated States of Micronesia','FM');
        // $this->AddCountry('New Caledonia','NC');
        // $this->AddCountry('New Zealand','NZ');
        // $this->AddCountry('Nauru','NR');
        // $this->AddCountry('Niue','NU');
        // $this->AddCountry('Norfolk Island','NF');
        // $this->AddCountry('Samoa','WS');
        // $this->AddCountry('Solomon Islands','SB');
        // $this->AddCountry('Tokelau','TK');
        // $this->AddCountry('Tonga','TO');
        // $this->AddCountry('Tuvalu','TV');
        // $this->AddCountry('Vanuatu','VU');
        // $this->AddCountry('Wallis and Futuna','WF');
        // $this->AddCountry('European Union','EU');
        // $this->AddCountry('Jolly Roger','JR');
        // $this->AddCountry('Olympics', 'OLY');
        // $this->AddCountry('United Nations', 'UN');

        // $c=Country::where('country','Spain')
        //     ->orWhere('nicename', 'Spain')->first();
        // $c->setTranslation('country','es','España');

        // $c=Country::where('country','Italy')
        //     ->orWhere('nicename', 'Italy')->first();
        // $c->setTranslation('country','es','Italia');

        // $c=Country::where('country','European Union')
        //     ->orWhere('nicename', 'European Union')->first();
        // $c->setTranslation('country','es','Union Europea');

        // $c=Country::where('country','United States')
        //     ->orWhere('nicename', 'United States')->first();
        // $c->setTranslation('country','es','Estados Unidos');

        // $c=Country::where('country','Brazil')
        //     ->orWhere('nicename', 'Brazil')->first();
        // $c->setTranslation('country','es','Brasil');

        // $c=Country::where('country','Croatia')
        //     ->orWhere('nicename', 'Croatia')->first();
        // $c->setTranslation('country','es','Croacia');

        // $c=Country::where('country','Denmark')
        //     ->orWhere('nicename', 'Denmark')->first();
        // $c->setTranslation('country','es','Dinamarca');

        // $c=Country::where('country','Dominican Republic')
        //     ->orWhere('nicename', 'Dominican Republic')->first();
        // $c->setTranslation('country','es','República Dominicana');

        // $c=Country::where('country','Egypt')
        //     ->orWhere('nicename', 'Egypt')->first();
        // $c->setTranslation('country','es','Egipto');

        // $c=Country::where('country','Finland')
        //     ->orWhere('nicename', 'Finland')->first();
        // $c->setTranslation('country','es','Finlandia');

        // $c=Country::where('country','France')
        //     ->orWhere('nicename', 'France')->first();
        // $c->setTranslation('country','es','Francia');

        // $c=Country::where('country','Germany')
        //     ->orWhere('nicename', 'Germany')->first();
        // $c->setTranslation('country','es','Alemania');

        // $c=Country::where('country','Great Britain')
        //     ->orWhere('nicename', 'Great Britain')->first();
        // $c->setTranslation('country','es','Gran Bretaña');


        // $c=Country::where('country','Greece')
        //     ->orWhere('nicename', 'Greece')->first();
        // $c->setTranslation('country','es','Grecia');

        // $c=Country::where('country','Ireland')
        //     ->orWhere('nicename', 'Ireland')->first();
        // $c->setTranslation('country','es','Irlanda');

        // $c=Country::where('country','Japan')
        //     ->orWhere('nicename', 'Japan')->first();
        // $c->setTranslation('country','es','Japón');

        // $c=Country::where('country','Luxembourg')
        //     ->orWhere('nicename', 'Luxembourg')->first();
        // $c->setTranslation('country','es','Luxemburgo');

        // $c=Country::where('country','Morocco')
        //     ->orWhere('nicename', 'Morocco')->first();
        // $c->setTranslation('country','es','Marruecos');

        // $c=Country::where('country','Netherland')
        //     ->orWhere('nicename', 'Netherland')->first();
        // $c->setTranslation('country','es','Holanda');

        // $c=Country::where('country','Norway')
        //     ->orWhere('nicename', 'Norway')->first();
        // $c->setTranslation('country','es','Noruega');

        // $c=Country::where('country','Russian Federation')
        //     ->orWhere('nicename', 'Russian Federation')->first();
        // $c->setTranslation('country','es','Rusia');

        // $c=Country::where('country','Sweden')
        //     ->orWhere('nicename', 'Sweden')->first();
        // $c->setTranslation('country','es','Suecia');

        // $c=Country::where('country','Switzerland')
        //     ->orWhere('nicename', 'Switzerland')->first();
        // $c->setTranslation('country','es','Suiza');

        // $c=Country::where('country','Turkey')
        //     ->orWhere('nicename', 'Turkey')->first();
        // $c->setTranslation('country','es','Turkia');

        // $c=Country::where('country','United Nations')
        //     ->orWhere('nicename', 'United Nations')->first();
        // $c->setTranslation('country','es','Naciones Unidas');

        $this->TranslateCountry('Spain', $locale='es', $translation='España');
        $this->TranslateCountry('Italy', $locale='es', $translation='Italia');
        $this->TranslateCountry('European Union', $locale='es', $translation='Unión Europea');
        $this->TranslateCountry('United States', $locale='es', $translation='Estados Unidos');
        $this->TranslateCountry('Brazil', $locale='es', $translation='Brasil');
        $this->TranslateCountry('Croatia', $locale='es', $translation='Croacia');
        $this->TranslateCountry('Denmark', $locale='es', $translation='Dinamarca');
        $this->TranslateCountry('Dominican Republic', $locale='es', $translation='República Dominicana');
        $this->TranslateCountry('Egypt', $locale='es', $translation='Egipto');
        $this->TranslateCountry('Finland', $locale='es', $translation='Finlandia');
        $this->TranslateCountry('France', $locale='es', $translation='Francia');
        $this->TranslateCountry('Germany', $locale='es', $translation='Alemania');
        $this->TranslateCountry('United Kingdom', $locale='es', $translation='Inglaterra');
        $this->TranslateCountry('Greece', $locale='es', $translation='Grecia');
        $this->TranslateCountry('Ireland', $locale='es', $translation='Irlanda');
        $this->TranslateCountry('Japan', $locale='es', $translation='Japón');
        $this->TranslateCountry('Luxembourg', $locale='es', $translation='Luxemburgo');
        $this->TranslateCountry('Morocco', $locale='es', $translation='Marruecos');
        $this->TranslateCountry('Netherland', $locale='es', $translation='Holanda');
        $this->TranslateCountry('Norway', $locale='es', $translation='Noruega');
        $this->TranslateCountry('Russian Federation', $locale='es', $translation='Federación Rusa');
        $this->TranslateCountry('Sweden', $locale='es', $translation='Suecia');
        $this->TranslateCountry('Switzerland', $locale='es', $translation='Suiza');
        $this->TranslateCountry('Turkey', $locale='es', $translation='Turkía');
        $this->TranslateCountry('United Nations', $locale='es', $translation='Naciones Unidas');


    }

    public function TranslateCountry($country, $locale='', $translation='')
    {
        if ($translation=='') return;
        if ($locale=='') $locale=App::getLocale();
        $c=Country::where('country',mb_strtoupper($country))
            ->orWhere('nicename', $country)->first();
        if ($c!=null) $c->setTranslation('country', $locale, mb_strtoupper($translation) );
    }

    public function AddCountry($country, $code)
    {
        $record=new Country();
        $record->country=$country;
        $record->code=$code;
        $record->save();
        $record->allowedActions()->create([     'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);
    }
}
