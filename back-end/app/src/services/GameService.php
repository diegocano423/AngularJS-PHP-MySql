<?php 

namespace App\Services;

class GameService {
	private $storage;
	private $isDBReady = TRUE;

	public function __construct() {
        if ($this->isDBReady) {
            $this->storage = new StorageService();
            $this->valid = new ValidationService();
        }
    }

    public function create ($title, $description, $developer, $console, $release){
    	$result = [];

    	if ($this->valid->validString($title)) {
    		if ($this->valid->validString($description)) {
    			if ($this->valid->validString($developer)) {
    				if ($this->valid->validString($console)) {
    					if ($release) {
                            $game_query = "SELECT title FROM games WHERE title = :title LIMIT 1";
                            $params_of_game = [ ":title" => $title ];
                            $create_query = "INSERT INTO games (title, description, developer, console, release) VALUES (:title, :description, :developer, :console, :release)";
                            $create_params = [
                                ":title" => $title,
                                ":description" => $description,
                                ":developer" => $developer,
                                ":console" => $console,
                                ":release" => $release
                            ];
            
                            if ($this->isDBReady) {
                                $it_does = $this->storage->query($game_query, $params_of_game);

                                if ($it_does['data'][0]) {
                                    $result["messages"] = "Game already registered";
                                    $result["error"] = true;
                                } else {
                                    $result = $this->storage->query($create_query, $create_params);
                                    $result = $this->storage->query($game_query, $params_of_game);
                                    return $result;
                                }
                            }

    					} else {
                            $result["message"] = "Release date is required.";
                            $result["error"] = true;
                        }
    				} else {
                        $result["message"] = "Console is required.";
                        $result["error"] = true;
    				}
    			} else {
                    $result["message"] = "Developer is required.";
                    $result["error"] = true;
    			}
    		} else {
                $result["message"] = "Description is required.";
                $result["error"] = true;
    		}
    	} else {
            $result["message"] = "Game title is required.";
            $result["error"] = true;
    	}
        return $result;
    }

    public function edit () {
        $result = [];

        if ($this->valid->validString($title)) {
            if ($this->valid->validString($description)) {
                if ($this->valid->validString($developer)) {
                    if ($this->valid->validString($console)) {
                        if ($release) {

                        } else {
                            $result["message"] = "A new release date field is required for edition.";
                            $result["error"] = true;
                        }
                    } else {
                        $result["message"] = "A new console field is required for edition.";
                        $result["error"] = true; 
                    }
                } else {
                    $result["message"] = "A new developer field is required for edition.";
                    $result["error"] = true;
                }
            } else {
                $result["message"] = "A new description field is required for edition.";
                $result["error"] = true;
            }
        } else {
            $result["message"] = "A new title field is required for edition.";
            $result["error"] = true;
        }
        return $result;
    }

    public function delete () {

    }

    public function getAll () {

    }

    public function getOne () {

    }
}