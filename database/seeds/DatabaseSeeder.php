<?php

use App\Field;
use App\Goal;
use App\User;
use App\Role;
use App\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->users_and_roles();
        $this->srips();
        $this->fields();
        $this->goals();
        $this->categories();
        // $this->call(UsersTableSeeder::class);
    }

    // Fill the fields
    public function fields()
    {
        $fields = [
            ['name' => 'Tehnologija - pridelava', 'srip_id' => '1'],
            ['name' => 'Tehnologija - predelava', 'srip_id' => '1'],
            ['name' => 'Distribucija', 'srip_id' => '1'],
            ['name' => 'Kakovost živil', 'srip_id' => '1'],
            ['name' => 'Embalaža', 'srip_id' => '1'],
            ['name' => 'Prehrana v javnih zavodih', 'srip_id' => '1'],
            ['name' => 'Novi izdelki', 'srip_id' => '1'],
            ['name' => 'Surovine', 'srip_id' => '1'],
            ['name' => 'Povezovanje / prenos znanja', 'srip_id' => '1'],
            ['name' => 'Učinki na zdravje', 'srip_id' => '1'],
            ['name' => 'Poskusni / testni centri', 'srip_id' => '1'],
            ['name' => 'Podaljšanje obstojnosti', 'srip_id' => '2'],
            ['name' => 'Potvorbe', 'srip_id' => '2'],
            ['name' => 'Analiza dejavnikov tveganj', 'srip_id' => '2'],
            ['name' => 'Mikrobiološki dejavniki tveganja', 'srip_id' => '2'],
            ['name' => 'Rezistenca', 'srip_id' => '2'],
            ['name' => 'Biofilmi', 'srip_id' => '2'],
            ['name' => 'Čistila', 'srip_id' => '2'],
            ['name' => 'Aktivne funkcionalne sestavine', 'srip_id' => '2'],
            ['name' => 'Logistika - varnost živil', 'srip_id' => '2'],
            ['name' => 'Zaščita živil', 'srip_id' => '2'],
            ['name' => 'Kemijski dejavniki tveganj', 'srip_id' => '2'],
            ['name' => 'Materiali, ki prihajajo v stik z živili', 'srip_id' => '2'],
            ['name' => 'Gensko spremenjeni organizmi', 'srip_id' => '2'],
            ['name' => 'Sledljivost', 'srip_id' => '2'],
            ['name' => 'Analitika', 'srip_id' => '2'],
            ['name' => 'Tehnološki procesi', 'srip_id' => '2'],
            ['name' => 'Higienski design', 'srip_id' => '2'],
            ['name' => 'Kakovost - varnost', 'srip_id' => '2'],
            ['name' => 'Novi izdelki', 'srip_id' => '2'],
            ['name' => 'Fizikalni dejavniki tveganja', 'srip_id' => '2'],
            ['name' => 'Alergeni', 'srip_id' => '2'],
            ['name' => 'Kultura zagotavljanja varnosti živil', 'srip_id' => '2'],
            ['name' => 'Hrana kot odpadek', 'srip_id' => '2'],
            ['name' => 'Živilske verige', 'srip_id' => '2'],
            ['name' => 'Baze - podatki', 'srip_id' => '2'],
            ['name' => 'Risk communication', 'srip_id' => '2'],
            ['name' => 'Čistila', 'srip_id' => '2']
        ];
        Field::insert($fields);
    }

    // Fill the users
    public function users_and_roles()
    {
        User::insert([
            'name' => 'Lenart Papež',
            'email' => 'admin@portal.si',
            'password' => bcrypt('admin'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Role::insert(['name' => 'super_admin']);
        Role::insert(['name' => 'admin']);
        Role::insert(['name' => 'editor']);
        DB::table('role_user')->insert(['role_id' => 1, 'user_id' => 1]);
    }

    // Fill the SRIP
    public function srips()
    {
        DB::table('srips')->insert([['name' => 'SRIP3'], ['name' => 'SRIP4']]);
    }

    // Fill the goals
    public function goals()
    {
        $goals = [
            ['name' => 'Optimizacija pridelave zelenjave', 'field_id' => '1'],
            ['name' => 'Kultivacija alg', 'field_id' => '1'],
            ['name' => 'Prekrivne folije', 'field_id' => '1'],
            ['name' => 'Testiranje zastirk pridelave zelenjave', 'field_id' => '1'],
            ['name' => 'Ponovna uporaba hranil za pridelavo hrane', 'field_id' => '1'],
            ['name' => 'Inovativni stroji', 'field_id' => '1'],
            ['name' => 'Pametni stroji', 'field_id' => '1'],
            ['name' => 'Monitoring iz zraka', 'field_id' => '1'],
            ['name' => 'Uničevanje bolezni', 'field_id' => '1'],
            ['name' => 'Tehnologija namakanja', 'field_id' => '1'],
            ['name' => 'Tehnologije za uporabo alternativnih dodatkov', 'field_id' => '1'],
            ['name' => 'Plazemska obdelava semen', 'field_id' => '1'],
            ['name' => 'Plazemski reaktor', 'field_id' => '1'],
            ['name' => 'Razvoj plazemske linije bolezni', 'field_id' => '1'],
            ['name' => 'Avtomatska linija za obdelavo semen', 'field_id' => '1'],
            ['name' => 'Testiranje pridelkov', 'field_id' => '1'],
            ['name' => 'Raziskava tržišča', 'field_id' => '1'],
            ['name' => 'Razvoj novih sort poljščin', 'field_id' => '1'],
            ['name' => 'Precizno kmetijstvo', 'field_id' => '1'],
            ['name' => 'Biooglje', 'field_id' => '1'],
            ['name' => 'Tehnologija sušenja', 'field_id' => '1'],
            ['name' => 'Razvoj novih hladilnih sistemov', 'field_id' => '1'],
            ['name' => 'Avtomatsko obiranje / ali nanašanje FFS', 'field_id' => '1'],
            ['name' => 'Funkcionalni krmni dodatki', 'field_id' => '1'],
            ['name' => 'Pametni rastlinjaki', 'field_id' => '1'],
            ['name' => 'Minimalna predelava', 'field_id' => '2'],
            ['name' => 'Alternativni načini predelave', 'field_id' => '2'],
            ['name' => 'Elektroporacija', 'field_id' => '2'],
            ['name' => 'Omsko gretje', 'field_id' => '2'],
            ['name' => 'Plazemske linije za obdelavo živil pred pakiranjem', 'field_id' => '2'],
            ['name' => 'Inovativni stroji', 'field_id' => '2'],
            ['name' => 'Namenska hidravlika in pnevmatika', 'field_id' => '2'],
            ['name' => 'Tribologija', 'field_id' => '2'],
            ['name' => '3D tiskanje v živlistvu', 'field_id' => '2'],
            ['name' => 'Sterilizacija', 'field_id' => '2'],
            ['name' => 'Linije za pakiranje', 'field_id' => '2'],
            ['name' => 'Odpadki hrane', 'field_id' => '2'],
            ['name' => 'Povečanje učinkovitosti stiskanja, ekstrakcije', 'field_id' => '2'],
            ['name' => 'Tehnologije za razvoj novih jedi, izdelkov', 'field_id' => '2'],
            ['name' => 'IKT', 'field_id' => '2'],
            ['name' => 'Metode za zagotavljanje varnosti hrane', 'field_id' => '2'],
            ['name' => 'Prepoznavanje tarčnih proteinov', 'field_id' => '2'],
            ['name' => 'Novi izdelki s specifičnimi senzoričnimi lastnostmi', 'field_id' => '2'],
            ['name' => 'Procesna kontrola kakovosti živil', 'field_id' => '2'],
            ['name' => 'Sprejemljivost in obstojnost končnega izdelka', 'field_id' => '2'],
            ['name' => 'Razvoj novih izdelkov z upoštevanjem zahtev trga', 'field_id' => '2'],
            ['name' => 'Optimizacija tehnologij termične priprave hrane', 'field_id' => '2'],
            ['name' => 'Nove tehnike, sestavine in naprave v gastronomiji', 'field_id' => '2'],
            ['name' => 'Plazemska tehnologija za vezavo dušika', 'field_id' => '2'],
            ['name' => 'Testiranje tehnologij', 'field_id' => '2'],
            ['name' => 'Izolacija bioaktivnih  proteinov', 'field_id' => '2'],
            ['name' => 'Ultrazvok, homeogenizacija pri visokem tlaku in mikrovalovi', 'field_id' => '2'],
            ['name' => 'Tehnologija - distribucija', 'field_id' => '3'],
            ['name' => 'Ohranjanje kakovosti', 'field_id' => '4'],
            ['name' => 'Senzorično ocenjevanje', 'field_id' => '4'],
            ['name' => 'Kakovost / genetika', 'field_id' => '4'],
            ['name' => 'Prehranska vrednost in senzorična kakovost živil', 'field_id' => '4'],
            ['name' => 'Pakiranje', 'field_id' => '5'],
            ['name' => 'Inteligentna embalaža', 'field_id' => '5'],
            ['name' => 'Aktivno pakiranje', 'field_id' => '5'],
            ['name' => 'Ekološka embalaža', 'field_id' => '5'],
            ['name' => 'Embalaža kot surovina', 'field_id' => '5'],
            ['name' => 'Grafična podoba', 'field_id' => '5'],
            ['name' => 'Novi embalažni materiali', 'field_id' => '5'],
            ['name' => 'Užitna in biorazgradljiva embalaža', 'field_id' => '5'],
            ['name' => 'Oprema za pakiranje in atmosfera', 'field_id' => '5'],
            ['name' => 'Bio polnila', 'field_id' => '5'],
            ['name' => 'Inovativni materiali - vlakna', 'field_id' => '5'],
            ['name' => 'Javna prehrana', 'field_id' => '6'],
            ['name' => 'Kratke verige', 'field_id' => '6'],
            ['name' => 'Razvoj funkcionalnih živil in prehranskih dopoolnil', 'field_id' => '7'],
            ['name' => 'Surovine', 'field_id' => '8'],
            ['name' => 'Povezovanje / prenos znanja', 'field_id' => '9'],
            ['name' => 'Šolanje', 'field_id' => '9'],
            ['name' => 'Kalibracija', 'field_id' => '9'],
            ['name' => 'Organizacija dela', 'field_id' => '9'],
            ['name' => 'Učinki hrane na zdravje', 'field_id' => '10'],
            ['name' => 'Klinična prehrana', 'field_id' => '10'],
            ['name' => 'Prenašanje tehnologij iz znanstvenega v aplikativno raziskovanje', 'field_id' => '11'],
            ['name' => 'Podaljšana obstojnost in svežina živil', 'field_id' => '12'],
            ['name' => 'Pristnost in potvorbe surovin, postopkov, izdelkov, deklaracij', 'field_id' => '13'],
            ['name' => 'Analiza procesnih in prerekvizitnih  dejavnikov tveganj osnovana na oceni tveganja', 'field_id' => '14'],
            ['name' => 'Mikrobiološki dejavniki tveganj', 'field_id' => '15'],
            ['name' => 'Odpornost mikroorganizmov na različne kemijske snovi in fizikalno kemijske postopke', 'field_id' => '16'],
            ['name' => 'Biofilmi v ŽPO', 'field_id' => '17'],
            ['name' => 'Mikroorganizmi  in toksini', 'field_id' => '18'],
            ['name' => 'Analiza tveganj novih aktivnih (funkcionalnih) sestavin - nova živila)', 'field_id' => '19'],
            ['name' => 'Zagotavljanje varnosti živil - v logistiki', 'field_id' => '20'],
            ['name' => 'Zaščita živil – grožnje in kritična področja', 'field_id' => '21'],
            ['name' => 'Analiza kemijskih dejavnikov tveganj na oceni tveganja', 'field_id' => '22'],
            ['name' => 'Kemijski dejavniki tveganj', 'field_id' => '22'],
            ['name' => 'Rezistenca', 'field_id' => '22'],
            ['name' => 'Ocena tveganja', 'field_id' => '23'],
            ['name' => 'Detekcija spojin embalažnih materialov', 'field_id' => '23'],
            ['name' => 'Detekcija GSO', 'field_id' => '24'],
            ['name' => 'Sledljivost porekla', 'field_id' => '25'],
            ['name' => 'Sledljivost - surovin/živil', 'field_id' => '25'],
            ['name' => 'Sledljivost - procesi in hladna veriga', 'field_id' => '25'],
            ['name' => 'Sledljivost, primerljivost rezultatov analiz', 'field_id' => '25'],
            ['name' => 'Vzorčenje / reprezentativen vzorec', 'field_id' => '26'],
            ['name' => 'Analiza sestavin živil s separacijskimi in spektroskopskimi tehnikami', 'field_id' => '26'],
            ['name' => 'Analiza snovi živil / nove metode', 'field_id' => '26'],
            ['name' => 'Protimikrobne snovi', 'field_id' => '26'],
            ['name' => 'Tehnološki procesi  - optimizacija', 'field_id' => '27'],
            ['name' => 'Tehnološki procesi za višjo kakovost /varnost pitne vode', 'field_id' => '27'],
            ['name' => 'Tehnologije v agrotehničnih ukrepih', 'field_id' => '27'],
            ['name' => 'Avtomatizacija procesov', 'field_id' => '27'],
            ['name' => 'Nadzor nad parametri (T)', 'field_id' => '27'],
            ['name' => 'Higienski design - multidisciplinarni pristop', 'field_id' => '28'],
            ['name' => 'Higienski design - izboljšave', 'field_id' => '28'],
            ['name' => 'Parametri kakovosti živil in hranilna vrednost', 'field_id' => '29'],
            ['name' => 'Tradicionalna živila "domače"', 'field_id' => '29'],
            ['name' => '"Nove" užitne snovi v gostinstvu', 'field_id' => '29'],
            ['name' => 'Živila z manj aditivov, brez konzervansov', 'field_id' => '29'],
            ['name' => 'Visoko kakovostni izdelki', 'field_id' => '29'],
            ['name' => 'Zaščita', 'field_id' => '29'],
            ['name' => 'Novi izdelki', 'field_id' => '30'],
            ['name' => 'Nove sestavine, pomožna tehnološka sredstva, starterske kulture', 'field_id' => '30'],
            ['name' => 'Fizikalni dejavniki tveganja', 'field_id' => '31'],
            ['name' => 'Alergeni', 'field_id' => '32'],
            ['name' => 'Food safety culture', 'field_id' => '33'],
            ['name' => 'Uporaba zavržkov hrane', 'field_id' => '34'],
            ['name' => 'Verige', 'field_id' => '35'],
            ['name' => 'Harmonizacija nacionalnih predpisov', 'field_id' => '36'],
            ['name' => 'Food Safety Izvedenci - baza', 'field_id' => '36'],
            ['name' => 'Podatki - zbirna točka', 'field_id' => '36'],
            ['name' => 'Baza podatkov o rezultatih analiz', 'field_id' => '36'],
            ['name' => 'Podatki – zbiranje in obdelava', 'field_id' => '36'],
            ['name' => 'Komunikacija o tveganjih', 'field_id' => '37'],
            ['name' => 'Čistila', 'field_id' => '38'],

        ];
        Goal::insert($goals);
    }

    public function categories()
    {
        $categories = [
            [ 'title' => 'Laboratoriji' ],
            [ 'title' => 'Oprema' ],
            [ 'title' => 'Varnost' ],
            [ 'title' => 'Kakovost' ]
        ];
        Category::insert($categories);
    }
}
