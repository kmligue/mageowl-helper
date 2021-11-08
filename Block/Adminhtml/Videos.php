<?php

namespace Mageowl\Helper\Block\Adminhtml;

use Kreait\Firebase\Factory;

class Videos
{
    protected $database;
    protected $dbname = 'mageowl';
    protected $google_api_key = 'AIzaSyCKo8qoey4VisGbiDhi_qXHVEUWxvLMRhg';
    protected $helper;

    public function __construct(
        \Kreait\Firebase\Factory $factory,
        \Mageowl\Helper\Helper\Data $helper
    ) {
        $this->helper = $helper;

        if ($this->helper->getFirebaseConfigJson()) {
            $factory = $factory->withServiceAccount($this->helper->getFirebaseConfigJson());
            $this->database = $factory->createDatabase();
        }
    }

    public function getVideos($fbkey)
    {
        if (!$this->database) {
            return [];
        }

        $reference = $this->database->getReference( $this->dbname . '/' . $fbkey );
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();

        return $value;
    }

    public function save($urls, $titles, $fbkey)
    {
        $data = array();

        foreach ($urls as $key => $value) {
            if (!empty($value)) {
                $data[] = array(
                    'video_id' => $this->get_video_id_from_url($value),
                    'url' => $value,
                    'title' => $titles[$key]
                );
            }
        }

        $this->database->getReference( $this->dbname . '/' . $fbkey )->set( $data );

        return $data;
    }

    protected function get_video_id_from_url($url) {
        $video_id = '';

        parse_str( parse_url( $url, PHP_URL_QUERY ), $array_of_vars );

        $video_id = $array_of_vars['v'];

        return $video_id;
    }
}