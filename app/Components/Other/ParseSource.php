<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.10.2018
 * Time: 16:29
 */

namespace App\Components\Other;


class ParseSource
{
    public $blocks;
    public $json;


    public static function video($raw_url)
    {
        $result = false;
        $raw_url = trim($raw_url);
        $url = parse_url($raw_url);

        try {
            if (strpos($url['host'], 'youtube') !== false || strpos($url['host'], 'youtu.be') !== false) {
                $query = $url['query']??false;

                parse_str($query, $query_arr);
                if (array_key_exists('v', $query_arr)) {
                    $video_id = $query_arr['v'];
                } else {
                    if (!$query) {
                        $video_id = str_replace('/', '', $url['path']);
                    }
                }
                $result = '<iframe class="embed-responsive-item"  src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
            } else if (strpos($url['host'], 'vimeo') !== false) {
                $video_id = filter_var($url['path'], FILTER_SANITIZE_NUMBER_INT);
                $result = '<iframe class="embed-responsive-item"  src="https://player.vimeo.com/video/' . $video_id . '"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
            }
        } catch (\Exception $e) {
            ob_get_clean();
            if(!isset($url['host'])){
                throw new \Exception('Неправильная ссылка, возможно нехватает http или https ');
            }

        }
        return $result;
    }






}