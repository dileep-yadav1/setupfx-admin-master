<?php

namespace App\Imports;

use App\Helpers\CustomHelper;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportLead implements ToModel, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // echo "<pre>";
        // print_r($row);
        // die;
        $clientData['admin_id'] = Auth::user()->admin_id;
        $clientData['first_name'] = $row[0];
        $clientData['last_name'] = $row[1];
        $clientData['email'] = $row[2];
        $clientData['contact'] = $row[3];
        $clientData['company_name'] = $row[4];
        $clientData['country'] = $row[5];
        $clientData['country_id'] = $row[5];
        $clientData['state_id'] = $row[6];
        $clientData['city_id'] = $row[7];
        $clientData['net_worth'] = ($row[8] != "") ? CustomHelper::getParameterId($row[8]) : "";
        $clientData['annual_income'] = ($row[9] != "") ? CustomHelper::getParameterId($row[9]) : "";
        $clientData['emp_status'] = ($row[10] != "") ? CustomHelper::getParameterId($row[10]) : "";
        $clientData['dob'] = $row[11];
        $clientData['address_1'] = $row[12];
        $clientData['address_2'] = $row[13];
        $clientData['source_income'] = ($row[14] != "") ? CustomHelper::getParameterId($row[14]) : "";
        $clientData['invest_known'] = ($row[15] != "") ? CustomHelper::getParameterId($row[15]) : "";
        $clientData['objective_exp'] = ($row[16] != "") ? CustomHelper::getParameterId($row[16]) : "";
        $clientData['nationality'] = $row[17];
        $clientData['previous_exp'] = ($row[18] != "") ? CustomHelper::getParameterId($row[18]) : "";
        $clientData['initial_amt'] = ($row[19] != "") ? CustomHelper::getParameterId($row[19]) : "";
        $clientData['status'] = 1;
        $clientData['created_by'] = Auth::user()->id;
        $clientData['updated_by'] = Auth::user()->id;
        $client = Client::create($clientData);

        $userData['admin_id'] = Auth::user()->admin_id;
        $userData['client_id'] = $client->id;
        $userData['name'] = $clientData['first_name'] . $clientData['last_name'];
        $userData['email'] = $clientData['email'];
        $userData['password'] = Hash::make("123456");
        $userData['dob'] = $clientData['dob'];
        $userData['role_id'] = config('constant.CLIENT_ROLE');
        $userData['status'] = 0;
        $userData['created_by'] = Auth::user()->id;
        $userData['updated_by'] = Auth::user()->id;

        return new User($userData);
    }
}
