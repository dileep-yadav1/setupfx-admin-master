<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportLead implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $data = Client::select(
            'clients.first_name',
            'clients.last_name',
            'clients.email',
            'clients.contact',
            'clients.company_name',
            'c_id.name as country_id',
            's_id.name as state_id',
            'ci_id.name as city_id',
            'nw.param_name as net_worth',
            'ai.param_name as annual_income',
            'es.param_name as emp_status',
            'clients.dob',
            'clients.address_1',
            'clients.address_2',
            'si.param_name as source_income',
            'ik.param_name as invest_known',
            'oe.param_name as objective_exp',
            'clients.nationality',
            'pe.param_name as previous_exp',
            'ia.param_name as initial_amt',
            'clients.status',
        )->leftjoin('countries as c_id', 'c_id.id', '=', 'clients.country_id')
            ->leftjoin('states as s_id', 's_id.id', '=', 'clients.state_id')
            ->leftjoin('cities as ci_id', 'ci_id.id', '=', 'clients.city_id')
            ->leftjoin('tab_parameters as si', 'si.param_value', '=', 'clients.source_income')
            ->leftjoin('tab_parameters as ik', 'ik.param_value', '=', 'clients.invest_known')
            ->leftjoin('tab_parameters as oe', 'oe.param_value', '=', 'clients.objective_exp')
            ->leftjoin('tab_parameters as pe', 'pe.param_value', '=', 'clients.previous_exp')
            ->leftjoin('tab_parameters as ia', 'ia.param_value', '=', 'clients.initial_amt')
            ->leftjoin('tab_parameters as nw', 'nw.param_value', '=', 'clients.net_worth')
            ->leftjoin('tab_parameters as ai', 'ai.param_value', '=', 'clients.annual_income')
            ->leftjoin('tab_parameters as es', 'es.param_value', '=', 'clients.emp_status')
            ->get();
        // echo "<pre>";
        // print_r($data);
        // die;
        return $data;
    }

    public function headings(): array
    {
        return [
            'First Name', 'Last Name', 'Email', 'Contact', 'Company Name', 'Country', 'State', 'City', 'Net Worth', 'Annual Income', 'Employement Status', 'Date of Birth', 'Address 1', 'Address 2', 'Source of Income', 'Knowledge of Investment', 'Objective Investment', 'Nationality', 'Previous Experience', 'Initail Amount', 'Status',
        ];
    }
}
