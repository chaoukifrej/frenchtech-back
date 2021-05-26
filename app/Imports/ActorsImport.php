<?php

namespace App\Imports;

use App\Actor;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ActorsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

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

    public function rules(): array
    {
        return [
            '*.logo' => ['string'],
            '*.name' => ['string', 'max:64'],
            '*.adress' => ['string', 'max:64'],
            '*.postal_code' => ['integer', 'max:06999', 'min:06000', 'size:5'],
            '*.city' => ['string', 'max:64'],
            '*.email' => ['string', 'email', 'max:64', 'unique:actors'],
            '*.phone' => ['string', 'max:20'],
            '*.category' => ['string', 'max:64'],
            '*.associations' => ['nullable', 'string', 'max:64'],
            '*.description' => ['string'],
            '*.facebook' => ['nullable', 'string'],
            '*.twitter' => ['nullable', 'string'],
            '*.linkedin' => ['nullable', 'string'],
            '*.website' => ['nullable', 'string'],
            '*.activity_area' => ['string', 'max:64'],
            '*.funds' => ['numeric'],
            '*.employees_number' => ['integer'],
            '*.jobs_available_number' => ['integer'],
            '*.women_number' => ['integer'],
            '*.revenues' => ['numeric']
        ];
    }
}
