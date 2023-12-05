<?php

namespace App\Http\Services;

use App\Http\Interfaces\PropertyDataInterface;
use App\Http\Traits\CacheTrait;
use Illuminate\Support\Facades\Http;

class DatafinitiService implements PropertyDataInterface
{
    use CacheTrait;

    public const RECORDS_PER_PAGE = 3;

    public function addressSearch(string $address, string $city, string $province, string $postal, string $country = "US"): array
    {
        $query = $this->buildSearchQuery($address, $city, $province,  $postal, $country);
        return $this->doSearch($query);
    }

    protected function buildSearchQuery(string $address, string $city, string $province, string $postal, string $country = "US"): string
    {
        $string = $this->getSearchParamString('address', $address);
        $string .= $this->appendSearchParamString('city', $city);
        $string .= $this->appendSearchParamString('province', $province);
        $string .= $this->appendSearchParamString('postalCode', $postal);
        $string .= $this->appendSearchParamString('country', $country);
        return $string;
    }

    protected function getSearchParamString(string $key, string $value)
    {
        return "$key:\"$value\"";
    }

    protected function appendSearchParamString(string $key, string $value)
    {
        return " AND " . $this->getSearchParamString($key, $value);
    }

    protected function doSearch(string $query) : array
    {
        if ($this->hasCached($query)) {
            return $this->getCached($query);
        }

        $url = config('services.datafiniti.endpoint');
        $token = config('services.datafiniti.token');
        $body = [
            'query' => $query,
            'format' => 'JSON',
            'num_records' => self::RECORDS_PER_PAGE,
            'download' => false
        ];

        $response = Http::withToken($token)->post($url, $body)->json();
        $this->setCached($query, $response);

        return $response;
    }
}