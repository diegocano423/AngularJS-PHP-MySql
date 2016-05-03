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
                            $create_query = "INSERT INTO games (title, description, developer, console, releaseDate) 
                                             VALUES (:title, :description, :developer, :console, :release)";
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

    public function edit ($title, $description, $developer, $console, $release) {
        $result = [];

        if ($this->valid->validString($title)) {
            if ($this->valid->validString($description)) {
                if ($this->valid->validString($developer)) {
                    if ($this->valid->validString($console)) {
                        if ($release) {
                            $edit_query = "UPDATE games 
                                           SET title   = :title, 
                                           description = :description,
                                           developer   = :developer,
                                           console     = :console,
                                           releaseDate = :release
                                           WHERE title = :title";
                            $edit_params = [
                                ":title"       => $title,
                                ":description" => $description,
                                ":developer"   => $developer,
                                ":console"     => $console,
                                ":release"     => $release
                            ];
                            $result_query = "SELECT * FROM games WHERE title = :title";
                            $result_params = [ ":title" => $title ];
                            $result = $this->storage->query($edit_query, $edit_params) ? true : false;

                            if ($result) {
                                $result = $this->storage->query($result_query, $result_params);
                                return $result;
                            } else {
                                $result = [
                                    'message' => "We don't have any game by that title",
                                    'error' => true
                                ];
                                return $result;
                            }

                            return $result;

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

    public function delete ($title) {
        $result = [];

        if ($title) {
            $delete_query = "DELETE FROM games WHERE title = :title";
            $delete_params = [":title" => $title];
            $result = $this->storage->query($delete_query, $delete_params);
            return $result['message'] = "Game succesfully deleted.";
        } else {
            $result["message"] = "We couldn't delete the game you selected.";
            $result["error"] = true;
            return $result;
        }

        return $result;     
    }

    public function getAll () {

    }

    public function getOne () {

    }
}