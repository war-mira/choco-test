<?php

namespace App\Http\Resources\Admin\Doctor;

use App\Helpers\ConstraintBuilder;
use App\Http\Resources\Base\TableResource;

class DoctorTable extends TableResource
{
    protected $rowResource = DoctorTableRow::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    protected function processQuerySearch($query, $search)
    {
        $constraints = $this->prepareConstraints($search);
        $doSearch = self::compileConstraints($constraints);

        $doSearch($query);

        return $query;
    }

    private function prepareConstraints($search)
    {
        $phrases = explode(' ', $search);
        $operator = 'where';
        $constraints = [];
        foreach ($phrases as $phrase) {
            if (empty(trim($phrase)))
                continue;
            $constraints[] = [
                $operator,
                [
                    ['_closure' => [

                        ['where', ConstraintBuilder::Doctors()->firstname->contains($phrase)],
                        ['orWhere', ['doctors.lastname', 'like', '%' . $phrase . '%']],
                        ['orWhere', ['doctors.patronymic', 'like', '%' . $phrase . '%']],
                        [
                            'orWhereHas',
                            [
                                'city',
                                [
                                    '_closure' => [
                                        ['where', ['cities.name', 'like', '%' . $phrase . '%']]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'orWhereHas',
                            [
                                'skills',
                                [
                                    '_closure' => [
                                        ['where', ['skills.name', 'like', '%' . $phrase . '%']]
                                    ]
                                ]
                            ]
                        ],
                        [
                            'orWhereHas',
                            [
                                'medcenters',
                                ['_closure' => [
                                    ['where', ['medcenters.name', 'like', '%' . $phrase . '%']]
                                ]]
                            ]
                        ],
                    ]
                    ]
                ]
            ];
            $operator = 'orWhere';
        }
        return $constraints;
    }

    private static function compileConstraints($constraints)
    {
        return function ($query) use ($constraints) {
            foreach ($constraints as $constraint) {
                $operator = $constraint[0];
                $arguments = $constraint[1];
                $params = [];
                foreach ($arguments as $argument) {
                    if ($argument['_closure'] ?? false) {
                        $params[] = function ($query) use ($argument) {
                            $closure = self::compileConstraints($argument['_closure']);
                            $closure($query);
                        };
                    } else {
                        $params[] = $argument;
                    }
                }
                $query->{$operator}(...$params);
            }
        };

    }
}
