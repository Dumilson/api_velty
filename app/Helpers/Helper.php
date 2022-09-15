<?php

namespace App\Helpers;

use DateTime;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function returPagination($data_collection, $data_contain, $params = null)
    {
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $data_collection,
            $data_contain->total(),
            $data_contain->perPage(),
            $data_contain->currentPage(),
            [
                'path' => \Request::url() . $params,
                'query' => [
                    'page' => $data_contain->currentPage()
                ]
            ]
        );
    }

    public static function objectJson($data, bool $assoc = false)
    {
        return json_decode(json_encode($data),$assoc);
    }

    public static function returnApi($messages, $status, $data = null, $header = null)
    {
        $response = ['status' => '0', 'message' => 'Validation error'];
        $response['status'] = $status;
        $response['message'] = $messages;
        if ($data != null or $data == 0) {
            $response['data'] = $data;
        }
        return response($response, $status)->withHeaders([
            $header
        ]);
    }

    public static function upload($image, $local)
    {
        if (is_file($image)) {
            $extension = $image->getClientOriginalExtension();
            $picture = uniqid() . '.' . $extension;
            $destinationPath = public_path() . $local;
            $res = $image->move($destinationPath, $picture);
            if ($res) {
                return [
                    'status' => true,
                    'message' => $picture
                ];
            }
            return [
                'status' => false,
                'message' => "Error Upload"
            ];
        }
    }

    public static function formata_telefone($numero)
    {
        if (empty($numero)) {
            return $numero;
        }
        $ret = '';
        switch (strlen($numero)) {
            case '10':
                $ret = "(" . substr($numero, 0, 2) . ") " . substr($numero, 2, 4) . "-" . substr($numero, 6, 4);
            case '11':
                $ret = "(" . substr($numero, 0, 2) . ") " . substr($numero, 2, 1) . "-" . substr($numero, 3, 4) . "-" . substr($numero, 7, 4);
                break;
            case '12':
                $ret = substr($numero, 0, 2) . " (" . substr($numero, 2, 2) . ") " . substr($numero, 4, 4) . "-" . substr($numero, 8, 4);
                break;
            case '13':
                $ret = substr($numero, 0, 2) . " (" . substr($numero, 2, 2) . ") " . substr($numero, 4, 1) . "-" . substr($numero, 5, 4) . "-" . substr($numero, 9, 4);
                break;
            default:
                $ret = $numero;
                break;
        }
        return $ret;
    }

    public static function formated_CEP($string)
    {
        return substr($string, 0, 5) . '-' . substr($string, 5, 3);
    }
    public static function formated_CNPJ($_NUM)
    {
        if (empty($_NUM) || $_NUM == '') {
            return $_NUM;
        }
        $o_ret = '';
        $o_ret = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $_NUM);
        return $o_ret;
    }

    public static function formated_CPF($_NUM)
    {
        if (empty($_NUM) || $_NUM == '') {
            return $_NUM;
        }
        $o_ret = '';
        $o_ret = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $_NUM);
        return $o_ret;
    }

    public static function verifyExist($table, $colum, $value, $colum_id = null, $value_colum_id = null)
    {
        $data = DB::table($table)->where($colum, $value)
            ->where($colum_id, "!=", $value_colum_id)
            ->first();
        if (!empty($data)) {
            return true;
        }
        return false;
    }
}
