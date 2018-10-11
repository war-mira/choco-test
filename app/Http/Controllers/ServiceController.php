<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceGroup;
use Illuminate\Http\Request;
use Intervention\Image\Exception\NotFoundException;

class ServiceController extends Controller
{

    private $related = [
        481 => 884,
        581 => 657,
        478 => 582,
    ];

    public function index()
    {

        $serviceGroup = ServiceGroup::with('services')
            ->active()->get();

        return view('redesign.pages.service.index',[
            'serviceGroups' => $serviceGroup
        ]);
    }

    public function groupList($alias)
    {
        $serviceGroup = ServiceGroup::whereAlias($alias)->active()->first();

        return view('redesign.pages.service.list',[
            'serviceGroup' => $serviceGroup
        ]);
    }
    public function medcentersList($group,$alias)
    {
        $service = Service::whereAlias($alias)->active()->first();
        if(is_null($service)){
            throw new NotFoundException();
        }

        if($service->group->alias !== $group){
            return redirect(route('service.service-list',[
                'group'=>$service->group->alias,
                'alias'=>$service->alias
            ]),301);
        }
        return view('redesign.pages.service.medcenters',[
            'service' => $service
        ]);
    }
    public function seed()
    {

         $groups = $this->getFromJson();
         $this->fillData($groups);
         dd($groups);
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getFromJson()
    {
        $groups = collect();
        $data = collect();
        $json = json_decode(\Storage::disk('public')->get('convertcsv.json'));
        foreach ($json as $key => $row) {
            $group = $row->{"Группа услуги"};
            if (empty($group)) {
                $row->{"Группа услуги"} = $json[$key - 1]->{"Группа услуги"};
            }
            $data->push($row);
        }
        $data->map(function ($item) use ($groups) {
            if (!$groups->has($item->{"Группа услуги"})) {
                $groups->put($item->{"Группа услуги"}, collect());
            }
            $new = $groups->get($item->{"Группа услуги"});
            $new->push($item);
        });
        return $groups;
    }

    /**
     * @param $groups
     */
    public function fillData($groups)
    {
        foreach ($groups as $key => $group) {
            $exist = ServiceGroup::where('name', $key)->first();
            if (is_null($exist)) {
                $service_group = new ServiceGroup();
                $service_group->name = $key;
                $service->active = 1;
                $service_group->save();
            } else {
                $service_group = $exist;
            }
            foreach ($group as $item) {
                if (!empty($item->{"Услуга"})) {
                    $service_exist = Service::where('name', $item->{"Услуга"})->first();
                    if (is_null($service_exist)) {
                        $service = new Service();
                        $service->name = $item->{"Услуга"};
                        $service->group_id = $service_group->id;
                        $service->active = 1;
                        $service->save();
                    } else {
                        $service = $service_exist;
                        $ids = clone $item;
                        unset($ids->{"Услуга"});
                        unset($ids->{"Группа услуги"});
                        foreach ($ids as $key => $price) {
                            if (!empty($price)) {
                                if(array_key_exists($key,$this->related)){
                                    $service->medcenters()->attach($this->related[$key],['price'=>(int)preg_replace("/[^0-9]/", "", $price)]);
                                }
                                $service->medcenters()->attach($key,['price'=>(int)preg_replace("/[^0-9]/", "", $price)]);
                            }
                        }


                    }
                }


            }
        }
    }
}
