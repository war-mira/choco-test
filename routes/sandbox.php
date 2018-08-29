<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.11.2017
 * Time: 15:24
 */

use App\Doctor;
use App\Skill;
use Illuminate\Support\Facades\Redis;

Route::group(['middleware' => 'role:superdev', 'as' => 'sandbox.', 'prefix' => 'sandbox'], function () {
    Route::get('/test', function () {
        return response('ok');
    })->name('test');
    Route::get('enumImages', 'Sandbox\ImageStorageController@enumImages');
    Route::get('checkBindings', 'Sandbox\ImageStorageController@checkBindings');
    Route::post('removeImages', 'Sandbox\ImageStorageController@removeImages')->name('removeImages');
    Route::get('/testSms', 'Sandbox\SmsServiceTestController@testSend');
    Route::get('/testPhoneVerify', 'Auth\PhoneVerificationController@requestCode');
    Route::get('/reacalcDoctorsRate', 'Sandbox\DoctorRateController@recalcRate');
    Route::get('/clientsReport', 'Sandbox\OrdersReportController@clientsReport');
    Route::get('/migrateMedcenterAvatar', 'Sandbox\MedcenterAvatarMigrationController@migrateAvatars');

    Route::get('/migrateOrdersTimestamps', 'Sandbox\OrdersMigrationController@migrateTimestamps');

    Route::get('/migratePostCoverImages', 'Sandbox\PostsCoverMigrationController@migrateCovers');
    Route::get('/migratePostTimestamps', 'Sandbox\PostsTimestampsMigrationController@migrateTimestamps');
    Route::get('/seedDoctorStatuses', 'Sandbox\StatusesSeedController@seedDoctorStatuses');

    Route::get('/migrateCommentsTimestamps', 'Sandbox\CommentsTimestampsMigrationController@migrateTimestamps');

    Route::get('/lostClients18', 'Sandbox\OrdersReportController@lostClients');

    Route::get('/migrateRating', 'Sandbox\RatingMigrationController@migrateRating');

    Route::get('/fixPhones', 'Sandbox\PhoneFormatFixController@fixPhones');

    Route::get('/components/pair-select', function () {
        $data1 = \App\Doctor::query()->where('status', 1)->orderBy('lastname')->get()->mapWithKeys(function ($doctor) {
            return [
                $doctor->id => [
                    'title' => $doctor->name,
                    'bind' => $doctor->medcenters()->pluck('medcenters.id')
                ]
            ];
        });
        $data2 = \App\Medcenter::query()->orderBy('name')->get()->mapWithKeys(function ($medcenter) {
            return [
                $medcenter->id => [
                    'title' => $medcenter->name,
                    'bind' => $medcenter->doctors()->pluck('doctors.id')
                ]
            ];
        });

        $id = 'composgpto';
        return view('test.pair-select', compact('id', 'data1', 'data2'));
    });
    Route::get('memcacheView', function () {
        return view('test.memcache');
    });

    Route::get('memcache', function (\Illuminate\Http\Request $request) {
        $lastUpdate = $request->query('t', 0);
        $value = \Illuminate\Support\Facades\Cache::get('memtest');

        if ($lastUpdate < $value['t'])
            return response($value, 200);
        else
            return response('', 304);
    });

    Route::post('memcache', function (\Illuminate\Http\Request $request) {
        $value = $request->input('value');
        $t = now()->timestamp;
        \Illuminate\Support\Facades\Cache::put('memtest', compact('value', 't'), 10);
        return $value;
    });


    Route::get('comment-digest',function (){
        $digest = \App\Comment::where([
                'status'=>1,
                'owner_type'=>'Doctor',
                ['created_at','>',\Carbon\Carbon::now()->startOfWeek()->toDateTimeString()]
            ])
            ->get()
            ->groupBy('owner_id')
            ->transform(function ($item,$key){

                $doc = Doctor::find($key);

                $name = $doc->firstname . ' ' . $doc->lastname;
                $mail = $doc->user ? $doc->user->email : $doc->email;

                $mail = 'alex@fed.kz';

                if(str_is('*@*.*',$mail))
                    Mail::to($mail)->send(new \App\Mail\DoctorReviewsWeeklyMail($name, $item));

                return  [
                    'mail'=>$mail,
                    'name'=>$name,
                    'items'=>$item->toArray()
                ];
            })
        ;

//        Doctor::whereHas('comments',function ($q){
//            return $q->where(['status'=>1])->whereDate('created_at','>',\Carbon\Carbon::now()->startOfWeek());
//        });

        dd( \Carbon\Carbon::now()->startOfWeek()->toDateTimeString(), $digest );
    });




    Route::get('search-index',function (){

        $per_page = 50;
        $total_pages = Doctor::public()->count()/$per_page;

        $config = [
            'model' => class_basename(Doctor::class),
            'fields'=> [
                'name'=>'self',
                'firstname'=>'self',
                'lastname'=>'self',
                'patronymic'=>'self',
                'skills'=>'name',
                'illnesses'=>'name',
                'qualifications'=>'name',
                'medcenters'=>'name',
                'additional'=>'name',
                'city'=>'name',
            ]
        ];

        Redis::publish('search indexing pages',$total_pages);
        Redis::publish('search indexing',Doctor::public()->count());

        for($page=0; $page<=$total_pages; $page++){

            $data = Doctor::public()->skip($per_page*$page)->take($per_page)->get();
            \App\Jobs\SearchIndexJob::dispatch($config,$data);
        }

        dd(
            $total_pages,
            Doctor::count()
        );
    });




    Route::any('search/{input?}/{modifier?}',function (\App\Http\Requests\Doctor\DoctorFilters $filters, $input = '', $modifier = ''){


        $search = new \App\Helpers\DoctorSearcher([$input,$modifier]);

        $search->lex()->context()->registerLog();

        $filter = $search->filter->toArray();
        $log = $search->log;
        $undefined = $search->stack;
        $processed = $search->input;


        $dump = [
            'unknown requests'=> Redis::zrangebyscore('documentSearcher:unrecoqnizedRequest','-inf','+inf','WITHSCORES'),
            'unrecognized'=> collect(Redis::keys('documentSearcher:unrecoqnized:*'))
                ->transform(function ($item){
                   return [substr($item,30) => collect(Redis::smembers($item))
                       ->transform(function ($record){
                            return json_decode($record);
                        })];
                })
        ];



        $docs = \App\Doctor::filter($filters->add($filter))->count();

        return (
            [
                'original'=>[
                    $input,
                    $modifier,
                    $filters
                ],
                'processing'=>$processed,
                'not recognized'=>$undefined,
                'filter'=>$filter,
                'log'=>$log,
                'result'=>$docs,
                'dump'=>$dump
            ]
        );
    });

    Route::view('sessions','sandbox.sessions');


    Route::get('doctor-contact',function (){

        $ar = [
            '1202-koneev-kairgali-ismagulovich'
            ,'1202-koneev-kairgali-ismagulovich'
            ,'1202-koneev-kairgali-ismagulovich'
            ,'1202-koneev-kairgali-ismagulovich'
            ,'327-popova-lyudmila-vladimirovna'
            ,'861-tryinkin-aleksey-viktorovich'
            ,'778-kobzar-nadejda-nikolaevna'
            ,'1202-koneev-kairgali-ismagulovich'
            ,'364-nikonov-igor-olegovich'
            ,'853-pozdnuhova-olga-leonidovna'
            ,'284-sultanova-bagdat-gazizovna'
            ,'2619-ahasheva-shaherizada-sepbolsyinovna'
            ,'861-tryinkin-aleksey-viktorovich'
            ,'1207-akijanova-irina-vladimirovna'
            ,'298-aryin-nurlan-muhtarovich'
            ,'276-vitkovskiy-oleg-vilgelmovich'
            ,'1059-syitina-oksana-nikolaevna'
            ,'286-lazareva-elena-nikolaevna'
            ,'1565-liseenko-igor-vasilevich'
            ,'298-aryin-nurlan-muhtarovich'
            ,'71-praskin-vyacheslav-anatolevich'
            ,'71-praskin-vyacheslav-anatolevich'
            ,'1177-sagindyikova-aliya-abhanovna'
            ,'298-aryin-nurlan-muhtarovich'
            ,'364-nikonov-igor-olegovich'
            ,'801-dyusupova-nurjamal-mukanovna'
            ,'3208-hegay-dmitriy-valerevich'
            ,'1588-chugay-oleg-grigorevich'
            ,'1706-yugay-tatyana-alekseevna'
            ,'2897-eshmuratov-temur-sherhanovich'
            ,'1296-yanishevskiy-aleksey-andreevich'
            ,'1042-askarova-indira-albertovna'
            ,'871-vasilchenko-lyubov-gerasimovna'
            ,'1180-baltabekov-nurlan-tursyinovich'
            ,'204-ilchenko-aleksandra-aleksandrovna'
            ,'1360-kim-oleg-dyik-enovich'
            ,'1328-litosh-vladimir-egorovich'
            ,'859-han-oleg-romualdovich'
            ,'238-dyibov-yuriy-aleksandrovich'
            ,'1231-omirali-rauan-muratovich'
            ,'1442-satunkina-valentina-grigorevna'
            ,'1111-shabelyanov-oleg-sergeevich'
            ,'84-tarasova-galina-viktorovna'
            ,'20-battalov-berik-pulatovich'
            ,'1179-kazakenova-arman-kudaybergenovna'
            ,'1042-askarova-indira-albertovna'
            ,'801-dyusupova-nurjamal-mukanovna'
            ,'1615-kaydarov-bakyit-kasenovich'
            ,'770-akimjanova-svetlana-maksimovna'
            ,'1226-kim-vladimir-leonidovich'
            ,'1059-syitina-oksana-nikolaevna'
            ,'287-turabaeva-ilona-bulatovna'
            ,'940-shilkina-olga-vasilevna'
            ,'1179-kazakenova-arman-kudaybergenovna'
            ,'1537-bekbasova-asel-jengisovna'
            ,'1202-koneev-kairgali-ismagulovich'
            ,'2176-gridin-igor-olegovich'
            ,'2289-svetlana-feklistova-anatolevna'
            ,'1042-askarova-indira-albertovna'
            ,'1592-komarovskaya-marina-aleksandrovna'
            ,'2104-rahimov-muhamethan-rayimhanovich'
            ,'873-sadyikov-kamil-baydulaevich'
            ,'288-tulegenova-tatyana-georgievna'
            ,'1180-baltabekov-nurlan-tursyinovich'
            ,'241-zamahova-elena-grigorevna'
            ,'82-musagulov-aslan-amangeldovich'
            ,'208-gachegova-tatyana-borisovna'
            ,'778-kobzar-nadejda-nikolaevna'
            ,'85-kononov-igor-alekseevich'
            ,'89-kushtalova-valentina-vladimirovna'
            ,'106-lenskaya-irina-gennadevna'
            ,'327-popova-lyudmila-vladimirovna'
            ,'2201-nurkanova-rena-ayapovna'
            ,'2605-salaev-erkin-bahtiyarovich'
            ,'770-akimjanova-svetlana-maksimovna'
            ,'3210-burumkulov-erik-rakishevich'
            ,'1437-morjikova-elena-anatolevna'
            ,'2360-anna-onlas-ruslanovna'
            ,'327-popova-lyudmila-vladimirovna'
            ,'110-sklyar-sergey-vladimirovich'
            ,'2289-svetlana-feklistova-anatolevna'
            ,'1510-asanova-elena-aleksandrovna'
            ,'2618-mametjanov-burhan-turganovich'
            ,'1163-demenkova-svetlana-valentinovna'
            ,'853-pozdnuhova-olga-leonidovna'
            ,'2619-ahasheva-shaherizada-sepbolsyinovna'
            ,'1504-ibragimov-timur-mihaylovich'
            ,'204-ilchenko-aleksandra-aleksandrovna'
            ,'1622-lisogor-grigoriy-valentinovich'
            ,'1622-lisogor-grigoriy-valentinovich'
            ,'2360-anna-onlas-ruslanovna'
            ,'1177-sagindyikova-aliya-abhanovna'
            ,'84-tarasova-galina-viktorovna'
            ,'777-usenov-kadyirjan-maratovich'
            ,'1266-firsov-vladimir-ivanovich'
            ,'859-han-oleg-romualdovich'
            ,'1556-shulgin-konstantin-borisovich'
            ,'1163-demenkova-svetlana-valentinovna'
            ,'2189-nikolay-dyachenko-alekseevich'
            ,'287-turabaeva-ilona-bulatovna'
            ,'244-kim-larisa-semenovna'
            ,'145-sumembaeva-marjan-zautbekovna'
            ,'1073-pojidaeva-anastasiya-leonidovna'
            ,'334-abdrazakov-kayrat-baltashevich'
            ,'1391-aleksandrova-elena-nikolaevna'
            ,'37-astapkevich-larisa'
            ,'923-vasilchenko-natalya-vladimirovna'
            ,'5066-djuvashev-almaz-bolatovich'
            ,'1042-askarova-indira-albertovna'
            ,'18-keneeva-guljana-karabekovna'
            ,'3212-korabelnikov-aleksandr-ivanovich'
            ,'80-loginova-lyudmila-aleksandrovna'
            ,'209-niyazova-lyazzat-baribaevna'
            ,'246-salyikbaeva-guljan-jumagalievna'
            ,'2422-mahmet-tumarbekov-kanyishevich'
            ,'888-husainov-tamerlan-erkinovich'
            ,'5076-djumataev-erik-asyilhanovich'
            ,'2189-nikolay-dyachenko-alekseevich'
            ,'1724-klimova-tatyana-sergeevna'
            ,'1202-koneev-kairgali-ismagulovich'
            ,'55-mansurova-gulmira-kamaldinovna'
            ,'8405-mashirenko-irina-vladimirovna'
            ,'110-sklyar-sergey-vladimirovich'
            ,'1059-syitina-oksana-nikolaevna'
            ,'1032-fedosova-tatyana-vladimirovna'
            ,'2289-svetlana-feklistova-anatolevna'
            ,'1588-chugay-oleg-grigorevich'
            ,'2990-aleksandr-chupin-nikolaevich'
            ,'867-baev-vladimir-pavlovich'
            ,'867-baev-vladimir-pavlovich'
            ,'1307-gilyazov-anis-hanifovich'
            ,'4995-dauletbaev-damir-abaydyildaevich'
            ,'2395-rustem-joldasov-ashirkarievich'
            ,'297-izbasarov-askar-ishanovich'
            ,'1357-kazakova-marina-valerevna'
            ,'1226-kim-vladimir-leonidovich'
            ,'1459-kim-igor-thya-unovich'
            ,'1305-lepesova-marjan-mahmutovna'
            ,'2405-inna-lyalkova-aleksandrovna'
            ,'3101-nurlyikaimova-jazira-aytbaevna'
            ,'6644-nurlyikaimova-jazira-aytbaevna'
            ,'873-sadyikov-kamil-baydulaevich'
            ,'3366-usmanova-gulsanam-nidjatovna'
            ,'1260-fateev-nikolay-viktorovich'
            ,'869-bukenova-janna-tlebaldievna'
            ,'2901-tumenbaeva-gauhar-kuatovna'
            ,'3383-jarova-galina-pavlovna'
            ,'3414-kudaybergenova-aygul-serikovna'
            ,'1053-kunaev-timur-irshatovich'
            ,'2363-polumiskov-vadim-evgenevich'
            ,'2197-shatskih-vladimir-vasilevich'
            ,'3472-alishev-bulat-asautaevich'
            ,'3204-baltaev-nurlan-anarkulovich'
            ,'3405-boyarova-oksana-yurevna'
            ,'4844-butyirskaya-irina-georgievna'
            ,'2391-djaimbetova-asel-pernebaevna'
            ,'13559-digay-aleksandr-konstantinovich'
            ,'102-zaltsman-irina-grigorevna'
            ,'316-kakimova-karlyigash-akimovna'
            ,'764-kim-vsevolod-anatolevich'
            ,'2968-kireev-dmitriy-aleksandrovich'
            ,'17-kireeva-elena'
            ,'1302-kuzmina-tatyana-gennadevna'
            ,'1567-kuzmina-tatyana-gennadevna'
            ,'6191-lihachev-sergey-valerievich'
            ,'2349-tatyana-roslyakova-anatolevna'
            ,'288-tulegenova-tatyana-georgievna'
            ,'1266-firsov-vladimir-ivanovich'
            ,'1556-shulgin-konstantin-borisovich'
            ,'3585-yalkin-shuhrat-shakurovich'
            ,'3585-yalkin-shuhrat-shakurovich'
            ,'1296-yanishevskiy-aleksey-andreevich'
            ,'2868-avdeeva-larisa-viktorovna'
            ,'668-amangaliev-almas-bisultanovich'
            ,'333-amirov-baktyibek-kojikovich'
            ,'104-kim-aleksandr-valerevich'
            ,'1225-kim-vladimir-valentinovich'
            ,'8546-kondrahova-svetlana-aleksandrovna'
            ,'3212-korabelnikov-aleksandr-ivanovich'
            ,'6092-kurbanov-kurban-samatovich'
            ,'6126-kuttyigojina-svetlana-viktorovna'
            ,'1437-morjikova-elena-anatolevna'
            ,'853-pozdnuhova-olga-leonidovna'
            ,'2886-popov-igor-valerevich'
            ,'1317-turlibekova-saule-serikovna'
            ,'8196-smetov-saken-balataevich'
            ,'2361-taybagarova-janar-borisovna'
            ,'1172-shaymerdenova-aygerim-serjanovna'
            ,'2197-shatskih-vladimir-vasilevich'
            ,'1706-yugay-tatyana-alekseevna'
            ,'22-adilova-leyla-mukanovna'
            ,'1928-an-viktor-vasilevich'
            ,'4375-arzyikulov-jetkergen-anesovich'
            ,'3597-artemev-konstantin-vladimirovich'
            ,'1426-asyimjanov-ruslan-asyimjanovich'
            ,'1379-ashimov-nurlan-tokenovich'
            ,'957-ayupova-venera-samatovna'
            ,'3420-berlizeva-yuliya-aleksandrovna'
            ,'3065-voloshina-elena-vasilevna'
            ,'1236-gileva-elena-vladimirovna'
            ,'2176-gridin-igor-olegovich'
            ,'1773-dyusenov-nurlan-bulatovich'
            ,'3101-nurlyikaimova-jazira-aytbaevna'
            ,'6644-nurlyikaimova-jazira-aytbaevna'
            ,'2361-taybagarova-janar-borisovna'
            ,'1408-karpolenko-nadejda-nikolaevna'
            ,'1592-komarovskaya-marina-aleksandrovna'
            ,'85-kononov-igor-alekseevich'
            ,'3461-kosenko-tatyana-frantsevna'
            ,'115-deryabin-leon-pavlovich'
            ,'881-luksha-olga-vladimirovna'
            ,'2042-makarova-ulyana-vasilevna'
            ,'8283-mitkovskaya-oksana-anatolevna'
            ,'1280-mukajanov-marat-kenjetaevich'
            ,'1879-mukanov-amir-sabitovich'
            ,'1812-muhamedov-yusup-majitovich'
            ,'953-utegenova-nazipa-aytbaevna'
            ,'2104-rahimov-muhamethan-rayimhanovich'
            ,'2357-uvaletova-tatyana-borisovna'
            ,'1195-haybulina-albina-kamilevna'
            ,'7773-hrapunova-olga-yurevna'
            ,'3436-chalaya-irina-yurevna'
            ,'2990-aleksandr-chupin-nikolaevich'
            ,'3585-yalkin-shuhrat-shakurovich'
            ,'5076-djumataev-erik-asyilhanovich'
            ,'4098-abieva-aida-maratovna'
            ,'333-amirov-baktyibek-kojikovich'
            ,'9512-bazanova-kseniya-sergeevna'
            ,'3290-jasulan-baymahanov-bolatbekovich'
            ,'3571-baratova-elena-vladimirovna'
            ,'1781-begimbaeva-menzipa-sauhumovna'
            ,'4844-butyirskaya-irina-georgievna'
            ,'3705-svetlana-byakova-sergeevna'
            ,'923-vasilchenko-natalya-vladimirovna'
            ,'1194-vorobeva-elena-mihaylovna'
            ,'208-gachegova-tatyana-borisovna'
            ,'2353-grebennikova-galina-aleksandrovna'
            ,'2176-gridin-igor-olegovich'
            ,'3192-gulyaeva-galina-gennadevna'
            ,'2956-duyunov-boris-anatolevich'
            ,'2097-irina-timofeeva-kebekovna'
            ,'8041-kalimoldaeva-saltanat-bulatovna'
            ,'104-kim-aleksandr-valerevich'
            ,'2436-aleksandr-kim-valerevich'
            ,'3419-kim-violetta-borisovna'
            ,'34-kugay-igor-borisovich'
            ,'9130-elena-lavrova-nikolaevna'
            ,'1678-tekebaeva-latina-ayjanovna'
            ,'1410-levterov-aleksey-anastasovich'
            ,'1622-lisogor-grigoriy-valentinovich'
            ,'3130-makarov-valeriy-anatolevich'
            ,'1445-manambaeva-zuhra-alpyisbaevna'
            ,'1393-mischenko-aleksandr-aleksandrovich'
            ,'3737-natalya-ogurtsova-mihaylovna'
            ,'3334-prokusheva-irina-petrovna'
            ,'30-sabadasheva-natalya-nikolaevna'
            ,'1129-sabdenov-nurbolat-ospanovich'
            ,'3742-salov-vladimir-dmitrievich'
            ,'1956-slavko-elena-alekseevna'
            ,'1209-tohseitova-saule-tursyinbekovna'
            ,'2350-irina-tyan-ilinichna'
            ,'8521-fast-ilya-vladimirovich'
            ,'1430-haliullina-roza-zaidovna'
            ,'290-sharipova-madina-anuarbekovna'
            ,'7963-shurpita-margarita-nikolaevna'
            ,'3585-yalkin-shuhrat-shakurovich'
            ,'3585-yalkin-shuhrat-shakurovich'
            ,'3295-abdibekov-maren-ibragimovich'
            ,'334-abdrazakov-kayrat-baltashevich'
            ,'28-abdrasilova-svetlana-serikbaevna'
            ,'908-abdullaev-tuychiboy-mansurhonovich'
            ,'13819-arman-abenov-maksutovich'
            ,'2415-aygul-seytalieva-ermuhanovna'
            ,'1705-orazbekova-ayman-kudaybergenovna'
            ,'2382-aldungarova-roza-kapsidarovna'
            ,'204-ilchenko-aleksandra-aleksandrovna'
            ,'3039-shavkat-aliev-timranovich'
            ,'1298-almagambetova-gulsara-asanovna'
            ,'8616-vladimir-arepev-eduardovich'
            ,'1179-kazakenova-arman-kudaybergenovna'
            ,'4416-astrahantseva-elena-vladimirovna'
            ,'299-ahmetov-ruslan-turarovich'
            ,'299-ahmetov-ruslan-turarovich'
            ,'4530-baybosunov-daniyar-almazbekovich'
            ,'2354-liliya-baymurzaeva-grigorevna'
            ,'2400-roman-bezrukov-vladimirovich'
            ,'2400-roman-bezrukov-vladimirovich'
            ,'3365-berezko-natalya-arnoldovna'
            ,'356-borsova-fatima-zaurbievna'
            ,'4826-buldakov-anatoliy-merkurevich'
            ,'3705-svetlana-byakova-sergeevna'
            ,'13879-valiev-serik-muratovich'
            ,'4854-vasetskaya-natalya-andreevna'
            ,'871-vasilchenko-lyubov-gerasimovna'
            ,'14058-olga-vaskovskaya-vladimirovna'
        ];

        $docs = Doctor::whereIn('alias',$ar)->get();
        return view('sandbox.doc-contact',compact('docs'));

    });
});
