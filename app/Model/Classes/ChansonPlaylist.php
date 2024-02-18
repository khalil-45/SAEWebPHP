<?php

namespace Model\Classes;

class ChansonPlaylist
{
    private $chanson_id;
    private $playlist_id;

    public function __construct($chanson_id, $playlist_id)
    {
        $this->chanson_id = $chanson_id;
        $this->playlist_id = $playlist_id;
    }

    public function getChansonId()
    {
        return $this->chanson_id;
    }

    public function getPlaylistId()
    {
        return $this->playlist_id;
    }
}

?>