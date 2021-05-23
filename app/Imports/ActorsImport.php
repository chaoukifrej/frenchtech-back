<?php

namespace App\Imports;

use App\Actor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ActorsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //a faire, methode pour recuperer long et lat
        $adress = $row['adresse'] . $row['ville'] . $row['postalcode'];
        $url = 'https://api-adresse.data.gouv.fr/search/?q=' . $adress;

        $client = new \GuzzleHttp\Client();
        $response = json_decode($client->get($url)->getBody());
        $longitude = $response->features[0]->geometry->coordinates[1];
        $latitude = $response->features[0]->geometry->coordinates[0];

        return new Actor([
            "name" => $row['nom'],
            "email" => $row['email'],
            "phone" => $row['telephone'],
            "adress" => $row['adresse'],
            "postal_code" => $row['postalcode'],
            "city" => $row['ville'],
            'longitude' => $longitude,
            'latitude' => $latitude,
            "category" => $row['categorie'],
            "associations" => $row['associations'],
            "facebook" => $row['facebook'],
            "linkedin" => $row['linkedin'],
            "twitter" => $row['twitter'],
            "website" => $row['siteinternet'],
            "activity_area" => $row['secteuractivite'],
            "funds" => $row['fonds'],
            "employees_number" => $row['nombreemployees'],
            "jobs_available_number" => $row['nombrepostesdisponibles'],
            "women_number" => $row['nombrefemmes'],
            "revenues" => $row['chiffreaffaires'],
            "logo" => $row['logo'],
            "description" => $row['description'],
        ]);
    }
}
